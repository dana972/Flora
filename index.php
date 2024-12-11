<?php
session_start();
require_once 'config/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Flora-Flowers Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Edu+TAS+Beginner:wght@400..700&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate/animate.min.css">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>


<body>
<?php include 'includes/navbar.php'; ?>
<div id="home">
    <?php include('pages/home.php'); ?>
</div>
<hr>
<div id="about">
    <?php include('pages/about.php'); ?>
</div>
<div id="gallery">
    <?php include('pages/gallery.php'); ?>
</div>

<div id="reviews">
    <?php include('pages/reviews.php'); ?>
</div>
<hr>
<div id="contact">
    <?php include('pages/contact.php'); ?>
</div>
<hr>





<script>
  document.getElementById("exploreButton").addEventListener("click", function () {
    document.getElementById("whyus").scrollIntoView({ behavior: "smooth" });
  });

  document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll('[data-toggle="counter-up"]');

    counters.forEach((counter) => {
      const updateCounter = () => {
        const target = parseInt(counter.textContent.trim(), 10);

        if (isNaN(target)) {
          console.error(`Invalid number in counter: "${counter.textContent.trim()}"`);
          return; // Exit if the target is not a valid number
        }

        const speed = 200; // Number of animation frames
        const increment = Math.max(1, Math.floor(target / speed)); // Ensure increment is at least 1

        let count = 0;

        const animate = () => {
          count += increment;

          if (count < target) {
            counter.textContent = count;
            requestAnimationFrame(animate);
          } else {
            counter.textContent = target; // Ensure final number matches target
          }
        };

        animate();
      };

      // Trigger animation when visible
      const observer = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              updateCounter();
              observer.disconnect(); // Stop observing after triggering
            }
          });
        },
        { threshold: 0.5 } // Trigger when 50% visible
      );

      observer.observe(counter);
    });
  });
</script>



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