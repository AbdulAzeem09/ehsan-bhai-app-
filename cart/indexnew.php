<?php
	include('../univ/baseurl.php');
	include( "../univ/main.php");
	session_start();
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
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
			<style type="text/css" media="screen">
				
				
				/*button css*/
				.btn_st_dash_s {
				border-radius: 18px!important;
				}
				.butn_draf {
				color: #fff!important;
				border-radius: 0;
				background-image: -moz-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -ms-linear-gradient(90deg,#f60 0,#fda649 99%);
				font-size: 14px;
				min-width: 130px;
				}
				.butn_draf:focus, .butn_draf:hover {
				color: #fff;
				opacity: .8;
				background-image: -moz-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);
				background-image: -ms-linear-gradient(90deg,#f60 0,#fda649 99%);
				}
				.btn_st_post {
				border-radius: 18px!important;
				color: #fff!important;
				border: 1px solid #0c3c38!important;
				background-color: #0c3c38!important;
				}
				
				.btn_st_post:focus, .btn_st_post:hover {
				color: #fff;
				background-color: #009688;
				border: 1px solid #0c3c38;
				}
				
				ul {
				list-style-type: none;
				}
				
				.butn_save {
				color: #fff;
				border-radius: 30px;
				background-image: -moz-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				background-image: -webkit-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				background-image: -ms-linear-gradient(90deg,#202548 0,#202548 39%,#202548 100%);
				font-size: 14px;
				min-width: 130px;
				}	
				.butn_update{
				color: #fff;
				border-radius: 40px;
				font-size: 14px;
				min-width: 100px;
				font-weight: 20px;
				
				/*background-image: -webkit-linear-gradient(90deg,#f60 0,#fda649 99%);*/
				
				background-image: -webkit-linear-gradient(90deg,#0f8c19 0,#45be51 100%);
				}
				
				.rating-box {
				position:relative!important;
				vertical-align: middle!important;
				font-size: 18px;
				font-family: FontAwesome;
				display:inline-block!important;
				color: lighten(@grayLight, 25%);
				padding-bottom: 10px;
				}
				
				.rating-box:before{
				content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
				}
				
				.ratings {
				position: absolute!important;
				left:0;
				top:0;
				white-space:nowrap!important;
				overflow:hidden!important;
				color: Gold!important;
				
				}
				.ratings:before {
				content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
				}
				
				
			</style>
		</head>
		<body onload="pageOnload('cart')" class="bg_gray">
			
			<?php
				include_once("../header.php");
			?>
			
			<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
   <link rel="stylesheet" href="css/bootstrap.min.css" >
   <!-- Optional theme -->
   <link rel="stylesheet" href="css/bootstrap-theme.min.css">
   <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	 

   <link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/A.style.css+design.css,Mcc.hQAhmIY5uF.css.pagespeed.cf.wVvL7jTLAe.css" />
   <style type="text/css">
    .left_group_gray{
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    } 
    .bsp_row-underline {
        content: "";
        display: block;
        border-bottom: 2px solid #3798db;
        margin-bottom: 20px
    }

    .bsp_deal-text {
        margin-left: -10px;
        font-size: 25px;
        margin-bottom: 10px;
        color: #000;
        font-weight: 700
    }

    .bsp_view-all {
        margin-right: -10px;
        font-size: 14px;
        margin-top: 10px
    }    

    .bsp_bbb_item {
        padding: 15px;
        background-color: #fff;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
        border: solid 1px #e8e8e8
    }

    .bsp_card-text {
        color: blue
    }  
    .total{
        text-align: right;
        font-weight: bolder;
        padding: 25px;
    } 
</style>
</head>
<body cz-shortcut-listen="true">
  <section class="main_box">
    <div class="container">

        <div class="row">            
            <div class="col-md-8">
                <div class="left_group_gray">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="d-flex justify-content-between"><h1>Cart</h1></div>
                        </div>
                        <div class="panel-body">                            
                            <table class="table table-borderless">
                                <th>Seller: <a href="#"> Marina</a>                                   
                                </th>                                                                   
                                    <tr>
                                        <td>
                                            <div class="pull-left" style="padding-right: 10px;">
                                                <img src="https://via.placeholder.com/280x280/87CEFA/000000" alt="" width="35" class="img-fluid" />
                                            </div>
                                            <div class="">
                                                <p><a href="#" class="text-reset">Wireless Headphones with Noise Cancellation Tru Bass Bluetooth</a></p>                                                
                                            </div>

                                        </td>
                                        <td style="white-space: nowrap;"><input type="text" name="qty" value="1" size="1" /> | <a href="#">delete</a> | <a href="#">Save for Later</a></td>
                                        <td class="text-right">$79.99</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0 pull-left" style="padding-right: 10px;">
                                                    <img src="https://via.placeholder.com/280x280/FF69B4/000000" alt="" width="35" class="img-fluid" />
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <p><a href="#" class="text-reset">Smartwatch IP68 Waterproof GPS and Bluetooth Support</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap;"><input type="text" name="qty" value="1" size="1" /> | <a href="#">delete</a> | <a href="#">Save for Later</a></td>
                                        <td class="text-right">$79.99</td>
                                    </tr>
                                
                                
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-right">$159,98</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Shipping</td>
                                        <td class="text-right">$20.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Discount (Code: NEWYEAR)</td>
                                        <td class="text-danger text-right">-$10.00</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">Cart Sub Total</td>
                                        <td class="text-right">$169,98</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td> <button class="btn btn-info text-right" id="" name=""> Pay this Seller</button></td>
                                    </tr>
                            </table>
                                                       
                            <table class="table table-borderless">
                                <th>Seller: <a href="#"> Rocky</a>                                    
                                </th>                                
                                
                                    <tr>
                                        <td>
                                            <div class="pull-left" style="padding-right: 10px;">
                                                <img src="https://via.placeholder.com/280x280/87CEFA/000000" alt="" width="35" class="img-fluid" />
                                            </div>
                                            <div class="">
                                                <p><a href="#" class="text-reset">Wireless Headphones with Noise Cancellation Tru Bass Bluetooth</a></p>                                              
                                            </div>

                                        </td>
                                        <td style="white-space: nowrap;"><input type="text" name="qty" value="1" size="1" /> | <a href="#">delete</a> | <a href="#">Save for Later</a></td>
                                        <td class="text-right">$79.99</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0 pull-left" style="padding-right: 10px;">
                                                    <img src="https://via.placeholder.com/280x280/FF69B4/000000" alt="" width="35" class="img-fluid" />
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <p><a href="#" class="text-reset">Smartwatch IP68 Waterproof GPS and Bluetooth Support</a></p>                                                     
                                                </div>
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap;"><input type="text" name="qty" value="1" size="1" /> | <a href="#">delete</a> | <a href="#">Save for Later</a></td>
                                        <td class="text-right">$79.99</td>
                                    </tr>
                                
                               
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-right">$159,98</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Shipping</td>
                                        <td class="text-right">$20.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Discount (Code: NEWYEAR)</td>
                                        <td class="text-danger text-right">-$10.00</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">Cart Sub Total</td>
                                        <td class="text-right">$169,98</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td> <button class="btn btn-info text-right" id="" name=""> Pay this Seller</button></td>
                                    </tr>
                            </table>
                        </div>
                        <div class="footer total">
                            <div class="">Cart TOTAL: 33,996</div>
                            <button class="btn btn-primary">Go to Check Out</button>
                        </div>                        
                    </div>
                </div>                
            </div>
            <div class="col-md-4">
                <div class="left_group_gray">
                    <div class="panel">
                        <div class="panel-body">                            

                            <h3>Coupon Code</h3>
                            <div>
                                <p>To get awesome discount use your coupon code.</p>
                                <input type="text" name="coupon" placeholder="Enter Coupon Code"/>
                                <button class="btn btn-default">Submit</button>
                            </div>

                            <hr>
                            <h3>Billing address</h3>

                            <address>
                                <strong>John Doe</strong><br />
                                1355 Market St, Suite 900<br />
                                San Francisco, CA 94103<br />
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            <div>
                                <p>Please Add Shipping Address by Clicking on </p>
                                <a href="#">Add Shipping Address</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="left_group_gray">
                    <div class="panel">
                        <div class="panel-body">                            
                             <div class="ibox">
                            <div class="ibox-content">
                                <p class="font-bold">
                                    Other products you may be interested
                                </p>
                                <hr />
                                <div>
                                    <a href="#" class="product-name"> Product 1</a>
                                    <div class="small m-t-xs">
                                        Many desktop publishing packages and web page editors now.
                                    </div>
                                    <div class="m-t text-righ">
                                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                                <hr />
                                <div>
                                    <a href="#" class="product-name"> Product 2</a>
                                    <div class="small m-t-xs">
                                        Many desktop publishing packages and web page editors now.
                                    </div>
                                    <div class="m-t text-righ">
                                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="left_group_gray">
                    <h3>Recently Viwed</h3>
                    <div class="row" style="margin:0px">
                        <div class="col-md-3 bsp_padding-0">
                            <div class="bsp_bbb_item"> 
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-responsive">
                                <h5 class="bsp_card-title">Dell espiron 320GB...</h5>
                                <div class="text-center">
                                    <p class="bsp_card-text">$ 1,399</p>
                                    <p>DELL</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 bsp_padding-0">
                            <div class="bsp_bbb_item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-responsive">
                                <h5 class="bsp_card-title">Dell espiron 320GB...</h5>
                                <div class="text-center">
                                    <p class="bsp_card-text">$ 1,399</p>
                                    <p>DELL</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 bsp_padding-0">
                            <div class="bsp_bbb_item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-responsive">
                                <h5 class="bsp_card-title">Dell espiron 320GB...</h5>
                                <div class="text-center">
                                    <p class="bsp_card-text">$ 1,399</p>
                                    <p>DELL</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 bsp_padding-0">
                            <div class="bsp_bbb_item"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="img-responsive">
                                <h5 class="bsp_card-title">Dell espiron 320GB...</h5>
                                <div class="text-center">
                                    <p class="bsp_card-text">$ 1,399</p>
                                    <p>DELL</p>
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
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="cancel" id="cancel" value="" />

                    <input type="textarea" name="reason" placeholder=" Why Are You Cancelling This?.." class="form-control" />
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" name="cancel" class="btn btn-danger btn-sm">Submit</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Refund</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idspOrder" id="idspOrder" value="374" />
                    <input type="hidden" name="idspPostings" id="idspPostings" value="43" />
                    <input type="hidden" name="spByuerProfileId" id="spByuerProfileId" value="997" />
                    <input type="hidden" name="spBuyeruserId" id="spBuyeruserId" value="385" />
                    <input type="hidden" name="spSellerProfileId" id="spSellerProfileId" value="1925" />

                    <input type="textarea" name="reason" placeholder=" Why Are You Returning This?.." class="form-control" />
                    <input type="file" name="image[]" accept="image/*" multiple="multiple" style="display: block;" />
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" name="refund" class="btn btn-success btn-sm">Submit</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
			
			
			
			
			
							
							<?php include('../component/f_footer.php');?>
							<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
							<?php include('../component/f_btm_script.php'); ?>
							
						</body>
					</html>
					
					<?php
					}
				?>
				<script type="text/javascript">
					
					function saveproductcart(orderId,savestatus){
						
						$.post("saveforlater.php", {orderId:orderId,savestatus:savestatus}, function (data) {
							window.location.reload();
						});
					}
					
					
					
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
					
					function payOnlyThisSeller(sellerid, totalprice){
						$('#selleridforss').val(sellerid);
						$('#total_amountforss').val(totalprice);
						$('#totalpriceforss').html(totalprice);
					}
					
					
				</script>								