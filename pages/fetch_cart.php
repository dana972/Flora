<?php
require_once '../config/config.php'; // Includes the mysqli-based config

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch cart items for the specific user
$user_id = 1; // Example user ID
$sql = "SELECT 
            cart.product_id, 
            products.name, 
            products.price, 
            cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.product_id 
        WHERE cart.user_id = ? 
        ORDER BY cart.product_id ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output cart items as table rows
if ($result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        $itemTotal = $item['price'] * $item['quantity'];
        echo "<tr>
            <td>{$item['name']}</td>
            <td>\${$item['price']}</td>
            <td>
                <input type='number' value='{$item['quantity']}' min='1' data-price='{$item['price']}' data-product-id='{$item['product_id']}' class='quantity-input'>
            </td>
            <td>\${$itemTotal}</td>
            <td>
                <button class='remove-btn' data-product-id='{$item['product_id']}'>Remove</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
}

$stmt->close();
$conn->close();
?>
