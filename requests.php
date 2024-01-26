<?php
    session_start();
    include('conn.php');

    if (!isset($_SESSION['customer_id'])) {
        echo '<script>
                location.replace("login.php");
                </script>';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create Request
        if (isset($_POST['create-request'])) {
            $itemName = $_POST['itemName'];
            $itemType = $_POST['itemType'];
            $itemCategory = $_POST['itemCategory'];
            $itemPrice = $_POST['itemPrice'];
            $itemDescription = $_POST['itemDescription'];
            $itemWeight = $_POST['itemWeight'];

            $insertRequest = mysqli_prepare($conn, "INSERT INTO request (request_name, customer_id, type_id, category_id, request_description, request_price, request_weight) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insertRequest, "siiisdd", $itemName, $_SESSION['customer_id'], $itemType, $itemCategory, $itemDescription, $itemPrice, $itemWeight);
            
            if (mysqli_stmt_execute($insertRequest)) {
                $requestId = mysqli_insert_id($conn);

                mysqli_stmt_close($insertRequest);

                if ($requestId) {
                    for ($imgCount = 0; $imgCount < count($_FILES["itemImages"]["tmp_name"]); $imgCount++) {
                        $imageData = file_get_contents($_FILES["itemImages"]["tmp_name"][$imgCount]);

                        $query = "INSERT INTO request_img (image, request_id) VALUES (?, ?)";

                        $insertImage = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($insertImage, "si", $imageData, $requestId);
                        mysqli_stmt_send_long_data($insertImage, 0, $imageData);

                        if (mysqli_stmt_execute($insertImage)) {
                            mysqli_stmt_close($insertImage);
                        } else {
                            echo '<script>alert("Failed to insert image.");</script>';
                        }
                    }
                }

                echo '<script>
                    alert("Request has been sent.");
                    location.replace("requests.php");
                    </script>';
                exit;
            } else {
                echo '<script>alert("Something went wrong.");</script>';
            }

            mysqli_stmt_close($insertRequest);
        }

        // Edit Request
        if (isset($_POST['edit-request'])) {
            $itemId = $_POST['editItemId'];
            $editedItemName = $_POST['editItemName'];
            $editedItemType = $_POST['editItemType'];
            $editedItemCategory = $_POST['editItemCategory'];
            $editedItemPrice = $_POST['editItemPrice'];
            $editedItemDescription = $_POST['editItemDescription'];
            $editedItemWeight = $_POST['editItemWeight'];

            $editRequest = mysqli_prepare($conn, "UPDATE request SET request_name = ?, type_id = ?, category_id = ?, request_description = ?, request_price = ?, request_weight = ? WHERE request_id = ?");
            mysqli_stmt_bind_param($editRequest, "siisddi", $editedItemName, $editedItemType, $editedItemCategory, $editedItemDescription, $editedItemPrice, $editedItemWeight, $itemId);
            
            if (mysqli_stmt_execute($editRequest)) {
                if(in_array(UPLOAD_ERR_OK, $_FILES["editItemImages"]["error"]) && isset($_FILES["editItemImages"]["tmp_name"])) {
                    $deleteExistingRowsQuery = "DELETE FROM request_img WHERE request_id = ?";
                    $stmt = mysqli_prepare($conn, $deleteExistingRowsQuery);
                    mysqli_stmt_bind_param($stmt, "i", $itemId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    for ($newimg = 0; $newimg < count($_FILES["editItemImages"]["tmp_name"]); $newimg++) {
                        if (!empty($_FILES["editItemImages"]["tmp_name"][$newimg])) {
                            $imageData = file_get_contents($_FILES["editItemImages"]["tmp_name"][$newimg]);
        
                            $query = "INSERT INTO request_img (image, request_id) VALUES (?, ?)";
                            $updateImage = mysqli_prepare($conn, $query);
                            mysqli_stmt_bind_param($updateImage, "si", $imageData, $itemId);
                            mysqli_stmt_send_long_data($updateImage, 0, $imageData);
        
                            if (mysqli_stmt_execute($updateImage)) {
                                mysqli_stmt_close($updateImage);
                            } else {
                                echo '<script>alert("Failed to update image.");</script>';
                            }
                        }
                    }

                    echo '<script>
                        alert("Request ' . $itemId .' information and images have been updated.");
                        location.replace("requests.php");
                        </script>';
                    exit;
                }
                else {
                    echo '<script>
                        alert("Request ' . $itemId .' information has been updated.");
                        location.replace("requests.php");
                        </script>';
                    exit;
                }
            } else {
                echo '<script>alert("Something went wrong.");</script>';
            }

            mysqli_stmt_close($editRequest);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
    <title>Requests</title>
    <style>
        .request-content {
            margin: 50px 150px 25px 150px;
        }

        .current-request-content {
            margin: 25px 150px 50px 150px;
        }

        .create-request-title {
            font-weight: 700;
        }

        .c-request-btn {
            padding: 10px 30px;
            margin: 25px 0;
            cursor: pointer;
            background-color: #C1B688;
            border-radius: 10px;
            font-weight: 600;
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

        .popup-title {
            font-size: 1.5em;
            font-weight: bold;
            border-bottom: 2px solid #C1B688;
            margin-bottom: 15px;
            padding-bottom: 10px;
            text-align: center;
            overflow: hidden;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }

        .request-form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        #cancelBtn,
        input[type="submit"] {
            padding: 10px;
            cursor: pointer;
            background-color: #ccc;
            width: 20%;
            border-radius: 5px;
        }

        .image-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            font-size: 12px;
            color: #666666;
        }

        .button-container {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        #createBtn {
            background-color: #4CAF50;
            color: white;
        }

        .request-actions {
            display: flex;
            flex-direction: column;
            gap: 7px;
            padding: 10px;
            border: 1px solid black;
            width: 100%;
            align-items: center;
        }

        .request-action-btn {
            padding: 10px;
            width: 40%;
            border-radius: 5px;
            font-weight: 700;
        }

        #view-action {
            background-color: #A5C188;
        }

        #edit-action {
            background-color: #F5EC1A;
        }

        #delete-action {
            background-color: #E70F0F;
        }

        #deleteForm {
            width: 100%;
        }

        #whatsapp-action {
            background-color: #008A40;
        }

        .swiper-container {
            width: 150px;
            height: 200px;
            margin-bottom: 10px;
            margin-left: 105px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
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
            width: 150px;
            height: 200px;
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

        .close-view-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 7px 0;
            margin: 10px 0 0 0;
            background-color: #D9D9D9;
            border-radius: 10px;
            font-weight: bold;
        }

        .view-content {
            margin: 7px 0; 
        }

        .view-subtitle {
            margin-bottom: 5px;
        }

        #whatsapp-action a {
            text-decoration: none;
            color: black;
        }

        .current-requests-title {
            margin-bottom: 15px;
            font-weight: 700;
        }

        .title-description {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 500;
            color: black;
            margin-top: 5px;
        }

        @media (max-width: 700px) {
            .request-content {
                margin: 50px 50px; 
            }
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <main>
        <div class="background-container">
            <img src="assets/images/bg.jpg" alt="Background Image">
            <div class="center-text">
                Request
            </div>
            <p><small class="title-description">You can request your beloved item to be selling on our site.</small></p>
        </div>

        <div class="request-content">
            <div class="create-request-container">
                <div class="create-request-title">
                    Create Request
                </div>
                <div class="create-request-btn">
                    <button class="c-request-btn" onclick="toggleRequestForm('create-request-popup')">Create</button>
                </div>
            </div>
        </div>

        <div id="overlay" class="overlay"></div>

        <div id="create-request-popup" class="popup">
            <div class="popup-title">Create Request</div>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <div class="request-form-group">
                    <label for="itemName">Item Name:</label>
                    <input type="text" id="itemName" name="itemName" required>
                </div>

                <div class="request-form-group">
                    <label for="itemType">Item Type:</label>
                    <select id="itemType" name="itemType" required>
                        <option value="" disabled selected>Select a type</option>
                        <option value="1">Men</option>
                        <option value="2">Ladies</option>
                        <option value="3">Others</option>
                    </select>
                </div>

                <div class="request-form-group">
                    <label for="itemCategory">Item Category:</label>
                    <select id="itemCategory" name="itemCategory" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="1">Top</option>
                        <option value="2">Bottom</option>
                        <option value="3">Sportwear</option>
                        <option value="4">Dress</option>
                        <option value="5">Blazer</option>
                        <option value="6">Jacket</option>
                        <option value="7">Hoodie</option>
                        <option value="8">Shoes</option>
                        <option value="9">Bag</option>
                        <option value="10">Electronics</option>
                        <option value="11">Button Badge</option>
                        <option value="12">Album</option>
                    </select>
                </div>

                <div class="request-form-group">
                    <label for="itemPrice">Item Price (RM):</label>
                    <input type="number" id="itemPrice" name="itemPrice" step="0.01" placeholder="Enter the item price" required>
                </div>

                <div class="request-form-group">
                    <label for="itemDescription">Item Description:</label>
                    <textarea id="itemDescription" name="itemDescription" rows="4" required></textarea>
                </div>

                <div class="request-form-group">
                    <label for="itemWeight">Item Weight (kg):</label>
                    <input type="number" id="itemWeight" name="itemWeight" step="0.1" required>
                </div>

                <div class="request-form-group">
                    <label for="itemImages">Item Image(s): (Max - 4)</label>
                    <input type="file" id="itemImages" name="itemImages[]" accept="image/*" multiple>
                </div>

                <div class="request-form-group">
                    <p>Image Preview</p>
                    <div class="image-preview" id="imagePreview">You have not yet selected any images.</div>
                </div>

                <div class="button-container">
                    <button type="button" id="cancelBtn" onclick="toggleRequestForm('create-request-popup')">Cancel</button>
                    <input type="submit" name="create-request" id="createBtn" value="Create">
                </div>
            </form>
        </div>

        <div class="current-request-content">
            <p class="current-requests-title">Current Request(s)</p>
            <?php
                $imageArray = array();
                $bil = 1;

                $query = "SELECT * FROM request WHERE customer_id = ?";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    // Bind the parameter
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION['customer_id']);

                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Get the result set
                        $result = mysqli_stmt_get_result($stmt);

                        // Check if there are any rows in the result set
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table style='width: 100%; border-collapse: collapse; border: 1px solid black;'>";
                            echo "<thead>";
                            echo "<tr style='border: 1px solid black; height: 50px; background-color: #C1B688; font-size: 18px;'>";
                            echo "<th style='border: 1px solid black; width: 160px;'>Bil.</th>";
                            echo "<th style='border: 1px solid black; width: 570px;'>Request Item Name</th>";
                            echo "<th style='border: 1px solid black;'>Status</th>";
                            echo "<th style='border: 1px solid black;'>Action(s)</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // Fetch rows as associative array
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr style='text-align: center; font-weight: 700;'>";
                                echo "<td style='border: 1px solid black;'>{$bil}</td>";
                                echo "<td style='border: 1px solid black;'>{$row['request_name']}</td>";
                                echo "<td style='border: 1px solid black;'>" . ucfirst($row['request_approval']) . "</td>";

                                // Show different buttons based on the status
                                echo "<td class='request-actions'>";
                                echo "<button class='request-action-btn' id='view-action' name='view-btn' onclick='viewRequest(" . htmlspecialchars(json_encode($row)) . ")'>View</button>";
                                if ($row['request_approval'] === 'approved') {
                                    echo "<button class='request-action-btn' id='whatsapp-action'><a target='_blank' href='https://wa.me/+601112338281?text=Hi,%20I%20would%20like%20to%20process%20with%20my%20request%20{$row['request_name']}'>WhatsApp</a></button>";
                                } elseif ($row['request_approval'] === 'pending') {
                                    echo "<button class='request-action-btn' id='edit-action' name='edit-btn' onclick='editRequest(" . htmlspecialchars(json_encode($row)) . ")'>Edit</button>";
                                    echo "<button type='button' id='delete-action' class='request-action-btn' onclick='confirmDelete(" . $row['request_id'] . ")'>Delete</button>";
                                }
                                echo "</td>";

                                echo "</tr>";
                                $bil++;
                            }

                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<i>Seems like there are no active requests for selling items.</i>";
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error in executing statement: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error in preparing statement: " . mysqli_error($conn);
                }
                ?>
        </div>

        <div id="view-request-popup" class="popup">
            <div class="popup-title">View Request</div>

            <div class="swiper-container">
                <div id="swiperWrapper" class="swiper-wrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="popup-content">
                <div class="view-content">
                    <p class="view-subtitle"><strong>Request Name:</strong></p> <span id="requestName"></span><br>
                </div>
                <div class="view-content">
                    <p class="view-subtitle"><strong>Request Type:</strong></p> <span id="requestType"></span><br>
                </div>
                <div class="view-content">
                    <p class="view-subtitle"><strong>Request Category:</strong></p> <span id="requestCategory"></span><br>
                </div>
                <div class="view-content">
                    <p class="view-subtitle"><strong>Request Weight:</strong></p> <span id="requestWeight"></span><br>
                </div>
                <div class="view-content">
                    <p class="view-subtitle"><strong>Request Price:</strong></p> <span id="requestPrice"></span><br>
                <div class="view-content">
                </div>
                    
                </div><p class="view-subtitle"><strong>Request Description:</strong></p> <span id="requestDescription"></span>
            </div>
            <button class="close-view-btn" onclick="closePopup()">Back</button>
        </div>

        <div id="edit-request-popup" class="popup">
            <div class="popup-title">Edit Request</div>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <input type="hidden" id="editItemId" name="editItemId">

                <div class="request-form-group">
                    <label for="editItemName"><strong>Item Name:</strong></label>
                    <input type="text" id="editItemName" name="editItemName" required>
                </div>

                <div class="request-form-group">
                    <label for="editItemType"><strong>Item Type:</strong></label>
                    <select id="editItemType" name="editItemType" required>
                        <option value="1">Men</option>
                        <option value="2">Ladies</option>
                        <option value="3">Others</option>
                    </select>
                </div>

                <div class="request-form-group">
                    <label for="editItemCategory"><strong>Item Category:</strong></label>
                    <select id="editItemCategory" name="editItemCategory" required>
                        <option value="1">Top</option>
                        <option value="2">Bottom</option>
                        <option value="3">Sportwear</option>
                        <option value="4">Dress</option>
                        <option value="5">Blazer</option>
                        <option value="6">Jacket</option>
                        <option value="7">Hoodie</option>
                        <option value="8">Shoes</option>
                        <option value="9">Bag</option>
                        <option value="10">Electronics</option>
                        <option value="11">Button Badge</option>
                        <option value="12">Album</option>
                    </select>
                </div>

                <div class="request-form-group">
                    <label for="editItemPrice"><strong>Item Price (RM):</strong></label>
                    <input type="number" id="editItemPrice" name="editItemPrice" step="0.01" placeholder="Enter the item price" required>
                </div>

                <div class="request-form-group">
                    <label for="editItemDescription"><strong>Item Description:</strong></label>
                    <textarea id="editItemDescription" name="editItemDescription" rows="4" required></textarea>
                </div>

                <div class="request-form-group">
                    <label for="editItemWeight"><strong>Item Weight (kg):</strong></label>
                    <input type="number" id="editItemWeight" name="editItemWeight" step="0.1" required>
                </div>

                <div class="request-form-group">
                    <label for="editItemImages"><strong>Item Image(s): (Max - 4)</strong></label>
                    <input type="file" id="editItemImages" name="editItemImages[]" accept="image/*" multiple>
                </div>

                <div class="request-form-group">
                    <p id="editImagePreviewTitle"><strong>Current Images</strong></p>
                    <div class="edit-image-preview" id="editImagePreview"></div>
                </div>

                <div class="button-container">
                    <button type="button" id="cancelBtn" onclick="closeEditPopup()">Cancel</button>
                    <input type="submit" name="edit-request" id="editBtn" value="Edit" disabled>
                </div>
            </form>
        </div>
    </main>
    
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        function confirmDelete(deleteRequestId) {
            console.log(deleteRequestId);
            var confirmDelete = confirm("Are you sure you want to delete this request?");

            if (confirmDelete) {
                window.location.href="delete-request.php?id=" + deleteRequestId;
            };
        }

        function enableEditButton() {
            document.getElementById('editBtn').disabled = false;
        }

        // Function to disable the "Edit" button
        function disableEditButton() {
            document.getElementById('editBtn').disabled = true;
        }

        // Add event listeners to each input field to detect changes
        document.getElementById('editItemName').addEventListener('input', enableEditButton);
        document.getElementById('editItemType').addEventListener('change', enableEditButton);
        document.getElementById('editItemCategory').addEventListener('change', enableEditButton);
        document.getElementById('editItemWeight').addEventListener('input', enableEditButton);
        document.getElementById('editItemPrice').addEventListener('input', enableEditButton);
        document.getElementById('editItemDescription').addEventListener('input', enableEditButton);
        document.getElementById('editItemImages').addEventListener('change', enableEditButton);

        function toggleRequestForm(popupForm_id) {
            const overlay = document.getElementById('overlay');
            const popup = document.getElementById(popupForm_id);

            if (popup.style.display === 'none' || popup.style.display === '') {
                overlay.style.display = 'block';
                popup.style.display = 'block';
            } else {
                overlay.style.display = 'none';
                popup.style.display = 'none';

                const form = document.querySelector('#' + popupForm_id + ' form');
                const previewContainer = document.getElementById('imagePreview');
                previewContainer.innerHTML = 'You have not yet selected any images.';
                form.reset();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#create-request-popup form');
            form.reset();
        });

        document.getElementById('itemImages').addEventListener('change', function () {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const maxImages = 4; // Set the maximum number of images allowed
            const maxWidth = 48; // Set the maximum width for each image
            const maxHeight = 64;
            const files = this.files;

            if (files.length > maxImages) {
                alert(`Please select up to ${maxImages} images.`);
                this.value = ''; // Clear the file input
                return;
            }

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('image-preview');

                    imgElement.style.maxWidth = `${maxWidth}px`;
                    imgElement.style.maxHeight = `${maxHeight}px`;
                    imgElement.style.border = '1px solid black';
                    imgElement.style.marginRight = '10px';

                    previewContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            }
        });

        function viewRequest(requestData) {
            var requestId = requestData.request_id;

            fetch(`request-img.php?request_id=${requestId}`)
                .then(response => response.json())
                .then(data => {
                    var swiperWrapperDiv = document.getElementById("swiperWrapper");
                    swiperWrapperDiv.innerHTML = "";

                    const typeMapping = {
                                    1: 'Men',
                                    2: 'Women',
                                    3: 'Others',
                                };

                    const categoryMapping = {
                        1: 'Top',
                        2: 'Bottom',
                        3: 'Sportwear',
                        4: 'Dress',
                        5: 'Blazer',
                        6: 'Jacket',
                        7: 'Hoodie',
                        8: 'Shoes',
                        9: 'Bag',
                        10: 'Electronics',
                        11: 'Button Badge',
                        12: 'Album',
                    };

                    const typeText = typeMapping[requestData.type_id];
                    const categoryText = categoryMapping[requestData.category_id];

                    document.getElementById('requestName').innerText = requestData.request_name;
                    document.getElementById('requestType').innerText = typeText;
                    document.getElementById('requestCategory').innerText = categoryText;
                    document.getElementById('requestWeight').innerText = requestData.request_weight;
                    document.getElementById('requestPrice').innerText = "RM " + parseFloat(requestData.request_price).toFixed(2);
                    document.getElementById('requestDescription').innerText = requestData.request_description;

                    data.images.forEach(base64Image => {
                        var imgElement = document.createElement("img");
                        imgElement.src = `data:image/jpeg;base64,${base64Image}`;

                        var swiperSlide = document.createElement("div");
                        swiperSlide.classList.add("swiper-slide");
                        swiperSlide.appendChild(imgElement);

                        swiperWrapperDiv.appendChild(swiperSlide);
                    });

                    var swiper = new Swiper(".swiper-container", {
                                    style: {
                                        "--swiper-navigation-color": "#000",
                                        "--swiper-navigation-size": "12px",
                                    },
                                    slidesPerView: 1,
                                    centeredSlides: true,
                                    navigation: {
                                        nextEl: ".swiper-button-next",
                                        prevEl: ".swiper-button-prev",
                                    },
                                });

                    document.getElementById('overlay').style.display = 'block';
                    document.getElementById('view-request-popup').style.display = 'block';
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        document.getElementById('editItemImages').addEventListener('change', function () {
            const previewContainer = document.getElementById('editImagePreview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const maxImages = 4; // Set the maximum number of images allowed
            const maxWidth = 48; // Set the maximum width for each image
            const maxHeight = 64;
            const files = this.files;

            if (files.length > maxImages) {
                alert(`Please select up to ${maxImages} images.`);
                this.value = ''; // Clear the file input
                return;
            }

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('image-preview');

                    imgElement.style.maxWidth = `${maxWidth}px`;
                    imgElement.style.maxHeight = `${maxHeight}px`;
                    imgElement.style.border = '1px solid black';
                    imgElement.style.marginRight = '10px';

                    previewContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            }

            document.getElementById("editImagePreviewTitle").innerHTML = "Image Preview";
        });

        function editRequest(requestData) {
            var requestId = requestData.request_id;

            fetch(`request-img.php?request_id=${requestId}`)
                .then(response => response.json())
                .then(data => {
                    const editPreviewContainer = document.getElementById('editImagePreview');
                    editPreviewContainer.innerHTML = '';
                    const maxWidth = 48;
                    const maxHeight = 64;

                    document.getElementById('editItemId').value = requestId;
                    document.getElementById('editItemName').value = requestData.request_name;
                    document.getElementById('editItemType').selectedIndex = requestData.type_id - 1;
                    document.getElementById('editItemCategory').selectedIndex = requestData.category_id - 1;
                    document.getElementById('editItemWeight').value = requestData.request_weight;
                    document.getElementById('editItemPrice').value = requestData.request_price;
                    document.getElementById('editItemDescription').value = requestData.request_description;

                    data.images.forEach(base64Image => {
                        var imgElement = document.createElement("img");
                        imgElement.src = `data:image/jpeg;base64,${base64Image}`;

                        imgElement.classList.add('edit-image-preview');

                        imgElement.style.maxWidth = `${maxWidth}px`;
                        imgElement.style.maxHeight = `${maxHeight}px`;
                        imgElement.style.border = '1px solid black';
                        imgElement.style.marginRight = '10px';

                        editPreviewContainer.appendChild(imgElement);
                    });

                    document.getElementById('overlay').style.display = 'block';
                    document.getElementById('edit-request-popup').style.display = 'block';
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('view-request-popup').style.display = 'none';
        }

        function closeEditPopup() {
            document.getElementById('editBtn').disabled = true;
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('edit-request-popup').style.display = 'none';
        }
    </script>
    <script src="script.js"></script>
</body>
</html>