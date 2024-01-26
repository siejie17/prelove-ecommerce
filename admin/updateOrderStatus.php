<?php
include 'conn.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the AJAX request
    $orderId = $_POST['orderId'];
    $track = $_POST['trackNumber'];
    $newStatus = $_POST['newStatus'];

    // Debugging output
    error_log("Received data: orderId=$orderId, track=$track, newStatus=$newStatus");

    // Update the order status in the database
    $updateSql = "UPDATE orders SET order_status = '$newStatus', track_number = '$track' WHERE order_id = $orderId";

    if ($conn->query($updateSql) === TRUE) {
        echo "Order status updated successfully";
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
