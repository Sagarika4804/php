<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<h2>User Page</h2>
<p>Welcome, regular user! You can view your profile here.</p>
<a href="role.php">Back</a>
