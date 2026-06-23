<?php
session_start(); // Start the session

include('header.php');
include('../db.php');

// Check if the theater is logged in by verifying the session
if (!isset($_SESSION['theater_id'])) {
    echo "You are not logged in!";
    exit();
}

// Get the Theater_ID from the session
$theater_id = $_SESSION['theater_id'];

// Get today's date
$today = date('Y-m-d');

// Fetch today's shows only for the logged-in theater
$query = "
    SELECT Shows.Show_ID, Shows.Time, Movies.Title, Movies.Rating
    FROM Shows
    JOIN Movies ON Shows.Movie_ID = Movies.Movie_ID
    WHERE Shows.Date = '$today' 
    AND Shows.Theater_ID = '$theater_id'"; // Filter by Theater_ID

$result = mysqli_query($conn, $query);
?>
<style>
/* Add your existing CSS styling here */
.table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: #fff;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.05);
}

.thead-dark {
    background-color: #4CAF50;
    color: black;
}

.table th, .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.box {
    border: 1px solid #ddd;
    padding: 15px;
    background-color: #f9f9f9;
}

.box-header {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
}

h3 {
    font-size: 1.5rem;
    font-weight: bold;
}

.content-wrapper {
    padding: 20px;
}
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Shows for Today</h3>
            </div>
            <div class="box-body">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Show ID</th>
                                <th>Time</th>
                                <th>Movie Name</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['Show_ID']; ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['Time'])); ?></td>
                                    <td><?php echo $row['Title']; ?></td>
                                    <td><?php echo $row['Rating']; ?>/10</td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h3>No Shows Available Today for this Theater</h3>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div><br><br><br><br><br><br><br><br><br><br><br>

<?php include('footer.php'); ?>
