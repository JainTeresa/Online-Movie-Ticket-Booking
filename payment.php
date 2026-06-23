<?php 
session_start(); 
include 'db.php'; 

$user_id = $_SESSION['User_ID'];

$movie_id = $_POST['movie_id'] ?? null; 
$theater_id = $_POST['theater_id'] ?? null; 
$show_id = $_POST['show_id'] ?? null; 
$date = $_POST['date'] ?? null; 
$show_time = $_POST['show_time'] ?? null; 
$totalAmount = $_POST['total_amount'] ?? 0; 
$selectedSeats = $_POST['selectedSeats'] ?? ''; 
$selectedSeatsArray = explode(',', $selectedSeats); 

$query = "SELECT Booking_Count FROM Users WHERE User_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $booking_count = $row['Booking_Count'];
} else {
    die("Error: User not found.");
}

$stmt->close();
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Payment - MovieFiesta</title> 
<link rel="stylesheet" href="css/style.css"> 
    <style> 
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px; 
        } 
        .back-button { 
            cursor: pointer; 
            margin-bottom: 20px; 
        } 
        .payment-form { 
            max-width: 400px; 
            margin: auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        } 
        .payment-form input { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        } 
        .payment-form button { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            background-color: #28a745; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        } 
        .payment-form button:hover { 
            background-color: #218838; 
        }
    </style>

</head>
<body>

    <img src="images/back-arrow.png" alt="Back" class="back-button" style="margin: 10px; width: 45px; height: 45px;" onclick="window.history.back();" /><br><br><br><br>

    <div class="payment-form">
        <h2 style="text-align:center;">Debit Card Payment</h2>
        <form action="payment_confirmation.php" method="POST" onsubmit="return validateForm();"> 
            <input type="text" name="card_number" id="card_number" placeholder="Card Number" maxlength="16" required> 
            <input type="text" name="card_holder" id="card_holder" placeholder="Card Holder Name" required> 
            <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required> 
            <input type="text" name="cvv" id="cvv" placeholder="CVV" maxlength="3" required> 
            
            <button type="submit">Pay Now</button> 
            
            <!-- Hidden fields to pass data --> 
            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>"> 
            <input type="hidden" name="theater_id" value="<?php echo htmlspecialchars($theater_id); ?>"> 
            <input type="hidden" name="show_id" value="<?php echo htmlspecialchars($show_id); ?>">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <input type="hidden" name="selectedSeats" value="<?php echo htmlspecialchars($selectedSeats); ?>">     
            <input type="hidden" name="show_time" value="<?php echo htmlspecialchars($show_time); ?>"> 
            <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($totalAmount); ?>">

        </form>
    </div>

    <script> 
        function validateForm() { 
            const cardNumber = document.getElementById('card_number').value; 
            const expiryDate = document.getElementById('expiry_date').value; 
            const cvv = document.getElementById('cvv').value; 
            
            // Validate card number (simple check) 
            if (!/^\d{16}$/.test(cardNumber)) { 
                alert("Invalid card number. Please enter a 16-digit card number."); 
                return false; 
            } 
            
            // Validate expiry date (MM/YY) 
            const [month, year] = expiryDate.split('/'); 
            const currentMonth = new Date().getMonth() + 1; // get current month (0-11) 
            const currentYear = new Date().getFullYear() % 100; // get current year (last two digits)
            if (!/^\d{2}$/.test(month) || !/^\d{2}$/. test(year) || month < 1 || month > 12) {
                alert("Invalid expiry date. Please enter a valid date in MM/YY format.");
                return false;
            } else if (year < currentYear || (year == currentYear && month < currentMonth)) {
                alert("Expired card. Please use a valid card with a future expiry date.");
                return false;
            }
            
            // Validate CVV
            if (!/^\d{3}$/.test(cvv)) {
                alert("Invalid CVV. Please enter a 3-digit CVV.");
                return false;
            }
            return true; // All validations passed
        }
    </script>
    
</body>
</html>


