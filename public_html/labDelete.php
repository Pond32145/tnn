<?php
include 'connectdb.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT pdf_path, image_path FROM lab WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($pdfPath, $imagePath);
$stmt->fetch();
$stmt->close();

if ($pdfPath && file_exists($pdfPath)) {
    unlink($pdfPath);
}

if ($imagePath && file_exists($imagePath)) {
    unlink($imagePath);
}

$stmt = $conn->prepare("DELETE FROM lab WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "<div class='alert alert-success'>Product deleted successfully.</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
}
$stmt->close();

$conn->close();
echo "<br><a href='labRead.php' class='btn btn-primary'>Go back</a>";
?>


