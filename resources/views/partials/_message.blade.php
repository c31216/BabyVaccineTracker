@if(Session::has('success'))

	<div class="alert alert-success" role="alert">
		<strong>Success: {{ Session::get('success') }}</strong>
	</div>
@elseif(Session::has('failed'))
	<div class="alert alert-danger" role="alert">
		<strong>Failed: {{ Session::get('failed') }}</strong>
	</div>

@endif

@if (count($errors)>0)
	
	<div class="alert alert-danger" role="alert">
		<strong>Errors: </strong>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>

@endif