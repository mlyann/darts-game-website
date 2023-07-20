<?php
// Assuming you have established a MySQL database connection
require 'connect.php';

// Query to retrieve the scores from the table
$query = "SELECT Name, overall, turn, first, second, third FROM scores
          WHERE turn = (SELECT MAX(turn) FROM scores)";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Start generating the HTML table
    $tableHTML = '<tr><th>Name</th><th>Overall</th><th>Turn</th><th>First</th><th>Second</th><th>Third</th></tr>';

    // Loop through the result set and append each row to the table
    while ($row = mysqli_fetch_assoc($result)) {
        $tableHTML .= '<tr>';
        $tableHTML .= '<td>' . $row['Name'] . '</td>';
        $tableHTML .= '<td>' . $row['overall'] . '</td>';
        $tableHTML .= '<td>' . $row['turn'] . '</td>';
        $tableHTML .= '<td>' . $row['first'] . '</td>';
        $tableHTML .= '<td>' . $row['second'] . '</td>';
        $tableHTML .= '<td>' . $row['third'] . '</td>';
        $tableHTML .= '</tr>';
    }

    // Send the table HTML as a response
    echo $tableHTML;
} else {
    // Handle the case when the query fails
    echo 'Error retrieving scores: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
