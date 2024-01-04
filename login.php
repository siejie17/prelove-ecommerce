<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<title>Login</title>
		<link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    	<style>
			.center{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 400px;
			background: white;
			border-radius: 50px;
			box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
            z-index: -1;
			}

			.center h1{
			text-align: center;
			padding: 20px 0;
			border-bottom: 1px solid silver;
			}

			.center form{
			padding: 0 40px;
			box-sizing: border-box;
			}

			form .txt_field{
			position: relative;
			border-bottom: 2px solid #adadad;
			margin: 30px 0;
			}

			.txt_field input{
			width: 100%;
			padding: 0 5px;
			height: 40px;
			font-size: 16px;
			border: none;
			background: none;
			outline: none;
			}

			.txt_field label{
			position: absolute;
			top: 50%;
			left: 5px;
			color: #adadad;
			transform: translateY(-50%);
			font-size: 16px;
			pointer-events: none;
			transition: .5s;
			}

			.txt_field span::before{
			content: '';
			position: absolute;
			top: 40px;
			left: 0;
			width: 0%;
			height: 2px;
			background: #2691d9;
			transition: .5s;
			}

			.txt_field input:focus ~ label,
			.txt_field input:valid ~ label{
			top: -5px;
			color: #2691d9;
			}

			.txt_field input:focus ~ span::before,
			.txt_field input:valid ~ span::before{
			width: 100%;
			}

			.pass{
			margin: -5px 0 20px 5px;
			color: #a6a6a6;
			cursor: pointer;
			}

			.pass:hover{
			text-decoration: underline;
			}

			button[type="submit"]{
			width: 100%;
			height: 50px;
			border: 1px solid;
			background: #2691d9;
			border-radius: 25px;
			font-size: 18px;
			color: #e9f4fb;
			font-weight: 700;
			cursor: pointer;
			outline: none;
			}

			button[type="submit"]:hover{
			border-color: #2691d9;
			transition: .5s;
			}

			.signup_link{
			margin: 30px 0;
			text-align: center;
			font-size: 16px;
			color: #666666;
			}

			.signup_link a{
			color: #2691d9;
			text-decoration: none;
			}

			.signup_link a:hover{
			text-decoration: underline;
			}

            .center #error-msg {
                color: red;
                padding: 5px;
            }
		</style>
        <script>
            // Check for error message in session storage
            window.onload = function() {
                var errorMsg = sessionStorage.getItem('loginErrorMsg');
                if (errorMsg) {
                    document.getElementById('error-msg').innerHTML = errorMsg;
                    sessionStorage.removeItem('loginErrorMsg'); // Clear the error message
                }
            };
        </script>
</head>
<body>
    <?php
        include('navbar.php');
        include('conn.php');

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_btn"])) {
            $email = $_POST["email"];
            $password = $_POST["pw"];

            $adminQuery = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$password'";
            $adminResult = mysqli_query($conn, $adminQuery);

            if (mysqli_num_rows($adminResult) > 0) {
                echo "<script> location.replace('admin/index.php'); </script>";
                exit();
            }

            $customerQuery = "SELECT * FROM customer WHERE customer_email = '$email' AND customer_password = '$password'";
            $customerResult = mysqli_query($conn, $customerQuery);

            if (mysqli_num_rows($customerResult) > 0) {
                $customerData = mysqli_fetch_assoc($customerResult);

                $_SESSION["customer_id"] = $customerData['customer_id'];

                echo "<script> location.replace('index.php'); </script>";
                exit();
            }

            echo "<script>sessionStorage.setItem('loginErrorMsg', 'Invalid email address or password.');</script>";
        }
    ?>

    <div class="login-container">
        <div class="center">
            <h1>Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="txt_field">
                <input type="text" name="email" required>
                <span></span>
                <label>Email Address</label>
            </div>
            <div class="txt_field">
                <input type="password" name="pw" required>
                <span></span>
                <label>Password</label>
            </div>
            <div id="error-msg"></div>
            <div class="pass">Forgot Password?</div>
            <button type="submit" name="submit_btn">Login</button>
            <div class="signup_link">
                Not a member? <a href="signup.php">Signup</a>
            </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>