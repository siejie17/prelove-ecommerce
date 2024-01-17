<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('conn.php');
// $_SESSION['customer_id']=2;
// header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_SESSION['customer_id']);

    if (isset($_POST['data'])) {
        // $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        // $search_word=mysqli_real_escape_string($conn,$_POST['search_word']);
        $rate=$_POST['rate'];
        $total_price_rate=$_POST['total_price_rate'];

        $formattedDate  = date('Y-m-d H:i:s',strtotime(strtr($_POST['date'], '/', '-')));
        // $formattedDates=strotime($formattedDate);
    
// Format the timestamp as "YYYY-MM-DD HH:MM:SS"
// $formattedDate =$date->format('Y-m-d H:i:s');
        // echo'<script>';
        // echo'console.log("' . $formattedDate . '")';
        // echo'</script>';

        $decodedData=json_decode($_POST['data'],true);
        // foreach ($decodedData as $item){$ic=$item['id']; echo'$ic';}
        if ($decodedData !== null) {
            $addOrder="INSERT INTO orders (customer_id,order_date,order_status,shipping_fee) VALUES ($customer_id,'$formattedDate','pending',$rate)";
            mysqli_query($conn,$addOrder);
            // Access the data as an associative array
            foreach ($decodedData as $item){
                $id = $item['id'];
               
                $removeProduct="DELETE FROM cart WHERE product_id='$id'";
                $productStatus="UPDATE product SET product_status='unavailable' WHERE product_id='$id'";
                $order_id="SELECT * FROM orders ORDER BY order_id DESC LIMIT 1";
                
               
                mysqli_query($conn,$removeProduct);
                mysqli_query($conn,$productStatus);
                $result=mysqli_query($conn,$order_id);
                if ($result) {
                    // Fetch the associative array of the result
                    $row = mysqli_fetch_assoc($result);
                    // Access the 'order_id' value
                    $orderId = $row['order_id'];
                    $orderDetails="INSERT INTO order_details (order_id,product_id) VALUES ($orderId,$id)";
                    mysqli_query($conn,$orderDetails);

                    
                } else {
                    // Handle the case where the query fails
                    echo "Query failed: " . mysqli_error($conn);
                }
                
            }
            $_SESSION['message']= 'Order created successfully';
            $url="cart.php?customerId=".urlencode($customer_id)."&orderId=".urlencode($orderId)."&total=".urlencode($total_price_rate);
            header("Location:$url");
            // echo '<script>';
            // echo 'setTimeout(function() { window.location.href = "' . $url . '"; }, 5000);'; // 3000 milliseconds (3 seconds) delay
            // echo '</script>';
            // header("Location:cart.php");
            
            exit();
        }

        else{
            $_SESSION['message']='ERROR DECODING JSON DATA';
            header("Location:cart.php");
            exit();
        }
        
        
    } else {
        echo'Error';
        $_SESSION['message']= 'Data not provided';
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
