<?php
              
              $turnScores = json_decode($_POST['turnScores']);
              $allPlayers = json_decode($_POST['allPlayers']);
              $playerTurn = $_POST['playerTurn'];
              
              $query = "UPDATE scores 
              SET 
                first = turnScores[0],
                second = turnScores[1],
                third = turnScores[2]
              WHERE Name = allPlayers[playerTurn]
                AND turn = (SELECT MAX(turn) FROM scores WHERE Name = allPlayers[playerTurn])";

            $result = mysqli_query($conn, $query);

            if(!$result){
                echo "Error updating turn scores:" . mysqli_error($conn);
            }
?>