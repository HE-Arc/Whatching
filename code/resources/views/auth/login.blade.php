@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">




        <div class="col-md-8 col-md-offset-2" style="margin-top:20vh">
          <div class="panel panel-default">
      <div class="panel-body">
          <blockquote>
            <h1>Login on Whatching</h1>
            <footer>Or join the night's watch you fool !</footer>
          </blockquote>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

                        {{ csrf_field() }}
                        <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-10 col-md-offset-1">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>



                        <div class="form-group text-right col-md-offset-1 col-md-11">
                                      <div class="checkbox" style="display:inline;margin-right:10px;">
                                          <label>
                                              <input type="checkbox" name="remember"> Remember Me
                                          </label>
                                      </div>

                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-danger" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
