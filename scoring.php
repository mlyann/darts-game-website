<!DOCTYPE html>
<html>
<head>

    <title>Darts</title>
    <link rel="stylesheet" type="text/css" href="styles/scoring.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        <?php require 'scripts/getPlayers.php'; ?> //var allPlayers = ["[\name\"]"]
        <?php require 'scripts/getGamemode.php'; ?>//var gamemode = 'Countdown';
        </script><script type="text/javascript" src="scripts/submitTurnCD.js"></script><script>
        multiplierValue = 1;
        var playerTurn = 0;
        var updatedScore;
        var prevScore;

        //set initial score
        if(gamemode == 'Countdown'){
          updatedScore = 301;
        }
        else if(gamemode == 'Highscore'){
          overallScore = 0;
        }

        //create initial table rows
        for(let i=0; i<allPlayers.length; i++){
         
          $.ajax({
              url: "scripts/createTurn.php",
              type: "POST",
              data: {
                name: allPlayers[playerTurn],
                overallScore: 301
              },
              error: function(xhr, status, error){
                console.log("Error sending data to createTurn.php: " + error);
              }
            });
      
        }
        

        var updatedScore = overallScore;

        var turnScores = [];

        //records the single dart score
        </script><script type="text/javascript" src="scripts/dart.js"></script><script>

        //determines if the current player won (countdown)
        function determineWinnerCD(){
              
              for(let i = 0; i<dartIndex; i++){
                updatedScore -= turnScores[i];
              }
              
              if(updatedScore == 0){//win

                console.log(allPlayers[playerTurn] + " wins @ "+ overallScore + "!");

                //sends winner's name to leaderboard
                $.ajax({
                  url: "scripts/insert_winner.php",
                  type: "POST",
                  data:{
                    name: allPlayers[playerTurn]
                  },
                  error: function(xhr, status, error){
                    console.log("Error sending data to insert_winner.php: " + error);
                  }
                });

                return true;
              }
              else if(updatedScore < 0){//bust

                console.log("Bust!")
              }
              return false;
        }

        //submits the current scores


         //sets up turn for next player
        function newTurn(){

          //adds new row for current player for their next turn
          //passes in player name and overall score (turn count is searched within the php file)
          $.ajax({
            url: "scripts/createTurn.php",
            type: "POST",
            data: {
              name: allPlayers[playerTurn],
              overallScore: updatedScore
            },
            error: function(xhr, status, error){
              console.log("Error sending data to createTurn.php: " + error);
            }
          });

          playerTurn = (playerTurn + 1) % allPlayers.length;
          dartIndex = 0;

          //get next player's overall score
          if(gamemode == 'Countdown'){

            $.ajax({
              url: "scripts/getOverall.php",
              type: "POST",
              data: {
                  name: allPlayers[playerTurn]
              },
              success: function(result) {
                  updatedScore = result;
                  console.log("Overall Score:", updatedScore);
              },
              error: function(xhr, status, error) {
                  console.log("Error getting overall score:", error);
              }
            });

            console.log("Overall Score: "+ allPlayers[playerTurn] + " : " +updatedScore);
          }
        }

        //backspace functionality
        function undo(){

          if(dartIndex > 0){

            dartIndex--;

            //update the number visualization
          }
        }

       // function quit(){}
    
       let multiplierActive = false; // Flag to track the active state of the multiplier
       </script><script type="text/javascript" src="scripts/multiplier.js"></script><script>



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
  <td id = "currentPlayerCell" class = "infoCell">current</td>
</tr>
<tr>
<td></td>
  <td id ="firstCell" class = "infoCell">first</td>
  <td id="secondCell" class = "infoCell">second</td>
  <td id="thirdCell" class = "infoCell">third</td>
</tr>
<tr>
  <td></td>
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
  <td colspan="3"><button class="button" onclick="submitTurn()">Enter Turn</button></td>
  <td><button class="button" name="missButton" onclick="dart(0, multiplierValue)">Miss</button></td>
</tr>
<tr>
  <td colspan="5"><button class="button" id="quitButton" onclick="quit()">Quit</button></td>
</tr>
</table>


</body>
</html>