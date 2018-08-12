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
            $('#btn-answer').removeAttr("disabled");
            $('#btn-reshuffle').removeAttr("disabled");
            $('#btn-im-done').removeAttr("disabled");
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

game.fireAjax = function (params, callback) {
    $.ajax(params)            
    
    .always(function(data, textStatus, jqXHR){                 
        callback(data);
    })

    .fail(function(data) {
        console.log("error", data.responseText)
    })
}

$(function () {    
    $('#collapseExample').on('shown.bs.collapse', function() {        
        $('#btn-start').hide().fadeOut("slow", function () {
            game.generateWords();
        });
        
        $('#btn-reshuffle, #btn-im-done').fadeIn("slow");        
    });
    
    $('#btn-reshuffle').on('click', function() {
        game.reshuffle();
    });
    
    $('#btn-answer').on('click', function() {
        game.checkAnswer();
    });
    
    $('#btn-next-riddles').on('click', function() {
        game.generateWords();
    });                        
});