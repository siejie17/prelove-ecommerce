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
            $customer_id=$_SESSION['customer_id'];
            $itemReview = $_POST['itemDescription'];
            // $date_time=date('Y-m-d H:i:s', strtotime($_POST['timestamp']));
            $order_id=$_POST['orderid'];

            $insertTestimonial = mysqli_prepare($conn, "INSERT INTO testimonial (testimonial_description, customer_id, order_id) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($insertTestimonial, "sii", $itemReview, $customer_id, $order_id);
            
            if (mysqli_stmt_execute($insertTestimonial)) {
                $testimonialId = mysqli_insert_id($conn);

                mysqli_stmt_close($insertTestimonial);

                if ($testimonialId) {
                    for ($imgCount = 0; $imgCount < count($_FILES["itemImages"]["tmp_name"]); $imgCount++) {
                        $imageData = file_get_contents($_FILES["itemImages"]["tmp_name"][$imgCount]);

                        $query = "INSERT INTO testimonial_img (image, testimonial_id) VALUES (?, ?)";

                        $insertImage = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($insertImage, "si", $imageData, $testimonialId);
                        mysqli_stmt_send_long_data($insertImage, 0, $imageData);

                        if (mysqli_stmt_execute($insertImage)) {
                            mysqli_stmt_close($insertImage);
                        } else {
                            echo '<script>alert("Failed to insert image.");</script>';
                        }
                    }
                }

                echo '<script>
                    alert("Review has been submitted.");
                    location.replace("my-order.php");
                    </script>';
                exit;
            } else {
                echo '<script>alert("Something went wrong.");</script>';
            }

            mysqli_stmt_close($insertTestimonial);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="search.css"/>
    <title>Order Status</title>

    <style>
        .topic{
            font-weight: bold;
            font-size:30px;
        }
        .cart-container {
            max-width: 1184px;
            margin: 50px auto 20px auto;
            /* padding: 10px; */
            border: 1px solid #ddd;
        }

        .cart-header{
            background-color:lightgrey;
        }

        .cart-header, .cart-item, .checkout-section {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item {
                align-items: center;
                margin-bottom: 10px;
            }

        .cart-item img {
            max-width: 130px;
            max-height: 200px;
            margin-right:10px;
            margin-left: 30px;
        }

        .cart-header > div, .cart-item > div {
                /* Set specific widths for each column */
                flex: 1; /* Equal width for all columns */
                max-width: 150px; /* Adjust the max-width as needed */
                text-align: center; /* Center the text */
        }

        .cart-header div> span{
            /* color:blue; */
            font-weight:bold;
        }

        .cancel, .delivered, .rate {
            color: white;
            padding: 10px;
            cursor: pointer;
            margin-right:10px;
            border-radius:5px;
            font-size:15px;
        }

        .cancel{
            background-color: red;
        }

        .delivered{
            background-color: orange;
        }

        .rate{
            width:125px;
            background-color: orange;
        }


        .topic{
            text-align:center;
            margin-top:10px;
        }

        .priceTitle{
            margin-left: 30px;
        }

        /* new */
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
        
        .error{
            height: auto;
            width: 1184px;
            margin: 50px auto;
            text-align:center;
        }

    </style>
</head>

<body>
    <?php
        include("navbar.php");
        echo'<main class="content">';
        
    ?>
    <section>
            <h3 class="topic">My Order</h3>
    </section>
    
        <?php
            
            $order_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
            if (isset($_SESSION['customer_id'])){
                $customer_id=mysqli_real_escape_string($conn,$_SESSION['customer_id']);
                $findId="SELECT order_id,track_number,order_date,order_status,shipping_fee FROM orders WHERE customer_id=$customer_id";

                $result=mysqli_query($conn,$findId);

                if($result->num_rows >0){

                    //represent 1 order id for each loop (after loop: many order id)
                    while($row=mysqli_fetch_assoc($result)){
                        $total=0.00;
                        $id=$row['order_id'];
                        $track=$row['track_number'];
                        $date=$row['order_date'];
                        $status=$row['order_status'];
                        $fee=$row['shipping_fee'];
                        echo'<div class="cart-container">';
                            echo'<div class="cart-header">';
                                    echo'<div>Order <br><span>#'.$id.'</span></div>';
                                    echo'<div>Tracking number <br><span>'.($track?$track:'-').'</span></div>';
                                    echo'<div>Order Date <br><span>'.$date.'</span></div>';
                                    echo'<div>Order Status <br><span>'.$status.'</span></div>';
                                echo'</div>';
                                $productInfo="SELECT product.product_id, product.product_name, product.product_price, min(product_img.image) AS min_image FROM orders JOIN order_details ON orders.order_id = order_details.order_id JOIN product ON order_details.product_id = product.product_id JOIN product_img ON product.product_id = product_img.product_id WHERE orders.customer_id = $customer_id AND orders.order_id=$id GROUP BY product.product_name, product.product_price";
                                $result1=mysqli_query($conn,$productInfo);
                                $productIds=array();

                            //represent 1 product inside 1 order id for each loop (after loop: many products inside one id)    
                            while($row1=mysqli_fetch_assoc($result1)){
                                $productId=$row1['product_id'];
                                $productIds[]=$productId;
                                $img=$row1['min_image'];
                                $name=$row1['product_name'];
                                $prices=(float)$row1['product_price'];
                                $subtotal=$prices;
                                $total+=$subtotal;
                                echo '<div class="cart-item">';
                                    echo '<div><img src="data:image/png;base64,'.base64_encode($row1['min_image']) . '" alt="' . $name . '"></div>';
                                    echo '<div>' . $name. '</div>';
                                    echo '<div>RM ' . $subtotal . '</div>';
                                echo '</div>';   
                            }  

                            $testimonial="SELECT order_id FROM testimonial WHERE order_id=$id";
                            $result2=mysqli_query($conn,$testimonial);
                            $row2=mysqli_fetch_assoc($result2);
                            
                            echo'<div class="checkout-section">';
                                echo'<div class="priceTitle">Total Price (Shipping fee inclusive): RM '.$total+$fee. '</div>';
                                if ($status==='pending'){
                                    echo '<div><button class="cancel" data-orderid="'.$id.'" data-product="'.implode(',', $productIds).'">Cancel Order</button></div>';
                                }

                                elseif($status==='shipping'){
                                    echo '<div><button class="delivered"  data-orderid="'.$id.'">Item Delivered</button></div>';
                                }

                                elseif($status==='delivered' && mysqli_num_rows($result2) == 0){
                                    echo '<div><button class="rate" data-orderid="'.$id.'">Rate</button></div>';
                                }

                                elseif($status==='delivered' && mysqli_num_rows($result2) > 0 ){
                                    
                                }

                                elseif($status==='cancelled'){
                                    
                                }

                                // endif;
                                
                            echo'</div>';?>

                            
                <?php
                        echo'</div>';
                    }
                }

                else{
                    echo"<div class='error'><h1>You have no order~ ~ ~</h1></div>";
                }

            }
        ?>
        
        <div id="overlay" class="overlay"></div>

        <div id="create-request-popup" class="popup">
            <div class="popup-title">Leave a review</div>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                
                <div class="request-form-group">
                    <label for="itemImages">Item Image(s): (Max - 4)</label>
                    <input type="file" id="itemImages" name="itemImages[]" accept="image/*" multiple>
                </div>

                <div class="request-form-group">
                    <p>Image Preview</p>
                    <div class="image-preview" id="imagePreview">You have not yet selected any images.</div>
                </div>

                <div class="request-form-group">
                    <label for="itemDescription">Review:</label>
                    <textarea id="itemDescription" name="itemDescription" rows="4" required></textarea>
                </div>

                <!-- <input type="hidden" id="timestamp" name="timestamp" value=""> -->
                <input type="hidden" id="orderid" name="orderid" value="">

                <div class="button-container">
                    <button type="button" id="cancelBtn" onclick="toggleRequestForm('create-request-popup')">Cancel</button>
                    <input type="submit" name="create-request" id="createBtn" value="Submit">
                </div>
            </form>
        </div>
        
        <div id="added-overlay" class="added-overlay"></div>

        <div id="added-popup" class="added-popup">
            <p><?php echo $order_message ?></p>
            <button id="added-closePopup">Close</button>
        </div>

    <?php
        echo'</main>';
        include("footer.php");
    ?>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cancelButton=document.querySelectorAll('.cancel');
        const deliveredButton=document.querySelectorAll('.delivered');
        const rateButtons = document.querySelectorAll('.rate');

        rateButtons.forEach(function (rateButton) {
            rateButton.addEventListener('click', function () {
                const orderid = rateButton.dataset.orderid;
                const orderidField = document.getElementById('orderid');
                orderidField.value = orderid;

                // If you want to toggle the request form, you can call your existing function
                toggleRequestForm('create-request-popup');
            });});
        // const orderid=cancel.dataset.orderid;
        // const productids=cancel.dataset.productid;

        cancelButton.forEach(
            cancel=>{
                cancel.addEventListener('click',function(){ 
                var removeOrd=confirm("Are you sure want to cancel the order?");
                if (removeOrd){
                    const data= cancel.dataset.product;
                    const id =cancel.dataset.orderid;
                    window.location.href='cancelOrder.php?data='+encodeURIComponent(data)+'&orderid='+encodeURIComponent(id);
                }
            });
    });

        deliveredButton.forEach(delivered=>{addEventListener('click',function(){
            var receiveItem=confirm("Are you sure that you have received the items?");
            if (receiveItem){
                const id =delivered.dataset.orderid;
                window.location.href='receiveOrder.php?orderid='+encodeURIComponent(id);
            }
        })
    });

        <?php if (!empty($order_message)) : ?>
                document.addEventListener('DOMContentLoaded',function(){
                const overlay = document.querySelector('#added-overlay');
                const popup = document.querySelector('#added-popup');
                const closePopup = document.querySelector('#added-closePopup');

                // Function to open the popup
                function openPopup() {
                    overlay.style.display = 'block';
                    popup.style.display = 'block';
                }

                // Function to close the popup
                function closePopupFunction() {
                    overlay.style.display = 'none';
                    popup.style.display = 'none';
                }

                // Event listener for the close button
                closePopup.addEventListener('click', function(){
                    closePopupFunction();
                });

                // Event listener for clicking outside the popup to close it
                overlay.addEventListener('click', function (event) {
                    if (event.target === overlay) {
                        closePopupFunction();
                    }
                });

                // Display the popup when the page loads
                // window.addEventListener('load', openPopup);
                openPopup();
                <?php unset($_SESSION['message']); ?>
            
            });
            
        <?php else : ?>
        <?php endif; ?>
    });

    // function rate(){
    //     window.location.href="review.php";
    // }

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

        // update timestamp before form submission
        document.getElementById('createBtn').addEventListener('click', function () {
            // const timestampField = document.getElementById('timestamp');
            // const currentTimestamp = new Date().toISOString().slice(0, 19).replace("T", " ");
            // timestampField.value = currentTimestamp;

            const orderidField = document.getElementById('orderid');
            const rateButton = document.querySelector('.rate');
            
            // Check if rateButton is found
            if (rateButton) {
                const orderid = rateButton.dataset.orderid;
                orderidField.value = orderid;
            }
        });
</script>

</body>
</html>