<?php
// updateType.php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check if the necessary fields are set
    if (isset($_POST['type_id']) && isset($_POST['type_name'])) {
        $typeId = mysqli_real_escape_string($conn, $_POST['type_id']);
        $typeName = mysqli_real_escape_string($conn, $_POST['type_name']);

        // Update the type name in the database (modify the query accordingly)
        $updateTypeSQL = "UPDATE type SET type_name = '$typeName' WHERE type_id = '$typeId'";

        if ($conn->query($updateTypeSQL) === TRUE) {
            echo "Type updated successfully";
            // Redirect to the page where you display all types
            header("Location: viewProductTypes.php");
            exit;
        } else {
            echo "Error updating type: " . $conn->error;
        }
    } else {
        echo "Error: Type ID or Type Name not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
