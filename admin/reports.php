<?php
require('config.php');
require('header.php');
require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Responsive web page here.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- match different viewport-->
    <meta name="keywords" content="prelovebyjosie admin dashboard"> <!-- define keywords for search engine-->
    <title>Prelovebyjosie Admin Dashboard</title> <!--title of the tab.-->

    <!-- google static icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="reports.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
    <div class="sectiontitle">
        <p>Reports</p>
    </div>

    <!-- switching tabs begins here -->
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'tab-revenue')">Revenue</button>
        <button class="tablinks" onclick="openTab(event, 'tab-solditems')">Items Sold</button>
    </div>

    <div id="tab-revenue" class="tabcontent">
        <div class="bargraph">
            <?php
            $sql="SELECT
            DATE_FORMAT(o.order_date, '%Y-%m-%d') AS day,
            SUM(p.product_price) AS daily_revenue
            FROM
                orders o
            JOIN
                order_details od ON o.order_id = od.order_id
            JOIN
                product p ON od.product_id = p.product_id
            WHERE
                o.order_status = 'delivered'
            GROUP BY
                DATE_FORMAT(o.order_date, '%Y-%m-%d')
            ORDER BY
                day";
            $data1 = array();
            $count=0;
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                // Output data of each row
                while ($row = $result->fetch_array()) 
                {
                    $data1[$count]["label"] = $row["day"]; // Use 'days' as the label pn x-axis
                    $data1[$count]["y"] = $row["daily_revenue"]; // Use daily revenue on y-axis
                    $count++;
                }
            }
            ?>

            <div id="dailyChartContainer" style="height: 370px; width: 100%;"></div>
        </div>

        <div class="linegraph">
            <?php
            $sql="SELECT
            DATE_FORMAT(o.order_date, '%Y-%m') AS month,
            SUM(p.product_price) AS monthly_revenue
            FROM
                orders o
            JOIN
                order_details od ON o.order_id = od.order_id
            JOIN
                product p ON od.product_id = p.product_id
            WHERE
                o.order_status = 'delivered'
            GROUP BY
                DATE_FORMAT(o.order_date, '%Y-%m')
            ORDER BY
                month";
            $data2 = array();
            $count=0;
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                // Output data of each row
                while ($row = $result->fetch_array()) 
                {
                    $data2[$count]["label"] = $row["month"]; // Use 'days' as the label pn x-axis
                    $data2[$count]["y"] = $row["monthly_revenue"]; // Use revenue on y-axis
                    $count++;
                }
            }
            ?>

        <div id="monthlyChartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>

    <div id="tab-solditems" class="tabcontent">
        <div class="total-sales">
            <?php 
                $total="SELECT
                SUM(p.product_price) AS 'Total Revenue'
                FROM
                    orders o
                JOIN
                    order_details od ON o.order_id = od.order_id
                JOIN
                    product p ON od.product_id = p.product_id
                WHERE
                    o.order_status = 'delivered'
                    ";

                $result = $conn->query($total);

                if ($result->num_rows > 0)
                {
                    while ($rowdata = $result->fetch_assoc())
                    {
                        echo "<strong>Total Revenue Items Sold (RM) : " . $rowdata['Total Revenue'] . "</strong>";
                    }
                }else
                {
                    echo "No values recorded.";
                }
            ?>
        </div>
        <div class="selector-container">
        <form id="items-sold" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


        <label for="monthSelector">Select Month:</label>
        <select id="monthSelector" name="month">
            <!-- Options for months  -->
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <label for="yearSelector">Select Year:</label>
        <select id="yearSelector" name="year"></select>

        <br>
        <input type="submit" value="Get Data">
        </form>

        </div> <!-- Selector contain ends here -->

        <div class="tableContainer">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (isset($_POST['month']) && isset($_POST['year'])) 
        {
            $selectedMonth = $_POST['month'];
            $selectedYear = $_POST['year'];

            // Your SQL query here to display items sold based on the selected values
            $sql = "SELECT
                        p.product_id as 'ID',
                        p.product_name as 'Product Name',
                        p.product_description as 'Description',
                        p.product_price as 'Price(RM)',
                        p.product_weight as 'Weight',
                        DATE_FORMAT(o.order_date, '%Y-%m') AS 'Date Sold'
                    FROM
                        orders o
                    JOIN
                        order_details od ON o.order_id = od.order_id
                    JOIN
                        product p ON od.product_id = p.product_id
                    WHERE
                        o.order_status = 'delivered' AND
                        DATE_FORMAT(o.order_date, '%m') = '$selectedMonth' AND
                        DATE_FORMAT(o.order_date, '%Y') = '$selectedYear'
                    GROUP BY
                        DATE_FORMAT(o.order_date, '%Y-%m')
                    ORDER BY
                        o.order_date DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price (RM)</th>
                        <th>Weight</th>
                        <th>Date Sold</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Product Name'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "<td>" . $row['Price(RM)'] . "</td>";
                    echo "<td>" . $row['Weight'] . "</td>";
                    echo "<td>" . $row['Date Sold'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No data found for the selected month and year.";
            }
        } else {
            echo "Month and year values are not set in the POST request.";
        }
    }
    ?>
        </div>
    </div> 

    <?php require('footer.php'); ?>
    
    <script>
        function openTab(evt,tabName)
        {
            var i, tabcontent, tablinks;
            tabcontent=document.getElementsByClassName("tabcontent");
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
    window.onload = function () {
        var dailyChart = new CanvasJS.Chart("dailyChartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Daily Revenue by Month"
            },
            axisY: {
                includeZero: true,
                title: "Revenue (RM)",
                prefix: "RM"
            },
            data: [{
                type: "column",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($data1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        dailyChart.render();

        var chart = new CanvasJS.Chart("monthlyChartContainer", {
        animationEnabled: true,
        title:{
            text: "Monthly Revenue by Year"
        },
        axisY: {
            includeZero: true,
            title: "Revenue (RM)",
            prefix: "RM"
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "YYYY",
            yValueFormatString: "RM#,##0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($data2, JSON_NUMERIC_CHECK); ?>
        }]
    });
        chart.render();
    }

    // jQuery code to populate the year dropdown with a range of years
    $(document).ready(function() {
        // Populate the year dropdown with a range of years
        var currentYear = new Date().getFullYear();
        var startYear = currentYear - 24; // Adjust the Oldest year range 
        var endYear = currentYear + 24; // Adjust the Newest year range

        for (var year = endYear; year >= startYear; year--) {
            $('#yearSelector').append($('<option>', {
                value: year,
                text: year,
                selected: year === currentYear // Set the default selected year to the current year
            }));
        }

        // Handle button click to get data
        $('#getDataBtn').on('click', function() {
            var selectedMonth = $('#monthSelector').val();
            var selectedYear = $('#yearSelector').val();

            // AJAX request to get data
            $.ajax({
                url: 'getReport.php',
                type: 'POST',
                data: { month: selectedMonth, year: selectedYear },
                success: function(data) {
                    // Display the retrieved data in the tableContainer
                    $('#tableContainer').html(data);
                },
                error: function() {
                    console.error('Error in AJAX request');
                }
            });
        });
    });

    function getData() {
        document.getElementById("items-sold").submit();
    }
    </script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>
