<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $release_date = mysqli_real_escape_string($conn, $_POST['release_date']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $crew = mysqli_real_escape_string($conn, $_POST['crew']);
    $poster_url = mysqli_real_escape_string($conn, $_POST['poster_url']);
    $trailer_url = mysqli_real_escape_string($conn, $_POST['trailer_url']);

    // Insert data into Movies table
    $query = "
        INSERT INTO Movies (Title, About, Release_Date, Duration, Genre, Rating, Cast, Crew, Poster_url, Trailer_url)
        VALUES ('$title', '$about', '$release_date', '$duration', '$genre', '$rating', '$cast', '$crew', '$poster_url', '$trailer_url')
    ";

    if (mysqli_query($conn, $query)) {
        echo "Movie added successfully!";
        header('Location: index.php'); // Redirect to index or movie list page after success
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
