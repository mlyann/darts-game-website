<?php
// Connect to the MySQL database
require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get players
$sql = "SELECT players FROM game_data";
$players = mysqli_query($conn, $sql);
$row = $players->fetch_assoc();
$playersJSON = $row['players'];

$playersArray = json_decode($playersJSON, true);

$allScores = [];
//"SELECT overall, first, second, third  FROM scores WHERE Name = 'alexander volkanovski' AND turn = (SELECT MAX(turn) FROM scores WHERE Name = 'alexander volkanovski')
foreach ($playersArray as $player) {
    $query = "SELECT overall, first, second, third 
              FROM scores
              WHERE Name = '$player'
              AND turn = (
                SELECT COALESCE(MAX(turn), 0) 
                FROM scores 
                WHERE Name = '$player' AND first IS NOT NULL
              )
              ORDER BY first IS NOT NULL DESC
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    // Get an array of scores for each player
    $scores = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $scores[] = array(
                'name' => $player,
                'overall' => $row['overall'],
                'first' => $row['first'],
                'second' => $row['second'],
                'third' => $row['third']
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
