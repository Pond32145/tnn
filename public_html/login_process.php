<?php
require_once 'connectdb.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: productRead.php");
            exit();
        } else {
            // รหัสผ่านไม่ถูกต้อง
            header("Location: login.php?alert=" . urlencode("รหัสผ่านไม่ถูกต้อง"));
            exit();
        }
    } else {
        // ไม่พบชื่อผู้ใช้
        header("Location: login.php?alert=" . urlencode("ไม่พบชื่อผู้ใช้"));
        exit();
    }
} else {
    // กรณีที่ไม่มีค่าที่คาดหวังจากฟอร์ม
    header("Location: login.php?alert=" . urlencode("กรุณากรอกชื่อผู้ใช้และรหัสผ่าน"));
    exit();
}

// $conn->close();
?>
