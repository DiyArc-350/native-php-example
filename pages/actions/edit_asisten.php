<?php 
session_start();

if( !isset($_SESSION["login"])){
    header("Location: ../auth/login.php");
    exit;
}

// Koneksi ke functions.php
require "../../functions/functions.php";

// ambil data di url
$id = $_GET["id"];
// query data items berdasarkan ID
$asisten = query("SELECT * FROM asisten WHERE id = ?", ["i", $id])[0];


// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di edit atau tidak
    if(updateAsisten($_POST) > 0){
        echo "
            <script>
                alert('data berhasil di edit');
                document.location.href = '../asisten.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('data gagal di edit');
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
    <title>edit asisten</title>
</head>
<body>
    <?php include '../template/navbar.php';?>
    <h1>edit asisten</h1>
    <div>
        <form action="" method="post">
            <input type="hidden" value="<?= $asisten["id"]; ?>" name="id" id="id" >
            <label for="nim">NIM</label>
            <input type="text" name="nim" value="<?= $asisten["nim"]; ?>" id="nim">
            <br>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $asisten["name"]; ?>" id="name">
            <br>
            <label for="code">Code</label>
            <input type="text" name="code" value="<?= $asisten["code"]; ?>" id="code">
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>