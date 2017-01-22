<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Patient;
use App\Vaccine;
use Session;
use App\MedicalPersonnel;
use Carbon;
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
                'patient_id' => 'required|max:255|numeric',
                'vaccination_received' => 'required|max:255|date',
                'midwife_name' => 'required|max:255',
                'vaccine_id' => 'required|numeric|same:expected_vaccine',
                'immunization_description' => 'required|max:255',
                'patient_weight' => 'required|max:255|numeric',
                'patient_height' => 'required|max:255|numeric',
        ]);
        $immunizationstatus = new Immunization;
        
        $immunizationstatus->patient_id = $request->patient_id;
        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife_name = $request->midwife_name;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->immunization_description = $request->immunization_description;
        $immunizationstatus->patient_weight = $request->patient_weight;
        $immunizationstatus->patient_height = $request->patient_height;

        $immunizationstatus->save();

        Session::flash('success' , 'Successfully Added.');
        return redirect()->route('immunization.show',$immunizationstatus->patient_id);
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

        $medicalpersonnel = MedicalPersonnel::where('medicalpersonnel_role', 'midwife')->get();

        $immunizationstatus = Immunization::join('vaccines', 'vaccines.VaccineID', '=', 'immunizations.vaccine_id')
            ->select('immunizations.*', 'vaccines.vaccine_name')
            ->where('patient_id','=', $id)
            ->get();

        $TookVaccine = Vaccine::whereDoesntHave('users', function($q) use($id) {
         $q->where('patients.PatientID', $id);
        })->get();

        if ($TookVaccine->isEmpty()) {

            if (!$patient->p1_completion_date) {

                $patient->p1_completion_date = Carbon::now()->toDateString();
                $patient->save();

            }
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
            'patient_id' => 'required|max:255|numeric',
            'vaccination_received' => 'required|max:255|date',
            'midwife_name' => 'required|max:255',
            'vaccine_id' => 'required|numeric',
            'immunization_description' => 'required|max:255',
            'patient_weight' => 'required|max:255|numeric',
            'patient_height' => 'required|max:255|numeric',
        ]);

        $immunizationstatus = Immunization::find($id);

        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife_name = $request->midwife_name;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->immunization_description = $request->immunization_description;
        $immunizationstatus->patient_weight = $request->patient_weight;
        $immunizationstatus->patient_height = $request->patient_height;


        $immunizationstatus->save();

        Session::flash('success' , 'Changes Successfully saved.');
        return redirect()->route('immunization.show',$immunizationstatus->patient_id);
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
