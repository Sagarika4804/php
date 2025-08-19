<?php
$servername = "localhost";   
$username = "root";          
$password = "";    
$database="blog";          


$conn = new mysqli($servername, $username, $password,$database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE users (
    id INT PRIMARY KEY,
    username VARCHAR(100) NOT NULL unique,
    password VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "table created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>