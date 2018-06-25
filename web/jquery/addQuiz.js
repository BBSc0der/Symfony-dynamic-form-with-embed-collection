$(document).ready(function () {

    $("#quiz_form_numberOfAnswers").change(function () {
        var number = $(this).val();
        $('.answers').each(function (index) {
            $(this).empty();
            for (i = 0; i < number; i++) {
                $(this).append(generateAnswer(index, i));
            }
        });
    });
    $("#quiz_form_numberOfQuestions").change(function () {
        var number = $(this).val();
        var answers = $("#quiz_form_numberOfAnswers").val();

        $('.questions').empty();
        for (i = 0; i < number; i++) {
            $('.questions').append(generateQuestion(i, answers));
        }
    });
    $(".questions").on("change", "input[type='checkbox']", function (event) {
        if (!$("#quiz_form_multipleChoice").is(":checked")) {

            var answNum = $("#quiz_form_numberOfAnswers").val();
            var id = $(this).attr('id');
            var questionId = id.split('_')[3];
            var answerId = id.split('_')[5];
            for (i = 0; i < answNum; i++) {
                if (i != answerId) {
                    var checkbox = $("#quiz_form_questions_" + questionId + "_answers_" + i + "_correct");
                    if (checkbox.is(":checked")) {
                        checkbox.prop('checked', false);
                    }
                }
            }
        }
    });


    function generateAnswer(question, answer) {
        return "<div class='answer'>" +
                "<label for='quiz_form_questions_" + question + "_answers_" + answer + "_content' class='required'>Odpowiedź: </label>" +
                "<input type='text' id='quiz_form_questions_" + question + "_answers_" + answer + "_content' name='quiz_form[questions][" + question + "][answers][" + answer + "][content]' required='required' class='answer_content'>" +
                "<input type='checkbox' id='quiz_form_questions_" + question + "_answers_" + answer + "_correct' name='quiz_form[questions][" + question + "][answers][" + answer + "][correct]' value='1'>" +
                "</div>";
    }
    function generateQuestion(question, nOfAnswers) {

        var answers = "";
        for (j = 0; j < nOfAnswers; j++) {
            answers += generateAnswer(question, j);
        }
        return "<div class='question'>" +
                (question + 1) + " " +
                "<label for='quiz_form_questions_" + question + "_content' class='required'>Treść pytania: </label>" +
                "<input type='text' id='quiz_form_questions_" + question + "_content' name='quiz_form[questions][" + question + "][content]' required='required' class='question_content'>" +
                "<div class='answers'>" +
                answers +
                "</div>" +
                "</div>";
    }
    $("input[type='checkbox']").change(function () {
        var id = $(this).attr('id');
        var multiple = $('#edit_quiz_form_multipleChoice').prop('checked');
        if (id != 'edit_quiz_form_multipleChoice' && !multiple) {
            var questionId = id.split('_')[4];
            var answerId = id.split('_')[6];
            $('[id^=edit_quiz_form_questions_' + questionId + '_answers_][type="checkbox"]').each(function () {
                var curAnsId = $(this).attr('id').split('_')[6];
                if (curAnsId != answerId) {
                    $(this).prop('checked', false);
                }
            });
        }


    });
});