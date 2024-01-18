<?php
session_start(); //set session 
require('config.php');
require('header.php');
// require('sidebar.php');
?>

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
        <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-item-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <!-- <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50">
                            Generate Report
                        </i>
                    </a> -->
                </div>
                <!-- Content Row -->
                <div class="row">

                    <!-- Total Registered Users Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Registerd Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            // SQL query to count the number of registered users
                                            $sql = "SELECT COUNT(customer_id) AS total_users FROM customer";

                                            // Execute the query
                                            $result = $conn->query($sql);

                                            // Check if the query was successful
                                            if ($result) {
                                            // Fetch the result as an associative array
                                            $row = $result->fetch_assoc();

                                            // Get the total number of registered users
                                            $totalUsers = $row['total_users'];

                                            // Output the result
                                            // echo "Total Registered Users: " . $totalUsers;
                                            echo $totalUsers;
                                            } else {
                                            // If the query was not successful, output the error
                                            echo "Error: " . $conn->error;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Number of products Card-->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Products</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            // SQL query to count the number of products
                                            $sql = "SELECT COUNT(product_id ) AS total_products FROM product";

                                            // Execute the query
                                            $result = $conn->query($sql);

                                            // Check if the query was successful
                                            if ($result) {
                                            // Fetch the result as an associative array
                                            $row = $result->fetch_assoc();

                                            // Get the total number of registered users
                                            $totalProducts = $row['total_products'];

                                            // Output the result
                                            echo $totalProducts;
                                            // echo "Total Number of Products: " . $totalProducts;
                                            } else {
                                            // If the query was not successful, output the error
                                            echo "Error: " . $conn->error;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Completed Orders Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Completed Orders</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            // SQL query to count the number of products
                                            $sql = "SELECT COUNT(order_id) AS total_orders FROM orders WHERE order_status='delivered' ";

                                            // Execute the query
                                            $result = $conn->query($sql);

                                            // Check if the query was successful
                                            if ($result) {
                                            // Fetch the result as an associative array
                                            $row = $result->fetch_assoc();

                                            // Get the total number of registered users
                                            $totalOrders = $row['total_orders'];

                                            // Output the result
                                            echo $totalOrders;
                                            // echo "Total Number of Completed Orders: " . $totalOrders;
                                            } else {
                                            // If the query was not successful, output the error
                                            echo "Error: " . $conn->error;
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenuew Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Revenue</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php   
                                            // SQL query to get the total revenue
                                            $sql = "SELECT SUM(product.product_price) AS total_revenue
                                                    FROM orders
                                                    JOIN order_details ON orders.order_id = order_details.order_id
                                                    JOIN product ON order_details.product_id = product.product_id";

                                            // Execute the query
                                            $result = $conn->query($sql);

                                            // Check if the query was successful
                                            if ($result) {
                                            // Fetch the result as an associative array
                                            $row = $result->fetch_assoc();

                                            // Get the total revenue
                                            $totalRevenue = $row['total_revenue'];

                                            // Output the result
                                            echo "RM: ". $totalRevenue;
                                            // echo "Total Revenue (RM): " . $totalRevenue;
                                            } else {
                                            // If the query was not successful, output the error
                                            echo "Error: " . $conn->error;
                                            }

                                            // Close the database connection
                                            $conn->close();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">

                </div>

            </div>


    </div>


    <!-- footer begins -->
    <footer>
    <?php require('footer.php'); ?>
    </footer>
    <!-- footer ends -->
    
</body>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</html>