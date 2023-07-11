<?php
    require 'connect.php';

    $name = $_POST['name'];
    $overallScore = $_POST['overallScore'];

    $query = "SELECT MAX(turn) AS latestTurn FROM scores WHERE Name = '$name'";

    $result = mysqli_query($conn, $query);

    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        $latestTurn = $row['latestTurn'];
    }

    $latestTurn++;

    $query = "INSERT INTO scores (Name, overall, turn, first, second, third) VALUES ('$name','$overallScore', '$latestTurn', 0, 0, 0)";

    if(!(mysqli_query($conn, $query))){

        echo "Error creating a new turn row: " . mysqli_error($conn);
    }

    $conn->close();
?>