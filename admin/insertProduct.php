<?php
// Include your database configuration file
include('conn.php');

// Function to sanitize input data
function sanitize($input)
{
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $productName = sanitize($_POST['pname']);
    $productDescription = sanitize($_POST['pdescription']);
    $productPrice = sanitize($_POST['pprice']);
    $productType = sanitize($_POST['ptype']);
    $productCategory = sanitize($_POST['pcat']);
    $productWeight = sanitize($_POST['pweight']);
    $productStatus = sanitize($_POST['pstatus']); //pimages

    // Insert into the product table
    $insertProductSQL = "INSERT INTO product (product_name, product_description, product_price, type_id, category_id, product_weight, product_status) 
    VALUES ('$productName', '$productDescription', '$productPrice', '$productType', '$productCategory', '$productWeight', '$productStatus')";

    if ($conn->query($insertProductSQL) === TRUE) {
        $lastProductId = $conn->insert_id; // Get the last inserted product ID

        // Handle file uploads for product images aka pimages
        for ($newimg = 0; $newimg < count($_FILES["pimages"]["tmp_name"]); $newimg++) {
            if (!empty($_FILES["pimages"]["tmp_name"][$newimg])) 
            {
                // Check if the total uploaded images exceed 4
                if ($newimg >= 4) {
                    echo '<script>alert("You can upload at most 4 images.\n Only first 4 images are inserted.");</script>';
                    break; // Stop processing additional images
                }

                $imageData = file_get_contents($_FILES["pimages"]["tmp_name"][$newimg]);

                $query = "INSERT INTO product_img (image, product_id) VALUES (?, ?)";
                $updateImage = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($updateImage, "si", $imageData, $lastProductId);
                mysqli_stmt_send_long_data($updateImage, 0, $imageData);

                if (mysqli_stmt_execute($updateImage)) {
                    mysqli_stmt_close($updateImage);
                } else {
                    echo '<script>alert("Failed to update image.");</script>';
                }
            }
        }

        // Display the alert box
        echo '<script>alert("Product added successfully.")</script>';
        // Set URL for redirect
        $URL = "addProductForm.php";
        // Redirect action for page
        echo "<script>location.href='$URL'</script>";

    } else {
        echo "Error: " . $insertProductSQL . "<br>" . $conn->error;
    }
}
?>
