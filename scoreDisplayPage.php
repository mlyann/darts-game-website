<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="user-scalable=no">
    <title>Score Display Page</title>
    <link rel="stylesheet" type="text/css" href="styles/scoreDisplayPage.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/getCurrentPlayer.js"></script>
    <script type="text/javascript" src="scripts/updateTableCell.js"></script>
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


        //populate info cells of table
        getCurrentPlayer();
        displayNames();
        displayInfo();




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
    <td class = "infoCell" id ="helpCell">D20 + D20 + D20</td>
  </tr>
</table>
      </div>


</body>
</html>
