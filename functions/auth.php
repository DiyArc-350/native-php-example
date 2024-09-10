<?php 
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
// cek conn db
include "conn.php";

function loginLaboran($data){
    global $conn;
    try{
        $username = mysqli_real_escape_string($conn, $data["username"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);

        //prepared stmt
        $stmt = $conn->prepare("SELECT * FROM laboran WHERE username =?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        //cek username
        if($result->num_rows === 1){
            //cek password
            $row = $result->fetch_all(MYSQLI_ASSOC)[0];
            if(password_verify($password, $row["password"])){
                //set session
                $_SESSION["login"] = true;
            }
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
    // return $result->num_rows;
}


function regisLaboran($data){
    global $conn;
    try{
        $username =  mysqli_real_escape_string($conn, strtolower(stripslashes($data["username"])));
        $email =  mysqli_real_escape_string($conn, strtolower(stripslashes($data["email"])));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["confirm_password"]);

        //cek username & email udah ada apa belum
        $stmt = $conn->prepare("SELECT username FROM laboran WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt2 = $conn->prepare("SELECT username FROM laboran WHERE email = ?");
        $stmt2->bind_param("s", $email);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0){
            echo " <script>
                alert ('username/email sudah terdaftar');
            </script>";
            return false;
        }

        //cek konfirmasi password
        if ($password !== $password2){
        echo "
            <script> 
                alert ('Konfirmasi password tidak sesuai');
            </script>";
        return false;
        }    

        //encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user baru
        $stmt = $conn->prepare("INSERT INTO laboran (username, email, password, created_at, updated_at) VALUES( ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        
    } catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }
    return mysqli_affected_rows($conn);
}
