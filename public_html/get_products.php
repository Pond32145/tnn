<?php
include './connectdb.php';

$typeFilter = $_GET['type']; // รับค่า parameter จาก AJAX สำหรับกรองประเภทยา

$sql = "SELECT p.*, pt.name AS type_name
        FROM product p
        LEFT JOIN product_type pt ON p.type_id = pt.id";

if (!empty($typeFilter)) {
    $sql .= " WHERE p.type_id = '$typeFilter'";
}

$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// $conn->close();

echo json_encode($data);
