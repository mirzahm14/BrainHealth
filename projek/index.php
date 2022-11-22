<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Counseling</title>
</head>
<body>
    <header>
        <h3>Ini header</h3>
        <a href="logout.php">Log out</a>
    </header>
    <p>
        <a href="pemesanan.php">Jadwalkan Sekarang</a><br>
        <a href="daftarpesanan.php">Jadwal Konsultasimu</a>
    </p>
</body>
</html>