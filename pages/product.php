<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Flora-Flowers shop</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Edu+TAS+Beginner:wght@400..700&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="..\assets\lib\animate\animate.min.css"/>
        <link href="..\assets\lib\owlcarousel\assets\owl.carousel.min.css" rel="stylesheet">
        


        <!-- Customized Bootstrap Stylesheet -->
        <link href="..\assets\css\NavHerobootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="..\assets\css\styleNavHero.css" rel="stylesheet">
    
    <style>/* General Styles */

.img-fluid .product-thumbnailimg {
  width: 200px;   /* Set a fixed width for all images */
  height: 250px;  /* Fixed height */
  object-fit: cover;  /* Ensures the image scales properly */
  border-radius: 10px;
  margin-bottom: 10px;
}


/* Filter Buttons */
.filter-buttons {
  text-align: center;
 margin-top:100px;
}

.filter-btn {
  background-color: #CB9DF0;
  color: white;
  border: none;
  padding: 10px 25px;
  margin: 5px;
  cursor: pointer;
  border-radius: 20px; /* Rounded buttons */
  transition: background-color 0.3s;
}

.filter-btn:hover {
  background-color: #F0C1E1;
}

/* Product Grid */
#product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  padding: 20px;
}

/* Product Card */
.product-card {
  background-color: #FFF9BF;
  border: 1px solid #F0C1E1;
  border-radius: 10px;
  width: 200px;
  padding: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  text-align: center;
}

.product-card img {
  width: 100%;
  height: 250px; /* Set a fixed height for all images */
  object-fit: cover; /* Ensures the image scales properly */
  border-radius: 10px;
  margin-bottom: 10px;
}


.product-card h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

/* Price and Button Container */
.price-cart-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.product-section {
  padding: 7rem 0; }
  .product-section .product-item {
    text-align: center;
    text-decoration: none;
    display: block;
    position: relative;
    padding-bottom: 50px;
    cursor: pointer; }
    .product-section .product-item .product-thumbnail {
      margin-bottom: 30px;
      position: relative;
      top: 0;
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease; }
    .product-section .product-item h3 {
      font-weight: 600;
      font-size: 16px; }
    .product-section .product-item strong {
      font-weight: 800 !important;
      font-size: 18px !important; }
    .product-section .product-item h3, .product-section .product-item strong {
      color: #2f2f2f;
      text-decoration: none; }
    .product-section .product-item .icon-cross {
      position: absolute;
      width: 35px;
      height: 35px;
      display: inline-block;
      background: #2f2f2f;
      bottom: 15px;
      left: 50%;
      -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
      transform: translateX(-50%);
      margin-bottom: -17.5px;
      border-radius: 50%;
      opacity: 0;
      visibility: hidden;
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease; }
      .product-section .product-item .icon-cross img {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%); }
        .product-section .product-item:before {
  bottom: 0;
  left: 0;
  right: 0;
  position: absolute;
  content: "";
  background: #FFF9BF; /* Grey color */
  height: 70%; /* Set this to the desired height */
  z-index: -1;
  border-radius: 10px;
  transition: none; /* Remove the transition */
}
.product-section .product-item:hover:before {background: #F0C1E1}

    .product-section .product-item:hover .product-thumbnail {
      top: -25px; }
    .product-section .product-item:hover .icon-cross {
      bottom: 0;
      opacity: 1;
      visibility: visible; }
    .product-section .product-item:hover:before {
      height: 70%; }
</style>
</head>
<body>
<?php include('..\includes\navbar.php'); ?>

<div class="filter-buttons">
  <button onclick="filterProducts('all')" class="filter-btn">All</button>
  <button onclick="filterProducts('flower')" class="filter-btn">Flowers</button>
  <button onclick="filterProducts('indoor')" class="filter-btn">Indoor Plants</button>
  <button onclick="filterProducts('office')" class="filter-btn">Office Plants</button>
</div>

<div id="product-grid">
<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">

		      		<!-- Start Column 1 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="#">
							<img src="../assets/images/productf1-removebg-preview.png" class="img-fluid product-thumbnail">
							<h3 class="product-title">Nordic Chair</h3>
							<strong class="product-price">$50.00</strong>

							<span class="icon-cross">
								<img src="../assets/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div> 
					<!-- End Column 1 -->
						
					<!-- Start Column 2 -->
					
					<!-- End Column 2 -->

					<!-- Start Column 3 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="#">
							<img src="../assets/images/productf3-removebg-preview.png" class="img-fluid product-thumbnail">
							<h3 class="product-title">Kruzo Aero Chair</h3>
							<strong class="product-price">$78.00</strong>

							<span class="icon-cross">
								<img src="../assets/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- End Column 3 -->

					<!-- Start Column 4 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="#">
							<img src="../assets/images/productf4-removebg-preview.png" class="img-fluid product-thumbnail">
							<h3 class="product-title">Ergonomic Chair</h3>
							<strong class="product-price">$43.00</strong>

							<span class="icon-cross">
								<img src="../assets/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- End Column 4 -->


					<!-- Start Column 1 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="#">
							<img src="../assets/images/productf5-removebg-preview.png" class="img-fluid product-thumbnail">
							<h3 class="product-title">Nordic Chair</h3>
							<strong class="product-price">$50.00</strong>

							<span class="icon-cross">
								<img src="../assets/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div> 
					<!-- End Column 1 -->
						
				
		      	</div>
		    </div>
		</div>


</div>

<script>function filterProducts(category) {
  const products = document.querySelectorAll('.product-card');
  products.forEach(product => {
    if (category === 'all' || product.dataset.category === category) {
      product.style.display = 'block';
    } else {
      product.style.display = 'none';
    }
  });
}
</script>
</body>
</html>