<?php
    require 'connect.php';

    //get game_data
    $sql = "SELECT dartIndex, currentPlayer FROM game_data";
    $indexResult = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($indexResult);
    $dartIndex = $row['dartIndex'];
    $currentPlayer = $row['currentPlayer'];

    if ($dartIndex >= 3) {
        $conn->close();
        return;
    }

    //get score and lastMult
    $score = $_POST['score'];
    $multiplierValue = $_POST['multiplierValue'];

    //select correct column in scores
    $columnNames = ['first', 'second', 'third'];
    $column = $columnNames[$dartIndex];
    
    //get the maximum turn value 
    $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
    $result = mysqli_query($conn, $subQuery);
    $row = mysqli_fetch_assoc($result);
    $maxTurn = $row['MAX(turn)'];
    
    //update dart and overall column
    $dartQuery = "UPDATE scores 
        SET $column = $score, overall = COALESCE(overall, 0) - COALESCE($column, 0), lastMult = $multiplierValue
        WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $dartQuery);

    //checck victory condition
    if ($multiplierValue == 2) {
        $winQuery = "SELECT overall FROM scores WHERE Name = '$currentPlayer' AND turn = $maxTurn;";
        $winResult = mysqli_query($conn, $winQuery);
        $winRow = mysqli_fetch_assoc($winResult);
        $overall = $winRow['overall'];
        if ($overall == 0) {
            //set average
            $getWinnerAvgQuery = "SELECT average FROM scores WHERE Name = '$currentPlayer' AND turn = 1;";
            $getWinnerAvgResult = mysqli_query($conn, $getWinnerAvgQuery);
            $getWinnerAvgRow = mysqli_fetch_assoc($getWinnerAvgResult);
            $winnerAvg = $getWinnerAvgRow['average'];

            $getWinningTurnScoreQuery = "SELECT SUM(COALESCE(first, 0) + COALESCE(second, 0) + COALESCE(third, 0)) AS score
                                        FROM scores WHERE Name = '$currentPlayer' AND overall = 0;";
            $getWinningTurnScoreResult = mysqli_query($conn, $getWinningTurnScoreQuery);
            $getWinningTurnScoreRow = mysqli_fetch_assoc($getWinningTurnScoreResult);
            $winningTurnScore = $getWinningTurnScoreRow['score'];

            $getWinningTurnQuery = "SELECT turn FROM scores WHERE Name = '$currentPlayer' AND overall = 0;";
            $getWinningTurnResult = mysqli_query($conn, $getWinningTurnQuery);
            $getWinningTurnRow = mysqli_fetch_assoc($getWinningTurnResult);
            $winningTurn = $getWinningTurnRow['turn'];

            $avg = ($winnerAvg + $winningTurnScore) / $winningTurn;

            $winnerAvgQuery = "UPDATE scores SET average = $avg WHERE Name = '$currentPlayer';";
            mysqli_query($conn, $winnerAvgQuery);

            //update wins
            $sql = "INSERT INTO wins (name, time) VALUES ('$currentPlayer', NOW())";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$currentPlayer', -353, 999)";
            mysqli_query($conn, $sql);
            echo 'win';
            
        }
    }
    

    //increment dartIndex
    $indexQuery = "UPDATE game_data SET dartIndex = dartIndex + 1";
    mysqli_query($conn, $indexQuery);

    $conn->close();
?>
