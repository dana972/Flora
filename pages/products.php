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
    <!-- Customized Bootstrap Stylesheet -->
  

    <!-- Template Stylesheet -->
<style>
    body {
        font-family: Arial, sans-serif;
        color:white;
        font-weight:bolder;
    }
    .sr-only {
    width: 2px;
    height: 2px;
    position: absolute;
    overflow: hidden;
  }

  .scroll {
    --transition-time: 0.4s;
    --width-arrow-line: 6px;
    --color-arrow: white; /* Light pinkish shade */
  }

  .top-btn {
    display: block;
    width: 60px;
    aspect-ratio: 1 / 1;
    border-radius: 50%;
    position: fixed; /* Position fixed to the bottom right corner */
    bottom: 20px;
    right: 20px;
    background-color: #CB9DF0; /* Light lavender shade */
    box-shadow: 0 0 10px #CB9DF0; /* Same light lavender shade */
    overflow: hidden;
  }

  .top-btn::before,
  .top-btn::after {
    content: "";
    position: absolute;
    top: 25%;
    left: 50%;
    translate: -50% 0;
  }

  .top-btn::before {
    width: 24px;
    aspect-ratio: 1 / 1;
    border-top: var(--width-arrow-line) solid var(--color-arrow);
    border-left: var(--width-arrow-line) solid var(--color-arrow);
    rotate: 45deg;
  }

  .top-btn::after {
    width: var(--width-arrow-line);
    height: 50%;
    background-color: var(--color-arrow);
  }

  .scroll--active .top-btn:hover::before,
  .scroll--active .top-btn:hover::after {
    animation: top 0.8s infinite;
  }

  @keyframes top {
    0% {
      top: 100%;
    }

    100% {
      top: -50%;
    }
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

/* Back Home Button Styles */
.back-home-container {
    position: absolute; /* Absolute positioning */
    top: 20px; /* Distance from the top */
    left: 20px; /* Distance from the left */
    display: inline-block; /* Prevent it from taking full width */
}

.back-home-button {
    display: flex;
    align-items: center;
    font-size: 1em;
    font-weight: bold;
    color: #CB9DF0; /* Lavender color for text */
    text-decoration: none;
    padding: 10px 15px;
    background-color: white;
    border: 2px solid #CB9DF0; /* Lavender border */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.back-home-button:hover {
    background-color: #CB9DF0;
    color: white;
}

.back-arrow {
    margin-right: 10px; /* Space between the arrow and text */
    font-size: 1.5em; /* Larger size for the arrow */
}

/* Filter Form Styles */
.filter-container {
    position: absolute; /* Positioning the filter form */
    top: 20px; /* Distance from the top */
    right: 20px; /* Distance from the right */
    display: flex;
    justify-content: center;
    align-items: center; /* Center the content vertically */
    padding: 10px 20px;
    background-color: #CB9DF0; /* Lavender background */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
    width: auto; /* Ensure the width is auto based on content */
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

/* Responsive Styles */
@media (max-width: 768px) {
    /* On smaller screens, hide the Back Home text and only show the arrow */
    /* Back Home Button Styles */
.back-home-container {
    position: absolute; /* Absolute positioning */
    top: 20px; /* Distance from the top */
    left: 20px; /* Distance from the left */
    display: inline-block; /* Prevent it from taking full width */
}

.back-home-button {
    display: flex;
    align-items: center;
    font-size: 1.2em;
    font-weight: bold;
    color: #CB9DF0; /* Lavender color for text */
    text-decoration: none;
    padding: 10px 15px;
    background-color: white;
    border: 2px solid #CB9DF0; /* Lavender border */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.back-home-button:hover {
    background-color: #CB9DF0;
    color: white;
}

.back-arrow {
    margin-right: 10px; /* Space between the arrow and text */
    font-size: 1.5em; /* Larger size for the arrow */
}

/* Responsive Styles for Small Screens */
@media screen and (max-width: 768px) {
    .back-home-button {
        font-size: 1em; /* Adjust font size */
        padding: 10px; /* Reduce padding */
        justify-content: center; /* Center content horizontally */
    }

    .back-home-button span: {
        display: none; /* Hide the text */
    }
}


    .back-home-button {
        font-size: 1em; /* Increase the size of the arrow */
        padding: 10px; /* Reduce padding */
    }

    /* Adjust Filter Form for smaller screens */
    .filter-container {
        top: 10px; /* Move it closer to the top */
        right: 10px; /* Move it closer to the right */
        padding: 8px 12px; /* Make padding smaller */
    }

    .filter-container select {
        font-size: 0.9em; /* Reduce font size */
        padding: 8px; /* Make the select box smaller */
    }

    
}

@media (max-width: 480px) {
    /* Further reduce the size of elements on very small screens */
    .filter-container {
        top: 5px; /* Even closer to the top */
        right: 5px; /* Even closer to the right */
        padding: 6px 10px; /* Smaller padding */
    }

    .filter-container select {
        font-size: 0.8em; /* Smaller font size */
        padding: 6px; /* Smaller select box */
    }

    .back-home-button {
        font-size: 1.5em; /* Keep the arrow large */
        padding: 8px; /* Reduce padding */
    }
}

</style>
</head>
<body>

<div class="back-home-container">
    <a href="../index.php" class="back-home-button">
        <span class="back-arrow">←</span> Back Home
    </a>
</div>
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
                    Add to Cart<i class="fas fa-plus"></i>
                </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
<br><br><hr><br>
<?php include '../includes/footer.php'; ?>
<div class="scroll scroll--active">
  <a href="#top" type="button" class="top-btn">
    <span class="sr-only">Scroll to Top</span>
  </a>
</div>
<script>// Select the scroll container
const scrollButtonContainer = document.querySelector('.scroll');

window.addEventListener('scroll', () => {
  if (window.scrollY > 400) {
    scrollButtonContainer.classList.add('scroll--active'); // Show button
  } else {
    scrollButtonContainer.classList.remove('scroll--active'); // Hide button
  }
});
</script>
</body>
</html>
