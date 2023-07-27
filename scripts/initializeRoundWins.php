<?php
//get players
$query = "SELECT players FROM game_data";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error getting players: " . mysqli_error($conn);
}

$playerNames = [];

while ($row = $result->fetch_assoc()) {
    $jsonNames = $row['players'];
    $namesArray = json_decode($jsonNames, true);
    
    if (is_array($namesArray)) {
        $playerNames = array_merge($playerNames, $namesArray);
    }
}

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