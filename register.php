<?php
session_start();
$conn = new mysqli("localhost", "root", "", "blog");


if (isset($_SESSION["loggedin"])) {
    header("Location: posts.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id=trim($_POST['id']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Username already taken.";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
        $stmt = $conn->prepare("INSERT INTO users (id,username, password) VALUES (?,?, ?)");
        $stmt->bind_param("iss",$id,$username, $hashedPassword);

        if ($stmt->execute()) {
            $success = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 300px; margin: auto; }
        input { width: 100%; padding: 10px; margin: 5px 0; }
        button { padding: 10px 20px; width: 100%; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h2>Register</h2>

<?php
if (!empty($error)) echo "<p class='error'>$error</p>";
if (!empty($success)) echo "<p class='success'>$success</p>";
?>

<form method="POST">
        <input type="text" name="id" placeholder="id" required><br>

    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>