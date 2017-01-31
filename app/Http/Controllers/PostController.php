<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Patient;
use App\Vaccine;
use App\Immunization;
use Session;
use PDF;
use Validator;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
    {
        $this->middleware('auth', ['except' => ['pdf']]);
    }


    public function index()
    {
        $patient = Patient::orderBy('PatientID', 'desc')->paginate(10);
        $vaccine = Vaccine::all();

        return view('patients.index')->withPatients($patient)->withVaccines($vaccine);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storpatient_age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'patient_fname' => 'required|max:50|min:2',
                'patient_lname' => 'required|max:50|min:2',
                'patient_bdate' => 'required|max:255',
                'patient_weight' => 'required|max:255|integer',
                'patient_height' => 'required|max:255|integer',
                'patient_sex' => 'required|min:1|in:F,M,',
                'patient_address' => 'required|max:255',
                'patient_phonenumber' => 'required|regex:(639)|size:12',
                'patient_uname' => 'required|max:255|unique:patients',
                'patient_headcircumference' => 'required|max:255|integer',
        ]);
        
        $output = "";
        $patient_acct = "";

        if ($validator->fails()) {

            foreach ($validator->errors()->all('<li>:message</li>') as $error_message) {
                $output .= $error_message;
            }

          return response()->json(['input' => $output, 'field_name' => $validator->errors()->keys()]);


        }else{
            $rand_num = rand(50, 10000);

            $patients = Patient::orderBy('PatientID', 'desc')->first();

            if ($patients) {
                $patient_acct = $patients->PatientID . $rand_num;
            }else{
                $patient_acct = $rand_num;
            }


            DB::table('patients')->insert([
                ['patient_fname' => $request->patient_fname,
                 'patient_lname' => $request->patient_lname,
                 'patient_bdate' =>$request->patient_bdate,
                 'patient_weight' => $request->patient_weight,
                 'patient_height' => $request->patient_height,
                 'patient_headcircumference' => $request->patient_headcircumference,
                 'patient_sex' => $request->patient_sex,
                 'patient_mother_name' => $request->patient_mother_name,
                 'patient_guardian_name' => $request->patient_guardian_name,
                 'patient_father_name' => $request->patient_father_name,
                 'patient_address' => $request->patient_address,
                 'patient_phonenumber' => $request->patient_phonenumber,
                 'patient_registration_date' => $request->patient_registration_date,
                 'patient_uname' => $request->patient_uname,
                 'patient_pass' => md5('user_pass'),

                ]
            ]);

           

            return response()->json(['patient_id' => $patient->PatientID]);
            
      
       
      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $patient = Patient::find($id);
        $immunizationstatus = Immunization::where('patient_id', '=' , $id)->orderBy('ImmunizationID','asc')->get();

        $TookVaccine = Vaccine::whereDoesntHave('users', function($q) use($id) {
         $q->where('patients.PatientID', $id);
        })->get();


        return view('patients.show')->withPatients($patient)->withImmunizationstatuses($immunizationstatus)->withTookvaccines($TookVaccine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patients.edit')->withPatient($patient);
    }

    /**
     * Update the specified resource in storpatient_age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        
        $patient = Patient::find($request->id);
        $b = $request['col'];
        
        if ($b == 'patient_age') {
           return false;
        }
        $patient->$b = $request->value;

        $patient->save();

        
        echo $request->value;
    }

    /**
     * Remove the specified resource from storpatient_age.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();       
        Session::flash('Success', 'Record Successfully Deleted');
        return redirect()->route('patients.index');
    }

    public function search(Request $request){
        if ($request->ajax()) {
            $output = "";
            if (empty($request->sort)) {
                $sort = 'PatientId';
            }else{
                $sort = $request->sort;
            }

            $patients = Patient::orderBy($sort, 'asc')->where('patient_fname','like', $request->search.'%')->orWhere('patient_lname','like', $request->search.'%')->orWhere('patient_address','like', $request->search.'%')->get();
            
            if ($patients) {
                foreach ($patients as  $patient) {
                    $output .= "<tr><td class='date patient_registration_date' id='".$patient->PatientID."'>".$patient->patient_registration_date."</td>".
                               "<td class='date patient_bdate' id='".$patient->PatientID."'>".$patient->patient_bdate."</td>".
                               "<td class='edit patient_lname' id='".$patient->PatientID."'>".$patient->patient_lname."</td>".
                               "<td class='edit patient_fname' id='".$patient->PatientID."'>".$patient->patient_fname."</td>".
                               "<td class='number patient_weight' id='".$patient->PatientID."'>".$patient->patient_weight."</td>".
                               "<td class='number patient_height' id='".$patient->PatientID."'>".$patient->patient_height."</td>".
                               "<td class='number patient_headcircumference id='".$patient->PatientID."'>".$patient->patient_headcircumference."</td>".
                               "<td class='patient_age'>".Carbon::createFromFormat('Y-m-d', $patient->patient_bdate)->diff(Carbon::now())->format('%y year(s), %m month(s) and %d day(s)')."</td>".
                               "<td class='select patient_sex' id='".$patient->PatientID."'>".$patient->patient_sex."</td>".
                               "<td class='edit patient_mother_name' id='".$patient->PatientID."'>".$patient->patient_mother_name."</td>".
                               "<td class='edit patient_father_name' id='".$patient->PatientID."'>".$patient->patient_father_name."</td>".
                               "<td class='edit patient_guardian_name' id='".$patient->PatientID."'>".$patient->patient_guardian_name."</td>".
                               "<td class='edit patient_address' id='".$patient->PatientID."'>".$patient->patient_address."</td>".
                               "<td><a href='posts/".$patient->PatientID."'><p>View Profile</p></a><td>".
                               "<td><a href='checkup/".$patient->PatientID."'><p>Check Up</p></a><td>".
                               "<td><a href='immunization/".$patient->PatientID."'><p>Immunization</p></a><td>".
                               "<td><a href='pdf/".$patient->PatientID."' target='_blank'><p>Download PDF</p></a><td></tr>";
                              
                }

                return Response($output);
            }else{
                return Response()->json(['no'=>'Not Found']);
            }
        }
        
    }
    public function pdf($id){
        $patient = Patient::where('PatientID', '=', $id)->first();

        $immunizationstatus = Immunization::where('patient_id', '=' , $id)->orderBy('patient_id','desc')->get();

        $TookVaccine = Vaccine::whereDoesntHave('users', function($q) use($id) {
         $q->where('patients.PatientID', $id);
        })->get();

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


        $pdf = PDF::loadView('pdf/pdf',['patients' => $patient,'vaccinationdates' => $vaccination_date, 'tookvaccines' => $TookVaccine]);
        $pdf->setPaper('A4', 'landscape');

        return @$pdf->stream('ImmunizationRecord.pdf');

    }

    public function update_hospital_type(Request $request){

         $vaccine_id = $request['vaccine_id'];

        DB::table('immunizations')
            ->where('patient_id', $request->id)
            ->where('vaccine_id', $vaccine_id)
            ->update(['vaccination_received' => $request->value,'hospital_type' => 'Private']);
        
        echo $request->value. '<br>' . 'Private';

    }

    public function store_hospital_type(Request $request){

        // $validator = Validator::make($request->all(), [
        //         'patient_fname' => 'required|max:50|min:2',
        //         'patient_lname' => 'required|max:50|min:2',
        //         'patient_bdate' => 'required|max:255',
        //         'patient_weight' => 'required|max:255|integer',
        //         'patient_height' => 'required|max:255|integer',
        //         'patient_sex' => 'required|min:1|in:F,M,',
        //         'patient_address' => 'required|max:255',
        //         'patient_phonenumber' => 'required|regex:(639)|size:12',
        //         'patient_uname' => 'required|max:255|unique:patients',
        //         'patient_headcircumference' => 'required|max:255|integer',
        // ]);
            $vaccine_id = $request['vaccine_id']; 
            $immunization = new Immunization;
            $immunization->vaccine_id = $vaccine_id;
            $immunization->immunization_description = 'empty';
            $immunization->midwife_name = 'empty';
            $immunization->patient_id = $request->id;
            $immunization->vaccination_received =  $request->value;
            $immunization->patient_weight = 0;
            $immunization->patient_height = 0;
            $immunization->hospital_type = 'Private';
            
            DB::table('immunizations')->insert([
                ['vaccine_id' => $vaccine_id, 'immunization_description' => 'empty', 'midwife_name' => 'empty'
                , 'patient_id' => $request->id
                , 'vaccination_received' => $request->value
                , 'patient_weight' => 0
                , 'patient_height' => 0
                , 'hospital_type' => 'Private'
            ]]);

            // return response()->json(['patient_id' => $immunization->PatientID]);
            echo $request->value. '<br>' . 'Private';

         

    }

    public function autocomplete(Request $request){

        if ($request->ajax()) {
            $output = "";
            if ($request->inputval) {
                $patients = Patient::orderBy('PatientID', 'asc')->where('patient_address','like', $request->inputval.'%')->groupBy('patient_address')->get();
                
                if ($patients) {
                    foreach ($patients as  $patient) {
                        $output .= "<li class='ui-menu-item'><a>".$patient->patient_address."</a></li>";
                                  
                    }

                    return Response($output);
                }else{
                    return Response('Not found');
                }
            }
        }
    }

  
}
