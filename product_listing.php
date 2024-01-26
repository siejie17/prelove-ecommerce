<?php 
    session_start();
    include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
    <title>Browse Product</title>
</head>

<body>
    <?php
        include("navbar.php");
        include("conn.php");
    ?>
    
    <?php
        $cart_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        if (isset($_GET['type']) && isset($_GET['category'])){
            $type=mysqli_real_escape_string($conn, $_GET['type']);
            $category=mysqli_real_escape_string($conn, $_GET['category']);

            $text=mysqli_real_escape_string($conn,$_GET['text']);
            $decodedText = stripslashes(urldecode($text));

            $sql = "SELECT product.product_id, product.product_name, product.product_price, MIN(product_img.image) AS min_image 
                    FROM product JOIN product_img ON product.product_id = product_img.product_id JOIN `type` ON product.type_id = `type`.type_id JOIN category ON product.category_id = category.category_id 
                    WHERE product.type_id = $type AND product.category_id = $category AND product.product_status = 'available'";
            $sql.= " GROUP BY product.product_id, product.product_name, product.product_price";

            $result = mysqli_query($conn, $sql);
    ?>
            <section class="search-result">
                <h3 class=topic>Search result for <span><?php echo $decodedText;?></span></h3>
            </section>
            <div class="product-container">
    <?php   
            $count = 0;
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $count++;
                    if ($count % 4 != 0){
    ?>                  <a href="product_description.php?product_id=<?php echo $row['product_id']?>" class="product-descr">
                            <div class="box">
                                <img src="data:image/png;base64,<?php echo base64_encode($row['min_image'])?>" alt="Product image">
                                <p class="product-name"><?php echo $row['product_name']?></p>
                                <h3 class="price">RM <?php echo $row['product_price']?></h3>
                                <form action="addToCart2.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <input type="hidden" name="search_word" value="<?php echo urlencode($decodedText); ?>">
                                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                                    <button type="submit" class="add-to-cart" data-id="'.<?php echo $row['product_id'] ?>.'" >Add to Cart</button>
                                </form>
                            </div>
                        </a>
        <?php
                    }

                   else{?>
                        <a href="product_description.php?product_id=<?php echo $row['product_id']?>" class="product-descr">
                            <div class="box" id="last">  
                                <img src="data:image/png;base64,<?php echo base64_encode($row['min_image'])?>" alt="Product image">
                                <p class="product-name"><?php echo $row['product_name']?></p>
                                <h3 class="price">RM <?php echo $row['product_price']?></h3>
                                <form action="addToCart2.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <input type="hidden" name="search_word" value="<?php echo urlencode($decodedText); ?>">
                                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                                    <button type="submit" class="add-to-cart" data-id="'.<?php echo $row['product_id'] ?>.'" >Add to Cart</button>
                                </form>
                            </div>
                        </a>
                <?php }
                }
            }
            
            echo '</div>';?>
            <div id="added-overlay" class="added-overlay"></div>

            <div id="added-popup" class="added-popup">
                <p><?php echo $cart_message; ?></p>
                <button id="added-closePopup">Close</button>
            </div>
    <?php  }
        
        
    ?>

    <?php
        include("footer.php");
    ?>

    <script>
        <?php if (!empty($cart_message)) : ?>
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
            closePopup.addEventListener('click', closePopupFunction);

            // Event listener for clicking outside the popup to close it
            overlay.addEventListener('click', function (event) {
                if (event.target === overlay) {
                    closePopupFunction();
                }
            });

            // Display the popup when the page loads
            openPopup();
            <?php unset($_SESSION['message']); ?>
        
        });
        
        <?php else : ?>
        <?php endif; ?>
    </script>
    <script src="script.js"></script>
</body>