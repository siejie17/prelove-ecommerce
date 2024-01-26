<?php
require('conn.php');
require('header.php');
// require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
  <title>Prelovedbyjosie Request</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
<style>
.overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 11;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            z-index: 12;
        }

        .swiper-container {
            width: 300px;
            height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            display: block; /* Remove any default image alignment */
            margin: 0 auto; /* Center image horizontally */
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            height: 20px;
            width: 20px;
            color: white;
            top: 55%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: black;
            border-radius: 50%;
            --swiper-navigation-size: 14px;
        }

        .swiper-button-next {
            right: 5px; /* Adjust the distance from the right edge */
        }

        .swiper-button-prev {
            left: 5px; /* Adjust the distance from the left edge */
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            width: 300px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .closeReqImg {
            position: absolute;
            top: 15px;
            right: 15px;
            color: black;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

.actionBtn 
{
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.actionBtn:hover 
{
    background-color: #FFEBCD;
}

.table-container{
    display: flex;
}

/* Additional styles for handling overflow in the customer table */
.content table {
    width: 100%;
    border-collapse: collapse;
    overflow: auto;
} 

.content table th, .content table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.content table th {
    background-color: #f2f2f2;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}


/* CSS for switch tab nav bar */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
  }

  .overlay-content {
    background-color: #efe8e8;
    padding: 20px;
    border-radius: 10px;
    max-width: 100%;
    text-align: center;
  }

  #orderSummaryBtn {
    cursor: pointer;
    background-color: #50953f;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
  }

/* orders table tab switch between different status */
/* Style the tab */
.tab {
    overflow: auto;
    border: 5px solid #ccc;
    background-color: #f1f1f1;
  }
  
  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }
  
  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }
  
  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }
  
  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }

