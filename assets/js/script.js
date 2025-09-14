$(document).ready(function() {
    // Example: Highlight selected option
    $('input[type=radio]').click(function() {
        $(this).closest('.question-block').find('label').css('font-weight', 'normal');
        $(this).next('label').css('font-weight', 'bold');
    });

    // Quiz submit handled via AJAX
    $('#quizForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'result.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res){
                $('#result').html(res);
                $('html, body').animate({ scrollTop: $('#result').offset().top }, 'slow');
            }
        });
    });
});
