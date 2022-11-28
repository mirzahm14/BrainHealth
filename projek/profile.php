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

if( isset($_POST['edit']) ){
    header("Location: editprofile.php");
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
    
    <form action="" method="post">
        <fieldset>
            <p>
                <label for="nama_pasien">Nama </label><br>
                <input type="text" name="nama_pasien" id="nama_pasien" value="<?= $row['nama_pasien'] ?>" disabled>
            </p>
            <p>
                <label for="nik">NIK</label><br>
                <input type="number" name="nik" id="nik" value="<?= $row['nik'] ?>" disabled>
            </p>
            <p>
                <label for="ttl">Tanggal Lahir: <br> <?= $row['ttl'] ?></label>
            </p>
            <p>
                <label for="nomor_hp">No HP</label><br>
                <input type="number" name="nomor_hp" id="nomor_hp" value="<?= $row['nomor_hp'] ?>" disabled>
            </p>
            <p>
                <label for="email">Alamat Email</label><br>
                <input type="email" name="email" id="email" value="<?= $row['email'] ?>" disabled>
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
        <button type="submit" name="edit">Edit Profile</button>
    </form>
</body>
</html>