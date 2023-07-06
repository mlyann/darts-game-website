<!DOCTYPE html>
<html>
<head>
    <title>Conditional Form</title>
    <script>
        function showForm() {
            var gameType = document.getElementById("game_type").value;
            var form = document.getElementById("count_form");
            form.style.display = "none";

            if (gameType === "countdown" || gameType === "countup") {
                form.style.display = "block";
            } 
            else if (gameType === "highscore") {
                form.style.display = "none";
            }
            
            if (gameType === "countdown") {
                document.getElementById("count_label").innerHTML = "Count Down From:";
            }
            else if (gameType === "countup") {
                document.getElementById("count_label").innerHTML = "Count Up To";
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
                    <?php
                        require 'scripts/connect.php';

                        $sql = "SELECT name FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = $row['name'];
                                echo "var option = document.createElement('option');\n";
                                echo "option.value = '$name';\n";
                                echo "option.textContent = '$name';\n";
                                echo "select.appendChild(option);\n";
                            }
                        }

                        $conn->close();
                    ?>

                    

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
    <h1>Conditional Form</h1>

    <label for="game_type">Game Type:</label>
    <select name="game_type" id="game_type" onchange="showForm()">
        <option value="">Select Type</option>
        <option value="countdown">Count Down</option>
        <option value="countup">Count Up</option>
        <option value="highscore">High Score</option>
    </select>

    <br><br>
    <div id="count_form" style="display:none">
    <label for="count_select" id ="count_label">test</label>
    <select id="count_select">
        <option value="301">301</option>
        <option value="501">501</option>
    </select>
    <br><br>
    </div>

    <div name="player_form">
        <label for="player_count">Select Number of Players (1-6):</label>
        <select name="player_count" id="player_count" onchange="showPlayerForm()">
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
    
   
</body>
</html>


