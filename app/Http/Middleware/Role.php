<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,string $role)
    {
        // $roles = array_slice(func_get_args(), 2);
        // dd($role);
        // $user = Auth::user()->role;
         
        // return $next($request);
            $user = Auth::user()->role;
            // dd($user,$role);
            if( $user == $role){
                return $next($request);
            }
        return redirect()->back();
    }
}
