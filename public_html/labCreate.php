<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$chekeStartPage = false;
include 'headerAdmin.php';
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $usageRate = $_POST['usage_rate'];
    $type_id = $_POST['type_id'];

    $uploadDir = 'uploads_lab/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $pdfName = null;
    $pdfPath = null;
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == UPLOAD_ERR_OK) {
        $uploadedPdf = $_FILES['pdfFile'];
        $pdfTmpPath = $uploadedPdf['tmp_name'];
        $pdfName = basename($uploadedPdf['name']);
        $pdfExt = strtolower(pathinfo($pdfName, PATHINFO_EXTENSION));
        $pdfPath = $uploadDir . $pdfName;

        if ($pdfExt != 'pdf') {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Only PDF files are allowed.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'labRead.php';
                    });
                  </script>";
            exit;
        }

        if (!move_uploaded_file($pdfTmpPath, $pdfPath)) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'There was a problem uploading the PDF.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'labRead.php';
                    });
                  </script>";
            exit;
        }
    } elseif ($_FILES['pdfFile']['error'] != UPLOAD_ERR_NO_FILE) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'File upload error: " . $_FILES['pdfFile']['error'] . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'labRead.php';
                });
              </script>";
        exit;
    }

    $imageName = null;
    $imagePath = null;
    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == UPLOAD_ERR_OK) {
        $uploadedImage = $_FILES['imageFile'];
        $imageTmpPath = $uploadedImage['tmp_name'];
        $imageName = basename($uploadedImage['name']);
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $imagePath = $uploadDir . $imageName;

        $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExt, $allowedImageExtensions)) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Only image files (jpg, jpeg, png, gif) are allowed.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'labRead.php';
                    });
                  </script>";
            exit;
        }

        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'There was a problem uploading the image.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'labRead.php';
                    });
                  </script>";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO lab (product_name, description, usage_rate, type_id, pdf_name, pdf_path, image_name, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", $productName, $description, $usageRate, $type_id, $pdfName, $pdfPath, $imageName, $imagePath);

    if ($stmt->execute()) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'บันทึกสำเร็จ',
                text: 'บันทึกข้อมูลใหม่เรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'labRead.php';
                }
            });
        });
    </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Error: " . $stmt->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'labRead.php';
                });
              </script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการทดลอง</title>
    <link rel="stylesheet" href="./assets/css/back.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
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

<body class='pt-5 '>
    <div class="container mt-5 pt-5 h-75 bg-light px-5 py-5 border-main justify-content-center align-items-center d-grid">
        <div class="d-flex justify-content-between">
            <h2>เพิ่มข้อมูลการทดลอง&nbsp;&nbsp;<i class="fa-solid fa-pen" style="color: #FFD43B;"></i></h2>
            <div type="submit" class="btnn" onclick="window.location.href ='labRead.php'"><i class="fa-regular fa-circle-left" style="color: #FFD43B; padding-right: 10px;"></i>ย้อนกลับ</div>
        </div>
        <hr style="width: 50%;">

        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="product_name" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type_id" class="form-label">ประเภทการทดลอง</label>
                    <select class="form-select" id="type_id" name="type_id" required>
                        <option value="">โปรดเลือกประเภทการทดลอง</option>
                        <option value="1">การทดสอบในห้องปฏิบัติการ</option>
                        <option value="2">การทดสอบจริงภายนอก</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">คุณสมบัติ</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usage_rate" class="form-label">อัตราการใช้งาน</label>
                    <input type="text" name="usage_rate" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pdfFile" class="form-label">อัพโหลด PDF</label>
                    <input type="file" name="pdfFile" class="form-control" accept=".pdf">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="imageFile" class="form-label">อัพโหลดรูปภาพ</label>
                    <input type="file" name="imageFile" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btnnt">เพิ่มข้อมูลการทดลอง</button>
            </div>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'footerAdmin.php' ?>
