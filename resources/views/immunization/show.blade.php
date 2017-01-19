
	@section('title', 'Immunization')
	@extends('main')

	@section('stylesheets')

		{!! Html::style('css/parsley.css') !!}
		{!! Html::style('dist/datepicker.css') !!}



	@endsection

	@section('content')
	<style>
		.empty{
			color: #B94A48;
			background-color: #F2DEDE;
			border: 1px solid #EED3D7;
		}
		.custom_success{
			color: #468847;
			background-color: #DFF0D8;
			border: 1px solid #D6E9C6;
		}
	</style>
	<div class="container">
		<h1 class="title-page">{{$patients->patient_lname.', '.$patients->patient_fname}}</h1>
		<!-- Trigger the modal with a button -->
		<br>

		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">Add</button>
		
		<div id="add" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add</h4>
		      </div>
		      <div class="modal-body">
		        {!! Form::open(['route' => 'immunization.store','data-parsley-validate' => '']) !!}

					<div class="row">
					  <div class="form-group col-xs-5 col-lg-6">

					    {{ Form::label('vaccination_received', "Date") }}
					    {{ Form::date('vaccination_received', null, ['class' => 'form-control', 'data-toggle'=> 'datepicker','required' => '', 'data-parsley-date','maxlength' => '10']) }}

					  </div>
				    </div>

				    <div class="row">
					  <div class="form-group col-xs-5 col-lg-6">

					    {{ Form::label('immunization_description', "Description") }}
					    {{ Form::text('immunization_description', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

					  </div>
				    </div>

				    <div class="row">
					  <div class="form-group col-xs-5 col-lg-3">

					    {{ Form::label('patient_weight', "Weight") }}
					    {{ Form::number('patient_weight', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','data-parsley-type' => 'number']) }}
					  </div>
					  <div class="form-group col-xs-5 col-lg-3">

					    {{ Form::label('patient_height', "Height") }}
					    {{ Form::number('patient_height', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','data-parsley-type' => 'number']) }}
					  </div>
				    </div>

				    <div class="row">
					  <div class="form-group col-xs-5 col-lg-6">
						<label for="">Midwife</label>
					    <select class="form-control" name="midwife_name">
		
						   	@foreach ($medicalpersonnels as $medicalpersonnel)
								<option value="{{ $medicalpersonnel->medicalpersonnel_name }}">{{ $medicalpersonnel->medicalpersonnel_name }}</option>
							@endforeach

						</select>
					    {{ Form::hidden('patient_id', $patients->PatientID) }}

					  </div>
				    </div>
				    

				    <div class="row" id="vaccines">
				    	<div class="form-group col-xs-5 col-lg-6">
				    		@if(!$tookvaccines->isEmpty())
				    			<label for="">Vaccine</label>
								<select class="form-control" id="a" name="vaccine_id">
			
								   	@foreach ($tookvaccines as $tookvaccine)
										<option value="{{ $tookvaccine->VaccineID }}">{{ $tookvaccine->vaccine_name }}</option>
									@endforeach

									{{ Form::hidden('expected_vaccine', null) }}
								{{-- 	@if($tookvaccines)
									<option value="{{ $tookvaccines->id }}">{{ $tookvaccines->name }}</option>
									@else
									<option value="empty">All Vaccines Has Been Taken Already</option>
									@endif --}}
								</select>
								@else
									<p>This child has already taken all the vaccines.</p>
							@endif
						</div>
				    </div>
				    <ul class="parsley-errors-list filled">
				    	<li id="empty_msg"></li>
				    </ul>
				    <br>

				    {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
				{!! Form::close() !!}
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		
		  </div>
		</div>
	      

	<hr>
	<div class="row">
	    <div class="table-responsive">
	        <table class="table table-hover">

		      <thead>
		        <tr>
		          <th>Check-Up Date</th>
		          <th>Doctor</th>
		          <th>Vaccine Taken</th>
		          <th>Description</th>
		          <th>Weight</th>
		          <th>Height</th>
		        </tr>
		      </thead>

		      <tbody>

				@foreach($immunizationstatuses as $immunizationstatus)

		          <tr>
		            <td><p>{{$immunizationstatus->vaccination_received}}</p></td>
		            <td><p>{{$immunizationstatus->midwife_name}}</p></td>
		            <td><p>{{$immunizationstatus->vaccine_name}}</p></td>
		            <td><p>{{$immunizationstatus->immunization_description}}</p></td>
		            <td><p>{{$immunizationstatus->patient_weight}}</p></td>
		            <td><p>{{$immunizationstatus->patient_height}}</p></td>
		            {{-- <td><button type="button" class="btn btn-success" id="edit" data-id="{{$immunizationstatus->id}}" data-toggle="modal" data-target="#edit_{{$immunizationstatus->id}}">Edit</button></td>
	 --}}
		           </tr>


		           <!-- Edit Modal -->
					<div id="edit_{{$immunizationstatus->ImmunizationID}}" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Edit</h4>
					      </div>
					      <div class="modal-body">
					        {!! Form::model($immunizationstatus, ['route' => ['immunization.update', $immunizationstatus->ImmunizationID ], 'method'=> 'PUT']) !!}

					        	<div class="row">
								  <div class="form-group col-xs-5 col-lg-6">

								    {{ Form::label('vaccination_received', "Vaccination Received") }}
								    {{ Form::date('vaccination_received', $immunizationstatus->vaccination_received, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

								  </div>
							    </div>

							    <div class="row">
								  <div class="form-group col-xs-5 col-lg-6">

								    {{ Form::label('midwife', "Midwife") }}
								    {{ Form::text('midwife', $immunizationstatus->midwife_name, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

								  </div>
							    </div>

							    <div class="row">
							    	<div class="form-group col-xs-5 col-lg-6">
							    		<label for="">Vaccine</label>
										<select class="form-control" name="vaccine_id">
										  	@foreach ($vaccines as $vaccine)
												<option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
											@endforeach
										</select>
									</div>
							    </div>

							    <div class="row">
								  <div class="form-group col-xs-5 col-lg-6">

								    {{ Form::label('description', "Description") }}
								    {{ Form::text('description', $immunizationstatus->immunization_description, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

								  </div>
							    </div>

							    <div class="row">
								  <div class="form-group col-xs-5 col-lg-3">

								    {{ Form::label('patient_weight', "Weight") }}
								    {{ Form::number('patient_weight', $immunizationstatus->patient_weight, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
								    {{ Form::hidden('patient_id', $immunizationstatus->patient_id) }}

								  </div>
								  <div class="form-group col-xs-5 col-lg-3">

								    {{ Form::label('patient_height', "Height") }}
								    {{ Form::text('patient_height', $immunizationstatus->patient_height, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

								  </div>
							    </div>

								{{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}

							{!! Form::close() !!}
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- END Modal -->

				@endforeach

		      </tbody>
		    </table>
		</div>
	  </div>
	</div>	
	@endsection


	@section('scripts')
		<script>
		    var token = '{{ Session::token() }}';
		    var url = '{{ route('posts.search') }}';
		    var add = '{{ route('posts.store') }}'
		    var index = "{{route('posts.index')}}";
		    var csrf = '{{ csrf_field() }}';
		</script>
		{!! Html::script('js/parsley.min.js') !!}
	    {!! Html::script('dist/datepicker.js') !!}
	    {!! Html::script('js/checkup.js') !!}
	    {!! Html::script('js/immunize.validation.js') !!}

	@endsection
