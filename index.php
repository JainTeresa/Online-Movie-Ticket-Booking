<?php 
include 'db.php'; 
include 'header.php'; 

// Fetch Now Showing Movies
$nowShowingQuery = "SELECT * FROM Movies WHERE release_date <= CURDATE() ORDER BY release_date DESC";
$nowShowingMovies = $conn->query($nowShowingQuery);

// Fetch Upcoming Movies
$upcomingMoviesQuery = "SELECT * FROM Upcoming_Movies";
$upcomingMovies = $conn->query($upcomingMoviesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... your existing head content ... -->
    <title>MovieFiesta - Your Movie Escape!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Main Content -->
    <main>
        <section class="movie-section">
            <!-- Upcoming Movies -->
            <div class="movie-list upcoming-movies">
                <h2>Upcoming Movies</h2><br>
                <?php if ($upcomingMovies->num_rows > 0): ?>
                    <?php while ($movie = $upcomingMovies->fetch_assoc()): ?>
                        <div class="movie-item">
                            <img src="<?= $movie['Poster_URL']; ?>" alt="<?= $movie['Title']; ?> Poster" class="movie-poster">
                            <div class="movie-details">
                                <h3><?= $movie['Title']; ?></h3>
                                <p><strong>Release Date:</strong> <?= $movie['Release_Date']; ?></p>
                                <p><strong>Genre:</strong> <?= $movie['Genre']; ?></p>
                                <p><strong>Crew:</strong> <?= $movie['Crew']; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No upcoming movies at the moment.</p>
                <?php endif; ?>
            </div>

            <!-- Now Showing Movies -->
            <div class="movie-list now-showing">
                <h2>Now Showing</h2><br>
                <?php if ($nowShowingMovies->num_rows > 0): ?>
                    <?php while ($movie = $nowShowingMovies->fetch_assoc()): ?>
                        <div class="movie-item">
                            <a href="movie_details.php?movie_id=<?= $movie['Movie_ID']; ?>">
                                <img src="<?= $movie['Poster_url']; ?>" alt="<?= $movie['Title']; ?> Poster" class="movie-poster">
                            </a>
                            <div class="movie-details">
                                <h3><?= $movie['Title']; ?></h3>
                                <p><strong>Rating:</strong> <?= $movie['Rating']; ?></p>
                                <p><strong>Genre:</strong> <?= $movie['Genre']; ?></p>
                                <p><strong>Starring:</strong> <?= $movie['Starring']; ?></p>
                                <p><a href="<?= $movie['Trailer_url']; ?>" target="_blank">Watch Trailer</a></p>
                                </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No movies are currently showing.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>