<?php
    require 'connect.php';

    //get players in the game
    $sql = "SELECT players from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);

    $playerIndex = 1;
    
    foreach ($playersArray as $player) {
        $id = $playerIndex . "nameCell";
        $overallCell = $playerIndex . "overallCell";
        $firstCell = $playerIndex . "firstCell";
        $secondCell = $playerIndex . "secondCell";
        $thirdCell = $playerIndex . "thirdCell";
        echo '<tr>';
        echo '<td class = "infoCell" id="' . $id . '"></td>';
        echo '<td class = "infoCell" id="' . $overallCell . '"></td>';
        echo '<td class = "infoCell" id="' . $firstCell . '"></td>';
        echo '<td class = "infoCell" id="' . $secondCell . '"></td>';
        echo '<td class = "infoCell" id="' . $thirdCell . '"></td>';
        echo '</tr>';
        $playerIndex += 1;
        
    }

    $conn->close();
?>