<?php 
session_start(); 
include 'db.php'; 

$user_id = $_SESSION['User_ID'];
$booking_count = $_SESSION['booking_count'] ?? 0;
$totalAmount = $_SESSION['totalAmount'] ?? 0;

$movie_id = $_GET['movie_id'] ?? null;
$theater_id = $_GET['theater_id'] ?? null;
$show_id = $_GET['show_id'] ?? null;
$date = $_GET['date'] ?? null;
$show_time = $_GET['show_time'] ?? null;

if (!$movie_id || !$theater_id || !$show_id || !$date) {
    header("Location: booking.php?error=invalidrequest");
    exit();
}

// Fetch theater details
$theaterQuery = "SELECT * FROM Theaters WHERE Theater_ID = '$theater_id'";
$theaterResult = $conn->query($theaterQuery);
$theater = $theaterResult->fetch_assoc();

// Fetch booked seats for the show
$bookedSeatsQuery = "SELECT s.Seat_No 
                     FROM Booked_Seats bs 
                     INNER JOIN Seats s 
                     ON bs.Seat_ID = s.Seat_ID 
                     WHERE bs.Show_ID = '$show_id'";
$bookedSeatsResult = $conn->query($bookedSeatsQuery);
$bookedSeats = array();
while ($bookedSeat = $bookedSeatsResult->fetch_assoc()) {
    $bookedSeats[] = $bookedSeat['Seat_No']; // Store alphanumeric seat numbers
}

// Initialize selected seats and total amount
$selectedSeats = array();
// Fetch user booking count to determine the discount
$bookingQuery = "SELECT Booking_Count FROM Users WHERE User_ID = '$user_id'";
$bookingResult = $conn->query($bookingQuery);
$bookingCount = $bookingResult->fetch_assoc()['Booking_Count'] ?? 0;

$_SESSION['booking_count'] = $bookingCount; // Update session

$discount = 0; // Default is no discount    
   if ($booking_count == 2) {
    $discount = 0.05; // 5% discount for the 2nd booking
} elseif ($booking_count == 5) {
    $discount = 0.10; // 10% discount for the 5th booking
} elseif ($booking_count == 10) {
    $discount = 0.20; // 20% discount for the 10th booking
}
    
// Initialize total amount
$totalAmount = 0;
if (isset($_POST['selectedSeats'])) {
    $selectedSeats = explode(',', $_POST['selectedSeats']);
    $totalAmount = count($selectedSeats) * $theater['Price'];
    $totalAmount -= $totalAmount * $discount; // Apply discount
}
echo "<script>const discountRate = $discount;</script>";

$leftSection = '';
$rightSection = '';
$seatNo = 1; // Numeric index
$cols = 10;
$rows = ceil($theater['Capacity'] / ($cols * 2));
$alphabet = range('A', 'S'); // Supports up to 20 rows

for ($i = 1; $i <= $rows; $i++) {
    $leftSection .= '<div class="seat-row">';
    $rightSection .= '<div class="seat-row">';
    
    for ($j = 1; $j <= $cols; $j++) {
        if ($seatNo <= $theater['Capacity']) {
            $leftSeatNo = $alphabet[$i - 1] . $j; // Alphanumeric seat (e.g. A1, A2)
            
            // Determine seat class
            $seatClass = 'available'; // Default to available
            if (in_array($leftSeatNo, $bookedSeats)) {
                $seatClass = 'sold'; // Mark as booked
            } elseif (in_array($leftSeatNo, $selectedSeats)) {
                $seatClass = 'selected'; // Mark as selected
            }
            $leftSection .= '<div id="seat-' . $seatNo . '" class="seat-box ' . $seatClass . '" onclick="selectSeat(this, \'' . $leftSeatNo . '\')">' . $leftSeatNo . '</div>';
            $seatNo++;
        }
        
        if ($seatNo <= $theater['Capacity']) {
            $rightSeatNo = $alphabet[$i - 1] . ($j + $cols); // Alphanumeric seat for the right section
            
            // Determine seat class
            $seatClass = 'available'; // Default to available
            if (in_array($rightSeatNo, $bookedSeats)) {
                $seatClass = 'sold'; // Mark as booked
            } elseif (in_array($rightSeatNo, $selectedSeats)) {
                $seatClass = 'selected'; // Mark as selected
            }
            $rightSection .= '<div id="seat-' . $seatNo . '" class="seat-box ' . $seatClass . '" onclick="selectSeat(this, \'' . $rightSeatNo . '\')">' . $rightSeatNo . '</div>';
            $seatNo++;
        }
    }
    
    $leftSection .= '</div>';
    $rightSection .= '</div>';
}
?>                                                                                                                                                          
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seat Selection - MovieFiesta</title>
  <link rel="stylesheet" href="css/style.css">
