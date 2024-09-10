<?php

require "../../functions/auth.php";

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if(regisLaboran($_POST) > 0){
        echo "
            <script>
                alert('Berhasil terdaftar');
                document.location.href = '../auth/login.php';
            </script>
        ";
    } else{
        echo "
            <script>
                alert('Gagal mendaftar');
                document.location.href = '../auth/register.php';
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
    <title>register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Password" required>
        <br>
        <button type="submit" name="submit">Daftar</button>
    </form>
    <a href="../pages/auth/login.php">Login</a>
    
</body>
</html>