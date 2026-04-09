<?php
	//  ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
	//   error_reporting(E_ALL);
    include('../../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="store/";
		include_once ("../../authentication/islogin.php");
		}else{
		function sp_autoloader($class){
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../../component/f_links.php');?>
			<!-- ===== INPAGE SCRIPTS====== -->       
			<?php include('../../component/dashboard-link.php'); ?>
			<script
			src="https://code.jquery.com/jquery-3.6.0.js"
			integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			crossorigin="anonymous"></script>
		</head>
		
		<body class="bg_gray">
			<?php
				//this is for store header
				$header_store = "header_store";
				include_once("../../header.php");
			?>
			<section class="main_box">
				<div class="container">
					<div class="row">
						<div id="sidebar" class="col-md-2 hidden-xs no-padding">
							<div class="left_grid store_left_cat">
								<?php
									include('left-buyermenu.php'); 
								?>
							</div>
						</div>
						<div class="col-md-10">                        
							
							
							<div class="row">
								
								
								
					
							<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
								
								<?php 
								
									if($_GET['status'] != " "){ 
								
												$spord = new _productposting; 
												$orid = $_GET['id'];
												//die('===55555===');
												 $stats=$_GET['status'];
												 $buyer = $_GET['buyerid'];
												// print_r($_GET);  die("===============");
												 
												 
												 if($stats == 4 ){
													 							$msg =" <b>Order Proccessed</b> :Your order has been proccessed ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$orid'>Click to View </a> ";
													 
													  $data=array('from_id'=>$_SESSION['pid'],
													'to_id'=>$buyer,
													'message'=>$msg,
													'module'=>"store",
													'by_seller_or_buyer'=> 1
													
													);
													 
												 }
												  if($stats == 3 ){
													  
													  	$msg =" <b>Order Delivered</b> :Your order has been Delivered ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$orid'>Click to View </a> ";
														
													  $data=array('from_id'=>$_SESSION['pid'],
													'to_id'=>$buyer,
													'message'=>$msg,
													'module'=>"store",
													'by_seller_or_buyer'=> 1
													
													);
													 
												 }
												 
												  if($stats == 2 ) { 
													  
													  
													  	$msg =" <b>Order Shipped</b> :Your order has been Shipped ,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$orid'>Click to View </a> "; 
														
													  $data=array('from_id'=>$_SESSION['pid'],
													'to_id'=>$buyer,
													'message'=>$msg,
													'module'=>"store",
													'by_seller_or_buyer'=> 1
													
													); 
													 
												 }
												 // die("====ffgj=============");
												 $noti = new _notification;
												 $postnoti = $noti->noti_create($data);
											  
												$date =  date('Y-m-d H:i:s');
												$data88 = array(
												"shipping_status" => $stats,
                                                "delivery_data" => 	$date 			 								
												);
												$spord->updateship($data88,$orid);
												
												header("location:sellerstatus.php");
									}
												?>
												<script>
	
	window.location.href= "<?php echo $BaseUrl; ?>/store/dashboard/sellerstatusnew.php?postid=<?php echo $orid ; ?>";
</script>
									
											
										</div>
										
										
										
										
											
								</div>
							</div>
						</div>
						
						
										
										 
						</div>   
					
			
</section>

<?php 
	include('../../component/f_footer.php');
	include('../../component/f_btm_script.php');  
	include '../../assets/mpdf/mpdf.php';
	$mpdf = new mPDF();
	$mpdf->WriteHTML($orderhtml);
	$mpdf->Output("storeinvoice.pdf", 'F');
?>

</body>
</html>
<?php
}
?>


