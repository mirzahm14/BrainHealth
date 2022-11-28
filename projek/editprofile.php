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
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="nama_pasien">Nama </label><br>
                <input type="text" name="nama_pasien" id="nama_pasien" value="<?= $row['nama_pasien'] ?>">
            </p>
            <p>
                <label for="nik">NIK</label><br>
                <input type="number" name="nik" id="nik" value="<?= $row['nik'] ?>">
            </p>
            <p>
                <label for="ttl">Tanggal Lahir</label>
                <input type="date" name="ttl" id="ttl" value="<?= $date ?>">
            </p>
            <p>
                <label for="nomor_hp">No HP</label><br>
                <input type="number" name="nomor_hp" id="nomor_hp" value="<?= $row['nomor_hp'] ?>" >
            </p>
            <p>
                <label for="email">Alamat Email</label><br>
                <input type="email" name="email" id="email" value="<?= $row['email'] ?>" >
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin </label><br>
                <label><input type="radio" name="jenis_kelamin" value="L" 
                <?php
                    if ($row['jenis_kelamin'] == 'L') {
                        echo "checked";
                    }
                ?>> Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" 
                <?php
                    if ($row['jenis_kelamin'] == 'P') {
                        echo "checked";
                    }
                   ?> value="P"> Perempuan</label>
            </p>
        </fieldset>
        <button type="submit" name="update">Update Profile</button>
    </form>
</body>
</html>