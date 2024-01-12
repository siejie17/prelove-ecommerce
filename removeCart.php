<?php
session_start();
include('conn.php');
// $_SESSION['customer_id']=2;
// header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

    if (isset($_GET['id'])) {
        $product_id = mysqli_real_escape_string($conn, $_GET['id']);
        // You may want to perform additional validation and security checks here.

        
            // Product not in the cart, insert into the cart table
            $insertSql = "DELETE FROM cart WHERE product_id='$product_id'";
            mysqli_query($conn, $insertSql);

            // Send a response indicating success
            $_SESSION['message']= 'Product removed from cart successfully';
            // Redirect back to the product page or any other desired page
            header("Location: cart.php");
            exit();
        
        
    } else {
        $_SESSION['message']= 'Product ID not provided';
        // Redirect back to the product page or any other desired page
        header("Location: cart.php");
        exit();
    }
} else {
    $_SESSION['message']= 'User not logged in';
    // Redirect back to the product page or any other desired page
    header("Location: cart.php");
    exit();
}
?>
  