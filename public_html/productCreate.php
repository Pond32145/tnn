<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$chekeStartPage = false;
include 'headerAdmin.php';
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $group_name = $_POST['group_name'];
    $common_name = $_POST['common_name'];
    $group_id = $_POST['group_id'];
    $type_id = $_POST['type_id'];
    $substance_characteristics = $_POST['substance_characteristics'];
    $packing_size = $_POST['packing_size'];
    $usage_rate = $_POST['usage_rate'];
    $feature = $_POST['feature'];
    $benefit = $_POST['benefit'];

    // Upload image
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO product (product_name, group_name, common_name,group_id, type_id, substance_characteristics, packing_size, usage_rate, feature, benefit, image) 
                    VALUES ('$product_name', '$group_name', '$common_name','$group_id','$type_id', '$substance_characteristics', '$packing_size', '$usage_rate', '$feature', '$benefit', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'บันทึกสำเร็จ',
                                text: 'บันทึกข้อมูลใหม่เรียบร้อยแล้ว',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'productRead.php';
                                }
                            });
                        });
                    </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error: " . $sql . "<br>" . $conn->error . "',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                      </script>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>เพิ่มยาฮอร์โมน</title>
    <link rel="stylesheet" href="./assets/css/back.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    

    <style>
        .btnn {
            padding: 6px;
            border-radius: 5px;
            text-decoration: none;
            /* background-color: green; */
            color: #000;
            margin: 0 10px;
            font-size: 18px;           
        }
        .btnn:hover{
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
    </style>
</head>

<body>
    <div class="container mt-5 pt-5" style="margin-bottom: 130px;">
        <div class="d-flex justify-content-between">
            <h2>เพิ่มข้อมูลยา&nbsp;&nbsp;<i class="fa-solid fa-pen" style="color: #FFD43B;"></i></i></h2>
            <div type="submit" class="btnn" onclick="window.location.href ='productRead.php'"><i class="fa-regular fa-circle-left" style="color: #FFD43B; padding-right: 10px;"></i>ย้อนกลับ</div>
        </div>
        <hr style="width: 50%;">

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="product_name" class="form-label">ชื่อสินค้า</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="type_id" class="form-label">ยาประเภท</label>
                    <select class="form-select" id="type_id" name="type_id" required>
                        <option value="">โปรดเลือกประเภทของยา</option>
                        <option value="1">ฮอร์โมน</option>
                        <option value="2">โรคพืช</option>
                        <option value="3">แมลง</option>
                        <option value="4">วัชพืช</option>
                        <option value="5">สารเสริม</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="group_id" class="form-label">กลุ่ม</label>
                    <input type="text" class="form-control" id="group_id" name="group_id" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="group_name" class="form-label">ชื่อกลุ่ม</label>
                    <input type="text" class="form-control" id="group_name" name="group_name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="common_name" class="form-label">ชื่อสามัญ</label>
                    <input type="text" class="form-control" id="common_name" name="common_name" required>
                </div>



                <div class="col-md-6 mb-3">
                    <label for="substance_characteristics" class="form-label">ลักษณะของสาร</label>
                    <input type="text" class="form-control" id="substance_characteristics" name="substance_characteristics" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="packing_size" class="form-label">ขนาดบรรจุ</label>
                    <input type="text" class="form-control" id="packing_size" name="packing_size" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usage_rate" class="form-label">อัตราการใช้งาน</label>
                    <input type="text" class="form-control" id="usage_rate" name="usage_rate" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="feature" class="form-label">คุณสมบัติ</label>
                    <textarea class="form-control" id="feature" name="feature" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="benefit" class="form-label">ผลประโยชน์</label>
                    <textarea class="form-control" id="benefit" name="benefit" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">อัพโหลดรูปภาพ</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
            </div>
            <div class="col-md-12 mt-4 text-end">
                <button type="submit" class="btnnt">เพิ่มข้อมูล</button>

            </div>
        </form>
    </div>

</body>

</html>

<?php include 'footerAdmin.php' ?>