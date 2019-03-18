<?php

namespace App\Http\Middleware;

use Closure;

class Student
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
        if (!Auth::check() or Auth::user()->role_id != 4) {
            Flash::error('Sorry, you need to be a student to access that page');
            return redirect()->route('courses.index');
        }
        return $next($request);
    }
}
