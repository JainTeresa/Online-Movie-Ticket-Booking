<?php 
session_start(); 
// Start session for automatic login
include 'db.php'; 
// Database connection
include 'header.php';

$error = '';

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Basic validation for empty fields
    if (empty($name) || empty($phone) || empty($location) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Invalid phone number. Please enter a 10-digit number.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
        $error = "Password must be at least 6 characters long, contain at least one lowercase letter, one uppercase letter, and one digit.";
    } else {
        // Check if the email already exists
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);
        if ($checkEmailResult->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password (only once)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user data into the database
            $query = "INSERT INTO users (name, phone, location, email, password) VALUES ('$name', '$phone', '$location', '$email', '$hashedPassword')";
            if ($conn->query($query) === TRUE) {
                // Automatically log the user in by setting session
                $_SESSION['user_id'] = $conn->insert_id;
                // Use the auto-incremented user ID
                
                // Redirect to home page after successful registration
                header("Location: index.php");
                exit(); 
                // Always exit after header redirection
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #d9ecd0;
            padding: 40px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .register-form input[type="text"], 
        .register-form input[type="email"], 
        .register-form input[type="password"], 
        .register-form input[type="tel"],
        .register-form select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        .register-form button {
            padding: 12px;
            background-color: #ff6347;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .register-form button:hover {
            background-color: #ff4500;
        }
        .register-container p {
            text-align: center;
            margin-top: 15px;
        }
        .register-container p a {
            color: #ff6347;
            text-decoration: none;
        }
        .register-container p a:hover {
            text-decoration: underline;
        }
        .error {
            color: #ff0000;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <main>
        <div class="register-container">
            <h2>Create Your Account</h2>
       <form class="register-form" action="register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
            <input type="tel" name="phone" placeholder="Phone Number (10 digits)" required value="<?= isset($phone) ? htmlspecialchars($phone) : '' ?>">
            <select name="location" required>
                <option value="">Select City</option>
                               <option value="Los Angeles">Los Angeles</option>
                </select>
            <input type="email" name="email" placeholder="Email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>

</body>
</html>