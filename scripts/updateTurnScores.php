<?php
    require 'connect.php';

    $turn1 = $_POST['turn1'];
    $turn2 = $_POST['turn2'];
    $turn3 = $_POST['turn3'];
    $name = $_POST['name'];

    // Escape variables to prevent SQL injection
    $turn1 = mysqli_real_escape_string($conn, $turn1);
    $turn2 = mysqli_real_escape_string($conn, $turn2);
    $turn3 = mysqli_real_escape_string($conn, $turn3);
    $name = mysqli_real_escape_string($conn, $name);

    // Get the maximum turn value for the given name
    $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$name'";
    $result = mysqli_query($conn, $subQuery);
    $row = mysqli_fetch_assoc($result);
    $maxTurn = $row['MAX(turn)'];

    // Update the scores table
    $query = "UPDATE scores 
              SET 
                first = '$turn1',
                second = '$turn2',
                third = '$turn3'
              WHERE Name = '$name'
                AND turn = $maxTurn";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error updating turn scores: " . mysqli_error($conn);
    }

    $conn->close();
?>
