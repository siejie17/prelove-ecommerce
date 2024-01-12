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
    <link rel="stylesheet" href="style1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="search.css"/>
    <title>Cart</title>
    <style>

.cart-container {
    max-width: 1184px;
    margin: 100px auto 20px auto;
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

.cart-item img {
    max-width: 130px;
    max-height: 200px;
    margin-right:10px;
}

.cart-header > div, .cart-item > div {
        /* Set specific widths for each column */
        flex: 1; /* Equal width for all columns */
        max-width: 150px; /* Adjust the max-width as needed */
        text-align: center; /* Center the text */
    }

#checkoutBtn {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    cursor: pointer;
    margin-right:10px;
}

.priceTitle{
    margin-left:10px;
}

.cart-item input[type="checkbox"] {
        transform: scale(2); /* Adjust the scale factor as needed */
    }

.extra-info{
    text-align:center;
    margin-bottom: 20px;
}
/* 
.round label {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 50%;
  cursor: pointer;
  height: 28px;
  left: 0;
  position: absolute;
  top: 0;
  width: 28px;
}

.round label:after {
  border: 2px solid #fff;
  border-top: none;
  border-right: none;
  content: "";
  height: 6px;
  left: 7px;
  opacity: 0;
  position: absolute;
  top: 8px;
  transform: rotate(-45deg);
  width: 12px;
}

.round input[type="checkbox"] {
  visibility: hidden;
}

.round input[type="checkbox"]:checked + label {
  background-color: #66bb6a;
  border-color: #66bb6a;
}

.round input[type="checkbox"]:checked + label:after {
  opacity: 1; */ */
/* } */

    </style>
