<?php
              require 'connect.php';

              $turnScores = json_decode($_POST['turnScores']);
              $name = $_POST['name'];
              
              $query = "UPDATE scores 
              SET 
                first = turnScores[0],
                second = turnScores[1],
                third = turnScores[2]
              WHERE Name = $name
                AND turn = (SELECT MAX(turn) FROM scores WHERE Name = $name)";

            $result = mysqli_query($conn, $query);

            if(!$result){
                echo "Error updating turn scores:" . mysqli_error($conn);
            }
            
            $conn->close();
?>