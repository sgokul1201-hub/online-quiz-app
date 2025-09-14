<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include '../db.php';

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$row = $conn->query("SELECT * FROM questions WHERE id='$id'")->fetch_assoc();

if(isset($_POST['submit'])){
    $q = $_POST['question'];
    $o1 = $_POST['option1'];
    $o2 = $_POST['option2'];
    $o3 = $_POST['option3'];
    $o4 = $_POST['option4'];
    $ans = $_POST['answer'];

    $stmt = $conn->prepare("UPDATE questions SET question=?, option1=?, option2=?, option3=?, option4=?, answer=? WHERE id=?");
    $stmt->bind_param("ssssssi", $q, $o1, $o2, $o3, $o4, $ans, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Question</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f0f2f5, #c3cfe2);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 600px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    input[type="text"], textarea, select {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus, textarea:focus, select:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 8px rgba(108,99,255,0.2);
        outline: none;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    button {
        padding: 12px;
        border-radius: 10px;
        border: none;
        background: #6c63ff;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        background: #574fd6;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(108,99,255,0.4);
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #6c63ff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #574fd6;
    }

    @media (max-width: 500px) {
        .container {
            padding: 30px 20px;
        }

        button, input[type="text"], textarea, select {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <h2>Edit Question</h2>
    <form method="POST">
        <label>Question</label>
        <textarea name="question" required><?= htmlspecialchars($row['question']) ?></textarea>

        <label>Option 1</label>
        <input type="text" name="option1" value="<?= htmlspecialchars($row['option1']) ?>" required>

        <label>Option 2</label>
        <input type="text" name="option2" value="<?= htmlspecialchars($row['option2']) ?>" required>

        <label>Option 3</label>
        <input type="text" name="option3" value="<?= htmlspecialchars($row['option3']) ?>" required>

        <label>Option 4</label>
        <input type="text" name="option4" value="<?= htmlspecialchars($row['option4']) ?>" required>

        <label>Answer</label>
        <select name="answer" required>
            <option value="">Select Correct Answer</option>
            <option value="option1" <?= $row['answer']=='option1'?'selected':'' ?>>Option 1</option>
            <option value="option2" <?= $row['answer']=='option2'?'selected':'' ?>>Option 2</option>
            <option value="option3" <?= $row['answer']=='option3'?'selected':'' ?>>Option 3</option>
            <option value="option4" <?= $row['answer']=='option4'?'selected':'' ?>>Option 4</option>
        </select>

        <button type="submit" name="submit">Update Question</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
