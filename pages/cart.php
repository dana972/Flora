<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include Font Awesome -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
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

        .cart {
            width: 60%;
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

        .checkout {
            width: 35%;
            padding: 20px;
            background-color: #CB9DF0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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

    </style>
</head>
<body>
  
    <div class="container">
        <div class="cart">
            <div class="back-arrow">
                <a href="product-page-url" class="back-btn"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
            </div>
            <h1>Your Cart</h1>

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
                <tbody id="cart-items">
    <?php include 'fetch_cart.php'; // PHP file containing the backend PHP code ?>

</tbody>

            </table>

            <div id="cart-summary">
                <h2>Cart Summary</h2>
                <p>Total Items: <span id="total-items">0</span></p>
                <p>Total Price: $<span id="total-price">0.00</span></p>
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
    document.addEventListener('DOMContentLoaded', function() {
    // Fetch cart data from the server (replace with your actual URL)
    fetch('fetch_cart.php')
        .then(response => response.json())
        .then(cartData => {
            // Assuming the cart data is returned as an array of items
            cartItems = cartData;

            // Update the cart UI
            updateCart();
        })
        .catch(error => {
            console.error('Error fetching cart data:', error);
        });

    // Function to update the cart table and summary
    function updateCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        const totalItemsElement = document.getElementById('total-items');
        const totalPriceElement = document.getElementById('total-price');
        
        let totalItems = 0;
        let totalPrice = 0;

        cartItemsContainer.innerHTML = ''; // Clear the table before re-rendering

        cartItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            totalItems += item.quantity;
            totalPrice += itemTotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.productName}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>
                    <input type="number" value="${item.quantity}" min="1" class="quantity-input" data-product-id="${item.productId}">
                </td>
                <td>$${itemTotal.toFixed(2)}</td>
                <td>
                    <button class="remove-btn" data-product-id="${item.productId}">Remove</button>
                </td>
            `;
            cartItemsContainer.appendChild(row);
        });

        // Update the cart summary
        totalItemsElement.textContent = totalItems;
        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    // Handle quantity change
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('quantity-input')) {
            const productId = parseInt(event.target.getAttribute('data-product-id'));
            const newQuantity = parseInt(event.target.value);
            
            const product = cartItems.find(item => item.productId === productId);
            if (product) {
                product.quantity = newQuantity;
                updateCart();
            }
        }
    });

    // Handle remove button click
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-btn')) {
            const productId = parseInt(event.target.getAttribute('data-product-id'));

            const productIndex = cartItems.findIndex(item => item.productId === productId);
            if (productIndex !== -1) {
                const product = cartItems[productIndex];

                // Send request to remove item from the database
                fetch('remove_from_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Successfully removed from the database, now update the

    </script>
</body>
</html>