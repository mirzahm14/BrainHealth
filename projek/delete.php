<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include("config.php");

//ambil appointment id dari daftar pesanan
$appointment_id = $_GET['appointment_id'];

$rowbill = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE appointment_id = $appointment_id");

//cek apakah pesanan sudah dibayar
if (mysqli_num_rows($rowbill) === 1){
    //query hapus
    $result1 = mysqli_query($koneksi, "DELETE  FROM pembayaran WHERE appointment_id = $appointment_id");
    $result2 = mysqli_query($koneksi, "DELETE  FROM appointment WHERE appointment_id = $appointment_id");

    if($result1 && $result2){
        echo "<script>alert('Pemesanan berhasil dibatalkan tanpa ada refund!');
                    document.location.href ='daftarpesanan.php'</script>";
    }
} else {
    //query hapus
    $result2 = mysqli_query($koneksi, "DELETE  FROM appointment WHERE appointment_id = $appointment_id");
    
    //cek query
    if($result2){
        echo "<script>alert('Pemesanan berhasil dibatalkan!');
                    document.location.href ='daftarpesanan.php'</script>";
    }
}