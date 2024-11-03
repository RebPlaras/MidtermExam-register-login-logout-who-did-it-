<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Shop Business - Register</title>
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
    </style>
</head>
<body>
    <h3>Reb's GPU Shop - Register</h3>

    <div class="form-container">
        <!-- register form -->
        <div class="form-box">
            <h4>Register</h4>
            <form action="../core/handleForms.php" method="POST">
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </p>
                <p>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </p>
                <p>
                    <label for="role">Register as</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </p>
                <p>
                    <input type="submit" name="registerBtn" value="Register">
                </p>
            </form>
        </div>
    </div>
</body>
</html>
