<?php
$host = "localhost";
$username = "root";
$db = "prelove";
$pass = "";

//create connection
$conn = new mysqli($host,$username, $pass, $db) OR DIE("DIE" .mysqli_error($conn));

//check connection
if(mysqli_connect_errno())
{
	echo "It is not connecting." .mysqli_connect_error();
}
global $conn;
?>