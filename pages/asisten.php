<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location: auth/login.php");
    exit;
}

require '../functions/functions.php';

$asisten = query("SELECT * FROM asisten", []);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asisten</title>
</head>
<body>
    <?php include 'template/navbar_root.php';?>
    <h1>Show Asisten</h1>
    <div>
        <a href="actions/add_asisten.php">Tambah Asisten</a>
    </div>
    <div>
        <table style="border: 1px solid;">
            <tr style="border: 1px solid;">
                <th>No</th>
                <th>NIM</th>
                <th>Name</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($asisten as $as) : ?>
            <tr style="border: 1px solid;">
                <th style="border: 1px solid;"><?= $i++; ?></th>
                <th style="border: 1px solid;"><?= $as["nim"]; ?></th>
                <th style="border: 1px solid;"><?= $as["name"]; ?></th>
                <th style="border: 1px solid;"><?= $as["code"]; ?></th>
                <th style="border: 1px solid;">
                    <a href="actions/edit_asisten.php?id=<?= $as["id"]; ?>">Edit</a>
                    <a href="actions/rm_asisten.php?id=<?= $as["id"]; ?>">Delete</a>
                </th>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>