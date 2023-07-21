<!DOCTYPE html>
<html>
<head>

    <title>Darts Score Input</title>
    <link rel="stylesheet" type="text/css" href="styles/scoring.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/getCurrentPlayer.js"></script>
    <script type="text/javascript" src="scripts/updateTableCell.js"></script>
    <script type="text/javascript" src="scripts/getScores.js"></script>
    <script type="text/javascript" src="scripts/dart.js"></script>
    <script type="text/javascript" src="scripts/multiplier.js"></script>
    <script type="text/javascript" src="scripts/displayNames.js"></script>
    <script type="text/javascript" src="scripts/displayScores.js"></script>
    <script>
      //initialize multiplier settings
        multiplierValue = 1;
        let multiplierActive = false; // Flag to track the active state of the multiplier

        //populate info cells of table
        getCurrentPlayer();
        getScores();
        displayNames();
        displayScores();
        
        //backspace functionality
        function undo() {
          $.ajax({
            url: 'scripts/undoCD.php'
          })
        };

        //submit turn functionality
        function submitTurnCD() {
          $.ajax({
            url: 'scripts/submitTurnCD.php'
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



<table class="center">
<tr>
<td></td>
<td></td>
  <td id = "currentPlayerCell" width="100%" class = "infoCell">current</td>
</tr>
<tr>
<td></td>
  <td id ="firstCell" class = "infoCell">first</td>
  <td id="secondCell" class = "infoCell">second</td>
  <td id="thirdCell" class = "infoCell">third</td>
</tr>
<tr>
  <td></td>
  <td><button class="button" name = "doubleButton" onclick="multiplier('double')">Double</button></td>
  <td><button class="button" name = "tripleButton" onclick="multiplier('triple')">Triple</button></td>
  <td><button class ="button" onclick="undo()">Undo</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(20, multiplierValue)">20</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(19, multiplierValue)">19</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(18, multiplierValue)">18</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(17, multiplierValue)">17</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(16, multiplierValue)">16</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(15, multiplierValue)">15</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(14, multiplierValue)">14</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(13, multiplierValue)">13</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(12, multiplierValue)">12</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(11, multiplierValue)">11</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(10, multiplierValue)">10</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(9, multiplierValue)">9</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(8, multiplierValue)">8</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(7, multiplierValue)">7</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(6, multiplierValue)">6</button></td>
</tr>
<tr>
  <td><button class="button" name ="scoreButton" onclick="dart(5, multiplierValue)">5</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(4, multiplierValue)">4</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(3, multiplierValue)">3</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(2, multiplierValue)">2</button></td>
  <td><button class="button" name ="scoreButton" onclick="dart(1, multiplierValue)">1</button></td>
</tr>
<tr>
  <td><button class="button" name="bullButton" onclick="dart(25, multiplierValue)">Bull</button></td>
  <td colspan="3"><button class="button" onclick="submitTurnCD()">Enter Turn</button></td>
  <td><button class="button" name="missButton" onclick="dart(0, multiplierValue)">Miss</button></td>
</tr>
</table>


</body>
</html>