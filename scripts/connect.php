<?php
//connect
$servername = "darts-dev.co4398xc5nn7.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "QFSFKOOj1pE3VPwu7KFm";
$database = "darts";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
