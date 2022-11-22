<?php
session_start();

if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}

include('config.php');

//cek apakah tombol login sudah diklik
if( isset($_POST["login"]) ){

    //ambil data dari form
    $nik = strval($_POST['nik']);
    $password = $_POST['password'];

    //buat query
    $result = mysqli_query($koneksi, "SELECT * FROM pasien WHERE nik = '$nik'");

    //cek nik apakah terdaftar
    if( mysqli_num_rows($result) === 1 ){
        //cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row['password']) ){
            //set session
            $_SESSION["user"] = $row;
            $_SESSION["login"] = true;

            echo "<script>alert('Login sukses!');
                document.location.href ='index.php'</script>";

            exit; //keluar fungsi if
        }
    }

    //jika password salah
    $error = true;
    if ( isset($error) ){
        echo "<script>alert('Username/Password salah!');
        document.location.href ='login.php'</script>";
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
        <h2>Login</h2>
    </header>

    <form action="" method="post">
        <fieldset>
            <p>
                <label for="nik">NIK: </label><br>
                <input type="number" name="nik" placeholder="Masukkan NIK" id="nik" required> <!--blm dihapus button controlnya, apus di css-->
            </p>
            <p>
                <label for="password">Password: </label><br>
                <input type="password" name="password" id="password" placeholder="Masukkan Password" required><br>
            </p>
        </fieldset>
        <br>
        <button type="submit" name="login">login</button>
    </form>
    <a href="registrasi.php">Belum punya akun</a>
</body>
</html>