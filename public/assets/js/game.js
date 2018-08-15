"use strict";

var game = {};

game.generateWords = function() {
    var params = {
        url: '/get_words',
        method: "GET",
        dataType: "json"
    }

    game.fireAjax(params, function (data) {
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
            $('#btn-answer, #btn-reshuffle, #btn-im-done, #btn-refresh-game').removeAttr("disabled");            
            $('#btn-next-riddles').fadeOut('slow');
        }
    });
}

game.reshuffle = function() {
    var params = {
        url: '/reshuffle',
        method: "GET",
        dataType: "json"
    }

    this.fireAjax(params, function (data) {
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

game.checkAnswer = function() {
    var params = {
        url: '/check_answer',
        method: "GET",
        data: { 'guess_word': $('#answerbox').val() },
        dataType: "json"
    }

    this.fireAjax(params, function (data) {        
        var response = data;
        
        game.generateAlerts(response);
    });    
}

game.generateAlerts = function (response) {
    var curr_alert_cls;
    var div_alert = '';

    $.each(response.message, function (k, v) {
        if (v.match(/Correct|Level/g)) {
            curr_alert_cls = 'alert-success';
            $('#btn-answer, #btn-reshuffle').attr("disabled", "disabled");            
            $('#btn-next-riddles').fadeIn('slow');

        } else if (response.status.match(/ERROR/) || v.match(/Incorrect/)) {
            curr_alert_cls = 'alert-danger';
        }

        div_alert += '<div class="alert '+ curr_alert_cls +' alert-dismissible" style="margin-top: 1em; display: none" role="alert"> \
        <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>' + v +' \
        </div>';
    });            
    
    $('#game-alert').html(div_alert);

    $('#game-alert .alert').fadeIn('slow', function () {
        window.setTimeout(function() {
            $('#game-alert .alert').fadeOut('slow');
        }, 4000);
    });
}

game.refreshGame = function () {
    var params = {
        url: '/refresh_game',
        method: "GET",        
        dataType: "json"
    }

    this.fireAjax(params, function (data) {        
        var response = data;        
        game.generateAlerts(response);
    });

    $('#collapseExample').trigger('shown.bs.collapse');    
}

game.fireAjax = function (params, responseCallback) {
    $.ajax(params)
    .promise()
    .then(responseCallback, function (data, textStatus, err) {
        console.log(textStatus + ' : ' + err);        
    });        
}

$(function () {    
    $('#collapseExample').on('shown.bs.collapse', function() {        
        $('#btn-start').hide().fadeOut("slow", function () {
            game.generateWords();
        });
        
        $('#btn-reshuffle, #btn-im-done, #btn-refresh-game').fadeIn("slow");        
    });
    
    $('#btn-reshuffle').on('click', function() {
        game.reshuffle();
    });

    $('#btn-refresh-game').on('click', function() {
        game.refreshGame();
    });
    
    $('#btn-answer').on('click', function() {
        game.checkAnswer();
    });
    
    $('#btn-next-riddles').on('click', function() {
        game.generateWords();
    });                        
});