<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = AuditLog::with(['user:id,name'])->orderBy('created_at', 'desc');

        if ($request->has('entity_type')) {
            $query->where('entity_type', $request->entity_type);
        }

        if ($request->has('entity_id')) {
            $query->where('entity_id', $request->entity_id);
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('action')) {
            $query->where('action', $request->action);
        }

        if ($request->has('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(50);
        return $this->success($logs);
    }

    public function show(AuditLog $auditLog)
    {
        $auditLog->load(['user:id,name']);
        return $this->success($auditLog);
    }

    public function entityHistory(Request $request)
    {
        $request->validate([
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
        ]);

        $history = AuditLog::where('entity_type', $request->entity_type)
            ->where('entity_id', $request->entity_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->success($history);
    }

    public function userHistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $history = AuditLog::where('user_id', $request->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return $this->success($history);
    }

    public function export(Request $request)
    {
        $query = AuditLog::query();

        if ($request->has('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        return $this->success($query->orderBy('created_at', 'desc')->get());
    }
}