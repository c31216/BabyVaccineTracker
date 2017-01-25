<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Patient;
use Validator;
use Hash;
class UserSettingsController extends Controller
{

	public function edit($id){
		$PatientID = Session::get('PatientID');
    	$patient = Patient::find($PatientID);
		return view('settings.edit')->withPatient($patient);
	}
    public function update(Request $request, $id){

    	$validator = Validator::make($request->all(), [
            'patient_uname' => 'required|max:255',
            'patient_pass' => 'required|min:6|max:255|alpha_num|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            'patient_pass_confirmation' => 'required|min:6|max:255|alpha_num|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
        $messages = [
        	'regex' => 'The password should contain at least one uppercase/lowercase letters and one number',
        	'patient_pass.requried' => 'The password field is required',
        	'patient_pass.min' => 'The password must be at least 6 characters.',
        	'patient_pass.max' => 'The password may not be greater than 255 characters.',
        	'patient_pass.alpha_num' => 'The password may only contain letters and numbers.',
        	'patient_pass.confizrmed' => 'The password confirmation does not match.',
        	'patient_pass_confirmation.requried' => 'The password field is required',
        	'patient_pass_confirmation.min' => 'The password must be at least 6 characters.',
        	'patient_pass_confirmation.max' => 'The password may not be greater than 255 characters.',
        	'patient_pass_confirmation.alpha_num' => 'The password may only contain letters and numbers.',
        	'patient_pass_confirmation.confirmed' => 'The password confirmation does not match.',

        ]);

    	$PatientID = Session::get('PatientID');

    	$patient = Patient::where('PatientID', '=', $PatientID)->first();

        if ($patient && !Hash::check($request->patient_old_pass, $patient->patient_pass)) {
		    $validator->errors()->add('patient_old_pass', 'The Old Password does not match our records.');
		    return redirect()->route('user.settings', $PatientID)->withErrors($validator);
		}

        if ($validator->fails()) {
		    return redirect()->route('user.settings', $PatientID)->withErrors($validator);
		}else{

			$patient->patient_pass =  $request->patient_pass;
			$patient->patient_uname =  $request->patient_uname;

			$patient->save();

		}

		
		Session::flash('success' , 'Successfully saved.');
		return redirect()->route('user.settings', $PatientID)->withErrors($validator);

    }
}
