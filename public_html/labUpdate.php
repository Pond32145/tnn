<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'connectdb.php';
$chekeStartPage = false;
include 'headerAdmin.php';

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $productName = $_POST['product_name'];
        $description = $_POST['description'];
        $usageRate = $_POST['usage_rate'];
        $typeId = $_POST['type_id'];

        // ตรวจสอบการอัปโหลดไฟล์ภาพ
        $imagePath = "";
        if ($_FILES["image"]["name"]) {
            $sqlSelect = "SELECT image_path FROM lab WHERE id=$id";
            $resultSelect = $conn->query($sqlSelect);

            if ($resultSelect->num_rows > 0) {
                $row = $resultSelect->fetch_assoc();
                $oldImagePath = $row['image_path'];

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $target_dir = "uploads_lab/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "ไฟล์ที่อัปโหลดไม่ใช่ไฟล์ภาพ.";
                    $uploadOk = 0;
                }

                if (file_exists($target_file)) {
                    echo "ขออภัยไฟล์นี้มีอยู่แล้ว.";
                    $uploadOk = 0;
                }

                if ($_FILES["image"]["size"] > 500000) {
                    echo "ขออภัยไฟล์ของคุณมีขนาดใหญ่เกินไป.";
                    $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "ขออภัยเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้นที่อนุญาต.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "ขออภัยไฟล์ของคุณไม่ได้ถูกอัปโหลด.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $imagePath = $target_file;
                    } else {
                        echo "ขออภัยมีข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ.";
                    }
                }
            } else {
                echo "ไม่พบเส้นทางไฟล์ภาพ.";
            }
        } else {
            $sqlSelect = "SELECT image_path FROM lab WHERE id=$id";
            $resultSelect = $conn->query($sqlSelect);
            if ($resultSelect->num_rows > 0) {
                $row = $resultSelect->fetch_assoc();
                $imagePath = $row['image_path'];
            }
        }

        // ตรวจสอบการอัปโหลดไฟล์ PDF
        $pdfPath = "";
        if ($_FILES["pdf"]["name"]) {
            $sqlSelect = "SELECT pdf_path FROM lab WHERE id=$id";
            $resultSelect = $conn->query($sqlSelect);

            if ($resultSelect->num_rows > 0) {
                $row = $resultSelect->fetch_assoc();
                $oldPdfPath = $row['pdf_path'];

                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }

                $target_dir_pdf = "uploads_lab/";
                $target_file_pdf = $target_dir_pdf . basename($_FILES["pdf"]["name"]);
                $uploadOk_pdf = 1;
                $pdfFileType = strtolower(pathinfo($target_file_pdf, PATHINFO_EXTENSION));

                if ($pdfFileType != "pdf") {
                    echo "ขออภัยเฉพาะไฟล์ PDF เท่านั้นที่อนุญาต.";
                    $uploadOk_pdf = 0;
                }

                if ($_FILES["pdf"]["size"] > 5000000) {
                    echo "ขออภัยไฟล์ของคุณมีขนาดใหญ่เกินไป.";
                    $uploadOk_pdf = 0;
                }

                if ($uploadOk_pdf == 0) {
                    echo "ขออภัยไฟล์ของคุณไม่ได้ถูกอัปโหลด.";
                } else {
                    if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file_pdf)) {
                        $pdfPath = $target_file_pdf;
                    } else {
                        echo "ขออภัยมีข้อผิดพลาดในการอัปโหลดไฟล์ PDF ของคุณ.";
                    }
                }
            } else {
                echo "ไม่พบเส้นทางไฟล์ PDF.";
            }
        } else {
            $sqlSelect = "SELECT pdf_path FROM lab WHERE id=$id";
            $resultSelect = $conn->query($sqlSelect);
            if ($resultSelect->num_rows > 0) {
                $row = $resultSelect->fetch_assoc();
                $pdfPath = $row['pdf_path'];
            }
        }

        $sqlUpdate = "UPDATE lab SET 
            product_name='$productName', 
            description='$description', 
            usage_rate='$usageRate', 
            image_path='$imagePath',
            pdf_path='$pdfPath',
            type_id='$typeId' 
            WHERE id=$id";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success',
                            text: 'บันทึกอัปเดตเรียบร้อยแล้ว',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.href = 'labRead.php';
                        });
                    });
                  </script>";
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดตบันทึก: " . $conn->error;
        }
    } else {
        echo "พารามิเตอร์ ID ไม่ได้ระบุ.";
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>อัปเดตข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/back.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .btnn {
            padding: 6px;
            border-radius: 5px;
            text-decoration: none;
            color: #000;
            margin: 0 10px;
            font-size: 18px;
        }

        .btnn:hover {
            background-color: #ccc;
            height: 40px;
        }

        .btnnt {
            padding: 6px;
            border-radius: 5px;
            text-decoration: none;
            background-color: green;
            color: #e9ecef;
            margin: 0 10px;
            font-size: 17px;
        }
        .border-main{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            margin-bottom: 130px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 pt-5 h-100 border-main bg-light px-5">
        <div class="d-flex justify-content-between">
            <h2>อัปเดตข้อมูลสินค้า&nbsp;&nbsp; <i class="fa-solid fa-pen" style="color: #FFD43B;"></i></h2>
            <div class="btnn" onclick="window.location.href ='labRead.php'"><i class="fa-regular fa-circle-left" style="color: #FFD43B; padding-right: 10px;"></i>ย้อนกลับ</div>
        </div>

        <hr style="width: 50%;">
        <form method="post" enctype="multipart/form-data">
            <?php
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $sql = "SELECT * FROM lab WHERE id=$id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <div class="col-md-6 mb-3 text-center">
                            <img src="<?= $row['image_path'] ?>" alt="รูปภาพปัจจุบัน" style="max-width: 150px; max-height: 150px;" class="img-fluid rounded mb-3">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="new_image" class="form-label">อัปโหลดรูปภาพใหม่</label>
                            <input type="file" class="form-control mb-3" id="new_image" name="image" accept="image/*">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="product_name" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $row['product_name'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type_id" class="form-label">ประเภทการทดลอง</label>
                            <select class="form-select" id="type_id" name="type_id" required>
                                <option value="">เลือกประเภท</option>
                                <option value="1" <?= $row['type_id'] == 1 ? 'selected' : '' ?>>การทดสอบในห้องปฏิบัติการ</option>
                                <option value="2" <?= $row['type_id'] == 2 ? 'selected' : '' ?>>การทดสอบจริงภายนอก</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="usage_rate" class="form-label">อัตราการใช้</label>
                            <input type="text" class="form-control" id="usage_rate" name="usage_rate" value="<?= $row['usage_rate'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required><?= $row['description'] ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pdf" class="form-label">อัปโหลด PDF ใหม่</label>
                            <input type="file" class="form-control mb-3" id="pdf" name="pdf" accept=".pdf">
                        </div>
                        <div class="col-md-6 mb-3">
                            <?php if (!empty($row['pdf_path'])) { ?>
                                <label class="form-label">PDF เดิม:</label>
                                <a href="<?= htmlspecialchars($row['pdf_path']) ?>" target="_blank"><?= basename($row['pdf_path']) ?></a>
                            <?php } ?>
                        </div>




                        <div class="col-md mb-3 text-end">
                            <button type="submit" class="btnnt rounded p-2">อัปเดตข้อมูล</button>
                        </div>
                    </div>
            <?php
                } else {
                    echo "ไม่พบข้อมูล.";
                }
            } else {
                echo "พารามิเตอร์ ID ไม่ได้ระบุ.";
            }
            ?>
        </form>
    </div>
</body>

</html>

<?php include 'footerAdmin.php'; ?>