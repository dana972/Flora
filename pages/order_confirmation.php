<?php
session_start();
require_once '../config/config.php';

// Ensure the user is logged in and an order_id is provided
if (!isset($_SESSION['user_id']) || !isset($_GET['order_id'])) {
    echo 'Invalid request or user not logged in.';
    exit;
}

$orderId = $_GET['order_id'];
$userId = $_SESSION['user_id'];

// Fetch the order details for the current order
$sql = "SELECT oi.*, p.name AS product_name, p.price
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = :order_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['order_id' => $orderId]);
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If no order items found
if (empty($orderItems)) {
    echo 'No items found for this order.';
    exit;
}

// Initialize total cost for the current order
$totalCost = 0;

// Fetch earlier orders for the same user
$sqlEarlierOrders = "SELECT o.order_id, o.status, o.created_at
                     FROM orders o
                     WHERE o.user_id = :user_id AND o.order_id != :order_id
                     ORDER BY o.created_at DESC";
$stmtEarlierOrders = $pdo->prepare($sqlEarlierOrders);
$stmtEarlierOrders->execute(['user_id' => $userId, 'order_id' => $orderId]);
$earlierOrders = $stmtEarlierOrders->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0C1E1;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #CB9DF0;
            text-align: center;
        }
        p {
            font-size: 1.2em;
            color: #555;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #CB9DF0;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .total-cost {
            font-size: 1.5em;
            font-weight: bold;
            text-align: center;
            margin-top: 30px;
            color: #CB9DF0;
        }
        .earlier-orders {
            margin-top: 40px;
        }
        .earlier-orders h3 {
            color: #CB9DF0;
        }
        .earlier-orders table {
            margin-top: 10px;
        }
        /* Back to Cart Button */
        .back-to-cart {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #CB9DF0;
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .back-to-cart i {
            margin-right: 10px;
            font-size: 1.5em;
        }
        .back-to-cart:hover {
            background-color: #a779d9;
        }
    </style>
</head>
<body>
    <!-- Back to Cart Button -->
    <a href="cart.php" class="back-to-cart">
        <i>&larr;</i> Back to Cart
    </a>

    <div class="container">
        <h2>Order Confirmation</h2>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderId); ?></p>
        <p><strong>Order Status:</strong> Pending</p>
        
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orderItems as $item) {
                    $itemTotal = $item['quantity'] * $item['price'];
                    $totalCost += $itemTotal;
                    echo "<tr>
                            <td>" . htmlspecialchars($item['product_name']) . "</td>
                            <td>" . $item['quantity'] . "</td>
                            <td>$" . number_format($item['price'], 2) . "</td>
                            <td>$" . number_format($itemTotal, 2) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        
        <p class="total-cost">Total Cost: $<?php echo number_format($totalCost, 2); ?></p>

        <!-- Earlier orders section -->
        <?php if (!empty($earlierOrders)) { ?>
        <div class="earlier-orders">
            <h3>Earlier Orders</h3>
            <?php foreach ($earlierOrders as $earlierOrder) { 
                // Fetch items for the earlier order
                $sqlEarlierOrderItems = "SELECT oi.*, p.name AS product_name, p.price
                                         FROM order_items oi
                                         JOIN products p ON oi.product_id = p.product_id
                                         WHERE oi.order_id = :order_id";
                $stmtEarlierOrderItems = $pdo->prepare($sqlEarlierOrderItems);
                $stmtEarlierOrderItems->execute(['order_id' => $earlierOrder['order_id']]);
                $earlierOrderItems = $stmtEarlierOrderItems->fetchAll(PDO::FETCH_ASSOC);
                $earlierOrderTotalCost = 0;
                ?>
                <h4>Order ID: <?php echo htmlspecialchars($earlierOrder['order_id']); ?> (Status: <?php echo htmlspecialchars($earlierOrder['status']); ?>)</h4>
                <p><strong>Order Date:</strong> <?php echo htmlspecialchars(date('F j, Y', strtotime($earlierOrder['created_at']))); ?></p>
                
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($earlierOrderItems as $item) {
                            $itemTotal = $item['quantity'] * $item['price'];
                            $earlierOrderTotalCost += $itemTotal;
                            echo "<tr>
                                    <td>" . htmlspecialchars($item['product_name']) . "</td>
                                    <td>" . $item['quantity'] . "</td>
                                    <td>$" . number_format($item['price'], 2) . "</td>
                                    <td>$" . number_format($itemTotal, 2) . "</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <p><strong>Total Cost: $<?php echo number_format($earlierOrderTotalCost, 2); ?></strong></p>
                <hr>
            <?php } ?>
        </div>
        <?php } else { ?>
            <p>No earlier orders found.</p>
        <?php } ?>
    </div>
</body>
</html>
