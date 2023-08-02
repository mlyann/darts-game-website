<?php
    require 'connect.php';

    //get dartIndex
    $sql = "SELECT dartIndex, currentPlayer FROM game_data";
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

    //select correct column in scores
    $columnNames = ['first', 'second', 'third'];
    $column = $columnNames[$dartIndex];
    
    //get the maximum turn value 
    $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
    $result = mysqli_query($conn, $subQuery);
    $row = mysqli_fetch_assoc($result);
    $maxTurn = $row['MAX(turn)'];
    
    //update scores table
    $dartQuery = "UPDATE scores 
        SET $column = $score, overall = COALESCE(overall, 0) + COALESCE($column, 0), lastMult = $multiplierValue
        WHERE Name = '$currentPlayer' AND turn = $maxTurn";
    mysqli_query($conn, $dartQuery);

    //increment dartIndex
    $indexQuery = "UPDATE game_data SET dartIndex = dartIndex + 1";
    mysqli_query($conn, $indexQuery);



    $conn->close();
?>