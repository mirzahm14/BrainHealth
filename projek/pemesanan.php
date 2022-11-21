<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

if( isset($_POST['pesan']) ){
    //ambil data dari form
    $nik = $_SESSION['user']['nik'];
    $tanggal_pemesanan = date("Y-m-d", strtotime($_POST['tanggal_pemesanan']));
    $psikolog_id = $_POST['psikolog_id'];
    $waktu_konsultasi = $_POST['waktu_konsultasi'];

    //memasukkan ke dalam database
    $result = mysqli_query($koneksi, "INSERT INTO appointment VALUES ('', '$nik', '$psikolog_id', '$tanggal_pemesanan', '$waktu_konsultasi', 'PENDING')");

    //cek jika query berhasil
    if( $result == TRUE ){
        echo "<script>alert('Pemesanan berhasil dibuat!');
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
                <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" required>
            </p>
            <p>
                <label for="psikolog_id">Psikolog: </label><br>
                <select id="psikolog_id" name="psikolog_id" required>
                    <option value="" disabled selected>Pilih Psikolog</option>
                    <option value ="DJ6Z1">Dra. Soerjantini Rahayu, M.A.</option>
                    <option value ="JBTH2">Drs. Budi Santoso, M.Si.</option>
                    <option value ="M8WC3">Sri Rahmani, S.Psi., M.Psi., Psikolog</option>
                    <option value ="VNJ24">Bianca Siregar, S.Psi, Ph.D</option>
                    <option value ="UQ4W5">Dr. Slamet Hassan, S.Psi., M.Si.</option>
                </select>
            </p>
            <p>
                <label for="waktu_konsultasi">Waktu Konsultasi: </label><br>
                <select id="waktu_konsultasi" name="waktu_konsultasi" required>
                        <option value="" disabled selected>Pilih waktu konsultasi</option>
                        <option value="10.00 - 11.00">10.00 - 11.00</option>
                        <option value="11.00 - 12.00">11.00 - 12.00</option>
                        <option value="13.00 - 14.00">13.00 - 14.00</option>
                        <option value="14.00 - 15.00">14.00 - 15.00</option>
                        <option value="15.00 - 16.00">15.00 - 16.00</option>
                        <option value="16.00 - 17.00">16.00 - 17.00</option>
                </select>
            </p>
        </fieldset>
        <button type="submit" name="pesan">Pesan</button>
    </form>
</body>
</html>