<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level): Response
    {
        if($request->session()->get('level') != $level){
            return redirect('/dashboard')->withErrors(['gagal','Anda tidak memilki akses ke halaman ini.']);
        }
        return $next($request);
    }
}
