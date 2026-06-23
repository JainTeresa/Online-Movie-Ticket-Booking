<?php
include('header.php');
include('../db.php'); // Assuming this is the correct path for db connection


// Ensure the theater is logged in
if (!isset($_SESSION['theater_id'])) {
    echo "You are not logged in!";
    exit();
}

// Get the Theater_ID from the session
$theater_id = $_SESSION['theater_id'];

?>
<style>
/* General Styles */
.content-wrapper {
    padding: 20px;
    background-color: #f4f6f9;
}

.content-header h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
}

.breadcrumb {
    background-color: transparent;
    padding-left: 0;
}

.box {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.box-header {
    border-bottom: 2px solid #4CAF50;
    margin-bottom: 15px;
}

ul.todo-list {
    list-style-type: none;
    padding: 0;
}

.todo-list li {
    display: flex;
    align-items: left;
    justify-content: space-between;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    transition: background-color 0.3s;
}

.todo-list li:hover {
    background-color: #f1f1f1;
}

.handle {
    font-size: 1.2rem;
    color: #4CAF50;
    margin-right: 10px;
}

.text {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
    text-align: left;
}

.no-movies {
    font-size: 1.2rem;
    color: #666;
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Movies List</h1>
          </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box --> 
                               <ul class="todo-list">
                            <?php 
                            // Query to fetch movies only for this theater
                            $qry7 = mysqli_query($conn, "
                                SELECT Movies.Title 
                                FROM Movies
                                JOIN Shows ON Movies.Movie_ID = Shows.Movie_ID
                                WHERE Shows.Theater_ID = '$theater_id'
                                GROUP BY Movies.Movie_ID
                            ");

                            // Check if there are any movies for this theater
                            if (mysqli_num_rows($qry7)) {
                                while ($c = mysqli_fetch_array($qry7)) {
                            ?>
                            <li>
                                <!-- Display movie name -->
                                <span class="handle">
                                    <i class="fa fa-film"></i>
                                </span>
                                <span class="text"><?php echo $c['Title']; ?></span>
                            </li>
                            <?php
                                }
                            } else {
                                echo "<p>No movies are currently being shown in this theater.</p>";
                            }
                            ?>
                        </ul>

    </section>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include('footer.php'); ?>
