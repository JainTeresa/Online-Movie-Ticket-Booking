<?php
include '../db.php'; // include database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Escape the inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);

    // Fetch the theater details from the database
    $query = "SELECT * FROM Theaters WHERE Email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Fetch theater details
        $theater = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $theater['Password'])) {
            // Successful login, store session data
            $_SESSION['theater_id'] = $theater['Theater_ID'];
            $_SESSION['theater_name'] = $theater['Name'];

            // Redirect to the theater panel dashboard (index.php)
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
    }
}
?>
