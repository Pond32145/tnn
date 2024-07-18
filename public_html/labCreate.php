<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload Product Details</h2>
        <?php
        include 'connectdb.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productName = $_POST['product_name'];
            $description = $_POST['description'];
            $usageRate = $_POST['usage_rate'];

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
                    echo "<div class='alert alert-danger'>Error: Only PDF files are allowed.</div>";
                    exit;
                }

                if (!move_uploaded_file($pdfTmpPath, $pdfPath)) {
                    echo "<div class='alert alert-danger'>Error: There was a problem uploading the PDF.</div>";
                    exit;
                }
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
                    echo "<div class='alert alert-danger'>Error: Only image files (jpg, jpeg, png, gif) are allowed.</div>";
                    exit;
                }

                if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                    echo "<div class='alert alert-danger'>Error: There was a problem uploading the image.</div>";
                    exit;
                }
            }

            $stmt = $conn->prepare("INSERT INTO lab (product_name, description, usage_rate, pdf_name, pdf_path, image_name, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $productName, $description, $usageRate, $pdfName, $pdfPath, $imageName, $imagePath);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Product details uploaded and saved successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="usage_rate" class="form-label">Usage Rate:</label>
                <input type="text" name="usage_rate" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pdfFile" class="form-label">Upload PDF:</label>
                <input type="file" name="pdfFile" class="form-control" accept=".pdf">
            </div>
            <div class="mb-3">
                <label for="imageFile" class="form-label">Upload Image:</label>
                <input type="file" name="imageFile" class="form-control" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
