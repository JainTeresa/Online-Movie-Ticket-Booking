<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Panel Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .login-box {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
               .login-logo b {
            color: ##333;
            text-align: center;  
            display: block;
        }
        .login-box-body {
            padding: 20px;
        }
        .login-box-msg {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            width: 100%;
        }
        .login-box-body a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
           <b style="font-size: 28px; text-align: center;">Theatre Panel</b>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Please login to start your session</p>

            <form action="process_login.php" method="post">
                <div class="form-group">
                    <input type="text" name="Email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="Password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <a href="../admin/login.php">Go To Admin Panel</a>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
