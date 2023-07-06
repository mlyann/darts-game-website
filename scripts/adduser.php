<?php
require 'connect.php';

$name = $_POST['name'];

$sql = "INSERT INTO users (name) VALUES ('$name')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
