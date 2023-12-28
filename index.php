<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            height: 100%;
        }

        .latest-product-title {
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .latest-product {
            margin: 10px 100px;
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .l-product-list {
            overflow: hidden;
            position: relative;
            width: 300px;
            height: 350px;
        }

        .l-product-container {
            width: 100%;
            height: 100%;
        }

        .product_img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Small devices (tablets) */
        @media (max-width: 576px) {
            .l-product-container {
                width: 33.333333%;
            }
        }

        /* Medium devices (desktops) */
        @media (max-width: 768px) {
            .l-product-container {
                width: 33.333333%;
            }

            .banner-image {
                background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url(assets/images/banner.png);
                background-repeat:no-repeat;
                background-position:right;
                background-size:contain; 
            }
        }

        /* Large devices (large desktops) */
        @media (max-width: 992px) {
            .l-product-container {
                width: 25%;
            }
        }

        @media (max-width: 992px) {
            .hero-column {
                width: 100vw; /* col-md-12 corresponds to full width on medium screens */
            }
        }
    </style>
    <title>PrelovebyJosie</title>
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
                                        <a href="product.php?id=' .$product['product_id'] . '">
                                            <img src="data:image/jpeg;base64,' . base64_encode($product['product_image']) . '" alt="product images" class="product_img">
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