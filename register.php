<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" id="subpage">


        <?php
        require('connect.php');


        if ($_POST['login'] == "" || $_POST['pass'] == "") {
            echo "<h1>podałeś puste hasło lub login</h1>";
        } else {
            $login = $_POST['login'];
            $email = $_POST['email'];



            $pass = szyfruj_cezara(sha1($_POST['pass']), 3);


            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "INSERT INTO user (login,haslo,email,role) VALUES ('$login','$pass','$email','default')";

                if (mysqli_query($conn, $sql)) {
                    echo "<h1>Zarejestrowano pomyślnie</h1>";
                } else {
                    echo '<div class="text"><h1>błąd: ' . $sql . mysqli_error($conn) . '</h1></div>';
                }
            } else {
                echo ("<h1>Podano niepoprawny adres email</h1>");
            }
        }


        mysqli_close($conn);
        ?>
        <br>
        <div class="text"><a href="index.php">Powrót</a></div>
    </div>
</body>

</html>