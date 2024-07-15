<?php
// เชื่อมต่อกับไฟล์เชื่อมต่อฐานข้อมูล
require_once 'connectdb.php';

// รับค่าจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birthdate = $_POST['birthdate'];
$position = $_POST['position'];

// ตรวจสอบว่ามีชื่อผู้ใช้ซ้ำหรือไม่
$sql_check_duplicate = "SELECT * FROM users WHERE username='$username'";
$result_check_duplicate = $conn->query($sql_check_duplicate);

if ($result_check_duplicate->num_rows > 0) {
    // มีชื่อผู้ใช้นี้อยู่แล้ว
    echo "ชื่อผู้ใช้นี้มีอยู่แล้วในระบบ";
} else {
    // นำรหัสผ่านมาทำการ hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
    $sql_insert_user = "INSERT INTO users (username, password_hash, first_name, last_name, birthdate, position) 
                        VALUES ('$username', '$hashed_password', '$first_name', '$last_name', '$birthdate', '$position')";

    if ($conn->query($sql_insert_user) === TRUE) {
        echo "ลงทะเบียนสำเร็จ";
    } else {
        echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
    }
}

$conn->close();
?>
