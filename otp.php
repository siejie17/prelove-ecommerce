<?php
    session_start();

    include("conn.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verify_otp"])) {
        $otp1 = $_POST["otp1"];
        $otp2 = $_POST["otp2"];
        $otp3 = $_POST["otp3"];
        $otp4 = $_POST["otp4"];
        $otp5 = $_POST["otp5"];
        $otp6 = $_POST["otp6"];
    
        $enteredOTP = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

        if ($enteredOTP == $_SESSION['otp']) {
            $firstName = $_SESSION["registration_data"]["first_name"];
            $lastName = $_SESSION["registration_data"]["last_name"];
            $username = $_SESSION["registration_data"]["username"];
            $email = $_SESSION["registration_data"]["email"];
            $password = $_SESSION["registration_data"]["password"];
            $phone = $_SESSION["registration_data"]["phone"];
            $address = $_SESSION["registration_data"]["shipping_address"];
            $postcode = $_SESSION["registration_data"]["postcode"];
            $city = $_SESSION["registration_data"]["city"];
            $state = $_SESSION["registration_data"]["state"];
            $country = $_SESSION["registration_data"]["country"];
            $profile_pic = file_get_contents("assets/images/user.png");
            $profile_pic = mysqli_real_escape_string($conn, $profile_pic);

            $sql = "INSERT INTO customer (customer_email, customer_password, customer_profilePic, username, customer_firstName, customer_lastName, customer_phoneNum, customer_address, customer_postcode, customer_district, customer_state, customer_country)
                VALUES ('$email', '$password', '$profile_pic', '$username', '$firstName', '$lastName', '$phone', '$address', '$postcode', '$city', '$state', '$country')";

            if (mysqli_query($conn, $sql)) {
                session_unset();
                session_destroy();
                echo '<script>alert("Account created successfully!");
                    location.replace("login.php");</script>';
            } else {
                echo '<script>alert("Error creating account: ' . mysqli_error($conn) . '");</script>';
            }
        } else {
            echo '<script>alert("Invalid OTP. Please try again.");</script>';
        }
    }

    function otpGeneration() {
        // Generate and send OTP through EmailJS
        $otp = rand(100000, 999999);

        $_SESSION['otp'] = $otp;

        // Send OTP through EmailJS
        echo '<script src="https://cdn.emailjs.com/dist/email.min.js"></script>';
        echo '<script>';
        echo 'emailjs.init("qlS0RDCH9l_vU1A5Q");';
        echo 'var templateParams = {';
        echo '  email_address: "' . $_SESSION["registration_data"]["email"] . '",';
        echo '  verification_code: ' . $otp . ',';
        echo '};';
        echo 'emailjs.send("service_c0qw7oe", "template_1ueyo8a", templateParams)';
        echo '.then(';
        echo '  function(response) {';
        echo '    console.log("Email sent successfully:", response);';
        echo '  },';
        echo '  function(error) {';
        echo '    console.error("Email sending failed:", error);';
        echo '  }';
        echo ');';
        echo '</script>';
    }

    if (!isset($_SESSION['otp']) || ($_SERVER["REQUEST_METHOD"] != "POST") || ($enteredOTP != $_SESSION['otp'])) {
        $email = $_SESSION["registration_data"]["email"];
        $checkSQL = "SELECT * FROM customer WHERE customer_email = ?";
        $checkStmt = mysqli_prepare($conn, $checkSQL);
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);
    
        if (mysqli_stmt_num_rows($checkStmt) == 0) {
            otpGeneration();
        } else {
            session_unset();
            session_destroy();
            echo '<script>
                alert("An account with this email already exists. Please log in.");
                location.replace("login.php");
              </script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>OTP Verification</title>
    <style>
        .otp {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F4F6F6;
        }

        :where(.otp-container, form, .otp-input-field, header) {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .otp-container {
            background: #ffffff;
            padding: 30px 65px;
            border-radius: 12px;
            row-gap: 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .otp-container header {
            height: 30px;
            width: 200px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .otp-container h5 {
            font-size: 12px;
            font-weight: 500;
            margin: -10px 0;
        }

        form .otp-input-field {
            flex-direction: row;
            column-gap: 10px;
        }

        .otp-input-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .otp-input-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-input-field input::-webkit-inner-spin-button,
        .otp-input-field input::-webkit-outer-spin-button {
            display: none;
        }

        form .otp-button {
            margin-top: 25px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            border: none;
            padding: 9px 0;
            cursor: pointer;
            border-radius: 6px;
            pointer-events: none;
            background: #6e93f7;
            transition: all 0.2s ease;
        }

        form .otp-button.active {
            background: #4070f4;
            pointer-events: auto;
        }

        form .otp-button:hover {
            background: #0e4bf1;
        }

        h5 a {
            color: #007bff;;
            text-decoration: none;
            transition: color 0.2s, text-decoration 0.2s;
        }

        h5 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="otp">
        <div class="otp-container">
            <header>
                Verify Your Account
            </header>
            <h5>We emailed you the six digit code to your email: <?php $_SESSION['registration_data']['email'] ?></h5>
            <h5>Please enter the code below to confirm your email address.</h5>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="otp-input-field">
                    <input type="number" name="otp1" class="otp-num"/>
                    <input type="number" name="otp2" class="otp-num" disabled />
                    <input type="number" name="otp3" class="otp-num" disabled />
                    <input type="number" name="otp4" class="otp-num" disabled />
                    <input type="number" name="otp5" class="otp-num" disabled />
                    <input type="number" name="otp6" class="otp-num" disabled />
                </div>
                <button class="otp-button" name="verify_otp">Verify OTP</button>
            </form>
            <!-- <h5>Didn't Receive OTP? <a href="#">Resend</a></h5> -->
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll("input");
        const button = document.querySelector("button");
    
        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

                if(currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                if(nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if(e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if(index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }

                if(!inputs[5].disabled && inputs[5].value !== "") {
                    button.classList.add("active");
                    return;
                }
                button.classList.remove("active");
            });
        });

        window.addEventListener("load", () => inputs[0].focus());
    </script>
</body>
</html>