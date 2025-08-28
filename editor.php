<?php
session_start();
if (!isset($_SESSION['logged_in']) || !in_array($_SESSION['role'], ['admin','editor'])) {
    echo "⛔ Access Denied. Editors or Admins only.";
    exit;
}
?>
<h2>Editor Page</h2>
<p>Editors and Admins can edit content here.</p>
<a href="role.php">Back</a>
