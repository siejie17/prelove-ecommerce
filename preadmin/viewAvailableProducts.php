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

    <!--Google icon CDN here.-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="viewAllProducts.css">
</head>
<body>
    <div>
        <h2 class="table-header">Products</h2>
    </div>

    <!-- card to show all available products -->
    <div class="card">
        <p onclick="window.location.href='viewAvailableProducts.php'">Display all <span class="available">available</span> products         <span class="material-symbols-outlined">event_available</span> </p>
    </div>

    <!-- card to show all unavailable products -->
    <div class="card">
        <p onclick="window.location.href='viewUnavailableProducts.php'"> Display all <span class="unavailable">unavailable</span> products <span class="material-symbols-outlined">event_busy</span>  </p>
    </div>

    <div class="container-fluid">
    <h2 class="table-header">View Available Products</h2>
    <!-- Table to display Products data -->
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Type</th>
            <th>Category</th>
            <th>Weight</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // SQL query to retrieve customer data
        $sql = "SELECT
        p.product_id,
        p.product_name,
        p.product_description,
        p.product_price,
        t.type_name,
        c.category_name,
        p.product_weight,
        p.product_status
        FROM
            product p
        JOIN
            type t ON p.type_id = t.type_id
        JOIN
            category c ON p.category_id = c.category_id
        WHERE p.product_status='available'
        ORDER BY p.product_id ASC;
        ";
        // Execute the query
        $result = $conn->query($sql);
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['product_description'] . "</td>";
                echo "<td>" . $row['product_price'] . "</td>";
                echo "<td>" . $row['type_name'] . "</td>";
                echo "<td>" . $row['category_name'] . "</td>";
                echo "<td>" . $row['product_weight'] . "</td>";
                echo "<td>" . $row['product_status'] . "</td>";
                echo "<td>";
                echo "<form method='post' action='deleteProduct.php'>";
                echo "<input type='hidden' name='productId' value='" . $row['product_id'] . "'>";
                echo "<button type='submit' name='deleteProductBtn'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No Products found</td></tr>";
        }
        ?>
        </tbody>
    </table>


</body>
</html>
<?php 
require('footer.php');
?>