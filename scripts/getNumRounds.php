<?php

require 'connect.php';

$query = "SELECT number_of_rounds FROM game_data";
$result = mysqli_query($conn, $query);

if(!$result){
    echo "Error getting number of rounds:" . mysqli_error($conn);
}

if($result && $result->num_rows > 0){

    $row = $result->fetch_assoc();
    $num = $row['number_of_rounds'];
}
echo "var numRounds = '$num'";

$conn->close();
?>