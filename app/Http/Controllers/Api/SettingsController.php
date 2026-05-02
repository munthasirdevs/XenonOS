<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Setting::query();

        if ($request->has('group')) {
            $query->where('group', $request->group);
        }

        $settings = $query->orderBy('group')->orderBy('key')->get();
        return $this->success($settings);
    }

    public function show(Setting $setting)
    {
        return $this->success($setting);
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings,key',
            'value' => 'required',
            'type' => 'nullable|in:string,integer,boolean,json',
            'group' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $setting = Setting::create($request->all());
        return $this->success($setting, 'Setting created', 201);
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required',
            'description' => 'nullable|string',
        ]);

        $setting->update($request->only(['value', 'description']));
        return $this->success($setting, 'Setting updated');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return $this->success(null, 'Setting deleted');
    }

    public function getValue(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $value = Setting::get($request->key, $request->default ?? null);
        return $this->success(['key' => $request->key, 'value' => $value]);
    }

    public function setValue(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'required',
            'type' => 'nullable|in:string,integer,boolean,json',
        ]);

        Setting::set(
            $request->key,
            $request->value,
            $request->type ?? 'string',
            $request->group ?? 'general'
        );

        return $this->success(null, 'Setting saved');
    }

    public function byGroup(string $group)
    {
        $settings = Setting::where('group', $group)->get();
        return $this->success($settings);
    }
}