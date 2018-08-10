@extends('layouts.app')

@section('content')
<div class="h-100 row justify-content-center align-items-center">
    <div id="form-signin" class="form-signin w-100 text-center">
        <form class="form-signin" role="form" method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
            <input type="text" id="inputUsername" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username" required autofocus>            
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert" style="margin: 1em 0;">
                    <strong>Email: {{ $errors->first('email') }}</strong>
                </span>
            @endif            
            <input type="password" id="inputPassword" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>                    
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert" style="margin: 1em 0;">
                    <strong>Password: {{ $errors->first('password') }}</strong>
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
    
    <div class="w-100 text-center">
        
    </div>    
</div>
@stop