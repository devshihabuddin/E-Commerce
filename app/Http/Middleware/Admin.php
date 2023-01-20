<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
       // dd(auth()->user()->role);
        if(Auth::guard('admin')->check()){
            return $next($request);
        }else{
            return redirect()->route('admin.login.form')->with('error',"You don't have access");
        }
        
    }
}
