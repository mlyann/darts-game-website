<!DOCTYPE html>
<html>
<head>
    <title>Darts</title>
    <link rel="stylesheet" type="text/css" href="styles/scoring.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        <?php require 'scripts/getPlayers.php'; ?> //var allPlayers = ["[\name\"]"]
        <?php require 'scripts/getGamemode.php'; ?>//var gamemode = 'Countdown';
        
        var playerTurn = 0;

        if(gamemode == 'Countdown'){
          overallScore = 301;
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
        </script><script type="text/javascript" src="scripts/setCurrentPlayer.js"></script><script>
        </script><script type="text/javascript" src="scripts/getCurrentPlayer.js"></script><script>
        </script><script type="text/javascript" src="scripts/updateTableCell.js"></script><script>
        <?php require 'scripts/setCurrentPlayer.php'; ?>
        setCurrentPlayer(allPlayers[0]);
        getCurrentPlayer();

        var updatedScore = overallScore;

        var dartIndex = 0;//darts thrown - 1
        var turnScores = [];

        //records the single dart score
        </script><script type="text/javascript" src="scripts/dart.js"></script><script>

        //determines if the current player won (countdown)
        function determineWinnerCD(){

prevScore = updatedScore;

for(let i = 0; i<dartIndex; i++){
  updatedScore -= turnScores[i];
}

if(updatedScore == 0 && multiplierValue === 2){//win

  console.log(allPlayers[playerTurn] + " wins!");

  //sends winner's name to leaderboard
  $.ajax({
    url: "scripts/insert_winner.php",
    type: "POST",
    data:{
      name: allPlayers[playerTurn]
    },
    error: function(xhr, status, error){
      console.log("Error sending data to insert_winner.php: " + error);//internal server error
    }
  });

  return true;
}
else {//bust

  updatedScore = prevScore;
  console.log("Bust!")
  console.log(allPlayers[playerTurn]);
}
return false;
}

        //updates/keeps track of highest scoring player (highscore)
        function determineWinnerHS(){

          for(let i=0; i<dartIndex; i++){
            updatedScore += turnScores[i];
          }

        }

        //submits the current scores
        function submitTurn(){

          var won;

          if(gamemode == 'Countdown'){
              won = determineWinnerCD();
          }
          
          //else if(gamemode == 'Highscore'){
            //won = false;//if playerTurn determine who won, otherweise won = false because not everybody went
         // }
          

          //sends necessary data to update turn scores
          $.ajax({
            url: "scripts/updateTurnScores.php",
            type: "POST",
            data:{
              turn1: turnScores[0],
              turn2: turnScores[1],
              turn3: turnScores[2],
              name: allPlayers[playerTurn]
            },
            error: function(xhr, status, error){
              console.log("Error sending data to updateTurnScores.php: " + error);
            }
          });
      

          if(!won){
            newTurn();
          }
          else{
            quit();
          }
        }

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
              }
            });
 
            updatedScore = overallScore;

            //
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
          }
        }

        //backspace functionality
        //function delete(){


        //}

        //temp
       // function quit(){
        
          
       // }
        

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
  <td><button class="button" name = "doubleButton" onclick="multiplier('double')">Double</button></td>
  <td><button class="button" name = "tripleButton" onclick="multiplier('triple')">Triple</button></td>
  <td><button class ="button" onclick="undo()">Undo</button></td>
</tr>
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
<tr>
  <td><button class="button" name="bullButton" onclick="dart(25)">Bull</button></td>
  <td colspan="3"><button class="button" onclick="submitTurn()">Enter Turn</button></td>
  <td><button class="button" name="missButton" onclick="dart(0)">Miss</button></td>
</tr>
<tr>
  <td colspan="5"><button class="button" id="quitButton" onclick="quit()">Quit</button></td>
</tr>
</table>

</body>
</html>