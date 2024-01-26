<?php
// editProductForm.php
require('conn.php');
require('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="prelovebyjosie admin dashboard">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            color: #007bff;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #007bff;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .actionBtn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .actionBtn:hover {
            background-color: #0056b3;
        }

        .backBtn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .backBtn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the product ID is set
        if (isset($_POST['productId'])) {
            $productId = $_POST['productId'];

            // Retrieve the product details based on the product ID
            $sql = "SELECT * FROM product WHERE product_id = $productId";
            $result = $conn->query($sql);

            // Fetch product types for dropdown
            $typeSql = "SELECT * FROM type";
            $typeResult = $conn->query($typeSql);
            $types = $typeResult->fetch_all(MYSQLI_ASSOC);

            // Fetch product categories for dropdown
            $categorySql = "SELECT * FROM category";
            $categoryResult = $conn->query($categorySql);
            $categories = $categoryResult->fetch_all(MYSQLI_ASSOC);

            // Check if the query was successful
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Extract relevant details for pre-filling the form
                $productName = $row['product_name'];
                $productDescription = $row['product_description'];
                $productPrice = $row['product_price'];
                $productWeight = $row['product_weight'];
                $selectedType = $row['type_id'];
                $selectedCategory = $row['category_id'];
                // Add more fields as needed
                ?>
                <!-- Display the form with pre-filled values -->
                <form action="updateProduct.php" method="POST">
                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" value="<?php echo $productName; ?>" required>

                    <label for="productDescription">Product Description:</label>
                    <textarea id="productDescription" name="productDescription" required><?php echo $productDescription; ?></textarea>

                    <label for="productPrice">Product Price:</label>
                    <input type="number" id="productPrice" name="productPrice" value="<?php echo $productPrice; ?>" step="0.01" required>

                    <label for="productWeight">Product Weight:</label>
                    <input type="number" id="productWeight" name="productWeight" value="<?php echo $productWeight; ?>" step="0.01" required>

                    <!-- Dropdown for Product Type -->
                    <label for="productType">Product Type:</label>
                    <select id="productType" name="productType" required>
                        <?php
                        foreach ($types as $type) {
                            $selected = ($type['type_id'] == $selectedType) ? 'selected' : '';
                            echo "<option value='{$type['type_id']}' {$selected}>{$type['type_name']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Dropdown for Product Category -->
                    <label for="productCategory">Product Category:</label>
                    <select id="productCategory" name="productCategory" required>
                        <?php
                        foreach ($categories as $category) {
                            $selected = ($category['category_id'] == $selectedCategory) ? 'selected' : '';
                            echo "<option value='{$category['category_id']}' {$selected}>{$category['category_name']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Add more fields as needed -->

                    <input type="submit" value="Update Product">
                </form>
                <button onclick="redirectBack()" class="backBtn">Go Back to View All Products</button>
                <?php
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Product ID not set.";
        }
    } else {
        echo "Invalid request.";
    }
    ?>

<script>
// Add this script at the end of your file or in the head section
function redirectBack() {
    // Redirect to viewAllProducts.php
    window.location.href = 'viewAllProducts.php';
}
</script>

</body>
</html>

<?php
require('footer.php');
?>