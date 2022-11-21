<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil appointment id dari daftar pesanan
$appointment_id = $_GET['appointment_id'];

//buat query tergantung dari appointment
$query = mysqli_query($koneksi, "SELECT * FROM appointment JOIN psikolog ON appointment.psikolog_id = psikolog.psikolog_id JOIN pasien ON appointment.nik = pasien.nik WHERE appointment_id = $appointment_id");
$row = mysqli_fetch_assoc($query);

//cek apakah tombol bayar sudah diklik
if ( isset($_POST['bayar']) ){
    //ambil data dari formulir
    $appointment_id = $appointment_id;
    $tagihan = 'Rp150.000';
    $jenis_pembayaran = $_POST['jenis_pembayaran'];

    //buat query
    $result = mysqli_query($koneksi, "INSERT INTO pembayaran VALUES ('$appointment_id', '$tagihan', '$jenis_pembayaran')");

    //cek query berhasil atau tidak
    if($result){
        $status = mysqli_query($koneksi, "UPDATE appointment SET status = 'PAID' WHERE appointment_id = $appointment_id");
        echo "<script>alert('Pembayaran berhasil dibuat!');
                document.location.href ='daftarpesanan.php'</script>";
    } else {
        echo "<script>alert('Pembayaran gagal dibuat!');
                document.location.href ='bill.php'</script>";
    }
}

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
    <header>Bayar dulu bos!</header>
    <a href="logout.php">Log Out</a>
    <a href="daftarpesanan.php">Kembali ke daftar konsultasi</a>

    <form action="" method="post">
        <fieldset>
            <p>Nama pasien: <?= $row['nama_pasien']?></p>
            <p>Nama psikolog: <?= $row['nama_psikolog']?></p>
            <p>Tanggal konsultasi: <?= $row['tanggal_pemesanan']?></p>
            <p>Waktu konsultasi: <?= $row['waktu_konsultasi']?></p>
            <p>Total tagihan: Rp150.000</p>
            <p>
                <label for="jenis_pembayaran">Pilih Jenis Pembayaran: </label>
                <select name="jenis_pembayaran" id="jenis_pembayaran">
                    <option value="" disabled selected>Pilih jenis pembayaran</option>
                    <option value="gopay">Go-Pay</option>
                    <option value="ovo">OVO</option>
                    <option value="dana">DANA</option>
                    <option value="bank">Transfer Bank</option>
                </select>
            </p>
        </fieldset>
        <button type="submit" name="bayar">Bayar</button>
    </form>
</body>
</html>