<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _bookRoom;
	$re = new _redirect;
	
	
	
	// my code start
	$pv = new _postingview;
	if (isset($_GET['action']) && $_GET['action'] == 'app') {  
	         $rowsdata = $pv->myReceivedBookingdetails($_GET['roomid']); 
	         $roomdata = $pv->myReceivedBookingRoom($_GET['boking']);
			 
		$roomid =	mysqli_fetch_assoc($roomdata); 
		
			    $startdtNew = $roomid['spCheckInDate'];
				$startdtNew = date($startdtNew);
			$paymentDate=date('Y-m-d', strtotime($startdtNew)); // 1 jan 22


	        $EnddtNew = $roomid['spCheckOutDate']; 
				$EnddtNew = date($EnddtNew);
			$EnddtNew=date('Y-m-d', strtotime($EnddtNew)); // 05 jan 22
		if($rowsdata){
         while($numdata = mysqli_fetch_assoc($rowsdata)){ 
	          $strtDate =	$numdata['spCheckInDate']; // 1 jan  //19 jan
	          $endDate =	$numdata['spCheckOutDate']; //12 jan //28 jan
			  
		
//echo $paymentDate; // echos today! 
$contractDateBegin = date('Y-m-d', strtotime($strtDate)); // 1 jan  //19 jan
$contractDateEnd = date('Y-m-d', strtotime($endDate)); //12 jan //28 jan

if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
   // echo "is between"; 
   
   echo '<h1>Sorry Booking Already Done In dates</h1>'; die;
   
}else{  
  //  echo "NO GO!";  
}
			
			
			//echo $paymentDate; // echos today! 
$contractDateBegin = date('Y-m-d', strtotime($strtDate));
$contractDateEnd = date('Y-m-d', strtotime($endDate));

if (($EnddtNew >= $contractDateBegin) && ($EnddtNew <= $contractDateEnd)){
   // echo "is between"; 
      echo '<h1>Sorry Booking Already Done In dates</h1>'; die;

}else{
   // echo "NO GO!";  
} 
		
			  
		 }
	}
	
	// End
	
	}
	//die('===============');








	if (isset($_GET['action']) && $_GET['action'] == 'app') {
		$bokId = $_GET['boking'];
		$result = $p->approve($bokId);

		$re->redirect("../real-estate/dashboard/booking.php");
	}else if(isset($_GET['action']) && $_GET['action'] == 'rej'){
		$bokId = $_GET['boking'];
		$result = $p->reject($bokId);
		
		$re->redirect("../real-estate/dashboard/booking.php");
	}else{
		$re->redirect("../real-estate/dashboard.php");
	}


	
	
	
?>