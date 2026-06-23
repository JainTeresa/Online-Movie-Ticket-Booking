<?php 
session_start(); 
include 'db.php'; 
include 'header.php';

$user_id = $_SESSION['User_ID'];

// Retrieve posted data from payment.php
$movie_id = $_POST['movie_id'] ?? null;
$theater_id = $_POST['theater_id'] ?? null;
$show_id = $_POST['show_id'] ?? null;
$date = $_POST['date'] ?? null;
$show_time = $_POST['show_time'] ?? null;
$totalAmount = $_POST['total_amount'] ?? 0;
$selectedSeats = $_POST['selectedSeats'] ?? '';
$selectedSeatNumbers = explode(',', $selectedSeats); 

// Get the user's booking count
$bookingCountQuery = "SELECT Booking_Count FROM Users WHERE User_ID = ?";
$stmtBookingCount = $conn->prepare($bookingCountQuery);
$stmtBookingCount->bind_param("i", $user_id);
$stmtBookingCount->execute();
$stmtBookingCount->bind_result($bookingCount);
$stmtBookingCount->fetch();
$stmtBookingCount->close();

// Determine discount based on the booking count
$discount = 0;
if ($bookingCount == 2) {
    $discount = 0.05 * $totalAmount;
} elseif ($bookingCount == 5) {
    $discount = 0.10 * $totalAmount;
} elseif ($bookingCount == 10) {
    $discount = 0.20 * $totalAmount;
} 
$final_amount = $totalAmount - $discount;

// Insert booking data into Bookings table
$bookingQuery = "INSERT INTO Bookings (User_ID, Theater_ID, Show_ID, Movie_ID, Number_of_Tickets, Booking_Date, Total_Amount, Discount_Amount) 
                 VALUES (?, ?, ?, ?, ?, CURDATE(), ?, ?)";
$stmt = $conn->prepare($bookingQuery);
$numberOfSeats = count($selectedSeatNumbers);
$totalAmountInt = (int)$totalAmount;
$stmt->bind_param("iiiiidd", $user_id, $theater_id, $show_id, $movie_id, $numberOfSeats, $totalAmount, $discount);
$stmt->execute();

// Get the newly inserted Booking ID
$booking_id = $stmt->insert_id;

// Insert payment data into Payments table
$paymentQuery = "INSERT INTO Payments (Payment_Date, Amount) VALUES (CURDATE(), ?)";
$stmtPayment = $conn->prepare($paymentQuery);
$stmtPayment->bind_param("d", $final_amount); // Use final discounted amount
$stmtPayment->execute();

// Get the newly inserted Payment ID
$payment_id = $stmtPayment->insert_id;

// Link Booking and Payment in Booking_Payments table
$bookingPaymentQuery = "INSERT INTO Booking_Payments (Booking_ID, Payment_ID) VALUES (?, ?)";
$stmtBookingPayment = $conn->prepare($bookingPaymentQuery);
$stmtBookingPayment->bind_param("ii", $booking_id, $payment_id);
$stmtBookingPayment->execute();

// Update Available_Seats in Shows table
$updateSeatsQuery = "UPDATE Shows SET Available_Seats = Available_Seats - ? WHERE Show_ID = ?";
$stmt = $conn->prepare($updateSeatsQuery);
$stmt->bind_param("ii", $numberOfSeats, $show_id);
$stmt->execute();

// Fetch Seat IDs based on the seat numbers
$seatNumbersArray = []; // This will store seat numbers for displaying later
foreach ($selectedSeatNumbers as $seatNumber) {
    // Find the corresponding Seat_ID for the given Seat_No and Theater_ID
    $seatQuery = "SELECT Seat_ID, Seat_No FROM Seats WHERE Seat_No = ? AND Theater_ID = ?";
    $stmt = $conn->prepare($seatQuery);
    $stmt->bind_param("si", $seatNumber, $theater_id);
    $stmt->execute();
    $seatResult = $stmt->get_result();

    if ($seatResult->num_rows > 0) {
        // Get the Seat_ID and Seat_No
        $seatRow = $seatResult->fetch_assoc();
        $seatID = $seatRow['Seat_ID'];
        $seatNumbersArray[] = $seatRow['Seat_No'];

        // Insert into Booked_Seats table
        $seatBookingQuery = "INSERT INTO Booked_Seats (Booking_ID, Seat_ID, Show_ID, Theater_ID) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($seatBookingQuery);
        $stmtInsert->bind_param("iiii", $booking_id, $seatID, $show_id, $theater_id);
        $stmtInsert->execute();

        // Check for errors in insertion
        if ($stmtInsert->error) {
            echo "Error inserting seat booking: " . $stmtInsert->error;
        }
    } else {
        echo "Seat number $seatNumber does not exist. Cannot book this seat.";
    }
}

// Convert seat numbers array to a comma-separated string
$seatNumbersString = implode(', ', $seatNumbersArray);

// Retrieve movie and theater names
$movieQuery = "SELECT Title FROM Movies WHERE Movie_ID = '$movie_id'";
$movieResult = $conn->query($movieQuery);
$movieName = $movieResult->fetch_assoc()['Title'];

$theaterQuery = "SELECT Name FROM Theaters WHERE Theater_ID = '$theater_id'";
$theaterResult = $conn->query($theaterQuery);
$theaterName = $theaterResult->fetch_assoc()['Name'];

$sql = "UPDATE Users SET Booking_Count = Booking_Count + 1 WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind the user's ID
$stmt->execute();  // Add this line to execute the query
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
         .payment-confirmation {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        
        .payment-confirmation h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .payment-confirmation p {
            margin-bottom: 20px;
        }
        
        .payment-confirmation .details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .payment-confirmation .details div {
            flex-basis: 45%;
            margin-bottom: 20px;
        }
        
        .payment-confirmation .details div span {
            font-weight: bold;
              }  
    </style>
</head>
<body>
    <br><br>
    <div class="payment-confirmation">
        <h2>Payment Confirmation</h2>
        <p>Thank you for your payment!</p><br>
        <div class="details">
            <div>
                <span>Booking ID:</span> <?= $booking_id ?>
            </div>
            <div>
                <span>Payment ID:</span> <?= $payment_id ?>
            </div>
            <div>
                <span>Movie:</span> <?= $movieName ?>
            </div>
            <div>
                <span>Theater:</span> <?= $theaterName ?>
            </div>
            <div>
                <span>Show Date:</span> <?= $date ?>
            </div>
            <div>
                <span>Show Time:</span> <?= $show_time ?? 'Not Available' ?>
            </div>
            <div>
                <span>Number of Tickets:</span> <?= $numberOfSeats ?>
            </div>
            <div>
                <span>Seat Numbers:</span> <?= $seatNumbersString ?>
            </div>
            <div>
                <span>Total Amount:</span> <?= number_format($totalAmount, 2) ?>
            </div>
        </div><br>
        <p>Your ticket has been sent to your registered email and phone number.</p>
    </div><br><br>
    <?php include 'footer.php'; ?>
</body>
</html>
