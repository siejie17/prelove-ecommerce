<?php
//updateCategory.php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check if the necessary fields are set
    if (isset($_POST['category_id']) && isset($_POST['category_name'])) {
        $catId = mysqli_real_escape_string($conn, $_POST['category_id']);
        $catName = mysqli_real_escape_string($conn, $_POST['category_name']);

        // Update the type name in the database (modify the query accordingly)
        $updateCatSQL = "UPDATE category SET category_name = '$catName' WHERE category_id = '$catId'";

        if ($conn->query($updateCatSQL) === TRUE) {
            echo '<script>alert("category updated successfully.")</script>';
            // Redirect to the page where you display all types
            header("Location: viewProductTypes.php");
            exit;
        } else {
            echo "Error updating type: " . $conn->error;
        }
    } else {
        echo "Error: Type ID or Type Name not provided.";
    }
}
?>

