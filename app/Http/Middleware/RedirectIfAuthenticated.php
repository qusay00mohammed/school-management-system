<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check() and $guard == 'web') {
    //             return redirect(RouteServiceProvider::HOME);

    //         } else if (Auth::guard($guard)->check() and $guard == 'student') {
    //             return redirect(RouteServiceProvider::STUDENT);

    //         } else if (Auth::guard($guard)->check() and $guard == 'parent') {
    //             return redirect(RouteServiceProvider::PARENT);

    //         } else if (Auth::guard($guard)->check() and $guard == 'teacher') {
    //             return redirect(RouteServiceProvider::TEACHER);
    //         }
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        else if (auth('student')->check()) {
            return redirect('/student/dashboard');
        }
        else if (auth('teacher')->check()) {
            return redirect('/teacher/dashboard');
        }
        else if (auth('parent')->check()) {
            return redirect('/parent/dashboard');
        }

        return $next($request);
    }

    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {

    //         if ($guard == "admin" && Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }

    //         if ($guard == "parent" && Auth::guard($guard)->check()) {
    //             return redirect('/parent/dashboard');
    //         }

    //         if ($guard == "student" && Auth::guard($guard)->check()) {
    //             return redirect('/student/dashboard');
    //         }

    //         if (Auth::guard($guard)->check() && $guard == "teacher") {
    //             return redirect('/teacher/dashboard');
    //         }
    //     }

    //     return $next($request);
    // }


}
