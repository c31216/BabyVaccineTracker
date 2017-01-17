@extends('main')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/date-picker.css') !!}

@endsection

@section('content')
	    <div class="row">	
	    
	    	<div class="col-md-6">
	    	<h1>Edit Record</h1>

	    		{!! Form::model($patient, ['route' => ['posts.update', $patient->PatientID ], 'method'=> 'PUT']) !!}

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('patient_uname', "Username:") }}
				    {{ Form:: text('patient_uname', $patient->patient_uname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

				  </div>
			    </div>

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-7 ">

				    {{ Form::label('patient_pass', "Password:") }}
				    {{ Form::text('patient_pass', $patient->patient_pass, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('patient_fname', "First Name:") }}
				    {{ Form::text('patient_fname', $patient->patient_fname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('patient_lname', "Last Name:") }}
				    {{ Form::text('patient_lname', $patient->patient_lname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    <label for="patient_bdate">Date Of Birth</label>
				    {{ Form::date('patient_bdate', $patient->patient_bdate, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','id' => 'dateofbirth']) }}

				  </div>
			    </div>
			    	{{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}
			    	<a href="{{ route('posts.index') }}"> Cancel</a>

			{!! Form::close() !!}

	    	</div>
	    </div>
@endsection


@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection