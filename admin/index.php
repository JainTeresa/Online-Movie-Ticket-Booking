<?php
include('header.php');
include('../db.php'); // Include your database connection

// Fetch theater list from the database
$query = "SELECT * FROM Theaters";
$result = $conn->query($query);
?>
<link rel="stylesheet" href="../css/adminstyle.css">

<div class="content-wrapper">
    <section>
    <h1 style="font-size: 28px; margin-bottom: 30px; background-color: #4CAF50; padding: 15px; border-radius: 5px; color: white;">Theater List</h1>
      </section>

  <!-- Content -->
  <div class="content">
    <div class="box">
      <div class="box-body">
        <?php if ($result->num_rows > 0): ?>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Theater ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Price</th>
                   </tr>
            </thead>
            <tbody>
              <?php while ($theater = $result->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $theater['Theater_ID']; ?></td>
                  <td><?php echo htmlspecialchars($theater['Name']); ?></td>
                  <td><?php echo htmlspecialchars($theater['Location']); ?></td>
                  <td><?php echo htmlspecialchars($theater['Capacity']); ?></td>
                  <td><?php echo htmlspecialchars($theater['Price']); ?></td>
                                  </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No theaters found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div><br><br><br><br><br><br>

<?php include('footer.php'); ?>

<script>
function del(theaterId) {
  if (confirm("Are you sure you want to delete this theater?")) {
    window.location = "delete_theater.php?id=" + theaterId; // Redirect to your delete script
  }
}
</script>
