<?php
session_start();
include '../db.php';

$error = '';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']); // simple MD5 hash

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f2f5, #c3cfe2);
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
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
        text-align: left;
    }

    input[type="text"], input[type="password"] {
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus, input[type="password"]:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 8px rgba(108,99,255,0.2);
        outline: none;
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

    p.error {
        color: red;
        margin-bottom: 15px;
        font-weight: bold;
    }

    @media (max-width: 500px) {
        .container {
            padding: 30px 20px;
        }

        button, input[type="text"], input[type="password"] {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if($error != '') { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
