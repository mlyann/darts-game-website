<!DOCTYPE html>
<html>
<head>
    <title>Victory Page</title>
    <link id = "stylesheet" rel="stylesheet" type="text/css" href="styles/winPage.css">
</head>
<body>
        <?php
        require 'scripts/connect.php';
        $winnerQuery = "SELECT name FROM wins ORDER BY time DESC LIMIT 1;";
        $winnerResult = mysqli_query($conn, $winnerQuery);
        $winnerRow = mysqli_fetch_assoc($winnerResult);
        $winner = $winnerRow['name'];

        $imageQuery = "SELECT image_url FROM users WHERE name = '$winner';";
        $imageResult = mysqli_query($conn, $imageQuery);
        $imageRow = mysqli_fetch_assoc($imageResult);
        $image = $imageRow['image_url'];
        if ($image == '') {
            $image = "https://www.coretechs.com/wp-content/uploads/2020/08/Coretechs_Mark.png";
        }

        $avgQuery = "SELECT average FROM scores WHERE name = '$winner' AND overall = 0;";
        $avgResult = mysqli_query($conn, $avgQuery);
        $avgRow = mysqli_fetch_assoc($avgResult);
        $avg = $avgRow['average'];

        $conn->close();

        $html = 
        '<div class = "winnerContainer">
        <img class = "profile" src="' . $image . '">
        <p>' . $winner . ' wins!</p>
        <p>Average: ' . $avg . '</p>
        </div>';

        echo $html;
        ?>
</body>
</html>
