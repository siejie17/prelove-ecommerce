<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateRequestBtn'])) {
    // Check if request_id and request_approval are provided
    if (isset($_POST['request_id'], $_POST['request_approval'])) {
        // Get the values from the form
        $requestId = $_POST['request_id'];
        $newApprovalStatus = $_POST['request_approval'];

        // Update the request_approval in the database
        $updateSql = "UPDATE request SET request_approval = '$newApprovalStatus' WHERE request_id = $requestId";

        if ($conn->query($updateSql) === TRUE) {
            echo "<script>alert('Request updated successfully.');</script>";
            // Redirect to the appropriate page after update
            header("Location: request.php");
            exit();
        } else {
            echo "Error updating request: " . $conn->error;
        }
    } else {
        echo "Request ID or Approval Status not provided.";
    }
} else {
    echo "Invalid request.";
}
?>
