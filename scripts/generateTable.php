<?php

    function appendRowofTwo($playersArray, &$output) {
        global $conn;
        global $playerIndex;
        global $gamemode;
        $html = 
        '<div class = "rowOfTwo">';
        $output = $output . $html;
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
            $profilePic = $playerIndex  . "profilePic";

            //get image
            $imgQuery = "SELECT image_url FROM users WHERE name = '$player';";
            $imgResult = mysqli_query($conn, $imgQuery);
            $imgRow = mysqli_fetch_assoc($imgResult);
            $img = $imgRow['image_url'];
            if ($img == '') {
                $img = "https://www.coretechs.com/wp-content/uploads/2020/08/Coretechs_Mark.png";
            }

            $html =  
            '<div class = "playerDiv reduced" id = "' . $playerDiv . '">
                <div class = "topRow">
                <img id = "' . $profilePic . '" class = "profile" src="' . $img . '">
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

            $output = $output . $html;
            $playerIndex++;
        }    
        $output = $output . '</div>';
    }

    require 'connect.php';

    //get starting points, players array, gamemode
    $sql = "SELECT starting_points, players, type, player_count, modified_order from game_data";
    $players = mysqli_query($conn, $sql);
    $row = $players->fetch_assoc();
    $playersArray = json_decode($row['players'], true);
    $starting_points = $row['starting_points'];
    $gamemode = $row['type'];
    $playerCount = $row['player_count'];
    $order = $row['modified_order'];

    if ($order != null) {
        $playersArray = explode(',', $order);
    }

    $playerIndex = 1;
    
    switch($playerCount) {
        case 1:
        case 2:
        case 3:
        case 4:
            $output = '';
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
                $profilePic = $playerIndex . "profilePic";
        
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
                    <img id = "' . $profilePic . '" class = "profile" src="' . $img . '">
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
        
                $output = $output . $html;
        
                $playerIndex++;
            }
            echo $output;
            break;
        case 5:
            $output = '';
            appendRowofTwo(array_slice($playersArray, 0, 2), $output);
            appendRowofTwo(array_slice($playersArray, 2, 2), $output);

            $html = '</div><div class = "currentOne">';
            $output = $output . $html;
            $lastPlayer = $playersArray[4];

                //assigns cell IDs
                $nameCell = $playerIndex . "nameCell";
                $firstCell = $playerIndex . "firstCell";
                $secondCell = $playerIndex . "secondCell";
                $thirdCell = $playerIndex . "thirdCell";
                $winsCell = $playerIndex . "winsCell";
                $roundCell = $playerIndex . "roundCell";
                $overallCell = $playerIndex . "overallCell";
                $playerDiv = $playerIndex . "playerDiv";
                $profilePic = $playerIndex . "profilePic";
        
                //get image
                $imgQuery = "SELECT image_url FROM users WHERE name = '$lastPlayer';";
                $imgResult = mysqli_query($conn, $imgQuery);
                $imgRow = mysqli_fetch_assoc($imgResult);
                $img = $imgRow['image_url'];
                if ($img == '') {
                    $img = "https://www.coretechs.com/wp-content/uploads/2020/08/Coretechs_Mark.png";
                }
        
                $html =  
                '<div class = "playerDiv full" id = "' . $playerDiv . '">
                    <div class = "topRow">
                    <img id = "' . $profilePic . '" class = "profile" src="' . $img . '">
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
        
                $output = $output . $html;
            
            $html = '</div>';
            $output = $output . $html;
            echo $output;
            break;
        case 6:
            $output = '';
            appendRowofTwo(array_slice($playersArray, 0, 2), $output);
            appendRowofTwo(array_slice($playersArray, 2, 2), $output);
            appendRowofTwo(array_slice($playersArray, 4, 2), $output);

            echo $output;
            break;

    }


    $conn->close();
?>