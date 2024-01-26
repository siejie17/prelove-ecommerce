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
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="search.css"/>
    

    <title>Browse product</title>
    <style>
        .checkout{
            text-align: center;   
        }

        .topic {
            display: inline-block; /* Ensures that text-align works */
            background-color: #f2f2f2; /* Optional: Add a background color for better visibility */
            padding: 10px;
            border-radius: 5px;
        }

        .checkout-container{
            margin-top: 30px;
            padding:0 80px;
        }

        .title{
            margin-bottom: 40px;
        }

        .fee{
            
            margin:30px 0 30px 30px;  
        }

        h2, h3{
            display:inline;
        }

        .checkout-container{
            display:flex;
            flex-direction:column;
            height: auto;
            width: 1184px;
            margin: 50px auto;
        }

        .button-container{
            display:flex;
            justify-content: space-between;
            width:100%;
            margin:30px 0;

        }

        .cancel, .confirm{
            height: 40px;
            width: 200px;
            /* margin: 15px 0x 0px 0px; */
            padding: 0 10px;
            border:3px solid lightgrey;
            border-radius: 5px;
            cursor:pointer;
            color:white;
            background-color:blue;
        }

        .button-container .cancel{
            background-color:grey;
        }

        .reference{
            text-align:center;
        }
    </style>
</head>

