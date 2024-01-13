<?php
require('config.php');
require('header.php');
require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <!-- google static icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="#">
</head>
<body>
    <div class="sectiontitle">
        <p>Testimonials</p>
    </div>

    <div class="testi-table">
        <table>
            <thead>
                <tr>
                    <th>Testimonial ID</th>
                    <th>Cust. Username</th>
                    <th>Product Name</th>
                    <th>Time Created</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT
            t.testimonial_id,
            c.username AS customer_username,
            p.product_name,
            t.testimonial_time AS time_created,
            t.testimonial_description,
            ti.image AS testimonial_img
            FROM
            testimonial t
            JOIN
            customer c ON t.customer_id = c.customer_id
            LEFT JOIN
            orders o ON t.customer_id = o.customer_id 
            LEFT JOIN
            order_details od ON o.order_id = od.order_id
            LEFT JOIN
            product p ON od.product_id = p.product_id
            LEFT JOIN
            testimonial_img ti ON t.testimonial_id = ti.testimonial_id
            ORDER BY
            t.testimonial_id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['testimonial_id'] . "</td>";
        echo "<td>" . $row['customer_username'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['time_created'] . "</td>";
        echo "<td>" . $row['testimonial_description'] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['testimonial_img']) . "' alt='Testimonial Image' style='max-width: 100px;'></td>";
        echo "<td><button onclick='deleteTestimonial(" . $row['testimonial_id'] . ")'>Delete</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No testimonials found.";
}
?>



            </tbody>
        </table>
    </div>
</body>
</html>
<?php 
require('footer.php');
?>