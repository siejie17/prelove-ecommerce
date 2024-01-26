<?php
    session_start();
    $_SESSION = array();
    session_destroy();

    echo '<script>
        alert("You have been succesfully logged out. You will be redirect to the main page shortly");
        setTimeout(function() {
            window.location.href = "index.php";
        }, 500);
    </script>';
    exit();
?>