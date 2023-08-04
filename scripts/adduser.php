<?php
require 'connect.php';

$name = $_POST['name'];
if (isset($_POST['image'])) {
    $image = $_POST['image'];
    $sql = "INSERT INTO users (name, image_url) VALUES ('$name', '$image')";
} else {
    $sql = "INSERT INTO users (name) VALUES ('$name')";
}



if ($conn->query($sql) === TRUE) {
    echo "User registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
