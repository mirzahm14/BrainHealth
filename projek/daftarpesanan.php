<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data dari database
$username = $_SESSION['user']['username'];
$result2 = mysqli_query($koneksi, "SELECT * FROM pasien WHERE username='$username'");
$result = mysqli_query($koneksi, "SELECT * FROM appointment JOIN pasien ON appointment.username = pasien.username JOIN psikolog ON appointment.psikolog_id = psikolog.psikolog_id WHERE appointment.username = '$username';");
$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

if( isset($_POST['pesan']) ){
    header("Location: pemesanan.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Konsultasi-BrainHealth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="css/daftarstyle.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
        <div class="container-fluid">
            <img src="assets/Mental Health Solution.png" class="img-fluid text-center" width="50px" height="50px" alt="logo">
            <a class="navbar-brand" href="#">BrainHealth</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="profilepsikolog.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    More
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="daftarpesanan.php">Riwayat Konsultasi</a></li>
                </ul>
                </li>
            </ul>
            <ul class="d-flex">
                <a class="profile" style="padding-top: 7px;" href="profile.php">
                    <img src="assets/icon-profile.png" alt="profilelogo"/>
                </a>
                <a class="nav-link m-2"> Hi, <?= $row2['nama_pasien']?></a>
                    <button class="btn btn-outline-warning" style="border-radius: 15px;" type="submit" ><a href="logout.php" class="logout">Log Out</a></button>
            </ul>
            </div>
        </div>
        </nav>
        <!-- Navbar end -->
    <div style="margin: 20px; padding: 10px;">
    <img src="assets/card-R.png" class="rounded mx-auto d-block img-fluid" style="margin-bottom: 50px; height: auto;" alt="...">
    <!-- Table Start -->
    <table class="table shadow-lg p-3 mb-5 bg-body rounded">
        <treat>
        <tr class="text-center">
            <th>No</th>
            <th>Pasien</th>
            <th>Psikolog</th>
            <th>Tanggal Konsultasi</th>
            <th>Waktu Konsultasi</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </treat>
        <?php $i = 1; ?>
        <?php mysqli_data_seek($result,0); ?>
        <?php while( $row = mysqli_fetch_assoc($result) ) : ?>
        <tbody>
        <tr>
            <td class="text-center"><?= $i ?></td>
            <td class="text-center"><?= $row["nama_pasien"]; ?></td>
            <td class="text-center"><?= $row["nama_psikolog"]; ?></td>
            <td class="text-center"><?= $row["tanggal_pemesanan"]; ?></td>
            <td class="text-center"><?= $row["waktu_konsultasi"]; ?></td>
            <td class="text-center">Rp150.000</td>
            <td class="text-center"><?= $row["status"]; ?></td>
            <td class="d-grid mx-auto">
                <button class="btn btn-outline-success"  ><a href="bill.php?appointment_id=<?= $row["appointment_id"]; ?>" class="bayar">Bayar</a></button><br>
                <button class="btn btn btn-outline-danger" ><a href="delete.php?appointment_id=<?= $row["appointment_id"]; ?>" class="batal">Batalkan</a></button>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Table End -->
    <form method="post">
    <button class="btn btn-secondary d-grid gap-2 col-6 mx-auto" style="border-radius: 10px;" type="submit" name="pesan">Pesan Jadwal Lain</button>
    </form>
</div>
        <!--footer start-->
        <footer>
            <div>
                <img class="fit" style="max-width: 100%; max-height: 100%;" src="assets/Footer.png" alt="...">
            </div>
        </footer>
        <!-- Footer end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>