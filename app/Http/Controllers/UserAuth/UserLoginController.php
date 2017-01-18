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
        $immunizationstatus = Immunization::where('p_id', '=' , $PatientID)->orderBy('id','desc')->get();

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
            'patient_uname' => 'required',
            'patient_pass' => 'required',
        ]);

    	$patient = Patient::where('patient_uname', '=', $request->patient_uname)->
    						where('patient_pass', '=', $request->patient_pass)->first();


    	if ($patient) {

    		Session::put('PatientID', $patient->PatientID);
    		return redirect()->route('user.index');

    	}else{

    		$request->flashOnly('patient_uname');
            $validator->errors()->add('patient_uname', 'These credentials do not match our records.');
    		return redirect()->route('user.login')->withErrors($validator);

    	}
    	// $patient_uname_db = $patient->patient_uname;
    	// $patient_pass_db = $patient->patient_pass;

    	// if ($request->patient_uname == $patient_uname_db && $request->patient_pass == $patient_pass_db) {
    	// 	echo 'sdfs';
    	// }else{
    	// 	echo 'failed';
    	// }
    }
	
}
