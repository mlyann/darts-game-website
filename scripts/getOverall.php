<?php

            $name = $_POST['name'];

            $query = "SELECT overall FROM scores WHERE Name = name AND turn = (SELECT MAX(turn) FROM scores WHERE Name = name);"

            $result = mysqli_query($conn, $query);

            if(!$result){
                echo "Error getting overall score:" . mysqli_error($conn);
            }

            if($result && $result->num_rows > 0){

                $row = $result->fetch_assoc();
                $overall = $row['overall'];
            }

            echo "var overallScore = $overall";
?>