<?php
    require "connect.php";

    $name = $_GET['name'];

    $query = "SELECT image_url FROM users WHERE name = '$name';";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['image_url'];
    }
    $conn->close();
?>