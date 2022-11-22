<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data dari database
$nik = $_SESSION['user']['nik'];
$result = mysqli_query($koneksi, "SELECT * FROM appointment JOIN pasien ON appointment.nik = pasien.nik JOIN psikolog ON appointment.psikolog_id = psikolog.psikolog_id WHERE appointment.nik = $nik;");
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
    <header>Daftar Jadwal Konsultasi yang Dipesan</header>
    <a href="logout.php">Log out</a>
    <a href="pemesanan.php">Pesan Jadwal Lain</a>

    <table border="1px">
        <tr>
            <th>No.</th>
            <th>Pasien</th>
            <th>Psikolog</th>
            <th>Tanggal Konsultasi</th>
            <th>Waktu Konsultasi</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php while( $row = mysqli_fetch_assoc($result) ) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row["nama_pasien"]; ?></td>
            <td><?= $row["nama_psikolog"]; ?></td>
            <td><?= $row["tanggal_pemesanan"]; ?></td>
            <td><?= $row["waktu_konsultasi"]; ?></td>
            <td>Rp150.000</td>
            <td><?= $row["status"]; ?></td>
            <td>
                <a href="bill.php?appointment_id=<?= $row["appointment_id"]; ?>">Bayar</a><br>
                <a href="edit.php?appointment_id=<?= $row["appointment_id"]; ?>">Edit</a><br>
                <a href="delete.php?appointment_id=<?= $row["appointment_id"]; ?>" onclick="return confirm('Apakah anda yakin untuk membatalkan konsultasi?');" name="batal">Batalkan</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endwhile; ?>
    </table>
</body>
</html>