<?php
require 'connect.php';

$name = $_POST['name'];
$image = $_POST['image'] ?? null; // Use null coalescing operator for image

// Prepare SQL based on the presence of the image
if ($image) {
    $sql = "INSERT INTO users (name, image_url) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $image);
} else {
    $sql = "INSERT INTO users (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
}

// Start outputting HTML
echo "<!DOCTYPE html>";
echo "<html><head>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<title>User Registration</title>";
echo "<link rel='stylesheet' type='text/css' href='../styles/adduser.css'>";
echo "</head><body>";

if ($stmt->execute()) {
    echo "<div class='registerContainer'>";
    echo "<h1>Welcome " . htmlspecialchars($name) . " to Coretechs!</h1>";
    echo "<p>User registered successfully.</p>";
    echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
    echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>"; // New button to return to the registration page
    echo "</div>";
} else {
    echo "<div class='registerContainer'>";
    echo "<h1>Registration Error</h1>";
    echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
    echo "<button class='button' onclick='location.href=\"../homepage.php\"'>Return to Home</button>";
    echo "<button class='button' onclick='location.href=\"../register_page.php\"'>Return to Registration Page</button>"; // Also show this button in case of an error
    echo "</div>";
}

$stmt->close();
$conn->close();

echo "</body></html>";
?>
