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
    <title>My Profile</title>
    <style>
        .profile-container {
            background-color: white;
            overflow: hidden;
            display: flex;
            margin-bottom: 30px;
        }

        .left-section {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #ddd;
            margin-left: 120px;
            margin-right: 20px;
            max-width: 350px; 
        }

        .right-section {
            flex: 2;
            padding: 60px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #ddd;
            margin-left: 20px;
            margin-right: 120px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px; /* Add margin to separate the button row from the profile picture row */
        }

        .profile-picture {
            height: 250px;
            width: 250px;
            border-radius: 50%;
            object-fit: cover;
        }

        .inline-upload {
            display: flex;
            align-items: center; /* Align items vertically in the center */
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: rgba(184,142,47,0.25);
            color: black;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid black;
            cursor: pointer;
            width: 220px;
            padding: 10px;
            text-align: center;
        }

        #full-button {
            width: 100%;
            max-width: 220px;
        }

        #profile-pic-input {
            display: none;
        }

        .user-info-row {
            display: flex;
            gap: 20px;
            align-items: center;
            font-size: 18px;
        }

        .label {
            font-weight: bold;
            width: 155px; /* Adjust the width as needed */
        }

        .user-info {
            flex: 1;
        }

        .editprofile {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto; /* Prevent scrolling */
        }

        .ep-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .ep-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .ep-form {
            display: grid;
            gap: 10px;
        }

        .ep-label {
            font-weight: bold;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        .editForm {
            padding: 20px 10px;
        }

        .ep {
            padding: 5px 0;
        }

        .subtitle {
            padding: 30px 120px;
            font-size: 20px;
        }

        .edit {
            max-width: 60px;
            width: 100%;
            background-color: blue;
            margin-top: 10px;
            margin-left: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border-radius: 5px;
        }

        .small-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: rgba(184,142,47,0.25);
            color: black;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid black;
            cursor: pointer;
            width: 150px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    include('navbar.php');
    include('conn.php');

    // Fetch profile picture from the database (replace 'your_table' and 'your_username' accordingly)
    $sql = "SELECT * FROM customer WHERE customer_id = ' " . $_SESSION['customer_id'] . " ' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profilePicture = $row['customer_profilePic'];
        echo '<main>
            <div class="background-container">
                <img src="assets/images/bg.jpg" alt="Background Image">
                <div class="center-text">
                    <h1>My Account</h1>
                </div>
            </div>
            <div class="subtitle"><h3>Profile Information</h3></div>
                <div class="profile-container">
                <div class="left-section">
                    <div class="profile-section">
                        <img class="profile-picture" src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" alt="Profile Picture">
                    </div>
                    <div class="button-section">
                        <form method="post" action="editProfile.php" enctype="multipart/form-data">
                            <div class="inline-upload">
                                <label for="profile-pic-input" class="small-button">Edit Profile Pic</label>
                                <input type="file" id="profile-pic-input" name="image" accept="image/*" style="display:none;">
                                <button class="edit" type="submit" name="upload">Update</button>
                            </div>
                        </form>
                        <a class="button" id="full-button" href="#" onclick="openPersonalInfoForm()">Edit Personal Information</a>
                    </div>
                </div>
                <div class="right-section">
                    <div class="user-info-row">
                        <div class="label">First Name:</div>
                        <div class="user-info">' . $row['customer_firstName'] . '</div>
                        <div class="label">Last Name:</div>
                        <div class="user-info">' . $row['customer_lastName'] . '</div>
                    </div>
                    <div class="user-info-row">
                        <div class="label">Username:</div>
                        <div class="user-info">' . $row['username'] . '</div>
                        <div class="label">Email Address:</div>
                        <div class="user-info">' . $row['customer_email'] . '</div>
                    </div>
                    <div class="user-info-row">
                        <div class="label">Phone Number:</div>
                        <div class="user-info">' . $row['customer_phoneNum'] . '</div>
                    </div>
                    <div class="user-info-row">
                        <div class="label">Shipping Address:</div>
                        <div class="user-info">' . $row['customer_address'] . '</div>
                    </div>
                    <div class="user-info-row">
                        <div class="label">Postcode:</div>
                        <div class="user-info">' . $row['customer_postcode'] . '</div>
                        <div class="label">City/District:</div>
                        <div class="user-info">' . $row['customer_district'] . '</div>
                    </div>
                    <div class="user-info-row">
                        <div class="label">State:</div>
                        <div class="user-info">' . $row['customer_state'] . '</div>
                        <div class="label">Country:</div>
                        <div class="user-info">' . $row['customer_country'] . '</div>
                    </div>
                </div>
            </div>
            
            <!-- Add this HTML block at the end of the body -->
    <div id="editFormModal" class="editprofile">
    <div class="ep-modal-content">
        <span class="ep-close" onclick="closeEditFormModal()">&times;</span>
        <h2>Edit Personal Information</h2>
        <form id="editForm" class="editForm" action="editProfile.php" method="post">
            <!-- Input fields for editing user information -->
            <div class="ep">
                <label for="editFirstName" class="ep-label">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" required>
            </div>

            <div class="ep">
                <label for="editLastName" class="ep-label">Last Name:</label>
                <input type="text" id="editLastName" name="editLastName" required>
            </div>

            <div class="ep">
                <label for="editUsername" class="ep-label">Username:</label>
                <input type="text" id="editUsername" name="editUsername" required>
            </div>

            <div class="ep">
                <label for="editEmail" class="ep-label">Email Address:</label>
                <input type="email" id="editEmail" name="editEmail" readonly>
            </div>

            <div class="ep">
                <label for="editPhoneNumber" class="ep-label">Phone Number:</label>
                <input type="tel" id="editPhoneNumber" name="editPhoneNumber" required>
            </div>

            <div class="ep">
                <label for="editShippingAddress" class="ep-label">Shipping Address:</label>
                <input type="text" id="editShippingAddress" name="editShippingAddress" required>
            </div>

            <div class="ep">
                <label for="editPostcode" class="ep-label">Postcode:</label>
                <input type="text" id="editPostcode" name="editPostcode" required>
            </div>

            <div class="ep">
                <label for="editCityDistrict" class="ep-label">City/District:</label>
                <input type="text" id="editCityDistrict" name="editCityDistrict" required>
            </div>

            <div class="ep">
                <label for="editState" class="ep-label">State:</label>
                <select id="editState" name="editState" required>
                    <!-- Add options dynamically if needed -->
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="ep">
                <label for="editCountry" class="ep-label">Country:</label>
                <input type="text" id="editCountry" name="editCountry" readonly>
            </div>

            <input type="submit" value="Save Changes">
        </form>
    </div>
</div></main>
';
    } else {
        echo "No results found.";
    }

    include('footer.php');

    mysqli_close($conn);
    ?>

    <script>

    function openPersonalInfoForm() {
        document.getElementById('editFirstName').value = '<?php echo $row['customer_firstName']; ?>';
        document.getElementById('editLastName').value = '<?php echo $row['customer_lastName']; ?>';
        document.getElementById('editUsername').value = '<?php echo $row['username']; ?>';
        document.getElementById('editEmail').value = '<?php echo $row['customer_email']; ?>';
        document.getElementById('editPhoneNumber').value = '<?php echo $row['customer_phoneNum']; ?>';
        document.getElementById('editShippingAddress').value = '<?php echo $row['customer_address']; ?>';
        document.getElementById('editPostcode').value = '<?php echo $row['customer_postcode']; ?>';
        document.getElementById('editCityDistrict').value = '<?php echo $row['customer_district']; ?>';
        document.getElementById('editState').value = '<?php echo $row['customer_state']; ?>';
        document.getElementById('editCountry').value = '<?php echo $row['customer_country']; ?>';

        // Display the modal
        document.getElementById('editFormModal').style.display = 'block';
    }

    function closeEditFormModal() {
        // Close the modal
        document.getElementById('editFormModal').style.display = 'none';
    }
    </script>
    <script src="script.js"></script>
</body>
</html>