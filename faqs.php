<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Frequent Asked Questions</title>
</head>
<body>
    <?php
        include("navbar.php");
    ?>

    <main>
        <div class="background-container">
            <img src="assets/images/bg.jpg" alt="Background Image">
            <div class="center-text">
                <h1>Frequently Asked Questions (FAQs)</h1>
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
                        <h3>Do I need to make an account in order to be able to make a purchase?</h3>
                        <i class="fa fa-chevron-down" ></i>
                    </div>
                    <div class="ans">
                        <p>Yes, you need to make an account so that our system have a record of your purchase for documentation purpose and in case there is a problem with the purchase.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="faqs" style="padding: 1000px 0;">
            <div class="faqs-container">
                <div class="accordion">
                    <div class="accordion-item" id="question1">
                        <a class="accordion-link" href="#question1">
                        Do I need to make an account in order to be able to make a purchase?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>Yes, you need to make an account so that our system have a record of your purchase for documentation purpose and in case there is a problem with the purchase.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question2">
                        <a class="accordion-link" href="#question2">
                        How many days will it take for my parcel to arrive?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>For West Malaysia, it will take about 1 week working days , and for East Malaysia it will take about 1-2 weeks working days.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question3">
                        <a class="accordion-link" href="#question3">
                        Is there any special promotion, eg: 10.10 ?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>Yes, sometimes there might be some promotion during special occasion for our customer.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question4">
                        <a class="accordion-link" href="#question4">
                        What type of shipping courier will be used?
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>The shipping courier that will be used are J&T. For customers that want to sell in the website, a different courier can be used upon discussion.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question5">
                        <a class="accordion-link" href="#question5">
                        How do I contact the seller or admin if I have any problem?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>Yes, you need to make an account so that our system have a record of your purchase for documentation purpose and in case there is a problem with the purchase.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question6">
                        <a class="accordion-link" href="#question6">
                        Can I get a refund/return if there is defect on the item?
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>There is no return or refund policy for the items. The customer can contact the admin for a overview of the latest item condition.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question7">
                        <a class="accordion-link" href="#question7">
                        Do all items have defect?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>No, only certain items have and there will be a description of the items condition on all the items because prelovebyjosie is transparent and clear about the things we sell.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question8">
                        <a class="accordion-link" href="#question8">
                        Do you sell items that are new?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>Yes we do sell new items as well.</p>
                        </div>
                    </div>

                    <div class="accordion-item" id="question9">
                        <a class="accordion-link" href="#question9">
                        Will u add more category to the list of items that is being sold?    
                        <i class="fa fa-chevron-down" ></i>
                        <i class="fa fa-chevron-up" ></i>
                        </a>
                        <div class="ans">
                            <p>Yes, slowly prelovebyjosie would like to expand the business and sell more variety of items for both male and female.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
        include("footer.php");
    ?>

    <script src="script.js"></script>
</body>
</html>



