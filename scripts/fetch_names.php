<?php
    require 'connect.php';

    $sql = "SELECT name FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            echo "var option = document.createElement('option');\n";
            echo "option.value = '$name';\n";
            echo "option.textContent = '$name';\n";
            echo "select.appendChild(option);\n";
        }
    }

    $conn->close();
?>