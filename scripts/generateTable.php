<?php
    require 'connect.php';

    //get info from game_data
    $sql = "SELECT starting_points, players from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);
    $starting_points = $row['starting_points'];
    $gamemode = $row['type'];

    $playerIndex = 1;
    
    foreach ($playersArray as $player) {
        $nameCell = $playerIndex . "nameCell";
        $firstCell = $playerIndex . "firstCell";
        $secondCell = $playerIndex . "secondCell";
        $thirdCell = $playerIndex . "thirdCell";
        $winsCell = $playerIndex . "winsCell";
        $roundCell = $playerIndex . "roundCell";
        echo '<tr>';
        echo '<td class = "infoCell nameCell" id="' . $nameCell . '"> </td>';
        echo '<td class = "infoCell scoreCell" id="' . $firstCell . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $secondCell . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $thirdCell . '"></td>';
        echo '<td class = "infoCell scoreCell" id="' . $roundCell . '"></td>';
        if ($gamemode == 'Highscore') {
            echo '<td class = "infoCell" id="' . $winsCell . '"></td>';
        }
        echo '</tr>';
        $playerIndex += 1;
        
    }

    $conn->close();
?>