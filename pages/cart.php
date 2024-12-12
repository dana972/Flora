<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

$userId = $_SESSION['user_id']; // Retrieve the user ID from session

// Connect to the database
require '../config/config.php';

try {
    // Fetch cart items with product information for the logged-in user
    $sql = "SELECT c.product_id, c.quantity, p.name, p.price, p.description 
            FROM cart c 
            INNER JOIN products p ON c.product_id = p.product_id 
            WHERE c.user_id = :user_id 
            GROUP BY c.product_id, c.quantity, p.name, p.price, p.description";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate cart summary
    $totalItems = 0;
    $totalPrice = 0.00;

    foreach ($cartItems as $item) {
        $totalItems += $item['quantity'];
        $totalPrice += $item['quantity'] * $item['price'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include Font Awesome -->
    <style>
        .logout-link {
            display: inline-block;
            margin-left: auto;
            color: #CB9DF0;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-link:hover {
            color: #F0C1E1;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            background-color: white;
        }

        h1 {
            text-align: center;
            color: #CB9DF0;
            margin-bottom: 20px;
        }

        .back-arrow {
            position: absolute;
            top: 60px;
            left: 80px;
        }

        .back-arrow a {
            font-size: 1.2em;
            font-weight: bold;
            color: #CB9DF0;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .back-arrow a:hover {
            color: #F0C1E1;
        }

        .cart, .checkout {
            flex: 1;
            min-width: 300px;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart {
            margin-right: 20px;
        }

        .checkout {
            background: #CB9DF0;
            margin-left: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #CB9DF0;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
            color: white;
        }

        td {
            vertical-align: top;
        }

        #cart-summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #CB9DF0;
            border-radius: 8px;
            text-align: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        input.quantity-input {
            width: 50px;
            padding: 5px;
            text-align: center;
            border: 1px solid #CB9DF0;
            border-radius: 5px;
        }

        button.remove-btn {
            padding: 10px;
            background-color: #F0C1E1;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        button.remove-btn:hover {
            background-color: #CB9DF0;
        }

        .checkout h2 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .checkout form {
            display: flex;
            flex-direction: column;
        }

        .checkout input, .checkout textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #CB9DF0;
            border-radius: 5px;
        }

        .checkout button {
            padding: 10px;
            background-color: #F0C1E1;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
            font-size: 16px;
            font-weight: bolder;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .checkout button:hover {
            background-color: white;
            color: black;
        }

        .payment-methods {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .payment-methods img {
            width: 100px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .payment-methods img:hover {
            transform: scale(1.1);
        }

        /* Media query to stack cart and checkout vertically on smaller screens */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .cart, .checkout {
                margin: 0;
                margin-bottom: 20px;
                width: 100%;
            }
        }

        .navigation-links {
            display: flex;
            justify-content: flex-start; /* Align items to the left */
            gap: 20px;
            margin-bottom: 20px;
        }

        .navigation-link {
            display: inline-block;
            color: #CB9DF0;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border: 2px solid transparent;
            transition: all 0.3s ease-in-out;
        }

        .navigation-link:hover {
            color: white;
            background-color: #CB9DF0;
            border-color: #CB9DF0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
   
<div class="container">
    <div class="cart">
        <div class="navigation-links">
          <a href="products.php" class="navigation-link back-btn"><i class="fas fa-arrow-left"></i> Continue Shopping </a>
          <a href="logout.php" class="navigation-link logout-link">Log Out</a>
          
            
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <input type='number' class='quantity-input' value='<?= htmlspecialchars($item['quantity']) ?>' min='1'>
                        </td>
                        <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                        <td>
                            <button class='remove-btn' data-product-id="<?= htmlspecialchars($item['product_id'] ?? '') ?>" <?= isset($item['product_id']) ? '' : 'disabled' ?>>Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="cart-summary">
            <h2>Cart Summary</h2>
            <p>Total Items: <span id="total-items"><?= $totalItems ?></span></p>
            <p>Total Price: $<span id="total-price"><?= number_format($totalPrice, 2) ?></span></p>
        </div>
    </div>

    <div class="checkout">
        <h2>Checkout</h2>
        <form id="checkout-form">
            <!-- Payment Section -->
            <input type="text" id="card-name" name="card-name" placeholder="Cardholder Name" required>
            <input type="text" id="card-number" name="card-number" placeholder="Card Number" required>
            <input type="text" id="card-expiry" name="card-expiry" placeholder="Expiry Date (MM/YY)" required>
            <input type="text" id="card-cvc" name="card-cvc" placeholder="CVC" required>

            <button type="submit">Place Order</button>
        </form>

        <div class="payment-methods">
            <img src="../assets/images/visa.svg" alt="Visa" title="Visa">
            <img src="../assets/images/master.png" alt="MasterCard" title="MasterCard">
            <img src="../assets/images/paypal.png" alt="PayPal" title="PayPal">
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');

        if (!productId) {
            alert('Invalid product. Cannot remove.');
            return;
        }

        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${encodeURIComponent(productId)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = this.closest('tr');
                const totalItemsElem = document.getElementById('total-items');
                const totalPriceElem = document.getElementById('total-price');
                const itemPrice = parseFloat(row.querySelector('td:nth-child(2)').textContent.slice(1));

                // Remove the row from the table
                row.remove();

                // Update cart summary
                let currentItems = parseInt(totalItemsElem.textContent, 10);
                let currentTotal = parseFloat(totalPriceElem.textContent);

                totalItemsElem.textContent = currentItems - 1;
                totalPriceElem.textContent = (currentTotal - itemPrice).toFixed(2);

                alert(data.message);
            } else {
                alert(data.message || 'Failed to remove item.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function () {
        const productId = this.closest('tr').querySelector('.remove-btn').getAttribute('data-product-id');
        const newQuantity = this.value;

        if (newQuantity < 1) {
            alert('Quantity must be at least 1.');
            this.value = 1;
            return;
        }

        fetch('update_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${encodeURIComponent(productId)}&quantity=${encodeURIComponent(newQuantity)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const totalItemsElem = document.getElementById('total-items');
                const totalPriceElem = document.getElementById('total-price');
                const row = this.closest('tr');
                const price = parseFloat(row.querySelector('td:nth-child(2)').textContent.slice(1));
                let currentTotal = parseFloat(totalPriceElem.textContent);
                const oldQuantity = parseInt(this.getAttribute('data-quantity'));

                // Update cart summary
                totalItemsElem.textContent = parseInt(totalItemsElem.textContent) + (newQuantity - oldQuantity);
                totalPriceElem.textContent = (currentTotal + ((newQuantity - oldQuantity) * price)).toFixed(2);

                // Update the stored quantity data attribute
                this.setAttribute('data-quantity', newQuantity);

                alert(data.message);
            } else {
                alert(data.message || 'Failed to update quantity.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>


</body>
</html>
