<?php
// Assuming you have a database connection in a config file
include '../config/config.php';

// Handling form submission to add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = 1; // Example user ID, replace with actual user ID logic
    $quantity = 1;

    // Check if the product already exists in the cart
    $check_query = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product exists, increment the quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;
        $update_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
    } else {
        // Product does not exist, add to cart
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    }

    if ($stmt->execute()) {
        echo 'Product added to cart!';
    } else {
        echo 'Error adding product to cart: ' . $stmt->error;
    }

    $stmt->close();
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
    display: flex;
    align-items: center; /* Center items vertically */
}

.back-arrow a {
    font-size: 1.2em;
    font-weight: bold;
    color: #CB9DF0;
    text-decoration: none;
    display: flex;
    align-items: center; /* Center the content vertically */
}

.back-arrow a i {
    margin-right: 5px; /* Space between the icon and text */
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
                <a href="../index.php#product" class="back-btn"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
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
                    <!-- Cart items will be dynamically injected here by JavaScript -->
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
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const quantity = 1; // Set default quantity to 1 if not specified

            // Send AJAX request to add to cart
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}&quantity=${quantity}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Display a success message
                // Optionally, refresh the cart summary without reloading the page
                updateCartSummary();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

// Function to update the cart summary without reloading the page
function updateCartSummary() {
    // Fetch the updated cart data and update the UI
}


    </script>
</body>
</html>
