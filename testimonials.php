<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
    <title>Testimonial</title>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <main>
    <div class="background-container">
        <img src="assets/images/bg.jpg" alt="Background Image">
        <div class="center-text">
            Testimonial
        </div>
    </div>

    <div class="content-wrapper">
        <?php

        include('conn.php');

        // Fetch testimonials and associated images from the database
        $sql = "SELECT t.testimonial_id, t.testimonial_time, t.testimonial_description, c.username, c.customer_profilePic
                FROM testimonial t
                JOIN customer c ON t.customer_id = c.customer_id;";
        $result = mysqli_query($conn, $sql);

        // Display testimonials using a while loop
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="testimonial-container">';
            echo '  <div class="customer-info">';
            echo '    <img src="data:image/jpeg;base64,' . base64_encode($row['customer_profilePic']) . '" alt="Profile Picture">';
            echo '    <p>' . $row['username'] . '</p>';
            echo '  </div>';
            echo '  <div class="testimonial-content">';
            echo '    <div class="testimonial-date">Posted time: ' . $row['testimonial_time'] . '</div>';
            echo '    <div class="testimonial-review">"' . $row['testimonial_description'] . '"</div>';
            echo '    <div class="testimonial-separator"><hr class="dashed"></div>';

            $imgsql = "SELECT i.image FROM testimonial_img i 
                LEFT JOIN testimonial t ON i.testimonial_id = t.testimonial_id 
                WHERE t.testimonial_id = " . $row['testimonial_id'];

            $imgresult = mysqli_query($conn, $imgsql);

            echo '<div class="image-container">';
            while ($imgrow = mysqli_fetch_assoc($imgresult)) {
                $encodedImage = base64_encode($imgrow['image']);
                echo '<img src="data:image/jpeg;base64,' . $encodedImage . '" alt="Testimonial Image" onclick="openModal(\'data:image/jpeg;base64,' . $encodedImage . '\')">';
            }
            echo '</div>';
            
            echo '  </div>';
            echo '</div>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    </main>
    <?php
        include('footer.php');
    ?>
    <script src="script.js"></script>
</body>
</html>
