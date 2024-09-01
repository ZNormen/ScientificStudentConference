<?php

    session_start();

    error_reporting(0);


    $email = $_SESSION['Email'];
    $first_name = $_SESSION['FirstName'];
    $last_name = $_SESSION['LastName'];
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
        $mail->Body = /*"<img src='cid:iok-logo_blck'>" .
                    '<br><br>' . */
                    "<h3>From: $first_name $last_name <br>
                        Email: $email <br>
                        Subject: $subj <br><br>
                        $txt </h3>";                  
        $mail->addAddress("<email>");
        //$mail->addEmbeddedImage("IOK-Logo_blck.png", 'iok-logo_blck');
        if($mail->Send()) {
            echo "<script>alert('Az Email sikeresen el lett küldve!')</script>";
        }
        else {
            echo "<script>alert('Az Emailt nem sikerült elküldeni!')</script>";
        }

        $mail->smtpClose();

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
                <form action="Kapcsolat.php" method="POST">
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