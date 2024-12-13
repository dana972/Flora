<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .footer {
            padding: 40px 0;
            background-color: #F0C1E1;
            color: white;
            text-align: center;
            width: 100%;
            margin: 0;
        }

        .footer .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px; /* Space between icons */
            margin-bottom: 20px;
        }

        .footer .social-icons a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            color: #F0C1E1;
            font-size: 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .footer .social-icons a:hover {
            background-color: #CB9DF0;
            color: white;
            transform: scale(1.1);
        }

        .footer ul {
            padding: 0;
            list-style: none;
            text-align: center;
            font-size: 22px; /* Increased font size */
            font-weight: bold; /* Made text bold */
            line-height: 1.8;
            margin-bottom: 0;
        }

        .footer li {
            display: inline-block;
            padding: 0 15px; /* Increased padding for spacing */
        }

        .footer ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;
        }

        .footer ul a:hover {
            opacity: 1;
        }

        .footer .copyright {
            margin-top: 15px;
            text-align: center;
            font-size: 16px; /* Increased font size */
            font-weight: bolder; /* Made text bold */
            color: #aaa;
            margin-bottom: 0;
        }

        .footer .footer-break {
            height: 2px;
            border-width: 0;
            color: gray;
            background-color: white;
        }
    </style>
</head>
<body>
    <footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <hr class="footer-break">
        <ul class="footer-links" role="navigation" aria-labelledby="footer-links-heading">
            <h3 id="footer-links-heading" class="sr-only">Footer Links</h3>
            <li><a href="index.php#home">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="../index.php#contact">Contact Us</a></li>
            <li><a href="pages/cart.php">Order Now</a></li>

        </ul>
        <p class="copyright">2024&copy;Dana Amasha & Mariam Nasrallah</p>
    </footer>
</body>
</html>
