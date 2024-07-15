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
            max-width: 150px;
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
            /* text-align: center; */
            vertical-align: middle;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
        }


        body {
            background-image: url("./assets/image/658a6d9fe6f232cee6592fbc_Group 1172.png");
            background-repeat: no-repeat;
            background-size: contain;
            padding-top: 100px;
            /* height: 987px; */
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

        .bg-sha {
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 150px;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 150px;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 150px;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 150px;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 150px;
        }

        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 150px;
        }

        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 150px;
        }

        .table th:nth-child(8),
        .table td:nth-child(8) {
            width: 150px;
        }

        .table th:nth-child(9),
        .table td:nth-child(9) {
            width: 150px;
        }

        .table th:nth-child(10),
        .table td:nth-child(10) {
            width: 150px;
        }

        .table th:nth-child(11),
        .table td:nth-child(11) {
            width: 150px;
        }
    </style>

</head>

<body>

    <!-- <img src="./assets/image/658a6d9fe6f232cee6592fbc_Group 1172.png" alt="" class="header-background w-100"> -->


    <div class="container mt-5 p-3 bg-white bg-sha" style="border-radius: 8px; margin-bottom:30px; ">

        <div class="d-flex justify-content-between">
            <h2 class="mb-3">รายการข้อมูลยา</h2>

        </div>
        <div class="mb-3 flex d-flex justify-content-end align-items-center" style="font-size: medium;">
            <label for="filterType" class="form-label pt-2" style="font-size: small;text-decoration: none;">กรองตามประเภทยา:</label>
            <select class="form-select" style="width: 100px;font-size: small;" id="filterType">
                <option value="">ทั้งหมด</option>
                <option value="1">ฮอร์โมน</option>
                <option value="2">โรคพืช</option>
                <option value="3">แมลง</option>
                <option value="4">วัชพืช</option>
                <option value="5">สารเสริม</option>
            </select>
            <a href="productCreate.php" class="btnn">เพิ่มข้อมูล</a>
        </div>
        <?php


        $sql = "SELECT p.*, pt.name AS type_name
       FROM product p
       LEFT JOIN product_type pt ON p.type_id = pt.id";
        $result = $conn->query($sql);
        ?>

        <?php if ($result->num_rows > 0) : ?>
            <div class="table-responsive table-container" >
                <table class="table table-striped" id="Table">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภท</th>
                            <th>กลุ่ม</th>
                            <th>ยาประเภท</th>
                            <th>ชื่อสามัญ</th>
                            <th>ลักษณะของสาร</th>
                            <th>ขนาดบรรจุ</th>
                            <th>อัตราการใช้งาน</th>
                            <th>คุณสมบัติ</th>
                            <th>ผลประโยชน์</th>
                            <th>เพิ่มเติม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c = 0 ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= ++$c ?></td>
                                <td><img src="<?= $row["image"] ?>" alt="Product Image" style="max-width: 50px;"></td>
                                <td><?= $row["product_name"] ?></td>
                                <td><?= $row["group_name"] ?></td>
                                <td><?= $row["group_id"] ?></td>
                                <td><?= $row["type_name"] ?></td>
                                <td><?= $row["common_name"] ?></td>
                                <td><?= $row["substance_characteristics"] ?></td>
                                <td><?= $row["packing_size"] ?></td>
                                <td><?= $row["usage_rate"] ?></td>
                                <td><?= $row["feature"] ?></td>
                                <td><?= $row["benefit"] ?></td>
                                <td>
                                    <a href="productUpdate.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row["id"] ?>)">ลบ</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else : ?>
            <!-- <div class="alert alert-warning" role="alert">0 results</div> -->
        <?php endif; ?>
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

            new $.fn.dataTable.FixedColumns(table, {
                leftColumns: 1, // คอลัมน์ที่ 1 จะไม่ขยับได้
                rightColumns: 0 // คอลัมน์ที่ 11 หรือ Actions ข้างขวาที่ไม่ต้องการให้ขยับได้
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
                    window.location.href = `productDelete.php?id=${id}`;
                }
            });
        }
    </script>



</body>

</html>
<?php include 'footerAdmin.php' ?>