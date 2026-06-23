<?php
include('header.php');
include('../db.php'); // Ensure the correct path for database connection

// Ensure admin or theater is logged in
if (!isset($_SESSION['theater_id']) && !isset($_SESSION['admin_id'])) {
    echo "You are not logged in!";
    exit();
}

?>

<style>
    /* Main container styling */
    .content {
        max-width: 800px;
        margin: 0 auto;
        background-color: #f4f6f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header styling */
    .content-header h1 {
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Form styling */
    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    select.form-control, input.form-control {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-control:focus {
        outline: none;
        border-color: #5cb85c;
        box-shadow: 0 0 5px rgba(92, 184, 92, 0.5);
    }

    /* Button styling */
    .btn-success {
        background-color: #5cb85c;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #4cae4c;
    }

    /* General layout adjustments */
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    /* Mobile responsiveness */
    @media (max-width: 600px) {
        .content {
            padding: 15px;
        }

        .btn-success {
            width: 100%;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<section class="content-header">
    <h1>Add Show</h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box --> 
    <div class="box">
        <div class="box-body">
            <form action="process_addshow.php" method="post" id="addShowForm">
                <!-- Select Movie -->
                <div class="form-group">
                    <label class="control-label">Select Movie</label>
                    <select name="movie" class="form-control" required>
                        <option value="">Select Movie</option>
                        <?php
                        // Fetch available movies
                        $movies = mysqli_query($conn, "SELECT * FROM Movies");
                        while ($movie = mysqli_fetch_array($movies)) {
                            echo "<option value='" . $movie['Movie_ID'] . "'>" . $movie['Title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Select Theater -->
                <div class="form-group">
                    <label class="control-label">Select Theater</label>
                    <select name="theater" class="form-control" required>
                        <option value="">Select Theater</option>
                        <?php
                        // Fetch theaters
                        $theaters = mysqli_query($conn, "SELECT * FROM Theaters");
                        while ($theater = mysqli_fetch_array($theaters)) {
                            echo "<option value='" . $theater['Theater_ID'] . "'>" . $theater['Name'] . " - " . $theater['Location'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Select Show Time -->
                <div class="form-group">
                    <label class="control-label">Select Show Time</label>
                    <select name="stime" class="form-control" required>
                        <option value="">Select Show Time</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="16:00">4:00 PM</option>
                        <option value="19:00">7:00 PM</option>
                        <option value="22:00">10:00 PM</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div class="form-group">
                    <label class="control-label">Start Date</label>
                    <input type="date" name="sdate" class="form-control" min="<?= date('Y-m-d'); ?>" required />
                </div>

                <!-- Available Seats -->
                <div class="form-group">
                    <label class="control-label">Available Seats</label>
                    <input type="number" name="available_seats" class="form-control" min="1" max="500" required />
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Show</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
// Front-end validation (optional, as HTML5 validations are already present)
document.getElementById('addShowForm').addEventListener('submit', function (event) {
    const form = event.target;
    if (!form.checkValidity()) {
        event.preventDefault();
        alert('Please fill in all required fields correctly.');
    }
});
</script>

<?php
include('footer.php');
?>
