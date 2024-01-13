<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Check if the 'month' and 'year' keys are set in the $_POST array
    if (isset($_POST['month']) && isset($_POST['year'])) {
        $selectedMonth = $_POST['month'];
        $selectedYear = $_POST['year'];

        $sql = "SELECT
            o.order_id AS 'Order ID',
            p.product_name AS 'Product Name',
            p.product_description AS 'Product Description',
            o.order_date AS 'Date Sold',
            p.product_price AS 'Price (RM)',
            p.product_weight AS 'Product Weight'
            FROM
            orders o
            JOIN
            customer c ON o.customer_id = c.customer_id
            JOIN
            order_details od ON o.order_id = od.order_id
            JOIN
            product p ON od.product_id = p.product_id
            WHERE o.order_status = 'delivered'
            GROUP BY
            o.order_id
            ORDER BY
            o.order_id ASC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            echo "<table border='1'>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Date Sold</th>
                    <th>Price (RM)</th>
                    <th>Product Weight</th>
                </tr>";

            while ($row = $result->fetch_assoc()) 
            {
                echo "<tr>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['product_description'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "<td>" . $row['product_price'] . "</td>";
                echo "<td>" . $row['product_weight'] . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "Month and year values are not set in the POST request.";
    }
}
?>
