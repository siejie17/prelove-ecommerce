<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "prelove";

    // Create a database connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>