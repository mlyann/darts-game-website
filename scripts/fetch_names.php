<?php
require 'scripts/connect.php';

$sql = "SELECT name FROM users";
$result = $conn->query($sql);

$options = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row['name'];
    }
}

$conn->close();

echo json_encode($options);
?>
