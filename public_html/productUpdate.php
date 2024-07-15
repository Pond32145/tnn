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
    // ตรวจสอบว่ามีการระบุ ID หรือไม่
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $group_name = $_POST['group_name'];
        $common_name = $_POST['common_name'];
        $group_id = $_POST['group_id'];
        $substance_characteristics = $_POST['substance_characteristics'];
        $packing_size = $_POST['packing_size'];
        $usage_rate = $_POST['usage_rate'];
        $feature = $_POST['feature'];
        $benefit = $_POST['benefit'];

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($_FILES["image"]["name"]) {
            // เลือกเส้นทางไฟล์ภาพเดิมจากฐานข้อมูล
            $sqlSelect = "SELECT * FROM hormone WHERE id=$id";
            $resultSelect = $conn->query($sqlSelect);

            if ($resultSelect->num_rows > 0) {
                $row = $resultSelect->fetch_assoc();
                $oldImagePath = $row['image'];

                // ลบไฟล์ภาพเก่าออกจากไดเรกทอรี
                if (unlink($oldImagePath)) {
                    // ทำการอัปโหลดไฟล์ภาพใหม่
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // ตรวจสอบว่าไฟล์ที่อัปโหลดเป็นไฟล์ภาพจริงหรือไม่
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "ไฟล์ที่อัปโหลดไม่ใช่ไฟล์ภาพ.";
                        $uploadOk = 0;
                    }

                    // ตรวจสอบว่าไฟล์ภาพมีอยู่แล้วหรือไม่
                    if (file_exists($target_file)) {
                        echo "ขออภัยไฟล์นี้มีอยู่แล้ว.";
                        $uploadOk = 0;
                    }

                    // ตรวจสอบขนาดของไฟล์
                    if ($_FILES["image"]["size"] > 500000) {
                        echo "ขออภัยไฟล์ของคุณมีขนาดใหญ่เกินไป.";
                        $uploadOk = 0;
                    }

                    // อนุญาตเฉพาะรูปแบบไฟล์ที่รองรับ
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo "ขออภัยเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้นที่อนุญาต.";
                        $uploadOk = 0;
                    }

                    // ตรวจสอบว่ามีข้อผิดพลาดในการอัปโหลดไฟล์หรือไม่
                    if ($uploadOk == 0) {
                        echo "ขออภัยไฟล์ของคุณไม่ได้ถูกอัปโหลด.";
                    } else {
                        // หากทุกอย่างถูกต้อง ให้ทำการอัปโหลดไฟล์
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            // อัปเดตบันทึกในฐานข้อมูลด้วยเส้นทางไฟล์ภาพใหม่
                            $sqlUpdate = "UPDATE product SET 
                                product_name='$product_name', 
                                group_name='$group_name', 
                                common_name='$common_name', 
                                group_id='$group_id', 
                                substance_characteristics='$substance_characteristics', 
                                packing_size='$packing_size', 
                                usage_rate='$usage_rate', 
                                feature='$feature', 
                                benefit='$benefit', 
                                image='$target_file' 
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
                                                window.location.href = 'productRead.php';
                                            });
                                        });
                                      </script>";
                            } else {
                                echo "เกิดข้อผิดพลาดในการอัปเดตบันทึก: " . $conn->error;
                            }
                        } else {
                            echo "ขออภัยมีข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ.";
                        }
                    }
                } else {
                    echo "ล้มเหลวในการลบไฟล์ภาพเก่า.";
                }
            } else {
                echo "ไม่พบเส้นทางไฟล์ภาพ.";
            }
        } else {
            // หากไม่มีการอัปโหลดภาพใหม่ ให้อัปเดตบันทึกโดยไม่เปลี่ยนเส้นทางภาพ
            $sqlUpdate = "UPDATE product SET 
                product_name='$product_name', 
                group_name='$group_name', 
                common_name='$common_name', 
                group_id='$group_id', 
                substance_characteristics='$substance_characteristics', 
                packing_size='$packing_size', 
                usage_rate='$usage_rate', 
                feature='$feature', 
                benefit='$benefit' 
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
                                window.location.href = 'productRead.php';
                            });
                        });
                      </script>";
            } else {
                echo "เกิดข้อผิดพลาดในการอัปเดตบันทึก: " . $conn->error;
            }
        }

        //$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
    } else {
        echo "พารามิเตอร์ ID ไม่ได้ระบุ.";
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>อัปเดตยาข้อมูลยา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/back.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container mt-5 mb-5 pt-5">
        <h2 class="mb-4">อัปเดตยาข้อมูลยา</h2>
        <hr style="width: 50%;">
        <form method="post" enctype="multipart/form-data">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM product WHERE id=$id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <div class="col-md-6 mb-3 text-center">
                            <img src="<?= $row['image'] ?>" alt="รูปภาพปัจจุบัน" style="max-width: 150px; max-height: 150px;" class="img-fluid rounded mb-3">
                        </div>
                        <div class="col-md-6 mb-3 text-end pt-3">
                            <label for="new_image" class="form-label">อัปโหลดรูปภาพใหม่</label>
                            <input type="file" class="form-control mb-3" id="new_image" name="image" accept="image/*">

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="product_name" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $row['product_name'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="group_name" class="form-label">ชื่อกลุ่ม</label>
                            <input type="text" class="form-control" id="group_name" name="group_name" value="<?= $row['group_name'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="common_name" class="form-label">ชื่อทั่วไป</label>
                            <input type="text" class="form-control" id="common_name" name="common_name" value="<?= $row['common_name'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="group_id" class="form-label">กลุ่ม</label>
                            <input type="text" class="form-control" id="group_id" name="group_id" value="<?= $row['common_name'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="substance_characteristics" class="form-label">ลักษณะสาร</label>
                            <input type="text" class="form-control" id="substance_characteristics" name="substance_characteristics" value="<?= $row['substance_characteristics'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="packing_size" class="form-label">ขนาดบรรจุ</label>
                            <input type="text" class="form-control" id="packing_size" name="packing_size" value="<?= $row['packing_size'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="usage_rate" class="form-label">อัตราการใช้</label>
                            <input type="text" class="form-control" id="usage_rate" name="usage_rate" value="<?= $row['usage_rate'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="feature" class="form-label">คุณสมบัติ</label>
                            <textarea class="form-control" id="feature" name="feature" rows="3" required><?= $row['feature'] ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="benefit" class="form-label">ประโยชน์</label>
                            <textarea class="form-control" id="benefit" name="benefit" rows="3" required><?= $row['benefit'] ?></textarea>
                        </div>
                        <div class="col-md mb-3 text-end">
                            <button type="submit" class="btn btn-primary">อัปเดต</button>
                            <a href="productRead.php" class="btn btn-secondary">ย้อนกลับ</a>
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
<?php include 'footerAdmin.php' ?> 