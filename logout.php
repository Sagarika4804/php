<?php
session_start();
session_unset();   
session_destroy(); 

echo "Logout successful!";
echo "<br><a href='login.php'>Login Again</a>";
?>
