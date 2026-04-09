<?php  
include('../univ/baseurl.php');
     include( "../univ/main.php");

  $con = mysqli_connect(DOMAIN, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
   //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

//print_r($_GET['id']);

$updatestatus0 = "UPDATE addshipping_address SET status='0' WHERE status= '1'";



$result1 = $con -> query($updatestatus0);


$Statusvalue =$_POST['status'];

$Statusid =$_POST['statusid'];


print_r($Statusvalue);
echo "<br>";
print_r($Statusid);

//exit();

$updatestatus1 = "UPDATE addshipping_address SET status='$Statusvalue' WHERE id= '$Statusid'";

//print_r($updatestatus1);

$result = $con -> query($updatestatus1);





//print_r($result1);
//print_r(expression)

?>