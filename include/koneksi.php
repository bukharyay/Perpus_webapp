<?php


$server = 'localhost';
$username = 'root';
$password = '';
$database = 'db_perpus';

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    echo "<br><b>Errornya = </b><span style='color:red;'>" . mysqli_connect_error() . "</span>";
} else {
    echo '';
    // echo "<br><span style='color:green;'>koneksi sudah <b>berhasil</b>, selamat menikmati!</span>";
}
