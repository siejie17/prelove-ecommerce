<?php
// updateProduct.php

// Include the configuration file
require('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productId = $_POST['productId']; 
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productWeight = $_POST['productWeight'];
    $productType = $_POST['productType'];
    $productCategory = $_POST['productCategory'];

    // SQL query to update product data
    $sql = "UPDATE product
            SET
            product_name = '$productName',
            product_description = '$productDescription',
            product_price = '$productPrice',
            product_weight = '$productWeight',
            type_id = '$productType',
            category_id = '$productCategory'
            WHERE product_id = '$productId'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to viewAllProducts.php after successful update

        // Display the alert box
        echo '<script>alert("Product updated successfully.")</script>';
        // Set URL for redirect
        $URL = "viewAllProducts.php";
        // Redirect action for page
        echo "<script>location.href='$URL'</script>";
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
