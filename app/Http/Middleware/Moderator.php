<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class Moderator
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
          //if this person is logged in and isn't an admin or mod, redirect
        if (!Auth::check() or Auth::user()->role_id > 2) {
            Flash::error('Sorry, you need to be an admin or a mod to access that page');
            return redirect()->route('courses.index');
        }

        return $next($request);
    }
}
