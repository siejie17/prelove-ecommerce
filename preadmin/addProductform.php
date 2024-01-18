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

    <style>
    body {
        font-family: 'Arial', sans-serif;
    }

    div {
        margin-bottom: 20px;
    }

    label {
        display: inline-block;
        width: 150px; /* Adjust the width as needed */
        text-align: right;
        margin-right: 10px; /* Adjust the right margin as needed */
    }

    input, select {
        width: 200px; /* Adjust the width as needed */
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px; /* Adjust the bottom margin as needed */
    }

    button {
        padding: 10px;
        background-color: #d2a984; /* Adjust the background color as needed */
        color: #fff; /* Adjust the text color as needed */
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #ae875f; /* Adjust the hover background color as needed */
    }

     /* Style for the file input container */
     .file-input-container {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 200px; /* Adjust the width as needed */
    }

    /* Style for the file input */
    .file-input {
        font-size: 20px; /* Adjust the font size as needed */
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        width: 100%;
        height: 100%;
    }

    /* Style for the square frame */
    .file-input-placeholder {
        width: 100%;
        height: 100px; /* Adjust the height as needed */
        border: 2px dashed #ccc; /* Adjust the border style and color as needed */
        box-sizing: border-box;
        padding: 20px;
        text-align: center;
    }
    
</style>

    <link rel="stylesheet" href="index.css">

<body>
    <div>
        <p>Products</p>
    </div>
    <div>
        <p>Add New Product</p>
        <!-- "multipart/form-data" value is necessary if the user will upload a file through the form -->
        <form name="createProduct" action="insertProduct.php" method="POST" enctype="multipart/form-data" >
        <label for="pname"> Product Name </label>
        <input type="text" name="pname" required><br>

        <label for="pdescription"> Product Description </label>
        <input type="text" name="pdescription" required><br>

        <label for="pprice"> Product Price(RM) </label>
        <input type="number" name="pprice" min="0.00" step="0.01" required><br>

        <label for="ptype"> Product Type </label>
        <select id="ptype" name="ptype">
        
        <?php
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

        ?>
        </select><br>

        <label for="pweight"> Product Weight (kg) </label>
        <input type="number" name="pweight" min="0.00" step="0.01" required><br>


        <label for="pstatus"> Product Status </label>
        <select id="pstatus" name="pstatus">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select><br>

        <div class="file-input-container">
        <label for="pimages"> Select Product Images (Max. 4 pics) </label><br>
        <input type="file" id="pimages" name="pimages[]" accept=".png, .jpeg, .jpg, .svg" multiple required><br>
        </div>

        <!-- Button to submit form -->
        <br>
        <button type="button" onclick="window.location.href='products.php'">Back</button>
        <button type="submit">Submit</button>
    </form>

    </div>
</body>
</html>