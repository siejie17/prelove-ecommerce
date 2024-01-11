<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  footer {
    background-color: #EEEEEE;
    padding: 15px 100px;
    height: auto;
    color: black;
  }

  .footer {
    padding: 0 20px;
  }

  .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  .footer-column {
    flex: 1;
    padding: 10px 10px;
  }

  .footer-container .footer-column .business-title {
    font-weight: bold;
  }

  .footer-divider {
    width: 100%;
    border-top: 1px solid #555;
    margin: 10px 0;
  }

  .copyright {
    text-align: center;
    margin-top: 10px;
    padding: 0 10px;
  }

  .payment-title {
    text-align: center;
  }

  .desc {
    padding: 5px 0 0 0;
    text-align: justify;
    line-height: 1.5;
  }

  .footer-icons i {
    font-size: 24px;
    padding: 10px 10px 10px 5px;
  }

  .links-container {
    display: flex;
    flex-wrap: wrap;
    text-align: justify;
    padding: 5px 0 5px 40px;
  }

  .link {
    width: 50%;
    box-sizing: border-box;
    padding: 5px;
    font-weight: 550;
  }

  .link-title {
    text-align: justify;
    padding-left: 45px;
  }

  .payment-icons {
    display: flex;
    padding: 5px 0 0 0;
    gap: 10px;
    font-size: 24px;
    justify-content: center; 
    align-items: center;
  }

  footer a {
    color: black;
    text-decoration: none;
  }

  @media (max-width: 1160px) {
    .footer-column {
      flex: 1 0 100%;
      margin-bottom: 10px;
    }

    .link, .payment-icons {
      width: 100%;
    }

    .links-container {
      padding: 5px 0;
    }

    .link-title {
      padding-left: 0;
    }

    .payment-title {
      text-align: left;
    }

    .payment-icons {
      justify-content: flex-start; /* Align icons to the left */
      align-items: center;
    }
  }
</style>

<footer>
  <div class="footer">
    <div class="footer-container">
      <div class="footer-column">
        <!-- Content for the first column -->
        <p class="business-title">Prelovebyjosie.</p>
        <p class="desc">Prelovebyjosie is a small business that is establish in 2022 with the goal of providing customer with high quality hand picked second hand item that is in trend.</p>
        <p class="footer-icons"><a href="https://www.instagram.com/prelovebyjosiee/" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="https://wa.me/+601112338281?text=Hi,+I+have+inquiry." target="_blank"><i class="fa fa-whatsapp"></i></a>
        </p>
      </div>
      <div class="footer-column" id="column">
        <!-- Content for the second column -->
        <p class="link-title">External Links</p>
        <div class="links-container">
          <div class="link"><a href="index.php">Home</a></div>
          <div class="link">
            <a href="<?= isset($_SESSION['customer_id']) ? 'requests.php' : 'login.php' ?>">
                Requests
            </a>
          </div>
          <div class="link"><a href="contact-us.php">Contact</a></div>
          <div class="link"><a href="testimonials.php">Testimonials</a></div>
          <div class="link">
            <a href="<?= isset($_SESSION['customer_id']) ? 'my-profile.php' : 'login.php' ?>">
                  My Profile
            </a>
          </div>
          <div class="link">
            <a href="<?= isset($_SESSION['customer_id']) ? 'order.php' : 'login.php' ?>">
                  My Order
            </a>
          </div>
          <div class="link">
            <a href="<?= isset($_SESSION['customer_id']) ? 'cart.php' : 'login.php' ?>">
                  My Cart
            </a>
          </div>
        </div>
      </div>
      <div class="footer-column" id="column">
        <!-- Content for the third column -->
        <p class="payment-title">Payment Method(s)</p>
          <!-- Payment Icons -->
          <div class="payment-icons">
            <h5>Manual Online Banking</h5>
          </div>
      </div>
    </div>

    <div class="footer-divider"></div>

    <div class="copyright">
      &copy; 2023 Prelovebyjosie. All Rights Reserved.
    </div>
  </div>
</footer>
