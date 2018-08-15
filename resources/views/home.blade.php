@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Gameboard</div>

                <div class="card-body">                    
                    <div class="collapse" id="collapseExample">
                        <table id="wordstbl" class="table table-bordered" style="display: none">
                            <tbody></tbody>
                        </table> 
                        <form id="scramble-form" class="text-center" style="margin: 4em 0;">                            
                            <div class="input-group input-group-lg justify-content-center">
                                <input id="answerbox" type="text" class="form-control text-center col-5" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="Answer..." autofocus>
                            </div>
                            <div class="my-4 col-sm-12">
                                <button id="btn-answer" type="button" class="btn btn-primary btn-lg" disabled>Submit</button>                                
                            </div>
                            <div class="my-4 col-sm-12">
                                <button id="btn-next-riddles" type="button" class="btn btn-success btn-lg" style="display:none">Next</button>
                            </div>
                            <div id="game-alert" class="my-4"></div>
                        </form>
                    </div><br>                    
                    <button id="btn-start" type="button" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Start</button>
                    <a id="btn-im-done" href="{{ url('/') }}" type="button" class="btn btn-danger btn-lg mx-1 float-left" style="display:none" disabled>I'm done</a>
                    <button id="btn-reshuffle" type="button" class="btn btn-primary btn-lg mx-1 float-left" role="button" style="display:none" disabled>Re-shuffle</button>                    
                    <button id="btn-refresh-game" type="button" class="btn btn-dark btn-lg mx-1 float-left" role="button" style="display:none" disabled>Refresh The Game</button>
                </div>
            </div>
            @if (Auth::check())
                <div class="alert alert-success alert-dismissible" style="margin-top: 1em" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    You are logged in!
                </div>
            @else
                <div class="alert alert-success alert-dismissible" style="margin-top: 1em">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    Welcome Guest,
                </div>
            @endif
        </div>
    </div>
</div>
@endsection