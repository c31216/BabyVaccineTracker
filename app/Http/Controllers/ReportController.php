<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use PDF;
use Session;
use Carbon\Carbon;
use App\Vaccine;
use App\Immunization;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf(Request $request){

    $reportby = "";

    if ($request->vaccines) {
        $vaccine_id = $request->vaccines;
        $patient = Patient::whereHas('users', function($q) use($vaccine_id){
            $q->where('vaccine_id', '=', $vaccine_id);
        })->get();
        $vaccine = Vaccine::where('VaccineID', '=', $vaccine_id)->first();
        $reportby = "Vaccine: " . $vaccine->vaccine_name; 

    }else if($request->month){
        $month = $request->month;
        $monthname = date("F",mktime(0,0,0,$month,1,2011));
        $patient = Immunization::join('patients', 'patients.PatientID', '=', 'immunizations.patient_id')
            ->select('patients.*')
            ->whereMonth('vaccination_received', '=', $month)
            ->get();

        $reportby = "Month: " . $monthname ;
    }else{
        $patient = Patient::where($request->filter , '=' , $request->input)->get();
        $reportby = "Location";
    }
     
    if ($patient->isEmpty()) {

         Session::flash('failed', 'Record Not Found');
         return redirect()->route('report.index');

    }else{

        $pdf = PDF::loadView('pdf.report',['patients' => $patient,'reportby' => $reportby]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('ImmunizationRecord.pdf');

     }
    


    }

    public function getvaccines(){
        $vaccines = Vaccine::all();
        $output = "";

        foreach ($vaccines as $vaccine) {

           $output .= '<option value="'.$vaccine->VaccineID.'">'.$vaccine->vaccine_name.'</option>';

        }

        echo $output;
    }
}
