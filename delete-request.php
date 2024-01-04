<?php
    include('conn.php');

    $entryIdToDelete = $_GET['request_id'];

    // Prepare and execute the SQL statement to delete the entry
    $imgsql = "DELETE FROM request_img WHERE request_id = ?";
    $imgstmt = mysqli_prepare($conn, $imgsql);
    mysqli_stmt_bind_param($imgstmt, "i", $entryIdToDelete);

    if (mysqli_stmt_execute($imgstmt)) {
        $sql = "DELETE FROM request WHERE request_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $entryIdToDelete);

        if (!mysqli_stmt_execute($stmt)) {
            http_response_code(500);
        }
    } else {
        http_response_code(500);
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>