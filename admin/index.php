<?php
session_start(); //set session 
require('conn.php');
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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="css/index.css">

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <style>
        /* view images button CSS */
        .actionBtn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        }

        .actionBtn:hover {
        background-color: #FFEBCD;
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 11;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            z-index: 12;
        }

        .swiper-container {
            width: 300px;
            height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            display: block; /* Remove any default image alignment */
            margin: 0 auto; /* Center image horizontally */
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            height: 20px;
            width: 20px;
            color: white;
            top: 55%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: black;
            border-radius: 50%;
            --swiper-navigation-size: 14px;
        }

        .swiper-button-next {
            right: 5px; /* Adjust the distance from the right edge */
        }

        .swiper-button-prev {
            left: 5px; /* Adjust the distance from the left edge */
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            width: 300px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .closeImg {
            position: absolute;
            top: 15px;
            right: 15px;
            color: black;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
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
            
                <h1 class="h3 mb-0 text-gray-800">Recent Orders</h1>
<!-- Recent orders table -->
<div id="orderstab" class="tabcontent">
    <!-- Table showing recent orders  -->
    <div class="recent-orders-table">
        <div class="table-responsive">
            <!--  this div to make the table responsive -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Username</th>
                        <th>Order Date</th>
                        <th>Amount (RM)</th>
                        <th>Tracking Number</th>
                        <th>Order Status</th>
                        <th>View Product Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Define how many records to display per page
                    $records_per_page = 10;

                    // Get the current page number from the query string
                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                        $current_page = intval($_GET['page']);
                    } else {
                        $current_page = 1;
                    }

                    // Calculate the offset for the SQL query
                    $offset = ($current_page - 1) * $records_per_page;

                    // SQL query to fetch order details with related information with pagination
                    $sql = "SELECT
                        o.order_id,
                        p.product_id,
                        p.product_name,
                        c.username,
                        o.order_date,
                        p.product_price AS total_amount,
                        COALESCE(o.track_number, 'NULL') AS track_number,
                        o.order_status
                        FROM
                        orders o
                        JOIN
                        customer c ON o.customer_id = c.customer_id
                        JOIN
                        order_details od ON o.order_id = od.order_id
                        JOIN
                        product p ON od.product_id = p.product_id
                        GROUP BY
                        o.order_id
                        ORDER BY
                        o.order_date DESC
                        LIMIT $records_per_page OFFSET $offset;";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['order_id'] . "</td>";
                            echo "<td>" . $row['product_id'] . "</td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['order_date'] . "</td>";
                            echo "<td>" . $row['total_amount'] . "</td>";
                            echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                            echo "<td>" . $row['order_status'] . "</td>";
                            echo "<td>" . "<button class='actionBtn' id='view-action' name='view-btn' onclick='viewImage(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='9'>" . "No Orders found." . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Display pagination links -->
            <?php
            // Count total number of records
            $total_records_sql = "SELECT COUNT(*) FROM orders;";
            $total_records_result = $conn->query($total_records_sql);
            $total_records = $total_records_result->fetch_row()[0];

            // Calculate the total number of pages
            $total_pages = ceil($total_records / $records_per_page);

            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item";
                if ($i == $current_page) {
                    echo " active";
                }
                echo "'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
    </div>
</div>


            </div>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- overlay for view images -->
        <div id="overlay" class="overlay"></div>
        <div id="see-image" class="popup">
        <span class="closeImg" onclick="closeImg()">&times;</span>
            <div class="swiper-container">
                <div id="swiperWrapper" class="swiper-wrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

    </div>

    <script>
    function viewImage(row) {
    var pId = row.product_id;
    console.log(pId);

    // Clear previous images
    var swiperWrapperDiv = document.getElementById("swiperWrapper");
    swiperWrapperDiv.innerHTML = "";

    fetch(`fetch-product-img.php?product_id=${pId}`)
        .then(response => response.json())
        .then(data => {
            data.images.forEach(base64Image => {
                var imgElement = document.createElement("img");
                imgElement.src = `data:image/jpeg;base64,${base64Image}`;

                var swiperSlide = document.createElement("div");
                swiperSlide.classList.add("swiper-slide");
                swiperSlide.appendChild(imgElement);

                swiperWrapperDiv.appendChild(swiperSlide);
            });

            var swiper = new Swiper(".swiper-container", {
                slidesPerView: 1,
                centeredSlides: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            document.getElementById('overlay').style.display = 'block';
            document.getElementById('see-image').style.display = 'block';
        })
        .catch(error => console.error('Error fetching data:', error));
}
    // view images API Ends



    function closeImg() {
        document.getElementById('see-image').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    </script>

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