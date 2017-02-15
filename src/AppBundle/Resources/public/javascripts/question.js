
$(function () {

    var startTheGameBtn = $('<button>').val('start');
    

    $('#confirm').on('click', function (el) {
        console.log($(el.target).parent());
        var answerToCheck = $('.answer:checked').val();
        event.preventDefault();
        $.ajax({
            method: 'POST',
            type: 'JSON',
            data: {answerToCheck: answerToCheck},
            success: function (response) {
//                console.log((response['false']));
                switch (response['answer']) {
                    case 'good':
                        var envelopeValue = response['envelopeValue'];
                        var currentWinnings = response['currentWinnings'];
                        $('#playground').children().remove();
                        var winningDiv = $('<div>');
                        
                        
                        
                        break;
                    case 'wrong':
                        console.log('nie');
                        break;
                }
            }
        });

    });


});