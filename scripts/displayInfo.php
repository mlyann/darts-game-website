<?php
// Connect to the MySQL database
require 'connect.php';
require 'checkout.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get info from game_data
$sql = "SELECT type, players, currentPlayer, dartIndex, starting_points FROM game_data";
$players = mysqli_query($conn, $sql);
$row = $players->fetch_assoc();
$playersJSON = $row['players'];
$gamemode = $row['type'];
$currentPlayer = $row['currentPlayer'];
$dartIndex = $row['dartIndex'];
$starting_points = $row['starting_points'];

$playersArray = json_decode($playersJSON, true);


$allScores = [];
foreach ($playersArray as $player) {

    if($gamemode == 'Countdown'){
        $query = "SELECT Name, overall, first, second, third, turn
        FROM scores
        WHERE Name = '$player'
        AND turn = IF(Name = '$currentPlayer',
                       (SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'),
                       CASE
                         WHEN (SELECT MAX(turn) FROM scores WHERE Name = '$player') > 1
                         THEN (SELECT MAX(turn) - 1 FROM scores WHERE Name = '$player')
                         ELSE (SELECT MAX(turn) FROM scores WHERE Name = '$player')
                       END)";
    }
    else if ($gamemode == 'Highscore' ){

        $query = "SELECT Name, overall, first, second, third, turn
          FROM scores
          WHERE Name = '$player'
          AND turn = (SELECT MAX(turn) FROM scores)";

        //gets the round wins from a separate query
        $winsQuery = "SELECT roundWins AS rWins FROM roundWins WHERE Name = '$player'";

        $winsResult = mysqli_query($conn, $winsQuery);

        if($winsResult){

            $winRow = mysqli_fetch_assoc($winsResult);

            $rWins = $winRow['rWins'];
        }  
    }

    $result = mysqli_query($conn, $query);


    // Get an array of scores for each player
    $scores = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if ($gamemode == 'Countdown') {

                if ($player == $currentPlayer) {

                    $playerDartIndex = $dartIndex;
                    $isCurrent = true;
                } else {
                    
                    $playerDartIndex = 3;
                    $isCurrent = false;
                }

                $avg = round(($starting_points - $row['overall']) / $row['turn'], 1);

                //calculate possible checkout
                if($row['overall'] != 0){
                    $checkout = generateCheckout($row['overall']);

                    if ($checkout != 'No outs possible') {

                        $plusCount = substr_count($checkout, '+');

                        if (($plusCount == 1 && $dartIndex > 1) || ($plusCount == 2 && $dartIndex > 0)) {
                            $checkout = 'No outs possible';
                        }
                    }
                }
                else{

                    $checkout = "You win!";
                }

                $scores[] = array(
                    'name' => $player,
                    'overall' => $row['overall'],
                    'first' => $row['first'],
                    'second' => $row['second'],
                    'third' => $row['third'],
                    'avg' => $avg,
                    'checkout' => $checkout,
                    'isCurrent' => $isCurrent
                );
            }
            else {
                $scores[] = array(
                    'name' => $player,
                    'overall' => $row['overall'],
                    'first' => $row['first'],
                    'second' => $row['second'],
                    'third' => $row['third'],
                    'rWins' => $rWins
                );
            }
        }
    }
    $allScores = array_merge($allScores, $scores);
}

// Return the data as the response
header('Content-Type: application/json');
echo json_encode($allScores);

// Close the database connection
$conn->close();
?>
