<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class CheckSession
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

       if (!Session::has('PatientID'))
        {
            return redirect()->route('user.login');

        }

        return $next($request);
    }
}
