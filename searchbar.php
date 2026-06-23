<?php
include 'db.php'; // Include database connection

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];
    
    // Escape the input to prevent SQL injection
    $searchTerm = $conn->real_escape_string($searchTerm);

    // Query to search for movies by title (case-insensitive)
    $query = "SELECT Movie_ID, Title FROM Movies WHERE LOWER(Title) LIKE LOWER('%$searchTerm%')";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch the first result
        $row = $result->fetch_assoc();
        // Redirect to the movie details page using the Movie_ID
        header("Location: movie_details.php?movie_id=" . $row['Movie_ID']);
        exit(); // Stop further execution
    } else {
        echo "No results found for '$searchTerm'.";
    }
}
?>
