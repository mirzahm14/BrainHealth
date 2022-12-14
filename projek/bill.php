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
$query = mysqli_query($koneksi, "SELECT * FROM appointment JOIN psikolog ON appointment.psikolog_id = psikolog.psikolog_id JOIN pasien ON appointment.username = pasien.username WHERE appointment_id = $appointment_id");
$row = mysqli_fetch_assoc($query);

if($row['status'] == 'PAID'){
    echo "<script>alert('Anda Sudah Membayar!');
                document.location.href ='daftarpesanan.php'</script>";
}

//cek apakah tombol bayar sudah diklik
if ( isset($_POST['bayar']) ){
    //ambil data dari formulir
    $appointment_id = $appointment_id;
    $tagihan = 'Rp150.000';
    $jenis_pembayaran = $_POST['jenis_pembayaran'];
    $nomor_hp = strval($_POST['nomor_hp']);

    //buat query
    $result = mysqli_query($koneksi, "INSERT INTO pembayaran VALUES ('$appointment_id', '$tagihan', '$jenis_pembayaran', '$nomor_hp')");

    //cek query berhasil atau tidak
    if($result){
        $status = mysqli_query($koneksi, "UPDATE appointment SET status = 'PAID' WHERE appointment_id = $appointment_id");
        echo "<script>alert('Pembayaran berhasil!');
                document.location.href ='daftarpesanan.php'</script>";
    } else {
        echo "<script>alert('Pembayaran gagal!');
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
    <title>Brainhealth</title>
    <link href="css/billstyle.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
                <a class="nav-link m-2"> Hi, <?= $row['nama_pasien']?></a>
                    <button class="btn btn-outline-warning" style="border-radius: 15px;" type="submit" ><a href="logout.php" class="logout">Log Out</a></button>
            </ul>
            </div>
        </div>
        </nav>
        <!-- Navbar end -->
    <!--Form Pembayaran Start-->
    <div class="card mb-3" style="padding-top: 50px; padding-left: 100px; padding-right: 100px; padding-bottom: 50px; border: 10px;">
        <img src="assets/Card-P.png" class="card-img-top" alt="...">
        <div class="card-body"></div>
        <form class="shadow-lg p-3 mb-5 bg-body rounded" action="" method="post">
            <fieldset>
                <p>Nama pasien : <?= $row['nama_pasien']?></p>
                <p>Nama psikolog : <?= $row['nama_psikolog']?></p>
                <p>Tanggal konsultasi : <?= $row['tanggal_pemesanan']?></p>
                <p>Waktu konsultasi : <?= $row['waktu_konsultasi']?></p>
                <p>Total tagihan : Rp150.000</p>
                <p>
                    <label for="jenis_pembayaran">Jenis Pembayaran  </label>
                    <select class="form-select" aria-label="Default select example" name="jenis_pembayaran" id="jenis_pembayaran" required>
                        <option value="" disabled selected>Pilih jenis pembayaran</option>
                        <option value="gopay">Go-Pay</option>
                        <option value="ovo">OVO</option>
                        <option value="dana">DANA</option>
                        <option value="spay">Shopee-Pay</option>
                    </select>
                </p>
                <p>
                    <label class="label" for="nomor_hp">Nomor HP : </label>
                    <input type="number" class="form-control" id="nomor_hp" placeholder="08XX XXXX XXXX" name="nomor_hp" required>
                </p>
            </fieldset>
            <button class="btn btn-warning d-grid gap-2" type="submit" name="bayar" onclick="return confirm('Pesanan yang sudah dibayar dan ingin dibatalkan, tidak mendapatkan refund!');">Bayar</button>
        </form>
        </div>
        </div>
        <!--Form Pembayaran End-->
        <!--footer start-->
        <footer>
            <div>
                <img class="fit" style="max-width: 100%; max-height: 100%;" src="assets/Footer.png" alt="...">
            </div>
        </footer>
        <!-- Footer end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>