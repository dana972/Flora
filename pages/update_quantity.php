<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'];
$newQuantity = (int)$_POST['quantity'];

require '../config/config.php';

try {
    $sql = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['quantity' => $newQuantity, 'user_id' => $userId, 'product_id' => $productId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Quantity updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
