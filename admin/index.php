<?php
session_start(); //set session 
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
    
    <link rel="stylesheet" href="index.css">
</head>
<body>

  <p>Dashboard</p>

  <!-- card showing total number of users -->
  <div class="card">
    <p>Total Number of Registered Users</p>
    <span class="material-symbols-outlined">group</span>
    <div class="container">
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
    echo "Total Number of Registered Users: " . $totalUsers;
    } else {
    // If the query was not successful, output the error
    echo "Error: " . $conn->error;
    }

    ?>
    </div>
  </div>
  
  <!-- card showing total number of products -->
  <div class="card">
    <p>Total Number of Products</p>
    <span class="material-symbols-outlined">apparel</span>
    <div class="container">
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
    echo "Total Number of Products: " . $totalProducts;
    } else {
    // If the query was not successful, output the error
    echo "Error: " . $conn->error;
    }
    ?>
    </div>
  </div>

  <!-- card showing total numbers of completed orders -->
  <div class="card">
    <p>Total Number of Completed Orders</p>
    <span class="material-symbols-outlined">list_alt</span>
    <div class="container">
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
    echo "Total Number of Completed Orders: " . $totalOrders;
    } else {
    // If the query was not successful, output the error
    echo "Error: " . $conn->error;
    }

    ?>
    </div>
  </div>

  <!-- card showing total revenue -->
<div class="card">
  <p>Total Revenue</p>
  <span class="material-symbols-outlined">attach_money</span>
  <div class="container">
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
      echo "Total Revenue (RM): " . $totalRevenue;
    } else {
      // If the query was not successful, output the error
      echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>
</div>


</body>
</html>

<?php 
require('footer.php');
?>