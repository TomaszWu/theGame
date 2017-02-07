
$(function () {

//    $('#test').on('click', function (el) {
//        event.preventDefault();
//        event.stopImmediatePropagation();
//        console.log($(el.target));
//
//        $.ajax({
//            method: 'POST',
//            type: 'JSON',
//            data: {test: 'test'},
//            success: function (response) {
//                console.log((response));
//            }
//        });
//    });

    $('input.answer').on('click', function () {
        $('input.answer').not(this).prop('checked', false);
    });

    $('#confirm').on('click', function (event) {
        var answerToCheck = $('.answer:checked').val();
        console.log(answerToCheck);
        event.preventDefault();
        $.ajax({
            method: 'POST',
            type: 'JSON',
            data: {answerToCheck: answerToCheck},
            success: function (response) {
                console.log((response));
            }
        });

    });


});