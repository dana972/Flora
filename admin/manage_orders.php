<?php
ob_start(); // Start output buffering
require '../config/config.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
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

        input, select, button {
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
        <h1>Manage Orders</h1>

        <!-- Add Order Form -->
        <h2>Add New Order</h2>
        <form method="POST">
            <label>User ID: <input type="number" name="user_id" required></label>
            <label>Total Amount: <input type="number" name="total_amount" step="0.01" required></label>
            <label>Status: <select name="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select></label>
            <button type="submit" name="action" value="create">Add Order</button>
        </form>

        <!-- List Orders -->
        <h2>Order List</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all orders
                $stmt = $pdo->query("SELECT * FROM orders");
                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['user_id'] ?></td>
                        <td><?= $order['total_amount'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button type="submit" name="action" value="edit">Edit</button>
                                <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Edit Order Form -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
            $order_id = $_POST['order_id'];
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
            $stmt->execute([$order_id]);
            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($order): ?>
                <h2>Edit Order</h2>
                <form method="POST">
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                    <label>User ID: <input type="number" name="user_id" value="<?= $order['user_id'] ?>" required></label>
                    <label>Total Amount: <input type="number" name="total_amount" step="0.01" value="<?= $order['total_amount'] ?>" required></label>
                    <label>Status: <select name="status" required>
                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select></label>
                    <button type="submit" name="action" value="update">Update Order</button>
                </form>
            <?php endif;
        }
        ?>
    </div>

    <?php
    // Handle Create
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
        $user_id = $_POST['user_id'];
        $total_amount = $_POST['total_amount'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $total_amount, $status]);

        header("Location: manage_orders.php");
        exit();
    }

    // Handle Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
        $order_id = $_POST['order_id'];
        $user_id = $_POST['user_id'];
        $total_amount = $_POST['total_amount'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("UPDATE orders SET user_id = ?, total_amount = ?, status = ? WHERE order_id = ?");
        $stmt->execute([$user_id, $total_amount, $status, $order_id]);

        header("Location: manage_orders.php");
        exit();
    }

    // Handle Delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        $order_id = $_POST['order_id'];
        $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->execute([$order_id]);

        header("Location: manage_orders.php");
        exit();
    }
    ?>
</body>
</html>
