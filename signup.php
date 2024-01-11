<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>SignUp</title>
    <style>
    .registration-form-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 10px 20px 20px 20px;
      max-width: 600px;
      margin: 20px auto;
      z-index: -2;
    }
    
    .input-fields {
      display: grid;
      padding: 10px 0 0 0;
      gap: 10px;
      position: relative;
      grid-template-columns: repeat(2, 1fr);
      grid-template-rows: repeat(6, auto);
    }

    #label {
      display: block;
      margin-bottom: 5px;
    }

    #first_name, #last_name, #username, #email_address, #pw, #confirm_pw, #phone_num, #shipping_address, #postcode, #city, #state, #country {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    /* Customize the third row to span two rows */
    .input-fields > div:nth-child(5) {
      grid-row: span 2;
    }

    /* Customize the fifth row to take the whole width */
    .input-fields > div:nth-child(8) {
      grid-column: span 2;
    }
    
    .requirement-list {
    	padding: 0;
    	margin-top: 10px;
    }
    
    .requirement-list li {
        list-style: none;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .requirement-list li i {
    	width: 20px;
        color: #aaa;
        font-size: 0.6rem;
    }
    
    .requirement-list li span {
    	margin-left: 12px;
        color: #333;
    }
    
    .requirement-list li.valid span {
    	color: #42D36B;
    }
    
    .pass-field i {
    	right: 53%;
        top: 33.2%;
        font-size: 1.2rem;
        color: #999;
        cursor: pointer;
        position: absolute;
        width: fit-content;
        transform: translateY(-50%);
    }
    
    .email-icon {
      width: 10px;
      height: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      color: white;
      border-radius: 50%;
      padding: 2px;
    }

    .email-icon.valid {
      background: green;
    }

    .email-icon.invalid {
      background: red;
    }
    
    #label .asterik {
    	color: red;
    }
    
    .continue-button {
      width: 100%;
      height: 40px;
      padding: 10px;
      background-color: #2691D9;
      color: #ffffff;
      border: 1px solid #2691D9;
      border-radius: 25px;
      cursor: pointer;
      font-size: 16px;
    }
    
    .terms {
    	text-align: center;
        margin-top: 20px;
    }
    
    .registration-form-container .registration-title {
      text-align: center;
      padding: 20px;
    }
    
    .terms a {
    	text-decoration: none;
    }
    
    .terms a:hover {
    	text-decoration: underline;
    }
    
    .terms .notice {
    	margin-bottom: 7px;
    }
    </style>
