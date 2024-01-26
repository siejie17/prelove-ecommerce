<?php
//fetch-product-img.php

include('conn.php');

if (isset($_GET['request_id'])) {
    $reqId = $_GET['request_id'];

    $queryImages = "SELECT image FROM request_img WHERE request_id = $reqId";
    $resultImages = mysqli_query($conn, $queryImages);

    if ($resultImages) {
        $imageData = array();
        while ($row = mysqli_fetch_assoc($resultImages)) {
            $imageData[] = base64_encode($row['image']);
        }

        mysqli_free_result($resultImages); // Free the result set
        mysqli_close($conn); // Close the connection after fetching data

        echo json_encode(['images' => $imageData]);
    } else {
        echo "Error fetching images: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>