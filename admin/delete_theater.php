<?php
include('../db.php'); // Include your database connection

if (isset($_GET['id'])) {
    $theaterId = intval($_GET['id']);

    // Delete theater from the database
    $query = "DELETE FROM Theaters WHERE Theater_ID = $theaterId";
    if ($conn->query($query) === TRUE) {
        header("Location: index.php?message=Theater deleted successfully.");
        exit();
    } else {
        echo "Error deleting theater: " . $conn->error;
    }
} else {
    echo "Invalid theater ID.";
}
?>
