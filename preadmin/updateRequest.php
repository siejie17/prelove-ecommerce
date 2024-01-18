<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateRequestBtn'])) {
    // Get values from the form submission
    $requestId = $_POST['request_id'];
    $requestApproval = $_POST['request_approval'];

    // Update the request_approval in the database
    $updateRequestSql = "UPDATE request SET request_approval = '$requestApproval' WHERE request_id = $requestId";

    // Execute the query
    if ($conn->query($updateRequestSql) === TRUE) {
        echo "<script>alert('Request updated successfully.');</script>";
        // Redirect to request.php
        header("Location: request.php");
        exit();
    } else {
        echo "Error updating request: " . $conn->error;
    }
} else {
    echo "Invalid request. Please submit the form.";
}
?>
