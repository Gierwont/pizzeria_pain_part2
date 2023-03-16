<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzeria";


$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Nie połączono, błąd: " . $conn->connect_error);
}
function szyfruj_cezara($haslo, $przesuniecie)
        {
            $zaszyfrowane = "";
            $dlugosc = strlen($haslo);
            for ($i = 0; $i < $dlugosc; $i++) {
                $kod = ord($haslo[$i]);
                if (ctype_alpha($haslo[$i])) {
                    $kod_szyfr = ($kod + $przesuniecie - ($kod >= 65 && $kod <= 90 && $kod + $przesuniecie > 90 || $kod >= 97 && $kod <= 122 && $kod + $przesuniecie > 122) * 26);
                    $zaszyfrowane .= chr($kod_szyfr);
                } else {
                    $zaszyfrowane .= $haslo[$i];
                }
            }
            return $zaszyfrowane;
        }
