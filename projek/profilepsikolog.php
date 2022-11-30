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

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrainHealth</title>
        <link href="css/profpsistyle.css" rel="stylesheet">
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
        <!--Psikolog-->
        <div>
        <img class="fit" style="max-width: 100%; max-height: 100%;" src="assets/Psikolog BrainHealth.png" alt="...">
        </div>
        <div class="text"  style="padding-left: 200px; padding-right: 200px; padding-top: 50px;">
            <div class="card-body">
                <p style="text-align: justify;">Psikolog BrainHealth sudah menyelesaikan pendidikan dari Magister Profesi Psikologi Peminatan Klinis dan memiliki gelar (M.Psi, Psikolog) dari berbagai universitas terbaik di Indonesia. Psikolog BrainHealth sudah memiliki Surat Izin Praktik Psikologi (SIPP) dari Himpunan Psikologi Indonesia (HIMPSI) dan Surat Izin Praktik Psikologi Klinis (SIPPK) dari Ikatan Psikologi Klinis Indonesia (IPK).</p>
                <p style="text-align: justify;">Masing-masing Psikolog memiliki pengalaman, keahlian, pendekatan terapi, serta latar belakang yang beragam dan berbeda, namun mereka sudah memiliki minimal dua tahun pengalaman dalam melakukan konseling. Terakhir, Psikolog BrainHealth dengan senang hati akan siap untuk mengonsultasikan berbagai masalah klinis, seperti gangguan alam perasaan (mood), trauma, dan keluhan psikologis lainnya.</p>
            </div>
            </div>
            <!--Psikolog Profile Start-->
            <div class="container" style="padding-top: 50px; padding-bottom: 25px; padding-right: 200px;  padding-left: 200px;">
                <div class="row">
                    <div class="col ">
                        <div class="card shadow p-3 mb-5 bg-body rounded" style="width: auto; border: none;">
                            <img src="assets/doctor1fix.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Soerjantini Rahayu, M.Psi.</h5>
                                <p class="fst-italic">Pengalaman : 10 Tahun</p>
                                <p class="text">Topik Keahlian : Perilaku, Pernikahan, Pranikah, Asmara, Interaksi Manusia dan lain-lain.</p>
                            </div>
                            </div>
                    </div>
                    <div class="col">
                        <div class="card shadow p-3 mb-5 bg-body rounded" style="width: auto; border: none;">
                            <img src="assets/doctor2fix.png" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bianca Siregar, M.Psi.</h5>
                                <p class="fst-italic">Pengalaman : 2 Tahun</p>
                                <p class="text">Topik Keahlian : Trauma, Masalah Emosi, Gangguan Kepribadian, Suicidal, dan lain-lain.</p>
                            </div>
                            </div>
                    </div>
                </div>
                </div>
                <div class="container" style="padding-top: 25px; padding-bottom: 25px; padding-right: 200px;  padding-left: 200px;">
                    <div class="row">
                        <div class="col ">
                            <div class="card shadow p-3 mb-5 bg-body rounded" style="width: auto; border: none;">
                                <img src="assets/doctor3fix.png" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sri Rahmani, S.Psi.</h5>
                                    <p class="fst-italic">Pengalaman : 11 Tahun</p>
                                    <p class="text">Topik Keahlian : Anak & Remaja, Keluarga, Masalah Emosi, Parenting, dan lain-lain.</p>
                                </div>
                                </div>
                        </div>
                        <div class="col">
                            <div class="card shadow p-3 mb-5 bg-body rounded" style="width: auto; border: none;">
                                <img src="assets/doctor4fix.png" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Budi Santoso, M.Psi.</h5>
                                    <p class="fst-italic">Pengalaman : 15 Tahun</p>
                                    <p class="text">Topik Keahlian: Karir, Industri Dan Organisasi, Hubungan Relasi, dan lain-lain.</p>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div style="margin-left: 190px; margin-top: 25px;">
                    <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 360px; border: none;">
                        <img src="assets/doctor5fix.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Slamet Hassan, M.Psi.</h5>
                            <p class="fst-italic">Pengalaman : 13 Tahun</p>
                            <p class="text">Topik Keahlian : Hubungan Relasi, Masalah Diri, Pengembangan Diri, Seksualitas, dan lain-lain.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                <!--Psikolog Profile End-->
                <div class="card text-center">
                    <div class="card-header">
                        Featured
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">BrainHealth</h5>
                        <p class="card-text">Solusi Masalah Kesehatan Mental Mu</p>
                        <a href="pemesanan.php" class="btn btn-warning">Konsultasi Sekarang</a>
                    </div>
                    <div class="card-footer fw-light text-muted border-0">
                        Terima Kasih Sudah Mempercayai Layanan Kami
                    </div>
                    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>