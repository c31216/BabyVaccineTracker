@include('partials._head')

<nav class="navbar navbar-default">
    <div class="container-fluid custom-container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>

        </button>
      </div>
      <div class="collapse navbar-collapse custom-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

            <li class="logo-container">
              <div class="col-xs-4">
                <img src="/img/vaccine-logo-whiteborder.png">
              </div>
              <div class="col-xs-8">
                <p class="title"><span>Baby Vaccine Tracker</span><br>your baby's health companion</p>
              </div>
            </li>

            <li>
              <a href="{{ route('user.index') }}">
                <div class="row nav-icon">
                  <img src="/img/document-icon.png">
                </div>
                <div class="row">
                  Personal Record
                </div>
              </a>
            </li>

            <li>
              <a href="{{ route('user.settings', Session::get('PatientID')) }}">
                <div class="row nav-icon">
                  <img src="/img/document-icon.png">
                </div>
                <div class="row">
                  Settings
                </div>
              </a>
            </li>

        </ul>

        <div class="col-md-3 active-user">
          <img src="/img/user-icon.png">
          <h1>Welcome, {{$patient->patient_fname}}
          <a href="{{ route('user.logout') }}" 
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                Logout
                </a>

                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
          </h1>
        </div>
      </div>
    </div><!--end of container-fluid-->
</nav>

@if(Session::has('success'))

  <div class="alert alert-success" role="alert">
    <strong>Success: {{ Session::get('success') }}</strong>
  </div>


@endif

<div class="container">

{!! Form::model($patient, ['route' => ['usersettings.update', $patient->PatientID ], 'method'=> 'PUT']) !!}

  <div class="row">
    <div class="form-group col-xs-5 col-lg-7 {{ $errors->has('patient_uname') ? ' has-error' : '' }}">

      {{ Form::label('patient_uname', "Username:") }}
      {{ Form:: text('patient_uname', $patient->patient_uname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}
      @if ($errors->has('patient_uname'))
        <span class="help-block">
            <strong>{{ $errors->first('patient_uname') }}</strong>
        </span>
      @endif

    </div>
    <div class="form-group col-xs-5 col-lg-7 {{ $errors->has('patient_old_pass') ? ' has-error' : '' }}">

      {{ Form::label('patient_old_pass', "Old Password:") }}
      {{ Form:: password('patient_old_pass', ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

      @if ($errors->has('patient_old_pass'))
        <span class="help-block">
            <strong>{{ $errors->first('patient_old_pass') }}</strong>
        </span>
      @endif

    </div>
     <div class="form-group col-xs-5 col-lg-7 {{ $errors->has('patient_pass') ? ' has-error' : '' }}">

      {{ Form::label('patient_pass', "New Password:") }}
      {{ Form:: password('patient_pass', ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}
      
      @if ($errors->has('patient_pass'))
          <span class="help-block">
              <strong>{{ $errors->first('patient_pass') }}</strong>
          </span>
      @endif

    </div>
     <div class="form-group col-xs-5 col-lg-7 {{ $errors->has('patient_pass_confirmation') ? ' has-error' : '' }}">

      {{ Form::label('patient_pass_confirmation', "Confirm Password:") }}
      {{ Form:: password('patient_pass_confirmation', ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

        @if ($errors->has('patient_pass_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('patient_pass_confirmation') }}</strong>
            </span>
        @endif

    </div>

  </div>

  {{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}

{!! Form::close() !!}
</div>