<style>

 .seat-box {
      width: 30px;
      height: 30px;
      border: 1px solid #ccc;
      display: inline-block;
      margin: 5px;
      text-align: center;
      padding-top: 5px;
      font-size: 12px;
      cursor: pointer;
    }
    .available {
      background-color: #c6efce;
    }
    .selected {
      background-color: #66b3ff;
    }
    .sold {
      background-color: #ff9999;
    }
    .screen {
      width: 35%;
      height: 30px;
      background-color: lightblue;
      color: black;
      text-align: center;
      font-size: 18px;
      padding: 5px;
      margin-bottom: 10px;
      margin-top: 30px;
      margin-left: 440px;
      border-radius: 10px;
    }
    .legend {
      text-align: center;
      margin-bottom: 20px;
      margin-top: 20px;
    }
    .legend-box {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin: 5px;
      border: 1px solid #ccc;
    }
    .pay-btn {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      margin-top: 20px;
      margin-bottom: 30px;
      cursor: pointer;
    }
  
   .seat-section {
  display: inline-block;
    vertical-align: top;
   width: 40%;
     margin-right: 115px;  
  margin-left: 115px;     
  margin-top: 20px;
}
  </style>
</head>
<body>
    <a href="booking.php?movie_id=<?= $movie_id; ?>"><img src="images/back-arrow.png" alt="Back" style="margin: 10px; width: 45px; height: 45px;"></a>
    <div class="legend">
        <div class="legend-box available"></div> Available
        <div class="legend-box selected"></div> Selected
        <div class="legend-box sold"></div> Sold
    </div>

    <div class="seat-selection">
        <form action="payment.php" method="POST" id="seatSelectionForm">
            <div style="display: flex; justify-content: space-between; gap: 1px;">
                <div class="seat-section"><?= $leftSection; ?></div>
                <div class="seat-section"><?= $rightSection; ?></div>
            </div>

            <div class="screen">All Eyes Here</div>
            <div style="text-align: center;">
                <button type="submit" class="pay-btn" onclick="return validateSelection()">Pay Rs. <?= $totalAmount; ?></button>
            </div>            
            <input type="hidden" id="selectedSeats" name="selectedSeats" value="<?= implode(',', $selectedSeats) ?>">
            <input type="hidden" id="totalAmount" name="total_amount" value="<?= $totalAmount ?>">
            <input type="hidden" name="movie_id" value="<?= $movie_id ?>">
            <input type="hidden" name="theater_id" value="<?= $theater_id ?>">
            <input type="hidden" name="show_id" value="<?= $show_id ?>">
            <input type="hidden" name="date" value="<?= $date ?>">
            <input type="hidden" name="show_time" value="<?= $show_time ?>">
        </form>
    </div>
    <script>
                                  let selectedSeats = <?= json_encode($selectedSeats); ?>;
        const seatPrice = <?= $theater['Price']; ?>;
        
        function selectSeat(seat, seatNo) {
            if (seat.classList.contains('sold')) {
                alert('Seat already booked!');
                return;
            }

            if (seat.classList.contains('selected')) {
                seat.classList.remove('selected');
                seat.classList.add('available');
                removeSeatFromSelection(seatNo);
            } else {
                seat.classList.remove('available');
                seat.classList.add('selected');
                addSeatToSelection(seatNo);
            }

            updateTotalAmount();
        }

        function addSeatToSelection(seatNo) {
            selectedSeats.push(seatNo);
            document.getElementById('selectedSeats').value = selectedSeats.join(',');
        }

        function removeSeatFromSelection(seatNo) {
            const index = selectedSeats.indexOf(seatNo);
            if (index > -1) {
                selectedSeats.splice(index, 1);
            }
            document.getElementById('selectedSeats').value = selectedSeats.join(',');
        }

       function updateTotalAmount() {
    let total = selectedSeats.length * seatPrice;
    let discountedTotal = total * (1 - discountRate); // Apply discount
    document.getElementById('totalAmount').value = discountedTotal.toFixed(2); // Update hidden input
    document.querySelector('.pay-btn').innerText = 'Pay Rs. ' + discountedTotal.toFixed(2); // Update button
}
        function validateSelection() {
            if (selectedSeats.length === 0) {
                alert('Please select at least one seat');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>