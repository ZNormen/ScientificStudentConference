<?php

    //Include required phpmailer files
    require 'phpmailer/includes/PHPMailer.php';
    require 'phpmailer/includes/SMTP.php';
    require 'phpmailer/includes/Exception.php';

    //Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Create instance of phpmailer
    $mail = new PHPMailer();

    //Set mailer to use smtp
    $mail->isSMTP();

    //Define smtp host
    $mail->Host = "smtp.gmail.com";

    //Enable smpt authentication
    $mail->SMTPAuth = "true";

    //Set type of encryption (ssl/tls)
    $mail->SMTPSecure = "tls";

    //Set port to connect to smtp
    $mail->Port = "587";

    //Set gmail username
    $mail->Username = "zorgonormen@gmail.com";

    //Set gmail password
    $mail->Password = "ImgwU2LeLe";

    //Set email subject
    $mail->Subject = "Teszt";

    //Set sender email
    $mail->setFrom("zorgonormen@gmail.com");
    
    /*$mail->isHTML(true);

    $mail->addAtachement();*/

    //Email body
    $mail->Body = "Gerappa";

    //Add recipient
    $mail->addAddress("io.konferencia@gmail.com");

    //Send email
    if($mail->Send()) {
        echo "<script>alert('Email Sent')</script>";
    }
    else {
        echo "<script>alert('Not Sent')</script>";
    }

    //Closing smtp connection
    $mail->smtpClose();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konferencia Adatbazis</title>
    <link rel="stylesheet" href="Fooldal.css">
    <!-- <link rel="stylesheet" href="index.css"> -->
</head>
<body>

    <div class="container">
        <img src="IOK-Hatter.jpg" alt="IOK-Hatter">
    </div>

    <nav>
        <input id="nav-toggle" type="checkbox">
        <a href="Fooldal.html"><div class="logo"><img src="IOK-Logo.png" alt="IOK-Logo"></div></a>
        <ul class="links">
            <li><a href="Fooldal.html">Főoldal</a></li>
            <li><a href="Program.html">Program</a></li>
            <li><a href="GYIK.html">GYIK</a></li>
            <li><a href="Bejelentkezes.php">Bejelentkezés</a></li>
            <li><a href="Regisztralas.php">Regisztrálás</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    
</body>
</html>