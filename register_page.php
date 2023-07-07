<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>

    <form action="scripts/adduser.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <input type="submit" value="Register">
    </form>

    <h1>User Deregistration</h1>

<form action="scripts/removeuser.php" method="POST" onsubmit="return confirm('Are you sure you want to remove this user?');">
    <label for="deregister_select">Name:</label>
    <select name="deregister_select" id="deregister_select">
        <?php
        require 'scripts/connect.php';
        $sql = "SELECT name FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                echo '<option value="' . $name . '">' . $name . '</option>';
            }
        }
        $conn->close();
        ?>
    </select>
    <br><br>
    <input type="submit" value="Deregister">
</form>



</body>
</html>