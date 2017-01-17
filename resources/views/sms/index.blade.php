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

		<div class="col-md-4">
			<br>
			<h4>Babies who has not yet taken: </h4>
			<br>
			
			<div class="form-group col-xs-9 col-lg-9">
				<select class="form-control" name="vaccine_id" selected="selected">
					<option value="">Select A Vaccine</option>
				   	@foreach ($vaccines as $vaccine)
						<option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
					@endforeach
				</select>	
				<br>
				
				<div id="messagebox">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Write a Message</button>

					<div class="modal fade" id="myModal" role="dialog">
					    <div class="modal-dialog modal-md">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Write a Message</h4>
					        </div>
					        <div class="modal-body">
					          <p>To:</p>
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

		<div class="col-md-6">

		</div>
	</div>
		
</div>	
@endsection


@section('scripts')

	<script>
	    var token = '{{ Session::token() }}';
	    var csrf = '{{ csrf_field() }}';
	    var user_filter = "{{route('sms.filter')}}";
	</script>

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/sms.js') !!}

@endsection
