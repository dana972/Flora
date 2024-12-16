<?php
session_start();
require_once '../config/config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user ID and order ID from the session and POST data
$userId = $_SESSION['user_id'];
$orderId = $_POST['order_id'] ?? null;

if ($orderId) {
    // Update the order status to "Cancelled"
    $sqlCancelOrder = "UPDATE orders SET status = 'Cancelled' WHERE order_id = :order_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sqlCancelOrder);
    $stmt->execute(['order_id' => $orderId, 'user_id' => $userId]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Order ID $orderId has been cancelled successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to cancel the order. Please try again.";
    }
}

// Redirect back to the orders page
header("Location: order_confirmation.php");
exit;
