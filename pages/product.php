<div class="container">
    <?php
    // Assuming you have a database connection in a config file
    include '../config/config.php';

    // Fetch products from the database
    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    session_start(); // Start the session to retrieve user_id

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        $counter = 0;
        while ($product = $result->fetch_assoc()) {
            if ($counter % 4 == 0 && $counter > 0) {
                echo '</div><div class="row">'; // New row for every 4 products
            }
            echo '<div class="col-md-3 product">';
            echo '<img src="assets/images/' . $product['image_url'] . '" alt="' . $product['name'] . '">';
            echo '<h2>' . $product['name'] . '</h2>';
            echo '<p>' . $product['description'] . '</p>';
            echo '<p>Price: $' . number_format($product['price'], 2) . '</p>';
            echo '<p>Stock: ' . $product['stock_quantity'] . '</p>';
            // Adding hidden input to pass product_id to the cart handler
            echo '<form method="POST" action="cart.php">';
            echo '<input type="hidden" name="product_id" value="' . $product['product_id'] . '">';
            echo '<button type="submit">Add to Cart</button>';
            echo '</form>';
            echo '</div>';
            $counter++;
        }
        echo '</div>';
    } else {
        echo 'No products found.';
    }

    // Handling form submission to add to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['user_id']; // Retrieve user ID from the session
        $quantity = 1;

        // Insert into cart table
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);

        if ($stmt->execute()) {
            echo 'Product added to cart!';
        } else {
            echo 'Error adding product to cart: ' . $stmt->error;
        }

        $stmt->close();
    }
    ?>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 20px auto;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content:space-around;
        margin: 0 -15px;
    }

    .product {
        flex: 0 0 23%;
        max-width: 13%;
        margin: 15px;
        padding: 20px;
        border: 1px solid #CB9DF0;
        background-color: white;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product img {
        width: 100%;
        height: 300px;
        border-bottom: 1px solid #CB9DF0;
    }

    .product h2 {
        color: #CB9DF0;
    }

    .product p {
        color: #333;
    }

    .product button {
        background-color: #F0C1E1;
        color: #FFF;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product button:hover {
        background-color: #CB9DF0;
    }
  </style>
</head>
<body>
</body>
</html>
