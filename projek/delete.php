<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include("config.php");

//ambil appointment id dari daftar pesanan
$appointment_id = $_GET['appointment_id'];

//buat query hapus
$result = mysqli_query($koneksi, "DELETE  FROM appointment WHERE appointment_id = $appointment_id");

//cek apakah hapus berhasil
if($result){
    echo "<script>alert('Pemesanan berhasil dihapus!');
                document.location.href ='daftarpesanan.php'</script>";
}
?>