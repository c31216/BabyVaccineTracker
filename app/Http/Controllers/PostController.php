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
                'patient_fname' => 'required|max:255',
                'patient_lname' => 'required|max:255',
                'patient_bdate' => 'required|max:255',
                'patient_weight' => 'required|max:255',
                'patient_height' => 'required|max:255',
                'patient_age' => 'required|max:255',
                'patient_sex' => 'required|min:1',
                'patient_mother_name' => 'required|max:255',
                'patient_address' => 'required|max:255',
                'patient_uname' => 'required|max:255|Alpha_num',
                'patient_pass' => 'required|max:255|Alpha_num'
        ]);
        
     

        // if ($validator->fails()) {

        //   return response()->json(['input' => $validator->errors()->keys()]);

        // }else{
        //     echo 'success';
        // }
       
      
        $patient = new Patient;
        $patient->patient_fname = $request->patient_fname;
        $patient->patient_lname = $request->patient_lname;
        $patient->patient_bdate = $request->patient_bdate;
        $patient->patient_weight = $request->patient_weight;
        $patient->patient_height = $request->patient_height;
        $patient->patient_age = $request->patient_age;
        $patient->patient_sex = $request->patient_sex;
        $patient->patient_mother_name = $request->patient_mother_name;
        $patient->patient_address = $request->patient_address;
        $patient->patient_uname = $request->patient_uname;
        $patient->patient_pass = $request->patient_pass;
        $patient->patient_registration_date = $request->patient_registration_date;

        $patient->save();

        echo $patient->PatientID;
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
        $immunizationstatus = Immunization::where('p_id', '=' , $id)->orderBy('id','desc')->get();

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

         

         


        return view('patients.show')->withPatients($patient)->withVaccinationdates($vaccination_date)->withImmunizationstatuses($immunizationstatus);
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
    public function update(Request $request, $id)
    {
        // $patient = Patient::find($id);
        // if ($request->slug == $patient->slug) {
        //     $this->validate($request, array(
        //         'title' => 'required|max:255',
        //         'body' => 'required'
        //     ));
        // } else {
        //     $this->validate($request, array(
        //         'title' => 'required|max:255',
        //         'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        //         'body' => 'required'
        //     ));
        // }
        // DB::update("UPDATE patients SET patient_fname = ? WHERE PatientID = ?", ['dfabvbda', '1']);
        
        $post = Post::find($request->id);

        $post->patient_fname = $request->value;

        $post->save();

        
        echo $request->value;
      
      

        // Session::flash('success' , 'Successfully saved.');

        // return redirect()->route('patients.index');
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
                               "<td class='edit patient_weight' id='".$patient->PatientID."'>".$patient->patient_weight."</td>".
                               "<td class='edit patient_height' id='".$patient->PatientID."'>".$patient->patient_height."</td>".
                               "<td class='edit patient_age' id='".$patient->PatientID."'>".$patient->patient_age."</td>".
                               "<td class='edit patient_sex' id='".$patient->PatientID."'>".$patient->patient_sex."</td>".
                               "<td class='edit patient_mother_name' id='".$patient->PatientID."'>".$patient->patient_mother_name."</td>".
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

        $immunizationstatus = Immunization::where('p_id', '=' , $id)->orderBy('id','desc')->get();

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


        $pdf = PDF::loadView('pdf/pdf',['patients' => $patient,'vaccinationdates' => $vaccination_date]);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('invoice.pdf');

    }

  
}
