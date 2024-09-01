<?php

    session_start();

    if(!isset($_SESSION['Email'])) {
        header("Location: Bejelentkezes.php");
    }

    $first_name = $_SESSION['FirstName'];
    $last_name = $_SESSION['LastName'];

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyen-Olyan Konferencia Home Page</title>
    <link rel="stylesheet" href="Fooldal.css">
    <link rel="stylesheet" href="Visszaszamlalo.css">
</head>
<body>

    <nav>
        <input id="nav-toggle" type="checkbox">
        <a href="Welcome_Admin.php"><div class="logo"><img src="IOK-Logo.png" alt="IOK-Logo"></div></a>
        <ul class="links">
            <li><a href="Welcome_Admin.php">Főoldal</a></li>
            <li><a href="Program.php">Program</a></li>
            <li><a href="GYIK.php">GYIK</a></li>
            <li><a href="Kapcsolat.php">Kapcsolat</a></li>
            <a id="user" href="Dolgozat_Admin.php">
                <li><img src="user.png" id="user-logo"> </li>
                <li><p id="FirstName"><?php echo $_SESSION['FirstName']; ?></p></li>
                <li><p id="LastName"><?php echo $_SESSION['LastName']; ?></p></li>
            </a>
            <li><a href="Kijelentkezes.php" id="logout">Kijelentkezés</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>

    

    <div class="container">
        <img src="IOK-Hatter.jpg" alt="IOK-Hatter">
    </div>

    <div class="CountdownContainer">
        <h2 id="jelentkezz"><span>A konferencia kezdete: 2022.05.27.</span></h2> 
        <p id="countdown">
            <div class="countdown">
                <div id="day">Nap</div>
                <div id="hour">Óra</div>
                <div id="minute">Perc</div>
                <div id="second">Másodperc</div>
            </div> 
        </p>
    </div>

    

    <script src="Visszaszamlalo.js"></script>

</body>
</html>