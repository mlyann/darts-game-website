<?php
  require 'connect.php';

  function newTurn ($type) { //helper function to update game_data
    global $conn;
    global $currentPlayer;

    updatePlayerAverage($currentPlayer);

    $query = "SELECT players FROM game_data";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error getting players: " . mysqli_error($conn);
    }

    $playerNames = [];

    while ($row = $result->fetch_assoc()) {
        $jsonNames = $row['players'];
        $namesArray = json_decode($jsonNames, true);
        
        if (is_array($namesArray)) {
            $playerNames = array_merge($playerNames, $namesArray);
        }
    }
    
    $currentPlayerIndex = array_search($currentPlayer, $playerNames);
    if ($currentPlayerIndex == (count($playerNames) - 1)) {
      
      $nextPlayer = $playerNames[0];
    }
    else {
      $nextPlayer = $playerNames[$currentPlayerIndex + 1];
    }
    $sql = "UPDATE game_data SET dartIndex = '0', currentPlayer ='$nextPlayer'";

    mysqli_query($conn, $sql);
  }

  function updatePlayerAverage($player) {
    global $conn;

    $startingQuery = "SELECT starting_points FROM game_data";
    $startingResult = mysqli_query($conn, $startingQuery);
    $startingRow = mysqli_fetch_assoc($startingResult);
    $starting_points = $startingRow['starting_points'];

    $scoresQuery = "SELECT overall, turn FROM scores WHERE Name = '$player' AND turn = (SELECT MAX(turn) FROM scores WHERE Name = '$player');";
    $scoresResult = mysqli_query($conn, $scoresQuery);
    $scoresRow = mysqli_fetch_assoc($scoresResult);
    $turn = $scoresRow['turn'];
    $overall = $scoresRow['overall'];

    $avg = round(($starting_points - $overall) / ($turn - 1), 1);
//TODO THIS UPDATES EVERY COLUMN IT IS INEFFICIENT
    $avgQuery = "UPDATE scores SET average = $avg WHERE Name = '$player';";
    mysqli_query($conn, $avgQuery);
  }

  //get currentPlayer
  $sql = "SELECT currentPlayer FROM game_data";
  $playerResult = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($playerResult);
  $currentPlayer = $row['currentPlayer'];

  // Get the maximum turn value 
  $subQuery = "SELECT MAX(turn) FROM scores WHERE Name = '$currentPlayer'";
  $result = mysqli_query($conn, $subQuery);
  $row = mysqli_fetch_assoc($result);
  $maxTurn = $row['MAX(turn)'];

  //get overall and lastMult
  $overallQuery = "SELECT overall, lastMult FROM scores WHERE Name = '$currentPlayer' AND turn = $maxTurn";
  $overallResult = mysqli_query($conn, $overallQuery);
  $row = mysqli_fetch_assoc($overallResult);
  $overall = $row['overall'];
  $lastMult = $row['lastMult'];

  //winner
  //check win conditions
  if ($overall == 0 && $lastMult == 2) {

    $sql = "INSERT INTO wins (name, time) VALUES ('$currentPlayer', NOW())";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$currentPlayer', -353, 999)";
    mysqli_query($conn, $sql);

  }//bust
  else if ($overall <= 1) {

    $oldOverallQuery = "SELECT SUM(COALESCE(overall,0) + COALESCE(first,0) + COALESCE(second,0) + COALESCE(third,0)) AS oldOverall
    FROM scores WHERE Name = '$currentPlayer' AND turn = $maxTurn";

    $oldOverallResult = mysqli_query($conn, $oldOverallQuery);
    $row = mysqli_fetch_assoc($oldOverallResult);

    $oldOverall = $row['oldOverall'];
    $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$currentPlayer', $oldOverall, $maxTurn + 1)";
    mysqli_query($conn, $sql);

    $sql = "UPDATE scores SET overall = $oldOverall WHERE name = '$currentPlayer' AND turn = $maxTurn;";
    mysqli_query($conn, $sql);

  
    newTurn('bust');
  }
  else {

    $sql = "INSERT INTO scores (name, overall, turn) VALUES ('$currentPlayer', $overall, $maxTurn + 1)";
    mysqli_query($conn, $sql);

    newTurn('standard');
  }

  $conn->close();
  ?>