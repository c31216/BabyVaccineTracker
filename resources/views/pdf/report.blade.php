@foreach($patients as $patient)

	Full Name: {{$patient->patient_lname}}, {{$patient->patient_fname}}, Weight: {{$patient->patient_weight}}, Height: {{$patient->patient_height}}, Mother Name: {{$patient->patient_mother_name}}, Sex: {{$patient->patient_sex}} <br>
	
@endforeach