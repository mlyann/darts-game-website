<?php
require 'connect.php';

$name = $_POST['name'];

$sql = "INSERT INTO game_data (currentPlayer) VALUES ('$name')";

mysqli_query($conn, $sql);

// Close the database connection
$conn->close();
?>
