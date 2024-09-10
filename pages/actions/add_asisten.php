<?php 
session_start();

if( !isset($_SESSION["login"])){
    header("Location: ../auth/login.php");
    exit;
}
// Koneksi ke functions.php
require "../../functions/functions.php";

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if(addAsisten($_POST) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = '../asisten.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = '../asisten.php';
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
    <title>add asisten</title>
</head>
<body >
    <?php include '../template/navbar.php';?>
    <h1>add asisten</h1>
    <div>
        <form action="" method="post">
            <label for="nim">NIM</label>
            <input type="text" name="nim" maxlength="12" id="nim">
            <br>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <br>
            <label for="code">Code</label>
            <input type="text" name="code" maxlength="3" id="code">
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>