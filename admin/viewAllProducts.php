<?php
require('conn.php');
require('header.php');
// require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <!--Google icon CDN here.-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="viewAllProducts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <style>
        .actionBtn 
        {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .actionBtn:hover 
        {
            background-color: #FFEBCD;
        }
        .backBtn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 3%;
        }

        .backBtn:hover {
            background-color: #FFEBCD;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 11;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            z-index: 12;
        }

        .swiper-container {
            width: 300px;
            height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            display: block; /* Remove any default image alignment */
            margin: 0 auto; /* Center image horizontally */
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            height: 20px;
            width: 20px;
            color: white;
            top: 55%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: black;
            border-radius: 50%;
            --swiper-navigation-size: 14px;
        }

        .swiper-button-next {
            right: 5px; /* Adjust the distance from the right edge */
        }

        .swiper-button-prev {
            left: 5px; /* Adjust the distance from the left edge */
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            width: 300px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .closeImage {
            position: absolute;
            top: 15px;
            right: 15px;
            color: black;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <button onclick="redirectBack()" class="backBtn">Go Back to Products</button>
    <div>
        <h2 class="table-header">Products</h2>
    </div>

    <!-- card to show all available products -->
    <div class="card">
        <p onclick="window.location.href='viewAvailableProducts.php'">Display all <span class="available">available</span> products         <span class="material-symbols-outlined">event_available</span> </p>
    </div>

    <!-- card to show all unavailable products -->
    <div class="card">
        <p onclick="window.location.href='viewUnavailableProducts.php'"> Display all <span class="unavailable">unavailable</span> products <span class="material-symbols-outlined">event_busy</span>  </p>
    </div>

    <div class="container-fluid">
        <h2 class="table-header">View All Products</h2>
        <!-- Table to display Products data -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Status</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Define how many records to display per page
                $records_per_page = 10;

                // Get the current page number from the query string
                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $current_page = intval($_GET['page']);
                } else {
                    $current_page = 1;
                }

                // Calculate the offset for the SQL query
                $offset = ($current_page - 1) * $records_per_page;

                // SQL query to retrieve product data
                $sql = "SELECT
                    p.product_id,
                    p.product_name,
                    p.product_description,
                    p.product_price,
                    t.type_name,
                    c.category_name,
                    p.product_weight,
                    p.product_status
                    FROM
                    product p
                    JOIN
                    type t ON p.type_id = t.type_id
                    JOIN
                    category c ON p.category_id = c.category_id
                    ORDER BY p.product_id ASC
                    LIMIT $records_per_page OFFSET $offset;";

                // Execute the query
                $result = $conn->query($sql);

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['product_description'] . "</td>";
                        echo "<td>" . $row['product_price'] . "</td>";
                        echo "<td>" . $row['type_name'] . "</td>";
                        echo "<td>" . $row['category_name'] . "</td>";
                        echo "<td>" . $row['product_weight'] . "</td>";
                        echo "<td>" . $row['product_status'] . "</td>";
                        echo "<td>" . "<button class='actionBtn' id='view-action' name='view-btn' onclick='viewImage(" . $row['product_id'] . ")'>View</button> " . "</td>";
                        echo "<td>";
                        echo "<form method='POST' action='editProductForm.php'>";
                        echo "<input type='hidden' name='productId' value='" . $row['product_id'] . "'>";
                        echo "<button type='submit' name='editProductBtn' class='actionBtn'>Edit</button>";
                        echo "</form>";
                        echo "<br>";
                        echo "<form method='POST' action='deleteProduct.php'>";
                        echo "<input type='hidden' name='productId' value='" . $row['product_id'] . "'>";
                        echo "<button type='submit' name='deleteProductBtn' class='actionBtn'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No Products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Display pagination links -->
        <?php
            // Count total number of records
            $total_records_sql = "SELECT COUNT(*) FROM product;";
            $total_records_result = $conn->query($total_records_sql);
            $total_records = $total_records_result->fetch_row()[0];

            // Calculate the total number of pages
            $total_pages = ceil($total_records / $records_per_page);

            echo "<ul class='pagination justify-content-center'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item";
                if ($i == $current_page) {
                    echo " active";
                }
                echo "'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            echo "</ul>";
            ?>
    </div>

    <!-- overlay for product images -->
    <div id="overlay" class="overlay"></div>
    <div id="pro-images" class="popup">
    <span class="closeImage" onclick="closeImages()">&times;</span>
        <div class="swiper-container">
            <div id="swiperWrapper" class="swiper-wrapper"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // JavaScript function to handle the redirection
        function redirectBack() {
            // Redirect to products.php
            window.location.href = 'products.php';
        }

        function viewImage(product_id) {
        fetch(`fetch-product-img.php?product_id=${product_id}`)
            .then(response => response.json())
            .then(data => {
                var swiperWrapperDiv = document.getElementById("swiperWrapper");
                swiperWrapperDiv.innerHTML = "";
                
                data.images.forEach(base64Image => {
                    var imgElement = document.createElement("img");
                    imgElement.src = `data:image/jpeg;base64,${base64Image}`;

                    var swiperSlide = document.createElement("div");
                    swiperSlide.classList.add("swiper-slide");
                    swiperSlide.appendChild(imgElement);

                    swiperWrapperDiv.appendChild(swiperSlide);
                });

                var swiper = new Swiper(".swiper-container", {
                    slidesPerView: 1,
                    centeredSlides: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });

                document.getElementById('overlay').style.display = 'block';
                document.getElementById('pro-images').style.display = 'block';
            })
            .catch(error => console.error('Error fetching data:', error));
    }
    // view images API Ends

        function closeImages() {
            document.getElementById('pro-images').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function confirmDelete(deleteTestimonialId) {
            var confirmDelete = confirm("Are you sure you want to delete this product?");

            if (confirmDelete) {
                window.location.href="deleteTestimonial.php?testimonial_id=" + deleteTestimonialId;
            };
        }

    </script>
</body>
</html>
<?php 
require('footer.php');
?>