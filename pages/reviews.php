<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Investa - Investment Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/assets/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/assets/css/all.assets/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.assets/css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.assets/css/4.1.1/animate.min.assets/css"/>
        <link href="assets/lib/animate/animate.min.assets/css" rel="stylesheet">
        <link href="assets/lib/owlcarousel/assets/owl.carousel.min.assets/css" rel="stylesheet">
      


        

    </head>
    <style>/*** reviews Start ***/
.reviews .reviews-carousel {
    position: relative;
}

.reviews .reviews-carousel .owl-dots {
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.reviews .reviews-carousel .owl-dot {
    position: relative;
    display: inline-block;
    margin: 0 5px;
    width: 15px;
    height: 15px;
    background: var(--bs-light);
    border: 1px solid #CB9DF0;
    border-radius: 10px;
    transition: 0.5s;
}

.reviews .reviews-carousel .owl-dot.active {
    width: 40px;
    background: #CB9DF0;
}
.reviews .reviews-carousel .reviews-item {
  height: 300px; /* Set a fixed height */}
/*** reviews End ***/</style>
    <body>


        <!-- Flora Reviews Start -->
<div class="container-fluid reviews bg-light py-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-xl-4 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="h-100 rounded">
                    <h4  style="color: #CB9DF0;font-weight: bolder;font-size:xx-large;">Flora Reviews</h4>
                    <h1 class="display-4 mb-4">What Our Customers Say</h1>
                    <p class="mb-4">Discover what our customers love about our flowers and plants. Their feedback inspires us to grow and provide the best for your spaces.</p>
                    <a class="btn rounded-pill text-white py-3 px-5" href="#" style="background-color: #CB9DF0;">See All Reviews <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="reviews-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="reviews-item  rounded p-4 wow fadeInUp" data-wow-delay="0.3s" style="background-color: #F0C1E1;">
                        <div class="d-flex">
                            <div><i class="fas fa-quote-left fa-3x  me-3" style="color: #CB9DF0"></i></div>
                            <p class="mt-4 text-dark">"The flowers I ordered were stunning and lasted for weeks! The care tips provided were so helpful. Highly recommend their service!"</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="my-auto text-end">
                                <h5>Emily R.</h5>
                                <p class="mb-0">Plant Enthusiast</p>
                            </div>
                            <div class="bg-white rounded-circle ms-3">
                                <img src="assets/images/testimonial-1.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: #CB9DF0;" alt="Customer review">
                            </div>
                        </div>
                    </div>
                    <div class="reviews-item  rounded p-4 wow fadeInUp" data-wow-delay="0.5s" style="background-color: #FFF9BF;">
                        <div class="d-flex">
                            <div><i class="fas fa-quote-left fa-3x  me-3" style="color: #CB9DF0"></i></div>
                            <p class="mt-4 text-dark">"I bought an indoor plant for my office, and it's been thriving ever since. The team helped me pick the perfect one for my space."</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="my-auto text-end">
                                <h5>James L.</h5>
                                <p class="mb-0">Office Manager</p>
                            </div>
                            <div class="bg-white rounded-circle ms-3">
                                <img src="assets/images/testimonial-3.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: #CB9DF0;" alt="Customer review">
                            </div>
                        </div>
                    </div>
                    <div class="reviews-item  rounded p-4 wow fadeInUp" data-wow-delay="0.7s"style="background-color: #FFF9BF;">
                        <div class="d-flex">
                            <div><i class="fas fa-quote-left fa-3x  me-3"style="color: #CB9DF0"></i></div>
                            <p class="mt-4 text-dark">"The delivery was on time, and the flowers were fresh and vibrant. It made a beautiful gift for my friend!"</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="my-auto text-end">
                                <h5>Sarah K.</h5>
                                <p class="mb-0">Happy Customer</p>
                            </div>
                            <div class="bg-white rounded-circle ms-3">
                                <img src="assets/images/testimonial-2.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: #CB9DF0;" alt="Customer review">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    
<script>
    // reviews carousel
    $(".reviews-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : false,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    </script>
    </body>

</html>