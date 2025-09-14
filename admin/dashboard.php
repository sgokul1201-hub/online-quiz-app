<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include '../db.php';

$result = $conn->query("SELECT * FROM questions ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f2f5, #c9d6ff);
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        p a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        p a:hover {
            color: #574fd6;
        }

        .btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 12px 25px;
            background: #6c63ff;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108,99,255,0.3);
        }

        .btn:hover {
            background: #574fd6;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(108,99,255,0.4);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #6c63ff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        tr:hover {
            background: #f5f5ff;
        }

        a.action {
            color: #6c63ff;
            text-decoration: none;
            margin-right: 10px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a.action:hover {
            color: #574fd6;
        }

        @media (max-width: 600px) {
            th, td {
                padding: 10px;
                font-size: 0.9rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome, <?php echo $_SESSION['admin']; ?> | <a href="logout.php">Logout</a></p>
        <a href="add_question.php" class="btn">Add Question</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['question'] ?></td>
                        <td>
                            <a href="edit_question.php?id=<?= $row['id'] ?>" class="action">Edit</a>
                            <a href="delete_question.php?id=<?= $row['id'] ?>" class="action" onclick="return confirm('Delete this question?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
