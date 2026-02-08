<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            return response()->json([
                'message' => 'لطفا ابتدا وارد حساب کاربری خود شوید'
            ], 401);
        }

        if(auth()->user()->role_id == 1){
            return response()->json([
                'message' => 'شما اجازه ورود به این قسمت را ندارید'
            ], 403);
        }

        return $next($request);
    }
}
