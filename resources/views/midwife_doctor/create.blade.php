@extends('main')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/date-picker.css') !!}

@endsection

@section('content')
	  
	<div class="container">
		<div class="row">
		<br><br>
	 		{!! Form::open(['route' => 'add.store','data-parsley-validate' => '']) !!}

				<div class="row">
				  <div class="form-group col-xs-2 col-lg-2">

				   <select class="form-control" name="medicalpersonnel_role">
						<option value="doctor">Doctor</option>
						<option value="midwife">Midwife</option>
					</select>

				  </div>
			    </div>

				<div class="row">
				  <div class="form-group col-xs-7 col-lg-3">

				    {{ Form::label('medicalpersonnel_name', "Name") }}
				    {{ Form::text('medicalpersonnel_name', null, ['class' => 'form-control', 'data-toggle'=> 'datepicker','required' => '', 'data-parsley-date','maxlength' => '10']) }}

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