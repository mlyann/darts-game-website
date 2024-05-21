<?php
require "connect.php";

$idQuery = "SELECT id FROM game_data;";
$idResult = mysqli_query($conn, $idQuery);
$idRow = mysqli_fetch_assoc($idResult);
$game_id = $idRow['id'];

echo $game_id;

$conn->close();
?>