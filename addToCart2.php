<?php
session_start();
include('conn.php');
// $_SESSION['customer_id']=2;
// header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

    if (isset($_POST['product_id'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $word=mysqli_real_escape_string($conn,$_POST['search_word']);
        $search_word= stripslashes(urldecode($word));
        $type=mysqli_real_escape_string($conn, $_POST['type']);
        $category= mysqli_real_escape_string($conn, $_POST['category']);
        // You may want to perform additional validation and security checks here.

        // Check if the product is already in the cart
        $checkSql = "SELECT * FROM cart WHERE customer_id = '$customer_id' AND product_id = '$product_id'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Product already in the cart, send a response indicating failure
            $_SESSION['message']= 'Product already in the cart';
            // Redirect back to the product page or any other desired page
            header("Location: product_listing.php?type=$type&category=$category&text=".urlencode($search_word));
            exit();

        } else {
            // Product not in the cart, insert into the cart table
            $insertSql = "INSERT INTO cart (customer_id, product_id) VALUES ('$customer_id', '$product_id')";
            mysqli_query($conn, $insertSql);

            // Send a response indicating success
            $_SESSION['message']= 'Product added to cart successfully';
            // Redirect back to the product page or any other desired page
            header("Location: product_listing.php?type=$type&category=$category&text=".urlencode($search_word));
            exit();
        }
        
    } else {
        $_SESSION['message']= 'Product ID not provided';
        // Redirect back to the product page or any other desired page
        header("Location: product_listing.php?type=$type&category=$category&text=".urlencode($search_word));
        exit();
    }
} else {
    $_SESSION['message']= 'User not logged in';
    // Redirect back to the product page or any other desired page
    header("Location: product_listing.php?type=$type&category=$category&text=".urlencode($search_word));
    exit();
}
?>
