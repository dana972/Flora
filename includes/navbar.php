<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>/* Base styles for the icons */
.icon-btn i {
    font-size: 1.3rem; /* Makes the icons larger */
    color: #CB9DF0; /* Default icon color */
    transition: color 0.3s ease, transform 0.3s ease; /* Smooth color change and hover effect */
}

/* Hover effect for icons */
.icon-btn:hover i {
    color: #F0C1E1; /* Changes color on hover */
    transform: scale(1.2); /* Slightly enlarges the icon on hover */
}

/* Search button styling */
.search-bar + .btn i {
    color: #CB9DF0; /* Matches your palette */
}

.search-bar + .btn:hover i {
    color: #F0C1E1; /* Lighter color on hover for search icon */
}
</style>
</head>
<body>
<div class="container-fluid header-top sticky-top">
            <div class="container d-flex align-items-center">
                <div class="d-flex align-items-center h-100">
                    <a href="#" class="navbar-brand" style="height: 125px;margin-left:0px">
                        <h1 class=" mb-0"><i class="fas fa-leaf"></i> Flora</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                </div>
                <div class="w-100 h-100">
                    <div class="topbar px-0 py-2 d-none d-lg-block" style="height: 45px;">
                        <div class="row gx-0 align-items-center">
                            <div class="col-lg-8 text-center text-lg-center mb-lg-0">
                                <div class="d-flex flex-wrap">
                                    <div class="border-end  pe-3">
                                        <a href="#" class="text-muted small"><i class="fas fa-map-marker-alt  me-2"></i>Find A Location</a>
                                    </div>
                                    <div class="ps-3">
                                        <a href="mailto:example@gmail.com" class="text-muted small"><i class="fas fa-envelope  me-2"></i>example@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end">
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex border-end  pe-3">
                                        <a class="btn p-0  me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn p-0  me-3" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn p-0  me-3" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="btn p-0  me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                    <div class="dropdown ms-3">
                                        <a href="#" class="dropdown-toggle " data-bs-toggle="dropdown"><small class="text-body"><i class="fas fa-globe-europe  me-2"></i> English</small></a>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">English</a>
                                            <a href="#" class="dropdown-item">Spanish</a>
                                            <a href="#" class="dropdown-item">Arabic</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-bar px-0 py-lg-0" style="height: 80px;">
                        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-lg-end">
                            <a href="#" class="navbar-brand-2">
                                <h1 class=" mb-0 "><i class="fas fa-leaf"></i> Flora</h1>
                                <!-- <img src="img/logo.png" alt="Logo"> -->
                            </a>  
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                                <span class="fa fa-bars"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <div class="navbar-nav mx-0 mx-lg-auto bg-white">
                                    <a href="index.html" class="nav-item nav-link active">Home</a>
                                    <a href="about.html" class="nav-item nav-link">About</a>
                                    <a href="service.html" class="nav-item nav-link">Services</a>
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                            <span class="dropdown-toggle">Products</span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="project.html" class="dropdown-item">Bouquets </a>
                                            <a href="team.html" class="dropdown-item">Indoor Plants</a>
                                            
                                        </div>
                                    </div>
                                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                                    <div class="nav-btn ps-3 d-flex align-items-center">
    <!-- Search Bar Start -->
    <form class="d-flex">
        <input class="form-control me-2 search-bar" type="search" placeholder="Search for flowers or plants..." aria-label="Search">
        <button class="btn me-3" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <!-- User Icon -->
    <a href="../pages/login.php" class="btn icon-btn me-3" title="Login">
        <i class="fas fa-user"></i>
    </a>
    <!-- Shopping Basket Icon -->
    <a href="cart.html" class="btn icon-btn" title="Cart">
        <i class="fas fa-shopping-basket"></i>
    </a>
</div>

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>