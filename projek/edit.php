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
$query = mysqli_query($koneksi, "SELECT * FROM appointment JOIN psikolog ON appointment.psikolog_id = psikolog.psikolog_id WHERE appointment_id = $appointment_id");
$row = mysqli_fetch_assoc($query);

//cek status apakah sudah dibayar
if($row['status'] == 'PAID'){
    echo "<script>alert('Anda Sudah Tidak Bisa Mengubah Jadwal!');
                document.location.href ='daftarpesanan.php'</script>";
}

//cek apakah tombol edit sudah diklik
if ( isset($_POST['edit']) ){
    
    //ambil data dari form
    $nik = $_SESSION['user']['nik'];
    $tanggal_pemesanan = date("Y-m-d", strtotime($_POST['tanggal_pemesanan']));
    $psikolog_id = $_POST['psikolog_id'];
    $waktu_konsultasi = $_POST['waktu_konsultasi'];

    //buat query edit
    $result = mysqli_query($koneksi, "UPDATE appointment SET nik = '$nik', tanggal_pemesanan = '$tanggal_pemesanan', psikolog_id = '$psikolog_id', waktu_konsultasi = '$waktu_konsultasi' WHERE appointment_id = $appointment_id ");

    //cek apakah query berhasil
    if( $result == TRUE ){
        echo "<script>alert('Perubahan berhasil dibuat!');
                document.location.href ='daftarpesanan.php'</script>";
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
    <header>Jadwalkan konsultasimu sekarang</header>
    <a href="logout.php">Log out</a>
    <form action="" method="post">
        <fieldset>
            <p>
                <label for="tanggal_pemesanan">Tanggal Konsultasi: </label><br>
                <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" value="<?= $row["tanggal_pemesanan"]; ?>" required>
            </p>
            <p>
                <p>Psikolog yang dipilih sebelumnya: <?= $row["nama_psikolog"]?></p>
                <label for="psikolog_id">Psikolog baru: </label><br>
                <select id="psikolog_id" name="psikolog_id" required>
                    <option value=""></option>
                    <option value ="DJ6Z1">Dra. Soerjantini Rahayu, M.A.</option>
                    <option value ="JBTH2">Drs. Budi Santoso, M.Si.</option>
                    <option value ="M8WC3">Sri Rahmani, S.Psi., M.Psi., Psikolog</option>
                    <option value ="VNJ24">Bianca Siregar, S.Psi, Ph.D</option>
                    <option value ="UQ4W5">Dr. Slamet Hassan, S.Psi., M.Si.</option>
                </select>
            </p>
            <p>
                <p>Waktu konsultasi sebelumnya: <?= $row["waktu_konsultasi"]?> </p>
                <label for="waktu_konsultasi">Waktu Konsultasi: </label><br>
                <select id="waktu_konsultasi" name="waktu_konsultasi" required>
                        <option value=""></option>
                        <option value="10.00 - 11.00">10.00 - 11.00</option>
                        <option value="11.00 - 12.00">11.00 - 12.00</option>
                        <option value="13.00 - 14.00">13.00 - 14.00</option>
                        <option value="14.00 - 15.00">14.00 - 15.00</option>
                        <option value="15.00 - 16.00">15.00 - 16.00</option>
                        <option value="16.00 - 17.00">16.00 - 17.00</option>
                </select>
            </p>
        </fieldset>
        <button type="submit" name="edit">Ubah Pesanan</button>
    </form>
</body>
</html>