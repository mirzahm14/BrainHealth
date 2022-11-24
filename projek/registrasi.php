<?php
session_start();

if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}
include("config.php");

//cek tombol submit sudah diklik blm
if( isset($_POST['register']) ){

    //ambil data dari form
    //htmlspecialchars untuk menghindari injeksi dr user
    $nik = strval(htmlspecialchars($_POST['nik']));
    $nama_pasien = htmlspecialchars($_POST['nama_pasien']);
    $ttl = htmlspecialchars(date("Y-m-d", strtotime($_POST['ttl']))); //ubah format ttl html to postgres
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $password = htmlspecialchars($_POST['password']);
    $verif_password = htmlspecialchars($_POST['verif_password']);

    //cek nik sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT nik FROM pasien WHERE nik = '$nik'");
    if( mysqli_fetch_assoc($result) ){
        echo "<script>alert('NIK Sudah Terdaftar!');
                   document.location.href ='registrasi.php'</script>";
        return false; //diberhentikan
    }
    // cek password sama atau tidak
    if($password !== $verif_password){
        echo "<script>alert('Password berbeda!');
                   document.location.href ='registrasi.php'</script>";
        return false; //diberhentikan
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //persiapan simpan data
    $query = mysqli_query($koneksi, "INSERT INTO pasien VALUES ('$nik', '$nama_pasien', '$ttl', '$jenis_kelamin', '$password')");
    //uji jika simpan data berhasil
    if($query){
        echo "<script>alert('Registrasi sukses!');
                document.location.href ='login.php'</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');
                document.location.href ='registrasi.php'</script>";
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
    <header>
        <h2>Registrasi Akun</h2>
    </header>
    <form action="" method="post">
        <fieldset>
            <p>
                <label for="nik">NIK: </label><br>
                <input type="number" name="nik" placeholder="Masukkan NIK" id="nik" required> <!--blm dihapus button controlnya, apus di css-->
            </p>
            <p>
                <label for="nama_pasien">Nama Lengkap: </label><br>
                <input type="text" name="nama_pasien" placeholder="Masukkan Nama Lengkap" id="nama_pasien" required>
            </p>
            <p>
                <label for="ttl">Tanggal Lahir: </label><br>
                <input type="date" name="ttl" required>
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin: </label><br>
                <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">Perempuan</label>
            </p>
            <p>
                <label for="password">Password: </label><br>
                <input type="password" name="password" id="password" placeholder="Masukkan Password" required><br>
                <label for="verif_password">Konfirmasi Password: </label><br>
                <input type="password" name="verif_password" id="verif_password" placeholder="Konfirmasi Password" required>
            </p>
        </fieldset>
        <br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <a href="login.php">Sudah memiliki akun</a>
</body>
</html>
