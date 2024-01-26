<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTestBtn'])) {
    // Check if category_id or type_id is provided
    if (isset($_POST['category_id'])) {
        // Get the category_id from the form submission
        $categoryId = $_POST['category_id'];

        // Delete the category from the category table
        $deleteCategorySql = "DELETE FROM category WHERE category_id = $categoryId";

        // Execute the query
        if ($conn->query($deleteCategorySql) === TRUE) {
            echo "<script>alert('Category deleted successfully.');</script>";
            // Redirect to the appropriate page after deletion
            header("Location: viewProductsCategory.php");
            exit();
        } else {
            echo "Error deleting category: " . $conn->error;
        }
    } elseif (isset($_POST['type_id'])) {
        // Get the type_id from the form submission
        $typeId = $_POST['type_id'];

        // Delete the type from the type table
        $deleteTypeSql = "DELETE FROM type WHERE type_id = $typeId";

        // Execute the query
        if ($conn->query($deleteTypeSql) === TRUE) {
            echo "<script>alert('Type deleted successfully.');</script>";
            // Redirect to the appropriate page after deletion
            header("Location: viewProductsType.php");
            exit();
        } else {
            echo "Error deleting type: " . $conn->error;
        }
    } else {
        echo "No category_id or type_id provided.";
    }
} else {
    echo "Invalid request.";
}
?>
