<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Patient;
use App\Vaccine;
use App\User;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
         
        $vaccine = Vaccine::all();
       
        return view('sms.index')->withVaccines($vaccine);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storpatient_age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storpatient_age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storpatient_age.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter(Request $request){
        $vaccine_id = $request->vaccine_id;

        $users = Patient::whereDoesntHave('users', function($q) use($vaccine_id){
            $q->where('vaccine_id', '=', $vaccine_id);
        })->get();

        if ($users->isEmpty()) {
            echo "";
            
        }else{    

            foreach ($users as $user) {
            echo "<input type='checkbox' class='users' checked name='".$user->PatientID."' value='".$user->PatientID."'> " . $user->patient_lname . ", " . $user->patient_fname . " <br>";
            }
        }

       
        
        // foreach ($patients as $patient) {
        //    echo "<p>" . $patient->patient_lname . ", " . $patient->patient_fname . "</p>";
        // }

    }

    public function getPatientID(Request $request){
        $PatientID = $request->patient_id;

        $output = "";

        $patients = Patient::whereIn('PatientID', $PatientID)->get();

        foreach ($patients as $patient) {
            if ($patient->patient_phonenumber) {

                 $output .= $patient->patient_phonenumber . ";";
            }
        

        }
        echo rtrim($output,';');
    }   

    public function sendmessage(Request $request){
        
        $dstno = $request->patient_numbers;
        $msg = $request->message;
        $username = 'otachan';
        $password = 'Eldertale1';
        $type = 1;
        $senderid = 12345;

        $sendlink = "http://www.isms.com.my/isms_send.php?un=".urlencode($username)."&pwd=".urlencode($password)."&dstno=".$dstno."&msg=".urlencode($msg)."&type=".$type."&sendid=".$senderid; 
        fopen($sendlink, "r");
        
    }
}
