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
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated.',
                ], 401);
            }
            return redirect('/login');
        }

        $roles = array_filter(array_map('trim', explode(',', $role)));
        $hasAccess = $request->user()->hasAnyRole($roles);

        if (!$hasAccess) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have the required role.',
                ], 403);
            }

            if ($request->user()->hasRole('client')) {
                return redirect('/client/dashboard');
            }

            return redirect('/login');
        }

        return $next($request);
    }
}