<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'connectdb.php';

// ตรวจสอบการส่งค่ามาจากฟอร์ม
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // พบผู้ใช้
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            // รหัสผ่านถูกต้อง
            session_start();
            $_SESSION['username'] = $username;
            header("Location: productRead.php"); 
            exit();
        } else {
            // รหัสผ่านไม่ถูกต้อง
            echo "รหัสผ่านไม่ถูกต้อง";
            header("Location: login.php");
        }
    } else {
        // ไม่พบชื่อผู้ใช้
        echo "ไม่พบชื่อผู้ใช้";
        header("Location: login.php");
    }
} else {
    // กรณีที่ไม่มีค่าที่คาดหวังจากฟอร์ม
    echo "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
    header("Location: login.php");
}

$conn->close();
?>
