@extends('public/layout')

@section('main')
<div class="h-100 row justify-content-center align-items-center">
<div id="form-signin" class="form-signin text-center">
    <form class="form-signin" method="POST" action="{{ url('auth/login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
        <input type="text" id="inputUsername" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" required autofocus>
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif

        <input type="password" id="inputPassword" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        
        <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign me in!</button>      
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>        
    </form>
</div>
</div>
@stop