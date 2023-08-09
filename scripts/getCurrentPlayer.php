<?php

require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//gets current player
$query = "SELECT currentPlayer FROM game_data";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPlayer = $row['currentPlayer'];
}

//get index of currentplayer
require "getPlayerNames.php";

$currentPlayerIndex = array_search($currentPlayer, $playerNames);

$conn->close();

echo $currentPlayerIndex;
?>
