<?php
//get players
require "getPlayerNames.php";

//clear roundWins table
$query = "DELETE FROM roundWins";
$result = mysqli_query($conn, $query);

if(!$result){
    echo "Error clearing roundWins table: " . mysqli_error($conn);
}

//initialize roundWins table with each player having zero wins
foreach($playerNames as $playerName){
    $query = "INSERT INTO roundWins (Name, roundWins) VALUES ('$playerName', 0)";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "Error adding a new row in roundWins: ". mysqli_error($conn);
    }
}

?>