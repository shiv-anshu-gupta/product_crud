<?php
require './includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $product = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    // Update the product in the database
    $query = "UPDATE product SET 
              name = '$name', price = '$price', quantity = '$quantity', description = '$description' 
              WHERE id = $id";
    if (mysqli_query($connection, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Edit Product</h1>
    <form action="edit.php?id=<?php echo $product['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $product['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Product</button>
        <a href="index.php" class="btn btn-secondary btn-block mt-3">Back to Products</a>
    </form>
</div>

<!-- Bootstrap JS (Optional but recommended for responsive features) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
