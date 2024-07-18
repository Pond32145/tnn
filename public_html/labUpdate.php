<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Product</h2>
        <?php
        include 'connectdb.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $productName = $_POST['product_name'];
            $description = $_POST['description'];
            $usageRate = $_POST['usage_rate'];

            $stmt = $conn->prepare("UPDATE lab SET product_name = ?, description = ?, usage_rate = ? WHERE id = ?");
            $stmt->bind_param("sssi", $productName, $description, $usageRate, $id);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Product details updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT product_name, description, usage_rate FROM lab WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($productName, $description, $usageRate);
            $stmt->fetch();
            $stmt->close();
        }

        $conn->close();
        ?>

        <form action="" method="post" class="mt-4">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" name="product_name" class="form-control" value="<?php echo htmlspecialchars($productName); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="usage_rate" class="form-label">Usage Rate:</label>
                <input type="text" name="usage_rate" class="form-control" value="<?php echo htmlspecialchars($usageRate); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
