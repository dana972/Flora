<?php
session_start();
require_once '../config/config.php';
// Fetch stats dynamically
$stmt = $pdo->query("SELECT COUNT(*) as total FROM products");
$productsCount = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM orders");
$ordersCount = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
$usersCount = $stmt->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
           body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
            color: #333;
        }

        .navbar {
    background-color: #CB9DF0;
    color: #fff;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 10;
    box-sizing: border-box; /* Ensures padding is included in width calculations */
}

.navbar h1 {
    margin: 0;
    font-size: 1.5rem; /* Adjust font size if needed for spacing */
}

.navbar button {
    background-color: #F0C1E1;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    color: #fff;
    font-weight: bold;
    margin-left: auto; /* Push the button to the right */
}

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #F0C1E1;
    padding: 1rem;
    position: fixed;
    top: 0; /* Align with the top of the page */
    left: 0;
    overflow-y: auto;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    padding-top: 4rem; /* Push content below the navbar */
}
        .navbar h1 {
            margin: 0;
        }

        .sidebar {
    width: 250px;
    height: 100vh;
    background-color: #F0C1E1;
    padding: 1rem;
    position: fixed;
    top: 0; /* Align with the top of the page */
    left: 0;
    overflow-y: auto;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    padding-top: 4rem; /* Push content below the navbar */
}

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 1rem 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #CB9DF0;
            color: #fff;
        }

        .main-content {
    margin-left: 270px; /* Offset by sidebar width */
    margin-top: 4rem; /* Offset by navbar height */
    padding: 2rem;
}
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card h2 {
            margin: 0 0 1rem;
            color: #CB9DF0;
        }

        .card p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Flora Admin Dashboard</h1>
        <a href="logout.php">
            <button style="background-color: #F0C1E1; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; color: #fff; font-weight: bold;">Logout</button>
        </a>
    </div>

    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_categories.php">Manage Categories</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_gallery.php">Manage Gallery</a></li>
            <li><a href="view_messages.php">View Customer Messages</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="card">
            <h2>Welcome, Admin!</h2>
            <p>Use the sidebar to navigate through the admin functionalities.</p>
        </div>

        <div class="card">
            <h2>Quick Stats</h2>
            <p>Total Products: <?= $productsCount; ?></p>
            <p>Total Orders: <?= $ordersCount; ?></p>
            <p>Total Users: <?= $usersCount; ?></p>
        </div>
    </div>
</body>
</html>


