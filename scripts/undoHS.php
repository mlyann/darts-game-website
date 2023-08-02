<?php
    require 'connect.php';

    //get dartIndex
    $sql = "SELECT dartIndex, currentPlayer FROM game_data";
    $indexResult = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($indexResult);
    $dartIndex = $row['dartIndex'];

    if($dartIndex > 0){

        //get currentPlayer
        $currentPlayer = $row['currentPlayer'];

        //select correct column in scores
        $columnNames = ['first', 'second', 'third'];
        $column = $columnNames[$dartIndex - 1];
        
        //get the maximum turn value 
        $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
        $result = mysqli_query($conn, $subQuery);
        $row = mysqli_fetch_assoc($result);
        $maxTurn = $row['MAX(turn)'];
        
        //update overall column
        $overallQuery = "UPDATE scores 
            SET overall = COALESCE(overall, 0) - COALESCE($column, 0), $column = NULL 
            WHERE Name = '$currentPlayer' AND turn = $maxTurn";
        mysqli_query($conn, $overallQuery);

        //decrement dartIndex
        $indexQuery = "UPDATE game_data SET dartIndex = dartIndex - 1";
        mysqli_query($conn, $indexQuery);
    }

    $conn->close();
?>