<body>
    <?php
    header('Content-Type: text/html; charset=utf-8');
        include("navbar.php");
        //include("conn.php");
        echo'<main class="content">';
    ?>

    <section class="checkout">
            <h3 class=topic>Checkout</h3>
    </section>
    <!-- <h1 class="checkout">Checkout</h1> -->

    <?php
        // $order_message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        function calculateShipping($weight, $state){
                $shippingRate=[
                    'Sabah' =>[
                        '0.5' => 15.9,
                        '1.0' => 15.9,
                        '1.5' => 22.25,
                        '2.0' => 28.6,
                        '2.5' => 35.0,
                        '3.0' => 41.35,
                        '3.5' => 47.7,
                        '4.0' => 54.05,
                        '4.5' => 60.4,
                        '5.0' => 66.8,
                        '5.5' => 73.15,
                        '6.0' => 79.5,
                        '6.5' => 85.85,
                        '7.0' => 92.2,
                        '7.5' => 98.6,
                        '8.0' => 104.95,
                        '8.5' => 111.3,
                        '9.0' => 117.65,
                        '9.5' => 124.0,
                        '10.0' => 130.4,
                        '10.5' => 136.75,
                        '11.0' => 143.1,
                        '11.5' => 149.45,
                        '12.0' => 155.8,
                        '12.5' => 162.2,
                        '13.0' => 168.55,
                        '13.5' => 174.9,
                        '14.0' => 181.25,
                        '14.5' => 187.6,
                        '15.0' => 194.0,
                        '15.5' => 200.35,
                        '16.0' => 206.7,
                        '16.5' => 213.05,
                        '17.0' => 219.4,
                        '17.5' => 225.8,
                        '18.0' => 232.15,
                        '18.5' => 238.5,
                        '19.0' => 244.85,
                        '19.5' => 251.2,
                        '20.0' => 257.6,
                        '20.5' => 263.95,
                        '21.0' => 270.3,
                        '21.5' => 276.65,
                        '22.0' => 283.0,
                        '22.5' => 289.4,
                        '23.0' => 295.75,
                        '23.5' => 302.1,
                        '24.0' => 308.45,
                        '24.5' => 314.8,
                        '25.0' => 321.2,
                        '25.5' => 327.55,
                        '26.0' => 333.9,
                        '26.5' => 340.25,
                        '27.0' => 346.6,
                        '27.5' => 353.0,
                        '28.0' => 359.35,
                        '28.5' => 365.7,
                        '29.0' => 372.05,
                        '29.5' => 378.4,
                        '30.0' => 384.8,
                    ],

                    'Sarawak'=>[
                        '0.5' => 13.8,
                        '1.0' => 13.8,
                        '1.5' => 20.15,
                        '2.0' => 26.5,
                        '2.5' => 32.85,
                        '3.0' => 39.2,
                        '3.5' => 45.6,
                        '4.0' => 51.95,
                        '4.5' => 58.3,
                        '5.0' => 64.65,
                        '5.5' => 71.0,
                        '6.0' => 77.4,
                        '6.5' => 83.75,
                        '7.0' => 90.1,
                        '7.5' => 96.45,
                        '8.0' => 102.8,
                        '8.5' => 109.2,
                        '9.0' => 115.55,
                        '9.5' => 121.9,
                        '10.0' => 128.25,
                        '10.5' => 134.6,
                        '11.0' => 141.0,
                        '11.5' => 147.35,
                        '12.0' => 153.7,
                        '12.5' => 170.65,
                        '13.0' => 177.0,
                        '13.5' => 183.4,
                        '14.0' => 189.75,
                        '14.5' => 196.1,
                        '15.0' => 202.45,
                        '15.5' => 208.8,
                        '16.0' => 215.2,
                        '16.5' => 210.95,
                        '17.0' => 217.3,
                        '17.5' => 223.65,
                        '18.0' => 230.0,
                        '18.5' => 236.4,
                        '19.0' => 242.75,
                        '19.5' => 249.1,
                        '20.0' => 255.45,
                        '20.5' => 261.8,
                        '21.0' => 268.2,
                        '21.5' => 274.55,
                        '22.0' => 280.9,
                        '22.5' => 287.25,
                        '23.0' => 293.6,
                        '23.5' => 300.0,
                        '24.0' => 306.35,
                        '24.5' => 312.7,
                        '25.0' => 319.05,
                        '25.5' => 325.4,
                        '26.0' => 331.8,
                        '26.5' => 338.15,
                        '27.0' => 344.5,
                        '27.5' => 350.85,
                        '28.0' => 357.2,
                        '28.5' => 363.6,
                        '29.0' => 369.95,
                        '29.5' => 376.3,
                        '30.0' => 382.65,
                    ],

                    'default'=>[
                        '0.5' => 7.4,
                        '1.0' => 7.4,
                        '1.5' => 7.4,
                        '2.0' => 8.5,
                        '2.5' => 16.96,
                        '3.0' => 16.96,
                        '3.5' => 19.08,
                        '4.0' => 19.08,
                        '4.5' => 21.2,
                        '5.0' => 21.2,
                        '5.5' => 23.3,
                        '6.0' => 23.3,
                        '6.5' => 25.45,
                        '7.0' => 25.45,
                        '7.5' => 27.55,
                        '8.0' => 27.55,
                        '8.5' => 29.7,
                        '9.0' => 29.7,
                        '9.5' => 31.8,
                        '10.0' => 31.8,
                        '10.5' => 33.9,
                        '11.0' => 33.9,
                        '11.5' => 36.05,
                        '12.0' => 36.05,
                        '12.5' => 38.15,
                        '13.0' => 38.15,
                        '13.5' => 40.3,
                        '14.0' => 40.3,
                        '14.5' => 42.4,
                        '15.0' => 42.4,
                        '15.5' => 44.5,
                        '16.0' => 44.5,
                        '16.5' => 46.65,
                        '17.0' => 46.65,
                        '17.5' => 48.75,
                        '18.0' => 48.75,
                        '18.5' => 50.9,
                        '19.0' => 50.9,
                        '19.5' => 53.0,
                        '20.0' => 53.0,
                        '20.5' => 55.1,
                        '21.0' => 55.1,
                        '21.5' => 57.25,
                        '22.0' => 57.25,
                        '22.5' => 59.35,
                        '23.0' => 59.35,
                        '23.5' => 61.5,
                        '24.0' => 61.5,
                        '24.5' => 63.6,
                        '25.0' => 63.6,
                        '25.5' => 65.7,
                        '26.0' => 65.7,
                        '26.5' => 67.85,
                        '27.0' => 67.85,
                        '27.5' => 69.95,
                        '28.0' => 69.95,
                        '28.5' => 72.1,
                        '29.0' => 72.1,
                        '29.5' => 74.2,
                        '30.0' => 74.2,
                    ]
                ];

                

                // if (!isset($shippingRate[$state])) {
                //     $state = 'default';
                //     $weight=round($weight,3);
                // }
                // $stateRates = $shippingRate[$state];
                // Use the default rates if the state is not 'Sabah' or 'Sarawak'
                if (!in_array($state, ['Sabah', 'Sarawak'])) {
                    
                    $state='default';
                    // $stateRates = $shippingRate['default'];
                    
                    
                    // Find the appropriate rate based on the weight and 'default' state
                    foreach ($shippingRate[$state] as $upperWeight => $fee) {
                        $upperWeights = (float)$upperWeight;
                        $fees = (float)$fee;
                        // echo $upperWeights;
                        // echo $fee;
                        // var_dump($weight,$upperWeights);    
                        // echo '</br>';
                        
                        if ($weight <= $upperWeights) {
                            $rate = $fees;
                            // echo'</br>';
                            // echo $weight;
                            // echo $upperWeights;
                            // return $rate;
                            break;
                        }
                    }
                } else {
                    // Handle Sabah and Sarawak states here
                    // $stateRates = $shippingRate[$state];
                    foreach ($shippingRate[$state] as $upperWeight => $fee) {
                        $upperWeights = (float)$upperWeight;
                        $fees = (float)$fee;
                        if ($weight <= $upperWeights) {
                            $rate = $fees;
                            // echo $upperWeights;
                            break;
                        }
                    }
                }
                // Use the default rates if the state is not 'Sabah' or 'Sarawak'
                // if (!in_array($state, ['Sabah', 'Sarawak'])) {
                //     // $state = 'default';
                //     $stateRates = $shippingRate['default'];
                // } else {
                //     $stateRates = $shippingRate[$state];
                // }

                // $upperWeight=0.0;
                // $fee=0.0;
                //$shippingRate[$state]
                // foreach ($stateRates as $upperWeight => $fee) {
                //     $upperWeights=(float)$upperWeight;
                //     $fees=(float)$fee;
                //     if ($weight <= $upperWeights) {
                //         $rate = $fees;
                //         echo $upperWeights;
                //         break;
                //     }
                // }
                
                
                return $rate;
        }
        // Check if the 'data' parameter is set in the URL
        if (isset($_GET['data'])) {
            // Retrieve the JSON-encoded data from the URL and decode it
            $jsonData = urldecode($_GET['data']);
            $decodedData = json_decode($jsonData, true);
            $state=$_GET['state'];
            $total_price=0.0;
            // $total_rate=0;
            // $total_price_rate=0;
            $total_weight=0.0;
            // Check if the decoding was successful
            if ($decodedData !== null) {
                // Access the data as an associative array
                foreach ($decodedData as $item) {
                    $id = $item['id'];
                    $price = (float)$item['price'];
                    // $rate= $item['rate'];
                    // $price_rate= $item['subtotal'];
                    $weight = (float)$item['weight'];
                    // $state=$item['state'];
                    $total_price+=$price; 
                    // $total_rate+=$rate;
                    // $total_price_rate+=$price_rate;
                    $total_weight+= $weight;
                }

                $rate= calculateShipping($total_weight,$state);
                $total_price_rate=$total_price+$rate;
                
    ?>

                    
                    <!-- // Process or use the data as needed
                    // For example, you might insert it into a database, perform calculations, etc. -->
                    <!-- echo "ID: $id, Name: $name, Price: $price, Weight: $weight, Quantity: $quantity<br>";
                    echo '<script>';
                    echo 'console.log(' . $id . ');'; // Use json_encode to handle escaping
                    echo '</script>'; -->
        
        <div class="checkout-container">
            <div class="title"><strong><h2>Order Summary:</h2></strong></div>
            <div class="fee"><h3>Subtotal (excluding shipping fee): RM <h2><?php echo $total_price; ?></h2><h3></div>
            <div class="fee"><h3>Total Weight:  <h2><?php echo $total_weight; ?></h2> kg</h3></div> 
            <div class="fee"><h3>Shipping Fee: RM <h2><?php echo $rate; ?></h2></h3></div> 
            <div class="fee"><h3>Order Total: RM <h2><?php echo $total_price_rate; ?></h2></h3></div>
            <a href="https://www.mycourier.my/jt-rate-jt-shipping-rate/" target="_blank" class="reference">Shipping fee reference</a>
            <!-- <button  -->
            <div class="button-container">
            <a href="cart.php" >
            <button type="button" class="cancel">Cancel Checkout</button>
            </a>

            <form id="form_submission" action="order.php" method="post">
                <input type="hidden" name="data" value="<?php echo htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8');; ?>">
                <input type="hidden" name="rate" value="<?php echo $rate; ?>">
                <input type="hidden" name="total_price_rate" value="<?php echo $total_price_rate; ?>">
                <input type="hidden" class="date" name="date" value="">
                <button type="button" class="confirm" onclick="placeOrder()">Place Order</button>
            </form>
            </div>
        </div>
                            
    <?php 
            } else {
                echo "Error decoding JSON data.";
            }
        } else {
            echo "No data parameter found in the URL.";
        }

        
        
    ?>
    
    
    <?php
        echo'</main>';
        include("footer.php");
    ?>

