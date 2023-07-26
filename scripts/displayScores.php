<?php
// Connect to the MySQL database
require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get players and type and currentplayer and dartIndex
$sql = "SELECT type, players, currentPlayer, dartIndex FROM game_data";
$players = mysqli_query($conn, $sql);
$row = $players->fetch_assoc();
$playersJSON = $row['players'];
$gamemode = $row['type'];
$currentPlayer = $row['currentPlayer'];
$dartIndex = $row['dartIndex'];

$playersArray = json_decode($playersJSON, true);


$allScores = [];
foreach ($playersArray as $player) {
    if ($gamemode == 'Countdown') {
    $query = "SELECT Name, overall, first, second, third, turn
    FROM scores
    WHERE Name = '$player'
    AND turn = IF(Name = '$currentPlayer',
        (SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'),
        (SELECT MAX(turn) - 1 FROM scores WHERE Name = '$player'))";
    }
    else {
        $query = "SELECT s.Name, s.overall, s.first, s.second, s.third, s.turn, r.roundWins
        FROM scores s
        LEFT JOIN roundWins r ON s.Name = r.Name
        WHERE s.Name = '$player'
        AND s.turn = IF(s.Name = '$currentPlayer',
                        (SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'),
                        (SELECT MAX(turn) - 1 FROM scores WHERE Name = '$player' AND Name <> '$currentPlayer')
                       )";
    }


    $result = mysqli_query($conn, $query);

    // Get an array of scores for each player
    $scores = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($gamemode == 'Countdown') {
            $scores[] = array(
                'name' => $player,
                'overall' => $row['overall'],
                'first' => $row['first'],
                'second' => $row['second'],
                'third' => $row['third'],
                'avg' => round($row['overall'] / ($row['turn'] * 3 + $dartIndex), 1)
            );
        }
        else {
            $scores[] = array(
                'name' => $player,
                'overall' => $row['overall'],
                'first' => $row['first'],
                'second' => $row['second'],
                'third' => $row['third'],
                'wins' => $row['roundWins'],
                'avg' => $row['overall'] / ($row['turn'] * 3 + $dartIndex)
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
