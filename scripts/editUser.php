<?php
require 'connect.php';

$name = $_POST['edit_select'];
$newName = $_POST['edit_name'];
if (isset($_POST['edit_image'])) {
    $image = $_POST['edit_image'];
    $sql = "UPDATE users SET image_url = '$image', name = '$newName' WHERE name = '$name';";
} else {
    $sql = "UPDATE users SET name = '$newName' WHERE name = '$name';";
}



if ($conn->query($sql) === TRUE) {
    echo "User edited successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
