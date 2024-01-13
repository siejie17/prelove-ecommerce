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

    <link rel="stylesheet" href="#.css">
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

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['type_id'] . "</td>";
                    echo "<td>" . $row['type_name'] . "</td>";
                    echo "</tr>";
                }
            }else
            {
                echo "No types found.";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php 
require('footer.php');
?>