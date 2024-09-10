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
$shift = query("SELECT * FROM shift WHERE id = ?", ["i", $id])[0];


// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di edit atau tidak
    if(updateShift($_POST) > 0){
        echo "
            <script>
                alert('data berhasil di edit');
                document.location.href = '../shift.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('data gagal di edit');
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
    <title>edit shift</title>
</head>
<body>
    <?php include '../template/navbar.php';?>
    <h1>edit shift</h1>
    <div>
        <form action="" method="post">
            <input type="hidden" value="<?= $shift["id"]; ?>" name="id" id="id" >
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $shift["name"]; ?>" id="name">
            <br>
            <label for="start_time">Start Time</label>
            <input type="datetime" name="start_time" value="<?= $shift["start_time"]; ?>" id="start_time">
            <br>
            <label for="end_time">End Time</label>
            <input type="datetime" name="end_time" value="<?= $shift["end_time"]; ?>" id="end_time">
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>