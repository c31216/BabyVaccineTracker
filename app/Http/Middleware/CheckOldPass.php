<?php

namespace App\Http\Middleware;

use Closure;
use App\Patient;
use Session;
class CheckOldPass
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
        $patient = Patient::where('patient_pass', '=', $request->patient_old_pass)->where('PatientID', '=',Session::get('PatientID'))->first();

        if (!$patient) {
            return redirect()->route('user.settings', Session::get('PatientID'));
        }
        
        return $next($request);
    }
}
