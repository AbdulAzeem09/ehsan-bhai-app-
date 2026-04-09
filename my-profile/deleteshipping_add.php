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
$shippid = isset($_POST["info"]) ? (int) $_POST["info"] : 0;
//$shippid =$_POST['info'];

/*$selectuid = "SELECT uid,status FROM addshipping_address  WHERE id= $shippid";

print_r($selectuid);


$result2 = $con -> query($selectuid);
$row2 = mysqli_fetch_assoc($result2);*/

//print_r($row2['uid']);


$sql = "DELETE FROM `addshipping_address` WHERE id=$shippid";

$result = $con -> query($sql);




/*if ($row2['status'] == 1) {
$selectdata1 = "SELECT * FROM addshipping_address  WHERE uid= $row2['uid'] AND status=0 ORDER BY id ASC LIMIT 1";

$result1 = $con -> query($selectdata1);
$row1 = mysqli_fetch_assoc($result1);

print_r($row1);
}
*/
//print_r($selectstatus0);



//print_r(expression)

?>
