<?php
$servername = "localhost";   
$username = "root";          
$password = "";    
$database="blog";          

$conn = new mysqli($servername, $username, $password,$database);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE posts (
    id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATE
)";

if ($conn->query($sql) === TRUE) {
    echo "table created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
