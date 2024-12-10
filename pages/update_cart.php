<?php
// update_cart.php
header('Content-Type: application/json');
include 'config/config.php'; // Include the database connection file

// Get data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'];
$quantity = $data['quantity'];

// Check if quantity is valid
if ($quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Quantity must be at least 1']);
    exit;
}

// Update the quantity in the database
$query = "UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?"; // Assuming user_id is part of the session
$stmt = $conn->prepare($query);
$stmt->bind_param('iii', $quantity, $productId, $_SESSION['user_id']); // Assuming user_id is stored in the session
$result = $stmt->execute();

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
}
?>
