<?php

namespace App\Http\Middleware;

use Closure;

class StopAdminFromDeleting
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
        if(auth()->check()){
           $roles = auth()->user()->roles;
            if(in_array('admin',$roles)){
                return response()->json([
                    'success'=>false,
                    'message'=>'User with adminroles are not allowed to delete users'
                ],200);
            }
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'You need to login'
            ],401);
        }
        
        
        return $next($request);
    }
}
