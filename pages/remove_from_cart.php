<?php
// remove_from_cart.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product ID from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['product_id'];

    // Logic to remove the product from the cart (for example, from session or database)
    // Assume a session-based cart
    session_start();

    // Remove item from session (or handle it according to your cart structure)
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['product_id'] == $productId) {
            unset($_SESSION['cart'][$index]);
            break;
        }
    }

    // Return success response
    echo json_encode(['success' => true]);
}
?>
