<?php
    require 'connect.php';

    //get info from game_data
    $sql = "SELECT starting_points, players, type from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);
    $starting_points = $row['starting_points'];
    $gamemode = $row['type'];

    $playerIndex = 1;
    
    foreach ($playersArray as $player) {

        echo '<tr>';
        echo '<td class = "infoCell nameCell" id="' . $playerIndex . "nameCell" . '"> </td>';
        echo '<td class = "infoCell scoreCell" id="' . $playerIndex . "firstCell" . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $playerIndex . "secondCell" . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $playerIndex . "thirdCell" . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $playerIndex . "roundCell" . '"></td>';
        echo '</tr>';

        $playerIndex++;
    }

    $conn->close();
?>