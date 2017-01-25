@extends('main')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('dist/datepicker.css') !!}

@endsection

@section('content')

<style>
	#messagebox{
		display: none;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<br>
			<h4>Babies who has not yet taken: </h4>
			<br>
			
			<div class="form-group col-xs-4 col-md-6 col-lg-6">
				<select class="form-control" name="vaccine_id" selected="selected">
					<option value="">Select A Vaccine</option>
				   	@foreach ($vaccines as $vaccine)
						<option value="{{ $vaccine->VaccineID }}">{{ $vaccine->vaccine_name }}</option>
					@endforeach
				</select>	
				<br>
				
				<div id="messagebox">
					<button type="button" id="write_message" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Write a Message</button>

					<div class="modal fade" id="myModal" role="dialog">
					    <div class="modal-dialog modal-md">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Write a Message</h4>
					        </div>
					        <div class="modal-body">

								<h4>Send To: </h4><span id="phone_numbers"></span><br><br>

								{!! Form::open(['route' => 'sms.send','data-parsley-validate' => '']) !!}

								{{ Form::textarea('message') }}<br>
								{{ Form::hidden('patient_numbers', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
								{{ Form::submit('Send Message', ['class' => 'btn btn-success']) }}
								{!! Form::close() !!}
								
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        </div>
					      </div>
					    </div>
					</div>
				</div>

				<br>
				<div id="user_filter">

				</div>
			</div>
		</div>
	</div><!--end of row-->
		
</div><!--end of container-->
@endsection


@section('scripts')

	<script>
	    var token = '{{ Session::token() }}';
	    var csrf = '{{ csrf_field() }}';
	    var user_filter = "{{route('sms.filter')}}";
	    var getPatientID = "{{route('get.patientid')}}";
	</script>

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/sms.js') !!}

@endsection
