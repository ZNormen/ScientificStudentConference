<?php

    error_reporting(0);

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $txt = $_POST['Text'];
    $subj = $_POST['Subject'];


    require_once 'phpmailer/includes/PHPMailer.php';
    require_once 'phpmailer/includes/SMTP.php';
    require_once 'phpmailer/includes/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';
    
    if(isset($_POST['Submit'])) {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "<email>";
        $mail->Password = "<pass>";
        $mail->Subject = $subj;
        $mail->setFrom($email);
        $mail->isHTML(true);
        $mail->Body = "<h3>From: $name <br>
                        Email: $email <br>
                        Subject: $subj <br><br>
                        $txt </h3>";                  
        $mail->addAddress("<email>");
        if($mail->Send()) {
            echo "<script>alert('Az Email sikeresen el lett küldve!')</script>";
        }
        else {
            echo "<script>alert('Az Emailt nem sikerült elküldeni!')</script>";
        }

        $mail->smtpClose();

        $name = "";
        $email = "";
        $subj = "";
        $txt = "";
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyen-Olyan Konferencia: Kapcsolat</title>
    <link rel="stylesheet" href="Fooldal.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Kapcsolat.css">
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

    <section class="contact">
        <div class="content">
            <h2>Kapcsolat</h2>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Cím</h3>
                        <p>Szilágycseh, Str.Trandafirilor, Nr.10</p>
                    </div>
                </div>

                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Telefonszám</h3>
                        <p>+40 758 969 420</p> 
                    </div>
                </div>

                <div class="box">
                    <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>io.konfernecia@gmail.com</p>
                    </div>
                </div>

            </div>
            <div class="ContactForm">
                <form action="KapcsolatLogout.php" method="POST">
                    <div class="inputBox">
                        <input type="text" name="Name" value="<?php echo $name; ?>" required="required">
                        <span>Név</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="Email" value="<?php echo $email; ?>" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Subject" value="<?php echo $subj; ?>" required="required">
                        <span>Tárgy</span> 
                    </div>
                    <div class="inputBox">
                        <textarea name="Text" placeholder="Üzenet" value="<?php echo $txt; ?>" required="required"></textarea>
                    </div>
                    <div class="inputBox">
                        <button name="Submit">Küldés</button>   
                    </div>
                </form>   
            </div>
        </div>
    </section>


</body>
</html>