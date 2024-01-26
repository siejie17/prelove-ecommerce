<?php 
    session_start();
    include('conn.php');
    include('navbar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
    <link rel="stylesheet" href="style.css"/>
    <title>Product Description</title>
    <style>
        .descr_container{
            margin: 20px 357.5px;
        }

        .clickble_slider1{
            padding: 100px 0;
        }

        .image-fluid{
            z-index: -10 ;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center; 
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            cursor: pointer;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
        }

        .swiper {
            width: 100%;
        }

        .swiper_thumb .swiper-slide {
            opacity: 0.7;
        }

        .swiper_thumb .swiper-slide:hover {
            opacity: 1;
        }

        .swiper_thumb .swiper-slide-thumb-active {
            opacity: 1;
            border: 2px solid red;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            user-select: none;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: red;
            background: rgba(255, 255, 255, .8);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0px 2px 2px rgb(221 56 34);
            z-index: 9;
        }

        .swiper-button-next,
        .swiper-button-prev::after {
            font-size: 24px;
            font-weight: 600;
        }

        .swiper-button-prev,
        .swiper-button-next::after {
            font-size: 24px;
            font-weight: 600;
        }

        .swiper-button-next {
            right: 0px;
        }

        .swiper-button-prev {
            left: 0px;
        }

        .swiper-button-next:hover {
            color: #ccc;
            background: red;
        }

        .swiper-button-prev:hover {
            color: #ccc;
            background: red;
        }

        .added-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }

        .added-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 3;
        }

        .added-popup p {
            margin-bottom: 20px;
        }

        #added-closePopup {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            float: right;
        }

        .add-to-cart{
            height: 50px;
            width: 400px;
            margin: 15px 0px 0px 0px;
            padding: 0 10px;
            border:1px solid lightgrey;
            border-radius: 5px;
            background-color: blue;
            color:white;
        }

        .add-to-cart:hover{
            background-color: #ff6700;
            color: white;
        }

        body.popup-open .swiper {
            opacity: 0.2; /* Adjust the opacity as needed */
            pointer-events: none; /* Disable pointer events for the swiper */
        }

        #small-preview {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
        $cart_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        
        if(isset($_GET['product_id'])){
            $product_id = mysqli_real_escape_string($conn,$_GET['product_id']);
            
            $sql = "SELECT product.product_id, product.product_name, product.product_description, product.product_price, product_img.image 
                    FROM product JOIN product_img ON product.product_id = product_img.product_id 
                    WHERE product_img.product_id=$product_id";
            
            $result = mysqli_query($conn, $sql);
        }           
    ?>

    <section class="clickble_slider1">
        <div class="descr_container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Swiper -->
                    <div class="row">
                        <div class="col-md-12 px-0 py-2">  
                            <div class="swiper swiper_large_preview">
                                <div class="swiper-wrapper">
                                <?php
                                if($result){
                                   
                                while($row=mysqli_fetch_assoc($result)){
                                ?>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                            <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($row['image'])?>"/>
                                        </div>
                                    </div>
                                <?php }} ?>
                                </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    
                            </div>
                            
                        </div>
                    
                        <div class="col-md-12 px-0 py-2">
                            <div thumbsSlider="" class="swiper swiper_thumb">
                                <div class="swiper-wrapper" id="small-preview">
                                <?php
                                    if($result){
                                        mysqli_data_seek($result, 0);
                                    while($row=mysqli_fetch_assoc($result)){
                                ?>
                                    <div class="swiper-slide">
                                        <div class="zoom_img">
                                        <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($row['image'])?>"/>
                                        </div>
                                    </div>
                                <?php }} mysqli_data_seek($result, 0);?>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>


                </div>  
                <div class="col-sm-6">
                    <?php $row=mysqli_fetch_assoc($result) ?>
                    <h1><?php echo $row['product_name']?></h1>
                    <h3 class="text-success"><?php echo "RM ".$row['product_price']?></h3>
                    <div class="lorem_text">
                        <p>
                        <?php echo $row['product_description']?>
                        </p>
                    </div>
                    
                    <form action="addToCart1.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                        <button type="submit" class="add-to-cart" data-id="'.<?php echo $row['product_id'] ?>.'" >Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="added-overlay" class="added-overlay"></div>

        <div id="added-popup" class="added-popup">
            <p><?php echo $cart_message ?></p>
            <button id="added-closePopup">Close</button>
        </div>
    </section>
        
    <?php include("footer.php")?>

    <script src="script.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!--Popup Form Manipulation-->
    <script>
        <?php if (!empty($cart_message)) : ?>
            document.addEventListener('DOMContentLoaded',function(){
            const overlay = document.querySelector('#added-overlay');
            const popup = document.querySelector('#added-popup');
            const closePopup = document.querySelector('#added-closePopup');
            const body = document.body; // Assuming your swiper is a child of the body


            // Function to open the popup
            function openPopup() {
                overlay.style.display = 'block';
                popup.style.display = 'block';
                body.classList.add('popup-open'); // Add a class to the body
            }

            // Function to close the popup
            function closePopupFunction() {
                overlay.style.display = 'none';
                popup.style.display = 'none';
                body.classList.remove('popup-open'); // Remove the class from the body
            }

            // Event listener for the close button
            closePopup.addEventListener('click', closePopupFunction);

            // Event listener for clicking outside the popup to close it
            overlay.addEventListener('click', function (event) {
                if (event.target === overlay) {
                    closePopupFunction();
                }
            });

            openPopup();
            <?php unset($_SESSION['message']); ?>
        
        });
        
        <?php else : ?>
        <?php endif; ?>
    </script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper_thumb", {
            spaceBetween: 10,
            slidesPerView: 4,
            speed: 300,
            // loop: true,
            freeMode: true,
            watchSlidesProgress: true,
            ClickAble: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
        
        var swiper2 = new Swiper(".swiper_large_preview", {
            spaceBetween: 10,
            slidesPerView: 1,
            speed: 0,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
</body>