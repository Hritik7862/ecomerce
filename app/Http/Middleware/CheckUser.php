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

    
        // $path = $request->getRequestUri();

        // if (Auth::check()) {
        //     if(($path == '/items' || $path =='/admin') && Auth::user()->is_admin){
        //         return $next($request);
        //     }
        // }
        // return abort('404');
    
    //else {
    //     if ($request->is('home')) {
    //         return redirect('/login');   
    //     }
    // }


}
}
        