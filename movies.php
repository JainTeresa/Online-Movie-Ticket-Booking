<?php
include 'db.php'; // Database connection
include 'header.php';

// Fetch all now showing movies
$nowShowingQuery = "SELECT * FROM Movies WHERE release_date <= CURDATE() ORDER BY release_date ASC";
$nowShowingResult = $conn->query($nowShowingQuery);
$nowShowingCount = $nowShowingResult->num_rows;

// Divide movies into two halves for left-right 50% display
$halfCount = ceil($nowShowingCount / 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>
    <main>
        <!-- Heading now in its own container -->
        <section class="movies-page-section">
            <div class="movies-heading">
                <h2>Now Showing Movies</h2>
            </div>

            <div class="movie-split-container-horizontal">
                <div class="movie-list-left">
                    <?php
                    // Loop through the first half of the movies
                    if ($nowShowingCount > 0) {
                        $counter = 0;
                        while ($movie = $nowShowingResult->fetch_assoc()) {
                            $counter++;
                            if ($counter <= $halfCount) {
                                echo "
                                <div class='movie-item'>
                                  <a href='movie_details.php?movie_id=" . $movie['Movie_ID'] . "'>
                                    <img src='" . $movie['Poster_url'] . "' alt='" . $movie['Title'] . " Poster' class='movie-poster'>
                                  </a>
                                  <div class='movie-details'>
                                    <h3>" . $movie['Title'] . "</h3>
                                    <p><strong>Rating:</strong> " . $movie['Rating'] . "</p>
                                    <p><strong>Genre:</strong> " . $movie['Genre'] . "</p>
                                    <p><strong>Starring:</strong> " . $movie['Starring'] . "</p>
                                    <p> <a href='" . $movie['Trailer_url'] . "' target='_blank'>Watch Trailer</a></p>
                                  </div>   
                                </div>";
                            }
                        }
                    }
                    ?>
                </div>
                
                <div class="movie-list-right">
                    <?php
                    // Loop through the second half of the movies
                    $nowShowingResult->data_seek(0); // Reset the query result to start again
                    $counter = 0;
                    while ($movie = $nowShowingResult->fetch_assoc()) {
                        $counter++;
                        if ($counter > $halfCount) {
                            echo "
                            <div class='movie-item'>
                              <a href='movie_details.php?movie_id=" . $movie['Movie_ID'] . "'>
                                <img src='" . $movie['Poster_url'] . "' alt='" . $movie['Title'] . " Poster' class='movie-poster'>
                              </a>
                              <div class='movie-details'>
                                    <h3>" . $movie['Title'] . "</h3>
                                    <p><strong>Rating:</strong> " . $movie['Rating'] . "</p>
                                    <p><strong>Genre:</strong> " . $movie['Genre'] . "</p>
                                    <p><strong>Starring:</strong> " . $movie['Starring'] . "</p>
                                    <p><a href='" . $movie['Trailer_url'] . "' target='_blank'>Watch Trailer</a></p>
                                  </div>   
                            </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
<?php
include 'footer.php';
?>    
</body>
</html>
