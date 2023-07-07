<!DOCTYPE html>
<html>
<head>
    <title>Create Game</title>
    <script type="text/javascript" src="scripts/showConditionalCreateOption.js"></script>
    <script type="text/javascript">
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
        <label for="player_count">Select Number of Players (1-6):</label>
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
    
   
</body>
</html>