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
$query = "SELECT players FROM game_data";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Error getting players: " . mysqli_error($conn);
}

$playerNames = [];

while ($row = $result->fetch_assoc()) {
    $jsonNames = $row['players'];
    $namesArray = json_decode($jsonNames, true);
    
    if (is_array($namesArray)) {
        $playerNames = array_merge($playerNames, $namesArray);
    }
}

$currentPlayerIndex = array_search($currentPlayer, $playerNames);

$conn->close();

echo $currentPlayerIndex;
?>
