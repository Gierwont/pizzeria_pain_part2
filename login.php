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

        $login = $_POST['login'];
        $_SESSION["login"] = $login;




        $pass = szyfruj_cezara(sha1($_POST['pass']), 3);

        $result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM `user` WHERE `login` = '$login' AND `haslo` = '$pass'"));
        if ($result[0] == 0) {
            echo '<h1>niepoprawne hasło lub login</h1>';
        } else {
            $sql = "SELECT id FROM user WHERE login = '$login'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $_SESSION["id"] = $id;

            $sql = "SELECT role FROM user WHERE login = '$login'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $role = $row['role'];
            $_SESSION["role"] = $role;

            header("Location: /main.php");
        }
        mysqli_close($conn);
        ?>
        <a href="index.php">Powrót</a>
    </div>
</body>

</html>