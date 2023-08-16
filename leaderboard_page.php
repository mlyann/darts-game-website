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
                } else if (button === 'week') {
                    week_button.classList.add('active');
                } else if (button === 'allTime') {
                    allTime_button.classList.add('active');
                }

                // Make an AJAX request to fetch the leaderboard data based on the selected button
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var leaderboardTable = document.getElementById('leaderboard_table');
                        leaderboardTable.innerHTML = xhr.responseText;
                    }
                };
                xhr.open('GET', 'scripts/show_leaderboard.php?timeRange=' + button, true);
                xhr.send();
            }
        </script>
    </head>
    <body>
        <div class = "leaderboardContainer">
        <h1>Leaderboard</h1>

        <div name="timeButtons">
            <button onclick="handleButtonClick('today')" id="today_button">Today</button>
            <button onclick="handleButtonClick('week')" id="week_button">This Week</button>
            <button onclick="handleButtonClick('allTime')" id="allTime_button">All Time</button>
            <br><br>
        </div>

        <div id="leaderboard_table">
            <?php
                require 'scripts/connect.php';

                $sql = "SELECT name, COUNT(name) AS wins FROM wins GROUP BY name ORDER BY wins DESC";
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
        </div>
            </div>
    </body>
</html>
