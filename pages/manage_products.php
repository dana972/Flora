<?php
ob_start(); // Start output buffering
require '../config/config.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        h1, h2 {
            color: #CB9DF0;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto; /* Enables horizontal scrolling */
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #CB9DF0;
            color: #fff;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, textarea, button {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #CB9DF0;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #a371c9;
        }

        img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>

        <!-- Add Product Form -->
        <h2>Add New Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Name: <input type="text" name="name" required></label>
            <label>Image: <input type="file" name="image" accept="image/*"></label>
            <label>Description: <textarea name="description" required></textarea></label>
            <label>Price: <input type="number" name="price" step="0.01" required></label>
            <label>Category ID: <input type="number" name="category_id" required></label>
            <label>Stock Quantity: <input type="number" name="stock_quantity" required></label>
            <button type="submit" name="action" value="create">Add Product</button>
        </form>

        <!-- List Products -->
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category ID</th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Fetch all products
                    $stmt = $pdo->query("SELECT * FROM products");
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['product_id'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>"></td>
                            <td><?= $product['description'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><?= $product['category_id'] ?></td>
                            <td><?= $product['stock_quantity'] ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <button type="submit" name="action" value="edit">Edit</button>
                                    <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php
                } catch (PDOException $e) {
                    echo 'Error fetching products: ' . $e->getMessage();
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Product Form -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
            $product_id = $_POST['product_id'];
            try {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
                $stmt->execute([$product_id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product): ?>
                    <h2>Edit Product</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <label>Name: <input type="text" name="name" value="<?= $product['name'] ?>" required></label>
                        <label>Image: <input type="file" name="image" accept="image/*"></label>
                        <label>Description: <textarea name="description" required><?= $product['description'] ?></textarea></label>
                        <label>Price: <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" required></label>
                        <label>Category ID: <input type="number" name="category_id" value="<?= $product['category_id'] ?>" required></label>
                        <label>Stock Quantity: <input type="number" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required></label>
                        <button type="submit" name="action" value="update">Update Product</button>
                    </form>
                <?php endif;
            } catch (PDOException $e) {
                echo 'Error fetching product details: ' . $e->getMessage();
            }
        }
        ?>
    </div>

    <?php
    // Handle Create
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
        try {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock_quantity = $_POST['stock_quantity'];
            $image_url = null;

            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_name = basename($_FILES['image']['name']);
                $target_dir = "../assets/images/";
                $target_file = $target_dir . $image_name;

                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    $image_url = $target_file;
                } else {
                    throw new Exception('Image upload failed.');
                }
            }

            $stmt = $pdo->prepare("INSERT INTO products (name, image_url, description, price, category_id, stock_quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $image_url, $description, $price, $category_id, $stock_quantity]);

            header("Location: manage_products.php");
            exit();
        } catch (Exception $e) {
            echo 'Error creating product: ' . $e->getMessage();
        }
    }

    // Handle Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
        try {
            $product_id = $_POST['product_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock_quantity = $_POST['stock_quantity'];
            $image_url = $_POST['existing_image'] ?? null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_name = basename($_FILES['image']['name']);
                $target_dir = "../assets/images/";
                $target_file = $target_dir . $image_name;

                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    $image_url = $target_file;
                } else {
                    throw new Exception('Image upload failed.');
                }
            }

            $stmt = $pdo->prepare("UPDATE products SET name = ?, image_url = ?, description = ?, price = ?, category_id = ?, stock_quantity = ? WHERE product_id = ?");
            $stmt->execute([$name, $image_url, $description, $price, $category_id, $stock_quantity, $product_id]);

            header("Location: manage_products.php");
            exit();
        } catch (Exception $e) {
            echo 'Error updating product: ' . $e->getMessage();
        }
    }

    // Handle Delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        try {
            $product_id = $_POST['product_id'];
            $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->execute([$product_id]);

            header("Location: manage_products.php");
            exit();
        } catch (Exception $e) {
            echo 'Error deleting product: ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>
