<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
    <style>
        .hero-container {
            padding: 5rem 15rem;
            height: 580px;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-image {
            background-image:url(assets/images/banner2.png);
            background-repeat:no-repeat;
            background-position:right;
            background-size:contain;
            height: 100%;
            width: 100%;
        }

        .hero-row {
            margin-top: 5rem;
            margin-bottom: 5rem;
        }

        .hero-column {
            width: 50%; /* col-lg-6 corresponds to 50% width on large screens */
            margin-right: auto; /* Auto margin for centering */
            padding-top: 5rem; /* Adjust the padding-top value */
            display: grid;
            flex-wrap: wrap;
            gap: 10px;
        }

        .system-name {
            color: #C1B688;
        }

        .slogan {
            font-size: 30px;
            font-weight: 500;
        }

        .shop-now-btn-container {
            width: 190px;
            height: 50px;
        }

        .shop-now-btn {
            background: url('assets/images/button.png') no-repeat;
            background-size: contain;
            color: #555555;
            padding: 10px 20px;
            border: none;
            cursor: default;
            font-weight: bold;
            width: 100%;
            height: 100%;
        }

        .latest-product-container {
            margin-bottom: 50px;
        }

        .latest-product-title {
            margin-bottom: 10px;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .latest-product {
            margin: 50px 100px 10px 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            gap: 20px;
        }

        .l-product-list {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .l-product {
            height: 100%;
            width: 100%;
        }

        .l-product-container {
            width: 300px;
            height: 500px;
        }

        .l-product-details {
            background-color: #F4F5F7;
            height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .l-product-name,
        .l-product-price {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product_img {
            display: block;
            transition: filter 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .index-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .l-product a {
            text-decoration: none;
            color: black;
        }

        .l-product-name {
            font-size: 16px;
            font-weight: bold;
        }

        .index-image-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            height: 80%;
        }

        .hover-button {
            padding: 5px;
            background-color: #FFFFFF;
            color: #B88E2F;
            font-size: 13px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            width: 180px;
            border-radius: 5px;
        }

        .index-image-container:hover .product_img {
            filter: brightness(0.7); /* Adjust the brightness value for dimming effect */
        }

        .index-image-container:hover .index-overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2); /* Adjust the scale value for button ease-in */
        }

        @media (max-width: 720px) {
            .latest-product {
                display: flex;
                flex-direction: column;
                width: 100%;
                height: 100%;
            }
        }

        /* Medium devices (desktops) */
        @media (max-width: 768px) {
            .banner-image {
                background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url(assets/images/banner.png);
                background-repeat:no-repeat;
                background-position:right;
                background-size:contain;
                height: 100%;
                width: 100%;
            }
        }

        @media (max-width: 992px) {
            .hero-column {
                width: 100vw; /* col-md-12 corresponds to full width on medium screens */
            }
        }
    </style>
    <title>PrelovebyJosie - Home</title>
</head>
<body>
    <?php include("navbar.php"); ?>
    <main>
        <div class="hero-container">
            <div class="banner-image">
                <div class="hero-row">
                    <div class="hero-column">
                        <h3 class="system-name">PrelovebyJosie E-commerce System</h3>
                        <p class="slogan">Every piece has a home.</p>
                        <div class="shop-now-btn-container"><button class="shop-now-btn">Shop Now</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="latest-product-container">
            <div class="latest-product-title">
                <h1>Latest Products</h1>
            </div>
            <div class="latest-product">
                <?php
                    include('conn.php');

                    $sql = "SELECT
                                p.product_id,
                                p.product_name,
                                p.product_price,
                                (
                                    SELECT pi.image
                                    FROM product_img pi
                                    WHERE pi.product_id = p.product_id
                                    LIMIT 1
                                ) AS product_image
                            FROM
                                product p
                            WHERE p.product_status = 'available'
                            ORDER BY p.product_id DESC
                            LIMIT 4;";
                    $products = mysqli_query($conn, $sql);

                    foreach($products as $product) {
                        echo '<div class="l-product-container">
                                <div class="l-product-list">
                                    <div class="l-product">
                                        <a href="product_description.php?product_id=' .$product['product_id'] . '">
                                        <div class="index-image-container">
                                            <img src="data:image/jpeg;base64,' . base64_encode($product['product_image']) . '" alt="product images" class="product_img">
                                            <div class="index-overlay">
                                                <button class="hover-button">View Product\'s Details</button>
                                            </div>
                                        </div>
                                            <div class="l-product-details">
                                                <div class="l-product-name">' . $product['product_name'] . ' </div>
                                                <div class="l-product-price">RM ' . $product['product_price'] . ' </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
    <script src="script.js"></script>
</body>
</html>