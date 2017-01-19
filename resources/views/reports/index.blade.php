@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}

@endsection

@section('title', 'Send a Report')

@section('content')



<div class="row">

	  
	<div class="container">
		<div class="row">
		<br><br>
	 		{!! Form::open(['route' => 'report.pdf','data-parsley-validate' => '']) !!}

				<div class="row">
				  <div class="form-group col-xs-2 col-lg-2">

				   <select class="form-control" name="filter">
						<option value="patient_address">By Address</option>
					</select>

				  </div>
			    </div>

				<div class="row">
				  <div class="form-group col-xs-5 col-lg-6">

				    {{ Form::label('input', "Name") }}
				    {{ Form::text('input', null, ['class' => 'form-control','required' => '']) }}

				  </div>
			    </div>
			    
			    {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection