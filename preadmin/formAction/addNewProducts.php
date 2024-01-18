<?php
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
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="">

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

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="import" href="D:\02. UNIMAS\Y3 SEM 1\TMA3083TME3413 Sem 1 2324 (G01) Software Engineering Lab (Ts Nurfauza Jali)\WORK\adminNavbar.html">
</head>
<body>
    <div>
        <p>Products</p>
    </div>
    <div>
        <p>Add New Product</p>
    <form action="insertProduct.php">
        <label for="pname"> Product Name </label>
        <input type="text" name="pname" required><br>

        <label for="pdescription"> Product Description </label>
        <input type="text" name="pdescription" required><br>

        <label for="pprice"> Product Price(RM) </label>
        <input type="number" name="pdescription" min="0" required><br>

        <label for="ptype"> Product Type </label>
        <select id="ptype" name="ptype">
        <?php
        // Include your database configuration file
        include('config.php');

        // SQL query to retrieve product types
        $sql = "SELECT * FROM type";
        $result = $conn->query($sql);

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No product types found</option>";
        }

        ?>
        </select><br>

        <label for="pcat"> Product Category </label>
        <select id="pcat" name="pcat">
        <?php
        // Include your database configuration file
        include('config.php');

        // SQL query to retrieve product category
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No product types found</option>";
        }

        // Close the database connection
        $conn->close();
        ?>
        </select><br>

        <label for="pweight"> Product Weight (kg) </label>
        <input type="number" name="pweight" min="0" required><br>

        <label for="pstatus"> Product Status </label>
        <select id="pstatus" name="pstatus">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select><br>

        <label for="pimages"> Select Product Images (Max. 4 pics) </label><br>
        <input type="file" id="pimages" name="pimages" accept=".png, .jpeg, .jpg, .svg"><br>

        <!-- Buttons -->
        <br>
        <button type="button" onclick="window.location.href='products.php'">Back</button>
        <button type="submit">Submit</button>
    </form>
    </div>
</body>
</html>