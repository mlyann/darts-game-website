<?php
$order = $_GET['order'];
require 'connect.php';

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

if ($order == null || !$order) {
    $playersArray = json_decode($playersJSON, true);
}
else {
    $playersArray = explode(',', $order);
}

$currentPlayerIndex = array_search($currentPlayer, $playersArray);

$allScores = [];
foreach ($playersArray as $player) {

    $query = "SELECT Name, overall, first, second, third, turn, average
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
    

    $result = mysqli_query($conn, $query);

    //get player image url
    $imgQuery = "SELECT image_url FROM users WHERE name = '$player';";
    $imgResult = mysqli_query($conn, $imgQuery);
    $imgRow = mysqli_fetch_assoc($imgResult);
    $img = $imgRow['image_url'];
    if ($img == null) {
        $img = "../styles/logo.webp";
    }


    // Get an array of scores for each player
    $scores = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($player == $currentPlayer){/// can maybe be the entire file's condition
                //gets the highest score and highest scoring player
                $bestQuery = "SELECT name, overall
                FROM scores
                WHERE turn = (SELECT MAX(turn) FROM scores)
                AND overall = (SELECT MAX(overall) FROM scores WHERE turn = (SELECT MAX(turn) FROM scores))
                ORDER BY overall DESC";
                $bestResult = $conn->query($bestQuery);
                if (!$bestResult) {
                    echo "Error getting the highest score: " . mysqli_error($conn);
                }

                $bestRow = $bestResult->fetch_assoc();

                //updates help guide (Highscore)
                if($bestRow['name'] == $player){

                    if ($currentPlayerIndex < (count($playersArray) - 1)) 
                        $help = "You are the score leader";
                    else
                        $help = "Round won!";
                }
                else{   
                    $help = $bestRow['overall'] + 1 - $row['overall'] . " to win"; 
                    $dartsNeeded = (($bestRow['overall'] + 1 - $row['overall']) / 60);
                    if (!((($dartsNeeded <= 3) && ($dartIndex < 1)) || (($dartsNeeded <= 2) && ($dartIndex < 2)) || (($dartsNeeded <= 1) && ($dartIndex < 3)))) {
                        $help = '';
                    }

                }
            }

            $scores[] = array(
                'name' => $player,
                'overall' => $row['overall'],
                'first' => $row['first'],
                'second' => $row['second'],
                'third' => $row['third'],
                'help' => $help,
                'img' => $img,
                'rWins' => $rWins
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
