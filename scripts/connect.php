<?php
//connect
$servername = "darts-daniel-dev.co4398xc5nn7.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "Bz5gfz^iLD0o7U.[?C8e";
$database = "darts";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
