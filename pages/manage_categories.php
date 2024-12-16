<?php
ob_start(); // Start output buffering
require '../config/config.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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

        input, button {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Categories</h1>

        <!-- Add Category Form -->
        <h2>Add New Category</h2>
        <form method="POST">
            <label>Name: <input type="text" name="name" required></label>
            <button type="submit" name="action" value="create">Add Category</button>
        </form>

        <!-- List Categories -->
        <h2>Category List</h2>
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all categories
                $stmt = $pdo->query("SELECT * FROM categories");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['category_id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                <button type="submit" name="action" value="edit">Edit</button>
                                <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Edit Category Form -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
            $category_id = $_POST['category_id'];
            $stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
            $stmt->execute([$category_id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($category): ?>
                <h2>Edit Category</h2>
                <form method="POST">
                    <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                    <label>Name: <input type="text" name="name" value="<?= $category['name'] ?>" required></label>
                    <button type="submit" name="action" value="update">Update Category</button>
                </form>
            <?php endif;
        }
        ?>
    </div>

    <?php
    // Handle Create
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
        $name = $_POST['name'];

        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);

        header("Location: manage_categories.php");
        exit();
    }

    // Handle Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];

        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $stmt->execute([$name, $category_id]);

        header("Location: manage_categories.php");
        exit();
    }

    // Handle Delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        $category_id = $_POST['category_id'];
        $stmt = $pdo->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->execute([$category_id]);

        header("Location: manage_categories.php");
        exit();
    }
    ?>
</body>
</html>
