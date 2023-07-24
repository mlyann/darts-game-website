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
    switch($dartIndex) {
        case '0':
            $column = 'first';
            break;
        case '1':
            $column = 'second';
            break;
        case '2':
            $column = 'third';
            break;
    }

    // Get the maximum turn value 
    $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
    $result = mysqli_query($conn, $subQuery);
    $row = mysqli_fetch_assoc($result);
    $maxTurn = $row['MAX(turn)'];

    //update dart column
    $dartQuery = "UPDATE scores SET $column = $score WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $dartQuery);

    //update overall column
    switch($column) {
        case 'first':
            $overallQuery = "UPDATE scores SET overall = COALESCE(overall,0) - COALESCE(first,0) WHERE Name = '$currentPlayer' AND turn = $maxTurn";
            break;
        case 'second':
            $overallQuery = "UPDATE scores SET overall = COALESCE(overall,0) - COALESCE(second,0) WHERE Name = '$currentPlayer' AND turn = $maxTurn";
            break;
        case 'third':
            $overallQuery = "UPDATE scores SET overall = COALESCE(overall,0) - COALESCE(third,0) WHERE Name = '$currentPlayer' AND turn = $maxTurn";
            break;
    }
    mysqli_query($conn, $overallQuery);

    //increment dartIndex
    $indexQuery = "UPDATE game_data SET dartIndex = dartIndex + 1";
    mysqli_query($conn, $indexQuery);

    //update lastMult column
    $lastMultQuery = "UPDATE scores SET lastMult = $multiplierValue WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $lastMultQuery);

    $conn->close();
?>
