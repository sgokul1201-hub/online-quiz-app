<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz System</title>
    <style>
        /* Reset some default styles */
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
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #333;
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 10px;
            background: #6c63ff;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108,99,255,0.3);
        }

        .btn:hover {
            background: #574fd6;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(108,99,255,0.4);
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 2rem;
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
        <h1>Welcome to Online Quiz System</h1>
        <div class="links">
            <a href="admin/list_questions.php" class="btn">Admin Panel</a>
            <a href="user/quiz.php" class="btn">Take Quiz</a>
        </div>
    </div>
</body>
</html>
