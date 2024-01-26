<?php
    session_start();
    include('conn.php');

    if (isset($_SESSION['customer_id'])) {
        $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

        if (isset($_GET['id'])) {
            $product_id = mysqli_real_escape_string($conn, $_GET['id']);

            // Product not in the cart, insert into the cart table
            $insertSql = "DELETE FROM cart WHERE product_id='$product_id'";
            mysqli_query($conn, $insertSql);

            // Redirect back to the product page or any other desired page
            header("Location: cart.php");
            exit();
        } else {
            // Redirect back to the product page or any other desired page
            header("Location: cart.php");
            exit();
        }
    } else {
        // Redirect back to the product page or any other desired page
        header("Location: cart.php");
        exit();
    }
?>
  