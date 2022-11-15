<?php 
include("connect.php");
include("header.php");
// cek tombol submit udh diklik blm
if (isset($_POST['submit'])&&!empty($_POST['submit'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $sex = $_POST['sex'];
    $password = $_POST['password'];

    //buat query
    $query = pg_query("INSERT INTO patient (nik, nama, sex, password) VALUES ('$nik', '$nama', '$sex', '$password')");
    if($query == TRUE){
        header('Location: login.php?status=sukses');
    } else {
        header('Location: register.php?status=gagal');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP PostgreSQL Registration & Login Example </title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Register Here </h2>
  <form method="post">
  
    <div class="form-group">
      <label for="nik">NIK:</label>
      <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" name="nik" requuired>
    </div>
    
    <div class="form-group">
      <label for="nama">Nama:</label>
      <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Lengkap" name="nama">
    </div>
    
    <div class="form-group">
      <label for="sex">Jenis Kelamin:</label></br>
        <label><input type="radio" name="sex" value="laki-laki"> Laki-laki</label>
	    <label><input type="radio" name="sex" value="perempuan"> Perempuan</label>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <a href="login.php"><p>Sudah punya akun</p></a>
  </form>
</div>
</body>
</html>
