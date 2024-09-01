<?php

    error_reporting(0);

    include("connection.php");

    if(isset($_SESSION['Email'])) {
        header("Location: Welcome.php");
    }

    require_once 'phpmailer/includes/PHPMailer.php';
    require_once 'phpmailer/includes/SMTP.php';
    require_once 'phpmailer/includes/Exception.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $email = $_POST["email"];

    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';
    if(isset($_POST["ResetRequestSubmit"])) {
        
        $code = uniqid(true);
        $query = mysqli_query($conn, "INSERT INTO resetpasswords(code, email) VALUES('$code', '$email')");
        if(!$query) {
            echo "<script>alert('Probléma adódott'!)</script>";
        }


        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "<email>";
        $mail->Password = "<pass>";
        $mail->Subject = "IOK Jelszó Megváltoztatása";
        $mail->setFrom($email);
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/Reset_Jelszo.php?code=$code";
        $mail->isHTML(true);
        $mail->Body = "<p>Igényelted a jelszavad megváltoztatását! A linkre kattintva a jelszavad megváltoztatásának az oldalára 
                        leszel irányítva. Ha nem te igényelted a jelszavad megváltoztatását, ezt az emailt figyelmen
                        kívül lehet hagyni!</p><br>" . "$url";                  
        $mail->addAddress($email);
        if($mail->Send()) {
            echo "<script>alert('Az Email sikeresen el lett küldve!')</script>";
        }
        else {
            echo "<script>alert('Az Emailt nem sikerült elküldeni!')</script>";
        }

        $mail->smtpClose();
    }

    

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyen-Olyan Konferencia Elfelejtett Jelszó</title>
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
            <p>Kérjük írd be az email címed! A megadott címre küldjük a linket, ami a jelszó megváltoztatása oldalunkhoz fogja irányítani.</p>
            <input type="email" name="email" class="contact-form-text" placeholder="Email" required>
            <button type="submit" name="ResetRequestSubmit" class="contact-form-btn">Küldés</button><br>
        </form>

        

    </div>

</body>
</html>