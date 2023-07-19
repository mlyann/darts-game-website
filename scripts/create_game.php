<?php
require 'connect.php';

$clearGameData = "DELETE FROM game_data";
$clearResult = mysqli_query($conn, $clearGameData);
if($clearResult)
{
	echo "Success resetting gamedata\n";
} else {
    echo "Failure ressetting gamedata\n";
}

$game_type = $_POST['game_type'];

if ($game_type == 'Countdown') {
    $starting_points = $_POST['count_select'];
}
elseif ($game_type == 'Highscore') {
    $number_of_rounds = $_POST['round_select'];
}

$player_count = $_POST['player_count'];

for ($i = 1; $i <= $player_count; $i++) {
    $player_name = $_POST["player_name_" . $i];

    if (empty($player_name)) {
        echo "Failure: Player name cannot be blank.";
        exit;
    }

    $player_names[] = $player_name;
}

$players_json = json_encode($player_names);

if ($game_type == 'Countdown') {
    $sql = "INSERT INTO game_data (type,starting_points,player_count,players,time) 
        VALUES ('$game_type', '$starting_points', '$player_count', '$players_json', NOW())";
}
elseif ($game_type == 'Highscore') {
    $sql = "INSERT INTO game_data (type, starting_points, number_of_rounds,player_count,players,time) 
        VALUES ('$game_type', '$starting_points', '$number_of_rounds', '$player_count', '$players_json', NOW())";
}

// insert into game_data 
mysqli_query($conn, $sql);

//create initial table rows in scores
$sql = "SELECT players from game_data";
$players = mysqli_query($conn, $sql);
$row = $players->fetch_assoc();
$playersArray = json_decode($row['players'], true);

foreach ($playersArray as $player) {
    $name = $player;
    $sql = "INSERT INTO scores (Name, overall, turn) VALUES ('$name','$starting_points', '1')";
    mysqli_query($conn, $sql);
}

// insert in database 
$rs = mysqli_query($conn, $sql);

if($rs)
{
	echo "Success creating game";
} else {
    echo "Failure creating game";
}

$clearScores = "DELETE FROM scores";
$clearResult = mysqli_query($conn, $clearScores);
if($clearResult)
{
	echo "Success resetting scores";
} else {
    echo "Failure ressetting scores";
}

$conn->close();
header("Location: /scoring.php");
exit;
?>