<?php
    include("connection.php");

    session_start();
    
    error_reporting(0);

    if(isset($_SESSION['Email'])) {
        header("Location: Bejelentkezes.php");
    }

    require_once 'phpmailer/includes/PHPMailer.php';
    require_once 'phpmailer/includes/SMTP.php';
    require_once 'phpmailer/includes/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['Submit'])) {
        $vezetek_nev = $_POST['FirstName'];
        $kereszt_nev = $_POST['LastName'];
        $email = $_POST['Email'];
        $jelszo = $_POST['Password'];
        $re_jelszo = $_POST['ConfirmPassword'];
        $tel = $_POST['PhoneNumber'];
        $intezmeny = $_POST['Institution'];
        $szerep = $_POST['Role'];

        if($jelszo == $re_jelszo) {
            $pass = password_hash($jelszo, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM confuser WHERE Email='$email'";
            $result = mysqli_query($conn, $sql);
            if(!$result->num_rows > 0) {
                $sql = "INSERT INTO confuser(FirstName, LastName, Email, PhoneNumber, Institution, Role, Password)
                        VALUES('$vezetek_nev', '$kereszt_nev', '$email', '$tel', '$intezmeny', '$szerep', '$pass')";
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo "<script>alert('Sikeresen Regisztráltál.')</script>";
                    
                    $subject = "Regisztrálás";
                    $mailFrom = $_POST['Email'];
                    $message = "Kedves " . $vezetek_nev ." ". $kereszt_nev."! Sikeresen regisztráltál az Ilyen-Olyan Konferenciára!";
                    $mailTo = $email;
                    $header = "From: " .  $vezetek_nev . " " . $kereszt_nev . "\n" . "Email: " . $email;

                    mail($mailTo, $subject, $message, $header);

                    $vezetek_nev = "";
                    $kereszt_nev = "";
                    $email = "";
                    $jelszo = "";
                    $re_jelszo = "";
                    $tel = "";
                    $intezmeny = "";
                    $szerep = "";
                }
                else {
                    echo "<script>alert('Probléma Adódott!')</script>";
                } 
            }
            else {
                echo "<script>alert('A Megadott Email Már Létezik!')</script>";
                $email = "";
            }   
        }
        else {
            echo "<script>alert('A Megadott Jelszavak Nem Egyeznek')</script>";
            $jelszo = "";
            $re_jelszo = "";
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
    <link rel="stylesheet" href="Regisztralas.css">
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

        <h1>Regisztrálás</h1>
        <div class="border"></div>

        <form class="contact-form" action="" method="POST">
            <input type="text" name="FirstName" class="contact-form-text" placeholder="Vezetéknév" value="<?php echo $vezetek_nev; ?>" required>
            <input type="text" name="LastName" class="contact-form-text" placeholder="Keresztnév" value="<?php echo $kereszt_nev; ?>" required>
            <input type="email" name="Email" class="contact-form-text" placeholder="Email" value="<?php echo $email; ?>" required>
            <input type="password" name="Password" class="contact-form-text" placeholder="Jelszó" pattern="[a-zA-Z]{6}[0-9]{2}" value="<?php echo $jelszo; ?>" required>
            <input type="password" name="ConfirmPassword" class="contact-form-text" placeholder="Jelszó Megerősítése" value="<?php echo $re_jelszo; ?>" required>
            <input type="tel" name="PhoneNumber" class="contact-form-text" placeholder="Telefonszám" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="<?php echo $tel; ?>" required>
            <input type="text" name="Institution" class="contact-form-text" placeholder="Intézmény" value="<?php echo $intezmeny; ?>">
            <select name="Role" class="contact-form-text" id="RoleSelect">
                <option value="" disabled selected hidden>Válasszd ki a szereped...</option>
                <option value="Hallgató">Hallgató</option>
                <option value="Előadó">Előadó</option>
            </select>
            <br>
            <button name="Submit" id="button" class="contact-form-btn">Regisztrálás</button>   
        </form>
        <br>
        <p>Regisztráltál már? Kattints <a href="Bejelentkezes.php">ide</a>, hogy jelnetkezz be!</p>
    </div>

    <script src="Role.js"></script>

</body>
</html>