<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location: auth/login.php");
    exit;
}


require '../functions/functions.php';

$shift = query("SELECT * FROM shift", []);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift</title>
</head>
<body>
    <?php include 'template/navbar_root.php';?>
    <section style="margin: 0 auto; max-width: fit-content;"> 
        <h1>Show Shift</h1>
        <div>
            <a href="actions/add_shift.php">Tambah Shift</a>
        </div>
        <div>
            <table style="border: 1px solid;">
                <tr style="border: 1px solid;">
                    <th>No</th>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($shift as $as) : ?>
                <tr style="border: 1px solid;">
                    <th style="border: 1px solid;"><?= $i++; ?></th>
                    <th style="border: 1px solid;"><?= $as["name"]; ?></th>
                    <th style="border: 1px solid;"><?= $as["start_time"]." - ". $as["end_time"]; ?></th>
                    <th style="border: 1px solid;">
                        <a href="actions/edit_shift.php?id=<?= $as["id"]; ?>">Edit</a>
                        <a href="actions/rm_shift.php?id=<?= $as["id"]; ?>">Delete</a>
                    </th>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </section>
</body>
</html>