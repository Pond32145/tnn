<link rel="stylesheet" href="./assets/css/back.css">
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// $chekeStartPage = false;
// include 'headerAdmin.php';
include 'connectdb.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Select image file path first
    $sql = "SELECT image FROM product WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $row['image'];

        // Delete record from database
        $sqlDelete = "DELETE FROM product WHERE id=$id";

        if ($conn->query($sqlDelete) === TRUE) {
            // Delete image file from directory
            if (unlink($imagePath)) {
                // Redirect to read.php after successful deletion
                header('Location: productRead.php');
                exit;
            } else {
                echo "Failed to delete image file.";
            }
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Image path not found.";
    }

    $conn->close();
}
?>
