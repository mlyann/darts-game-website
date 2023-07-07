<!DOCTYPE html>
<html>
<head>
    <title>Darts</title>

    <?php require 'scripts/connect.php'; ?>

    <script>

        <?php require 'scripts/getPlayers.php'; ?> //var allPlayers = ["[\name\"]"]
        <?php require 'scripts/getGamemode.php'; ?>//var gamemode = 'Countdown';
        
        var playerTurn = 0;
        var dartIndex = 0;//darts thrown - 1

        function dart(score){

          if(dartIndex == 3){//disable buttons after dart limit is reached
            <?php

              if(dartIndex == 0){

                $query = "UPDATE scores SET first = score";
              }
              else if(dartIndex == 1){

                $query = "UPDATE scores SET second = score";
              }
              else if(dartIndex == 2){

                $query = "UPDATE scores SET third = score";
              }

            ?>

            if(gamemode == 'Countdown'){

               var updatedScore = overallScore - score;//except when overall < 0


               //CHANGE so this happens in updateCount()
               //ask how it works when button is pressed and you win before pressing "end turn"
               /* 
              if(updatedScore == 0){//win

                console.log(allPlayers[playerTurn] + " wins @ "+ overallScore + "!");
                quit();
              }
              else if(updatedScore < 0){//bust

                console.log("Bust!")
                newTurn();//CONTINUES AFTER newTurn() completes, iterates dartIndex again at the bottom.
              }
              */
  

            }
            else if(gamemode == 'Highscore'){

              var updatedScore = overallScore + score;
            }

            dartIndex++;
          }
        }

        //update countdown for curr player
        function updateCount(){//if no bust, no win (countdown normally)

          if(gamemode == 'Countdown'){


          }

          newTurn();
        }

         //sets up turn for next player
        function newTurn(){
         
          playerTurn = (playerTurn + 1) % allPlayers.length;

          dartIndex = 0;

          //get current player's overall score
          <?php
            $query = "SELECT overall FROM scores WHERE Name = allPlayers[playerTurn] AND turn = (SELECT MAX(turn) FROM scores WHERE Name = allPlayers[playerTurn]);"

            $result = mysqli_query($conn, $query);

            if($result && $result->num_rows > 0){

                $row = $result->fetch_assoc();
                $overall = $row['overall'];
            }

            var overallScore = $overall;
          ?>
        }

        //backspace functionality
        function delete(){


        }

        //temp
        function quit(){
        
            
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
          <td><button class = "button" onclick="">Bull</button></td>
          <td colspan = "3"><button class = "button" onclick="">Enter Turn</button></td>
          <td><button class = "button" onclick="dart(0)">Miss</button></td>
          
        </tr>
        
         <tr>
           <td colspan="5"><button class = "button" id = "quitButton" onclick="quit()">Quit</button></td>
         </tr>
          
      </table>

</body>
</html>