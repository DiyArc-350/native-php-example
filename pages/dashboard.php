<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location: auth/login.php");
    exit;
}

require '../functions/functions.php';

$asisten = query("SELECT shift_asisten.id, nim, asisten.name, code, start_time, end_time, shift.name AS day 
FROM asisten 
JOIN shift_asisten ON asisten.id = shift_asisten.asisten_id 
JOIN shift ON shift.id = shift_asisten.shift_id
ORDER BY asisten.id", []);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php include 'template/navbar_root.php';?>
    <h1>Dashboard</h1>
    <h2>Show Jadwal</h2>
    <div>
        <a href="actions/add_jadwal.php">Tambah Jadwal</a>
    </div>
    <div>
        <table style="border: 1px solid;">
            <tr style="border: 1px solid;">
                <th>No</th>
                <th>NIM</th>
                <th>Name</th>   
                <th>Code</th>
                <th>Schedule</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($asisten as $as) : ?>
            <tr style="border: 1px solid;">
                <th style="border: 1px solid;"><?= $i++; ?></th>
                <th style="border: 1px solid;"><?= htmlspecialchars($as["nim"]); ?></th>
                <th style="border: 1px solid;"><?= htmlspecialchars($as["name"]); ?></th>
                <th style="border: 1px solid;"><?= htmlspecialchars($as["code"]); ?></th>
                <th style="border: 1px solid;"><?= htmlspecialchars($as["day"]); ?></th>
                <th style="border: 1px solid;">
                    <a href="actions/edit_jadwal.php?id=<?= $as["id"]; ?>">Edit</a>
                    <a href="actions/rm_jadwal.php?id=<?= $as["id"]; ?>">Delete</a>
                </th>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>