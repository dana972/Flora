<?php
// Start the session
session_start();

// Database configuration
require '../config/config.php';

try {
    // Fetch all categories from the database
    $categorySql = "SELECT category_id, name FROM categories";
    $categoryStmt = $pdo->prepare($categorySql);
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get the category ID from the GET parameter
    $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

    // Fetch products based on the category ID
    $productSql = "SELECT product_id, name, price, description, image_url FROM products";
    if ($categoryId) {
        $productSql .= " WHERE category_id = :category_id";
    }

    $productStmt = $pdo->prepare($productSql);

    if ($categoryId) {
        $productStmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    }

    $productStmt->execute();
    $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Products</title>
<!-- Add Font Awesome for the cross icon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    body {
        font-family: Arial, sans-serif;
        color:white;
        font-weight:bolder;
    }

    .product-container {
        margin-top: 300px; /* Adjusted margin-top for better positioning */
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Gap between items horizontally */
        row-gap: 300px; /* Increased row gap for more space between rows */
        justify-content: center;
    }

    .product {
        background-color: #F0C1E1; /* Light pinkish background */
        border-radius: 10px;
        padding: 10px 20px 20px; /* Increased padding-top for image */
        width: 255px;
        height: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        text-align: center;
        position: relative;
    }

    .product img {
        position: absolute;
        top: -60%; /* Keeps the image floating above the product card */
        left: 50%;
        transform: translateX(-50%); /* Centers the image horizontally */
        width: 300px; /* Fixed width */
        height: 320px; /* Fixed height */
        border-radius: 50%; /* Makes the image circular */
        object-fit: cover; /* Ensures the image is cropped to fit without distortion */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow for better visibility */
        background-color: #CB9DF0; /* Fallback background for images that fail to load */
    }

    .product h2 {
        font-size: 1.5em;
        color: white; /* Lavender color for the title */
        margin-top: 130px; /* Adjusted margin to create space for the image */
    }

    .product p {
        font-size: 1em;
        color: #333; /* Dark text for description and price */
    }

    .product form {
        margin-top: 10px;
    }

    .product button {
        
        background-color:white ; /* Light pinkish background on hover */
        color:  #CB9DF0;/* Dark text color on hover */
        border: none;
        padding: 10px 5px; /* Larger padding for a bigger button */
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2em; /* Increased font size for the button */
        transition: background-color 0.2s;
        position: relative;
    }

    .product button:hover {
        background-color: #CB9DF0; /* Lavender color for button */
        color: #fff; /* White text on the button */
    }

    /* Add the cross icon next to the button */
    .product button i {
        margin-left: 10px; /* Space between the text and icon */
    }

    form select {
        padding: 10px;
        border: 1px solid #CB9DF0;
        border-radius: 5px;
        font-size: 1em;
        background-color: #F0C1E1;
        color: #333;
    }

    /* Filter Form Styles */
    .filter-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #CB9DF0; /* Lavender background */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
    }

    .filter-container label {
        font-size: 1.2em;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    .filter-container select {
        padding: 10px;
        font-size: 1em;
        border: 2px solid #CB9DF0; /* Lavender border */
        border-radius: 5px;
        background-color: white; /* Contrasting background for better visibility */
        color: #333;
        transition: border-color 0.2s, background-color 0.2s;
        -webkit-appearance: none; /* Remove default styling on Safari */
        -moz-appearance: none; /* Remove default styling on Firefox */
        appearance: none; /* Remove default styling on other browsers */
    }

</style>
</head>
<body>

<div class="filter-container">
    <form method="GET" action="">
        <label for="category_id">Filter by Category:</label>
        <select name="category_id" id="category_id" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>" 
                    <?php echo $categoryId == $category['category_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="product-container">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" >
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <button type="submit" name="add_to_cart">
                    Add to Cart
                     <!-- Plus Icon -->
                     <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
