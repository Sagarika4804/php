<?php
session_start();

// Protect page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<h2>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>You have logged in successfully.</p>
<p>Your Age: <?php echo htmlspecialchars($_SESSION['age']); ?></p>

<a href="logout.php">Logout</a>
