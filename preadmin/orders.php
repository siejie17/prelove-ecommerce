<?php
session_start(); //set session 
require('config.php');
require('header.php');
// require('sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <meta name="keywords" content="clothing, buy"> <!-- Separate keywords with commas -->
    <meta name="keywords" content="Prelovebyjosie, prelovebyjosie, clothing, ecommerce clothing">
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="css/index.css">

    <!-- Favicon for the browser tab -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Apple Touch Icon (iOS devices) -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Icon for Microsoft browsers -->
    <meta name="msapplication-TileImage" content="mstile-144x144.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- Standard favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Additional icon sizes for various devices -->
    <link rel="icon" sizes="192x192" href="icon-192x192.png">
    <link rel="icon" sizes="128x128" href="icon-128x128.png"> 

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="import" href="D:\02. UNIMAS\Y3 SEM 1\TMA3083TME3413 Sem 1 2324 (G01) Software Engineering Lab (Ts Nurfauza Jali)\WORK\adminNavbar.html">

    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .overlay-content {
            background-color: #efe8e8;
            padding: 20px;
            border-radius: 10px;
            max-width: 100%;
            text-align: center;
        }

        #orderSummaryBtn {
            cursor: pointer;
            /* background-color: #50953f; */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        /* order summary pending card */
        #pending
        {
            color: rgb(240, 127, 6);
            font-weight: bold;
        }
        #icon1
        {
            color: rgb(240, 127, 6);
        }

        /* order summary shipped card */
        #shipped
        {
            color: rgb(22, 6, 240);
            font-weight: bold;
        }
        #icon2
        {
            color: rgb(22, 6, 240);
        }

        /* order summary delivered card */
        #delivered
        {
            color: rgb(4, 249, 4);
            font-weight: bold;
        }
        #icon3
        {
            color: rgb(4, 249, 4);
        }
        /* order summary cancelled card */
        #cancelled
        {
            color: rgb(240, 6, 6);
            font-weight: bold;
        }
        #icon4
        {
            color: rgb(240, 6, 6);
        }

        /* orders table tab switch between different status */
        /* Style the tab */
        .tab {
            overflow: auto;
            border: 5px solid #ccc;
            background-color: #f1f1f1;
        }
        
        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        
        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }
        
        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }
        
        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Orders</h1>

            <div class="row">
                <!-- Start Add new Product -->
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button class="btn btn-primary mt-2 mb-3" id="orderSummaryBtn">Order Summary</button> <!-- button to trigger order summary  -->

                <div id="overlay" class="overlay">
                    <div class="overlay-content">
                        <h5>Order Summary</h5>

                        <!-- Total no of orders card -->
                        <div class="card">
                            <p>Total Number of orders
                            <span class="material-symbols-outlined">list_alt</span>
                            </p>
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

                        <!-- Total Number of Pending Orders card -->
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

                        <!-- Total no of shipped orders -->
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

                        <!-- Total no. of delivered orders -->
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

                        <!-- Total no. of cancelled orders -->
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

                        <!-- Total Revenue -->
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


            </div>

            <!-- switching tabs begins here -->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'all-tab')">All Orders</button>
                <button class="tablinks" onclick="openTab(event, 'pending-tab')">Pending</button>
                <button class="tablinks" onclick="openTab(event, 'shipping-tab')">Shipping</button>
                <button class="tablinks" onclick="openTab(event, 'delivered-tab')">Delivered</button>
                <button class="tablinks" onclick="openTab(event, 'cancelled-tab')">Cancelled</button>
            </div>
            
            <!-- All Order table -->
            <div id="all-tab" class="tabcontent">
                <!-- Table showing all orders  -->
                <div class="orders-table">
                    <table class="table table-bordered">
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

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['order_id'] . "</td>";
                                    echo "<td>" . $row['product_name'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['order_date'] . "</td>";
                                    echo "<td>" . $row['total_amount'] . "</td>";
                                    echo "<td>" . ($row['track_number'] !== 'NULL' ? $row['track_number'] : 'NULL') . "</td>";
                                    echo "<td>" . $row['order_status'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='editOrderForm.php?order_id=" . $row['order_id'] . "'>Edit</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td>" . "No Orders found." . "</td>";
                                echo "<tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Pending Order table -->
            <div id="pending-tab" class="tabcontent">
                <!-- Table showing all orders  -->
                <div class="orders-table">
                    <table class="table table-bordered">
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
                                echo "<td>";
                                echo "<a href='editOrderForm.php?order_id=" . $row['order_id'] . "'>Edit</a>";
                                echo "</td>";
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
                <!-- Table showing pending order ends -->
            </div>

            <!-- Shipping Order table -->
            <div id="shipping-tab" class="tabcontent">
                <!-- Table showing all orders  -->
                <div class="orders-table">
                    <table class="table table-bordered">
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
                                    echo "<td>";
                                    echo "<a href='editOrderForm.php?order_id=" . $row['order_id'] . "'>Edit</a>";
                                    echo "</td>";
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
                <!-- Table showing Shipping order ends -->
            </div>

            <!-- Delivered Order table -->
            <div id="delivered-tab" class="tabcontent">
                <!-- Table showing all orders  -->
                <div class="orders-table">
                    <table class="table table-bordered">
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
                                    echo "<td>";
                                    echo "<a href='editOrderForm.php?order_id=" . $row['order_id'] . "'>Edit</a>";
                                    echo "</td>";
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
                <!-- Table showing Delivered order ends -->
            </div>

            <!-- Cancelled Order table -->
            <div id="cancelled-tab" class="tabcontent">
                <!-- Table showing all orders  -->
                <div class="orders-table">
                    <table class="table table-bordered">
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
                                    echo "<td>";
                                    echo "<a href='editOrderForm.php?order_id=" . $row['order_id'] . "'>Edit</a>";
                                    echo "</td>";
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
                <!-- Table showing Delivered order ends -->
            </div>
            

        </div>

    </div>
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>    

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
        //overlay.removeEventListener('click', closeOverlay);
    }

    // Set 'all-req' as the default active tab and show it initially
    document.getElementById('all-tab').style.display = "block";
    document.getElementsByClassName("tablinks")[0].className += " active";

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
<?php //require('footer.php'); ?>

