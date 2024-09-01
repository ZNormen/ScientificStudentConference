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
    <link rel="stylesheet" href="GYIK.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


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

    <div class="container">
        <img src="IOK-Hatter.jpg" alt="IOK-Hatter">
    </div>

    
    <div class="accordion">
        
        <h1>Gyakori Kérdések</h1>
        <div class="border"></div>

        <div class="card">
            <div class="card-header">
                <h3>Díjmentes-e a konfernecián való részvétel?</h3>
                <span class="fa fa-plus"></span>
            </div>
            <div class="card-body">
                <p>A konferencián való részvétel díjmentes, akár résztvevő vagy, akár néző.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Szükséges-e felsőoktatási végzettség a konfernecián való részvételhez?</h3>
                <span class="fa fa-plus"></span>
            </div>
            <div class="card-body">
                <p>Nem szükséges. Az egyetlen feltétel, hogy legalább 18 éves legyél.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Lehet-e csapatként is résztvenni a konferencián?</h3>
                <span class="fa fa-plus"></span>
            </div>
            <div class="card-body">
                <p>Természtesen. A csaptban készítet munkák részére nincs külön kategória, de az osztályozásnál figyelembe veszik, hogy hány ember vett részt a kutatásban.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Ha a vírushelyzet miatt ismét szigorításokat vezetnek be, a konferencia átlesz helyezve egy másik időpontra?</h3>
                <span class="fa fa-plus"></span>
            </div>
            <div class="card-body">
                <p>A korlátozás szintjétől függ. Ha lehet szervezni eseményeket kevés résztvevővel, akkor a helyszínen jelen lehetnek azok akik bekell mutassák munkájuk. Ha egyáltalán nem lehet szervezni eseményeket, akkor a bemutatók az online-térben fognak lezajlani.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Ha bármilyen oknál fogva nem tudok részt venni a<br>konferencia első napján, bemutathatom a második nap a kutatásom?</h3>
                <span class="fa fa-plus"></span>
            </div>
            <div class="card-body">
                <p>Ha időben értesíted a szervezőket, meglehet oldani, hogy áttegyék a bemutató időpontját a második napra. Ha nem sikerült értesíteni a szervezőket időben, akkor, ha egy másik résztvevő nem mondta le a részvételét vagy nem helyeztette át a bemutatójának az időpontját az első napra, sajnos nem lesz lehetőséged a munkádat bemutatni.</p>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="GYIK.js"></script>

</body>
</html>