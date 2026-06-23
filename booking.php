<?php 
session_start(); 
include 'db.php'; 
include 'header.php';

$user_id = $_SESSION['User_ID'];

// Get movie ID from URL
$movie_id = $_GET['movie_id'];

// Fetch movie details
$movieQuery = "SELECT * FROM Movies WHERE Movie_ID = '$movie_id'";
$movieResult = $conn->query($movieQuery);

if (!$movieResult) {
    die("Query failed: " . $conn->error);
}

$movie = $movieResult->fetch_assoc();

// Fetch unique dates from Shows table
$datesQuery = "SELECT DISTINCT Date FROM Shows WHERE Movie_ID = '$movie_id' ORDER BY Date ASC";
$datesResult = $conn->query($datesQuery);

// Generate current and next 6 days' dates
$dates = array();
for ($i = 0; $i <= 6; $i++) {
    $date = date('Y-m-d', strtotime('+' . $i . ' days'));
    $dates[] = $date;
}

// Selected date and movie ID
$selectedDate = isset($_GET['date']) ? $_GET['date'] : $dates[0];
$movie_id = $_GET['movie_id'];

// Fetch theaters and show times for the selected date and movie
if ($selectedDate) {
    $theatersQuery = "SELECT * FROM Theaters 
                      INNER JOIN Shows ON Theaters.Theater_ID = Shows.Theater_ID 
                      WHERE Shows.Movie_ID = '$movie_id' AND Shows.Date = '$selectedDate'";
    $theatersResult = $conn->query($theatersQuery);

    if (!$theatersResult) {
        die("Query failed: " . $conn->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main>
        <section class="booking-section">
            <h2>Book Tickets for <?= $movie['Title']; ?></h2><br>
            <div class="date-selection">
                <?php foreach ($dates as $date) { 
                    $dayName = date('D', strtotime($date));
                    $dayNumber = date('j', strtotime($date));
                    $monthName = date('M', strtotime($date));
                ?>
                <a href="?movie_id=<?= $movie_id; ?>&date=<?= $date; ?>" class="date-box <?= ($selectedDate == $date) ? 'selected' : ''; ?>">
                    <span><?= $dayName; ?></span>
                    <span><?= $dayNumber; ?></span>
                    <span><?= $monthName; ?></span>
                </a>
                <?php } ?>
            </div>

            <?php if ($selectedDate) { ?>
                <?php if ($theatersResult->num_rows > 0) { ?>
                    <div class="theater-selection">
                        <?php while ($theater = $theatersResult->fetch_assoc()) { ?>
                            <div class="theater-box">
                                <br><h4><?= $theater['Name'] ?? 'Theater Name Not Found'; ?></h4>
                                <div class="show-times">
                                    <?php 
                                    $showTimesQuery = "SELECT Show_ID, Time AS Show_Time FROM Shows WHERE Theater_ID = '$theater[Theater_ID]' AND Movie_ID = '$movie_id' AND Date = '$selectedDate'";
                                    $showTimesResult = $conn->query($showTimesQuery);

                                    if (!$showTimesResult) {
                                        die("Query failed: " . $conn->error);
                                    }

                                    while ($showTime = $showTimesResult->fetch_assoc()) {
                                    ?>
                                        <button class="show-time-box <?= ($selectedShowTime == $showTime['Show_ID']) ? 'selected' : ''; ?>" 
                                                data-theater-id="<?= $theater['Theater_ID']; ?>" 
                                                data-show-id="<?= $showTime['Show_ID']; ?>">
                                            <?= $showTime['Show_Time'] ?? 'Show Time Not Found'; ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div> 
                    <div class="select-seats-btn-container">
                        <br><br><br><br>
                        <button class="select-seats-btn" onclick="selectSeats()">Select Seats</button>
                    </div>
                    <script>
                        let selectedTheaterId = null;
                        let selectedShowTime = null;

                        document.querySelectorAll('.show-time-box').forEach(button => {
                            button.addEventListener('click', () => {
                                document.querySelectorAll('.show-time-box').forEach(btn => btn.classList.remove('selected'));
                                button.classList.add('selected');
                                selectedTheaterId = button.dataset.theaterId;
                                selectedShowTime = button.dataset.showId;
                            });
                        });

                        function selectSeats() {
                            if (selectedShowTime && selectedTheaterId) {
                                window.location.href = "seat_selection.php?movie_id=<?= $movie_id; ?>&theater_id=" + selectedTheaterId + "&show_id=" + selectedShowTime + "&date=<?= $selectedDate; ?>&show_time=" + document.querySelector('.show-time-box.selected').textContent.trim();
                            } else {
                                alert("Please select a show time.");
                            }
                        }

                        
                        function closeModal() {
                            const modal = document.getElementById("myModal");
                            modal.style.display = "none";
                        }
                    </script>
                <?php } else { ?>
                    <br><br><p>No theaters found for the selected movie and date.</p><br><br><br><br><br><br><br><br><br><br><br>
                <?php } ?>
            <?php } ?>
        </section>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <p id="modal-content-text"></p>
                <button onclick="closeModal()">OK</button>
            </div>
        </div>

    </main>
    <?php include 'footer.php'; ?>
</body>
</html>

