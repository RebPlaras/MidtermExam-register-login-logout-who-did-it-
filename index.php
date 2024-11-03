<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Shop Business - Login/Register</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
        }
        input, select {
            font-size: 1.2em;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-box {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h3>Reb's GPU Shop - Login / Register</h3>

    <div class="form-container">
        <!-- login form -->
        <div class="form-box">
            <h4>Login</h4>
            <form action="../core/handleForms.php" method="POST">
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </p>
                <p>
                    <input type="submit" name="loginBtn" value="Login">
                </p>
            </form>
        </div>

        <!-- register link -->
        <div class="register-link">
            <p>Don't have an account? <a href="registerpage.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
