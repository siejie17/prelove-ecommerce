<?php
// Include your database configuration file
include('config.php');

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
    $productStatus = sanitize($_POST['pstatus']);

    // Insert into the product table
    $insertProductSQL = "INSERT INTO product (product_name, product_description, product_price, type_id, category_id, product_weight, product_status) VALUES ('$productName', '$productDescription', '$productPrice', '$productType', '$productCategory', '$productWeight', '$productStatus')";

    if ($conn->query($insertProductSQL) === TRUE) {
        $lastProductId = $conn->insert_id; // Get the last inserted product ID

        // Handle file uploads for product images
        $targetDir = "uploads/"; // Specify the target directory where images will be stored
        $allowedExtensions = array("jpg", "jpeg", "png", "svg");

        // Loop through each selected file
        //for ($i = 0; $i < count($_FILES['pimages']['name']); $i++) {
            $fileName = basename($_FILES['pimages']['name'][$i]);
            $targetFilePath = $targetDir . $fileName;
            $fileExtension = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Check if the file has a valid extension
            if (in_array($fileExtension, $allowedExtensions)) {
                // Move the file to the specified directory
                if (move_uploaded_file($_FILES['pimages']['tmp_name'][$i], $targetFilePath)) {
                    // Insert image details into the product_img table
                    $insertImageSQL = "INSERT INTO product_img (image, product_id) VALUES ('$targetFilePath', '$lastProductId')";
                    $conn->query($insertImageSQL);
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file format. Allowed formats: jpg, jpeg, png, svg.";
            }
        //}

        //echo "Product added successfully.";
        // Display the alert box  
        echo '<script>alert("Product added successfully.")</script>'; 
        $URL="addProduct.php";
        echo "<script>location.href='$URL'</script>";

    } else {
        echo "Error: " . $insertProductSQL . "<br>" . $conn->error;
    }

    // Close the database connection
    //$conn->close();
}
?>
