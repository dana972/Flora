<?php
session_start();
require_once '../config/config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if user is not logged in
    exit;
}

$userId = $_SESSION['user_id'];
$orderId = $_GET['order_id'] ?? null; // Use null if order_id is not provided

// Fetch earlier orders for the same user
$sqlEarlierOrders = "SELECT o.order_id, o.status, o.created_at
                     FROM orders o
                     WHERE o.user_id = :user_id" . ($orderId ? " AND o.order_id != :order_id" : "") . "
                     ORDER BY o.created_at DESC";
$stmtEarlierOrders = $pdo->prepare($sqlEarlierOrders);

// Bind parameters based on the presence of order_id
$params = ['user_id' => $userId];
if ($orderId) {
    $params['order_id'] = $orderId;
}

$stmtEarlierOrders->execute($params);
$earlierOrders = $stmtEarlierOrders->fetchAll(PDO::FETCH_ASSOC);

// Check if an order ID was provided to fetch its details
if ($orderId) {
    // Fetch the order details for the current order
    $sql = "SELECT oi.*, p.name AS product_name, p.price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['order_id' => $orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize total cost for the current order
    $totalCost = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
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
    margin: 20px auto; /* Adds a 20px space from the top */
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
    top: 30px;
    left: 120px;
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

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .back-to-cart {
        left: 40px; /* Adjust left for smaller screens */
        padding: 8px 16px; /* Smaller padding */
        font-size: 1em; /* Smaller font */
    }

    .back-to-cart i {
        font-size: 1.2em; /* Smaller icon */
    }
}

@media (max-width: 480px) {
    .back-to-cart {
        left: 5px; /* Further adjust left for very small screens */
        padding: 6px 12px; /* Even smaller padding */
        font-size: 0.9em; /* Even smaller font */
    }

    .back-to-cart i {
        font-size: 0.2em; /* Smaller icon */
    }
}

    </style>
</head>
<body>
    <!-- Back to Cart Button -->
    <a href="cart.php" class="back-to-cart">
        <i>&larr;</i> Back to Cart
    </a>

    <div class="container">
        <?php if ($orderId && !empty($orderItems)) { ?>
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
        <?php } else { ?>
            <h2>No Current Order</h2>
            <p>No order details available for the given Order ID.</p>
        <?php } ?>

        <!-- Earlier orders section -->
        <div class="earlier-orders">
            <h3>Earlier Orders</h3>
            <?php if (!empty($earlierOrders)) { 
    foreach ($earlierOrders as $earlierOrder) { 
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
        <?php if ($earlierOrder['status'] !== 'Cancelled') { ?>
            <form action="cancel_order.php" method="POST">
                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($earlierOrder['order_id']); ?>">
                <button type="submit" style="background-color: #CB9DF0; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Cancel Order</button>
            </form>
        <?php } else { ?>
            <p style="color: red; font-weight: bold;">This order has been cancelled.</p>
        <?php } ?>
        <hr>
<?php }
} else { ?>
    <p>No earlier orders found.</p>
<?php } ?>

    </div>
</body>
</html>
