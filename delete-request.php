<?php
    include('conn.php');

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $imgsql = "DELETE FROM request_img WHERE request_id = ?";
    $imgstmt = mysqli_prepare($conn, $imgsql);

    if ($imgstmt) {
        mysqli_stmt_bind_param($imgstmt, "i", $id);
        if (mysqli_stmt_execute($imgstmt)) {
            // Delete from request table
            $sql = "DELETE FROM request WHERE request_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script> <alert>Your request has been deleted successfully.</alert>; </script>";
                } else {
                    echo "Error deleting from request: " . mysqli_error($conn) . "<br>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing statement for request table: " . mysqli_error($conn) . "<br>";
            }
        } else {
            echo "Error deleting from request_img: " . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($imgstmt);
    } else {
        echo "Error preparing statement for request_img table: " . mysqli_error($conn) . "<br>";
    }

    echo "<script> location.replace('requests.php'); </script>";
    // Close the connection
    mysqli_close($conn);
?>