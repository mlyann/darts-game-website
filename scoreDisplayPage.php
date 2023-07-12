<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <meta http-equiv="refresh" content="5">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<?php
// Assuming you have established a MySQL database connection
require 'scripts/connect.php';
// Query to retrieve the scores from the table
$query = "SELECT Name, overall, turn, first, second, third FROM scores
          WHERE turn = (SELECT MAX(turn) FROM scores WHERE Name = scores.Name AND first IS NOT NULL)";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Start generating the HTML table
    echo '<table>';
    echo '<tr><th>Name</th><th>Overall</th><th>Turn</th><th>First</th><th>Second</th><th>Third</th></tr>';

    // Loop through the result set and display each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td>' . $row['overall'] . '</td>';
        echo '<td>' . $row['turn'] . '</td>';
        echo '<td>' . $row['first'] . '</td>';
        echo '<td>' . $row['second'] . '</td>';
        echo '<td>' . $row['third'] . '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
} else {
    // Handle the case when the query fails
    echo 'Error retrieving scores: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>


</body>
</html>
