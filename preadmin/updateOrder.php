<?php
// Include your database configuration file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateOrderBtn'])) {
    // Get data from the form submission
    $orderId = $_POST['order_id'];
    $orderStatus = $_POST['order_status'];
    $trackingNumber = $_POST['track_number'];

    // SQL query to update the order details
    $updateOrderSQL = "UPDATE orders SET order_status = '$orderStatus', track_number = '$trackingNumber' WHERE order_id = $orderId";

    // Execute the query
    if ($conn->query($updateOrderSQL) === TRUE) {
        echo "<script>alert('Order updated successfully.');</script>";
        
        // Redirect to viewAllOrders.php or any other page
        header("Location: orders.php");
        exit();
    } else {
        echo "Error updating order: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
