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
    <meta name="keywords" content="clothing, buy"> <!-- Separate keywords with commas -->
    <meta name="keywords" content="Prelovebyjosie, prelovebyjosie, clothing, ecommerce clothing">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        .actionBtn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .actionBtn:hover {
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

        .closeTestimonialImages {
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

<body id="page-top">
    <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Testimonials</h1>

            <!-- Testimonials Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Testimonials</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Testimonial ID</th>
                                    <th>Cust. Username</th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Time Created</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                            <?php
                                $sql = "SELECT
                                DISTINCT(t.testimonial_id),
                                c.username AS customer_username,
                                o.order_id,
                                o.order_date,
                                t.testimonial_time AS time_created,
                                t.testimonial_description
                                FROM
                                testimonial t
                                JOIN
                                customer c ON t.customer_id = c.customer_id
                                LEFT JOIN
                                orders o ON t.customer_id = o.customer_id AND t.order_id = o.order_id
                                LEFT JOIN
                                order_details od ON o.order_id = od.order_id
                                ORDER BY
                                t.testimonial_id DESC;";
                                
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['testimonial_id'] . "</td>";
                                        echo "<td>" . $row['customer_username'] . "</td>";
                                        echo "<td>" . $row['order_id'] . "</td>";
                                        echo "<td>" . $row['order_date'] . "</td>";
                                        echo "<td>" . $row['time_created'] . "</td>";
                                        echo "<td>" . $row['testimonial_description'] . "</td>";
                                        echo "<td>" . "<button class='actionBtn' id='view-action' name='view-btn' onclick='viewTestimonial(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                                        echo "<td>";
                                        echo "<button type='submit' name='deleteTestBtn' class='actionBtn' onclick='confirmDelete(" . $row['testimonial_id'] . ")'>Delete</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                
                                        echo "</table>";
                                    } else {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "No testimonials found.";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        <!-- overlay for testimonial images -->
        <div id="overlay" class="overlay"></div>
        <div id="testimonial-images" class="popup">
        <span class="closeTestimonialImages" onclick="closeTestimonialImages()">&times;</span>
            <div class="swiper-container">
                <div id="swiperWrapper" class="swiper-wrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <?php require('footer.php'); ?>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    function viewTestimonial(row) {
    var testId = row.testimonial_id;
    console.log(testId);

    // Clear previous images
    var swiperWrapperDiv = document.getElementById("swiperWrapper");
    swiperWrapperDiv.innerHTML = "";

    fetch(`fetch-testimonial-img.php?testimonial_id=${testId}`)
        .then(response => response.json())
        .then(data => {
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
            document.getElementById('testimonial-images').style.display = 'block';
        })
        .catch(error => console.error('Error fetching data:', error));
}

    // view images API Ends

    function confirmDelete(deleteTestimonialId) {
        var confirmDelete = confirm("Are you sure you want to delete this testimonial?");

        if (confirmDelete) {
            window.location.href="deleteTestimonial.php?testimonial_id=" + deleteTestimonialId;
        };
    }

    function closeTestimonialImages() {
        document.getElementById('testimonial-images').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    </script>
</body>
</html>