</style>
</head>
<body>
    <!-- Section title -->
    <div class="title">
        <h2>Item Request for Listing</h2>
    </div>

    <!-- switching tabs begins here -->
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'all-req')">All Requests</button>
        <button class="tablinks" onclick="openTab(event, 'pending-tab')">Pending</button>
        <button class="tablinks" onclick="openTab(event, 'approve-tab')">Approved</button>
        <button class="tablinks" onclick="openTab(event, 'decline-tab')">Declined</button>
    </div>

    <!-- tab content for all requests -->
    <div id="all-req" class="tabcontent">
        <div class="all-req-table">
            <table>
                <thead>
                    <tr>
                        <th> Req ID </th>
                        <th> Req Product Name </th>
                        <th> Username </th>
                        <th> Item Type </th>
                        <th> Item Category </th>
                        <th> Description </th>
                        <th> Price (RM) </th>
                        <th> Weight (kg) </th>
                        <th> Approval Status </th>
                        <th>Request Images</th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // SQL query to fetch order details
                    $sql="SELECT
                    r.request_id,
                    r.request_name,
                    c.username,
                    t.type_name,
                    cg.category_name,
                    r.request_description,
                    r.request_price,
                    r.request_weight,
                    r.request_approval
                FROM
                    request r
                JOIN
                    customer c ON r.customer_id = c.customer_id
                JOIN category cg ON cg.category_id = r.category_id
                JOIN type t ON t.type_id = r.type_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                            echo "<td>" . $row['request_id'] . "</td>";
                            echo "<td>" . $row['request_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['type_name'] . "</td>";
                            echo "<td>" . $row['category_name'] . "</td>";
                            echo "<td>" . $row['request_description'] . "</td>";
                            echo "<td>" . $row['request_price'] . "</td>";
                            echo "<td>" . $row['request_weight'] . "</td>";
                            echo "<td>" . $row['request_approval'] . "</td>";
                            echo "<td>" . " <button class='actionBtn' id='view-action' name='view-btn' onclick='viewReq(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . " 'class='actionBtn' >Edit</a>" . "</td>";
                            echo "<tr>";
                        }
                    }else
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo "No requests found.";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div> <!-- all req tab ends -->

    <!-- Pending tab starts -->
    <div id="pending-tab" class="tabcontent">
    <div class="pending-table">
            <table>
                <thead>
                    <tr>
                        <th> Req ID </th>
                        <th> Req Product Name </th>
                        <th> Username </th>
                        <th> Item Type </th>
                        <th> Item Category </th>
                        <th> Description </th>
                        <th> Price (RM) </th>
                        <th> Weight (kg) </th>
                        <th> Approval Status </th>
                        <th>Request Images</th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // SQL query to fetch order details
                    $sql="SELECT
                    r.request_id,
                    r.request_name,
                    c.username,
                    t.type_name,
                    cg.category_name,
                    r.request_description,
                    r.request_price,
                    r.request_weight,
                    r.request_approval
                FROM
                    request r
                JOIN
                    customer c ON r.customer_id = c.customer_id
                JOIN category cg ON cg.category_id = r.category_id
                JOIN type t ON t.type_id = r.type_id
                WHERE r.request_approval='pending'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                            echo "<td>" . $row['request_id'] . "</td>";
                            echo "<td>" . $row['request_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['type_name'] . "</td>";
                            echo "<td>" . $row['category_name'] . "</td>";
                            echo "<td>" . $row['request_description'] . "</td>";
                            echo "<td>" . $row['request_price'] . "</td>";
                            echo "<td>" . $row['request_weight'] . "</td>";
                            echo "<td>" . $row['request_approval'] . "</td>";
                            echo "<td>" . " <button class='actionBtn' id='view-action' name='view-btn' onclick='viewReq(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . " 'class='actionBtn' >Edit</a>"; "</td>";
                            echo "<tr>";
                        }
                    }else
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo "No requests found.";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <!-- pending tab ends -->

    <!-- approve tab starts -->
    <div id="approve-tab" class="tabcontent">
    <div class="approve-table">
            <table>
                <thead>
                    <tr>
                        <th> Req ID </th>
                        <th> Req Product Name </th>
                        <th> Username </th>
                        <th> Item Type </th>
                        <th> Item Category </th>
                        <th> Description </th>
                        <th> Price (RM) </th>
                        <th> Weight (kg) </th>
                        <th> Approval Status </th>
                        <th>Request Images</th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // SQL query to fetch order details
                    $sql="SELECT
                    r.request_id,
                    r.request_name,
                    c.username,
                    t.type_name,
                    cg.category_name,
                    r.request_description,
                    r.request_price,
                    r.request_weight,
                    r.request_approval
                FROM
                    request r
                JOIN
                    customer c ON r.customer_id = c.customer_id
                JOIN category cg ON cg.category_id = r.category_id
                JOIN type t ON t.type_id = r.type_id
                WHERE r.request_approval='approved'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                            echo "<td>" . $row['request_id'] . "</td>";
                            echo "<td>" . $row['request_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['type_name'] . "</td>";
                            echo "<td>" . $row['category_name'] . "</td>";
                            echo "<td>" . $row['request_description'] . "</td>";
                            echo "<td>" . $row['request_price'] . "</td>";
                            echo "<td>" . $row['request_weight'] . "</td>";
                            echo "<td>" . $row['request_approval'] . "</td>";
                            echo "<td>" . " <button class='actionBtn' id='view-action' name='view-btn' onclick='viewReq(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . " 'class='actionBtn' >Edit</a>"; "</td>";
                            echo "<tr>";
                        }
                    }else
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo "No requests found.";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

    </div> 
    <!-- approve tab ends -->


    <div id="decline-tab" class="tabcontent">
    <div class="decline-table">
            <table>
                <thead>
                    <tr>
                        <th> Req ID </th>
                        <th> Req Product Name </th>
                        <th> Username </th>
                        <th> Item Type </th>
                        <th> Item Category </th>
                        <th> Description </th>
                        <th> Price (RM) </th>
                        <th> Weight (kg) </th>
                        <th> Approval Status </th>
                        <th>Request Images</th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // SQL query to fetch order details
                    $sql="SELECT
                    r.request_id,
                    r.request_name,
                    c.username,
                    t.type_name,
                    cg.category_name,
                    r.request_description,
                    r.request_price,
                    r.request_weight,
                    r.request_approval
                FROM
                    request r
                JOIN
                    customer c ON r.customer_id = c.customer_id
                JOIN category cg ON cg.category_id = r.category_id
                JOIN type t ON t.type_id = r.type_id
                WHERE r.request_approval='denied'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                            echo "<td>" . $row['request_id'] . "</td>";
                            echo "<td>" . $row['request_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['type_name'] . "</td>";
                            echo "<td>" . $row['category_name'] . "</td>";
                            echo "<td>" . $row['request_description'] . "</td>";
                            echo "<td>" . $row['request_price'] . "</td>";
                            echo "<td>" . $row['request_weight'] . "</td>";
                            echo "<td>" . $row['request_approval'] . "</td>";
                            echo "<td>" . " <button class='actionBtn' id='view-action' name='view-btn' onclick='viewReq(" . htmlspecialchars(json_encode($row)) . ")'>View</button> " . "</td>";
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . " 'class='actionBtn' >Edit</a>"; "</td>";
                            echo "<tr>";
                        }
                    }else
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo "No requests found.";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <!-- decline tab ends -->

    <!-- overlay for testimonial images -->
    <div id="overlay" class="overlay"></div>
        <div id="reqImg" class="popup">
        <span class="closeReqImg" onclick="closeReqImg()">&times;</span>
            <div class="swiper-container">
                <div id="swiperWrapper" class="swiper-wrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
function viewReq(row) {
    var reqId = row.request_id;
    console.log(reqId);
    fetch(`fetch-req-img.php?request_id=${reqId}`)
        .then(response => response.json())
        .then(data => {
            var swiperWrapperDiv = document.getElementById("swiperWrapper");
            swiperWrapperDiv.innerHTML = "";
            
            data.images.forEach(base64Image => {
                var imgElement = document.createElement("img");
                imgElement.src = `data:image/jpeg;base64,${base64Image}`;

                var swiperSlide = document.createElement("div");
                swiperSlide.classList.add("swiper-slide");
                swiperSlide.appendChild(imgElement);

                swiperWrapperDiv.appendChild(swiperSlide);
            });

            var swiper = new Swiper(".swiper-container", {
                slidesPerView: 1,
                centeredSlides: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            document.getElementById('overlay').style.display = 'block';
            document.getElementById('reqImg').style.display = 'block';
        })
        .catch(error => console.error('Error fetching data:', error));
}
// view images API Ends
function closeReqImg() {
        document.getElementById('reqImg').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    // switch tab function
    function openTab(evt, tabName) 
    {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active"; // Add this line to add "active" class to the clicked button
    }

    // Set 'all-req' as the default active tab and show it initially
    document.getElementById('all-req').style.display = "block";
    document.getElementsByClassName("tablinks")[0].className += " active";
</script>

<?php 
require('footer.php');
?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>