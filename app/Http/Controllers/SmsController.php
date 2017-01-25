<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Patient;
use App\Vaccine;
use App\User;
use Session;

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
        $balance = 'http://www.isms.com.my/isms_balance.php?un=otachan&pwd=Eldertale1';
   
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

        $patients = Patient::whereDoesntHave('users', function($q) use($vaccine_id){
            $q->where('vaccine_id', '=', $vaccine_id);
        })->get();

        if ($patients->isEmpty()) {
            echo "";
            
        }else{    

            foreach ($patients as $patient) {
                
       

          

            echo    "<div class='[ form-group ]'>
                        <input type='checkbox' class='users' checked name='".$patient->PatientID."' value='".$patient->PatientID."' id='".$patient->PatientID."' autocomplete='off' />
                        <div class='[ btn-group ]'>
                            <label for='".$patient->PatientID."' class='[ btn btn-primary ]'>
                                <span class='[ glyphicon glyphicon-ok ]'></span>
                                <span> </span>
                            </label>
                            <label for='fancy-checkbox-primary' class='[ btn btn-default active ]'>
                                " . $patient->patient_lname . ", " . $patient->patient_fname . "
                            </label>
                        </div>
                    </div>";
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
            if ($patient->patient_phonenumber != ' ') {

                 $output .= $patient->patient_phonenumber . ";";
            }
        

        }
        echo rtrim($output,';');
    }   

    public function sendmessage(Request $request){

        $dstno = $request->patient_numbers;
        $msg = $request->message;
        $username = 'cmeniano';
        $password = 'Eldertale1';
        $type = 1;
        $senderid = 'MexicoRHC';

        $sendlink = "https://www.isms.com.my/isms_send.php?un=".urlencode($username)."&pwd=".urlencode($password)."&dstno=".$dstno."&msg=".urlencode($msg)."&type=".$type."&sendid=".$senderid; 
        fopen($sendlink, "r");

        // $fields = array();
        // $fields["api"] = "XXXXXXXXXXXXX";
        // $fields["number"] = $one_number; //safe use 63
        // $fields["message"] = $string_message;
        // $fields["from"] = $string_from;
        // $fields_string = http_build_query($fields);
        // $outbound_endpoint = "http://api.semaphore.co/api/sms"
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $outbound_endpoint);
        // curl_setopt($ch,CURLOPT_POST, count($fields));
        // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output = curl_exec($ch);
        // curl_close($ch);  http://www.semaphore.co/ no free trial, outbound = 0.5 php inbound = 4
        // /https://www.itexmo.com/Developers/packages/index.php - per month
        //https://manage.plivo.com/accounts/register/ 0.40 php

        Session::flash('Success', 'Your Message Has Been Sent');
        return redirect()->route('sms.index');


    }
}
