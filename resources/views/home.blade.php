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
<script>
    $('#collapseExample').on('shown.bs.collapse', function() {        
        $('#btn-start').hide().fadeOut("slow", function () {
            generateWords();
        });
        
        $('#btn-reshuffle, #btn-im-done').fadeIn("slow");        
    });

    $('#btn-reshuffle').on('click', function() {
        reshuffle();
    });

    $('#btn-answer').on('click', function() {
        checkAnswer();
    });

    $('#btn-next-riddles').on('click', function() {
        generateWords();
    });

    function generateWords() {
        var params = {
            url: "{{ url('get_words') }}",
            method: "GET",
            data: { id: null },
            dataType: "json"
        }

        var jqxhr = $.ajax(params);

        jqxhr.done(function(data, textStatus, jqXHR) {
            // console.log("done", data.responseText)
        })
        jqxhr.fail(function(data) {
            console.log("error", data.responseText)
        })
        jqxhr.always(function(data, textStatus, jqXHR) {
            if (data.words.length > 0) {
                var newstr = '<tr>';
                $.each(data.words, function (k, v) {
                    newstr += '<td class="text-center text-uppercase font-weight-bold">' + v + '</td>';
                });
                newstr += '</tr>';

                $('#wordstbl').fadeOut('slow', function () {
                    $('#wordstbl tbody').html(newstr);
                    $('#wordstbl').fadeIn('slow');
                });

                $('#answerbox').val('');
                $('#btn-answer').removeAttr("disabled");
                $('#btn-reshuffle').removeAttr("disabled");
                $('#btn-im-done').removeAttr("disabled");
                $('#btn-next-riddles').fadeOut('slow');
            }
        });
    }

    function reshuffle() {
        var params = {
            url: "{{ url('reshuffle') }}",
            method: "GET",
            dataType: "json"
        }

        var jqxhr = $.ajax(params);

        jqxhr.done(function(data, textStatus, jqXHR) {
            // console.log("done", data.responseText)
        })
        jqxhr.fail(function(data) {
            console.log("error", data.responseText)
        })
        jqxhr.always(function(data, textStatus, jqXHR) {            
            if (data.words.length > 0 && data.words[0].length > 0) {
                var newstr = '<tr>';
                $.each(data.words, function (k, v) {
                    newstr += '<td class="text-center text-uppercase font-weight-bold">' + v + '</td>';
                });
                newstr += '</tr>';

                $('#wordstbl').fadeOut('slow', function () {
                    $('#wordstbl tbody').html(newstr);
                    $('#wordstbl').fadeIn('slow');
                });
            } else {
                return false;
            }
        });
    }

    function checkAnswer() {
        var params = {
            url: "{{ url('check_answer') }}",
            method: "GET",
            data: { 'guess_word': $('#answerbox').val() },
            dataType: "json"
        }

        var jqxhr = $.ajax(params);

        jqxhr.done(function(data, textStatus, jqXHR) {
            // console.log("done", data.responseText)
        })
        jqxhr.fail(function(data) {
            console.log("error", data.responseText)
        })
        jqxhr.always(function(data, textStatus, jqXHR) {
            var response = data;

            if (response.message) {
                var curr_alert_cls;
                if (response.message.match(/Correct|Level/g)) {
                    curr_alert_cls = 'alert-success';
                    $('#btn-answer').attr("disabled", "disabled");
                    $('#btn-reshuffle').attr("disabled", "disabled");
                    $('#btn-next-riddles').fadeIn('slow');

                } else if (response.message.match(/Incorrect/)) {
                    curr_alert_cls = 'alert-danger';
                }
                
                $('#game-alert').html(
                                    '<div class="alert '+ curr_alert_cls +' alert-dismissible" style="margin-top: 1em; display: none" role="alert"> \
                                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> Your answer is ' + response.message +' \
                                    </div>');

                $('#game-alert .alert').fadeIn('slow', function () {
                    window.setTimeout(function() {
                        $('#game-alert .alert').fadeOut('slow');
                    }, 4000);
                });
            }            
        });        
    }    
</script>
@endsection