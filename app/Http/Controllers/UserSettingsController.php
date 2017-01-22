<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Patient;
use Validator;
class UserSettingsController extends Controller
{

	public function edit($id){
		$PatientID = Session::get('PatientID');
    	$patient = Patient::find($PatientID);
		return view('settings.edit')->withPatient($patient);
	}
    public function update(Request $request, $id){
    	$PatientID = Session::get('PatientID');

    	$patient = Patient::where('patient_pass', '=', $request->patient_old_pass)->where('PatientID', '=', $PatientID)->first();
    	
    	$validator = Validator::make($request->all(), [
            'patient_uname' => 'required|max:255|exists:patients,patient_uname',
            'patient_pass' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            'patient_pass_confirmation' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],$messages = ['regex' => 'The password should contain at least one uppercase/lowercase letters and one number',]);

        if (!$patient) {
		    $validator->errors()->add('patient_old_pass', 'The Old Password does not match our records.');
		    return redirect()->route('user.settings', $PatientID)->withErrors($validator);
		}

        if ($validator->fails()) {
		    return redirect()->route('user.settings', $PatientID)->withErrors($validator);
		}

		$patient->patient_pass =  $request->patient_pass;
		$patient->patient_uname =  $request->patient_uname;

		$patient->save();
		Session::flash('success' , 'Successfully saved.');
		return redirect()->route('user.settings', $PatientID)->withErrors($validator);

    }
}
