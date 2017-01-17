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
                'p_id' => 'required|max:255|numeric',
                'checkup_date' => 'required|max:255|date',
                'doctor' => 'required|max:255',
                'symptoms' => 'required|max:255',
                'prescription' => 'required|max:255',
                'description' => 'required|max:255',
                'patient_weight' => 'required|max:255|numeric',
                'patient_height' => 'required|max:255|numeric',
        ]);
        $checkup = new Checkup;

        $checkup->p_id = $request->p_id;
        $checkup->checkup_date = $request->checkup_date;
        $checkup->doctor = $request->doctor;
        $checkup->symptoms = $request->symptoms;
        $checkup->prescription = $request->prescription;
        $checkup->description = $request->description;
        $checkup->patient_weight = $request->patient_weight;
        $checkup->patient_height = $request->patient_height;

        $checkup->save();

        Session::flash('success' , 'Successfully Added.');
        return redirect()->route('checkup.show',$checkup->p_id);

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
        $medicalpersonnel = MedicalPersonnel::where('role', 'doctor')->get();
        $checklist = Checkup::where('p_id', '=' , $id)->orderBy('id', 'desc')->get();
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
            'p_id' => 'required|max:255|numeric',
            'checkup_date' => 'required|max:255|date',
            'doctor' => 'required|max:255',
            'symptoms' => 'required|max:255',
            'prescription' => 'required|max:255',
            'description' => 'required|max:255',
            'patient_weight' => 'required|max:255|numeric',
            'patient_height' => 'required|max:255|numeric',
        ]);

        $checklist = Checkup::find($id);

        $checklist->checkup_date = $request->checkup_date;
        $checklist->doctor = $request->doctor;
        $checklist->symptoms = $request->symptoms;
        $checklist->prescription = $request->prescription;
        $checklist->description = $request->description;
        $checklist->patient_weight = $request->patient_weight;
        $checklist->patient_height = $request->patient_height;


        $checklist->save();

        Session::flash('success' , 'Changes Successfully saved.');
        return redirect()->route('checkup.show',$checklist->p_id);
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
