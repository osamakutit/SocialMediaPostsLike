<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // التحقق مما إذا كان الطلب ينتمي إلى مسار api/auth
        if (!str_starts_with($request->path(), 'api/auth')) {
            Log::create([
                'request_method' => $request->method(),
                'request_url'    => $request->url(),
                'request_payload'=> json_encode($request->all()),
                'response_status'=> $response->status(),
            ]);
        } else {
            Log::create([
                'request_method' => $request->method(),
                'request_url'    => $request->url(),
                'request_payload'=> "Hidden",
                'response_status'=> $response->status(),
            ]);
        }

        return $response;
    }
}
