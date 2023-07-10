<?php

$query = "SELECT type FROM game_data";
$result = mysqli_query($conn, $query);

if(!$result){
    echo "Error getting gamemode:" . mysqli_error($conn);
}

if($result && $result->num_rows > 0){

    $row = $result->fetch_assoc();
    $mode = $row['type'];
}
echo "var gamemode = '$mode'";

?>