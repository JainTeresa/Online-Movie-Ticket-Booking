<?php
include('header.php');
include('../db.php');
?>
<style>
.content-wrapper {
    padding: 20px;
    }

 .form-group label {
    font-weight: bold;
    color: #333;
}
.form-control {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn-success {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-success:hover {
    background-color: #218838;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <ol class="breadcrumb">
            <h3><li class="active">Add Movie</li></h3>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form action="process_add_movie.php" method="post" enctype="multipart/form-data" id="add-movie-form">
                    <!-- Movie Title -->
                    <div class="form-group">
                        <label for="title">Movie Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <!-- About/Description -->
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Release Date -->
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" name="release_date" class="form-control" required>
                    </div>

                    <!-- Duration -->
                    <div class="form-group">
                        <label for="duration">Duration (in minutes)</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>

                    <!-- Genre -->
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" class="form-control" required>
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        <label for="rating">Rating (out of 10)</label>
                        <input type="number" step="0.1" name="rating" class="form-control" required>
                    </div>

                    <!-- Cast -->
                    <div class="form-group">
                        <label for="cast">Cast</label>
                        <input type="text" name="cast" class="form-control" required>
                    </div>

                    <!-- Crew -->
                    <div class="form-group">
                        <label for="crew">Crew</label>
                        <input type="text" name="crew" class="form-control" required>
                    </div>

                    <!-- Poster URL -->
                    <div class="form-group">
                        <label for="poster_url">Poster URL</label>
                        <input type="text" name="poster_url" class="form-control" required>
                    </div>

                    <!-- Trailer URL -->
                    <div class="form-group">
                        <label for="trailer_url">Trailer YouTube Link</label>
                        <input type="url" name="trailer_url" class="form-control" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Movie</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div><br><br><br>

<?php include('footer.php'); ?>
