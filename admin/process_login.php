<?php
// Include database connection
include '../db.php'; 

// Start the session at the beginning of the script
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Escape the inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);

    // Fetch the user data from the database
    $query = "SELECT * FROM Users WHERE Email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['Password'])) {
            // Successful login, set session and redirect
            $_SESSION['admin_id'] = $user['User_ID'];
           
            // Use absolute path for redirection to ensure the correct page
          header("Location: index.php");
            exit(); // Make sure to exit after redirection
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method'); window.location.href='login.php';</script>";
}
?>
