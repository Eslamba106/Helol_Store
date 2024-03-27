<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->is('admin') || $request->is('admin/*')) {
                    // redirect for backend
                    return redirect(RouteServiceProvider::Admin);
                } else {
                    // redirect for frontend in case front
                    // return redirect(RouteServiceProvider::HOME);
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        return $next($request);
    }
}
