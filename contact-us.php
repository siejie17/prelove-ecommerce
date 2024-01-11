<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
  <style>
    .f-container {
      display: flex;
      position: relative;
      padding: 20px 200px;
    }

    .f-container:before {
      content: '';
      position: absolute;
      height: 85%;
      width: 2px;
      background-color: #ccc;
      border-left: 2px dotted #ccc; /* Change 'dashed' to 'dotted' */
      top: 5%;
      left: 50%; /* Change to 50% to center the dotted line */
      transform: translateX(-50%);
    }

    .left-section {
      flex: 1;
      padding: 20px;
      max-width: 500px;
      margin-right: 150px;
    }

    .form-container {
      border-radius: 20px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }

    .contact-form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 8px;
    }

    .contact-form input:not([type="submit"]),
    .contact-form textarea {
      padding: 10px;
      margin-bottom: 30px; 
      border-color: #C1B688;
    }

    .submit-btn {
      background-color: #C1B688;
      font-size: 14px;
      font-weight: bold;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px;
      width: 130px;
      cursor: pointer;
      margin-bottom: 10px;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: black;
      color: white;
    }

    .right-section {
      flex: 1;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .upper-section,
    .bottom-section {
      flex: 1;
      margin-bottom: 20px;
      text-align: center;
      align-items: center;
      display: flex;
      flex-direction: column;
    }

    #message {
      height: 150px;
    }

    h2 {
      font-size: 32px;
      margin-bottom: 30px;
    }

    .right-section i {
      font-size: 200px;
      cursor: pointer;
      color: black;
    }

    .container .left-section h2 {
      text-align: center;
    }

    .business-card-img {
      width: 301px;
      height: 172px;
      overflow: hidden;
    }

    #businessCard {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .email-title {
      text-align: center;
    }

    .enlarge-business-card {
      margin: auto;
      display: block;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80%; /* Adjust the size as needed */
      max-width: 800px;
      border-radius: 25px;
    }

    .enlargeBusinessCard {
      display: none;
      position: fixed;
      z-index: 11;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.8); /* Dimmed background color */
    }

    .closeEnlargeBusinessCard {
      position: absolute;
      top: 15px;
      right: 15px;
      color: #fff;
      font-size: 30px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
  <title>Contact Us</title>
</head>
<body>
    <?php include("navbar.php"); ?>

    <main>
      <div class="background-container">
          <img src="assets/images/bg.jpg" alt="Background Image">
          <div class="center-text">
              Contact Us
          </div>
      </div>
      <div class="f-container">
          <div class="left-section">
          <h2 class="email-title">Email</h2>
          <div class="form-container">
              <form class="contact-form" id="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email_address" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <input type="submit" id="button" class="submit-btn" value="Send Email">
              </form>
          </div>
          </div>

          <div class="right-section">
          <div class="upper-section">
              <h2>WhatsApp</h2>
              <a href="https://wa.me/+601112338281?text=Hi,+I+have+inquiry." target="_blank">
              <i class="fa fa-whatsapp"></i>
              </a>
          </div>

          <div class="bottom-section">
              <h2>Business Card</h2>
              <div class="business-card-img">
              <img id="businessCard" src="assets/images/business-card.jpg" alt="Business Card" onclick="enlargeBusinessCard()">
              </div>
          </div>
          </div>
      </div>

      <div id="myEnlargeBusinessCard" class="enlargeBusinessCard">
          <span class="closeEnlargeBusinessCard" onclick="closeBusinessCard()">&times;</span>
          <img src="assets/images/business-card.jpg" alt="Enlarge Business Card" class="enlarge-business-card">
      </div>
    </main>

    <?php include('footer.php'); ?>

  <script> 
    emailjs.init('qlS0RDCH9l_vU1A5Q');

    const btn = document.getElementById('button');
    document.getElementById('contact-form').addEventListener('submit', function(event) {
      event.preventDefault();

      btn.value = 'Sending...';

      const serviceID = 'service_g49mtaw';
      const templateID = 'template_d2oqguq';

      emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
          btn.value = 'Send Email';
          alert('Sent!');

          document.getElementById('name').value = '';
          document.getElementById('email').value = '';
          document.getElementById('message').value = '';
        }, (err) => {
          btn.value = 'Send Email';
          alert(JSON.stringify(err));
        });
    });
  
    function enlargeBusinessCard() {
      document.getElementById('myEnlargeBusinessCard').style.display = 'block';
    }

    function closeBusinessCard() {
      document.getElementById('myEnlargeBusinessCard').style.display = 'none';
    }

    window.onclick = function(event) {
      var modal = document.getElementById('myEnlargeBusinessCard');
      if (event.target === modal) {
          modal.style.display = 'none';
      }
    }
  </script>
  <script src="script.js"></script>
</body>
</html>