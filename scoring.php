<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="user-scalable=no">
    <title>Darts Score Input</title>
    <link rel="stylesheet" type="text/css" href="styles/scoring.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/getCurrentPlayer.js"></script>
    <script type="text/javascript" src="scripts/updateTableCell.js"></script>
    <script type="text/javascript" src="scripts/displayNames.js"></script>
    <script type="text/javascript" src="scripts/displayInfo.js"></script>
    <script type="text/javascript" src="scripts/resetMultipliers.js"></script>
    <script type="text/javascript" src="scripts/multiplier.js"></script>
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

      //initialize global vars
        multiplierValue = 1;
        let multiplierActive = false; // Flag to track the active state of the multiplier

        //populate info cells of table
        getCurrentPlayer();
        displayNames();
        displayInfo();
        
        async function handleButtonClick(buttonId) {
          let buttonType = buttonId.split('_')[1];
          console.log(buttonType);
          switch (buttonType) {
            case 'undo':
              await undo();
              break;
            default:
              await dart(buttonType).then(() => {
                resetMultipliers(); // Call resetMultipliers() after dart() is finished
              });
          }
          await displayInfo(); // Wait until the functions are done before calling displayInfo()
        }

        function handleHover(buttonId) {
          console.log(buttonId);
        }


        function dart(score) {

          return new Promise((resolve, reject) => {
            let path = "scripts/dart";

            if (gamemode === 'Countdown')
              path += 'CD.php';
            else if (gamemode === 'Highscore')
              path += 'HS.php';

            score *= multiplierValue;
            if(score == 75)
              score = 25;

            $.ajax({
              url: path,
              type: "POST",
              data: {
                score: score,
                multiplierValue: multiplierValue
              },
              success: function(response) {
                resolve(response);
              },
              error: function(xhr, status, error) {
                console.error("Error sending data to " + path + ": " + error);
                reject(error);
              }
            });
          });
        }


        //backspace functionality
        function undo() {
          return new Promise((resolve, reject) => {
            let url = "scripts/undo";

            if (gamemode === 'Countdown')
              url += 'CD.php';
            else if (gamemode === 'Highscore')
              url += 'HS.php';

            $.ajax({
              url: url,
              success: function(response) {
                resolve(response);
              },
              error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                reject(error); 
              }
            });
          });
        }


        //submit turn functionality
        async function submitTurn() {
          // Reset multiplier buttons
          resetMultipliers();

          let url = "scripts/submitTurn";

          if (gamemode == 'Countdown')
            url += 'CD.php';
          else if (gamemode == 'Highscore')
            url += 'HS.php';

          try {
            await $.ajax({ 
              url: url
            });
          } catch (error) {
            console.error(error);
          }

          displayInfo();
          await getCurrentPlayer(); // Wait for getCurrentPlayer to complete before proceeding
        };

function updateInfo(){
getCurrentPlayer();
displayInfo();
setTimeout(updateInfo, 100);
}
updateInfo();

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


<div class = "center" id = "tableWrapper"> 
  <div class = "center" id = "infoContainer">
<?php require 'scripts/generateTable.php' ?>
<table class = "center gameInfo">
  <tr>
    <td class = "infoCell" id ="helpCell"></td>
  </tr>
</table>
      </div>

<table class="center inputs">
  <tr>
  <td width = "33%" style = "border-left: none; border-top: none; border-bottom: none;"><button id = "input_25" class="button" name ="inputButton">Bull</button></td>
  <td width = "33%" style = "border-top: none; border-bottom:none;"><button class="button" id = "doubleButton" onclick="multiplier('double')">Double</button></td>
  <td width = "33%" style = "border-top: none; border-right: none; border-bottom: none;" ><button class="button" id = "tripleButton" onclick="multiplier('triple')">Triple</button></td>
      </tr>
</table>
<table class="center inputs">
<tr>
  <td style = "border-left: none;"><button id = "input_20" class="button numInput" name ="inputButton" >20</button></td>
  <td><button id = "input_19" class="button numInput" name ="inputButton">19</button></td>
  <td><button id = "input_18" class="button numInput" name ="inputButton">18</button></td>
  <td><button id = "input_17" class="button numInput" name ="inputButton">17</button></td>
  <td style = "border-right: none;"><button id = "input_16" class="button numInput" name ="inputButton">16</button></td>
</tr>
<tr>
  <td style = "border-left: none;"><button id = "input_15" class="button numInput" name ="inputButton">15</button></td>
  <td><button id = "input_14" class="button numInput" name ="inputButton">14</button></td>
  <td><button id = "input_13" class="button numInput" name ="inputButton">13</button></td>
  <td><button id = "input_12" class="button numInput" name ="inputButton"">12</button></td>
  <td style = "border-right: none;"><button id = "input_11" class="button numInput" name ="inputButton">11</button></td>
</tr>
<tr>
  <td style = "border-left: none;"><button id = "input_10" class="button numInput" name ="inputButton">10</button></td>
  <td><button id = "input_9" class="button numInput" name ="inputButton">9</button></td>
  <td><button id = "input_8" class="button numInput" name ="inputButton">8</button></td>
  <td><button id = "input_7" class="button numInput" name ="inputButton">7</button></td>
  <td style = "border-right: none;"><button id = "input_6" class="button numInput" name ="inputButton">6</button></td>
</tr>
<tr>
  <td style = "border-left: none;"><button id = "input_5" class="button numInput" name ="inputButton">5</button></td>
  <td><button id = "input_4" class="button numInput" name ="inputButton">4</button></td>
  <td><button id = "input_3" class="button numInput" name ="inputButton">3</button></td>
  <td><button id = "input_2" class="button numInput" name ="inputButton">2</button></td>
  <td style = "border-right: none;"><button id = "input_1" class="button numInput" name ="inputButton">1</button></td>
</tr>
<tr>
  <td colspan = "2" style = "border-bottom: none; border-left: none"  id = "undoCell"><button id = "input_undo" class ="button" name ="inputButton">Undo</button></td>
  <td colspan="3" style = "border-right: none; border-bottom: none;"><button class="button" onclick="submitTurn()">Enter Turn</button></td>
</tr>
</table>
<script>
  const inputButtons = document.getElementsByName('inputButton');
  inputButtons.forEach(button => {
    button.addEventListener('click', function() {
        handleButtonClick(this.id);
    }), 
    button.addEventListener('active:hover', function() {
      handlerHover(this.id);
    })
  });
  buttons = document.getElementsByClassName('numInput');
  tripleButton = document.getElementById('tripleButton');
  doubleButton = document.getElementById('doubleButton');
  bullButton = document.getElementById('input_25');
  </script>
</div>


</body>
</html>
