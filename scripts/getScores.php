<?php
// Your PHP script that handles the database query

// Connect to the MySQL database
require 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform your SQL query
$query = "SELECT first, second, third  FROM scores
    WHERE Name = (SELECT currentPlayer FROM game_data)
    AND turn = (SELECT MAX(turn) FROM scores WHERE first IS NOT NULL)";
$result = $conn->query($query);

// Fetch the data
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['first'];
        $data[] = $row['second'];
        $data[] = $row['third'];
    }
}

// Close the database connection
$conn->close();

// Return the data as the response
echo json_encode($data);
?>
