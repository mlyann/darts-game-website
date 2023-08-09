<?php

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

    $query = "SELECT Name, overall, first, second, third, turn, average
    FROM scores
    WHERE Name = '$player'
    AND turn = IF(Name = '$currentPlayer',
                    (SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'),
                    CASE
                        WHEN (SELECT MAX(turn) FROM scores WHERE Name = '$player') > 1
                        THEN (SELECT MAX(turn) - 1 FROM scores WHERE Name = '$player')
                        ELSE (SELECT MAX(turn) FROM scores WHERE Name = '$player')
                    END)";
    

    $result = mysqli_query($conn, $query);


    // Get an array of scores for each player
    $scores = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

                if ($player == $currentPlayer) {

                    $playerDartIndex = $dartIndex;
                    $isCurrent = true;
                } else {
                    
                    $playerDartIndex = 3;
                    $isCurrent = false;
                }

                //calculate possible checkout
                if ($dartIndex < 3) {
                $checkout = generateCheckout($row['overall']);
                if ($checkout != 'No outs possible') {
                    $plusCount = substr_count($checkout, '+');
                    if (($plusCount == 1 && $dartIndex > 1) || ($plusCount == 2 && $dartIndex > 0)) {
                        $checkout = 'No outs possible';
                    }
                }
            } else {
                $checkout = 'No outs possible';
            }

                $scores[] = array(
                    'name' => $player,
                    'overall' => $row['overall'],
                    'first' => $row['first'],
                    'second' => $row['second'],
                    'third' => $row['third'],
                    'avg' => $row['average'],
                    'help' => $checkout,
                    'isCurrent' => $isCurrent
                );
            

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
