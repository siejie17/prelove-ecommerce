<?php
include 'conn.php';

// Check if request_id is provided in the URL
if (isset($_GET['request_id'])) {
    $requestId = $_GET['request_id'];

    // Fetch request details based on the request_id
    $sql = "SELECT * FROM request WHERE request_id = $requestId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $request = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/web-logo/Prelovebyjosie.ico" />
    <title>Edit Request</title>
    <!-- CSS -->
    <!-- CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #ccc;
            color: #333;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #999;
        }

        @media screen and (max-width: 600px) {
            .container {
                max-width: 100%;
                margin: 20px;
            }
        }
    </style>

</head>
<body>
    <div class="container">
    <h2>Edit Request</h2>
    <form action="updateRequest.php" method="post">
        <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
        <!-- Other form fields for editing request_name, request_description, etc. -->

        <label for="request_approval">Approval Status:</label>
        <select name="request_approval">
            <option value="Pending" <?php echo ($request['request_approval'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Approved" <?php echo ($request['request_approval'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
            <option value="Denied" <?php echo ($request['request_approval'] == 'Denied') ? 'selected' : ''; ?>>Denied</option>
        </select>

        <button type="submit" name="updateRequestBtn">Update Request</button>
    </form>
    <button onclick="goBack()">Back</button>
    </div>
    

    <script>
        function goBack() {
            // Redirect to request.php or any other page
            window.location.href = "request.php";
        }
    </script>
</body>
</html>
<?php
    } else {
        echo "Request not found.";
    }
} else {
    echo "Request ID not provided.";
}
?>