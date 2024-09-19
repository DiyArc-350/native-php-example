<?php 
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
//db connectin
include "conn.php";

function query($query, array $col=[]) {
    global $conn;

    $stmt = $conn->prepare($query);

    if (!empty($col)) {

        $stmt->bind_param(...$col);

    }
    $stmt->execute();

    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);  

    return $data;
}

function addAsisten($data) {
    global $conn;
    try{
        //bersihin input dulu ygy
        $nim = mysqli_real_escape_string($conn, htmlspecialchars($data["nim"]));
        $name = mysqli_real_escape_string($conn, htmlspecialchars($data["name"]));
        $code = mysqli_real_escape_string($conn, htmlspecialchars($data["code"]));
    
         // Prepared statement
        $stmt = $conn->prepare("INSERT INTO asisten (nim, name, code, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    
        $stmt->bind_param("iss", $nim, $name, $code);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);

}

function updateAsisten($data) {
    global $conn;
    try{
        $id = mysqli_real_escape_string($conn, htmlspecialchars($data["id"]));
        $nim = mysqli_real_escape_string($conn, htmlspecialchars($data["nim"]));
        $name = mysqli_real_escape_string($conn, htmlspecialchars($data["name"]));
        $code = mysqli_real_escape_string($conn, htmlspecialchars($data["code"]));
    
        // Prepared statement
        $stmt = $conn->prepare("UPDATE asisten SET nim = ?, name = ?, code = ?, updated_at = NOW() WHERE id = ?");
    
        $stmt->bind_param("issi", $nim, $name, $code, $id);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);
}

function addShift($data) {
    global $conn;
    try{
        //bersihin input dulu ygy
        $name = mysqli_real_escape_string($conn, htmlspecialchars($data["name"]));
        $start_time = mysqli_real_escape_string($conn, htmlspecialchars($data["start_time"]));
        $end_time = mysqli_real_escape_string($conn, htmlspecialchars($data["end_time"]));

         // Prepared statement
        $stmt = $conn->prepare("INSERT INTO shift (name, start_time, end_time, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    
        $stmt->bind_param("sss", $name, $start_time, $end_time);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);

}

function updateShift($data) {
    global $conn;
    try{
         $id = mysqli_real_escape_string($conn, htmlspecialchars($data["id"]));
        $name = mysqli_real_escape_string($conn, htmlspecialchars($data["name"]));
        $start_time = mysqli_real_escape_string($conn, htmlspecialchars($data["start_time"]));
        $end_time = mysqli_real_escape_string($conn, htmlspecialchars($data["end_time"]));

        $stmt = $conn->prepare("UPDATE shift SET name = ?, start_time = ?, end_time = ?, updated_at = NOW() WHERE id = ?");
    
        $stmt->bind_param("sssi", $name, $start_time, $end_time, $id);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);
}

function addJadwal($data) {
    global $conn;
    try{
        //bersihin input dulu ygy
        $asisten_id = mysqli_real_escape_string($conn, htmlspecialchars($data["asisten_id"]));
        $shift_id = mysqli_real_escape_string($conn, htmlspecialchars($data["shift_id"]));

         // Prepared statement
        $stmt = $conn->prepare("INSERT INTO shift_asisten (asisten_id, shift_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
    
        $stmt->bind_param("ii", $asisten_id, $shift_id);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);
}

function updateJadwal($data) {
    global $conn;
    try{
        $id = mysqli_real_escape_string($conn, htmlspecialchars($data["id"]));
        $asisten_id = mysqli_real_escape_string($conn, htmlspecialchars($data["asisten_id"]));
        $shift_id = mysqli_real_escape_string($conn, htmlspecialchars($data["shift_id"]));

        $stmt = $conn->prepare("UPDATE shift_asisten SET asisten_id = ?, shift_id = ?, updated_at = NOW() WHERE id = ?");
    
        $stmt->bind_param("iii", $asisten_id, $shift_id, $id);
    
        $stmt->execute();
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
    }
    return mysqli_affected_rows($conn);
}

function delateAsisten($id) {
    global $conn;
    // Clean the input data
    $id = mysqli_real_escape_string($conn, htmlspecialchars($id));

    // Prepared statement
    $stmt = $conn->prepare("DELETE FROM asisten WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    return $stmt->affected_rows; 
}

function delateShift($id) {
    global $conn;
   // Clean the input data
    $id = mysqli_real_escape_string($conn, htmlspecialchars($id));

    // Prepared statement
    $stmt = $conn->prepare("DELETE FROM shift WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    return $stmt->affected_rows; 
}

function delateJadwal($id) {
    global $conn;
    // Clean the input data
    $id = mysqli_real_escape_string($conn, htmlspecialchars($id));

    // Prepared statement
    $stmt = $conn->prepare("DELETE FROM shift_asisten WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    return $stmt->affected_rows; 
}



