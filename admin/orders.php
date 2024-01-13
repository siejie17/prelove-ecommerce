<?php
require('config.php');
require('header.php');
require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <!-- google static icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="orders.css">
</head>
<body>
    <!-- Section title -->
    <div class="title">
        <h2>Orders</h2>
    </div>

    <!-- order summary section -->
    <button id="orderSummaryBtn">Order Summary</button> <!-- button to trigger order summary  -->
    <div id="overlay" class="overlay">
    <div class="overlay-content">
    <!-- Your order summary content goes here -->
    <h5>Order Summary</h5>
    <div class="card">
        <p>Total Number of Orders <span class="material-symbols-outlined">list_alt</span> </p>
        <p>
        <?php 
        $sql1="SELECT COUNT(*) AS total_orders FROM orders";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result1->fetch_assoc()) 
                {
                    echo $row['total_orders'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
    <div class="card">
        <p>Total Number of <span id="pending">Pending</span> Orders <span class="material-symbols-outlined" id="icon1">list_alt</span> </p>
        <p>
        <?php 
        $sql2="SELECT COUNT(*) AS total_orders FROM orders WHERE order_status='pending'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result2->fetch_assoc()) 
                {
                    echo $row['total_orders'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
    <div class="card">
        <p>Total Number of <span id="shipped">Shipped</span> Orders <span class="material-symbols-outlined" id="icon2">list_alt</span> </p>
        <p>
        <?php 
        $sql3="SELECT COUNT(*) AS total_orders FROM orders WHERE order_status='shipping'";
        $result3 = $conn->query($sql3);
        if ($result1->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result3->fetch_assoc()) 
                {
                    echo $row['total_orders'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
    <div class="card">
        <p>Total Number of <span id="delivered">Delivered</span> Orders <span class="material-symbols-outlined" id="icon3">list_alt</span> </p>
        <p>
        <?php 
        $sql4="SELECT COUNT(*) AS total_orders FROM orders WHERE order_status='delivered'";
        $result4 = $conn->query($sql4);
        if ($result4->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result4->fetch_assoc()) 
                {
                    echo $row['total_orders'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
    <div class="card">
        <p>Total Number of <span id="cancelled">Cancelled</span> Orders <span class="material-symbols-outlined" id="icon4">list_alt</span> </p>
        <p>
        <?php 
        $sql5="SELECT COUNT(*) AS total_orders FROM orders WHERE order_status='cancelled'";
        $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result5->fetch_assoc()) 
                {
                    echo $row['total_orders'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
    <div class="card">
        <p>Total Revenue (RM) <span class="material-symbols-outlined">attach_money</span></p>
        <p>
        <?php 
        $sql6="SELECT
        SUM(p.product_price) AS total_revenue
        FROM
            orders o
        JOIN
            order_details od ON o.order_id = od.order_id
        JOIN
            product p ON od.product_id = p.product_id
        WHERE
            o.order_status = 'delivered';
        ";
        $result6 = $conn->query($sql6);
        if ($result6->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result6->fetch_assoc()) 
                {
                    echo $row['total_revenue'];

                }
            }else
            {
                echo "No orders found.";
            }
        ?>
        </p>
    </div>
        <button onclick="closeOverlay()">Close</button>
        </div>
    </div>
    <!-- overlay ends -->

    <!-- switching tabs begins here -->
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'all-tab')">All Orders</button>
        <button class="tablinks" onclick="openTab(event, 'pending-tab')">Pending</button>
        <button class="tablinks" onclick="openTab(event, 'shipping-tab')">Shipping</button>
        <button class="tablinks" onclick="openTab(event, 'delivered-tab')">Delivered</button>
        <button class="tablinks" onclick="openTab(event, 'cancelled-tab')">Cancelled</button>
    </div>

    <div id="pending-tab" class="tabcontent">
    <!-- Table showing all orders  -->
    <div class="orders-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Amount (RM)</th>
                    <th>Tracking Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to fetch order details with related information
            $sql = "SELECT
                o.order_id,
                p.product_name,
                c.username,
                o.order_date,
                p.product_price AS total_amount,
                COALESCE(o.track_number, 'NULL') AS track_number,
                o.order_status
                FROM
                orders o
                JOIN
                customer c ON o.customer_id = c.customer_id
                JOIN
                order_details od ON o.order_id = od.order_id
                JOIN
                product p ON od.product_id = p.product_id
                WHERE o.order_status = 'pending'
                GROUP BY
                o.order_id
                ORDER BY
                o.order_id ASC;";

                    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['total_amount']. "</td>";
                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo "<td>".'<span class="material-symbols-outlined"> build </span>'."<td>";
                    echo "</tr>";
                }
            }else
            {
                echo "<tr>";
                echo "<td>"."No Orders found."."</td>";
                echo "<tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Table showing all orders ends -->
    </div>

    <div id="shipping-tab" class="tabcontent">
    <!-- Table showing all orders  -->
    <div class="orders-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Amount (RM)</th>
                    <th>Tracking Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to fetch order details with related information
            $sql = "SELECT
                o.order_id,
                p.product_name,
                c.username,
                o.order_date,
                p.product_price AS total_amount,
                COALESCE(o.track_number, 'NULL') AS track_number,
                o.order_status
                FROM
                orders o
                JOIN
                customer c ON o.customer_id = c.customer_id
                JOIN
                order_details od ON o.order_id = od.order_id
                JOIN
                product p ON od.product_id = p.product_id
                WHERE o.order_status = 'shipping'
                GROUP BY
                o.order_id
                ORDER BY
                o.order_id ASC;";

                    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['total_amount']. "</td>";
                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo "<td>".'<span class="material-symbols-outlined"> build </span>'."<td>";
                    echo "</tr>";
                }
            }else
            {
                echo "<tr>";
                echo "<td>"."No Orders found."."</td>";
                echo "<tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Table showing all orders ends -->
    </div>

    <div id="delivered-tab" class="tabcontent">
    <!-- Table showing all orders  -->
    <div class="orders-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Amount (RM)</th>
                    <th>Tracking Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to fetch order details with related information
            $sql = "SELECT
                o.order_id,
                p.product_name,
                c.username,
                o.order_date,
                p.product_price AS total_amount,
                COALESCE(o.track_number, 'NULL') AS track_number,
                o.order_status
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
                o.order_id ASC;";

                    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['total_amount']. "</td>";
                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo '<td><button class="icon-button" onclick="yourClickFunction()"><span class="material-symbols-outlined"> Edit </span></button></td>';
                    echo "</tr>";
                }
            }else
            {
                echo "<tr>";
                echo "<td>"."No Orders found."."</td>";
                echo "<tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Table showing all orders ends -->
    </div>

    <div id="cancelled-tab" class="tabcontent">
    <div class="orders-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Amount (RM)</th>
                    <th>Tracking Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to fetch order details with related information
            $sql = "SELECT
                o.order_id,
                p.product_name,
                c.username,
                o.order_date,
                p.product_price AS total_amount,
                COALESCE(o.track_number, 'NULL') AS track_number,
                o.order_status
                FROM
                orders o
                JOIN
                customer c ON o.customer_id = c.customer_id
                JOIN
                order_details od ON o.order_id = od.order_id
                JOIN
                product p ON od.product_id = p.product_id
                WHERE o.order_status = 'cancelled'
                GROUP BY
                o.order_id
                ORDER BY
                o.order_id ASC;";

                    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['total_amount']. "</td>";
                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo "<td>".'<span class="material-symbols-outlined"> build </span>'."<td>";
                    echo "</tr>";
                }
            }else
            {
                echo "<tr>";
                echo "<td>"."No Orders found."."</td>";
                echo "<tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Table showing all orders ends -->
    </div>

    <div class="tabcontent" id="all-tab">
        <!-- Table showing all orders  -->
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Username</th>
                    <th>Order Date</th>
                    <th>Amount (RM)</th>
                    <th>Tracking Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to fetch order details with related information
            $sql = "SELECT
                o.order_id,
                p.product_name,
                c.username,
                o.order_date,
                p.product_price AS total_amount,
                COALESCE(o.track_number, 'NULL') AS track_number,
                o.order_status
                FROM
                orders o
                JOIN
                customer c ON o.customer_id = c.customer_id
                JOIN
                order_details od ON o.order_id = od.order_id
                JOIN
                product p ON od.product_id = p.product_id
                GROUP BY
                o.order_id
                ORDER BY
                o.order_id ASC;";

                    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['total_amount']. "</td>";
                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo "<td>".'<span class="material-symbols-outlined"> build </span>'."<td>";
                    echo "</tr>";
                }
            }else
            {
                echo "";
            }
            ?>
            </tbody>
        </table>
    </div>


<!-- javascripts functions -->
<script>
const overlay = document.getElementById('overlay');
const orderSummaryBtn = document.getElementById('orderSummaryBtn');

orderSummaryBtn.addEventListener('click', openOverlay);

function openOverlay() {
    overlay.style.display = 'flex';

    // Add event listener to the overlay to close it when clicked
    overlay.addEventListener('click', closeOverlay);
}

function closeOverlay() {
    overlay.style.display = 'none';

    // Remove the event listener after closing the overlay
    overlay.removeEventListener('click', closeOverlay);
}

// switch tab function
function openTab(evt, tabName) 
{
    var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active"; // Add this line to add "active" class to the clicked button
}

function showAllOrders() {
    // Assuming 'allOrders' is the ID of the container element
    var allOrdersContainer = document.getElementById('allOrders');

    // Scroll to the 'All Orders' section
    if (allOrdersContainer) {
        allOrdersContainer.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>


</body>

</html>
<?php 
require('footer.php');
?>