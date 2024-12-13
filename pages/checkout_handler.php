<?php
session_start();
require_once '../config/config.php'; // Database connection

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];

// Check if the cart is empty (retrieve items from the cart table)
$sql = "SELECT * FROM cart WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If the cart is empty
if (empty($cartItems)) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty.']);
    exit;
}

// Calculate the total amount of the order
$totalAmount = 0;
foreach ($cartItems as $item) {
    // Fetch the price of the product from the products table
    $sql = "SELECT price FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $item['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the product was found and calculate the total amount
    if ($product) {
        $priceAtPurchase = $product['price'];
        $totalAmount += $priceAtPurchase * $item['quantity'];
    } else {
        // If product is not found, return an error message
        echo json_encode(['success' => false, 'message' => 'Product not found for cart item.']);
        exit;
    }
}

// Begin transaction
try {
    $pdo->beginTransaction();

    // Step 1: Create a new order record
    $sql = "INSERT INTO orders (user_id, total_amount, status, created_at) VALUES (:user_id, :total_amount, 'pending', NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $userId,
        'total_amount' => $totalAmount
    ]);
    $orderId = $pdo->lastInsertId(); // Get the newly created order ID

    // Step 2: Move items from the cart to the order_items table
    foreach ($cartItems as $item) {
        // Fetch the price of the product from the products table
        $sql = "SELECT price FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['product_id' => $item['product_id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $priceAtPurchase = $product['price'];

            // Insert the cart item into the order_items table
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) 
                    VALUES (:order_id, :product_id, :quantity, :price_at_purchase)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_purchase' => $priceAtPurchase // Use price fetched from products table
            ]);
        }
    }

    // Step 3: Clear the cart after placing the order
    $sql = "DELETE FROM cart WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    // Step 4: Commit the transaction
    $pdo->commit();

    // Success message and redirection to the order confirmation page
    // Redirect to the order confirmation page
    header("Location: order_confirmation.php?order_id=" . $orderId);
    exit;
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error placing order: ' . $e->getMessage()]);
}
?>
