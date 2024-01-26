<?php
//fetch-product-img.php

include('conn.php');

if (isset($_GET['product_id'])) {
    $proId = $_GET['product_id'];

    $queryImages = "SELECT image FROM product_img WHERE product_id = $proId";
    $resultImages = mysqli_query($conn, $queryImages);

    if ($resultImages) {
        $imageData = array();
        $imageData = [];
        while ($row = mysqli_fetch_assoc($resultImages)) {
            $imageData[] = base64_encode($row['image']);
        }

        mysqli_close($conn); // Close the connection after fetching data

        echo json_encode(['images' => $imageData]);
    } else {
        echo "Error fetching images: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>