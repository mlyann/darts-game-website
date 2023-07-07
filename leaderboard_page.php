<?php
require 'scripts/connect.php';

$sql = "SELECT name, COUNT(name) AS wins FROM wins GROUP BY name ORDER BY wins DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Leaderboard</h1>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Wins</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $wins = $row['wins'];

        echo "<tr><td>$name</td><td>$wins</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
