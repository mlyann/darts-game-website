<?php
    require 'connect.php';

    //get dartIndex
    $sql = "SELECT dartIndex FROM game_data";
    $indexResult = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($indexResult);
    $dartIndex = $row['dartIndex'];

    if ($dartIndex >= 3) {
        $conn->close();
        return;
    }

    //get score and lastMult
    $score = $_POST['score'];
    $multiplierValue = $_POST['multiplierValue'];

    //get currentPlayer
    $sql = "SELECT currentPlayer FROM game_data";
    $playerResult = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($playerResult);
    $currentPlayer = $row['currentPlayer'];

    //select correct column in scores
    $columnNames = ['first', 'second', 'third'];
    $column = $columnNames[$dartIndex];
    
    //get the maximum turn value 
    $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
    $result = mysqli_query($conn, $subQuery);
    $row = mysqli_fetch_assoc($result);
    $maxTurn = $row['MAX(turn)'];
    
    //update dart column
    $dartQuery = "UPDATE scores SET $column = $score WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $dartQuery);

    //update overall column
    $overallQuery = "UPDATE scores SET overall = COALESCE(overall, 0) - COALESCE($column, 0) WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $overallQuery);

    //increment dartIndex
    $indexQuery = "UPDATE game_data SET dartIndex = dartIndex + 1";
    mysqli_query($conn, $indexQuery);

    //update lastMult column
    $lastMultQuery = "UPDATE scores SET lastMult = $multiplierValue WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $lastMultQuery);

    $conn->close();
?>
