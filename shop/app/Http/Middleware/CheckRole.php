<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu user có role == 1 mới được truy cập tiếp
        if(Auth::guard('admin')->check()&&  Auth::guard('admin')->user()->role_id==1){
            return $next($request);
        }
        abort(401, 'Unauthorized.');

    }
}
