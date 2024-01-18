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
                    <h1 class="h3 mb-2 text-gray-800">Testimonials</h1>

                    

                    <!-- Testimonials Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Testimonials</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Testimonial ID</th>
                                            <th>Cust. Username</th>
                                            <th>Product Name</th>
                                            <th>Time Created</th>
                                            <th>Description</th>
                                            <th>Images</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    <?php
                                        $sql = "SELECT
                                        t.testimonial_id,
                                        c.username AS customer_username,
                                        p.product_name,
                                        t.testimonial_time AS time_created,
                                        t.testimonial_description,
                                        ti.image AS testimonial_img
                                        FROM
                                        testimonial t
                                        JOIN
                                        customer c ON t.customer_id = c.customer_id
                                        LEFT JOIN
                                        orders o ON t.customer_id = o.customer_id 
                                        LEFT JOIN
                                        order_details od ON o.order_id = od.order_id
                                        LEFT JOIN
                                        product p ON od.product_id = p.product_id
                                        LEFT JOIN
                                        testimonial_img ti ON t.testimonial_id = ti.testimonial_id
                                        ORDER BY
                                        t.testimonial_id DESC";
                                        
                                        $result = $conn->query($sql);
                                        
                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['testimonial_id'] . "</td>";
                                                echo "<td>" . $row['customer_username'] . "</td>";
                                                echo "<td>" . $row['product_name'] . "</td>";
                                                echo "<td>" . $row['time_created'] . "</td>";
                                                echo "<td>" . $row['testimonial_description'] . "</td>";
                                                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['testimonial_img']) . "' alt='Testimonial Image' style='max-width: 100px;'></td>";
                                                echo "<td>";
                                                echo "<form method='post' action='deleteTestimonial.php'>";
                                                echo "<input type='hidden' name='testimonial_id' value='" . $row['testimonial_id'] . "'>                                                ";
                                                echo "<button type='submit' name='deleteTestBtn'>Delete</button>";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        
                                                echo "</table>";
                                            } else {
                                                echo "<tr>";
                                                echo "<td>";
                                                echo "No testimonials found.";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>


                </div>




            </div>
        </div>
        <?php require('footer.php'); ?>

    </div>

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

    
</body>
</html>
