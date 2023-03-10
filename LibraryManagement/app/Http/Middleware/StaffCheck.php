<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->session()->has('loginUsername')) {
            return redirect()->route('login');
        }
        if($request->session()->get('loginUsername') == 'admin') {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
