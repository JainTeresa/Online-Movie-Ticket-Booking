<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Login</title>
    <!-- Add some basic styling -->
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .login-box {
            width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                   }
        .login-logo a {
            font-size: 28px;
            color: #333;
            text-align: center;
            display: block;           
        }

        .login-box-msg {
            margin-bottom:22px;
         }

        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #c9302c;
        }
        .login-box-body {
            padding: 30px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>

    <!-- Add validation script -->
    <script>
        function validateForm() {
            var email = document.forms["loginForm"]["Email"].value;
            var password = document.forms["loginForm"]["Password"].value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            // Clear previous errors
            document.getElementById('emailError').textContent = "";
            document.getElementById('passwordError').textContent = "";

            var isValid = true;

            // Email validation
            if (email == "" || !emailPattern.test(email)) {
                document.getElementById('emailError').textContent = "Please enter a valid email.";
                isValid = false;
            }

            // Password validation (minimum length)
            if (password == "" || password.length < 6) {
                document.getElementById('passwordError').textContent = "Password must be at least 6 characters long.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <a><b> Admin Panel</b></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Please login to start your session</p>

            <!-- Form with onsubmit validation -->
            <form name="loginForm" action="process_login.php" method="post" onsubmit="return validateForm()">
                <div class="form-group has-feedback">
                    <input name="Email" type="text" size="25" placeholder="Email" class="form-control" required/>
                    <span class="error" id="emailError"></span> <!-- Email validation error -->
                </div>
                <div class="form-group has-feedback">
                    <input name="Password" type="password" size="25" placeholder="Password" class="form-control" required/>
                    <span class="error" id="passwordError"></span> <!-- Password validation error -->
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Login</button><br><br>
                </div>
            </form>
            <a href="../theatre/login.php" style="text-decoration: none;">Go To Theatre Panel</a>
        </div>
    </div>
</body>
</html>
