<?php 
include 'db.php'; 
include 'header.php';

// Get movie ID from URL
$movie_id = $_GET['movie_id'];

// Fetch movie details
$movieQuery = "SELECT * FROM Movies WHERE Movie_ID = '$movie_id'";
$movieResult = $conn->query($movieQuery);
$movie = $movieResult->fetch_assoc();

// Fetch now showing movies
$nowShowingQuery = "SELECT * FROM Movies WHERE release_date <= CURDATE() ORDER BY release_date DESC";
$nowShowingResult = $conn->query($nowShowingQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movie Details - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Adjust layout to 60% and 40% */
        .movie-details-section {
            display: flex;
            justify-content: space-between;
        }
        .movie-details-left {
            width: 70%;
        }
        .movie-details-right {
            width: 30%;
        }
        .now-showing-movie {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .now-showing-movie-poster img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            margin-right: 20px;
            margin-bottom: 20px;
        }
        .now-showing-movie-details {
            flex-grow: 1;
               }

        .now-showing-movie-details h3 {
            margin-top: 0;
            margin-bottom: 30px; 
                   }
        .now-showing-movie-details p {
            margin-bottom: 2opx;
        }
        .now-showing-movie-details a {
            text-decoration: none;
            color: #007BFF;
        }

.modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.4); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal h2 {
        color: #333;
    }

    .modal ul {
        text-align: left;
        font-size: 16px;
        color: #555;
    }

    .modal-close-btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .modal-close-btn:hover {
        background-color: #45a049;
    }

    </style>
</head>

<body>
    <main>
        <br><section class="movie-details-section">
           <div class="movie-details-left">
    <div class="movie-poster-and-details">
        <div class="movie-poster-container" style="margin-left: 15px;">
            <img src="<?= $movie['Poster_url']; ?>" alt="<?= $movie['Title']; ?> Poster">
        </div>
        <div class="movie-details-info">
            <h2><?= $movie['Title']; ?></h2>
            <p><strong>Rating:</strong> <?= $movie['Rating']; ?></p>
            <p><strong>Duration:</strong> <?= $movie['Duration']; ?> minutes</p><br>
            <a href="#" class="book-tickets-btn" onclick="validateLogin(event)">Book Tickets</a>
            <a href="#" class="book-tickets-btn" style="margin-left: 15px;" onclick="openDiscountModal()">Discount</a>
         </div>
    </div>
    <div class="movie-extra-details" style="margin-left: 15px; margin-right: 100px;">
        <h3>More Details</h3>
        <p><strong>Trailer:</strong> <a href="<?= $movie['Trailer_url']; ?>" target="_blank">Watch Trailer</a></p>
        <p><strong>Release Date:</strong> <?= $movie['Release_Date']; ?></p>
        <p><strong>Genre:</strong> <?= $movie['Genre']; ?></p>
        <p><strong>Starring:</strong> <?= $movie['Starring']; ?></p>
        <p><strong>Crew:</strong> <?= $movie['Crew']; ?></p>
        <p><strong>About Movie:</strong> <?= $movie['About']; ?></p>
    </div>
</div> 
            <div class="movie-details-right">
                <h2>Now Showing</h2>
                <?php while ($nowShowingMovie = $nowShowingResult->fetch_assoc()): ?>
                    <div class="now-showing-movie">
                        <div class="now-showing-movie-poster">
                            <a href="movie_details.php?movie_id=<?= $nowShowingMovie['Movie_ID']; ?>">
                                <img src="<?= $nowShowingMovie['Poster_url']; ?>" alt="<?= $nowShowingMovie['Title']; ?> Poster">
                            </a>
                        </div>
                        <div class="now-showing-movie-details">
                            <h3><?= $nowShowingMovie['Title']; ?></h3>
                            <p><strong>Rating:</strong> <?= $nowShowingMovie['Rating']; ?></p>
                            <p><strong>Genre:</strong> <?= $nowShowingMovie['Genre']; ?></p>
                            <p><a href="<?= $nowShowingMovie['Trailer_url']; ?>" target="_blank">Watch Trailer</a></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

<!-- Modal for Discount -->
    <div id="discountModal" class="modal">
        <div class="modal-content">
            <h2>Discount Details</h2>
            <p>Here are the discounts available for our loyal customers:</p>
            <ul>
                <li>5% off on your 3rd booking.</li>
                <li>10% off on your 5th booking.</li>
                <li>20% off on your 10th booking.</li>
                <li>25% off after completing 20 bookings.</li>
            </ul>
            <button class="modal-close-btn" onclick="closeDiscountModal()">OK</button>
        </div>
    </div>

<script>

// Open the Discount Modal
function openDiscountModal() {
    document.getElementById("discountModal").style.display = "block";
}

// Close the Discount Modal
function closeDiscountModal() {
    document.getElementById("discountModal").style.display = "none";
}

function validateLogin(event) {
    event.preventDefault();
    if (!<?= isset($_SESSION['User_ID']) ? 'true' : 'false'; ?>) {
        alert("Please login first to book tickets.");
        window.location.href = "login.php?redirect=movie_details.php?movie_id=<?= $movie['Movie_ID']; ?>";
    } else {
        window.location.href = "booking.php?movie_id=<?= $movie['Movie_ID']; ?>";
    }
}
</script>
    <?php include 'footer.php'; ?>
</body>
</html>