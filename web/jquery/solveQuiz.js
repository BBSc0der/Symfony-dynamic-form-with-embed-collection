$(document).ready(function () {
    $("input[type='radio']").change(function () {
        var id = $(this).attr('id');
        var questionId = id.split('_')[4];
            var answerId = id.split('_')[6];
            $('[id^=solve_quiz_form_questions_'+questionId+'_answers_][type="radio"]').each(function(){
               var curAnsId = $(this).attr('id').split('_')[6];
               if(curAnsId != answerId){
                   $(this).prop('checked', false);
               }
            });
            
    });
});