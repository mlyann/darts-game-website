<?php
//connect
$servername = "darts.coretechs.com";
$username = "php";
$password = "password";
$database = "darts";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// ... Connection code (from Step 2) ...

// Fetch data from a table
$sql = "SELECT name, COUNT(name) AS wins FROM wins GROUP BY name ORDER BY wins DESC;"; // Replace 'your_table' with the name of your table
$result = $conn->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"] . " - Wins: " . $row["wins"] . "<br>";
    }
} else {
    echo "No data found.";
}

// Close the connection
$conn->close();
?>


