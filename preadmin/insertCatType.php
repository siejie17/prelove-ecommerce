<?php
// Include your database configuration file
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "pcat" key exists in the $_POST array
    if (isset($_POST['pcat'])) {
        // Sanitize user input to prevent SQL injection
        $pcat = mysqli_real_escape_string($conn, $_POST['pcat']);

        // Check if $pcat is not empty
        if (!empty($pcat)) {
            // Perform actions related to product category
            $insertCategorySQL = "INSERT INTO category (category_name) VALUES ('$pcat')";
            
            if ($conn->query($insertCategorySQL) === TRUE) {
                // Insertion successful, redirect
                echo '<script>
                    alert("Add New Product Category Notice\\n Category has been added!");
                </script>';

                header("Location: http://localhost/admin/products.php");
                exit;
            } else {
                echo "Error: " . $insertCategorySQL . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Product category is empty.";
        }
    }

    // Check if the "ptype" key exists in the $_POST array
    if (isset($_POST['ptype'])) {
        // Sanitize user input to prevent SQL injection
        $ptype = mysqli_real_escape_string($conn, $_POST['ptype']);

        // Check if $ptype is not empty
        if (!empty($ptype)) {
            // Perform actions related to product type
            $insertTypeSQL = "INSERT INTO type (type_name) VALUES ('$ptype')";
            
            if ($conn->query($insertTypeSQL) === TRUE) {
                // Insertion successful, redirect
                echo '<script>
                    alert("Add New Product Type Notice\\n Type has been added!");
                </script>';
                header("Location: http://localhost/admin/products.php");
                exit;
            } else {
                echo "Error: " . $insertTypeSQL . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Product type is empty.";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle cases where the form was not submitted via POST
    echo "Form not submitted.";
}
?>
