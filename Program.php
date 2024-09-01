<?php

    session_start();

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
    <link rel="stylesheet" href="Program.css">
</head>
<body>

    <nav>
        <input id="nav-toggle" type="checkbox">
        <a href="Welcome.php"><div class="logo"><img src="IOK-Logo.png" alt="IOK-Logo"></div></a>
        <ul class="links">
            <li><a href="Welcome.php">Főoldal</a></li>
            <li><a href="Program.php">Program</a></li>
            <li><a href="GYIK.php">GYIK</a></li>
            <li><a href="Kapcsolat.php">Kapcsolat</a></li>
            <a id="user" href="Dolgozat.php">
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

    <div class="ColumnContainer">

        <h1>Program</h1>
        <div class="border"></div>

        <div class="row">

            <div class="column">
            <h2>Csütörtök (Május 26.)</h2>
            <p>
                09:00 - Megnyitó előadás
                <br>
                09:30 - Dolgozatok bemutatása
                <br>
                12:30 - Szünet
                <br>
                13:30 - Dolgozatok bemutatása
                <br>
                18:00 - Előadást tart: Bodea György, egyetemi tanár
            </p>
            </div>

            <div class="column">
            <h2>Péntek (Május 27.)</h2>
            <p>
                09:30 - Dolgozatok bemutatása
                <br>
                12:30 - Szünet
                <br>
                13:30 - Dolgozatok bemutatása
                <br>
                18:00 - Előadást tart: Antal Katalin, egyetemi tanár
            </p>
            </div>

            <div class="column">
            <h2>Szombat (Május 28.)</h2>
            <p>
                18:00 - Eredményhídetés
            </p>
            </div>

        </div>
        
    </div>

    
    

</body>
</html>