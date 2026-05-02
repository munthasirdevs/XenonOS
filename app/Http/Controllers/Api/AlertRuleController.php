<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlertRule;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AlertRuleController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = AlertRule::query();

        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $rules = $query->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($rules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'trigger_type' => 'required|in:' . implode(',', AlertRule::triggerTypes()),
            'condition' => 'required|array',
            'action' => 'required|in:' . implode(',', AlertRule::actions()),
            'config' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $rule = AlertRule::create([
            ...$request->all(),
            'is_active' => $request->is_active ?? true,
            'created_by' => $request->user()->id,
        ]);

        return $this->success($rule, 'Alert rule created', 201);
    }

    public function show(AlertRule $alertRule)
    {
        return $this->success($alertRule);
    }

    public function update(Request $request, AlertRule $alertRule)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'trigger_type' => 'sometimes|in:' . implode(',', AlertRule::triggerTypes()),
            'condition' => 'sometimes|array',
            'action' => 'sometimes|in:' . implode(',', AlertRule::actions()),
            'config' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $alertRule->update($request->all());
        return $this->success($alertRule, 'Alert rule updated');
    }

    public function destroy(AlertRule $alertRule)
    {
        $alertRule->delete();
        return $this->success(null, 'Alert rule deleted');
    }

    public function toggle(AlertRule $alertRule)
    {
        $alertRule->update(['is_active' => !$alertRule->is_active]);
        return $this->success(null, $alertRule->is_active ? 'Rule enabled' : 'Rule disabled');
    }

    public function triggerOptions()
    {
        return $this->success([
            'types' => AlertRule::triggerTypes(),
            'actions' => AlertRule::actions(),
        ]);
    }

    public function execute(Request $request)
    {
        $rules = AlertRule::where('is_active', true)->get();

        $executed = 0;
        foreach ($rules as $rule) {
            $executed++;
        }

        return $this->success(['executed' => $executed, 'rules_checked' => $rules->count()]);
    }
}