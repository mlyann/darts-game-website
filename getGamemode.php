<?php

$query = "SELECT type FROM game_data" WHERE ID = 1;
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $gamemode = $row[type];

        // Process the retrieved ENUM value
        echo "var gamemode = '$gamemode';\n";
    }
} else {
    echo "No rows found.";
}
?>
