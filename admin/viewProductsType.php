<?php
require('conn.php');
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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <!-- google icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="#.css">

    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }

        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 20px;
            border: 1px solid #804000; /* Brown line color */
            background-color: #fff;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .title {
            text-align: center;
            margin-top: 30px;
        }

        .type-table {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actionBtn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .actionBtn:hover {
            background-color: #FFEBCD;
        }
        
        .submitBtn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .submitBtn:hover {
            background-color: green;
        }
        
        .backBtn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 3%;
        }

        .backBtn:hover {
            background-color: #FFEBCD;
        }

        /* Additional Styles */
        h2 {
            color: #007bff;
        }

        p {
            color: #333;
        }
    </style>

</head>
<body>
    <button onclick="redirectBack()" class="backBtn">Go Back to Products</button>
    <!-- Section title -->
    <div class="title">
        <h2>Products</h2>
    </div>

    <!-- Table  title -->
    <div class="table title">
        <h2>View All Product Types</h2>
    </div>

    <div class="type-table">
        <!-- Table to show products category  -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to retrieve data 
            $sql = "SELECT * FROM type";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['type_id'] . "</td>";
                    echo "<td>" . $row['type_name'] . "</td>";
                    echo "<td>";
                    echo "<button class='actionBtn' onclick='editType(" . $row['type_id'] . ", \"" . $row['type_name'] . "\")'>Edit</button>";
                    echo "<form method='post' action='deleteCatType.php'>";
                    echo "<input type='hidden' name='type_id' value='" . $row['type_id'] . "'> ";
                    echo "<button type='submit' name='deleteTestBtn' class='actionBtn' >Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No types found.";
            }
            ?>
            </tbody>
        </table>

    <!-- Overlay for product type edit -->
    <div id="editOverlay" class="overlay">
        <div class="overlay-content">
            <h2>Edit Type Notice</h2>
            <hr style="border-color: #804000; margin-bottom: 20px;"> <!-- Brown line -->
            
            <!-- PHP echoed existing type_name into text area here for admin to edit -->
            <form id="editForm" method="POST" action="updateTypeCat.php">
                <label for="editTypeId">Type ID:</label>
                <input type="text" id="typeId" name="typeId" readonly>

                <label for="editTypeName">Type Name:</label>
                <input type="text" id="typeName" name="typeName">

                <button type="button" onclick="closeOverlay()" class="actionBtn">Back</button>
                <button type="submit" class="submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Function to open the edit overlay and populate the fields
        function editType(typeId, typeName) {
            document.getElementById('typeId').value = typeId;
            document.getElementById('typeName').value = typeName;
            document.getElementById('editOverlay').style.display = 'block';
        }

        // Function to close the edit overlay
        function closeOverlay() {
            document.getElementById('editOverlay').style.display = 'none';
        }
        // JavaScript function to handle the redirection
        function redirectBack() {
            // Redirect to products.php
            window.location.href = 'products.php';
        }
    </script>
<?php 
require('footer.php');
?>
</body>
</html>