@extends('layouts.app')

@section('content')
<div class="h-100 row justify-content-center align-items-center">
    <div class="card text-center w-50">
        <div class="card-body">
            <h3 class="card-title">Welcome Scramblers!</h3>
            <p class="card-text">The most addictive words scrambler game ever!</p>
            <a class="btn btn-primary" href="{{ route('login') }}" role="button">Login</a>&nbsp;
            <a class="btn btn-success" href="{{ url('home') }}" role="button">Just Play!</a>        
        </div>
    </div>
</div>
@endsection