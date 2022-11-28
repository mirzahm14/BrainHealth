<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

// ambil data dari user
$username = $_SESSION['user']['username'];
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);

//ambil tanggal
$date = date("Y-m-d", strtotime($row['ttl']));

//cek tombol update
if( isset($_POST['update']) ){

    //ambil data dari form update
    $username = $_SESSION['user']['username'];
    $nik = strval(htmlspecialchars($_POST['nik']));
    $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
    $ttl = htmlspecialchars(date("Y-m-d", strtotime($_POST['ttl']))); //ubah format ttl html to postgres
    $nomor_hp = strval($_POST['nomor_hp']);
    $email = htmlspecialchars($_POST['email']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);

    $result = mysqli_query($koneksi, "UPDATE pasien SET username='$username', nik='$nik', nama_pasien='$nama_pasien', ttl='$ttl', jenis_kelamin='$jenis_kelamin', nomor_hp='$nomor_hp', email='$email' WHERE username='$username'");

    if($result){
        header("Location: profile.php");
    } else{
        echo "<script>alert('Gagal memperbaharui!');
                document.location.href ='editprofile.php'</script>";
    }

    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainHealth</title>
    <link href="css/profilestyle.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

            /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
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

    <div class="card border-0" style="padding-left: 100px; padding-right: 100px; padding-bottom: 50px;">
        <div class="row g-0 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="col-md-4">
            <img src="assets/profile-card1.png" class="img-fluid" style="border-radius: 10px;" alt="...">
            </div>
                <div class="col-md-8">
            <div class="card-body">
            <!--Profile Start-->
        <form action="" method="post" style="padding-top: 20px;">
            <fieldset>
            <p class="text-center">
                <label class="fw-bold"> Identitas Anda</label>
            </p>
            <p>
                <label for="nama_pasien">Nama</label><br>
                <input class="border-0" type="text" name="nama_pasien" id="nama_pasien" value="<?= $row['nama_pasien'] ?>" >
            </p>
            <p>
                <label for="nik">NIK</label><br>
                <input class="border-0" type="number" name="nik" id="nik" value="<?= $row['nik'] ?>" >
            </p>
            <p>
                <label for="ttl">Tanggal Lahir <br>
                <input type="date" name="ttl" id="ttl" value="<?= $date ?>">
            </p>
            <p>
                <label for="nomor_hp">No HP</label><br>
                <input class="border-0" type="number" name="nomor_hp" id="nomor_hp" value="<?= $row['nomor_hp'] ?>" >
            </p>
            <p>
                <label for="email">Alamat Email</label><br>
                <input class="border-0" type="email" name="email" id="email" value="<?= $row['email'] ?>" >
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin </label><br>
                <label><input type="radio" name="jenis_kelamin" value="L" 
                <?php
                    if ($row['jenis_kelamin'] == 'L') {
                        echo "checked";
                    }
                ?> >Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" 
                <?php
                    if ($row['jenis_kelamin'] == 'P') {
                        echo "checked";
                    }
                    ?>>Perempuan</label>
                </p>
            </fieldset>
            <button class="btn btn-warning"type="submit" name="update">Update Profile</button>
        </form>
    <!--Profile End-->
            </div>
            </div>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>