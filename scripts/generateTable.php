<?php
    require 'connect.php';

    //get starting points, players array, gamemode
    $sql = "SELECT starting_points, players, type from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);
    $starting_points = $row['starting_points'];

    $playerIndex = 1;
    
    foreach ($playersArray as $player) {
        
        //assigns cell IDs
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

        $html =  
        '<div class = "playerDiv" id = "' . $playerDiv . '">
            <div class = "topRow">
            <img class = "profile" src="' . $img . '">
                <p class = "name" id="' . $nameCell . '"></p>
                <p class = "overall" id="' . $overallCell . '"></p>
            </div>
            <table class = "bottomRow">
                <td class = "infoCell scoreCell" id="' . $firstCell . '"></td>
                <td class = "infoCell scoreCell" id="' . $secondCell . '"></td>
                <td class = "infoCell scoreCell" id="' . $thirdCell . '"></td>
                <td class = "infoCell bigCell " id="' . $roundCell . '"></td>
            </table>
        </div>';

        //adds the round wins tag
        if($gamemode == 'Highscore'){

            $rWinsCell = $playerIndex . "roundWinsCell";
            $pt = strpos($html,"/p>") + 3;
            $html = substr($html,0,$pt) . '<p class = "roundWins" id="'.$rWinsCell.'"></p>' . substr($html,$pt);
        }

        echo $html;

        $playerIndex++;
    }

    $conn->close();
?>