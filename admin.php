<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    echo "⛔ Access Denied. Admins only.";
    exit;
}
?>
<h2>Admin Dashboard</h2>
<p>Only admins can see this page.</p>
<a href="role.php">Back</a>
