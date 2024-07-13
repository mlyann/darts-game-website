<?php
    require 'connect.php';
    $order = $_POST['order'];

    $setOrderQuery = "UPDATE game_data SET modified_order = '$order';";
    mysqli_query($conn, $setOrderQuery);

    $conn->close();
?>