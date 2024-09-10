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
    if(addShift($_POST) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = '../shift.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = '../shift.php';
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
    <title>add shift</title>
</head>
<body >
    <?php include '../template/navbar.php';?>
    <h1>add asisten</h1>
    <div>
        <form action="" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <br>
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time"id="start_time">
            <br>
            <label for="end_time">End Time</label>
            <input type="time" name="end_time"id="end_time">
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>