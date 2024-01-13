<?php
require('config.php');
require('header.php');
require('sidebar.php');
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

</head>

<body>
    <div>
        <h2 class="table-header">Products</h2>
    </div>
    <!-- 3 cards to add new product, category and type respectively -->
    <div class="card">
        <div class="container">
            <p>Add New Product</p>
        </div>
        <div class="container">
            <a href="addProduct.php">Proceed to add</a>
        </div>
    </div>
    <div class="card">
        <div class="container">
            <p>Add New Product Category</p>
        </div>
        <div class="container">
            <a id="addLink" onclick="showOverlay('Add New Product Category')">Proceed to add</a>
        </div>
    </div>
    <div class="card">
        <div class="container">
            <p>Add New Product Type</p>
        </div>
        <div class="container">
            <a id="addLink" onclick="showOverlay('Add New Product Type')" >Proceed to add</a>
        </div>
    </div>
    

    <!-- 3 cards to view new product, category and type respectively -->
    <div class="card">
        <div class="container">
            <p>View All Product</p>
        </div>
        <div class="container">
            <a href="viewAllProducts.php">Proceed to view</a>
        </div>
    </div>
    <div class="card">
        <div class="container">
            <p>View All Product Category</p>
        </div>
        <div class="container">
            <a href="#">Proceed to view</a>
        </div>
    </div>
    <div class="card">
        <div class="container">
            <p>View All Product Type</p>
        </div>
        <div class="container">
            <a href="#">Proceed to view</a>
        </div>
    </div>

    <!-- Overlay container -->
    <div class="overlay" id="overlay">
        <div class="overlay-frame">
            <h2 id="overlay-title"></h2>
            <textarea id="overlay-input" placeholder="Please type new details here."></textarea>
            <br>
            <button onclick="hideOverlay()">Back</button>
            <button onclick="submitOverlayInput()">Submit</button>
        </div>
    </div>


<div class="products-table">
    <table>    <!-- Table to show products  -->
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
    $conn->close();
    ?>
    </tbody>
</div>

    <script>
    // Function to show overlay
    function showOverlay(title) {
        document.getElementById('overlay-title').innerHTML = title;
        document.getElementById('overlay-input').value = '';
        document.getElementById('overlay').style.display = 'flex';
    }

    // Function to hide overlay
    function hideOverlay() {
        document.getElementById('overlay').style.display = 'none';
    }

    // Function to submit overlay input
    function submitOverlayInput() {
        // Perform actions with the input value (you can customize this part)
        var inputValue = document.getElementById('overlay-input').value;
        alert('Submitted value: ' + inputValue);

        // Close the overlay
        hideOverlay();
    }
</script>


</body>
</html>
<?php 
require('footer.php');
?> 