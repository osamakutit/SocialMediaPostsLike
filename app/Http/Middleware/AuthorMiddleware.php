<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin using the isAdmin method
        if ($request->user()->isAuthor()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
