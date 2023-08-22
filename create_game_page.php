<!DOCTYPE html>
<html>
<head>
    <title>Create Game</title>
    <meta name="viewport" content="user-scalable=no">
    <link rel="stylesheet" type="text/css" href="styles/createGame.css">
    <script type="text/javascript">

        function showConditionalCreateOption() {
            var gameType = document.getElementById("game_type").value;
            var count_form = document.getElementById("count_form");
            var highscore_form = document.getElementById("highscore_form");
            highscore_form.style.display = "none";
            count_form.style.display = "none";

            if (gameType === "Countdown") {
                count_form.style.display = "block";
                highscore_form.style.display = "none";
            } 
            else if (gameType === "Highscore") {
                count_form.style.display = "none";
                highscore_form.style.display = "block";
            }
            
            if (gameType === "Countdown") {
                document.getElementById("count_label").innerHTML = "Count Down From:";
            }
            else if (gameType === "Highscore") {
                document.getElementById("round_label").innerHTML = "Number of Rounds:";
            }
        }

        function showPlayerForm() {
            var playerCount = document.getElementById("player_count").value;
            var playerForm = document.getElementById("player_form");
            
            playerForm.innerHTML = "";

            if (playerCount !== "") {
                for (var i = 1; i <= playerCount; i++) {
                    var label = document.createElement("label");
                    label.for = "player_name_" + i;
                    label.textContent = "Player " + i + " Name:";

                    var select = document.createElement("select");
                    select.id = "player_name_" + i;
                    select.name = "player_name_" + i;
                    <?php require 'scripts/fetch_names.php'; ?>
                    //keeps current values when changing length
                    if (i <= playersArray.length) {
                        select.value = playersArray[i - 1];
                    }

                    // Append the label, select, and line break to the form
                    playerForm.appendChild(label);
                    playerForm.appendChild(select);
                    playerForm.appendChild(document.createElement("br"));

                }
            }

        }
    </script>

</head>
<body>
    <h1>Create Game</h1>
    <form id ="create_game_form" action ="scripts/create_game.php" method = "POST">
    <label for="game_type">Game Type:</label>
    <select name="game_type" id="game_type" onchange="showConditionalCreateOption()" required>
        <option value="">Select Type</option>
        <option value="Countdown">Count Down</option>
        <option value="Highscore">High Score</option>
    </select>
    <br><br>

    <div id="count_form" style="display:none">
    <label for="count_select" id ="count_label"></label>
    <select id="count_select" name="count_select" required>
        <option value="301">301</option>
        <option value="501">501</option>
    </select>
    <br><br>
    </div>

    <div id="highscore_form" style="display:none">
    <label for="round_select" id ="round_label"></label>
    <select id="round_select" name="round_select" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <br><br>
    </div>

    <div name="player_form">
        <label for="player_count">Select Number of Players:</label>
        <select name="player_count" id="player_count" onchange="showPlayerForm()" required>
            <option value="">Select Number</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <div id = player_form></div>

    </div>
    <button type="submit">Launch Game</button>
    </form>
    <script>
        <?php //autofill form with setup of most recent game
        require "scripts/connect.php";

        $gameQuery = "SELECT type, starting_points, number_of_rounds, player_count, players FROM game_data;";
        $gameResult = mysqli_query($conn, $gameQuery);
        if ($gameResult) {
            $gameRows = mysqli_fetch_assoc($gameResult);
            $type = $gameRows['type'];
            if ($type == 'Countdown') {
                $starting_points = $gameRows['starting_points'];
                echo "var starting_points = '$starting_points';";
            } else {
                $number_of_rounds = $gameRows['number_of_rounds'];
                echo "var number_of_rounds = '$number_of_rounds';";
            }
            $player_count = $gameRows['player_count'];
            $playersArray = $gameRows['players'];
            echo "var type = '$type';";
            echo "var player_count = '$player_count';";
            echo "var playersArray = '$playersArray';";
        }

        $conn->close();
        ?>
        if (type == 'Countdown' || type == 'Highscore') {
        document.getElementById("game_type").value = type;
        showConditionalCreateOption();
        if (type == 'Countdown') {
            document.getElementById("count_select").value = starting_points;
        }
        else {
            document.getElementById('round_select').value = number_of_rounds;
        }
        document.getElementById("player_count").value = player_count;
        showPlayerForm();
        playersArray = JSON.parse(playersArray)
        for (let i = 1; i <= player_count; i++) {
            document.getElementById('player_name_' + i).value = playersArray[i-1];
        }
    }
    </script>
   
</body>
</html>