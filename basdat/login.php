<?php
include("connect.php");
include("header.php");
if(isset($_POST['submit'])){
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $query = pg_query("SELECT * FROM patient WHERE nik = '$nik' AND password = '$password';");
    $cek = pg_num_rows($query);

    if ($cek == 1){
        session_start();
        header('Location: frontpage.php?status=sukses');
    } else {
        header('Location: login.php?status=gagal');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
</head>
<body>
<div class="container">
  <h2>Masuk </h2>
  <form method="post">
  
     
    <div class="form-group">
      <label for="nik">NIK:</label>
      <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" name="nik">
    </div>
    
     
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <p>Belum punya akun?</p>
    <a href="register.php">Sign Up</a>
  </form>
</div>
</body>
</html>
