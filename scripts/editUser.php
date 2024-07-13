<?php
require 'connect.php';

echo "<!DOCTYPE html>";
echo "<html><head>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<title>Edit User</title>";
echo "<link rel='stylesheet' type='text/css' href='../styles/adduser.css'>";
echo "</head><body>";

$name = $_POST['edit_select'];
$newName = $_POST['edit_name'];
if (isset($_POST['edit_image'])) {
    $image = $_POST['edit_image'];
    $sql = "UPDATE users SET image_url = ?, name = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $image, $newName, $name);
} else {
    $sql = "UPDATE users SET name = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newName, $name);
}

if ($stmt->execute()) {
    echo "<div class='registerContainer'>";
    echo "<h1>User edited successfully.</h1>";
    echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
    echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
    echo "</div>";
} else {
    echo "<div class='registerContainer'>";
    echo "<h1>Error in user update</h1>";
    echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
    echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
    echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
    echo "</div>";
}

$stmt->close();
$conn->close();

echo "</body></html>";
?>
