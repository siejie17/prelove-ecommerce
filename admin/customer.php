<?php 
require('header.php');
require('sidebar.php');
require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <link rel="stylesheet" href="customer.css">
</head>

<body>
    <div>
        <h2 class="table-header">Customers</h2>
    </div>

    <div class="table-container">
    <h2 class="table-header">List of registered customers</h2>
    <!-- Table to display customer data -->
    <table>
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
                //echo "<td><a href='#' onclick='viewProfilePic(\"data:image/png;base64," . base64_encode($row['customer_profilePic']) . "\")'>View</a></td>";
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



    <script>
        function viewProfilePic(imageSrc, customerId, username) {
    document.getElementById('profilePic').src = imageSrc;
    document.getElementById('nameContainer').innerHTML = "Viewing ID: " + customerId + ", " + username + " Profile Picture";
    document.getElementById('profilePicOverlay').style.display = 'flex';
}

        function closeOverlay() {
            document.getElementById('profilePicOverlay').style.display = 'none';
        }
    </script>

</body>
</html>
<?php 
require('footer.php');
?>