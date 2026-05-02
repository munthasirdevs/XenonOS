<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        if (!$request->user()->hasRole($role)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have the required role.',
            ], 403);
        }

        return $next($request);
    }
}