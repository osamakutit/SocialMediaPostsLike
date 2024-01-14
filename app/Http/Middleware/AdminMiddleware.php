<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin using the isAdmin method
        if ($request->user()->isAdmin()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}