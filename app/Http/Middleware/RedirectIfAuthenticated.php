<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User as user;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       if (Auth::guard($guard)->check()) {
        $tes = user::join('roles','roles.id_role','users.id_role')
        ->where('email',Auth::user()->email)->first();
        if ($tes->n_role != 'client') {
            return redirect('/profil');
        }
            return redirect('/profil');
        }
        return $next($request);
        
        

        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }
        // return $next($request);
    }
}
