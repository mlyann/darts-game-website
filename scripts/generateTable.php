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
        $overallCell = $playerIndex . "overallCell";
        $playerDiv = $playerIndex . "playerDiv";

        //get image
        $imgQuery = "SELECT image_url FROM users WHERE name = '$player';";
        $imgResult = mysqli_query($conn, $imgQuery);
        $imgRow = mysqli_fetch_assoc($imgResult);
        $img = $imgRow['image_url'];
        if ($img == '') {
            $img = "https://www.coretechs.com/wp-content/uploads/2020/08/Coretechs_Mark.png";
        }

        // echo '<tr>';
        // echo '<td class = "infoCell nameCell" id="' . $nameCell . '"> </td>';
        // echo '<td class = "infoCell scoreCell" id="' . $firstCell . '"></td>';
        // echo '<td class = "infoCell scoreCell" id="' . $secondCell . '"></td>';
        // echo '<td class = "infoCell scoreCell" id="' . $thirdCell . '"></td>';
        // echo '<td class = "infoCell scoreCell" id="' . $roundCell . '"></td>';
        // if ($gamemode == 'Highscore') {
        //     echo '<td class = "infoCell" id="' . $winsCell . '"></td>';
        // }
        // echo '</tr>';
        echo 
        '<div id = "' . $playerDiv . '">
            <div class = "topRow">
            <img class = "profile" src="' . $img . '">
                <p class = "name" id="' . $nameCell . '"></p>
                <p class = "overall" id="' . $overallCell . '"></p>
            </div>
            <table>
                <td class = "infoCell scoreCell" id="' . $firstCell . '"></td>
                <td class = "infoCell scoreCell" id="' . $secondCell . '"></td>
                <td class = "infoCell scoreCell" id="' . $thirdCell . '"></td>
                <td class = "infoCell scoreCell" id="' . $roundCell . '"></td>
            </table>
        </div>';
        $playerIndex += 1;
        
    }

    $conn->close();
?>