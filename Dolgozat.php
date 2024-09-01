<?php
    error_reporting(0);

    session_start();

    include("connection.php");

    if(isset($_SESSION['Role'])) {
        if($_SESSION['Role'] == "Hallgató")
            header("Location: Welcome_Hallgato.php");
        elseif($_SESSION['Role'] == "Admin")
            header("Location: Welcome_Admin.php");
    }

    if(isset($_GET["upload"])) {
        if($_GET["upload"] == "success") {
            echo "<script>alert('Sikeresen feltöltötted a dolgozatod!')</script>";
        }
    }

    if(isset($_GET["file-type"])) {
        if($_GET["upload"] == "incorrect") {
            echo "<script>alert('Ilyen kiterjesztésű file-t nem tölthetsz fel')</script>";
        }
    }

    if(!isset($_SESSION['Email'])) {
        header("Location: Bejelentkezes.php");
    }

    $first_name = $_SESSION['FirstName'];
    $last_name = $_SESSION['LastName'];
    $email = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilyen-Olyan Konferencia Home Page</title>
    <link rel="stylesheet" href="Fooldal.css">
    <link rel="stylesheet" href="Dolgozat.css">
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
            <!-- <li><a href="Dolgozat.php">Dolgozat Feltöltése</a></li> -->
            <li><a href="Kijelentkezes.php" id="logout">Kijelentkezés</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>

    
    <div class="contact-section">

        <!-- <div class="container">
            <img src="IOK-Hatter.jpg" alt="IOK-Hatter">
        </div> -->

        <h1>Felhasználói Felület</h1>
        <div class="border"></div>

        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>Szak</th>
                        <th>Cím</th>
                        <th>Abstract</th>
                        <th>Státusz</th>
                    </tr>
                </thead><br>
                <tbody>
                <?php

                $records = mysqli_query($conn, "SELECT * FROM paper WHERE Email='$email'");
                while($data = mysqli_fetch_array($records)) {
                    $section_id = $data["SectionID"];
                    $sql = "SELECT Name FROM Section WHERE SectionID='$section_id'";
                    $result = mysqli_query($conn, $sql);
                    if($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $section_id = $row["Name"];?>
                        <tr>
                            <td><?php echo $section_id; ?></td>
                            <td><?php echo $data["Title"]; ?></td>
                            <td><?php echo $data["Abstract"]; ?></td>
                            <td><?php echo $data["Status"]; ?></td>
                        </tr>

                    <?php
                    }
                    else {
                        echo "<script>alert('Nincs ilyen szak!')</script>";
                    }
                }
            
                    ?>
                </tbody>
            </table>
        </div>    

        <form class="contact-form" action="Feltoltes.php" method="POST" enctype="multipart/form-data">
            <select name="Section" class="contact-form-text">
                <option value="" disabled selected hidden>Válasszd ki a szakot...</option>
                <?php
                    $records = mysqli_query($conn, "SELECT Name FROM section");
                    while($data = mysqli_fetch_array($records)) {
                        echo "<option value='". $data["Name"] . "'>" . $data["Name"] . "</option>";
                    }
                ?>
            </select>
            <input type="text" name="Title" class="contact-form-text" placeholder="Dolgozat Címe" required>
            <textarea name="Abstract" placeholder="Abstract" rows="7" cols="78" required="required"></textarea>
            <input type="file" name="file" class="contact-form-text" required>
            <p id="kiterj" class="kiterj">Elfogadott kiterjesztésű file-ok: .pdf</p>
            <br>
            <button name="Submit" id="button" class="contact-form-btn">Dolgozat Feltöltése</button>   
        </form>

    </div>


</body>
</html>