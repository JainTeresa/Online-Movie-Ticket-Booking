<?php 
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
} 
include 'db.php'; 
include 'header.php';

// Fetch user information 
$userId = $_SESSION['User_ID']; 
$userQuery = "SELECT * FROM Users WHERE User_ID = ?"; 
$stmt = $conn->prepare($userQuery); 
$stmt->bind_param("i", $userId); 
$stmt->execute(); 
$userResult = $stmt->get_result(); 
$user = $userResult->fetch_assoc();

// Handle profile update 
if (isset($_POST['update_profile'])) { 
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $location = $_POST['location'];

    $updateQuery = "UPDATE Users SET Name = ?, Email = ?, Phone = ?, Location = ? WHERE User_ID = ?"; 
    $stmt = $conn->prepare($updateQuery); 
    $stmt->bind_param("ssssi", $name, $email, $phone, $location, $userId); 

    if ($stmt->execute()) { 
        $user['Name'] = $name; 
        $user['Email'] = $email; 
        $user['Phone'] = $phone; 
        $user['Location'] = $location; 
        echo "<script>alert('Profile updated successfully!');</script>"; 
    } else { 
        echo "<script>alert('Failed to update profile.');</script>"; 
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MovieFiesta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
              padding: 0;
              margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
                                 }
        
        .container {
            display: flex;
            justify-content: space-between;
            padding: 2rem;
            flex-wrap: wrap;
            
                             }                    
        
            .profile-details, .booking-history {
            width: 48%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: fit-content;
                    }

        .profile-details h3, .booking-history h3 {
            margin-bottom: 25px;
            text-align: center;
            color: #333;
        }
        .profile-details form input[type="text"],
        .profile-details form input[type ="email"],
        .profile-details form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .profile-details form button {
            color: #fff;
            border: none;
            margin: 0 auto;
            background-color: #27ae60;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .profile-details form button:hover {
            background-color: #2ecc71;
        }
        .booking-history ul {
            list-style: none;
            padding: 0;
        }
        .booking-history ul li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .options {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container" >
        <!-- Left side: Profile Details -->
        <section class="profile-details">
            <h3>Edit Your Profile</h3>
            <form method="POST" action="profile.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $user['Name']; ?>" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['Email']; ?>" required><br>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?= $user['Phone']; ?>"><br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?= $user['Location']; ?>"><br>
                <button type="submit" name="update_profile">Update Profile</button><br>
            </form>
        </section>
        <!-- Right side: Booking History -->
<section class="booking-history">
    <h3>Your Booking History</h3>
    <?php 
    $bookingQuery = "
        SELECT b.Booking_ID, m.Title, th.Name AS Theater_Name, s.Date, s.Time, b.Number_of_Tickets, b.Total_Amount 
        FROM Bookings b 
        JOIN Shows s ON b.Show_ID = s.Show_ID 
        JOIN Movies m ON b.Movie_ID = m.Movie_ID 
        JOIN Theaters th ON b.Theater_ID = th.Theater_ID 
        WHERE b.User_ID = '$userId' 
        ORDER BY b.Booking_Date DESC
    ";
    $bookingResult = $conn->query($bookingQuery);
    ?>
    
    <?php if ($bookingResult->num_rows > 0): ?>
        <ul class="booking-list">
            <?php while ($booking = $bookingResult->fetch_assoc()): ?>
                <li class="booking-item">
                    <div class="booking-details">
                        <h4><?= $booking['Title']; ?> (<?= $booking['Theater_Name']; ?>)</h4>
                        <p>Show Date: <?= $booking['Date']; ?></p>
                        <p>Show Time: <?= $booking['Time']; ?></p>
                        <p>Tickets: <?= $booking['Number_of_Tickets']; ?></p>
                        <p>Total Amount: ₹<?= $booking['Total_Amount']; ?></p>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You have no booking history.</p>
    <?php endif; ?>
</section>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>