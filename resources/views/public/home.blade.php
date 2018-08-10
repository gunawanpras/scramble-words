@extends('layouts.app')

@section('content')
<div class="h-100 row justify-content-center align-items-center">
    <div class="card text-center w-50">
        <div class="card-body">
            <h3 class="card-title">Home</h3>
            <p class="card-text">Level 1</p>            
            <a class="btn btn-success" href="{{ url('home') }}" role="button">Answer</a>        
        </div>
    </div>
</div>
@stop