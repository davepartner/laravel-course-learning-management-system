<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //if this person is logged in and isn't an admin, redirect
        if(!Auth::check() OR Auth::user()->role_id != 1 ){
            Flash::error('Sorry, you need to be an admin to access that page');
            return redirect()->route('courses.index');
        }

        return $next($request);
    }
}
