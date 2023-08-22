<?php
    require 'connect.php';

    $newTableFlagQuery = "SELECT new_table_flag FROM game_data;";
    $newTableFlagResult = mysqli_query($conn, $newTableFlagQuery);
    $newTableFlagRow = mysqli_fetch_assoc($newTableFlagResult);
    $newTableFlag = $newTableFlagRow['new_table_flag'];

    $resetTableFlagQuery = "UPDATE game_data SET new_table_flag = false;";
    mysqli_query($conn, $resetTableFlagQuery);

    echo $newTableFlag;

    $conn->close();
?>