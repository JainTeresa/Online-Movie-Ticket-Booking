<?php
include('header.php');
include('../db.php'); // Include your database connection file

// Initialize variables for validation
$title = $cast = $release_date = $description = $poster_url = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["name"]))) {
        $errors[] = "Movie name is required.";
    } else {
        $title = trim($_POST["name"]);
    }

    // Validate cast
    if (empty(trim($_POST["cast"]))) {
        $errors[] = "Cast is required.";
    } else {
        $cast = trim($_POST["cast"]);
    }

    // Validate release date
    if (empty(trim($_POST["date"]))) {
        $errors[] = "Release date is required.";
    } else {
        $release_date = trim($_POST["date"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $errors[] = "Description is required.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Handle file upload for the poster image
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $target_dir = "uploads/"; // Specify your upload directory
        $poster_url = $target_dir . basename($_FILES["attachment"]["name"]);
        move_uploaded_file($_FILES["attachment"]["tmp_name"], $poster_url);
    } else {
        $errors[] = "Poster image is required.";
    }

    // If there are no errors, proceed to insert data into the database
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO Upcoming_Movies (Title, Release_Date, Poster_URL, Cast) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $release_date, $poster_url, $cast]);
        header("Location: upcoming_movie.php?success=1"); // Redirect on success
        exit();
    }
}
?>

<link rel="stylesheet" href="css/adminstyle.css"> <!-- Add your stylesheet -->
<style>
  /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.content-wrapper {
    padding: 20px;
    margin-left: 240px; /* Adjust if sidebar width changes */
}

/* Header Styles */
.content-header {
    background-color: #4CAF50;    
    margin-bottom: 20px;
    padding-bottom: 10px;
}

.content-header h1 {
    font-size: 24px;
    color: white;
}

/* Breadcrumbs */
.breadcrumb {
    background: none;
    padding: 0;
    margin: 10px 0;
}

/* Form Styles */
.form-group {
    margin-bottom: 15px;
}

.form-control {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    width: 100%;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.control-label {
    font-weight: bold;
    margin-bottom: 10px;
}

/* Button Styles */
.btn {
    background-color: #28a745;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #218838;
}

/* Alert Styles */
.alert {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.alert ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.alert li {
    margin-bottom: 5px;
}

/* Box Styles */
.box {
    margin: 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px;
}

.box-body {
    padding: 15px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Upcoming Movies</h1>
            </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="upcoming_movie.php" method="post" enctype="multipart/form-data" id="form1">
                    <div class="form-group">
                        <label class="control-label">Movie Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($title); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cast</label>
                        <input type="text" name="cast" class="form-control" value="<?php echo htmlspecialchars($cast); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Release Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($release_date); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($description); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Poster Image</label>
                        <input type="file" name="attachment" class="form-control" placeholder="Images" required style="padding: 3px;">
                    </div>
                    <br><div class="form-group">
                        <button class="btn btn-success">Add Movie</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
include('footer.php');
?>