</head>
<body>
    <?php
        include("navbar.php");
        echo'<main class="content">';
    ?>
    
    <div class="cart-container">
        <div class="cart-header">
            <div class="select">Select</div>
            <div>Product Image</div>
            <div>Name</div>
            <div>Weight</div>
            <div>Price</div>
            <div>Quantity</div>
            <div>Subtotal</div>
            <div>Remove</div>
        </div>

        <?php
            
            $cart_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
            if (isset($_SESSION['customer_id'])){
                $customer_id=mysqli_real_escape_string($conn,$_SESSION['customer_id']);
                $sql="SELECT cart.cart_id, cart.product_id, product.product_name, product.product_price, product.product_weight, min(product_img.image) AS min_image FROM cart JOIN product ON cart.product_id= product.product_id JOIN product_img ON cart.product_id =  product_img.product_id WHERE cart.user_id = $customer_id GROUP BY cart.cart_id, cart.product_id, product.product_name, product.product_price, product.product_weight";
                $personal_detail="SELECT customer_state FROM customer WHERE customer_id=$customer_id";
                $result=mysqli_query($conn,$sql);
                $result1=mysqli_query($conn,$personal_detail);
                $row1=mysqli_fetch_assoc($result1);

                if($result->num_rows >0){
                    while($row=mysqli_fetch_assoc($result)){
                        // $rate= (float)calculateShipping($row['product_weight'],$row1['customer_state']);
                        $prices=(float)$row['product_price'];
                        $subtotal=$prices;
                        echo '<div class="cart-item" data-id="' . $row['product_id'] . '" data-name="' . $row['product_name'] . '" data-price="' . $row['product_price'] . '" data-weight="' . $row['product_weight'] . '" >';
                        echo '<div class="round">';
                        echo '<div><input type="checkbox" class="selectCheckbox" data-id="' . $row['product_id'] .'"data-price="'. $prices.'"  data-subtotal="'.$subtotal.'" data-weight="' . $row['product_weight'] . '" data-state="'.$row1['customer_state'].'"></div>';
                        // echo '<label for="checkbox" '. $row['product_id'] . '"></label>';
                        echo '</div>';
                        echo '<div><img src="data:image/png;base64,'.base64_encode($row['min_image']) . '" alt="' . $row['product_name'] . '"></div>';
                        echo '<div>' . $row['product_name'] . '</div>';
                        echo '<div>' . $row['product_weight'] . '</div>';
                        echo '<div>RM ' . $row['product_price'] . '</div>';
                        echo '<div>' . '1'. '</div>';
                        echo '<div>RM ' . $subtotal . '</div>';
                        echo '<div><button class="removeBtn" data-id="'. $row['product_id'].'"><h1>-</h1></button></div>';
                        echo '</div>';      
                        
                    }
                }

                else{echo'<div>There is no item in the cart</div>';}

            }
        ?>

        <!-- <div class="cart-item" data-id="${item.id}"> -->
            <!-- Item details go here -->
            <!-- <div><input type="checkbox" class="selectCheckbox" data-id="${item.id}"></div>
            <div><img src="assets/images/h2_1.jpg" alt="image"></div>
            <div>Hoodie</div>
            <div>RM 50</div>
            <div>1</div>
            <div>50</div>
            <div><button class="removeBtn">Remove</button></div>
        </div> -->

        <!-- <div class="cart-item" data-id="2"> -->
            <!-- Another item details go here -->
        <!-- </div> -->
        <!-- Add more cart items as needed -->

        <div class="checkout-section">
            <!-- <label for="itemSelect">Select Item:</label>
            <select id="itemSelect"> -->
                <!-- Options populated dynamically using JavaScript -->
            <!-- </select> -->
            <div class="priceTitle">Total Price: RM <span id="totalPrice">0</span></div>
            <button id="checkoutBtn" data-state=<?php echo $row1['customer_state'];?>>Checkout</button>
        </div>
        
        
    </div>

    <div class="extra-info">
        <h4>***Every item only has a quantity of 1</h4>
        <a href="https://www.mycourier.my/jt-rate-jt-shipping-rate/" target="_blank">Shipping fee reference</div>
    </div>

    <div id="added-overlay" class="added-overlay"></div>

    <div id="added-popup" class="added-popup">
        <p><?php echo $cart_message ?></p>
        <button id="added-closePopup">Close</button>
    </div>
    <?php
        echo'</main>';
    ?>

    <?php
        include("footer.php");
    ?>
    
    <script src="script.js"></script>
    <script>
    const totalPriceElement = document.getElementById('totalPrice');
    const checkoutBtn = document.getElementById('checkoutBtn');

    // Calculate and update total price on checkbox change
    function updateTotalPrice() {
        const selectedItems = document.querySelectorAll('.cart-item input:checked');
        let totalPrice = 0;

        selectedItems.forEach(item => {
            const itemId = parseInt(item.dataset.id);
            const selectedItemPrice = parseFloat(item.dataset.subtotal);
            // const selectedItem = items.find(item => item.id === itemId);
            if (!isNaN(itemId) && !isNaN(selectedItemPrice)) {
                    totalPrice += selectedItemPrice;
                }
        });

        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    // Checkout button click event
    // checkoutBtn.addEventListener('click', function () {
    //     const selectedItems = document.querySelectorAll('.cart-item input:checked');

    //     if (selectedItems.length > 0) {
    //         let checkoutMessage = 'Checkout:\n';

    //         selectedItems.forEach(item => {
    //             const itemId = parseInt(item.dataset.id);
    //             const selectedItem = items.find(item => item.id === itemId);
    //             if (selectedItem) {
    //                 checkoutMessage += `${selectedItem.name} - Total Price: ${selectedItem.price * selectedItem.quantity}\n`;
    //             }
    //         });

    //         alert(checkoutMessage);
    //     } else {
    //         alert('Please select items to checkout.');
    //     }
    // });

    checkoutBtn.addEventListener('click', function () {
            const selectedItems = document.querySelectorAll('.cart-item input:checked');

            if (selectedItems.length > 0) {
                // Collect data for selected items
                const selectedData = [];

                selectedItems.forEach(item => {
                    const data = {
                        id: parseInt(item.dataset.id),
                        // name: item.dataset.name, 
                        price: parseFloat(item.dataset.price),
                        // rate: parseFloat(item.dataset.rate),
                        // subtotal: parseFloat(item.dataset.subtotal),
                        weight: parseFloat(item.dataset.weight),
                        // state: (item.dataset.state)
                    }; 
 
                    if (!isNaN(data.id) && !isNaN(data.price) && !isNaN(data.weight)) {
                        selectedData.push(data);
                    }
                    
                });
                // $state=checkbox.dataset.state;
                // Convert data to JSON string
                const jsonData = JSON.stringify(selectedData);
                const state = checkoutBtn.dataset.state;
                // Pass data to the next page using URL parameters
                window.location.href = 'checkout.php?data=' + encodeURIComponent(jsonData)+'&state='+encodeURIComponent(state);
            } else {
                alert('Please select items to checkout.');
            }
        });

    // Populate cart items dynamically using JavaScript
    // const cartContainer = document.querySelector('.cart-container');
    // items.forEach(item => {
    //     const cartItem = document.createElement('div');
    //     cartItem.classList.add('cart-item');
    //     cartItem.dataset.id = item.id;

    //     cartItem.innerHTML = `
    //         <div><img src="${item.image}" alt="${item.name}"></div>
    //         <div>${item.name}</div>
    //         <div>${item.price}</div>
    //         <div>${item.quantity}</div>
    //         <div>${item.price * item.quantity}</div>
    //         <div><button class="removeBtn">Remove</button></div>
    //         <div><input type="checkbox" class="selectCheckbox" data-id="${item.id}"></div>
    //     `;

    //     cartContainer.appendChild(cartItem);
    // });

    // Add event listener to checkboxes for updating total price
    const checkboxes = document.querySelectorAll('.selectCheckbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    // Event listener for remove button
    const removeButtons = document.querySelectorAll('.removeBtn');
    removeButtons.forEach(removeBtn => {
        removeBtn.addEventListener('click', function () {

            const itemId = parseInt(this.closest('.cart-item').dataset.id);
            // const itemIndex = items.findIndex(item => item.id === itemId);

            // if (itemIndex !== -1) {
            //     items.splice(itemIndex, 1);
            //     this.closest('.cart-item').remove();
            //     updateTotalPrice();
            // }
            const userConfirmation = confirm("Are you sure you want to remove this item from the cart?");
            if (userConfirmation) {
                if (!isNaN(itemId)) {
                        // Implement your logic to remove the item from the database or update the UI as needed
                        this.closest('.cart-item').remove();
                        updateTotalPrice();
                        window.location.href = 'removeCart.php?id=' + itemId;
                    }
            } else {}
        });
    });



    </script> 
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
</body>
</html>