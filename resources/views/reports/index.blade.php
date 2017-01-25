@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}
  {!! Html::style('css/autocomplete.css') !!}
@endsection

@section('title', 'Send a Report')

@section('content')


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
				  <div class="form-group col-xs-6 col-lg-4">
				      <div class="form-group">
				        <input class="form-control bs-autocomplete" placeholder="Search" name="input" type="text" autocomplete="off">
				          <ul class="nav nav-pills nav-stacked bs-autocomplete-menu" >
				          	
				          </ul>
				          <div id="notfound"></div>
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

	</script>
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/autocomplete.js') !!}
@endsection