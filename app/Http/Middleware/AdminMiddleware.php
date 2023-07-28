<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->getPathInfo();

        if (Auth::check()) {
            $isAdmin = Auth::user()->is_admin;
            if (($isAdmin && ( $path == '/items' || $path == '/admin' || $path == '/logout' || $path == '/items/create' || $path == '/update-admin-status')) || 
                ($isAdmin && strpos($path, '/items') === 0 && in_array($request->getMethod(), ['GET', 'POST', 'PUT', 'DELETE']))) {
                return $next($request);
            }
        } else {
            return redirect('/login'); 
        }

        return abort(404);
    }
}








