<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="user-scalable=no">
  <title>Score Display Page</title>
  <link id = "stylesheet" rel="stylesheet" type="text/css" href="styles/scoreDisplayPage.css">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="scripts/getCurrentPlayer.js"></script>
  <script type="text/javascript" src="scripts/updateTableCell.js"></script>
  <script type="text/javascript" src="scripts/displayNames.js"></script>
  <script type="text/javascript" src="scripts/displayInfoCD.js"></script>
  <script type="text/javascript" src="scripts/displayInfoHS.js"></script>
  <script type="text/javascript" src="scripts/checkForNewGame.js"></script>
  <script type="text/javascript" src="scripts/displayInfo.js"></script>
  <script type="text/javascript" src="scripts/generateTable.js"></script>
  <script type="text/javascript" src="scripts/rearrangePlayers.js"></script>

  <script>
      //get relevant game data
      <?php
        require 'scripts/connect.php';

        $query = "SELECT id, type, number_of_rounds, player_count, players FROM game_data";
        $result = mysqli_query($conn, $query);

        if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $mode = $row['type'];
          $game_id = $row['id'];
          $numRounds = $row['number_of_rounds'];
          $playerCount = $row['player_count'];
          $playersArray = $row['players'];
        }

        echo "var playerCount = '$playerCount';";
        echo "var gamemode = '$mode';";
        echo "var game_id = '$game_id';";
        echo "var numRounds = '$numRounds';";
        echo "var playersArray = '$playersArray';";
        
        $conn->close();
      ?>

        //determine sthe stylesheet based on the number of players and the gamemode
        switch(playerCount) {
          case '4':
            stylesheet.href = 'styles/scoreDisplayPage4.css';
            break;
          case '5':
            stylesheet.href = 'styles/scoreDisplayPage5.css';
            break;
          default:
            break;
        }

    //populate info cells of table
    generateTable();
    getCurrentPlayer();
    displayNames();
    displayInfo();

    async function updateInfo(){
      await updateTable();
      getCurrentPlayer();
      displayInfo();
      setTimeout(updateInfo, 100);
    }

    function updateTable() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: 'scripts/getNewTableFlag.php', // Replace with your PHP script's path
            method: 'GET',
            success: function(response) {
                if (response == true) {
                  generateTable();
                }
                resolve();
            },
            error: function(xhr, status, error) {
                reject(error); // Reject in case of an error
            }
        });
    });
}

    updateInfo();
    checkForNewGame();

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
  <div id = "generatedTable" style = "display: flex; flex-direction: column; align-items: center;"></div>
    <table class = "center gameInfo">
      <tr>
        <td class = "infoCell" id ="helpCell">D20 + D20 + D20</td>
        <script>
          switch(playerCount) {
            case '2':
              document.getElementById('helpCell').style.fontSize = '7.5rem';
              break;
            case '3':
              document.getElementById('helpCell').style.fontSize = '5.5rem';
              break;
          }
        </script>
      </tr>
    </table>
  </div>

</body>
</html>
