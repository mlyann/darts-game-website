<?php

require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//gets current player
$query = "SELECT currentPlayer, modified_order FROM game_data;";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentPlayer = $row['currentPlayer'];
    $modified_order = $row['modified_order'];
}

//get index of currentplayer
require "getPlayerNames.php";
if ($modified_order == null) {
    $currentPlayerIndex = array_search($currentPlayer, $playerNames);
} else {
    $modifiedPlayerNames = explode(',', $modified_order);
    $currentPlayerIndex = array_search($currentPlayer, $modifiedPlayerNames);
}

$conn->close();

echo $currentPlayerIndex;
?>
