<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
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
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            if (!empty(Auth::user()->level)) {
                $user = Auth::user()->level;
                if ($user == $role) {
                    return $next($request);
                }
            } else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
