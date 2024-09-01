<?php
    error_reporting(0);

    session_start();

    include("connection.php");

    if(!isset($_SESSION['Email'])) {
        header("Location: Bejelentkezes.php");
    }

    $first_name = $_SESSION['FirstName'];
    $last_name = $_SESSION['LastName'];
    $email = $_SESSION['Email'];

    if(isset($_POST['Submit'])) {
        $title = $_POST['Title'];
        $abstract = $_POST['Abstract'];
        $section = $_POST['Section'];
        $status = "Ellenőrzés";

        $sql = "SELECT * FROM section WHERE Name='$section'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $section_id = $row['SectionID'];
        }
        else {
            echo "<script>alert('Probléma adódott!(Szekció)')</script>";
        }

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf', 'docx');
        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 1000000) {
                    $fileNameNew = $title.".".$fileActualExt;
                    $fileDestination = 'D:\XAMPP\htdocs\Weblap\Dolgozatok/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = "SELECT * FROM paper WHERE Email='$email' AND SectionID='$section_id'";
                    $result = mysqli_query($conn, $sql);
                    if($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['Email'];
                        $section_id = $row['SectionID'];
                        $sql = "UPDATE Paper SET Title=?, Document=?, Abstract=?, Status=? WHERE Email='$email' AND SectionID='$section_id'";
                        $stmt = mysqli_stmt_init($conn);
                        if(mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "ssss", $title, $fileName, $abstract, $status);
                            mysqli_stmt_execute($stmt);

                            header("Location: Dolgozat.php?upload=success");
                            echo "<script>alert('A dolgozat Sikeresen fel lett töltve!')</script>";
                        }
                        else {
                            echo "<script>alert('Probléma adódott a dolgozat feltöltése során!')</script>";
                        }
                    }
                    else {
                        $sql = "INSERT INTO Paper(Title, Document, Abstract, Status, Email, SectionID) VALUES(?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sssssi", $title, $fileName, $abstract, $status, $email, $section_id);
                            mysqli_stmt_execute($stmt);

                            header("Location: Dolgozat.php?upload=success");
                            echo "<script>alert('A dolgozat Sikeresen fel lett töltve!')</script>";
                        }
                        else {
                            echo "<script>alert('Probléma adódott a dolgozat feltöltése során!')</script>";
                        } 
                    }

                    
                }
                else {
                    echo "<script>alert('Túl nagy a file-od mérete!')</script>";
                }
            }
            else {
                echo "<script>alert('Probléma adódott a file feltöltése közben!')</script>";
            }
        }
        else {
            header("Location: Dolgozat.php?file-type=incorrect");
            echo "<script>alert('Ilyen kiterjesztésű file-t nem tölthetsz fel')</script>";
        }

    }

?>