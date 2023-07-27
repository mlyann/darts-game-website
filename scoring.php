<!DOCTYPE html>
<html>
<head>

    <title>Darts Score Input</title>
    <link rel="stylesheet" type="text/css" href="styles/scoring.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/getCurrentPlayer.js"></script>
    <script type="text/javascript" src="scripts/updateTableCell.js"></script>
    <script type="text/javascript" src="scripts/getScores.js"></script>
    <script type="text/javascript" src="scripts/multiplier.js"></script>
    <script type="text/javascript" src="scripts/displayNames.js"></script>
    <script type="text/javascript" src="scripts/displayInfo.js"></script>
    <script>
        //get the gamemode
        <?php
          require 'scripts/connect.php';

          $query = "SELECT type FROM game_data";
          $result = mysqli_query($conn, $query);

          if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mode = $row['type'];
          }

          echo "var gamemode = '$mode';";
          $conn->close();
        ?>

      //initialize multiplier settings
        multiplierValue = 1;
        let multiplierActive = false; // Flag to track the active state of the multiplier

        //populate info cells of table
        getCurrentPlayer();
        getScores();
        displayNames();
        displayInfo();

        function dart(score){
          let path = "scripts/dart";

          if(gamemode == 'Countdown')
            path += 'CD.php';
          else if(gamemode == 'Highscore')
            path += 'HS.php';

          score = score * multiplierValue;
          if (score == 75) {
            score = 25;
          }
          
          $.ajax({
            url: path,
            type: "POST",
            data: {
              score: score,
              multiplierValue: multiplierValue
            },
            error: function(xhr, status, error){
              console.log("Error sending data to "+path +": "+error);
            }
          });
        };

        //backspace functionality
        function undo() {
          let url = "scripts/undo";

          if(gamemode == 'Countdown')
            url += 'CD.php';
          else if(gamemode == 'Highscore')
            url += 'HS.php';

          $.ajax({
            url: url
          })
        };

        //submit turn functionality
        function submitTurn() {
          let url = "scripts/submitTurn";

          if(gamemode == 'Countdown')
            url += 'CD.php';
          else if(gamemode == 'Highscore')
            url += 'HS.php';

          $.ajax({
            url: url
          })
        };

  </script>
  <style>
.center {
    margin-left: auto;
    margin-right: auto;
  }
  
  .button {
    display: block;
    width: 100%;
    text-align: center;
  }
</style>
</head>
<body>


<div>
<table class="center info">

<?php require 'scripts/generateTable.php' ?>
</table>
<table class = "center gameInfo">
  <tr>
    <td class = "infoCell" id ="turnCell">Turn: 1</td>
    <td class = "infoCell" id ="checkoutCell">D20 + D20 + D20</td>
  </tr>
</table>
<table class="center special">
<tr>
  <td></td>
  <td><button class="button" id = "doubleButton" onclick="multiplier('double')">Double</button></td>
  <td><button class="button" id = "tripleButton" onclick="multiplier('triple')">Triple</button></td>
  <td><button class ="button" onclick="undo()">Undo</button></td>
</tr>
</table>
<table class = "center inputs">
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(20)">20</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(19)">19</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(18)">18</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(17)">17</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(16)">16</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(15)">15</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(14)">14</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(13)">13</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(12)">12</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(11)">11</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(10)">10</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(9)">9</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(8)">8</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(7)">7</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(6)">6</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(5)">5</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(4)">4</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(3)">3</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(2)">2</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(1)">1</button></td>
</tr>
</table>
<table class = "center special">
<tr>
  <td><button class="button" id="bullButton" onclick="dart(25)">Bull</button></td>
  <td colspan="3"><button class="button" onclick="submitTurn()">Enter Turn</button></td>
  <td><button class="button" name="missButton" onclick="dart(0)">Miss</button></td>
</tr>
</table>
</div>


</body>
</html>