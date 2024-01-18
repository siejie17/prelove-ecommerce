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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="prelovebyjosie admin dashboard">
    <title>Prelovebyjosie Admin Dashboard</title>
    <link rel="stylesheet" href="#.css">
    
    <!-- google icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <!-- Section title -->
    <div class="title">
        <h2>Products</h2>
    </div>

    <!-- Table  title -->
    <div class="table title">
        <h2>View All Product Categories</h2>
    </div>

    <div class="category-table">
        <!-- Table to show products category  -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to retrieve data 
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                // Output data of each row
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['category_id'] . "</td>";
                    echo "<td>" . $row['category_name'] . "</td>";
                    // Add two buttons for Edit and Delete
                    echo '<td>
                    <button onclick="editCat(' . $row['category_id'] . ')"> Edit <span class="material-symbols-outlined">edit </span> </button>
                    <button onclick="deleteCat(' . $row['category_id'] . ')"> Delete <span class="material-symbols-outlined"> delete </span> </button>
                    </td>';
                    echo "</tr>";
                    echo "</tr>";
                }
            }else
            {
                echo "No categories found.";
            }
            ?>
            </tbody>
        </table>
    </div>
    <script>
    
    </script>

    <!-- Form for category deletion -->
    <form id="deleteForm" action="deleteProductsCategory.php" method="POST">
       <input type="hidden" name="category_id" value="">
    </form>

    <?php 
    require('footer.php');
    ?>
</body>
</html>