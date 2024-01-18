<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <meta name="keywords" content="clothing, buy"> <!-- Separate keywords with commas -->
    <meta name="keywords" content="Prelovebyjosie, prelovebyjosie, clothing, ecommerce clothing">
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="css/index.css">

    <!-- Favicon for the browser tab -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Apple Touch Icon (iOS devices) -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Icon for Microsoft browsers -->
    <meta name="msapplication-TileImage" content="mstile-144x144.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- Standard favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Additional icon sizes for various devices -->
    <link rel="icon" sizes="192x192" href="icon-192x192.png">
    <link rel="icon" sizes="128x128" href="icon-128x128.png"> 

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="import" href="D:\02. UNIMAS\Y3 SEM 1\TMA3083TME3413 Sem 1 2324 (G01) Software Engineering Lab (Ts Nurfauza Jali)\WORK\adminNavbar.html">
</head> 

<body id="page-top">
<div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a href="index.php" class="sidebar-brand d-flex align-items-center justify-content-center">
            <img class="logo" src="assets/logo.jpg" alt="Prelovebyjosie logo" style="height: 3rem; padding-right: 0.5em;">
            <span class="sidebar-brand-text mx-10"> Prelovebyjosie Admin 
            </span>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a href="index.php" class="nav-link">
                <i class="material-symbols-outlined"> dashboard </i> 
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="customer.php" class="nav-link">
                <i class="material-symbols-outlined">
                group </i> 
                <span>Customers</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="products.php" class="nav-link">
                <i class="material-symbols-outlined">
                apparel </i> 
                <span>Products</span>
            </a>
        </li>

        <li class="nav-item">
        <a href="orders.php" class="nav-link">
                <i class="material-symbols-outlined">list_alt </i> 
                <span>Orders</span>
            </a>
        </li>

        <li class="nav-item">
        <a href="testimonials.php" class="nav-link">
            <i class="material-symbols-outlined"> rate_review</i> 
            <span>Testimonials</span>
            </a>
        </li>
        <li class="nav-item">
        <a href="request.php" class="nav-link">
            <i class="material-symbols-outlined">request_page</i> 
            <span>Item Request for Listing</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="reports.php" class="nav-link">
                <i class="material-symbols-outlined"> analytics </i> 
                <span>Reports</span>
            </a>
        </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto mt-2">

                        <div class="topbar-divider d-none d-lg-block"></div>
                        <div class="userinfo d-flex justify-content-end" style="display: flex">
                            <p>Hi, Admin</p>
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div class="logout">
                            <span class="material-symbols-outlined">exit_to_app</span>
                        </div>

                    </ul>
                </nav>
                <!-- End of Topbar -->

</body>