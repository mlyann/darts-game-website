<?php
require 'connect.php';

//adds new turn rows for each player
function newTurns(){
    global $conn, $playerNames, $maxTurn, $bestPlayer;

    foreach($playerNames as $p){

        $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$p', 0, $maxTurn + 1)";  
        if(!mysqli_query($conn, $sql)){
            echo "Error: " . mysqli_error($conn);
        }
    }   

    //make winning player go first
    if ($bestPlayer) {
        $setFirstPlayerQuery = "UPDATE game_data SET dartIndex = '0', currentPlayer = '$bestPlayer', new_table_flag = true;";
        mysqli_query($conn, $setFirstPlayerQuery);
        $bestPlayerIndex = array_search($bestPlayer, $playerNames);
        echo 'Winning Player Index:' . $bestPlayerIndex;
        exit();
    }
}

function updatePlayerAverage($player) {
    global $conn;

    $scoresQuery = "SELECT overall, turn FROM scores WHERE Name = '$player' AND turn = (SELECT MAX(turn) FROM scores WHERE Name = '$player');";
    $scoresResult = mysqli_query($conn, $scoresQuery);
    $scoresRow = mysqli_fetch_assoc($scoresResult);
    $turn = $scoresRow['turn'];
    $overall = $scoresRow['overall'];

    $avg = round(($overall) / ($turn), 1);

//TODO THIS UPDATES EVERY COLUMN IT IS INEFFICIENT
    $avgQuery = "UPDATE scores SET average = $avg WHERE Name = '$player';";
    mysqli_query($conn, $avgQuery);
}

//get currentPlayer
$query = "SELECT currentPlayer FROM game_data";
$playerResult = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($playerResult);
$currentPlayer = $row['currentPlayer'];

updatePlayerAverage($currentPlayer);

//gets player names
require "getPlayerNames.php";

//gets current player index
$currentPlayerIndex = array_search($currentPlayer, $playerNames);

// Get the maximum turn value 
$query = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$maxTurn = $row['MAX(turn)'];

//get overall
$overallQuery = "SELECT overall FROM scores WHERE Name = '$currentPlayer' AND turn = $maxTurn";
$overallResult = mysqli_query($conn, $overallQuery);
$row = mysqli_fetch_assoc($overallResult);
$overall = $row['overall'];

// if each player has taken their turn
//taking a turn sets average, this is how we check if every player has gone
$allPlayersThrownQuery = "SELECT average FROM scores WHERE turn = (SELECT MAX(turn) FROM scores);";
$allPlayersThrownResult = mysqli_query($conn, $allPlayersThrownQuery);

if ($allPlayersThrownResult) {
    $allPlayersThrown = true;

    while ($row = mysqli_fetch_assoc($allPlayersThrownResult)) {
        if ($row['average'] === null) {
            $allPlayersThrown = false;
            break; // No need to continue checking if one value is null
        }
    }

} else {
    echo "allPlayersThrownQuery failed: " . mysqli_error($conn);
}


if ($allPlayersThrown) {
    
    //gets the highest scoring player and check for ties
    $query = "SELECT name, overall
    FROM scores
    WHERE turn = (SELECT MAX(turn) FROM scores)
    AND overall = (SELECT MAX(overall) FROM scores WHERE turn = (SELECT MAX(turn) FROM scores))
    ORDER BY overall DESC";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error getting the highest scoring player: " . mysqli_error($conn);
    }

    //if there is no tie - update round wins and check for winner
    if ($result && $result->num_rows === 1) {

        $row = $result->fetch_assoc();
        $bestPlayer = $row['name'];

        //update round wins table
        $query = "UPDATE roundWins SET roundWins = roundWins + 1 WHERE Name = '$bestPlayer'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Error updating round wins: " . mysqli_error($conn);
        }

        //gets the greatest number of round wins
        $query = "SELECT roundWins FROM roundWins WHERE name = '$bestPlayer'";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mostWins = $row['roundWins'];
        }

        //gets the number of rounds to win
        $query = "SELECT number_of_rounds FROM game_data";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $numRounds = $row['number_of_rounds'];
        }

        //winner
        if ($mostWins == $numRounds) {

            $sql = "INSERT INTO wins (name, time) VALUES ('$bestPlayer', NOW())";
            mysqli_query($conn, $sql);
            $conn->close();
            echo 'win';
            exit();
        }
    }
    newTurns();
}

$nextPlayer = $playerNames[($currentPlayerIndex + 1) % count($playerNames)];
$sql = "UPDATE game_data SET dartIndex = '0', currentPlayer ='$nextPlayer'";
mysqli_query($conn, $sql);


$conn->close();
?>