<?php
// Your PHP script that handles the database query

// Connect to the MySQL database
require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform your SQL query
$query = "SELECT currentPlayer FROM game_data";
$result = $conn->query($query);

// Fetch the data
$currentPlayer = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPlayer = $row['currentPlayer'];
}

//get index of currentplayer
require "getPlayerNames.php";

$currentPlayerIndex = array_search($currentPlayer, $playerNames);

// Close the database connection
$conn->close();

// Return the data as the response
echo $currentPlayerIndex;
?>
