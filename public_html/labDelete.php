<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'connectdb.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // เลือกไฟล์ PDF และไฟล์ภาพจากฐานข้อมูล
    $sql = "SELECT pdf_path, image_path FROM lab WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pdfPath = $row['pdf_path'];
        $imagePath = $row['image_path'];

        // ลบไฟล์ PDF และไฟล์ภาพจากไดเรกทอรี
        $deleteSuccess = true;
        if ($pdfPath && file_exists($pdfPath)) {
            if (!unlink($pdfPath)) {
                echo "Failed to delete PDF file.";
                $deleteSuccess = false;
            }
        }

        if ($imagePath && file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                echo "Failed to delete image file.";
                $deleteSuccess = false;
            }
        }

        // ลบข้อมูลจากฐานข้อมูลถ้าลบไฟล์สำเร็จ
        if ($deleteSuccess) {
            $sqlDelete = "DELETE FROM lab WHERE id=$id";
            if ($conn->query($sqlDelete) === TRUE) {
                // เปลี่ยนเส้นทางไปยัง labRead.php หลังจากการลบสำเร็จ
                header('Location: labRead.php');
                exit;
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    } else {
        echo "Record not found.";
    }

    $conn->close();
}
?>
