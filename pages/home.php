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
    </head>

    <body>


        <!-- Navbar & Hero Start -->
       
        <!-- Navbar & Hero End -->
        <?php include('..\includes\navbar.php'); ?>
        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel overflow-hidden">
            <div class="header-carousel-item hero-section">
               <img src="..\assets\images\top-view-flowers-with-copy-space.jpg" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h1 class="display-2  mb-4" id=welcome>Welcome To Flora</h1>
                                      <h4 class=" text-uppercase fw-bold mb-4">Where Nature's Beauty Meets Your Special Moments</h4>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn  py-3 px-4 px-md-5 me-2 " href="./product.php">Shop Now</a>
                                        <a class="btn py-3 px-4 px-md-5 ms-2" href="#">Contact Us </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-section">
                <img src="..\assets\images\flat-lay-blooming-flowers-with-copy-space.jpg" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                   
                                    <h1 class="display-2  mb-4" style="margin-top: 150px;margin-left:150px" >Daily Fresh Flowers </h1>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
        <!-- Carousel End -->

   

         <?php include('about.php'); ?>
        

        <!-- electrical template top nav hero section js links  -->
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="..\assets\lib\wow\wow.min.js"></script>
        <script src="..\assets\lib\easing\easing.min.js"></script>
        <script src="..\assets\lib\waypoints\waypoints.min.js"></script>
        <script src="..\assets\lib\owlcarousel\owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="..\assets\js\main.js"></script>
        <!-- electrical template top nav hero section js links  end-->
</body>
</html>