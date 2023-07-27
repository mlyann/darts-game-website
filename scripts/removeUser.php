<?php
require 'connect.php';

$name = $_POST['deregister_select'];

$sql = "DELETE FROM users WHERE name = '$name'";

if ($conn->query($sql) === TRUE) {
    echo "User removed successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
$conn->close();
?>
