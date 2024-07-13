# Darts App

## Name
Darts App

## Description
This is an internship project of Sam Hopkins and Daniel Wang. The end goal is to create a web app that allows competitors to:
1) View and update a live scoreboard during a game of darts (Countdown or Highscore)
2) Maintain a leaderboard of win data 
3) Maintain advanced stats (potential feature)

## Installation
```php
<?php
//connect
$servername = "";
$username = "";
$password = "";
$database = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
This is the code for connect.php, which is needed for the app to work but is inside of the gitignore.

## Production Deployee
Open the path of the file: 
```
ubuntu@DartsProd:/var/www/html/darts-prod/darts-app$ 
```
Then do the updates:
```
git pull production prod
``` 

## Authors
Mr. Yang
