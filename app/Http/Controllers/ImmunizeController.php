<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Patient;
use App\Vaccine;
use Session;
use App\MedicalPersonnel;

class ImmunizeController extends Controller
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
                'vaccination_received' => 'required|max:255|date',
                'midwife' => 'required|max:255',
                'vaccine_id' => 'required|numeric|same:expected_vaccine',
                'description' => 'required|max:255',
                'patient_weight' => 'required|max:255|numeric',
                'patient_height' => 'required|max:255|numeric',
        ]);
        $immunizationstatus = new Immunization;
        
        $immunizationstatus->p_id = $request->p_id;
        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife = $request->midwife;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->description = $request->description;
        $immunizationstatus->patient_weight = $request->patient_weight;
        $immunizationstatus->patient_height = $request->patient_height;

        $immunizationstatus->save();

        Session::flash('success' , 'Successfully Added.');
        return redirect()->route('immunization.show',$immunizationstatus->p_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::where('PatientID', '=', $id)->first();

        $medicalpersonnel = MedicalPersonnel::where('role', 'midwife')->get();

        $immunizationstatus = Immunization::join('vaccines', 'vaccines.id', '=', 'immunizations.vaccine_id')
            ->select('immunizations.*', 'vaccines.name')
            ->where('p_id','=', $id)
            ->get();

        $TookVaccine = Vaccine::whereDoesntHave('users', function($q) use($id) {
         $q->where('patients.PatientID', $id);
        })->get();

        if ($TookVaccine->isEmpty()) {
            echo 'sdfsd';
         }

        $vaccine = Vaccine::all();
        return view('immunization.show')->withPatients($patient)
        ->withImmunizationstatuses($immunizationstatus)
        ->withTookvaccines($TookVaccine)->withVaccines($vaccine)
        ->withMedicalpersonnels($medicalpersonnel);
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
            'vaccination_received' => 'required|max:255|date',
            'midwife' => 'required|max:255',
            'vaccine_id' => 'required|numeric',
            'description' => 'required|max:255',
            'patient_weight' => 'required|max:255|numeric',
            'patient_height' => 'required|max:255|numeric',
        ]);

        $immunizationstatus = Immunization::find($id);

        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife = $request->midwife;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->description = $request->description;
        $immunizationstatus->patient_weight = $request->patient_weight;
        $immunizationstatus->patient_height = $request->patient_height;


        $immunizationstatus->save();

        Session::flash('success' , 'Changes Successfully saved.');
        return redirect()->route('immunization.show',$immunizationstatus->p_id);
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
