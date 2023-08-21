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
                        if (document.getElementById("month")) {
                            document.getElementById("month").style.display = 'none';
                        }
                        if (document.getElementById("week")) {
                            document.getElementById("week").style.display = 'none';
                        }
                        if (document.getElementById("today")) {
                            document.getElementById("today").style.display = 'flex';
                        }
                        break;
                    case 'week':
                        if (document.getElementById("month")) {
                            document.getElementById("month").style.display = 'none';
                        }
                        if (document.getElementById("today")) {
                            document.getElementById("today").style.display = 'none';
                        }
                        if (document.getElementById("week")) {
                            document.getElementById("week").style.display = 'flex';
                        }
                        break;
                    case 'month':
                        if (document.getElementById("week")) {
                            document.getElementById("week").style.display = 'none';
                        }
                        if (document.getElementById("today")) {
                            document.getElementById("today").style.display = 'none';
                        }
                        if (document.getElementById("month")) {
                            document.getElementById("month").style.display = 'flex';
                        }
                        break;
                    default:
                        break;
                }
            }

            function handleButtonClick(button) {
                var today_button = document.getElementById('today_button');
                var week_button = document.getElementById('week_button');
                var month_button = document.getElementById('month_button');

                today_button.classList.remove('active');
                week_button.classList.remove('active');
                month_button.classList.remove('active');

                // Toggle active class on the clicked button
                if (button === 'today') {
                    today_button.classList.add('active');
                    changeDateRange('today');
                } else if (button === 'week') {
                    week_button.classList.add('active');
                    changeDateRange('week');
                } else if (button === 'month') {
                    month_button.classList.add('active');
                    changeDateRange('month');
                }
            }
        </script>
    </head>
    <body>
        <div class = "leaderboardContainer">
        <h1>Leaderboard</h1>

        <div name="timeButtons">
            <button class = "active" onclick="handleButtonClick('today')" id="today_button">Today</button>
            <button onclick="handleButtonClick('week')" id="week_button">This Week</button>
            <button onclick="handleButtonClick('month')" id="month_button">This Month</button>
            <br><br>
        </div>

            <?php
                require 'scripts/connect.php';
                //generate month table
                $sql = "SELECT u.name, u.image_url, COUNT(w.name) AS wins FROM users u
                    LEFT JOIN wins w ON u.name = w.name
                    WHERE DATE(w.time) >= CURDATE() - INTERVAL 30 DAY
                    GROUP BY u.name, u.image_url
                    HAVING wins > 0
                    ORDER BY wins DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class = 'labelRow'>
                        <p class ='name'>Name</p><p class = 'wins'>Wins</p>
                        </div>";
                    $rank = 1;
                    $winsCounter = 9999;
                    echo '<div class = "rowContainer" id = "month" style = "display: none;">';
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $wins = $row['wins'];
                        $image_url = $row['image_url'];
                        echo '<div class = playerRow>';

                        if ($rank < 4) {
                            switch($rank) {
                                case 1;
                                    echo "<img class = 'profile rank1' src = '$image_url'>";
                                    break;
                                case 2:
                                    echo "<img class = 'profile rank2' src = '$image_url'>";
                                    break;
                                case 3:
                                    echo "<img class = 'profile rank3' src = '$image_url'>";
                                    break;
                            }
                            if ($wins < $winsCounter) {
                                $winsCounter = $wins;
                                $rank =  $rank + 1 ;
                            }
                        } else {
                            echo "<img class = 'profile' src = '$image_url'>";
                        }
                        echo "<p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                }

                //generate today table
                $rank = 1;
                $winsCounter = 9999;

                $sql = "SELECT u.name, u.image_url, COUNT(w.name) AS wins FROM users u
                LEFT JOIN wins w ON u.name = w.name
                WHERE DATE(w.time) = CURDATE() 
                GROUP BY u.name, u.image_url 
                HAVING wins > 0
                ORDER BY wins DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class = "rowContainer" id = "today">';
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $wins = $row['wins'];
                        $image_url = $row['image_url'];
                        echo '<div class = playerRow>';

                        if ($rank < 4) {
                            switch($rank) {
                                case 1;
                                    echo "<img class = 'profile rank1' src = '$image_url'>";
                                    break;
                                case 2:
                                    echo "<img class = 'profile rank2' src = '$image_url'>";
                                    break;
                                case 3:
                                    echo "<img class = 'profile rank3' src = '$image_url'>";
                                    break;
                            }
                            if ($wins < $winsCounter) {
                                $winsCounter = $wins;
                                $rank =  $rank + 1 ;
                            }
                        } else {
                            echo "<img class = 'profile' src = '$image_url'>";
                        }
                        echo "<p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                }

                //generate week table
                $rank = 1;
                $winsCounter = 9999;

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

                        if ($rank < 4) {
                            switch($rank) {
                                case 1;
                                    echo "<img class = 'profile rank1' src = '$image_url'>";
                                    break;
                                case 2:
                                    echo "<img class = 'profile rank2' src = '$image_url'>";
                                    break;
                                case 3:
                                    echo "<img class = 'profile rank3' src = '$image_url'>";
                                    break;
                            }
                            if ($wins < $winsCounter) {
                                $winsCounter = $wins;
                                $rank =  $rank + 1 ;
                            }
                        } else {
                            echo "<img class = 'profile' src = '$image_url'>";
                        }

                        echo "<p>$name</p><p class = 'wins'>$wins</p>";
                        echo '</div>';
                    }
                    echo '</div>';

                } else {
                }

                $conn->close();
            ?>
        </div>
    </body>
</html>
