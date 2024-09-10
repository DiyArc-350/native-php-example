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
$jadwal = query("SELECT * FROM shift_asisten WHERE id = ?", ["i", $id])[0];

// Ambil data shift
 $shift = query("SELECT * FROM shift", []);
 // Ambil data asisten
 $asisten = query("SELECT * FROM asisten", []);


// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if(updateJadwal($_POST) > 0){
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
    echo updateJadwal($_POST);
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit jadwal</title>
</head>
<body >
    <?php include '../template/navbar.php';?>
    <h1>edit jadwal</h1>
    <div>
        <form action="" method="post">
            <input type="hidden" value="<?= $jadwal["id"]; ?>" name="id" id="id" >
            <label for="asisten">Asisten</label>
            <select name="asisten_id" id="asisten" required>
                <?php foreach($asisten as $a) :?>
                <option value="<?=$a["id"]?>" <?= $a["id"] == $jadwal["asisten_id"] ? "selected" : "" ?>><?=$a["code"]?></option>
                <?php endforeach;?>
            </select>
            <br>
             <label for="shift">Shift</label>
            <select name="shift_id" id="shift" required>
                <?php foreach($shift as $s) :?>
                <option value="<?=$s["id"]?>" <?= $s["id"] == $jadwal["shift_id"] ? "selected" : "" ?>><?=$s["name"]?></option>
                <?php endforeach;?>
            </select>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>