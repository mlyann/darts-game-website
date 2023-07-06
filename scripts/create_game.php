<?php
require 'connect.php';

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

    $player_names[] = $player_name;
}

$players_json = json_encode($player_names);

if ($game_type == 'Countdown') {
    $sql = "INSERT INTO game_data (type,starting_points,player_count,players,time) 
        VALUES ('$game_type', '$starting_points', '$player_count', '$players_json', NOW())";
}
elseif ($game_type == 'Highscore') {
    $sql = "INSERT INTO game_data (type,number_of_rounds,player_count,players,time) 
        VALUES ('$game_type', '$number_of_rounds', '$player_count', '$players_json', NOW())";
}

// insert in database 
$rs = mysqli_query($conn, $sql);

if($rs)
{
	echo "Success";
} else {
    echo "Failure";
}

$conn->close();
?>