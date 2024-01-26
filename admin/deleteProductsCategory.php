<?php
require('conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the "category_id" key exists in the $_POST array
        if (isset($_POST['category_id'])) {
            // Sanitize user input to prevent SQL injection
            $categoryId = mysqli_real_escape_string($conn, $_POST['category_id']);

            // Perform actions related to category deletion
            $deleteCategorySQL = "DELETE FROM category WHERE category_id = '$categoryId'";

            if ($conn->query($deleteCategorySQL) === TRUE) {
                // Deletion successful, you can redirect or do other actions
                echo '<script>alert("Category deleted successfully.")</script>';
                header("Location: viewProductsCategory.php");
                exit;
            } else {
                echo "Error: " . $deleteCategorySQL . "<br>" . $conn->error;
            }
        } else {
            // Handle the case where category_id is not set
            echo "Error: Category ID not provided.";
        }
    }
?>
