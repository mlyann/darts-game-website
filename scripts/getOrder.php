<?php
require 'connect.php';

// Query to retrieve data from the database
$sql = "SELECT modified_order FROM game_data;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($result && ($row['modified_order'] != null)) {
    echo $row['modified_order'];
} else {
    echo null;
}

$conn->close();
?>
