<?php
require('conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the "category_id" key exists in the $_POST array
        if (isset($_POST['type_id'])) {
            // Sanitize user input to prevent SQL injection
            $type = mysqli_real_escape_string($conn, $_POST['type_id']);

            // Perform actions related to category deletion
            $deleteType = "DELETE FROM type WHERE type_id = '$type'";

            if ($conn->query($deleteType) === TRUE) {
                // Deletion successful, you can redirect or do other actions
                echo '<script>alert("Category deleted successfully.")</script>';
                header("Location: viewProductsType.php");
                exit;
            } else {
                echo "Error: " . $deleteType . "<br>" . $conn->error;
            }
        } else {
            // Handle the case where category_id is not set
            echo "Error: Category ID not provided.";
        }
    }
?>
