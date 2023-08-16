<!DOCTYPE html>
<html>
<head>
    <title>Victory Page</title>
    <link id = "stylesheet" rel="stylesheet" type="text/css" href="styles/winPagePhone.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/checkForNewGame.js"></script>
    <script>
        //this is weird but it lets me test on testserver and prod
        switch(document.referrer[document.referrer.length - 5]) {
            case 'e':
                stylesheet.href = "styles/winPageIpad.css";
                break;
            default:
                stylesheet.href = "styles/winPagePhone.css";
                break;
        }
    </script>
</head>
<body>
        <?php
        require 'scripts/connect.php';

        $winnerQuery = "SELECT name FROM wins ORDER BY time DESC LIMIT 1;";
        $winnerResult = mysqli_query($conn, $winnerQuery);
        $winnerRow = mysqli_fetch_assoc($winnerResult);
        $winner = $winnerRow['name'];

        $imageQuery = "SELECT image_url FROM users WHERE name = '$winner';";
        $imageResult = mysqli_query($conn, $imageQuery);
        $imageRow = mysqli_fetch_assoc($imageResult);
        $image = $imageRow['image_url'];
        if ($image == '') {
            $image = "https://www.coretechs.com/wp-content/uploads/2020/08/Coretechs_Mark.png";
        }

        $avgQuery = "SELECT average FROM scores WHERE name = '$winner' ORDER BY average DESC LIMIT 1;";
        $avgResult = mysqli_query($conn, $avgQuery);
        $avgRow = mysqli_fetch_assoc($avgResult);
        $avg = $avgRow['average'];

        $conn->close();

        $html = 
        '<div class = "winnerContainer">
        <div class="confetti-container" id="confettiContainer"></div>
        <img class = "profile" src="' . $image . '">
        <p>' . $winner . ' wins!</p>
        <p>Average: </p><p class ="avg">' . $avg . '</p>
        <div class = "buttonContainer">
        <a href="/create_game_page.php"><button>New Game</button></a>
        <a href="/homepage.php"><button>Homepage</button></a>
        </div>
        </div>';

        echo $html;
        ?>



<script>
    <?php
    require 'scripts/connect.php';

    $idQuery = "SELECT id FROM game_data;";
    $idResult = mysqli_query($conn, $idQuery);
    $idRow = mysqli_fetch_assoc($idResult);
    $game_id = $idRow['id'];

    $conn->close();

    echo "var game_id = '$game_id';\n";
    ?>

    checkForNewGame();

    // Generate confetti elements
    const container = document.getElementById('confettiContainer');
    const confettiCount = 50;
    const colors = ['red', 'yellow', 'blue'];

    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement('div');
        const randomColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.backgroundColor = randomColor;
        confetti.className = 'confetti';
        confetti.style.left = `${Math.random() * 100}%`;
        confetti.style.animationDelay = `${Math.random()}s`;
        container.appendChild(confetti);
    }
</script>
</body>
</html>
