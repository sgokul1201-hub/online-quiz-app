<?php
include '../db.php';

$score = 0;
$total = 0;
$output = "<h3>Results:</h3>";

foreach($_POST as $qid => $userAns){
    $id = str_replace('q','',$qid);
    $total++;

    $row = $conn->query("SELECT * FROM questions WHERE id='$id'")->fetch_assoc();

    // Get correct answer text
    $correct_answer_key = $row['answer']; // e.g., 'option2'
    $correct_answer_text = $row[$correct_answer_key];

    if($row['answer'] == $userAns){
        $score++;
        $output .= "<p style='color:green;'>".$row['question']." - Correct</p>";
    } else {
        $output .= "<p style='color:red;'>".$row['question']." - Incorrect <br> Correct Answer: ".$correct_answer_text."</p>";
    }
}

$output .= "<h4>Score: $score / $total</h4>";
echo $output;
?>
