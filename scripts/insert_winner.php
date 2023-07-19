<?php
require 'connect.php';

$name = $_POST['name'];

$sql = "INSERT INTO wins (name, time) VALUES ('$name', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "User won successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
