<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check()){
            return response()->json([
                'success'=>false,
                'message'=>'You need to login to carry out this action'
            ],401);
        }
        return $next($request);
    }
}
