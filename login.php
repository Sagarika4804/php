<?php
session_start();
$conn = new mysqli("localhost", "root", "", "blog");

if (isset($_SESSION["loggedin"])) {
    header("Location: posts.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);   
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?"); // ✅ query by username
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {  
            
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $db_username;

            header("Location: posts.php"); 
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that username.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 300px; margin: auto; }
        input { width: 100%; padding: 10px; margin: 5px 0; }
        button { padding: 10px 20px; width: 100%; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Login</h2>

<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button><br/><br/>
    <a href="for.php">forgot password</a><br/>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>
