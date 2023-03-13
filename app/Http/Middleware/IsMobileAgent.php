<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMobileAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('api')->check())
        {
            if(auth('api')->user()->role == 3)
            {
                return $next($request);
            }
            else
            {
                return response()->json(["UnAuthorize"], 401);
            }
        }
        else
        {
            return response()->json(["UnAuthorize"], 401);

        }
    }
}
