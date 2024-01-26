<?php
// Include your database connection file (conn.php)
require('conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if type_id is set
    if (isset($_POST['typeId'])) {
        // Handle type update
        $typeId = $_POST['typeId'];
        $typeName = $_POST['typeName'];

        // SQL query to update type_name in the type table
        $updateTypeQuery = "UPDATE `type` SET `type_name` = '$typeName' WHERE `type_id` = $typeId";

        if ($conn->query($updateTypeQuery) === TRUE) {
            // Display the alert box
            echo '<script>alert("Type updated successfully! Redirecting to view all types.")</script>';
            // Set URL for redirect
            $URL = "viewProductsType.php";
            // Redirect action for page
            echo "<script>location.href='$URL'</script>";
            exit;
        } else {
            echo "Error updating type: " . $conn->error;
        }
    } elseif (isset($_POST['catId'])) {
        // Check if category_id is set
        // Handle category update
        $categoryId = $_POST['catId'];
        $categoryName = $_POST['catName'];

        // SQL query to update category_name in the category table
        $updateCategoryQuery = "UPDATE `category` SET `category_name` = '$categoryName' WHERE `category_id` = $categoryId";

        if ($conn->query($updateCategoryQuery) === TRUE) {
             // Display the alert box
             echo '<script>alert("Category updated successfully! Redirecting to view all categories.")</script>';
             // Set URL for redirect
             $URL = "viewProductsCategory.php";
             // Redirect action for page
             echo "<script>location.href='$URL'</script>";
            exit;
        } else {
            echo "Error updating category: " . $conn->error;
        }
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request method!";
}

// Close the database connection
$conn->close();
?>
