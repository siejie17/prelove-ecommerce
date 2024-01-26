<?php
    include('conn.php');

    if (isset($_GET['request_id'])) {
        $requestId = $_GET['request_id'];

        $queryImages = "SELECT image FROM request_img WHERE request_id = $requestId";
        $resultImages = mysqli_query($conn, $queryImages);

        if ($resultImages) {
            $imageData = array();
            while ($row = mysqli_fetch_assoc($resultImages)) {
                $imageData[] = base64_encode($row['image']);
            }

            mysqli_close($conn);

            echo json_encode(['images' => $imageData]);
        } else {
            echo "Error fetching images: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request";
    }

    mysqli_close($conn);
?>