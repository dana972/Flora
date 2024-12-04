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
  

        <style>
            /*** Attractions Start ***/
            .attractions {
                position: relative;
                overflow: hidden;
            }
            
            .attractions::after {
                content: "";
                width: 100%;
                height: 70%;
                position: absolute;
                overflow: hidden;
                top: 0;
                left: 0;
                background: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url(../assets/images/bannerbg.jpg) center center no-repeat;
                background-size: cover;
                z-index: -2;
                animation-name: attraction-image-zoom;
                animation-duration: 10s;
                animation-delay: 1s;
                animation-iteration-count: infinite;
                animation-direction: alternate;
                transition: 1s;
            }
            
            @keyframes attraction-image-zoom {
                0%  {width: 100%;}
            
                25% {width: 115%;}
            
                50% {width: 130%;}
            
                75% {width: 120%;}
            
                100% {width: 100%;}
            }
            
            .attractions .attractions-section {
                position: relative;
                z-index: 3;
            }
            
            .attractions .attractions-item {
                position: relative;
                border-radius: 10px;
                transition: 0.5s;
                z-index: 1;
            }
            
            .attractions .attractions-item::after {
                content: "";
                position: absolute;
                width: 100%;
                height: 0;
                top: 0;
                left: 0;
                border-radius: 10px;
                background: rgba(0, 0, 0, .7);
                transition: 0.5s;
                z-index: 2;
            }
            
            .attractions .attractions-item:hover:after {
                height: 100%;
            }
            
            .attractions .attractions-item .attractions-name {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 10px;
                color: #CB9DF0;
                font-size: 24px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: 0.5s;
                z-index: 3;
                opacity: 0;
            }
            
            .attractions .attractions-item:hover .attractions-name {
                opacity: 1;
            }
            
            .attractions-carousel .owl-stage-outer {
                margin-top: 58px;
            }
            
            .attractions .owl-nav .owl-prev {
                position: absolute;
                top: -58px;
                left: 0;
                background: #CB9DF0;
                color: var(--bs-white);
                padding: 6px 35px;
                border-radius: 30px;
                transition: 0.5s;
            }
            
            .attractions .owl-nav .owl-prev:hover {
                background: #F0C1E1;
                color: #CB9DF0;
            }
            
            .attractions .owl-nav .owl-next {
                position: absolute;
                top: -58px;
                right: 0;
                background: #CB9DF0;
                color: var(--bs-white);
                padding: 6px 35px;
                border-radius: 30px;
                transition: 0.5s;
            }
            
            .attractions .owl-nav .owl-next:hover {
                background: #F0C1E1;
                color: #CB9DF0;
            }
            .attractions-item img {
                height: 300px; /* Set the desired height */
                object-fit: cover; /* Ensures the image maintains its aspect ratio and fills the container */
            }
            
            /*** Attractions End ***/
            </style>
    </head>

    <body>

      

      <!-- Attractions Start -->
<div class="container-fluid attractions py-5" style="margin-top: 100px;">
    <div class="container attractions-section py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 style="
    color: #CB9DF0;font-weight: bolder;font-size:xx-large;">Flora Shop</h4>
            <h1 class="display-5 text-white mb-4">Explore Our Beautiful Bouquets and Plants</h1>
            <p class="text-white mb-0">Discover a curated selection of vibrant bouquets and lush indoor plants, perfect for adding beauty and natural elegance to your home and special occasions.
            </p>
        </div>
        <div class="owl-carousel attractions-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="attractions-item wow fadeInUp" data-wow-delay="0.2s">
                <img src="../assets/images/banner1.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">Swiss cheese</a>
            </div>
            <div class="attractions-item wow fadeInUp" data-wow-delay="0.4s">
                <img src="../assets/images/banner2.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">Pink Lily</a>
            </div>
            <div class="attractions-item wow fadeInUp" data-wow-delay="0.6s">
                <img src="../assets/images/banner3.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">Snake Plant</a>
            </div>
            <div class="attractions-item wow fadeInUp" data-wow-delay="0.8s">
                <img src="../assets/images/banner4.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">Red Roses</a>
            </div>
            <div class="attractions-item wow fadeInUp" data-wow-delay="1s">
                <img src="../assets/images/banner5.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">  Dracaena </a>
            </div> 
             <div class="attractions-item wow fadeInUp" data-wow-delay="1s">
                <img src="../assets/images/banner6.jpg" class="img-fluid rounded w-100" alt="">
                <a href="#" class="attractions-name">Pink Roses</a>
            </div>
        </div>
    </div>
</div>
<!-- Attractions End -->

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>


<script>
    // attractions carousel
    $(".attractions-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="fa fa-angle-right"></i>',
            '<i class="fa fa-angle-left"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            },
            1400:{
                items:4
            }
        }
    });

</script>

    </body>

</html>