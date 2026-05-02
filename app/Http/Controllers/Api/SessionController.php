<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $sessions = $request->user()
            ->sessions()
            ->orderBy('last_activity', 'desc')
            ->get();

        return $this->success($sessions);
    }

    public function destroy(Request $request, Session $session)
    {
        if ($session->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $session->delete();

        return $this->success(null, 'Session deleted successfully');
    }
}