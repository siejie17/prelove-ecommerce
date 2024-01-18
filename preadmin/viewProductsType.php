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

    <!-- google icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="#.css">

    <style>
        /* Add your CSS styles here */

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
    </style>

</head>
<body>
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

                    // Add two buttons for Edit and Delete
                    echo '<td>
                        <button onclick="editType(' . $row['type_id'] . ', \'' . $row['type_name'] . '\')"> Edit <span class="material-symbols-outlined">edit </span> </button>
                        <button onclick="deleteType(' . $row['type_id'] . ')"> Delete <span class="material-symbols-outlined"> delete </span> </button>
                    </td>';
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
            <form id="editForm">
                <label for="editTypeId">Type ID:</label>
                <input type="text" id="typeId" name="typeId" readonly>

                <label for="editTypeName">Type Name:</label>
                <input type="text" id="typeName" name="typeName">

                <button type="button" onclick="closeOverlay()">Back</button>
                <button type="button" onclick="submitEdit()">Submit</button>
            </form>
        </div>
    </div>

    <!-- Your existing HTML code -->

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

    // Function to handle the form submission (update the database)
function submitEdit() {
    var typeId = document.getElementById('typeId').value;
    var typeName = document.getElementById('typeName').value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: Specify the type of request (POST), the URL, and whether it should be asynchronous (true)
    xhr.open('POST', 'updateType.php', true);

    // Set the request header if you are sending data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Set the callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response, if needed
            // You can add additional logic here after the update is complete
            console.log(xhr.responseText);

            // Close the overlay after the update
            closeOverlay();
        }
    };

    // Prepare the data to be sent in the request body
    var data = 'type_id=' + encodeURIComponent(typeId) + '&type_name=' + encodeURIComponent(typeName);

    // Send the request with the data
    xhr.send(data);
}


</script>
<?php 
require('footer.php');
?>
</body>
</html>
