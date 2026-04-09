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

	$postid=$_GET['postid'];

	$obj=new _sellercomment	;
	
	$ress=$obj->getsellernewdata($postid);
	
	//print_r($ress);
		//die("=====");
	if($ress !=""){
		$roww=mysqli_fetch_assoc($ress);
			//print_r($roww);

		//	die("=====");
	}
	$del_address=$roww['shipping_address'];
	$date= $roww['sporderdate'];
		//die("=====");
		
		
			
		
		
		
	?>
	<!DOCTYPE html>
	<html lang="en-US">



	<style>
		.panel-body.shippment {
			padding: 0px !important;
		}

		tfoot tr {
			display: block !important;
		}
		button#indent {
    padding: 0px 12px;
}
.fa{
	font-size:14px!important;
}
		
	</style>


	<head>
		
		<!-- order.html links--->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>The SharePage</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<!-- Optional theme -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	--> 

		<link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/A.style.css+design.css,Mcc.hQAhmIY5uF.css.pagespeed.cf.wVvL7jTLAe.css" />
		<style type="text/css">
			.left_group_gray{
				box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

			}
			.progress-bar {
				background-image: -webkit-linear-gradient(top,#0f8f46  0,#2bc46f 100%);
				background-image: -o-linear-gradient(top,#0f8f46  0,#2bc46f 100%);
				background-image: -webkit-gradient(linear,left top,left bottom,from(#0f8f46 ),to(#2bc46f));
				background-image: linear-gradient(to bottom,#0f8f46 0,#2bc46f 100%);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff286090', GradientType=0);
				background-repeat: repeat-x;
			}
			.one, .two, .three{
				position: absolute;
				margin-top: -10px;
				z-index: 1;
				height: 40px;
				width: 80px;
				border-radius: 25px;
				text-align: center;
				padding: 10px 0;      
				
			}
			.one{
				left:20%;
			}
			.two{
				left:45%;
			}
			.three{
				left:70%;
			}
			.primary-color{
				background-color:#aff8d0;
			}

			.no-color{
				background-color:#aff8d0;
			}
			.text-end {
				text-align: right!important;
			}


		</style>
		<!-- order.html links end--->
		<?php include('../../component/f_links.php');?>
		<!-- ===== INPAGE SCRIPTS====== -->       
		<?php include('../../component/dashboard-link.php'); ?>
			<!-- <script
			src="https://code.jquery.com/jquery-3.6.0.js"
			integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			crossorigin="anonymous"></script> -->
			
			
			
		</head>
		
		<body class="bg_gray" cz-shortcut-listen="true">
			<?php
				//this is for store header
			$header_store = "header_store";
			include_once("../../header.php");
			?>
			<!-- order.html code -->
			
			
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
						<div class="" id="">
						
						
						<div class="col-md-7" >
						
													<div class="row" id = "hhid"><br />
												<div class="col-md-12">
													<div class="progress">
														<div class="one primary-color" id="pro">Processed</div>
														<div class="two primary-color" id="ship">Shipped</div>
														<div class="three no-color" id="deli">Delivered</div>

														<?php 

			                                     $st= new _orderSuccess;
                                                 $status= $st->readdetails($_GET['postid']);
			 
			// die("*****8*************1514**");
			                                      if($status!=false){
												//print_r($status);die;
												$i=1;
												
												
											     while($r1=mysqli_fetch_assoc($status)){
											
										//print_r($r1);
										//die("*****8*************1514**");
										     $id=$r1['idspOrder'];
											 $prid=$r1['idspPostings'];
											  $bpid=$r1['spByuerProfileId'];
											// die("*****8*************1514**");
											 $buid=$r1['spBuyeruserId'];
											 $spid=$r1['spSellerProfileId'];
											 
											$price=$r1['sporderAmount'];
											$shipping_stat=$r1['shipping_status'];
											$qty=$r1['spOrderQty'];
											$can=$r1['is_cancel'];
											$ref=$r1['is_refund'];
											$date=$r1['can_ref_date'];
											
										
												 }}
											
		

		if(isset($_POST['refund'])){
$status= array("is_refund"=>1 ,"reason"=>$_POST['reason'], "can_ref_date"=>date('Y-m-d H:i:s '));
					 $s=new _spcustomers_basket;
				     $st= $s->updatestatus($status,$_GET['postid']);
					 
					 
					 			if(isset($_FILES['image'])){
				
				foreach($_FILES["image"]["tmp_name"] as $key=>$tmp_name) {		
			
	$filename = $_FILES["image"]["name"][$key];
	$tempname = $_FILES["image"]["tmp_name"][$key];
		$folder = "images/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
			
			$imgdata = array("id"=>$r1['idspOrder'],
				"basket_id"=>$_GET['postid'], 
				"image"=>$filename);
			
			
				$p= new _spprofiles;
			   $pf= $p->imageInsert($imgdata); 
			
			
		}
		 }
			}
			
			
			
		
			                               
											
											 
			
					 if(isset($_POST['refund'])){
						 
				// print_r($_POST['refund']);
$stat= array("basket_id"=> $_POST['idspOrder'],
"product_id"=> $_POST['idspPostings'],
"buyerprofile_id"=> $_POST['spByuerProfileId'],
"buyeruser_id"=> $_POST['spBuyeruserId'],
"sellerprofile_id"=> $_POST['spSellerProfileId']



);
					 $s=new _productposting;
				     $st= $s->insertrefund($stat);
					 //print_r($st);
					// die("+++++++++++++++");
					 
					 }
				 
					
					
					}
					if(isset($_POST['cancel'])){
				 $status= array("is_cancel"=>1, "reason"=>$_POST['reason'], "can_ref_date"=> date('Y-m-d H:i:s '));
					 $s=new _spcustomers_basket;
				     $st= $s->updatestatus($status,$_GET['postid']);
					
					}

                 //echo $_GET['postid']."hello";
													$spord3 = new _productposting;
				$status4 = $spord3->readshiptm($_GET['postid']);
				//print_r($status4);
				if($status4 != false){
				$data99 = mysqli_fetch_assoc($status4);
					//print_r($data99);
					}
				//die('=======');
				$shipst =  $data99['shipping_status'];
				//echo$BaseUrl;
				//die("===========");
              $spSellerProfileId=$data99['spByuerProfileId'];
			  $pid=$_SESSION['pid'];

			  //echo$spSellerProfileId;
			  //die("===========");
            //echo "<pre>";
			
			//echo $shipst; //die("---------------------");
		   
 //die("===========");
                   

					switch ($shipst) { 
						case "1":
						echo "<div class='progress-bar' style='width: 15%;'></div>
						<style>
	.one {
    background-color: #777 !important;
	color:white;
	
}

	.two {
    background-color: #777 !important;
	color:white;
}

   .three{
    background-color: #777 !important;
	color:white;
}

 </style>
						";
break;
case "4":
echo "<div class='progress-bar' style='width: 46%;'></div>
<style>
						
.two {
 background-color: #777 !important;
color:white;
}

.three
 {
    background-color: #777 !important;
	color:white;
}

</style>
          ";
break;
case "2":
echo "<div class='progress-bar' style='width: 70%;'></div>
<style>
	
.three
 {
    background-color: #777 !important;
	color:white
}

						</style>
						";
						break;
						case "3":
						echo "<div class='progress-bar' style='width: 100%;'></div>";
						case "0":
						echo "<div class='progress-bar' style='width: 100%;'></div>";
						break;


					}
					// echo $spSellerProfileId;
					// echo $pid ;
			// die("===========");
 if($pid != $spSellerProfileId){
				//die("+++++++++++");
				 //header("location:https://dev.thesharepage.com/timeline/");
	               // header("location:$BaseUrl/store/dashboard/order_mang.php?msg=notaccess");
				   
          
					?>
                  <script>
				   location.href ='<?php echo $BaseUrl; ?>/store/dashboard/order_mang.php?msg=notaccess';
				   </script>
                     <?php } ?>       

					<!--div class="progress-bar" style="width: 70%;"></div -->
				</div>

			</div>
		</div>

						
						
					<div id="printableArea">	 
							<div class="left_group_gray">
								<div class="panel">
									<div class="panel-heading">
									<span style="font-size:20px; color:red;">MY ORDER</span>
										<div class="d-flex justify-content-between">
											<div>
												Order Date: <strong ><?php echo $date; ?></strong> |
												Order#: <strong >#<?php  echo $_GET['postid'];?></strong> |
												Payment: <strong >Stripe</strong> 
												<!--   Status: <strong class="badge rounded-pill btn-info">SHIPPING</strong> -->
											</div> 

				

	</div>
</div>

<?php 
$st1= new _orderSuccess;
$status= $st1->readdetails($_GET['postid']);

if($status){
	$i=1;
	while($r1=mysqli_fetch_assoc($status)){
		$prid=$r1['idspPostings'];
		$price=$r1['sporderAmount'];
		$qty=$r1['spOrderQty'];
		$can=$r1['is_cancel'];
		$ref=$r1['is_refund'];
		$dat=$r1['can_ref_date'];
		$prtitle=$r1['spPostingTitle'];
		$qty=$r1['spOrderQty'];

		$total=$qty*$price;


		$n=$st1->readname($prid);
		$na=mysqli_fetch_assoc($n);
		$prtitle=$na['spPostingTitle'];
		$sippingch=$na['sippingcharge'];
		$fixedamount=$na['fixedamount'];
											//die('========');

		if($sippingch==1){
			$sippingch=0;
		}
		if($sippingch==2){
			$left_qty=$qty-1;
									//echo $left_qty;
									//die('===');
			$left_wty_amt= $left_qty *.25*$fixedamount;
			$sippingch=$fixedamount+$left_wty_amt;
		}
		


		$uname	= $st1->readusername($r1['spByuerProfileId']);
		while($r2=mysqli_fetch_assoc($uname)){
			$name= $r2['spProfileName'];
			$userid=$r2['idspProfiles'];
		}

		$prname= $st1->readproductname($r1['idspPostings']);
		while($r3=mysqli_fetch_assoc($prname)){
				$curr= $r3['default_currency'];
			$productname=$r3['spPostingTitle'];
			 $refund_value = $r3['is_refund'];
		}									
	}
}

?>

<?php
if(isset($_POST['review'])){
	
	
	
	$data = array("basket_id"=>$_POST['basket_id'],
	                        "product_id"=>$_POST['product_id'],
	                         "review_star"=>$_POST['rating'],
	                          "user_profileid"=>$_POST['pid'],   
	                           "user_userid"=>$_POST['uid'],  
                                 "review_comment"=>$_POST['comments'],
								 "product_type"=>'Store'
	);
	
	 $sr= new _spproduct_review;
	$status= $sr->create($data);
}

?>

<div class="panel-body">                            
	<table class="table table-borderless">
		<tbody>
			<tr>
				<th>Products</th>
				<th></th>
				<th style="text-align:center;">Quantity</th>
				<th class="text-end" >Price</th>
			</tr>
			<tr>
				<td>

					<div class="pull-left" style="padding-right: 10px;">

						<?php 


						$pic = new _productpic;
						$res2 = $pic->read($prid);
						if($res2!=false){
							$rp = mysqli_fetch_assoc($res2);
							$ppic = $rp['spPostingPic'];
						} 
						?>
						<img src="<?=  $ppic ?>" width="70px" height="70px">

					</div>
					<div class="">

						<p><a href="<?= $BaseUrl; ?>/store/detail.php?catid=1&postid=<?= $prid; ?>" ><?php echo $productname ;  ?> </a></p>

					</div>

				</td>
				<td></td>
				<td style="text-align:center;"><?php echo $qty; ?></td>

				<?php 
				$userid=$_SESSION['uid'];
				$c= new _orderSuccess;
				$currency= $c->readcurrency($userid);
				$res1= mysqli_fetch_assoc($currency);
				//$curr=$res1['currency'];

				?>

				<td class="text-end"><?php echo '  ' . $price .'.00' . ' ' .$curr; ?></td>
			</tr>

		</tbody>


		
		<tr>
			<td colspan="3">Subtotal</td>
			<td class="text-end"><?php  echo '  '.$total  .'.00' . ' ' .$curr;  ?></td>
		</tr>
		<tr>
			<td colspan="3">Shipping</td>
			<td class="text-end"><?php echo '  '. $sippingch .'.00' . ' ' .$curr; ?></td>
		</tr>
                                <!--    <tr>
                                        <td colspan="2">Discount (Code: NEWYEAR)</td>
                                        <td class="text-danger text-end">-$10.00</td>
                                    </tr>  -->
                                    <tr class="fw-bold">
                                    	<td colspan="3">TOTAL</td>
                                    	<td class="text-end"><?php echo  ' '. $sippingch+$total .'.00' . ' ' .$curr; ?></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="panel-footer">
                            	<div class="d-flex">
                            		<button class="btn btn-primary" onclick="printDiv('printableArea')" id="invoicee">Invoice</button>
                            	</div>
                            </div>
                        </div>
                    </div>
					
                    <div class="left_group_gray">
                    	<div class="panel">
                    		<div class="panel-body">
                    			<div class="row">
                                   <!--    <div class="col-lg-6">
                             <h3 class="h6">Payment Method</h3>  
                                    <p>
                                       
                        
                                    </p>
                                </div>
                            -->


                            <?php 
                            $sptr = new _spevent_transection;
                            $readship = $sptr->readshipm($_GET['postid']);
                            if($readship){
                            	$readship1=mysqli_fetch_assoc($readship);
                            }
                            $ordertr= $sptr->readtr($_GET['postid']);
                            if($ordertr){
                            	$ordertrs=mysqli_fetch_assoc($ordertr);
                            	$addresss = $ordertrs['shippAddress'];
								//echo  $addresss;
                            }
							
							
                            ?>



                                 
                            <div class="col-lg-6">
                            	<h3 class="h3">Billing address</h3>
                            	<address>
                            		<h5><?php 
                         $spBuyeruserId=$data99['spBuyeruserId'];
						 
						// print_r($data99);
							// die("++++++++++++++");
						 $objj=new _spuser;
						 $res12=$objj->readdatabybuyerid($spBuyeruserId);
						 if($res12 !=false){
							 
							 $row12=mysqli_fetch_assoc($res12);
							echo "<pre/>";
							 
							 
							 
						 }
                        echo $row12['default_country']."<br>"; 
					 echo $row12['default_state']."<br>"; 
					  echo $row12['default_city']."<br>"; 
					   echo $row12['address']."<br>"; 
					    echo $row12['spUserzipcode']; 
									   ?><h5>
                            		</address>
                            	</div>

                            	<div class="col-lg-6">
                            		<h3 class="h3">Delivery address</h3>
                            		<address>
                            			<h5><pre><?php echo  $del_address; ?></pre><h5>
                            			</address>
                            		</div>
									</div>

                            		<div class="col-md-12">



                            			<?php if($ref==1)
                            			{
                            				echo "	<div class='float-left' >Product Images</div>";
                            				$p= new _spprofiles;
                            				$pf= $p->readimg($_GET['postid']);

                            				if($pf!=false){
                            					while($img=mysqli_fetch_assoc($pf)){
											//print_r($img);
                            						$image=$img['image'];
                            						echo  "   <div class='col-md-3' style='display: inline-block; padding-top:20px;'><img src='$BaseUrl/store/dashboard/images/".$image."' alt='image' width='100' height='100' />"; ?>

                            					</div>&nbsp;&nbsp;&nbsp;

                            				<?php 	} } ?>

                            			<?php }


                            			?>

                            		</div>

                            	</div>
                            </div>
                        </div>
                   
				   </div>
                </div>
<script>
	function printDiv(divName) {
 
	
	var printContents = document.getElementById(divName).innerHTML;
	
	
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
	 document.getElementById("invoicee").style.display = "none";
	
    // document.getElementById('pro').value="";
// document.getElementById('ship').value="";
 //document.getElementById('deli').value=""; 
     window.print();

     document.body.innerHTML = originalContents;
}
	</script>

                <div class="col-md-3" >
                	<div class="left_group_gray" style="display:none;">
                		<div class="panel" >
                			<!--<div class="panel-body">
                				<h4>Customer Notes</h4>
                				<p>Sed enim, faucibus litora velit vestibulum habitasse. Cras lobortis cum sem aliquet mauris rutrum. Sollicitudin. Morbi, sem tellus vestibulum porttitor.</p>
                			</div>-->
                		</div>
                	</div>

                	<div class="left_group_gray">
                		<div class="panel">
                			<div class="panel-body shippment">
                				<h4>Shipping Information</h4>
                				<div class="col-md-12">
								
								<?php  $spord3 = new _productposting;
				$status3 =$spord3->readshiptm($_GET['postid']);
				if($status3 != false){
				$data99 = mysqli_fetch_assoc($status3);
					}
				//die('=======');
				$shipst =  $data99['shipping_status'];
			
				if($shipst == 3){ ?>
					
					<!--<button style="background-color:#0f8f46" type="button" class="btn btn-info">Review</button>
					
					<!-- Button trigger modal -->
					<?php 
					 $st1= new _orderSuccess;
$status= $st1->readdetails($_GET['postid']);

if($status){
	$i=1;
	$r1=mysqli_fetch_assoc($status);
		$prid=$r1['idspPostings'];
		
}

$st2= new _orderSuccess;
$status= $st2->readdetails($_GET['postid']);

if($status){
	
	$r1=mysqli_fetch_assoc($status);
	
		 $ref=$r1['is_refund'];
		
		$prname= $st2->readproductname($r1['idspPostings']);
		$r3=mysqli_fetch_assoc($prname);
		//print_r($_SESSION)."<br><br>"."----------------------------";
		//print_r($r3);
			//$productname=$r3['spPostingTitle'];
			 $refund_value = $r3['is_refund'];
		 $refund_within = $r3['refund_within']; 
			 $idspPostings = $r3['idspPostings']; 
			
}

if($refund_value == 0){
$sr= new _spproduct_review;
	                                            $status= $sr->readrating($_SESSION['uid'], $_SESSION['pid'], $prid);
												
												if($status ==false){
					
					
					?>
					
					
<button style="background-color:#0f8f46" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Review
</button>

<?php }  ?>

<?php } else{ 

  
	$sb= new _spcustomers_basket;
	
	$sta= $sb->readdelivery($idspPostings);
//die("---------");	
if($sta){
	$i=1;
	$r2=mysqli_fetch_assoc($sta);
		$delivery_data=$r2['delivery_data'];
		$is_refund=$r2['is_refund'];
	
}
	
    
$Date =  $delivery_data;
$date1= date('Y-m-d', strtotime($Date. ' +'. $refund_within.' days'));
 //date('Y-m-d', strtotime($Date. ' + 1 days'));
 $date2 =  date('Y-m-d H:i:s');
 $date3=date('Y-m-d', strtotime($date2. ' + 0 days'));
// echo $Date."<br>".$date3; 
if($date3 > $date1){ 
if($is_refund  == 0){  
 ?>
	
	<button style="background-color:#0f8f46" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Review
</button>
	
<?php } }

				} } 
?>
<style>

.rating {
    float:left;
    width:300px;
}
.rating span { float:right; position:relative; }
.rating span input {
    position:absolute;
    top:0px;
    left:0px;
    opacity:0;
}
.rating span label {
    display:inline-block;
    width:30px;
    height:30px;
    text-align:center;
    color:#FFF;
    background:#ccc;
    font-size:30px;
    margin-right:2px;
    line-height:30px;
    border-radius:50%;
    -webkit-border-radius:50%;
}
.rating span:hover ~ span label,
.rating span:hover label,
.rating span.checked label,
.rating span.checked ~ span label {
    background:#F90;
    color:#FFF;
}
</style>

<style>
.fa {
  font-size: 35px;
  .checked {
  color: orange;
}
</style>
<!-- Modal -->
<form action=""  method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <?php 
	  $st1= new _orderSuccess;
$status= $st1->readdetails($_GET['postid']);

if($status){
	$i=1;
	$r1=mysqli_fetch_assoc($status);
		$prid=$r1['idspPostings'];
}
	  ?>
	  
	  <input type="hidden" name ="basket_id" value="<?php  echo $_GET['postid'];?>">
	  <input type="hidden" name ="product_id" value="<?php  echo $prid;?>">
	  <input type="hidden" name ="uid" value="<?php  echo $_SESSION['uid'];?>">
	  <input type="hidden" name ="pid" value="<?php  echo $_SESSION['pid'];?>">
	  <div class="rating">
    <input class="fa fa-star"  name="rating" id="str5" value="5"><label for="str5"></label>
	<input type="radio" name="rating" id="str4" value="4"><label for="str4"></label>
  <input type="radio" name="rating" id="str3" value="3"><label for="str3"></label>
    <input type="radio" name="rating" id="str2" value="2"><label for="str2"></label>
   <input type="radio" name="rating" id="str1" value="1"><label for="str1"></label>
	</div>
	  
       
<!--<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>-->
<br><br>
<textarea type="text" class="form-control" name="comments" placeholder="Please Write Your Comments......"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="review">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
		
		$(document).ready(function(){
    // Check Radio-box
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('input:radio').change(
      function(){
        var userRating = this.value;
        //alert(userRating); 
    }); 
});

</script>		
					
				 <?php //} else {
				
				?>
                          
                					

                					<br>

                					
									
									
					<?php 
					
				
				
					
				 $sell=new _productposting;
				 $sellty= $sell->read($prid);
				 
				 if($sellty!=false){
			
				 $selltype=mysqli_fetch_assoc($sellty);
				 
				//die('=====agdfhft=====');
				//print_r($selltype);
					$cancel=$selltype['is_cancel'];
					$refund=$selltype['is_refund'];
				    $type=$selltype['sellType'];
					$refundwithin=$selltype['refund_within'];
					$idspPostings=$selltype['idspPostings'];
				
					$can_ref_date=$selltype['can_ref_date'];
				 }
				 
				 $sb=new _spcustomers_basket;
				 $res= $sb->readdelivery($idspPostings);
				  if($res!=false){
			
				 $row=mysqli_fetch_assoc($res);
				 
			
					$can_ref_date = $row['can_ref_date'];
				  }
				 

				        if($type=='Retail'){  
					//die('=====');
						//echo $cancel;
						if($can==1 || $ref==1){
						if($can==1){
						echo "You have cancelled The order on ".' '.$date;
						}
						if($ref==1){
						
						
										
						$rd= new _spprofiles;
					$rad= $rd->readst($_GET['postid']);
					if($rad !=false){
					$read=mysqli_fetch_assoc($rad);
					
					$st=$read['status'];
						//echo $st;buyerprofile_id
						
						if($st==0){
						echo "Refund Status : Pending";
						}
						
						if($st==1){
						echo "Refund Status : Accepted";
						}
						
						
						if($st==2){
						echo "Refund Status : Rejected";
						}
						
						echo "<br>You have refunded the order on ".' '.$can_ref_date;
						
						}
						
						}
						}
						
						else{
						
						
					if($cancel== 1){
						
					$a= new _productposting;
					$an= $a->readshipstatus($_GET['postid']);
					
					if($an!=false){
					$anoop= mysqli_fetch_assoc($an);
					
					//print_r($anoop);
					//ship //process //order
					  $sta= $anoop['shipping_status'];
					//die("+++++++++");
					//3
					}
					if($sta==0 || $sta== 2  || $sta== 4)
					{
				
					?>
                									<form action="" method="post">
                										<input type="hidden" name="cancel" id="cancel" value="<?php echo $cancel;?>" >
                								<!---	<button type="submit" name="cancel" onclick="return confirm('Are you sure you want to Cancel this item?');"  class="btn btn-danger btn-sm ">Cancel</button--->
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
  Cancel
</button>
                									</form>
					<?php }}
					
					$st2= new _orderSuccess;
$status= $st2->readdetails($_GET['postid']);

if($status){
	
	$r1=mysqli_fetch_assoc($status);
	
		 $ref=$r1['is_refund'];
		
		$prname= $st2->readproductname($r1['idspPostings']);
		$r3=mysqli_fetch_assoc($prname);
		//print_r($_SESSION)."<br><br>"."----------------------------";
		//print_r($r3);
			//$productname=$r3['spPostingTitle'];
			 $refund_value = $r3['is_refund'];
		 $refund_within = $r3['refund_within']; 
			 $idspPostings = $r3['idspPostings']; 
			
}
					
					$sb= new _spcustomers_basket;
	//echo $idspPostings;
	$stat= $sb->readdelivery($idspPostings);
//die("---------");	
if($stat){
	$i=1;
	$r2=mysqli_fetch_assoc($stat);
		$delivery_data=$r2['delivery_data'];
	
}
	
    
$Date =  $delivery_data;
$date1= date('Y-m-d', strtotime($Date. ' +'. $refund_within.' days'));
 //date('Y-m-d', strtotime($Date. ' + 1 days'));
 $date2 =  date('Y-m-d H:i:s');
 $date3=date('Y-m-d', strtotime($date2. ' + 0 days'));
 //echo $date1."<br>".$date3; 
 $dd = ($date3 > $date1);
 //var_dump($dd);
if($dd == false){ 
					
                								if($refund== 1){ 
												
												$spord3 = new _productposting;
				$status3 =$spord3->readshiptm($_GET['postid']);
				if($status3 != false){
				$data99 = mysqli_fetch_assoc($status3);
					}
				//die('=======');
				$shipst =  $data99['shipping_status'];
			
													if($sta==3)
					{ 
													?>

                								<!--	<form action="" method="post">   
                										<input type="hidden" name="refund" id="refund" value="<?php //echo $refund;?>" >
                										<button type="submit" name="refund" onclick="return confirm('Are you sure you want to Refund this item?');" class="btn btn-success btn-sm">Refund</button>
                									</form-->
			
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
  Refund
</button>
                									<?php 
                								}
						}
}
                							}
                						
                					}

                					if($readship1  == ""){
                						?>
										</br>
										<span style="font-size:16px;color:blue;"> Shipping Details Not Provided</span>
                					<?php }else { ?>
                						<br>
                						<b>Courier Service Name :</b>  <?= $readship1['CourierService'] ?> <br><br>
                						<b>Shipped Date  :</b>   <?= $readship1['ShippedDate'] ?> <br><br>
									<b>Tracking Number  :</b>   <?= $readship1['TrackingNumber']  ?>
									
									

                																					<?php


                								$spord3 = new _productposting;
                								$status3 =$spord3->readshiptm($_GET['postid']);
                								if($status3 != false){
                									$data99 = mysqli_fetch_assoc($status3);
																//die('=======');
                									
                								}

                								?>

                                                        
                								

                						





				 <?php } //}?>
                					<div id="myModal45" class="modal fade" role="dialog">
                						<div class="modal-dialog">

                							<!-- Modal content-->
                							<div class="modal-content">
                								<div class="modal-header">
                									<button type="button" class="close" data-dismiss="modal">&times;</button>
                									<h4 class="modal-title">Tracking Details </h4>
                								</div>
                								<form action="" method="post">
                									<div class="modal-body">
                										<label class="">Courier Service Name </label>
                										<input type="text" class="form-control" name="CourierService">
                										<input type="hidden" class="form-control" name="shipStatus" value="1">
                										<input type="hidden" class="form-control" id="postids" value="<?= $_GET['postid']; ?>" name="postid">

                										<label class="form-label">Shipped Date </label>
                										<input type="date" class="form-control" name="ShippedDate">

                										<label class="form-label">Tracking Number</label>
                										<input type="text" class="form-control" name="TrackingNumber">

                									</div>
                									<div class="modal-footer">
                										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                										<button type="submit" class="btn btn-success" name="sub3">Submit</button>
                									</div>
                								</form>
                							</div>

                						</div>

                					</div>

                				</div>
                				<hr />
                				<br>
							<!--<div class="col-md-12">
                            <h4 style="font-weight:bold;">Delivery Address</h4>
                            <address>
                                       
										<h5><?php //echo  $addresss; ?><h5>
										
                            </address>
                        </div>   -->
                    </div>
                </div>
            </div>
			</div>
			 </div>
        </div>
    </div>
</div> 
</div>

</section>

<div class="modal" id="myModal1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cancel</h4>
				<button type="button" class="close" data-dismiss="modal" style="margin-top:-30px;">×</button>
			</div>

			<div class="modal-body">
				<form action="" method="post">
					<input type="hidden" name="cancel" id="cancel" value="" />
						<input type="hidden" name="spSellerProfileId" id=" " value=<?php echo $spid; ?> /> 

					<input type="textarea" name="reason" placeholder=" Why Are You Cancelling This?.." class="form-control" />
			
			</div>

			<div class="modal-footer">
				<button type="submit" name="cancel" value= "cancel" class="btn btn-danger btn-primary">Submit</button>
	</form>
				<!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
			</div>
		</div>
	</div>
</div>

<?php
if($_POST['cancel']){
	
	//die("------------------");
//$msg =" <b>Order Refund Request </b> :You Have New Refund Request CLick Here to view,<a   href='https://dev.thesharepage.com/store/dashboard/statusnew.php?postid=$_GET['postid']' >Click to View </a> ";

$basketid= $_GET['postid'];

$msg =" <b>Order Cancelled </b> : You Have New Cancelled Request CLick Here to view,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$basketid'>Click to View </a> ";
													
													$noti = new _notification;
													
													$data=array('from_id'=>$_SESSION['pid'],
													'to_id'=> $_POST['spSellerProfileId'],
													'message'=>$msg,
													'module'=>"store",
													'by_seller_or_buyer'=> 2
													
													);
													
													$postnoti = $noti->noti_create($data);
													
} 



											 
			
					 if(isset($_POST['refund'])){
						 
						 
						 $msg =" <b>Order Refund Request</b> : You Have New Refund Request CLick Here to view,<a   href='$BaseUrl/store/dashboard/statusnew.php?postid=$basketid'>Click to View </a> ";
													
													$noti = new _notification;
													
													$data=array('from_id'=>$_SESSION['pid'],
													'to_id'=> $_POST['spSellerProfileId'],
													'message'=>$msg,
													'module'=>"store",
													'by_seller_or_buyer'=> 2
													
													);
													
													$postnoti = $noti->noti_create($data);
					 }
?>

<div class="modal" id="myModal2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Refund</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>

			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					 <input type="hidden" name="idspOrder" id="idspOrder" value="<?php echo $id;?>" >
			 <input type="hidden" name="idspPostings" id="idspPostings" value="<?php echo $prid;?>" >
			 <input type="hidden" name="spByuerProfileId" id="spByuerProfileId" value="<?php echo $bpid;?>" >
			 <input type="hidden" name="spBuyeruserId" id="spBuyeruserId" value="<?php echo $buid;?>" >
			 <input type="hidden" name="spSellerProfileId" id="spSellerProfileId" value="<?php echo $spid;?>" >

					<input type="textarea" name="reason" placeholder=" Why Are You Returning This?.." class="form-control" />
					<input type="file" name="image[]" accept="image/*" multiple="multiple" style="display: block;" />
				
			</div>

			<div class="modal-footer">
				<button type="submit" name="refund" class="btn btn-success btn-sm">Submit</button>
               </form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- order.html code end-->

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

<script>
	// A $( document ).ready() block.
	$( document ).ready(function() {

		var posstid = $(this).attr("data-postid") ;
		alert(posstid);
		$("#postids").val(posstid);

	});
	
</script>
