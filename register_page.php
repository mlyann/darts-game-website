<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function showEditUser() {
            var name = document.getElementById('edit_select').value;
            $.ajax({
                url: "/scripts/showEditUser.php",
                data: {
                    name: name
                },
                success: function(response) {
                    var url = response;
                    document.getElementById('img').src = url;
                }
            });

            document.getElementById('edit_name').value = name;

        }
    </script>
</head>
<body>
    <h1>User Registration</h1>

    <form action="scripts/adduser.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="image">Image URL:</label>
        <input type="text" name="image" id="image">
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

<h1>Edit User</h1>

<form action="scripts/editUser.php" method="POST" onchange="showEditUser()" onsubmit="return confirm('Are you sure you want to edit this user?');>
    <label for="edit_select">Name:</label>
    <select name="edit_select" id="edit_select">
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
    <img id="img" src = ""></img>
    <br><br>
    <label for="edit_name">New Name:</label>
    <input type="text" name="edit_name" id="edit_name" required>
    <br><br>
    <label for="edit_image">New Image URL:</label>
    <input type="text" name="edit_image" id="edit_image">
    <br><br>
    <input type="submit" value="Edit">
</form>



</body>
</html>