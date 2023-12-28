<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
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

    .contact-form input,
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
  </style>
  <title>Contact Form</title>
</head>
<body>
    <?php
        include("navbar.php");
    ?>
    <main>
    <div class="background-container">
        <img src="assets/images/bg.jpg" alt="Background Image">
        <div class="center-text">
            <h1>Contact Us</h1>
        </div>
    </div>
    <div class="f-container">
        <div class="left-section">
        <h2 class="email-title">Email</h2>
        <div class="form-container">
            <form class="contact-form" id="form">
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
            <a href="whatsapp://send?text=Hello" target="_blank">
            <i class="fa fa-whatsapp"></i>
            </a>
        </div>

        <div class="bottom-section">
            <h2>Business Card</h2>
            <div class="business-card-img">
            <img id="businessCard" src="assets/images/business-card.jpg" alt="Business Card">
            </div>
        </div>
        </div>
    </div>
    </main>
    <?php include('footer.php'); ?>
  <script>
    emailjs.init('qlS0RDCH9l_vU1A5Q');
    const btn = document.getElementById('button');
    document.getElementById('form').addEventListener('submit', function(event) {
      event.preventDefault();

      btn.value = 'Sending...';

      const serviceID = 'service_g49mtaw';
      const templateID = 'template_d2oqguq';

      emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
          btn.value = 'Send Email';
          alert('Sent!');
        }, (err) => {
          btn.value = 'Send Email';
          alert(JSON.stringify(err));
        });

        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('message').value = '';
    });
  </script>
  <script src="script.js"></script>
</body>
</html>