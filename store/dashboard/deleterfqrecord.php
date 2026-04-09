<?php
function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");

	$r = new _rfq;


//echo "here";

//print_r($_POST['getidspRfq']);


//print_r($_POST['save']);
//print_r($_POST['check']);

//exit();


//if(isset($_POST['save'])){
	$checkbox = $_POST['check'];

	for($i=0;$i<count($checkbox);$i++){
	$del_id = $checkbox[$i]; 

//	echo $del_id;

	$message =  $r->removeRfqComment($del_id);



//	mysqli_query($conn,"DELETE FROM employee WHERE userid='".$del_id."'");
	$message = "Data deleted successfully !";


	//echo $message;
}
//}

  
//echo $message;

//exit();

//echo $r->tcd->sql;

$re = new _redirect;
 	$re->redirect($BaseUrl.'/store/dashboard/quotation_list.php?idspRfq='.$_POST['getidspRfq']);
	


	?>