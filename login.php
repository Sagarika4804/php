<?php
session_start();
include "pdo.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['username'] = $user['username'];
        $_SESSION['age'] = $user['age'];  
        $_SESSION['logged_in'] = true;

        header("Location: dash.php"); 
        exit;
    } else {
        echo "Invalid username or password!";
    }
}
?>


<form method="POST">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
