
<!DOCTYPE html>
<html lang="en">
<head>
<body>

        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel overflow-hidden">
            <div class="header-carousel-item hero-section">
               <img src="assets/images/top-view-flowers-with-copy-space.jpg" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <br>
                                    <br>
                                    <h1 class="display-2  mb-4" id=welcome>Welcome To Flora</h1>
                                      <h4 class=" text-uppercase fw-bold mb-4">Where Nature's Beauty Meets Your Special Moments</h4>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn  py-3 px-4 px-md-5 me-2 " href="product.php">Shop Now</a>
                                        <a class="btn py-3 px-4 px-md-5 ms-2" href="index.php#contact">Contact Us </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-section">
                <img src="assets/images/flat-lay-blooming-flowers-with-copy-space.jpg" alt="">
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

      
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/lib/wow/wow.min.js"></script>
        <script src="assets/lib/easing/easing.min.js"></script>
        <script src="assetslib/waypoints/waypoints.min.js"></script>
        <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
        
        <script>(function ($) {
    "use strict";

    // Initiate the wowjs
    new WOW().init();


    // Header carousel
    $(".header-carousel").owlCarousel({
        animateOut: 'fadeOut',
        items: 1,
        margin: 0,
        stagePadding: 0,
        autoplay: true,
        smartSpeed: 1000,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
    });


   
})(jQuery);

</script>
        
</body>
</html>