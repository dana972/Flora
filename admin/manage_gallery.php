<?php
session_start();
require_once '../config/config.php';

$editItem = null;

// Handle adding a new gallery item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = $_POST['name'] ?? '';
        $image_url = $_POST['image_url'] ?? '';
        $delay_time = $_POST['delay_time'] ?? 0;

        if ($name && $image_url) {
            $stmt = $pdo->prepare("INSERT INTO gallery (name, image_url, delay_time) VALUES (:name, :image_url, :delay_time)");
            $stmt->execute([
                ':name' => $name,
                ':image_url' => $image_url,
                ':delay_time' => $delay_time,
            ]);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    // Handle updating an existing gallery item
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $image_url = $_POST['image_url'] ?? '';
        $delay_time = $_POST['delay_time'] ?? 0;

        if ($id && $name && $image_url) {
            $stmt = $pdo->prepare("UPDATE gallery SET name = :name, image_url = :image_url, delay_time = :delay_time WHERE id = :id");
            $stmt->execute([
                ':name' => $name,
                ':image_url' => $image_url,
                ':delay_time' => $delay_time,
                ':id' => $id,
            ]);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    // Handle deleting a gallery item
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Check if the user is editing an item
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = :id");
    $stmt->execute([':id' => $edit_id]);
    $editItem = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch all gallery items
$stmt = $pdo->query("SELECT * FROM gallery");
$galleryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F8F8F8;
}

.container {
    padding: 2rem;
    max-width: 1200px; /* Set a max width for the container */
    margin: 0 auto; /* Center the container */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: left;
}

table th {
    background-color: #CB9DF0;
    color: #fff;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
}

.btn.add {
    background-color: #CB9DF0;
}

.btn.edit {
    background-color: #CB9DF0;
}

.btn.delete {
    background-color: #CB9DF0;
}

.gallery-image {
    max-width: 100px;
    height: auto;
    border-radius: 8px;
}

.form-container {
    background-color: #fff;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-container input {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-container button {
    background-color: #CB9DF0;
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Gallery</h1>

        <!-- Form for adding or editing gallery items -->
        <div class="form-container">
            <?php if ($editItem): ?>
                <h2>Edit Gallery Item</h2>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $editItem['id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($editItem['name']); ?>" required>

                    <label for="image_url">Image URL:</label>
                    <input type="text" id="image_url" name="image_url" value="<?= htmlspecialchars($editItem['image_url']); ?>" required>

                    <label for="delay_time">Delay Time (in seconds):</label>
                    <input type="number" id="delay_time" name="delay_time" value="<?= htmlspecialchars($editItem['delay_time']); ?>" min="0" step="0.1">

                    <button type="submit">Update Item</button>
                </form>
            <?php else: ?>
                <h2>Add New Gallery Item</h2>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="add">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="image_url">Image URL:</label>
                    <input type="text" id="image_url" name="image_url" required>

                    <label for="delay_time">Delay Time (in seconds):</label>
                    <input type="number" id="delay_time" name="delay_time" min="0" step="0.1">

                    <button type="submit">Add Item</button>
                </form>
            <?php endif; ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Delay Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($galleryItems as $item): ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td>
                        <img src="../<?= htmlspecialchars($item['image_url']) ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>" 
                             class="gallery-image">
                    </td>
                    <td><?= htmlspecialchars($item['name']); ?></td>
                    <td><?= htmlspecialchars($item['delay_time']); ?>s</td>
                    <td>
                        <a href="?edit_id=<?= $item['id']; ?>" class="btn edit">Edit</a>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                            <button type="submit" class="btn delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