<script src="script.js"></script>
<script>
    function placeOrder(){
        var confirmOrder =confirm("Are you sure you want to place an order");

        if (confirmOrder){
            var currentDate=new Date();
            
            // Specify the desired options for date and time
            var options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false, // Use 24-hour format
                timeZone: 'Asia/Kuala_Lumpur' // Specify the desired time zone, e.g., 'UTC' or 'Asia/Kuala_Lumpur'
            };

            // Format the date using Intl.DateTimeFormat
            var formattedDate = new Intl.DateTimeFormat('en-GB', options).format(currentDate);

            // Extract the time portion
            var time = formattedDate.slice(11, 19);
            

            // console.log('Formatted Date:', formattedDate);
        // Format the date using the specified options
        // var formattedDate = currentDate.toLocaleString('en-GB', );
        //    var date=currentDate.toLocaleString().slice(0,19).replace('T',' ');
            document.querySelector(".date").value=formattedDate;
            // var malaysiaTime = new Date(currentDate);
            // malaysiaTime.setHours(malaysiaTime.getHours() + 8); // Adjust for Malaysia Time (UTC+8)
        //     console.log('Formatted Date:', formattedDate);
        //     setTimeout(function () {
        //     document.querySelector("#form_submission").submit();
        // }, 5000);
            // var formattedDate = malaysiaTime.toLocaleString('en-GB', {
            // year: 'numeric',
            // month: '2-digit',
            // day: '2-digit',
            // hour: '2-digit',
            // minute: '2-digit',
            // second: '2-digit',
            // timeZone: 'Asia/Kuala_Lumpur' // Set the time zone to Malaysia
            // });

            // document.querySelector(".date").value = formattedDate;

            document.querySelector("#form_submission").submit();
            document.querySelector("#form_submission").addEventListener('submit', function (event) {
            console.log("Form submitted");
    });
        }
        else{}
    }

    
</script>

</body>
</html>