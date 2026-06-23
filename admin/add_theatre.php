<?php
include('header.php');
include('../db.php'); // Your database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Password encryption

    // Validate form inputs
    $errors = [];
    if (empty($name)) $errors[] = 'Theater name is required.';
    if (empty($location)) $errors[] = 'Location is required.';
    if (empty($capacity) || !is_numeric($capacity)) $errors[] = 'Capacity must be a valid number.';
    if (empty($price) || !is_numeric($price)) $errors[] = 'Price must be a valid number.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($password)) $errors[] = 'Password is required.';

    // If no validation errors, insert the theater details into the database
    if (empty($errors)) {
        $query = "INSERT INTO Theaters (Name, Location, Capacity, Price, Email, Password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssisss", $name, $location, $capacity, $price, $email, $password);

        if ($stmt->execute()) {
            $success_message = "Theater added successfully!";
        } else {
            $error_message = "Error adding theater: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<link rel="stylesheet" href="../css/adminstyle.css">
<style>
/* General styles for the admin panel */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

.content-wrapper {
    padding: 20px;
    margin-left: 240px; /* Adjust if sidebar width changes */
}

.content-header {
    background-color: #4CAF50;
    padding: 20px;
    border-radius: 5px;
    color: white;
    margin-bottom: 20px;
}

.content-header h1 {
    margin: 0;
    font-size: 24px;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
    list-style: none;
}

.breadcrumb li {
    display: inline;
    font-size: 14px;
}

.breadcrumb li a {
    color: white;
    text-decoration: none;
}

.breadcrumb li::after {
    content: " / ";
    color: white;
}

.breadcrumb li:last-child::after {
    content: "";
}

/* Box layout */
.box {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.box-header {
    margin-bottom: 20px;
}

.box-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

/* Form styling */
form {
    width: 100%;
}

form .form-group {
    margin-bottom: 15px;
}

form label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

form input, form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

form input:focus, form select:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Button styling */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

table th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
}

table td {
    background-color: #f9f9f9;
}

/* Modal styles */
.modal-header {
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.modal-title {
    margin: 0;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 10px;
    text-align: right;
    border-top: 1px solid #ddd;
}

.modal-footer button {
    margin-left: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
        padding: 15px;
    }

    form input, form select, button {
        width: 100%;
    }
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Theater</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Theater Details</h3>
            </div>

            <div class="box-body">
                <!-- Display validation errors -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Success message -->
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <!-- Theater form -->
                <form method="POST" action="add_theatre.php">
                    <div class="form-group">
                        <label for="name">Theater Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo isset($location) ? $location : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="<?php echo isset($capacity) ? $capacity : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Ticket Price</label>
                        <input type="number" name="price" class="form-control" value="<?php echo isset($price) ? $price : ''; ?>" required>
                    </div>

                    <!-- Admin Username and Password -->
                    <div class="form-group">
                        <label for="email">Usename</label>
                        <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Theater</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
