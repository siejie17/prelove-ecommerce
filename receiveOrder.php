<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('conn.php');
// $_SESSION['customer_id']=2;
// header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

    if (isset($_GET['orderid'])) {
        $order_id=urldecode($_GET['orderid']);

        // foreach ($decodedData as $item){$ic=$item['id']; echo'$ic';}
        if ($order_id !== null) {
            $updateStatus="UPDATE orders SET order_status='delivered' WHERE order_id='$order_id'";
            mysqli_query($conn,$updateStatus);
            
            $_SESSION['message']= 'Order status change to delivered successfully';
            header("Location: my-order.php");
            exit();
        }

        else{
            $_SESSION['message']='ERROR DECODING JSON DATA';
            header("Location:my-order.php");
            exit();
        }
        
        
    } else {
        echo'Error';
        $_SESSION['message']= 'Data not provided';
        // Redirect back to the product page or any other desired page
        header("Location: my-order.php");
        exit();
    }
} else {
    $_SESSION['message']= 'User not logged in';
    // Redirect back to the product page or any other desired page
    header("Location: my-order.php");
    exit();
}
?>
