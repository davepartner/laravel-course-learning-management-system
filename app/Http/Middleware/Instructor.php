<?php

namespace App\Http\Middleware;

use Closure;
use Flash;
use Auth;

class Instructor
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
        if (!Auth::check() or Auth::user()->role_id > 3) {
            Flash::error('Sorry, you need to be an admin, a mod or an instructor to access that page');
            return redirect()->route('courses.index');
        }
        return $next($request);
    }
}
