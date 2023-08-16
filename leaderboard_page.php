<html>
    <head>
    <meta name="viewport" content="user-scalable=no">
    <link id = "stylesheet" rel="stylesheet" type="text/css" href="styles/leaderboard.css">
        <style>
            .active {
                background-color: green;
                color: white;
            }
        </style>
        <script type="text/javascript">
            function changeDateRange(interval) {
                switch(interval) {
                    case 'today':
                        document.getElementById("allTime").style.display = 'none';
                        document.getElementById("week").style.display = 'none';
                        document.getElementById("today").style.display = 'flex';
                        break;
                    case 'week':
                        document.getElementById("allTime").style.display = 'none';
                        document.getElementById("today").style.display = 'none';
                        document.getElementById("week").style.display = 'flex';
                        break;
                    case 'allTime':
                        document.getElementById("week").style.display = 'none';
                        document.getElementById("today").style.display = 'none';
                        document.getElementById("allTime").style.display = 'flex';
                        break;
                    default:
                        break;
                }
            }

            function handleButtonClick(button) {
                var today_button = document.getElementById('today_button');
                var week_button = document.getElementById('week_button');
                var allTime_button = document.getElementById('allTime_button');

                today_button.classList.remove('active');
                week_button.classList.remove('active');
                allTime_button.classList.remove('active');

                // Toggle active class on the clicked button
                if (button === 'today') {
                    today_button.classList.add('active');
                    changeDateRange('today');
                } else if (button === 'week') {
                    week_button.classList.add('active');
                    changeDateRange('week');
                } else if (button === 'allTime') {
                    allTime_button.classList.add('active');
                    changeDateRange('allTime');
                }
            }
        </script>
    </head>
    <body>
        <div class = "leaderboardContainer">
        <h1>Leaderboard</h1>

        <div name="timeButtons">
            <button onclick="handleButtonClick('today')" id="today_button">Today</button>
            <button onclick="handleButtonClick('week')" id="week_button">This Week</button>
            <button class = "active" onclick="handleButtonClick('allTime')" id="allTime_button">All Time</button>
            <br><br>
        </div>

            <?php
                require 'scripts/connect.php';
                //generate allTime table
                $sql = "SELECT u.name, u.image_url, COUNT(w.name) AS wins FROM users u
                    LEFT JOIN wins w ON u.name = w.name
                    GROUP BY u.name, u.image_url
                    HAVING wins > 0
                    ORDER BY wins DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class = 'labelRow'>
                        <p class ='name'>Name</p><p class = 'wins'>Wins</p>
                        </div>";

                    echo '<div class = "rowContainer" id = "allTime">';
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $wins = $row['wins'];
                        $image_url = $row['image_url'];
                        echo '<div class = playerRow>';
                        echo "<img class = 'profile' src = '$image_url'><p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                    echo "No data found.";
                }

                //generate today table
                $sql = "SELECT u.name, u.image_url, COUNT(w.name) AS wins FROM users u
                LEFT JOIN wins w ON u.name = w.name
                WHERE DATE(w.time) = CURDATE() 
                GROUP BY u.name, u.image_url 
                HAVING wins > 0
                ORDER BY wins DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class = "rowContainer" id = "today" style = "display: none;">';
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $wins = $row['wins'];
                        $image_url = $row['image_url'];
                        echo '<div class = playerRow>';
                        echo "<img class = 'profile' src = '$image_url'><p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                    echo "No data found.";
                }

                //generate week table
                $sql = "SELECT u.name, u.image_url, COUNT(w.name) AS wins FROM users u
                LEFT JOIN wins w ON u.name = w.name
                WHERE DATE(w.time) >= CURDATE() - INTERVAL 7 DAY
                GROUP BY u.name, u.image_url
                HAVING wins > 0
                ORDER BY wins DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class = "rowContainer" id = "week" style = "display: none;">';
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $wins = $row['wins'];
                        $image_url = $row['image_url'];
                        echo '<div class = playerRow>';
                        echo "<img class = 'profile' src = '$image_url'><p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                    echo "No data found.";
                }

                $conn->close();
            ?>
        </div>
    </body>
</html>
