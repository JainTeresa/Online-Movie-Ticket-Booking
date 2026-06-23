<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <!-- Logo and Brand Text -->
    <div class="logo-container">
        <img src="images/logo.jpeg" alt="MovieFiesta Logo" class="logo">
        <div class="brand-text">
            <h1>MovieFiesta</h1>
            <p>Your Movie Escape!</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav>
        <ul class="nav-links">
            <li><a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Home</a></li>
        <li><a href="movies.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'movies.php') ? 'active' : ''; ?>">Movies</a></li>
            <?php if (isset($_SESSION['User_ID'])): ?>
                <li><a href="profile.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>">Profile</a></li>
        <li><a href="logout.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : ''; ?>">Login</a></li>
        <li><a href="register.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'active' : ''; ?>">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Search Bar -->
    <div class="search-bar-container">
        <form action="searchbar.php" method="GET">
            <input type="text" name="query" placeholder="Search for movies..." class="search-bar" required>
            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>
</header>
