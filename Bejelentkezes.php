<?php

    include("connection.php");

    session_start();

    error_reporting(0);

    if(isset($_SESSION['Email'])) {
        header("Location: Welcome.php");
    }


    if(isset($_POST['Submit'])) {
        $email = $_POST['Email'];
        $jelszo = $_POST['Password'];

        $sql = "SELECT * FROM confuser WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($jelszo, $row["Password"])) {
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['FirstName'] = $row['FirstName'];
                $_SESSION['LastName'] = $row['LastName'];
                $_SESSION['Role'] = $row['Role'];
                if($row['Role'] == "Hallgató") {
                    header("Location: Welcome_Hallgato.php");
                }
                elseif($row['Role'] == "Admin") {
                    header("Location: Welcome_Admin.php");
                }
                else {
                    header("Location: Welcome.php");
                }
                $email = "";
                $jelszo = "";
            }
            else {
                echo "<script>alert('A Megadott Email Vagy Jelszó Helytelen!')</script>";
            }
            
        }
        else {
            echo "<script>alert('A Megadott Email Vagy Jelszó Helytelen!')</script>";
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

        <h1>Bejelentkezés</h1>

        <div class="border"></div>
        <form class="contact-form" action="" method="POST">
            <input type="email" name="Email" class="contact-form-text" placeholder="Email" value="<?php echo $email; ?>" required>
            <input type="password" name="Password" class="contact-form-text" placeholder="Jelszó" value="<?php echo $_POST['Password']; ?>" required>
            <button name="Submit" class="contact-form-btn">Belépés</button>
            <br><a href="Elfelejtett_Jelszo.php">Elfelejtette a jelszavát?</a>   
        </form>

        <p>Még nem regisztráltál? Kattints <a href="Regisztralas.php">ide</a>!</p>

    </div>

</body>
</html>

    
</body>
</html>