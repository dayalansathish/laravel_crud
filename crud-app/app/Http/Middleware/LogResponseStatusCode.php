<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogResponseStatusCode
{
    public function handle(Request $request, Closure $next)
    {
        // Handle the request and get the response
        $response = $next($request);

        // Log the status code
        \Log::info('Response Status Code: ' . $response->status());

        // Store the status code in the session
        session(['status_code' => $response->status()]);
        // dd($response->status());
        return $response;
    }
}
