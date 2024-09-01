<?php

    ob_start();

    error_reporting(0);

    session_start();

    include("connection.php");

    if(isset($_SESSION['Role'])) {
        if($_SESSION['Role'] == "Hallgató")
            header("Location: Welcome_Hallgato.php");
        elseif($_SESSION['Role'] == "Előadó")
            header("Location: Welcome.php");
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
    <link rel="stylesheet" href="Dolgozat_Admin.css">
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
            <a id="user" href="Dolgozat_Admin.php">
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

    
    <div class="contact-section">

        <h1>Dolgozatok Ellenőrzése</h1>
        <div class="border"></div>
        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>Előadó email</th>
                        <th>Szak</th>
                        <th>Cím</th>
                        <th>Abstract</th>
                        <th>Státusz</th>
                        <th colspan="2">Jóváhagyás</th>
                    </tr><br>
                </thead>
                <tbody>
                    <?php
                        $records = mysqli_query($conn, "SELECT * FROM paper");
                        while($data = mysqli_fetch_array($records)) {
                            $section_id = $data["SectionID"];
                            $sql = "SELECT Name FROM Section WHERE SectionID='$section_id'";
                            $result = mysqli_query($conn, $sql);
                            if($result->num_rows > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $section_name = $row["Name"]; 
                                $paper_id = $data["PaperID"]; ?>

                                <tr>
                                    <td><?php echo $data["Email"]; ?></td>
                                    <td><?php echo $section_name; ?></td>
                                    <td><?php echo $data["Title"]; ?></td>
                                    <td><?php echo $data["Abstract"]; ?></td> 
                                    <td><?php echo $data["Status"]; ?></td>
                                    <td id="table-btn"><form method="POST">
                                        <a id="jov" href="Dolgozat_Admin.php?jovahagyva=<?php echo $paper_id; ?>"><img id="jov" src="checked.png"></a>
                                        <a id="vissz" href="Dolgozat_Admin.php?visszautasitva=<?php echo $paper_id; ?>"><img id="vissz" src="delete-button.png"></a>
                                    </form></td>
                                </tr>
                            <?php
                            }
                            else {
                                echo "<script>alert('Nincs ilyen szak!')</script>";
                            }
                            
                        }
                    
                    ?>
            </tbody>
        </div>

    </div>

    <?php
    
        if(isset($_GET["jovahagyva"])) {
            $id = $_GET["jovahagyva"];

            $sql = "UPDATE paper SET Status='Elfogadva' WHERE PaperID='$id'";
            mysqli_query($conn, $sql);
            header("Location: Dolgozat_Admin.php");
            exit();
        }

        if(isset($_GET["visszautasitva"])) {
            $id = $_GET["visszautasitva"];

            $sql = "UPDATE paper SET Status='Visszautasítva' WHERE PaperID='$id'";
            mysqli_query($conn, $sql);
            header("Location: Dolgozat_Admin.php");
            exit();
        }

    ?>


</body>
</html>