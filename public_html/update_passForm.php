<?php

include 'connectdb.php';
// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
   
    
    // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
    $current_password = mysqli_real_escape_string($conn, $current_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    
    // Query เพื่อเรียกดูรหัสผ่านที่เก็บไว้
    $query = "SELECT password_hash FROM users WHERE id = 'id';"; // แทนที่ 'username' ด้วยชื่อผู้ใช้ที่เป็นของคุณ
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // มีผลลัพธ์มากกว่า 0
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];
        
        // ตรวจสอบรหัสผ่านเดิม
        if ($current_password != $stored_password) {
            echo "Current password is incorrect.";
        } else {
            // ตรวจสอบรหัสผ่านใหม่กับการยืนยันรหัสผ่านใหม่
            if ($new_password != $confirm_password) {
                echo "New password and confirm password do not match.";
            } else {
                // ทำการอัปเดตรหัสผ่านในฐานข้อมูล
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query = "UPDATE users SET password = '$hashed_password' WHERE username = 'username';"; // แทนที่ 'username' ด้วยชื่อผู้ใช้ที่เป็นของคุณ
                
                if ($conn->query($update_query) === TRUE) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            }
        }
    } else {
        echo "User not found.";
    }
    
    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password Form</title>
</head>
<body>
    <h2>Update Password</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="Update Password">
    </form>
</body>
</html>
