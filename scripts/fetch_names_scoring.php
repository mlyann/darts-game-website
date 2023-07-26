<?php
    require 'connect.php';

    //get players in the game
    $sql = "SELECT starting_points, players from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);
    $starting_points = $row['starting_points'];

    $gamemodeQuery = "SELECT type from game_data";
    $gamemodeResult = mysqli_query($conn, $gamemodeQuery);
    $row = $gamemodeResult->fetch_assoc();
    $gamemode = $row['type'];


    $playerIndex = 1;
    
    foreach ($playersArray as $player) {
        $nameCell = $playerIndex . "nameCell";
        $overallCell = $playerIndex . "overallCell";
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
        echo '<td class="infoCell scoreCell" id="' . $overallCell . '">' . $starting_points . '</td>';
        if ($gamemode == 'Highscore') {
            echo '<td class = "infoCell" id="' . $winsCell . '"></td>';
        }
        echo '</tr>';
        $playerIndex += 1;
        
    }

    $conn->close();
?>