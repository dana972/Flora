<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit;
    }

    $userId = $_SESSION['user_id'];

    if (!isset($_POST['product_id'])) {
        echo json_encode(['success' => false, 'message' => 'Product ID missing.']);
        exit;
    }

    $productId = $_POST['product_id'];

    require '../config/config.php';

    try {
        // Check if the item exists in the cart
        $checkSql = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $cartItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$cartItem) {
            echo json_encode(['success' => false, 'message' => 'Item not found in cart.']);
            exit;
        }

        // Remove the item completely from the cart
        $deleteSql = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        echo json_encode(['success' => true, 'message' => 'Item removed from cart.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
