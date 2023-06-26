<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    // {

    //     if(Auth::user()){
    //         return redirect('/home');
            // dd(Auth::user());
    //     }; 
    //     return $next($request);
    // }
    // {
    //     if (Auth::check()) {
    //         return redirect('/home');
    //     }
        
    //     return $next($request);
    // }
    {
        // dd(Auth::check());

    if (!Auth::check()) {
    
     return redirect('/home');
    
    } 
    //else {
    //     if ($request->is('home')) {
    //         return redirect('/login');
    //     }
    // }

    return $next($request);

}
}
        