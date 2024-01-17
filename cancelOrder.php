<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('conn.php');
// $_SESSION['customer_id']=2;
// header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

    if (isset($_GET['data'])) {
        $jsonData = urldecode($_GET['data']);
        $decodedData = explode(',',$jsonData);
        $order_id=urldecode($_GET['orderid']);
       
        if (is_array($decodedData)) {
            if ($decodedData !== null) {
                // echo '<script>console.log($decodedata)
                // // console.log($order_id)</script>';
                // $remove="DELETE FROM order_details WHERE order_id=$order_id";
                // $remove1="DELETE FROM orders WHERE order_id=$order_id";
                $cancel="UPDATE orders SET order_status='cancelled' WHERE order_id=$order_id";
                mysqli_query($conn,$cancel);
                // mysqli_query($conn,$remove);
                // mysqli_query($conn,$remove1);
                // Access the data as an associative array
                foreach ($decodedData as $product_id){
                    $realId=(int)$product_id;
                    echo $realId;
                    $available="UPDATE product SET product_status='available' WHERE product_id='$realId'";
                    
                    mysqli_query($conn,$available);
                }
                $_SESSION['message']= 'Cancelled successfully';
                header("Location: my-order.php");
                exit();
            }
        }

        else{
            $_SESSION['message']='ERROR DECODING JSON DATA';
            header("Location: my-order.php");
            exit();
        }
        
        
    } else {

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
