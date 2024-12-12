<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Database configuration
require '../config/config.php';

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Fetch current quantity from cart for this product_id, if exists
try {
    $sql = "SELECT quantity FROM cart WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        // If product exists in cart, update the quantity
        $new_quantity = $existing['quantity'] + 1;
        $update_sql = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $pdo->prepare($update_sql);
        $stmt->execute(['quantity' => $new_quantity, 'user_id' => $user_id, 'product_id' => $product_id]);
    } else {
        // Otherwise, insert a new row
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $pdo->prepare($insert_sql);
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => 1]);
    }

    // Redirect to cart page after adding product successfully
    header("Location: cart.php");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
