<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $role = $role == 'admin' ? 1 : 0;
        $user = Auth::user();
        if($user->is_admin == $role){
            return $next($request);
        }

        return redirect('/home');
    }
}
