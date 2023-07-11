<?php
    require 'connect.php';

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

    echo "var allPlayers = " . json_encode($playerNames) . ";";

    $conn->close();
?>
