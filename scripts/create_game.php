<?php
require 'connect.php';

$game_type = $_POST['game_type'];

if ($game_type == 'countdown') {
    $starting_points = $_POST['count_select'];
}
elseif ($game_type == 'highscore') {
    $number_of_rounds = $_POST['round_select'];
}

$player_count = $_POST['player_count'];

for ($i = 1; $i <= $player_count; $i++) {
    $player_name = $_POST["player_name_" . $i];

    $player_names[] = $player_name;
}

$conn->close();
?>