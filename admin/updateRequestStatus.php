<?php
// updateRequestStatus.php

include('conn.php'); // Replace with the actual filename

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary fields are set
    if (isset($_POST['requestId']) && isset($_POST['newStatus'])) {
        $requestId = mysqli_real_escape_string($conn, $_POST['requestId']);
        $approvalStatus = mysqli_real_escape_string($conn, $_POST['newStatus']);

        // Update the approval status in the database
        $updateApprovalSQL = "UPDATE request SET request_approval = '$approvalStatus' WHERE request_id = '$requestId'";

        if ($conn->query($updateApprovalSQL) === TRUE) 
        {
            // Display the alert box  
            echo '<script>alert("Edit Success")</script>'; 
        } else {
            echo "Error updating approval status: " . $conn->error;
        }
    } else {
        echo "Error: Request ID or Approval Status not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
