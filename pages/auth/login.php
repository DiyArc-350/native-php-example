<?php
session_start();

// Koneksi ke functions.php
require '../../functions/auth.php';

if(isset($_SESSION["login"])){
    header("Location: ../dashboard.php");
    exit;
}

// cek apakah tombol submit, sudah diklik apa belum
if(isset($_POST["login"])){
   if(loginLaboran($_POST) >0){
    header("Location: ../dashboard.php");
    exit;
   }else{
     echo "
        <script>
            alert('Gagal Login, silakan cek ulang');
            document.history.back();
        </script>
    ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit" name="login" >Login</button>
    </form>
    <a href="register.php">Daftar</a>
    
</body>
</html>