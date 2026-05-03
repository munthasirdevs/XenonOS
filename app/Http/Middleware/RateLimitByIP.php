<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitByIP
{
    protected $maxAttempts = 5;
    protected $decaySeconds = 60; // 1 minute window
    
    public function handle(Request $request, Closure $next)
    {
        $key = 'login:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            
            // Log suspicious activity
            \App\Models\SecurityLog::create([
                'user_id' => null,
                'event' => 'suspicious_activity',
                'ip_address' => $request->ip(),
                'details' => 'Too many login attempts from IP - rate limit exceeded. Blocked for ' . $seconds . ' seconds.',
            ]);
            
            return response()->json([
                'message' => 'Too many login attempts. Please try again in ' . ceil($seconds / 60) . ' minute(s).',
                'retry_after' => $seconds,
            ], 429);
        }
        
        RateLimiter::hit($key, $this->decaySeconds);
        
        return $next($request);
    }
}