<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTestBtn'])) {
    // Get the testimonial ID from the form submission

$testimonialId = $_POST['testimonial_id'];

// Delete from testimonial_img first
$deleteTestimonialImgSql = "DELETE FROM testimonial_img WHERE testimonial_id = $testimonialId";

if ($conn->query($deleteTestimonialImgSql) === TRUE) {
    // Now, delete from testimonial
    $deleteTestimonialSql = "DELETE FROM testimonial WHERE testimonial_id = $testimonialId";

    if ($conn->query($deleteTestimonialSql) === TRUE) {
        echo "<script>alert('Testimonial deleted successfully.');</script>";
        header("Location: testimonials.php");
        exit();
    } else {
        echo "Error deleting testimonial: " . $conn->error;
    }
} else {
    echo "Error deleting testimonial images: " . $conn->error;
}
}
?>