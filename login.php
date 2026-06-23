<?php
session_start();
// Start session for automatic login
include 'db.php'; // Database connection
include 'header.php';

$error = '';
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation for empty fields
    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Retrieve the hashed password from the database
        $query = "SELECT * FROM Users WHERE Email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['Password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // The password is correct, log the user in
                $_SESSION['User_ID'] = $row['User_ID'];
                header("Location: index.php");
                exit();
            } else {
                // The password is incorrect
                $error = "Invalid email or password.";
            }
        } else {
            // The email does not exist
            $error = "Invalid email or password.";
        }
    }
}    
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Main Content -->
<main>
    <section class="login-section">
        <h2>Login to MovieFiesta</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="login-btn">Login</button>
            </div>
            <p class="account-text">Don't have an account? <a href="register.php" class="create-account-link">Create one</a></p>
            <?php
            if ($error) {
                echo '<p class="error">' . $error . '</p>';
            }
            ?>
        </form>
    </section>
</main>
<!-- Footer -->
<?php
include 'footer.php';
?>
</body>
</html>