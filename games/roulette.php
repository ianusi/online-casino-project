<?php

// Login check, don't remove!
include_once('../connection.php');

// gets users money
if (!isset($_SESSION['money'])) {
    $_SESSION['money'] = 500; // Starting with 500 rubles
}

echo '<div class="back"><a href="../index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd" />
                    </svg>Back home</a><hr><p>money: ' . $_SESSION['money'] . '</p></div>';

// Redirect to login if user is not logged in
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: ../login.php');
    exit(); // Terminate script execution after redirect
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino - Russian roulette</title>
    <link rel="stylesheet" href="../style.css">
    <!-- The font, don't remove!! -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body class="roulette-body">
    <header class="roulette-navbar">
        <div>
            <img src="../assets/images/logo.png" alt="Logo">
            <h2>90 Casino</h2>
        </div>
        <div>
            <a href="../settings.php">Settings</a>
            <a href="../logout.php">Logout</a>
        </div>
    </header>

    <div class="roulette-container">
        <h1 class="roulette-h1">Russian Roulette</h1>

        <form action="roulette.php" method="post">
            <button type="submit" name="trigger">Pull the trigger!</button>
            <button type="submit" name="spin">Spin the barrel</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['trigger'])) {


                // 40% win chance and 60% losing chance
                $outcome = mt_rand(1, 10);

                if ($outcome <= 4) {
                    $_SESSION['money'] += 100; // Win: 100 rubles
                    echo "<h2 style='color: green;'>You survived and won 100 rubles.</h2>";
                } else {
                    $_SESSION['money'] -= 50; // Lose: 50 rubles
                    echo "<h2 style='color: red;'>You died and lost 50 rubles.</h2>";
                }
            } elseif (isset($_POST['spin'])) {
                // code for spinning the barrel, skipping a turn
                echo "<h2 style='color: black;'>You spun the barrel, the next turn is skipped.</h2>";
            }
        }
        ?>
    </div>

    <div class="roulette-image">
        <img class="roulette-revolver" src="../assets/images/roulette-revolver.png" alt="revolver" />
    </div>

    <footer class="absolutefooter">
        <div>
            <img src="../assets/images/logo.png">
            <h4>90 Casino</h4>
        </div>

        <div>
            <p>Made by: Lennard, Kars, Sven, Dominique</p>
        </div>
    </footer>

</body>

</html>