@include('partials._head')
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.check') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('patient_uname') ? ' has-error' : '' }}">
                            <label for="patient_uname" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="patient_uname" type="text" class="form-control" name="patient_uname" value="{{ old('patient_uname') }}" required autofocus>

                                @if ($errors->has('patient_uname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('patient_uname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('patient_pass') ? ' has-error' : '' }}">
                            <label for="patient_pass" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="patient_pass" type="password" class="form-control" name="patient_pass" required>

                                @if ($errors->has('patient_pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('patient_pass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                     {{--    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


