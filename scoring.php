<!DOCTYPE html>
<html>
<head>
    <title>Darts</title>

    <?php require connect.php ?>

    <script>

        

        var currPlayer = "$playerName";
        var countdown = true;

        function turn(score){
        
            
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