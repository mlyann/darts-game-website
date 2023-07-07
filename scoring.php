<!DOCTYPE html>
<html>
<head>
    <title>Darts</title>

    <?php require 'scripts/connect.php'; ?>

    <script>

        <?php require 'scripts/getPlayers.php'; ?> //var allPlayers = ["[\name\"]"]
        <?php require 'scripts/getGamemode.php'; ?>//var gamemode = 'Countdown';
        
        var playerTurn = 0;
        var currPlayer = "";
        var dartsThrown = 1;


        function dart(score){

          if(dartsThrown == 0){

            newTurn();
          }



          dartsThrown = (dartsThrown + 1) % 3;
        }

        function newTurn(){
        
          playerTurn = (playerTurn + 1) % allPlayers.length;

          currPlayer = allPlayers[playerTurn];

          //get current player's overall score
          <?php

              $query = "SELECT overall FROM scores WHERE Name = currPlayer AND turn = (SELECT MAX(turn) FROM scores WHERE Name = currPlayer);"
              
              $result = mysqli_query($conn, $query);

              if($result && $result->num_rows > 0){

                $row = $result->fetch_assoc();
                $overall = $row['overall'];
              }
            var overallScore = $overall;
          ?>

          if(gamemode == 'Countdown'){


          }
          else if(gamemode == 'Highscore'){

            $updatedScore = $overallScore + score;
          }
          else{

            console.log("uh oh- enum wrong");
          }
          

          //update turn score and first,second,or third
            
        }
        
        function endTurn(){
        
            
        }

        //temp
        function quit(){
        
            
        }




    </script>
</head>
<body>

    <table>
        <tr>
          <td><button class = "button" onclick="turn(20)">20</button></td>
          <td><button class = "button" onclick="turn(19)">19</button></td>
          <td><button class = "button" onclick="turn(18)">18</button></td>
          <td><button class = "button" onclick="turn(17)">17</button></td>
          <td><button class = "button" onclick="turn(16)">16</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="turn(15)">15</button></td>
          <td><button class = "button" onclick="turn(14)">14</button></td>
          <td><button class = "button" onclick="turn(13)">13</button></td>
          <td><button class = "button" onclick="turn(12)">12</button></td>
          <td><button class = "button" onclick="turn(11)">11</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="turn(10)">10</button></td>
          <td><button class = "button" onclick="turn(9)">9</button></td>
          <td><button class = "button" onclick="turn(8)">8</button></td>
          <td><button class = "button" onclick="turn(7)">7</button></td>
          <td><button class = "button" onclick="turn(6)">6</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="turn(5)">5</button></td>
          <td><button class = "button" onclick="turn(4)">4</button></td>
          <td><button class = "button" onclick="turn(3)">3</button></td>
          <td><button class = "button" onclick="turn(2)">2</button></td>
          <td><button class = "button" onclick="turn(1)">1</button></td>
        </tr>
        <tr>
          <td><button class = "button" onclick="">Bull</button></td>
          <td colspan = "3"><button class = "button" onclick="">Enter Turn</button></td>
          <td><button class = "button" onclick="add(0)">Miss</button></td>
          
        </tr>
        
         <tr>
           <td colspan="5"><button class = "button" id = "quitButton" onclick="quit()">Quit</button></td>
         </tr>
          
      </table>

</body>
</html>