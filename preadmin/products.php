<?php
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
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="products.css">

</head>

<body>
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    <div class="row">
        <!-- 3 cards to add new product, category and type respectively -->
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>Add New Product</p>
            </div>
            <div class="container">
                <a href="addProductform.php" class="btn btn-primary">Proceed to add</a>
            </div>
        </div>
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>Add New Product Category</p>
            </div>
            <div class="container">
                <a id="addLink" onclick="showOverlay('overlayCategory')" class="btn btn-primary text-white" >Proceed to add</a>
            </div>
        </div>
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>Add New Product Type</p>
            </div>
            <div class="container">
                <a class="btn btn-primary text-white" id="addLink" onclick="showOverlay('overlayType')" >Proceed to add</a>
            </div>
        </div>
        

        <!-- 3 cards to view new product, category and type respectively -->
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>View All Product</p>
            </div>
            <div class="container">
                <a href="viewAllProducts.php" class="btn btn-primary">Proceed to view</a>
            </div>
        </div>
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>View All Product Category</p>
            </div>
            <div class="container">
                <a href="viewProductsCategory.php" class="btn btn-primary">Proceed to view</a>
            </div>
        </div>
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="container text-xl font-weight-bold text-black text-uppercase mb-1">
                <p>View All Product Type</p>
            </div>
            <div class="container">
                <a href="viewProductsType.php" class="btn btn-primary">Proceed to view</a>
            </div>
        </div>
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

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of Products</h6>
    </div>
    <div class="products-table">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (RM)</th>
                        <th>Weight (kg)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Number of records per page
                        $records_per_page = 10;

                        // Get the current page number from the URL, default to 1 if not set
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                        // Calculate the offset for the SQL query
                        $offset = ($current_page - 1) * $records_per_page;

                        // SQL query to retrieve products with pagination
                        $sql = "SELECT * FROM product LIMIT $offset, $records_per_page";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['product_description'] . "</td>";
                                echo "<td>" . $row['product_price'] . "</td>";
                                echo "<td>" . $row['product_weight'] . "</td>";
                                echo "<td>" . $row['product_status'] . "</td>";
                                echo "</tr>";
                            }


                        // Pagination links
                        $total_pages_sql = "SELECT COUNT(*) as count FROM product";
                        $total_pages_result = $conn->query($total_pages_sql);
                        $total_rows = $total_pages_result->fetch_assoc()['count'];
                        $total_pages = ceil($total_rows / $records_per_page);

                        } else {
                            echo "No products found.";
                        }

                        // Close the database connection
                        //$conn->close();
                    ?>
                </tbody>
            </table>

    </div>



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
<?php 
require('footer.php');
?> 