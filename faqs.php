<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/web-logo/Prelovebyjosie.ico" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
    <title>Frequent Asked Questions (FAQs)</title>
</head>
<body>
    <?php
        include("navbar.php");
    ?>

    <main>
        <div class="background-container">
            <img src="assets/images/bg.jpg" alt="Background Image">
            <div class="center-text">
                Frequently Asked Questions (FAQs)
            </div>
        </div>
        <section>
            <div class="faqs-container">
                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Do I need to make an account in order to be able to make a purchase?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Yes, you need to make an account so that our system have a record of your purchase for documentation purpose and in case there is a problem with the purchase.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>How many days will it take for my parcel to arrive?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>For West Malaysia, it will take about 1 week working days, and for East Malaysia it will take about 1-2 weeks working days.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Is there any special promotion, eg: 10.10?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Yes, sometimes there might be some promotion during special occasion for our customer.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>What type of shipping courier will be used?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>The shipping courier that will be used are J&T. For customers that want to sell in the website, a different courier can be used upon discussion.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>How do I contact the seller or admin if I have any problem?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Customers can contact for support through WhatsApp or email. There will be a button that will link customer directly to the communication platform.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Can I get a refund/return if there is defect on the item?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>There is no return or refund policy for the items. The customer can contact the admin for a overview of the latest item condition.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Do all items have defect?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>No, only certain items have and there will be a description of the items condition on all the items because prelovebyjosie is transparent and clear about the things we sell.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Do you sell items that are new?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Yes, we do sell new items as well.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-link">    
                        <h3>Will u add more category to the list of items that is being sold?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Yes, slowly prelovebyjosie would like to expand the business and sell more variety of items for both male and female.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
    <?php
        include("footer.php");
    ?>
</body>
</html>



