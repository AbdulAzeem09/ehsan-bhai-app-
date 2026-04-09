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
									include('left-sellermenu.php'); 
								?>
							</div>
						</div>
						<div class="col-md-10">                        
							
							<?php 
								$storeTitle = "Buyer Dashboard / My Orders";
								$folder = "store";                       
							?>
							<div class="row">
								
								
								<?php
									
									
									
									
									
									if($_GET['status'] == "2"){
												$spord = new _productposting;
												$orid = $_GET['id'];
												$stats = $_GET['status'];
												$data88 = array(
												"shipping_status" => $stats 
												);
												$spord->updateship($data88,$orid);
											}
											
											if($_GET['status'] == "3"){
												$spord1 = new _productposting;
												$orid = $_GET['id'];
												$stats = $_GET['status'];
												$data88 = array(
												"shipping_status" => $stats 
												);
												$spord1->updateship($data88,$orid);
											}
											
											if(isset($_POST['sub3'])){
												$CourierService4 = $_POST['CourierService'];
												$postid4 = $_POST['postid'];
												$ShippedDate4 = $_POST['ShippedDate'];
												$TrackingNumber4 = $_POST['TrackingNumber'];
												
												$datat = array(
												"CourierService" =>  $CourierService4,
												"PostId" =>  $postid4,
												"ShippedDate" =>  $ShippedDate4,
												"TrackingNumber" =>  $TrackingNumber4,
												
												);
												$ship = new _spevent_transection;
												$ship->createshipm($datat); 
												
											}
											
									
									
									
									
									
									
									
									
									
									if(isset($_POST['refund'])){
										$status= array("is_refund"=>1 ,"can_ref_date" => date('d-m-Y'));
										$s=new _spcustomers_basket;
										$st= $s->updatestatus($status,$_GET['postid']);
										
									}
									if(isset($_POST['cancel'])){
										$status= array("is_cancel"=>1,"can_ref_date" => date('d-m-Y'));
										$s=new _spcustomers_basket;
										$st= $s->updatestatus($status,$_GET['postid']);
									}
									
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
											
										if($sippingch==0){
										$sippingch=0;
														}
											if($sippingch==1){
									$left_qty=$qty-1;
									//echo $left_qty;
									//die('===');
									$left_wty_amt= $left_qty *.25*$fixedamount;
							        $sippingch=$fixedamount+$left_wty_amt;
														}
														if($sippingch==2){
															$sippingch=0;
														}
											
											
											$uname	= $st1->readusername($r1['spByuerProfileId']);
											while($r2=mysqli_fetch_assoc($uname)){
												$name= $r2['spProfileName'];
												$userid=$r2['idspProfiles'];
											}
											
											$prname= $st1->readproductname($r1['idspPostings']);
											while($r3=mysqli_fetch_assoc($prname)){
												$productname=$r3['spPostingTitle'];
											}									
										}
									}
									
									
									$sptr = new _spevent_transection;
									$readship = $sptr->readshipm($_GET['postid']);
									if($readship){
										$readship1=mysqli_fetch_assoc($readship);
									}
									$ordertr= $sptr->readtr($_GET['postid']);
									if($ordertr){
										$ordertrs=mysqli_fetch_assoc($ordertr);
										$addresss = $ordertrs['shippAddress'];
									}
								?>
								
							</tr>
							<span style="font-size:20px;">Order Details</span>

							<div class="col-md-12 pro_detail_box" style=" margin: 10px; ">
							
								<div class="row ticket-reply markdown-content staff">
									<div class="col-md-3" style="padding:25px; margin-left: 20px;">
										<b>Delivery Address</b>
										<br>
										<h6><?= $addresss; ?><h6>
										</div>
										<div class="col-md-1" style="padding:40px 0px;">
											<?php
												$pic = new _postingpic;
												$res2 = $pic->read($prid);
												if($res2!=false){
													$rp = mysqli_fetch_assoc($res2);
													$ppic = $rp['spPostingPic'];
												}
											?>
										    <img src="<?= $ppic ?>" width="70px" height="70px"> 
										</div> 
										<div class="col-md-3" style="padding:25px;box-sizing:border-box">
											<b>Product Detail</b><br>
<a href="https://dev.thesharepage.com/friends/?profileid=<?php echo $userid; ?>"><?php echo 'Buyer Name : '.$name; ?></a>
											<h6>Product Id : <?= $prid ?><h6>
