<?php
require 'connect.php';

echo "<!DOCTYPE html>";
echo "<html><head>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<title>User Removal</title>";
echo "<link rel='stylesheet' type='text/css' href='../styles/adduser.css'>";
echo "</head><body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deregister_select']) && !empty($_POST['deregister_select'])) {
        $name = $_POST['deregister_select'];

        $stmt = $conn->prepare("DELETE FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            echo "<div class='registerContainer'>";
            echo "<h1>User " . htmlspecialchars($name) . " has been removed successfully.</h1>";
            echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
            echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
            echo "</div>";
        } else {
            echo "<div class='registerContainer'>";
            echo "<h1>Removal Error</h1>";
            echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
            echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
            echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
            echo "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='registerContainer'>";
        echo "<h1>Error</h1>";
        echo "<p>Error: Name is required.</p>";
        echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
        echo "</div>";
    }
} else {
    echo "<div class='registerContainer'>";
    echo "<h1>Error</h1>";
    echo "<p>Error: Invalid request method.</p>";
    echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>";
    echo "</div>";
}

$conn->close();

echo "</body></html>";
?>