</head>
<body>
    <?php
        include("navbar.php");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["continue"])) {

            $first_name = sanitizeInput($_POST["first_name"]);
            $last_name = sanitizeInput($_POST["last_name"]);
            $username = sanitizeInput($_POST["username"]);
            $email = filter_var($_POST["email_address"], FILTER_SANITIZE_EMAIL);
            $password = sanitizeInput($_POST["pw"]);
            $phone = sanitizeInput($_POST["phone_num"]);
            $shipping_address = sanitizeInput($_POST["shipping_address"]);
            $postcode = sanitizeInput($_POST["postcode"]);
            $city = sanitizeInput($_POST["city"]);
            $state = sanitizeInput($_POST["state"]);
            $country = sanitizeInput($_POST["country"]);

            $_SESSION["registration_data"] = array(
                "first_name" => $first_name,
                "last_name" => $last_name,
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "phone" => $phone,
                "shipping_address" => $shipping_address,
                "postcode" => $postcode,
                "city" => $city,
                "state" => $state,
                "country" => $country
            );
            
            echo '<script> location.replace("otp.php"); </script>';
        }

        function sanitizeInput($input) {
            return htmlspecialchars(trim($input));
        }
    ?>

    <main>
        <div class="registration-form-container">
        <h2 class="registration-title">Signup</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="input-fields">
                <div>
                    <label id="labels" for="first_name"><strong>First Name </strong><span class="asterik">*</span></label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div>
                    <label for="last_name"><strong>Last Name </strong><span class="asterik">*</span></label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div>
                    <label for="username"><strong>Username </strong><span class="asterik">*</span></label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="email_address"><strong>Email Address </strong><span class="asterik">*</span></label>
                    <input type="email" id="email_address" name="email_address" onkeyup="validateEmail(this)" required>
                    <span id="er-email" style="margin-top: 10px;"></span>
                </div>
                <div>
                <div class="pass-field">
                    <label for="pw"><strong>Password </strong><span class="asterik">*</span></label>
                    <input type="password" id="pw" name="pw" required>
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div class="content">
                    <p>Password must contain</p>
                    <ul class="requirement-list">
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>At least 8 characters length</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>At least 1 number (0...9)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>At least 1 lowercase letter (a...z)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>At least 1 special symbol (!...$)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>At least 1 uppercase letter (A...Z)</span>
                        </li>
                    </ul>
                </div>
            </div>
                <div>
                    <label for="confirm_pw"><strong>Confirm Password </strong><span class="asterik">*</span></label>
                    <input type="password" id="confirm_pw" name="confirm_pw" disabled required>
                    <div id="er-confirm-password"></div>
                </div>
                <div>
                    <label for="phone_num"><strong>Phone Number </strong><span class="asterik">*</span></label>
                    <input type="tel" id="phone_num" name="phone_num" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" onkeyup="validatePhoneNumber()" required>
                    <small>(eg. +601XXXXXXXXX or 01XXXXXXXXX)</small>
                    <div id="phoneError"></div>
                </div>
                <div>
                    <label for="shipping_address"><strong>Shipping Address </strong><span class="asterik">*</span></label>
                    <input type="text" id="shipping_address" name="shipping_address" required>
                </div>
                <div>
                    <label for="postcode"><strong>Postcode </strong><span class="asterik">*</span></label>
                    <input type="text" id="postcode" name="postcode" required>
                </div>
                <div>
                    <label for="city"><strong>City/District </strong><span class="asterik">*</span></label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="state"><strong>State </strong><span class="asterik">*</span></label>
                        <select id="state" name="state" required>
                        <option value="" disabled selected>Select a state</option>
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
                    </select>
                </div>
                <div>
                    <label for="country"><strong>Country </strong><span class="asterik">*</span></label>
                    <select id="country" name="country" required>
                        <option value="" disabled selected>Select a country</option>
                        <option value="Malaysia">Malaysia</option>
                        </select>
                </div>
            </div>
        
            <div class="terms">
                <div class="notice">By clicking “continue”, you agree to our Terms and Privacy Policy.</div>
            </div>
            <input type="submit" class="continue-button" name="continue" value="Continue">
        </form>
            <div class="terms">
                Already got an account? <a href="login.php">Login</a>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
  <script>
      const passwordInput = document.querySelector(".pass-field input");
      const confirm_pw = document.getElementById('confirm_pw');
      const eyeIcon = document.querySelector(".pass-field i");
      const requirementList = document.querySelectorAll(".requirement-list li");
      
      const requirements = [
      	{regex: /.{8,}/, index: 0},
        {regex: /[0-9]/, index: 1},
        {regex: /[a-z]/, index: 2},
        {regex: /[^A-Za-z0-9]/, index: 3},
        {regex: /[A-Z]/, index: 4}
      ]
      
      confirm_pw.addEventListener('keyup', () => {
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirm_pw.value;
        const confirmPasswordError = document.getElementById('er-confirm-password');

        if (passwordValue === confirmPasswordValue) {
          confirmPasswordError.textContent = 'Password matched.'; // Clear error message
          confirmPasswordError.style.color = 'green';
        } else {
          confirmPasswordError.textContent = 'Passwords do not match.';
          confirmPasswordError.style.color = 'red';
        }
      });
      
      passwordInput.addEventListener("keyup", (e) => {
        const isValidPassword = requirements.every(item => item.regex.test(e.target.value));
      
      	requirements.forEach(item => {
      		const isValid = item.regex.test(e.target.value);
            const requirementItem = requirementList[item.index];
            
            if(isValid) {
            	requirementItem.classList.add("valid");
                requirementItem.firstElementChild.className = "fa-solid fa-check";
            }
            else {
            	requirementItem.classList.remove("valid");
                requirementItem.firstElementChild.className = "fa-solid fa-circle";
            }
        });
        
        if (isValidPassword) {
          confirm_pw.removeAttribute('disabled');
        } else {
          confirm_pw.setAttribute('disabled', true);
        }
     });
     
     eyeIcon.addEventListener("click", () => {
     	passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        eyeIcon.className = `fa-solid fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
     });
     
     function validateEmail(inputEmail) {
     	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var msg = document.getElementById("er-email");
        
        if(!inputEmail.value.match(mailformat))
        {
          msg.innerHTML = `<span style="margin-left: 5px;"><i class="fas fa-times email-icon invalid"></i></span> Invalid email address!`;
          msg.style.color = "red";
        }
        else {
            msg.innerHTML = '';
        }
     }
     
     function validatePhoneNumber() {
          const phoneInput = document.getElementById('phone_num');
          const phoneError = document.getElementById('phoneError');

          const regexPattern = /^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/;

          if (regexPattern.test(phoneInput.value)) {
              phoneError.textContent = 'Valid phone number'; // Clear error message if valid
              phoneError.style.color = 'green';
          } else {
              phoneError.textContent = 'Invalid phone number';
              phoneError.style.color = 'red';
          }
      }
  </script>

</body>
</html>