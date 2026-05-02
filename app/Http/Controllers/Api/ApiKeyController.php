<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $keys = $request->user()->apiKeys()
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->success($keys);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $key = Str::random(64);
        $hashedKey = hash('sha256', $key);

        $apiKey = $request->user()->apiKeys()->create([
            'name' => $request->name,
            'key_hint' => substr($key, -4),
            'key_hash' => $hashedKey,
            'permissions' => $request->permissions ?? ['read'],
            'expires_at' => $request->expires_at,
        ]);

        return $this->success([
            'id' => $apiKey->id,
            'name' => $apiKey->name,
            'key' => $key,
            'key_hint' => $apiKey->key_hint,
            'expires_at' => $apiKey->expires_at,
        ], 'API key created - store securely', 201);
    }

    public function show(Request $request, ApiKey $apiKey)
    {
        if ($apiKey->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        return $this->success($apiKey);
    }

    public function update(Request $request, ApiKey $apiKey)
    {
        if ($apiKey->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'permissions' => 'sometimes|array',
            'expires_at' => 'nullable|date',
        ]);

        $apiKey->update($request->only(['name', 'permissions', 'expires_at']));
        return $this->success($apiKey, 'API key updated');
    }

    public function destroy(Request $request, ApiKey $apiKey)
    {
        if ($apiKey->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $apiKey->delete();
        return $this->success(null, 'API key revoked');
    }

    public function regenerate(Request $request, ApiKey $apiKey)
    {
        if ($apiKey->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $key = Str::random(64);
        $hashedKey = hash('sha256', $key);

        $apiKey->update([
            'key_hint' => substr($key, -4),
            'key_hash' => $hashedKey,
        ]);

        return $this->success([
            'key' => $key,
            'key_hint' => $apiKey->key_hint,
        ], 'API key regenerated');
    }
}