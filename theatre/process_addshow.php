<?php
include('../db.php'); // Connect to database
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['admin_id']) && !isset($_SESSION['theater_id'])) {
    echo "You are not logged in!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_id = $_POST['movie'];
    $theater_id = $_POST['theater'];
    $show_time = $_POST['stime'];
    $start_date = $_POST['sdate'];
    $available_seats = $_POST['available_seats'];

    // Insert the new show into the Shows table
    $query = "INSERT INTO Shows (Movie_ID, Theater_ID, Date, Time, Available_Seats) 
              VALUES ('$movie_id', '$theater_id', '$start_date', '$show_time', '$available_seats')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Show added successfully'); window.location.href='view_shows.php';</script>";
    } else {
        echo "<script>alert('Error adding show: " . mysqli_error($conn) . "'); window.location.href='add_show.php';</script>";
    }
}
?>