<h6><a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=<?php $_GET['postid'];?><?php echo $prid; ?>"><?php echo 'Product Title : '.$prtitle; ?></a><h6>
												<p><?php echo 'Price : '.$price; ?></p>
												<p><?php echo 'Quantity : '.$qty; ?></p>
												
												
												
											</div>
											<div class="col-md-4">
												<h4 style="padding:30px 0px">Download</h4>
												<?php echo 'Total : '.$total; ?>
												
					<p><?php echo 'Shipping Charges : '.$sippingch; ?></p>
					
					<p><?php echo 'Grand Total : '.$sippingch+$total; ?></p>
											</div>
											
											</div>
											<hr>
											
											<div class="row ticket-reply markdown-content staff" style="padding:0px 45px">
											<div class="col-md-6">
											
											
												
												<br>
											
												<?php 
													$sell=new _productposting;
													$sellty= $sell->read($prid);
													
													if($sellty){
														$selltype=mysqli_fetch_assoc($sellty);
														$cancel=$selltype['is_cancel'];
														$refund=$selltype['is_refund'];
														$type=$selltype['sellType'];
														if($type=='Retail'){
															if($can==1 || $ref==1){
																if($can==1){
																	echo "You have cancelled The order";
																}
																if($ref==1){
								echo "	<b>Status</b><br> <span style='color:red;'>Order Refund Request by Buyer on</span>".' '.$dat.'<br><br>';
																}
															}
															else{
																
																if($cancel== 1){ ?>
																<form action="" method="post">
																	<input type="hidden" name="cancel" id="cancel" value="<?php echo $cancel;?>" >
<!--<button type="submit" name="cancel" onclick="return confirm('Are you sure you want to Cancel this item?');"  class="btn btn-danger btn-sm ">Cancel</button>-->
																</form>
																<?php }
																if($refund== 1){?>
																
																<form action="" method="post">   
	<input type="hidden" name="refund" id="refund" value="<?php echo $refund;?>" >
<!--<button type="submit" name="refund" onclick="return confirm('Are you sure you want to Refund this item?');" class="btn btn-success btn-sm">Refund</button>-->
																</form>
																
																<?php 
																}
															}
														}
													}
													
													if($readship1  == ""){
													?>
													<button type="button" class="btn btn-info btn-sm" data-postid="<?= $_GET['postid'] ?>" data-toggle="modal" data-target="#myModal45">Tracking Details</button>
													<?php }else { ?>
													<br>
													<b>Courier Service Name :</b>  <?= $readship1['CourierService'] ?> <br>
													<b>Shipped Date  :</b>   <?= $readship1['ShippedDate'] ?> <br>
													<b>Tracking Number  :</b>   <?= $readship1['TrackingNumber'] ?>
													
													<div class="row">
														<div class="col-md-6">
															
															<?php
															
															
								$spord3 = new _productposting;
					$status3 =$spord3->readshiptm($_GET['postid']);
					if($status3 != false){
							$data99 = mysqli_fetch_assoc($status3);
																//die('=======');
																$shipst =  $data99['shipping_status'];
																
					}
															?>
											
											
		<select class="form-control" onchange="location = this.value;">
				<option value="" selected="selected" >Option</option>
				
	<option value="new_sellerstatus.php?status=2&id=<?= $_GET['postid'] ?>" <?php if($shipst == '2'){ echo 'selected'; } ?>>Shipped</option>
	
	<option value="new_sellerstatus.php?status=3&id=<?= $_GET['postid'] ?>" <?php if($shipst == '3'){ echo 'selected'; } ?>>Delivered</option> 
															</select>
														</div>
														
													</div>
												
													
													
													
													
												<?php } ?>
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
											<div class="row float-right">
											<div class="col-md-12">
												<div class="float-left" >Refunded Images</div>
												
												
												<?php if($ref==1)
												{
											
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
										
										
										<?php  
											
											
											
											
											$p = new _orderSuccess;
											$or = new _order; 
											$result = $p->readmyOrder($_SESSION['pid']);
											
											if ($result) {
												$i = 1;
												while ($row = mysqli_fetch_assoc($result)) {
													extract($row);
													$dt = new DateTime($payment_date);
													$sp = new _spprofiles;
													
													$spbuyresult  = $sp->read($spProfile_idspProfile);
													if($spbuyresult != false)
													{
														$buyrow = mysqli_fetch_assoc($spbuyresult);
														$buyername = $buyrow["spProfileName"];
													}
													$result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);
													
													if ($result2) {
														while ($row2 = mysqli_fetch_assoc($result2)) {
															$buyerprofilid = $row2['spByuerProfileId'];
															$sellerprofilid = $row2['spSellerProfileId'];
															$orderdate = $row2['sporderdate'];
															$trancsectionid = $row2['txn_id'];
															$sellproducttitle = $row2["spPostingTitle"];
															$sporderAmount = $row2["sporderAmount"];
															$spOrderQty = $row2['spOrderQty'];
															
															$sp = new _spprofiles;
															$spsellresult  = $sp->read($sellerprofilid);
															
															if($spsellresult != false)
															{
																$sellrow = mysqli_fetch_assoc($spsellresult);
																$sellername = $sellrow["spProfileName"];
															}
															$pp = new _productpic;  
															
															$sellpic = $pp->read($sellpostid);
															if($sellpic != false){
																
																$sellrowpic = mysqli_fetch_assoc($sellpic);
																$sellProductimg   = $sellrowpic['spPostingPic'];
															}         
															$firstname = $row['first_name'];
															$lastname = $row['last_name'];
															
															
															$orderhtml ='
															<html lang="en-US">
															
															<head>
															
															<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
															
															<style>
															
															.showeventrating{
															margin-left: 45px;
															margin-right: 45px;
															margin-bottom: 10px;
															}
															
															.pdftablehead{
															font-weight: bold;
															font-size: 16px;
															}
															tr td{
															padding: 15px;
															line-height: 1.42857143;
															vertical-align: top;
															border-top: 1px solid #ddd;
															}
															.tddata{
															padding-left : 14px;
															text-transform: capitalize;
															}
															.textboxcenter{
															
															border:1px solid black;
															width:50%;
															height:100px;
															margin-left: 180px;
															
															}
															.trdata .newtddata{
															padding: 7px!important;
															border:none!important;
															vertical-align: top!important;
															padding-left : 60px;
															
															}
															.bordernone{
															border:none!important;
															}
															
															
															</style> 
															
															</head>    
															
															<body class="bg_gray">
															
															<section class="main_box">            
															<div class="container">
															
															
															<div class="row">
															
															
															<div class="col-md-12">
															<div class="bg_white detailEvent m_top_10">
															
															
															
															<div class="row">
															<div class="showeventrating">
															
															
															<p style="text-align:center; padding-top:20px;"> <img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
															<p style="font-size: 30px; text-align:center;">The SharePage</p>
															<div class="textboxcenter">
															<div class="col-md-6">                                 
															<table class="table">
															
															
															<tbody>
															<tr class="trdata">
															<td class="pdftablehead newtddata" style="padding-top:40px;">Title :</td>
															<td class="tddata newtddata" style="padding-top:40px;">'.$sellproducttitle.'</td>
															
															</tr>
															
															</tbody>
															</table>
															
															</div>
															
															</div>
															
															
															
															<br>
															
															
															
															<div class="row">
															<div class="col-md-6" style="width:50%; float:left;">                                 
															<table class="table">
															
															<tbody>
															<tr style="border:none!important;">
															<td class="pdftablehead" style="border:none!important;" >Name : </td>
															<td class="tddata" style="font-weight:bold; border:none!important;">'.$firstname.'    '.$lastname.'</td>
															
															</tr>
															<tr>
															<td class="pdftablehead">Sold By :</td>
															<td class="tddata">'.ucwords($sellername).'</td>
															
															</tr>
															
															<tr>
															<td class="pdftablehead">Total Price :</td>
															<td class="tddata">$'.$sporderAmount.'</td>
															
															</tr>
															</tbody>
															</table>
															
															</div>
															<div class="col-md-6"  style="width:50%;float:right;">
															<table class="table">
															
															<tbody>
															<tr style="border:none!important;">
															<td class="pdftablehead" style="border:none!important;">Quantity : </td>
															<td class="tddata" style="padding-left:20px; border:none!important;">'.$spOrderQty.'</td>
															
															</tr>
															<tr>
															<td class="pdftablehead">Ship To :</td>
															<td class="tddata" style="padding-bottom:35px;">'.$buyername.'</td>
															
															</tr>
															
															</tbody>
															</table>
															
															</div>
															</div>
															
															
															
															<hr>
															<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Order Placed : '.date("Y-m-d H:i:A",strtotime($orderdate)).'</p>
															
															
															
															<div style="float:left; padding-left: 12px;" >
															<p font-size: 12px;>'.$row['remark'].' <br> Transaction ID : '.$trancsectionid.'</p>
															</div>
															
															<p style="text-align:center; padding-top:230px;">Paid Online From- www.TheSharePage.com</p>
															</div>
															</div>
															</div>
															</div>
															</div>
															</div>
															
															</section>
															</body>
															</html>';                                                            
														}
													}
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $txn_id; ?></td>
													<td><?php echo  $amount; ?></td>
													<td><?php echo  $buyername;?></td>
													<td><?php echo $dt->format('d-M-Y'); ?></td>
													<td  class="text-center">
														<a href="<?php echo $BaseUrl.'/store/dashboard/storeinvoice.pdf'?>" class="btn"  id="btnPDF" style="color: #fff!important;  background-color: #CCA5C6;">Invoice</a>
														<a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php?txnid='.$txn_id?>" class="btn" style="color: #fff!important;background-color: #A2DE54;">Order Detail</a>
													</td>
												</tr>
												<?php
													$i++;
												}
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						<?php   $p = new _orderSuccess;
							$or = new _order; 
							$result = $p->readmyOrder($_SESSION['pid']);
							if ($result) {
								$i = 1;
								while ($row = mysqli_fetch_assoc($result)) {
									extract($row);
									$dt = new DateTime($payment_date);
									
									
									$result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);
									if ($result2) {
										
										while ($row2 = mysqli_fetch_assoc($result2)) {          
											$buyerprofilid = $row2['spByuerProfileId'];
											
											$sellerprofilid = $row2['spSellerProfileId'];
											$sellpostid = $row2["idspPostings"];
											
											$idspOrder = $row2["idspOrder"];
											$spOrderQty = $row2['spOrderQty'];
											
											$sp = new _spprofiles;
											
											$spbuyresult  = $sp->read($buyerprofilid);
											if($spbuyresult != false){
												$buyrow = mysqli_fetch_assoc($spbuyresult);
												$buyername = $buyrow["spProfileName"]; 
											}
											$pp = new _productpic;  
											
											$sellpic = $pp->read($sellpostid);
											if($sellpic != false){
												
												$sellrowpic = mysqli_fetch_assoc($sellpic);
												
												$sellProductimg   = $sellrowpic['spPostingPic'];
											}         
										?>
										
										<div class="row">
											<div class="col-md-12" style="margin-top: 15px;">
												<div class="panel with-nav-tabs panel-info">
													<div class="panel-heading" style="padding: 22px 10px;">
														<ul class="nav nav-tabs">
															<div class="col-md-3">
																<li class="active">Order Placed  <br>
																<?php echo $dt->format('d-M-Y'); ?></li>
															</div>
															
															<div class="col-md-3">
																<li>TOTAL <br>
																	<?php echo'$'. $amount; ?>
																</li>
															</div>
															
															<div class="col-md-3">
																<li class="eventcapitalize">SHIP TO  <br>
																<?php echo $buyername;?></li>
															</div>
															
															<div class="col-md-3">
																<li>ORDER <?php echo $txn_id; ?><br>
																</div>
															</ul>
														</div>
														<div class="panel-body">
															<div class="tab-content">
																<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
																	<div class="col-md-8">
																		<div class="col-md-4"> 
																			<?php  
																				if ($sellProductimg) {
																					echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($sellProductimg) . "' style='height: 130px;' >";
																					
																					}else{
																					echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive' style='height: 130px;'>";
																				}
																			?>
																		</div>
																		<div class="col-md-8">
																		</div>
																	</div>
																	<div class="col-md-4">
																		<a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php';?>" class="btn btntrackorder">Order Detail</a>
																		<a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>" class="btn btnwithorder">Invoice</a>
																	</div>
																</div>   
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php
												
											}
										}
									}
								} ?> 
						</div>   
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

<script>
	// A $( document ).ready() block.
	$( document ).ready(function() {
	
	var posstid = $(this).attr("data-postid") ;
	alert(posstid);
	$("#postids").val(posstid);
	
	});
</script>
