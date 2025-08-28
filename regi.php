<?php
session_start();
include "pdo.php";
include "val.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = sanitize_input($_POST['id']);
    $username = sanitize_input($_POST['email']); 
    $password = $_POST['password'];
    $role = "";

    
    if (!validate_password($password)) {
        die("Password must be at least 6 characters long");
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $pdo->prepare("INSERT INTO users (id, username, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$id, $username, $hashedPassword, $role])) {
        header("Location: login.php?success=1");
        exit;
    } else {
        echo "Error registering user.";
    }
}
?>


<form method="POST">
    User ID: <input type="text" name="id" required><br><br>
    Username (Email): <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
        role: <input type="text" name="role" required><br><br>


    <button type="submit">Register</button>
</form>
