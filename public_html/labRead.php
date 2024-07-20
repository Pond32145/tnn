<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$chekeStartPage = true;
include 'headerAdmin.php';
include 'connectdb.php';

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>รายการยา</title>
    <link rel="stylesheet" href="./assets/css/back.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 2px 8px;
            font-size: 15px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e9ecef;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .table td,
        .table th {
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
            /* max-width: 150px; */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table th {
            text-align: center;
            padding-right: 100px;
        }

        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
        }

        body {
            background-image: url("./assets/image/658a747e85fea47ec19cd381_Group 970.png");
            background-repeat: no-repeat;
            background-size: contain;
            padding-top: 100px;
        }

        .btnn {
            padding: 6px;
            border-radius: 5px;
            text-decoration: none;
            background-color: green;
            color: #e9ecef;
            margin: 0 10px;
            font-size: 13px;
        }

        .btnn:hover {
            color: aqua;
        }

        .bg-sha {
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
        }
    </style>

</head>

<body>

    <div class="container mt-5 p-3 bg-white bg-sha" style="border-radius: 8px; margin-bottom:30px; ">

        <div class="d-flex justify-content-between mb-3">
            <h2>รายการข้อมูลการทดลอง</h2>
            <div class="mb-3 flex d-flex justify-content-end align-items-center" style="font-size: medium;">
                <label for="filterType" class="form-label pt-2" style="font-size: small;text-decoration: none;">กรองตาม :</label>
                <select class="form-select" style="width: 100px;font-size: small;" id="filterType">
                    <option value="">ทั้งหมด</option>
                    <option value="การทดสอบในห้องปฏิบัติการ">การทดสอบในห้องปฏิบัติการ</option>
                    <option value="การทดสอบจริงภายนอก">การทดสอบจริงภายนอก</option>
                </select>
                <a href="labCreate.php" class="btnn">เพิ่มข้อมูล</a>
            </div>
        </div>

        <?php
        $filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
        $sql = "SELECT * FROM lab JOIN 
                lab_type ON lab.type_id = lab_type.type_id;";
        if (!empty($filterType)) {
            $sql .= " WHERE lab_type.type_id = " . intval($filterType);
        }
        $result = $conn->query($sql);
        ?>

        <div class="table-responsive table-container">
            <table class="table table-striped" id="Table">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อสินค้า</th>
                        <th>คุณสมบัติ</th>
                        <th>อัตราการใช้งาน</th>
                        <th>ประเภทการทดลอง</th>
                        <th>PDF</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <?php $counter++; ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><img src="<?= $row['image_path'] ?>" alt="Product Image" style="max-width: 50px;"></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td style="max-width: 350px;"><?= htmlspecialchars($row['usage_rate']) ?></td>
                            <td style="max-width: 350px;"><?= htmlspecialchars($row['type_name']) ?></td>

                            <td style="max-width: 100px;">
                                <?php if (!empty($row['pdf_path'])) { ?>
                                <a href="<?= htmlspecialchars($row['pdf_path']) ?>" target="_blank"><?= basename($row['pdf_path']) ?></a>
                            <?php } ?>
                            </td>
                            <td>
                                <a href="labUpdate.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row["id"] ?>)">ลบ</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php $conn->close(); ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.5/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var table = $('#Table').DataTable({
                "scrollX": true,
                "scrollY": "700px",
                "language": {
                    "search": "ค้นหา: ",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    }
                }
            });


        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถย้อนกลับได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ฉันจะลบ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `labDelete.php?id=${id}`;
                }
            });
        }
    </script>
    <script>
        document.getElementById('filterType').addEventListener('change', function() {
            var filterType = this.value;
            var tableRows = document.querySelectorAll('#Table tbody tr');

            var counter = 0; // ตัวแปรสำหรับนับเลขใหม่

            tableRows.forEach(function(row) {
                var rowType = row.querySelector('td:nth-child(6)').textContent; // เลือก cell ที่มีประเภทยา

                if (filterType === '' || rowType === filterType) {
                    row.style.display = 'table-row';
                    counter++; // เพิ่มเลขใหม่เมื่อแสดงแถว
                    row.querySelector('td:first-child').textContent = counter; // กำหนดเลขใหม่ในคอลัมน์แรก
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


</body>

</html>
<?php include 'footerAdmin.php' ?>