<?php

include('conn.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the image file is empty
    if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {
        // Read the image data
        $filedata = file_get_contents($_FILES['image']['tmp_name']);
        
        // Escape the data to prevent SQL injection
        $filedata = mysqli_real_escape_string($conn, $filedata);

        // Update the user information in the database
        $updateSql = "UPDATE customer SET
            customer_profilePic = '$filedata'
            WHERE customer_id = '" . $_SESSION['customer_id'] . "'";

        if (mysqli_query($conn, $updateSql)) {
            echo "<script>alert('Profile Picture Updated Successfully.');</script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    } else {
        echo "<script>alert('Please upload a valid image file.');</script>";
    }

    if (isset($_POST['editFirstName'], $_POST['editLastName'], $_POST['editUsername'], $_POST['editPhoneNumber'], $_POST['editShippingAddress'], $_POST['editPostcode'], $_POST['editCityDistrict'], $_POST['editState'])) {

        // Sanitize and validate input (you can add more validation as needed)
        $firstName = mysqli_real_escape_string($conn, $_POST['editFirstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['editLastName']);
        $username = mysqli_real_escape_string($conn, $_POST['editUsername']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['editPhoneNumber']);
        $shippingAddress = mysqli_real_escape_string($conn, $_POST['editShippingAddress']);
        $postcode = mysqli_real_escape_string($conn, $_POST['editPostcode']);
        $cityDistrict = mysqli_real_escape_string($conn, $_POST['editCityDistrict']);
        $state = mysqli_real_escape_string($conn, $_POST['editState']);

        // Update the user information in the database
        $updateSql = "UPDATE customer SET
            customer_firstName = '$firstName',
            customer_lastName = '$lastName',
            username = '$username',
            customer_phoneNum = '$phoneNumber',
            customer_address = '$shippingAddress',
            customer_postcode = '$postcode',
            customer_district = '$cityDistrict',
            customer_state = '$state'
            WHERE customer_id = '" . $_SESSION['customer_id'] . "'";

        if (mysqli_query($conn, $updateSql)) {
            echo "<script>alert('Account Information Updated.');</script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

    echo "<script>location.replace('my-profile.php');</script>";
}

mysqli_close($conn);

?>
