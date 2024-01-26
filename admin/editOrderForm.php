<?php
// Include your database configuration file
include 'conn.php';

// Check if order_id is provided in the URL
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Fetch order details based on the order_id
    $sql = "SELECT * FROM orders WHERE order_id = $orderId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        // Display the order update form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Edit Order</title>
    <!-- CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #ccc;
            color: #333;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #999;
        }

        @media screen and (max-width: 600px) {
            .container {
                max-width: 100%;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Order</h2>
        <form action="updateOrder.php" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

        <label for="order_status">Order Status:</label>
        <select name="order_status" required>
            <option value="Pending" <?php echo ($order['order_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Shipping" <?php echo ($order['order_status'] == 'Shipping') ? 'selected' : ''; ?>>Shipping</option>
            <option value="Delivered" <?php echo ($order['order_status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
            <option value="Cancelled" <?php echo ($order['order_status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
        </select>

        <label for="track_number">Tracking Number:</label>
        <input type="text" name="track_number" value="<?php echo $order['track_number']; ?>">

        <button type="submit" name="updateOrderBtn">Update Order</button>
        </form>
        <button class="back-button" onclick="goBack()">Back</button>
    </div>
    </div>
    <script>
    function goBack() {
        // Redirect to viewAllOrders.php or any other page
        window.location.href = "orders.php";
    }
    </script>

</body>
</html>
<?php
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID not provided.";
}
?>
