<?php

namespace App\Http\Controllers\UserAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Patient;
use Session;
use Validator;
use App\Vaccine;
use App\Immunization;
use PDF;
use Hash;

class UserLoginController extends Controller
{
    public function login(){

    	return view('userside.login');
    }

    public function logout(){
    	Session::forget('PatientID');

    	return redirect()->route('user.login');
    }

    public function index(){
    
    	$PatientID = Session::get('PatientID');
    	$patient = Patient::find($PatientID);
        $immunizationstatus = Immunization::where('patient_id', '=' , $PatientID)->orderBy('ImmunizationID','desc')->get();

        $vaccination_date = [];
        $values = [];
        $null_values = [];
        $count = 0;

        while ($count<12) {
            if ($count >= sizeof($immunizationstatus)){
                while ($count<12) {
                    $null_values[] = 'Empty';
                    $count++;
                }
                break;
               
            }else{
                $anotherValue = $immunizationstatus[$count];
            }
            $values[] =  $anotherValue->vaccination_received;
            $count++;
        }
         foreach (array_merge($values,$null_values) as $merge ) {
             $vaccination_date[] = $merge;
        }

    	return view('userside.index')->withPatient($patient)->withVaccinationdates($vaccination_date)->withImmunizationstatuses($immunizationstatus);
    }

    public function check(Request $request){

    	$validator = Validator::make($request->all(), [
            'patient_uname' => 'required|max:255',
            'patient_pass' => 'required|max:255',
        ]);

    	$patient = Patient::where('patient_uname', '=', $request->patient_uname)->first();


    	if ($patient && Hash::check($request->patient_pass, $patient->patient_pass)) {

    		Session::put('PatientID', $patient->PatientID);
    		return redirect()->route('user.index');

    	}else{

    		$request->flashOnly('patient_uname');
            $validator->errors()->add('patient_uname', 'These credentials do not match our records.');
    		return redirect()->route('user.login')->withErrors($validator);

    	}
    }
	
}
