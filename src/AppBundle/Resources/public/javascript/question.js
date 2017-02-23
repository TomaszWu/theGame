
$(function () {



    $('#confirm').on('click', function (el) {
        console.log($(el.target).parent());
        var answerToCheck = $('.answer:checked').val();
        event.preventDefault();
        $.ajax({
            method: 'POST',
            type: 'JSON',
            data: {answerToCheck: answerToCheck},
            success: function (response) {

                $('#playground').children().remove();
                switch (response['answer']) {
                    case 'good':
//                        alert("Poprawna odpowiedź!");
                        var correctAnswerInfo = ('<h2>Poprawna odpowiedź!</h2><h3>Wygrałeś\n\
' + response['envelopeValue'] + '. Na Twoim koncie znajduje się ' + response['currentWinnings'] + '</h3>');
                        var envelopeValue = response['envelopeValue'];
                        var currentWinnings = response['currentWinnings'];
                        var nextQuestionButton = $('<div><button id="nextQuestion">Następnie pytanie</button></div>');
                        var quiteGameButton = $('<div><button id="quiteGame">Skończ grę</button></div>');
                        $('#playground').append(correctAnswerInfo);
                        $('#playground').append(nextQuestionButton);
                        $('#playground').append(quiteGameButton);
                        $(document).on('click', '#nextQuestion', function (el) {
                            window.location.href = '/player/chooseTheEnvelope';
                        })
                        break;
                    case 'wrong':
                        console.log('nie');
                        break;
                }
                
            }
        });

    });


});