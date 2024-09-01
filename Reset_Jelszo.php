<?php

    include("connection.php");

    if(!isset($_GET["code"])) {
        exit("Az oldal nem létezik!");
    }
    
    $code = $_GET["code"];

    $getEmailQuery = mysqli_query($conn, "SELECT email FROM resetpasswords WHERE code='$code'");
    if(mysqli_num_rows($getEmailQuery) == 0) {
        exit("Az oldal nem létezik!");
    }

    if(isset($_POST["ResetSubmit"])) {
        $password = $_POST["Password"];
        $re_password = $_POST["RePassword"];
        if($password != $re_password) {
            echo "<script>alert('A két jelszó nem egyezik!')</script>";
        }
        else {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $row = mysqli_fetch_array($getEmailQuery);
            $email = $row["email"];

            $query = mysqli_query($conn, "UPDATE confuser SET Password='$pass' WHERE Email='$email'");
            
            if($query) {
                $query = mysqli_query($conn, "DELETE FROM resetpasswords WHERE code='$code'");
                echo "<script>alert('Jelszó sikeresen megváltoztatva!')</script>";
                header("Location: Bejelentkezes.php");
            }
            else {
                echo "<script>alert('Probléma adódott!')</script>";
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyen-Olyan Konferencia Home Page</title>
    <link rel="stylesheet" href="Fooldal.css">
    <link rel="stylesheet" href="Bejelentkezes.css">
</head>
<body>

    <nav>
        <input id="nav-toggle" type="checkbox">
        <a href="Fooldal.html"><div class="logo"><img src="IOK-Logo.png" alt="IOK-Logo"></div></a>
        <ul class="links">
            <li><a href="Fooldal.html">Főoldal</a></li>
            <li><a href="Program.html">Program</a></li>
            <li><a href="GYIK.html">GYIK</a></li>
            <li><a href="KapcsolatLogout.php">Kapcsolat</a></li>
            <li><a href="Bejelentkezes.php">Bejelentkezés</a></li>
            <li><a href="Regisztralas.php">Regisztrálás</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>

    <div class="contact-section">
        <form class="contact-form" action="" method="POST">
                <input type="password" name="Password" class="contact-form-text" placeholder="Új Jelszó" required>
                <input type="password" name="RePassword" class="contact-form-text" placeholder="Új Jelszó Megerősítése" required>
                <button type="submit" name="ResetSubmit" class="contact-form-btn">Jelszó Megváltoztatása</button>
        </form>

    </div> 

</body>
</html>