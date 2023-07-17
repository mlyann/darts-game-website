<?php
require 'connect.php';

$name = $_POST['name'];

$sql = "INSERT INTO game_data (currentPlayer) VALUES ('$name')";

if ($conn->query($sql) === TRUE) {
    echo "currentPlayer set successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
