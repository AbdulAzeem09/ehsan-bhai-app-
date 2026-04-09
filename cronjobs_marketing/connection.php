<?php
include "../univ/main.php";

$username = UNAME;
$password = PASS;
$hostname = DBHOST; 
$dbname = DBNAME; 

//connection to the database
$conn = mysqli_connect($hostname, $username, $password, $dbname)  or die("Unable to connect to MySQL");
?>