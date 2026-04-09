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


$Shipping_id = $_POST['shipping_id'];



$Fullname = $_POST['fullname'];

$Address = $_POST['address'];

$City = $_POST['city'];

$State = $_POST['spUserState'];

$Country = $_POST['country'];


$Zipcode = $_POST['zipcode'];

$Phone = $_POST['phone'];

$Landmark = $_POST['landmark'];

$Address_type = $_POST['address_type'];

$Delivery_instructions = $_POST['delivery_instructions'];

/*
print_r($Shipping_id);
print_r($Fullname);
print_r($Address);
print_r($City);
print_r($State);
print_r($Country);
print_r($Zipcode);
print_r($Phone);
print_r($Landmark);
print_r($Address_type);
print_r($Delivery_instructions);*/


$updatesql = "UPDATE addshipping_address SET fullname='$Fullname', fulladdress='$Address', city='$City', state='$State', country='$Country', zipcode='$Zipcode', phone='$Phone', landmark='$Landmark', address_type='$Address_type', delivery_Instructions='$Delivery_instructions' WHERE id = '$Shipping_id'";


//print_r($updatesql);

 

//print_r($insertsql);
if(!mysqli_query($con, $updatesql)) {
        echo 'Could not update';
    }else {
        echo "Thank you";
    }

    

?>


