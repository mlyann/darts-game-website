<?php

    require 'connect.php';

    $query = "SELECT JSON_UNQUOTE(players) AS name FROM game_data WHERE ID=1";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "Error getting players:" . mysqli_error($conn);
    }

    $playerNames = [];

    while ($row = $result->fetch_assoc()){

        $playerNames[] = $row['name'];
    }

    $jsonArr = json_encode($playerNames);
    echo "var allPlayers = $jsonArr";

    $conn->close();
?>
