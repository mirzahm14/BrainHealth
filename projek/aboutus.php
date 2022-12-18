<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data user
$username = $_SESSION['user']['username'];
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us-BrainHealth</title>
    <link href="css/aboutstyle.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
        <!--Header-->
        <div>
            <img class="fit shadow-sm" style="max-width: 100%; max-height: 100%;" src="assets/Header.png" alt="...">
        </div>
        <!--Header-->
            <div class="text"  style="background-color: #FFD523; padding-left: 200px; padding-right: 200px; padding-top: 50px; padding-bottom: 70px;">
                <div class="card-body">
                    <h3>Kami Memulainya dari ...</h3>
                    <p style="text-align: justify; padding-top: 10px;">Keresahan kami yang sama yaitu, pentingnya mental health dan self-development di kampus IPB University. Tujuan besar kami adalah ingin semua orang berdaya dengan memiliki identity-aware, active problem solver dan growth mindset. 
                        Untuk mencapai tujuan itu, BrainHealth memiliki sistem tersendiri yang diturunkan menjadi produk & layanan utama seperti mentoring, konseling, dan lain-lain. 
                        </p>
                    <p style="text-align: justify;">Selain itu, kami juga memiliki Psikolog terbaik yang sudah menyelesaikan pendidikan dari Magister Profesi Psikologi Peminatan Klinis dan memiliki gelar (M.Psi, Psikolog) dari berbagai universitas terbaik di Indonesia. Psikolog BrainHealth sudah memiliki Surat Izin Praktik Psikologi (SIPP) dari Himpunan Psikologi Indonesia (HIMPSI) dan Surat Izin Praktik Psikologi Klinis (SIPPK) dari Ikatan Psikologi Klinis Indonesia (IPK).</p>
                    <p style="text-align: justify;">Ini baru awal, kami akan terus berkembang</p>
                </div>
                </div>
                
        <div>
            <img class="fit shadow-sm" style="max-width: 100%; max-height: 100%;" src="assets/Team.png" alt="...">
        </div>

        <div class="text"  style="background-color: #ffff; padding-left: 400px; padding-right: 400px; padding-top: 100px; padding-bottom: 100px;">
            <div class="card-body">
                <h3 style="text-align: center;">#HidupBahagia</h3>
                <p style="text-align: center;">BrainHealth hadir untuk mengajarkan kemampuan dan hal penting dalam menjalani hidup. Kami percaya, setiap orang berhak berkembang, setidaknya 1% setiap hari.</p>
            </div>
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