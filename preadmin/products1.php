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
            <h1 class="h3 mb-2 text-gray-800">Products</h1>

            <div class="row">

                <!-- Start Add new Product -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        Add New Product</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="btn btn-primary" href="addProductform.php" role="button">Add Product</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add New Product -->
                
                <!-- Start Add New Product Category -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        Add New Product Category </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <!-- <a class="btn btn-primary" href="formAction/insertNewProduct.php" role="button">Add Category</a> -->
                                        <a id="addLink" onclick="showOverlay('overlayCategory')" class="btn btn-primary" >Add Category</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add New Product Category -->

                <!-- Start Add New Product Type -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        Add New Product Type</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="btn btn-primary" href="formAction/insertNewProduct.php" role="button">Add Type</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add New Product -->

                <!-- Start View all Product -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        View All Product</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="btn btn-primary" href="formAction/insertNewProduct.php" role="button">View</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End View All Product -->

                <!-- Start View All Product Category -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        View All Product Category</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="btn btn-primary" href="formAction/insertNewProduct.php" role="button">View Category</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End View All Product Category -->

                <!-- Total Add new Product -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"> 
                                        View All Product Type</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a class="btn btn-primary" href="formAction/insertNewProduct.php" role="button">View Type</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End View All Product -->




            </div>

                <!-- Overlay container for Add New Product Category -->
            <div class="overlay" id="overlayCategory">
                <div class="overlay-frame">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="POST">
                        <label for="pcat">New Product Category:</label><br>
                        <textarea id="pcat" name="pcat" placeholder="Please input new product category here." rows="4" required></textarea><br>
                        <input type="submit" value="Submit">
                    </form>
                    <button onclick="hideOverlay('overlayCategory')">Back</button>
                </div>
            </div>

            <!-- Overlay container for Add New Product Category Notice -->
            <div class="overlay" id="overlayCategoryNotice">
                <div class="overlay-frame">
                    <p>Add New Product Category Notice</p>
                </div>
            </div>

            <!-- Overlay container for Add New Product Type -->
            <div class="overlay" id="overlayType">
                <div class="overlay-frame">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="POST">
                        <label for="ptype">New Product Type:</label><br>
                        <textarea id="ptype" name="ptype" placeholder="Please input new product type here." rows="4" required></textarea><br>
                        <input type="submit" value="Submit">
                    </form>
                    <button onclick="hideOverlay('overlayType')">Back</button>
                </div>
            </div>

            <!-- Overlay container for Add New Product Type Notice -->
            <div class="overlay" id="overlayTypeNotice">
                <div class="overlay-frame">
                    <p>Add New Product Type Notice</p>
                </div>
            </div>

            <?php
                // Check if the "pcat" key exists in the $_POST array
                if (isset($_POST['pcat'])) {
                    // Sanitize user input to prevent SQL injection
                    $pcat = mysqli_real_escape_string($conn, $_POST['pcat']);

                    // Check if $pcat is not empty
                    if (!empty($pcat)) {
                        // Perform actions related to product category
                        $insertCategorySQL = "INSERT INTO category (category_name) VALUES ('$pcat')";
                        
                        if ($conn->query($insertCategorySQL) === TRUE) {
                            // Insertion successful, redirect
                            echo '<script>
                                alert("Add New Product Category Notice\\n Category has been added!");
                            </script>';

                        } else {
                            echo "Error: " . $insertCategorySQL . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error: Product category is empty.";
                    }
                }

                // Check if the "ptype" key exists in the $_POST array
                if (isset($_POST['ptype'])) {
                    // Sanitize user input to prevent SQL injection
                    $ptype = mysqli_real_escape_string($conn, $_POST['ptype']);

                    // Check if $ptype is not empty
                    if (!empty($ptype)) {
                        // Perform actions related to product type
                        $insertTypeSQL = "INSERT INTO type (type_name) VALUES ('$ptype')";
                        
                        if ($conn->query($insertTypeSQL) === TRUE) {
                            // Insertion successful, redirect
                            echo '<script>
                                alert("Add New Product Type Notice\\n Type has been added!");
                            </script>';
                
                        } else {
                            echo "Error: " . $insertTypeSQL . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error: Product type is empty.";
                    }
                }
            ?>
            
        </div>

        
    </div>
    
    
        <?php require('footer.php'); ?>


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

    <script>
        function showOverlay(overlayId) {
            document.getElementById(overlayId).style.display = 'flex';
        }

        // Function to hide overlay
        function hideOverlay(overlayId) {
            document.getElementById(overlayId).style.display = 'none';
        }

        // Function to show overlay notice
        function showNotice(title, content) {
            document.getElementById('overlay-title').innerHTML = title;
            document.getElementById('overlay-input').innerHTML = content;
            document.getElementById('overlay').style.display = 'flex';
        }
    </script>

    
</body>
</html>
