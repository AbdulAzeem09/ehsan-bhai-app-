<?php
	include('../univ/baseurl.php');
	session_start();

if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="cart/";
	include_once ("../authentication/check.php");
	
}else{

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <?php include('../component/f_links.php');?>
	   
	</head>
	<body onload="pageOnload('cart')" class="bg_gray">

		<?php
			
			include_once("../header.php");
		?>
		<section class="landing_page">
            <div class="container">
            	<div class="row">
            		<div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <?php include('../component/left-landing.php');?>
                    </div>	
                    
                    <div class="col-md-10">
                    	<div class="cartbox bradius-15">
                    		<div class="cart_header">
                    			<h1 style="color: #032350;"><i class="fa fa-shopping-cart"></i> Cart</h1>
                    			<a href="javascript:void(0)" class="btn empty_cart pull-right db_btn db_primarybtn" data-pid="<?php echo $_SESSION['pid']; ?>" id="emptyorder"><i class="fa fa-shopping-cart"></i> Empty Cart</a>
                    		</div>
                    		<div class="cart_body">
                    			<input class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?> "/>

								
<table class="table table-responsive table-striped table_black_head" >
									<thead style="background-color: #032350;">
										<tr>
											<th>Product Name</th>
											<th>Price ($)</th>
											<th>Quantity</th>
											<th>Sub Total</th>
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody id="cartbody">
										<?php
											$p = new _order;
											$rpvt = $p->readCartItem($_SESSION['uid']);
											//echo $p->ta->sql;
											  if ($rpvt != false){
												while($row = mysqli_fetch_assoc($rpvt))
												{ 	
													$title = $row['spPostingTitle'];
													$m = new _postfield;
													$res = $m->readfield($row["idspPostings"]);
													//echo $m->ta->sql;
													if ($res != false){
														while($rows = mysqli_fetch_assoc($res))
														{
															if($rows["spPostFieldLabel"] == "Start Date"){
																$startdate = $rows["spPostFieldValue"];
															}else{
																$startdate = "0000-00-00";
															}
															
															if($rows["spPostFieldLabel"] == "End Date"){
																$enddate = $rows["spPostFieldValue"];
															}else{
																$enddate = "0000-00-00";
															}
															
															if($rows["spPostFieldLabel"] == "Expiry"){
																$enddate = $rows["spPostFieldValue"];
															}else{
																$enddate = "0000-00-00";
															}
															
															$catid = $rows["spCategories_idspCategory"];
														}
													}
													
													//Quantity Availability
													$pr = new _postfield;
													$re = $pr->quantity($row["idspPostings"]);
													if($re != false)
													{
														$i = 0;
														$rw = mysqli_fetch_assoc($re);
														$totalquantity = $rw["spPostFieldValue"];
													}
													else
														$totalquantity = 0;
													
													$or = new _order;
													$soldquantity  = 0;
													$res = $or->quantityavailable($row["idspPostings"]);
													if($res != false)
													{
														while($order = mysqli_fetch_assoc($res))
														{
															if($order["spOrderStatus"] == 0)
															{
																$soldquantity += $order["spOrderQty"];
															}	
																
														}
													}
													$available = $totalquantity - $soldquantity;
													if($available == 0)
													{
														$max = 1;
													}
													else
														$max = $available;
												//Quantity Availability Completed
												
													$postingid = $row["idspPostings"];

													echo "<tr class='calculatetotal'>";
													echo "<td><a href='../store/detail.php?catid=1&postid=".$row["idspPostings"]."'>".$row['spPostingTitle']."</a></td>";
													$price = $row['spPostingPrice'];
													if($price != false)
														echo "<td class='itemprice'  style='width:15%;' data-itemprice='".$row['spPostingPrice']."'>  $".$row['spPostingPrice']."</td>";
													else
														echo "<td>" ."0000" ."</td>";
													
												
													$quantity = 1;
													
													echo "<td style='width:10%'>

													<input type='number' class='quantity' id='liveQty' style=' border: none; width: 100%;' min='1' max='".$max."' value='".$row['spOrderQty']."' data-title='".$row['spPostingTitle']."' data-available='".$available."' data-postid='".$postingid ."' data-oid='".$row['idspOrder']."' onkeyup='this.value = minmax(this.value, 0, $available)' >
													</input>
													</td>";
													
													$subtotal =	$row['spOrderQty'] * $row['spPostingPrice'];
													
													echo "<td class='subtotal' style='width:10%;' data-subtotal='".$subtotal."'>$" .$subtotal."</td>";

													STATIC $total= 0 ;
													$total = $total + $subtotal;

													echo "<td class='sp-order' data-oid='".$row['idspOrder']."' data-postid='".$postingid ."' data-catid='".$row['spCategories_idspCategory']."'  data-quantity='".$quantity."' data-remainingquant='".$available."' data-subtotal='".$subtotal."'  data-profileid='".$_SESSION["pid"]."' data-startdate='' data-enddate='' data-categoryid='' style='width:10%;'><a href='javascript:void(0)' class='remove_order' data-oid='".$row['idspOrder']."' ><span class='glyphicon glyphicon-remove'></span></a></td>";
													echo "</tr>";
												}
												
												 echo "<tr>";
													echo "<td><b> Total</b></td>";
													echo "<td></td>";
													echo "<td></td>";
													echo "<td id='totalamount'>$".$total."</td>";
													echo "<td></td>";
												 echo "</tr>";

											}		
										?>

									</tbody>
								</table>
								<?php
									$p = new _postingview;
									if (isset($postingid)) {
										$result = $p->read($postingid );
										if($result){
											while($row = mysqli_fetch_assoc($result))
											{
												$categoryid = $row["idspCategory"];
												$p = new _postfield;
												$res = $p->readfield($postingid);
												if ($res != false)
												{
													while($rows = mysqli_fetch_assoc($res))
													{
														if($rows["spPostFieldLabel"] == "Expiry")
															$closingdate = $rows["spPostFieldValue"];
													}
												}
											}
										}
									}else{
										echo "<h3>Cart is empty!</h3>";
									}
								?>

								<div class="row">
									<div class="col-md-12">
										<h3>Shipping Information</h3>
									</div>
									<?php
									$us = new _spuser;
									$result4 = $us->readship($_SESSION['uid']);
									if ($result4) {
										$row4 = mysqli_fetch_assoc($result4);
										$shipname 	= $row4['shipName'];
										$shipmobNum = $row4['shipPhone'];
										$shipemail = $row4["shipEmail"];
										$shipcountry = $row4['country_id'];
										$shipstate = $row4['state_id'];
										$shipcity = $row4['city_id'];
										$shipAdd = $row4['shipAddress'];
										$shipnotshow = 1;
									}else{
										$shipname 	= "";
										$shipmobNum = "";
										$shipemail = "";
										$shipcountry = "";
										$shipstate = "";
										$shipcity = "";
										$shipAdd = "";
										$shipnotshow = 0;
									}
									?>
									<form class="shipform" id="shipform" method="POST" action="" >
										<input type="hidden" name="txtUser" value="<?php echo $_SESSION['uid'];?>" id="txtUser" >
										<div class="col-md-4">
											<div class="form-group">
												<label>Full Name<span>*</span></label>
												<input type="text" name="txtFullName" class="form-control" value="<?php echo ($shipname == "")?'':$shipname; ?>" id="txtFullName" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mobile Number<span>*</span></label>
												<input type="text" name="txtMobNum" class="form-control" value="<?php echo ($shipmobNum == "")?'':$shipmobNum; ?>" id="txtMobNum" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input type="text" name="txtEmail" class="form-control" value="<?php echo ($shipemail == "")?'':$shipemail; ?>" id="txtEmail" >
											</div>
										</div>
										<div class="col-md-4">
		                                    <div class="form-group">
		                                        <label for="spUserCountry" class="control-label">Country<span>*</span></label>
		                                        <select id="spUserCountry" class="form-control " name="spUserCountry">
		                                            <option value="">Select Country</option>
		                                            <?php
		                                            $co = new _country;
		                                            $result3 = $co->readCountry();
		                                            if($result3 != false){
		                                                while ($row3 = mysqli_fetch_assoc($result3)) {
		                                                    ?>
		                                                    <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($shipcountry) && $shipcountry ==$row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
		                                                    <?php
		                                                }
		                                            }
		                                            ?>
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="loadUserState">
		                                    
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label for="spUserState" class="control-label">State<span>*</span></label>
	                                                <select class="form-control" id="spUserState" name="spUserState" >
	                                                    <option>Select State</option>
	                                                    <?php
	                                                    if (isset($shipstate) && $shipstate > 0) {
	                                        				$countryId = $shipcountry;
		                                                    $pr = new _state;
		                                                    $result2 = $pr->readState($countryId);
		                                                    if($result2 != false){
		                                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
		                                                            <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($shipstate) && $shipstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
		                                                            <?php
		                                                        }
		                                                    }
		                                                }
	                                                    ?>
	                                                </select>
	                                            </div>
	                                        </div>
		                                       
		                                </div>
		                                <div class="loadCity">
		                                    
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label for="spUserCity" class="control-label">City<span>*</span></label>
	                                                <select id="spUserCity" class="form-control " name="spUserCity">
	                                                	<option>Select City</option>
	                                                    <?php
	                                                    if (isset($shipcity) && $shipcity > 0) {
	                                        				$stateId = $shipstate;
		                                                    $co = new _city;
		                                                    $result3 = $co->readCity($stateId);
		                                                    //echo $co->ta->sql;
		                                                    if($result3 != false){
		                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
		                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($shipcity) && $shipcity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
		                                                        }
		                                                    }
		                                                }
	                                                    ?>
	                                                </select>
	                                            </div>
	                                        </div>
		                                        
		                                </div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label>Street / Apartment / Unit / Building / Floor<span>*</span></label>
												<input type="text" name="txtaddress" class="form-control" value="<?php echo ($shipAdd == "")?'':$shipAdd; ?>" id="txtaddress" >
											</div>
											<input type="button" name="" id="btnAddShip" class="btn btn-submit db_btn db_primarybtn" value="Save Shipping Info">
										</div>
									</form>
								</div>
								<?php
								// ===PAYPAL ACCOUNT LIVE SETTING
								// RETURN CANCEL LINK
								$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								$success_return = $BaseUrl."/paymentstatus/payment_success.php";
								// ===END
								// ===LOCAL ACCOUNT SETTING
								// RETURN CANCEL LINK
								//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
								// ===END



								//Here we can use paypal url or sanbox url.
								// sandbox
								$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
								// live payment
								//$paypal_url		= 'https://www.paypal.com/cgi-bin/webscr';
								//Here we can used seller email id. 
								$merchant_email = 'developer-facilitator@thesharepage.com';
								// live email
								//$merchant_email = 'sharepagerevenue@gmail.com';
																
								//paypal call this file for ipn
								//$notify_url 	= "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
								?>
								<!--<a href="#" id="checkout" class="btn btn-success pull-right" data-postid="<?php echo $postingid; ?>" data-buyerid="<?php echo $_SESSION['pid']; ?>" data-categoryid="<?php echo $categoryid; ?>" data-expirydate="<?php echo $closingdate; ?>" data-quantity="1"><span class="glyphicon glyphicon-shopping-cart"></span>Checkout</a>-->
								
								
								<form action="<?php echo $paypal_url; ?>" method="post">
									<input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
									<!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
									<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
									<input type="hidden" name="return" value="<?php echo $success_return; ?>">
									<input type="hidden" name="rm" value="2" />
        							<input type="hidden" name="lc" value="" />
        							<input type="hidden" name="no_shipping" value="1" />
        							<input type="hidden" name="no_note" value="1" />
        							<input type="hidden" name="currency_code" value="USD">
        							<input type="hidden" name="page_style" value="paypal" />
        							<input type="hidden" name="charset" value="utf-8" />
									<input type="hidden" name="cbt" value="Back to FormGet" />
									


									<!-- Specify a Buy Now button. -->
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="upload" value="1">

									<?php
										$p = new _order;
										$rpvt = $p->readCartItem($_SESSION['uid']);
										  if ($rpvt != false)
										  {
											  $i = 0;
											while($row = mysqli_fetch_assoc($rpvt))
											{ 	
												$price = 0;
												if(isset($row['spPostingPrice'])){
													$price = $row['spPostingPrice'];
												}
												$quantity = $row['spOrderQty'];

												
												$i = $i+1;
												$string = str_replace(' ', '', $row['spPostingTitle']);
												echo "<input type='hidden' name='item_name_".$i."' value='".$row['idspPostings']."'>";
												echo "<input type='hidden' name='item_number' value='143' >";
												echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_".$i."' value='".$price."'>";
												
												echo "<input type='hidden' id='".$row['idspPostings']."' name='quantity_".$i."' value='".$quantity."'>";
											}
										  }
												
										?>

									<input type="hidden" name="shopping_url" value="http://www.a2zwebhelp.com">
									
									

									
									
									<?php
									if (isset($shipnotshow) && $shipnotshow == 1) {
										?>
										<div class="row no-margin">
											<input class="pull-right"  type="image" name="submit" border="0" src="../assets/images/payment/paypal.png" alt="Buy Now" id="checkout" >
										</div>
										<?php
									}
									?>
									
									<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

								</form>
								
								
								<!--tesing Complete-->
								


                    		</div>
                    	</div>

						
						  


                    </div>
                </div>
            </div>
        </section>
	
 		<?php include('../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/f_btm_script.php'); ?>
        
	</body>
</html>
<?php
}
?>
<script type="text/javascript">
 var number = document.getElementById('liveQty');

// Listen for input event on numInput.
number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}    
function minmax(value, min, max) 
{
   /* if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; */
    if(parseInt(value) > max) 
        return max; 
    else return value;
}

</script>