<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deregister_select']) && !empty($_POST['deregister_select'])) {
        $name = $_POST['deregister_select'];

        $stmt = $conn->prepare("DELETE FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            echo "User removed successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Name is required.";
    }
} else {
    echo "Error: Invalid request method.";
}

$conn->close();
?>
