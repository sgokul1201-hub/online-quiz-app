<?php
include '../db.php';
$questions = $conn->query("SELECT * FROM questions ORDER BY RAND()");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Quiz</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Take Quiz</h2>
        <form id="quizForm">
            <?php $i=1; while($row = $questions->fetch_assoc()){ ?>
                <div class="question-block">
                    <p><b><?= $i ?>. <?= $row['question'] ?></b></p>
                    <input type="radio" name="q<?= $row['id'] ?>" value="option1"> <?= $row['option1'] ?><br>
                    <input type="radio" name="q<?= $row['id'] ?>" value="option2"> <?= $row['option2'] ?><br>
                    <input type="radio" name="q<?= $row['id'] ?>" value="option3"> <?= $row['option3'] ?><br>
                    <input type="radio" name="q<?= $row['id'] ?>" value="option4"> <?= $row['option4'] ?><br>
                </div>
            <?php $i++; } ?>
            <button type="submit">Submit Quiz</button>
        </form>
        <div id="result"></div>
    </div>

<script>
$(document).ready(function(){
    $("#quizForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'result.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res){
                $("#result").html(res);
            }
        });
    });
});
</script>
</body>
</html>
