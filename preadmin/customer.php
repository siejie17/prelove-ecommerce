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
        .table-container{
    display: flex;
}

/* Additional styles for handling overflow in the customer table */
.content table {
    width: 100%;
    border-collapse: collapse;
    overflow: auto;
} 

.content table th, .content table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.content table th {
    background-color: #f2f2f2;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.overlay-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.profile-pic-container {
    height: 300px; /* Adjust the height as needed */
    overflow: auto;
    border: 2px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
}

.profile-pic-container img {
    width: 100%;
    height: auto;
}

.brown-line {
    border: 3px solid #8B4513; /* Brown color */
    margin: 3px ; /* Adjust the spacing as needed */
}


.back-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Customers</h1>

                    <!-- Customer Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Registered Customers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Postcode</th>
                                            <th>District</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Profile Picture</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                        // SQL query to retrieve customer data
                                        $sql = "SELECT * FROM customer";
                                        // Execute the query
                                        $result = $conn->query($sql);
                                        // Check if there are rows in the result
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['customer_id'] . "</td>";
                                                echo "<td>" . $row['customer_email'] . "</td>";
                                                echo "<td>" . $row['username'] . "</td>";
                                                echo "<td>" . $row['customer_firstName'] . "</td>";
                                                echo "<td>" . $row['customer_lastName'] . "</td>";
                                                echo "<td>" . $row['customer_phoneNum'] . "</td>";
                                                echo "<td>" . $row['customer_address'] . "</td>";
                                                echo "<td>" . $row['customer_postcode'] . "</td>";
                                                echo "<td>" . $row['customer_district'] . "</td>";
                                                echo "<td>" . $row['customer_state'] . "</td>";
                                                echo "<td>" . $row['customer_country'] . "</td>";
                                                echo "<td><a href='#' onclick='viewProfilePic(\"data:image/png;base64," . base64_encode($row['customer_profilePic']) . "\", " . $row['customer_id'] . ", \"" . $row['username'] . "\")'>View</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='13'>No customers found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <div class="overlay" id="profilePicOverlay" onclick="closeOverlay()">
                                <div class="overlay-content">
                                <div class="name-container" id="nameContainer"></div>
                                <hr class="brown-line" color="brown" width="100%">
                                <div class="profile-pic-container">
                                    <img id="profilePic" alt="Customer Profile Picture">
                                </div>
                                <button class="back-button" onclick="closeOverlay()">Back</button>
                                </div>
                                </div>
                </div>



            </div>
        </div>
        <?php require('footer.php'); ?>

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
    
    <script>
    function viewProfilePic(imageSrc, customerId, username) {
    document.getElementById('profilePic').src = imageSrc;
    document.getElementById('nameContainer').innerHTML = "Viewing ID: " + customerId + ", " + username + " Profile Picture";
    document.getElementById('profilePicOverlay').style.display = 'flex';
    }

    function closeOverlay() 
    {
        document.getElementById('profilePicOverlay').style.display = 'none';
    }
    </script>

    
</body>
</html>
