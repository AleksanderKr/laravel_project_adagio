<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check()) {
            # dostęp dla administratorów oraz do własnych profili
            if (Auth::user()->role == 1 || '/users/'.Auth::id() == $request->getPathInfo() || '/users/'.Auth::id().'/edit' == $request->getPathInfo()) {
                return $next($request);
            }
            else {
                return redirect('/home')->with('message', 'Access denied');
            }   
        }
        else {
            return redirect('/login')->with('message', 'Log in to get access');
        }
        
        return $next($request);
    }
}
