<?php
session_start();
$conn = new mysqli("localhost", "root", "", "blog");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];   
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = $_POST['created_at']; 

    
    $stmt = $conn->prepare("INSERT INTO posts (id, title, content, created_at) VALUES (?, ?, ?, ?)"); // ✅ 4 placeholders
    $stmt->bind_param("isss", $id, $title, $content, $created_at); 
    
    if ($stmt->execute()) {
        echo "Post added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>Add New Post</h2>
<form method="post">
    <label>id:</label><br>
    <input type="text" name="id" required><br><br>
    
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>
    
    <label>Content:</label><br>
    <textarea name="content" rows="5" cols="30" required></textarea><br><br>
    
    <label>Created At:</label><br>
    <input type="date" name="created_at"><br><br>
    
    <button type="submit" name="submit">Add Post</button>
</form>
