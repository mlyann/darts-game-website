<!DOCTYPE html>
<html>
<head>
    <title>Darts</title>

    <?php require 'scripts/connect.php'; ?>

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
            <?php require 'scripts/createTurn.php'; ?>
        }

        var updatedScore = overallScore;

        var dartIndex = 0;//darts thrown - 1
        var turnScores = [];

        //records the single dart score
        function dart(score){

          if(dartIndex == 3){//disable buttons after dart limit is reached
            
            turnScores[dartIndex] = score;
          
            dartIndex++;
          }
        }

        //determines if the current player won (countdown)
        function determineWinnerCD(){
              
              for(let i = 0; i<dartIndex; i++){
                updatedScore -= turnScores[i];
              }
              
              if(updatedScore == 0){//win

                console.log(allPlayers[playerTurn] + " wins @ "+ overallScore + "!");
                return true;
              }
              else if(updatedScore < 0){//bust

                console.log("Bust!")
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
          /*
          else if(gamemode == 'Highscore'){
            won = false;//if playerTurn determine who won, otherweise won = false because not everybody went
          }
          */

          //sends necessary data to update turn scores
          $.ajax({
            url: "scripts/updateTurnScores.php",
            type: "POST",
            data:{
              turnScores: JSON.stringify(turnScores),
              name: allPlayers[playerTurn]
            },
            error: function(xhr, status, error){
              console.log("Error sending data to updateTurnScores.php: " + error);
            }
          });
          <?php require 'scripts/updateTurnScores.php'; ?>



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
          <?php require 'scripts/createTurn.php'; ?>

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

            <?php require 'scripts/getOverall.php'; ?>
            updatedScore = overallScore;
          }
        }

        //backspace functionality
        function delete(){


        }

        //temp
        function quit(){
        
          <?php mysqli_close($conn) ?>
        }


    </script>
</head>
<body>

    <table>
        <tr>
          <td><button class = "button" onclick="dart(20)">20</button></td>
          <td><button class = "button" onclick="dart(19)">19</button></td>
          <td><button class = "button" onclick="dart(18)">18</button></td>
          <td><button class = "button" onclick="dart(17)">17</button></td>
          <td><button class = "button" onclick="dart(16)">16</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="dart(15)">15</button></td>
          <td><button class = "button" onclick="dart(14)">14</button></td>
          <td><button class = "button" onclick="dart(13)">13</button></td>
          <td><button class = "button" onclick="dart(12)">12</button></td>
          <td><button class = "button" onclick="dart(11)">11</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="dart(10)">10</button></td>
          <td><button class = "button" onclick="dart(9)">9</button></td>
          <td><button class = "button" onclick="dart(8)">8</button></td>
          <td><button class = "button" onclick="dart(7)">7</button></td>
          <td><button class = "button" onclick="dart(6)">6</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="dart(5)">5</button></td>
          <td><button class = "button" onclick="dart(4)">4</button></td>
          <td><button class = "button" onclick="dart(3)">3</button></td>
          <td><button class = "button" onclick="dart(2)">2</button></td>
          <td><button class = "button" onclick="dart(1)">1</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="dart(60)">Bull</button></td>
          <td colspan = "3"><button class = "button" onclick="submitTurn()">Enter Turn</button></td>
          <td><button class = "button" onclick="dart(0)">Miss</button></td>
          
        </tr>
        
         <tr>
           <td colspan="5"><button class = "button" id = "quitButton" onclick="quit()">Quit</button></td>
         </tr>
          
      </table>

</body>
</html>