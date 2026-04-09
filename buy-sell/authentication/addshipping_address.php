<?php

    include('../univ/baseurl.php');
    include( "../univ/main.php");

   // require_once '../library/config.php';
    /*require_once '../library/config.php';
    require_once '../library/functions.php';*/
        //$conn = _data::getConnection();

    $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

$pid = $_POST['p_id'];
$uid = $_POST['u_id'];


$Fullname = $_POST['fullname'];

$Address = $_POST['address'];

$City = $_POST['spUserCity'];

$State = $_POST['spUserState'];


$Country = $_POST['country'];

$Zipcode = $_POST['zipcode'];

$Phone = $_POST['phone'];

$Landmark = $_POST['landmark'];

$Address_type = $_POST['address_type'];

$Delivery_instructions = $_POST['delivery_instructions'];


/*print_r($Fullname);
print_r($Address);
print_r($City);
print_r($State);
print_r($Zipcode);
print_r($Phone);
print_r($Landmark);
print_r($Address_type);
print_r($Delivery_instructions);*/



 $insertsql   = "INSERT INTO addshipping_address (uid, pid, fullname, fulladdress, city, state, country, zipcode, phone, landmark, address_type, delivery_Instructions) VALUES ('$uid', '$pid','$Fullname','$Address','$City','$State', '$Country', '$Zipcode', '$Phone','$Landmark','$Address_type','$Delivery_instructions')";


print_r($insertsql);

if(!mysqli_query($con, $insertsql)) {
        echo 'Could not insert';
    }else {
        echo "Thank you";
    }

?>


