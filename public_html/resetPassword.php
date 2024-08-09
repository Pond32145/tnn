<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$chekeStartPage = true;
include 'headerAdmin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/back.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
               html, body {
            height: 100%;
            margin: 0;
        }
        .body {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('./assets/image/65716e71ccb8efa53ebd071c_Scroll Group 4-p-1600.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .form-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
            background-color: #fff;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-label {
            flex: 0 0 150px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: .8rem;
        }
        .btn-primary {
            border-radius: 0.375rem;
        }
    </style>
</head>
<body>
    <div class="body">
        <div class="form-container">
            <h2>เปลี่ยนรหัสผ่าน</h2>
            <form id="resetPasswordForm" action="resetPassword.php" method="POST">
                <div class="form-group">
                    <label for="username" class="form-label">ชื่อผู้ใช้:</label>
                    <input type="text" id="username" name="username" class="form-control border-bottom ms-2" required>
                </div>
                <div class="form-group">
                    <label for="old_password" class="form-label">รหัสผ่านเดิม:</label>
                    <input type="password" id="old_password" name="old_password" class="form-control border-bottom ms-2" required>
                </div>
                <div class="form-group">
                    <label for="new_password" class="form-label">รหัสผ่านใหม่:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control border-bottom ms-2" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control border-bottom ms-2" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">ยืนยัน</button>
            </form>
        </div>
    </div>

    <?php
    require_once 'connectdb.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = [];

        if (isset($_POST['username'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
            $username = $_POST['username'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password !== $confirm_password) {
                $response = ['status' => 'error', 'message' => 'รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน'];
            } else {
                $sql_check_user = "SELECT password_hash FROM users WHERE username=?";
                $stmt = $conn->prepare($sql_check_user);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result_check_user = $stmt->get_result();

                if ($result_check_user->num_rows > 0) {
                    $row = $result_check_user->fetch_assoc();
                    $hashed_password = $row['password_hash'];

                    if (password_verify($old_password, $hashed_password)) {
                        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $sql_update_password = "UPDATE users SET password_hash=? WHERE username=?";
                        $stmt_update = $conn->prepare($sql_update_password);
                        $stmt_update->bind_param("ss", $new_hashed_password, $username);

                        if ($stmt_update->execute()) {
                            $response = ['status' => 'success', 'message' => 'เปลี่ยนรหัสผ่านสำเร็จ'];
                        } else {
                            $response = ['status' => 'error', 'message' => 'Error: ' . $stmt_update->error];
                        }
                    } else {
                        $response = ['status' => 'error', 'message' => 'รหัสผ่านเก่าไม่ถูกต้อง'];
                    }
                } else {
                    $response = ['status' => 'error', 'message' => 'ไม่มีชื่อผู้ใช้นี้ในระบบ'];
                }

                $stmt->close();
            }
        } else {
            $response = ['status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน'];
        }

        $conn->close();
        
        // Send JSON response
        echo '<script>
                var response = ' . json_encode($response) . ';
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "login.php"; 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.message
                    });
                }
              </script>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>