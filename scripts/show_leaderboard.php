<?php
require 'connect.php';

$timeRange = $_GET['timeRange'];

// Build the SQL query based on the selected time range
$dateCondition = "";
if ($timeRange === "today") {
    $dateCondition = "DATE(time) = CURDATE()";
} elseif ($timeRange === "week") {
    $dateCondition = "DATE(time) >= CURDATE() - INTERVAL 7 DAY";
}

$sql = "SELECT name, COUNT(name) AS wins FROM wins";
if (!empty($dateCondition)) {
    $sql .= " WHERE " . $dateCondition;
}
$sql .= " GROUP BY name ORDER BY wins DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
