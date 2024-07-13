<?php
// Connect to the MySQL database
require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get players
$sql = "SELECT players from game_data";
$players = mysqli_query($conn, $sql);
$row = $players->fetch_assoc();
$playersArray = $row['players'];

// Return the data as the response
echo $playersArray;

// Close the database connection
$conn->close();
?>
