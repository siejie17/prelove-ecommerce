<?php
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProductBtn'])) {
    // Get the product ID from the form submission
    $productId = $_POST['productId'];

    // SQL query to delete the product
    $deleteProductSQL = "DELETE FROM product WHERE product_id = $productId";

    // Execute the query
    if ($conn->query($deleteProductSQL) === TRUE) {
        echo "<script>alert('Product deleted successfully.');</script>";
        // Redirect to viewAllProducts.php
        header("Location: viewAllProducts.php");
        echo "<script>alert('Product deleted successfully.');</script>";
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
?>
