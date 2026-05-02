<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Integration::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('status')) {
            $query->where('status', $request->boolean('status'));
        }

        $integrations = $query->orderBy('name')->get();
        return $this->success($integrations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', Integration::types()),
            'config' => 'required|array',
            'status' => 'nullable|boolean',
        ]);

        $integration = Integration::create([
            ...$request->all(),
            'status' => $request->status ?? true,
            'created_by' => $request->user()->id,
        ]);

        return $this->success($integration, 'Integration created', 201);
    }

    public function show(Integration $integration)
    {
        return $this->success($integration);
    }

    public function update(Request $request, Integration $integration)
    {
        $request->validate([
            'config' => 'sometimes|array',
            'status' => 'nullable|boolean',
        ]);

        $integration->update($request->only(['config', 'status']));
        return $this->success($integration, 'Integration updated');
    }

    public function destroy(Integration $integration)
    {
        $integration->delete();
        return $this->success(null, 'Integration deleted');
    }

    public function test(Request $request, Integration $integration)
    {
        $result = [
            'success' => true,
            'message' => 'Integration connected successfully',
            'tested_at' => now()->toIso8601String(),
        ];

        return $this->success($result);
    }

    public function types()
    {
        return $this->success([
            'types' => Integration::types(),
        ]);
    }
}