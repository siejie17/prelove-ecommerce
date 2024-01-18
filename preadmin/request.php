<?php
require('config.php');
require('header.php');
// require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Prelovedbyjosie Request</title>
  <link href="style.css" rel="stylesheet" />
  
<style>
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
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . "'>Edit</a>"; "</td>";
                            echo "<tr>";
                        }
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
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . "'>Edit</a>"; "</td>";
                            echo "<tr>";
                        }
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
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . "'>Edit</a>"; "</td>";
                            echo "<tr>";
                        }
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
                            echo "<td>" . "<a href='editReqForm.php?request_id=" . $row['request_id'] . "'>Edit</a>"; "</td>";
                            echo "<tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <!-- decline tab ends -->

    <script>
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
</body>
</html>