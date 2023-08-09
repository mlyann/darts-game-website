<?php
require 'connect.php';

//create a new turn for the next player
function newTurn(){
    global $conn, $currentPlayer, $playerNames, $currentPlayerIndex, $maxTurn, $overall;

    $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$currentPlayer', $overall, $maxTurn + 1)";
    mysqli_query($conn, $sql);
        
    //updates game_data to create a new turn
    if ($currentPlayerIndex == (count($playerNames) - 1)) {
        $nextPlayer = $playerNames[0];
    } else {
        $nextPlayer = $playerNames[$currentPlayerIndex + 1];
    }
    $sql = "UPDATE game_data SET dartIndex = '0', currentPlayer ='$nextPlayer'";
    mysqli_query($conn, $sql);
    //reset player scores for highscore
    $resetQuery = "UPDATE scores AS s1
    JOIN (SELECT MAX(turn) AS max_turn FROM scores) AS s2
    SET s1.overall = 0
    WHERE s1.turn = s2.max_turn;
    ";
    mysqli_query($conn, $resetQuery);
}

//get currentPlayer
$query = "SELECT currentPlayer FROM game_data";
$playerResult = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($playerResult);
$currentPlayer = $row['currentPlayer'];

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

//each player has taken their turn
if ($currentPlayerIndex == (count($playerNames) - 1)) {
    
    //gets the highest scoring player and check for ties
    $query = "SELECT name, overall
    FROM scores
    WHERE turn = (SELECT MAX(turn) FROM scores) - 1
    AND overall = (SELECT MAX(overall) FROM scores WHERE turn = (SELECT MAX(turn) FROM scores) - 1)
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
            $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$bestPlayer', 9999, 999)";
            mysqli_query($conn, $sql);

            $conn->close();
            exit();
        }
    }
}
newTurn();

$conn->close();
?>