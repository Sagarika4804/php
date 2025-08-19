<?php
session_start();
$conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id); 
    
    if ($stmt->execute()) {
        echo "Post deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>Delete Post</h2>
<form method="post">
    <label>Enter Post ID:</label><br>
    <input type="number" name="id" required><br><br>
    
    <button type="submit" name="delete">Delete Post</button>
</form>
