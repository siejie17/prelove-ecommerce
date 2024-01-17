<?php 
session_start();
include('conn.php');
// $_SESSION['customer_id']=2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="search.css"/>
    

    <title>Browse product</title>
    <style>
/*         
        div{
            height: 160px;
            margin-top:80px;
            background-color:purple;
            border: 1px solid transparent;
        }

        .hello{
            margin-top: 100px;
            /* padding: 80px; */
        /* }  */
        .errorProd h1 {
        text-align: center;
    }
    </style>
</head>

<body>
    <?php
    header('Content-Type: text/html; charset=utf-8');
        include("navbar.php");
        //include("conn.php");
    ?>

    <?php
        $cart_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

        echo'<main class="content">';
    
        if (isset($_GET['search'])){
            $search_word=mysqli_real_escape_string($conn, $_GET['search']);

            $arr_keyword=explode(" ", $search_word);
            // $sql="SELECT product.product_id,product.product_name, product.product_price, product_img.product_id, product_img.image FROM product JOIN product_img ON product.product_id= product_img.product_id WHERE ";

            $sql="SELECT product.product_id, product.product_name, product.product_price, MIN(product_img.image) AS min_image FROM product JOIN product_img ON product.product_id = product_img.product_id WHERE product.product_status = 'available' AND (";

            foreach($arr_keyword as $index=>$keyword){
                if($index>0){
                    $sql.=" OR ";
                }

                $sql.= "product.product_name LIKE '%". mysqli_real_escape_string($conn,$keyword). "%'";
            }
            $sql.= ") GROUP BY product.product_id, product.product_name, product.product_price";
            $result=mysqli_query($conn,$sql);
    ?>
            <section class="search-result">
                <h3 class=topic>Search result for <span><?php echo $search_word;?></span></h3>
            </section>
            <div class="product-container">
    <?php   
            $count=0;
            if($result->num_rows >0){
                while($row=mysqli_fetch_assoc($result)){
                    $count++;
                    if ($count%4!=0){
    ?>                  
                        
                            <a href="product_description.php?product_id=<?php echo $row['product_id']?>" class="product-descr">
                                <div class="box">
                                    <img src="data:image/png;base64,<?php echo base64_encode($row['min_image'])?>" alt="Product image">
                                    <p class="product-name"><?php echo $row['product_name']?></p>
                                    <h3 class="price">RM <?php echo $row['product_price']?></h3>
                                    <form action="addToCart.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                        <input type="hidden" name="search_word" value="<?php echo $search_word; ?>">
                                        <button type="submit" class="add-to-cart" data-id="'.<?php echo $row['product_id'] ?>.'">Add to Cart</button>
                                    </form>
                                </div>
                            </a>

        <?php
                    }//if

                   else{?>
                        
                            <a href="product_description.php?product_id=<?php echo $row['product_id']?>" class="product-descr">
                                <div class="box" id="last">  
                                    <img src="data:image/png;base64,<?php echo base64_encode($row['min_image'])?>" alt="Product image">
                                    <p class="product-name"><?php echo $row['product_name']?></p>
                                    <h3 class="price">RM <?php echo $row['product_price']?></h3>
                                    <form action="addToCart.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                        <input type="hidden" name="search_word" value="<?php echo $search_word; ?>">
                                        <button type="submit" class="add-to-cart" data-id="'.<?php echo $row['product_id'] ?>.'" >Add to Cart</button>
                                    </form>
                                </div>
                            </a>
                        
                        
               <?php } //else
               
                    }//while
            } //if
            
            if($result->num_rows <= 0){
                echo "<p class='errorProd'><h1>No matching product!!</h1></p>". mysqli_error($conn);
            }
            echo '</div>';
        }
        ?>
        <div id="added-overlay" class="added-overlay"></div>

        <div id="added-popup" class="added-popup">
            <p><?php echo $cart_message ?></p>
            <button id="added-closePopup">Close</button>
        </div>
        
    <?php
    echo'</main>';

    ?>

    <!-- <section class="search-result">
    //     <h3 class=topic>Search result for <span>product</span></h3>
    // </section>

    // <div class="product-container">
    //     <div class="box">
    //         <img src="assets/images/h2_1.jpg" alt="Product image">
    //         <p class="product-name">Hoodie #1</p>
    //         <h3 class="price">RM 50</h3>
    //         <form>
    //             <button class="add-to-cart">Add to Cart</button>
    //         </form>
    //     </div>

        
    // </div> -->

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
            // window.addEventListener('load', openPopup);
            openPopup();
            <?php unset($_SESSION['message']); ?>
        
        });
        
        <?php else : ?>
        <?php endif; ?>
    </script>
    <script src="script.js"></script>

</body>