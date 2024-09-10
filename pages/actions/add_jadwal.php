<?php 
session_start();

if( !isset($_SESSION["login"])){
    header("Location: ../auth/login.php");
    exit;
}
// Koneksi ke functions.php
require "../../functions/functions.php";

// Ambil data shift
 $shift = query("SELECT * FROM shift", []);
 // Ambil data asisten
 $asisten = query("SELECT * FROM asisten", []);


// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if(addJadwal($_POST) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = '../dashboard.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = '../dashboard.php';
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
    <title>add jadwal</title>
</head>
<body >
    <?php include '../template/navbar.php';?>
    <h1>add jadwal</h1>
    <div>
        <form action="" method="post">
            <label for="asisten_id">Asisten</label>
            <select name="asisten_id" id="asisten_id" required>
                <option value="">-- Pilih Asisten --</option>
                <?php foreach($asisten as $a) :?>
                <option value="<?=$a["id"]?>"><?=$a["code"]?></option>
                <?php endforeach;?>
            </select>
            <br>
             <label for="shift_id">Shift</label>
            <select name="shift_id" id="shift_id" required>
                <option value="">-- Pilih Shift --</option>
                <?php foreach($shift as $s) :?>
                <option value="<?=$s["id"]?>"><?=$s["name"]?></option>
                <?php endforeach;?>
            </select>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>