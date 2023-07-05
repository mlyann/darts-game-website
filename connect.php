<?php
//connect
$servername = "localhost";
$username = "php";
$password = "password";
$database = "darts";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>