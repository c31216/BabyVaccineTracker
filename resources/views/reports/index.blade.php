@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}
  {!! Html::style('css/autocomplete.css') !!}
@endsection

@section('title', 'Send a Report')

@section('content')
@if(Session::has('success'))

	<div class="alert alert-success" role="alert">
		<strong>Success: {{ Session::get('success') }}</strong>
	</div>


@endif

	<div class="container">
		<div class="row">
		<br><br>
	 		{!! Form::open(['route' => 'report.pdf','data-parsley-validate' => '','target' => '_blank']) !!}

				<div class="row">
				  <div class="form-group col-xs-2 col-lg-2">

				   	<select class="form-control" name="filter">
						<option value="patient_address">By Address</option>
						<option value="month">By Month</option>
						<option value="vaccine_id">By Vaccine</option>
					</select>

				  </div>
			    </div>

				<div class="row">
				  <div class="form-group col-xs-6 col-lg-3">
				      <div class="form-group" id="type">
				        
				      </div>
				  </div>
			    </div>
			    
			    {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('scripts')
	<script>

		var token = '{{ Session::token() }}';
		var csrf = '{{ csrf_field() }}';
		var autocompleteurl = '{{ route('posts.autocomplete') }}';
		var getvaccines = '{{ route('get.vaccines') }}';

	</script>
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/autocomplete.js') !!}
	{!! Html::script('js/report.js') !!}
@endsection