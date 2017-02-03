<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Checkup;
use App\MedicalPersonnel;
use App\Patient;
use Session;

class CheckupController extends Controller
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
        //
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
        $this->validate($request, [
                'patient_id' => 'required|max:255|numeric',
                'checkup_date' => 'required|max:255|date',
                'doctor_name' => 'required|max:255',
                'checkup_symptoms' => 'required|max:255',
                'checkup_prescription' => 'required|max:255',
                'checkup_description' => 'required|max:255',
                'patient_weight' => 'required|max:255|numeric',
                'patient_height' => 'required|max:255|numeric',
        ]);
        $checkup = new Checkup;

        $checkup->patient_id = $request->patient_id;
        $checkup->checkup_date = $request->checkup_date;
        $checkup->doctor_name = $request->doctor_name;
        $checkup->checkup_symptoms = $request->checkup_symptoms;
        $checkup->checkup_prescription = $request->checkup_prescription;
        $checkup->checkup_description = $request->checkup_description;
        $checkup->patient_weight = $request->patient_weight;
        $checkup->patient_height = $request->patient_height;

        $checkup->save();

        Session::flash('success' , 'Successfully Added.');
        return redirect()->route('checkup.show',$checkup->patient_id);

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
        $medicalpersonnel = MedicalPersonnel::where('medicalpersonnel_role', 'doctor')->get();
        $checklist = Checkup::where('patient_id', '=' , $id)->orderBy('CheckupID', 'desc')->get();
        return view('checkup.show')->withPatients($patient)->withChecklists($checklist)->withMedicalpersonnels($medicalpersonnel);
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

        $this->validate($request, [
            'patient_id' => 'required|max:255|numeric',
            'checkup_date' => 'required|max:255|date',
            'doctor_name' => 'required|max:255',
            'checkup_symptoms' => 'required|max:255',
            'checkup_prescription' => 'required|max:255',
            'checkup_description' => 'required|max:255',
            'patient_weight' => 'required|max:255|numeric',
            'patient_height' => 'required|max:255|numeric',
        ]);

        $checklist = Checkup::find($id);

        $checklist->checkup_date = $request->checkup_date;
        $checklist->doctor_name = $request->doctor_name;
        $checklist->checkup_symptoms = $request->checkup_symptoms;
        $checklist->checkup_prescription = $request->checkup_prescription;
        $checklist->checkup_description = $request->checkup_description;
        $checklist->patient_weight = $request->patient_weight;
        $checklist->patient_height = $request->patient_height;


        $checklist->save();

        Session::flash('success' , 'Changes Successfully saved.');
        return redirect()->route('checkup.show',$checklist->patient_id);
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
}
