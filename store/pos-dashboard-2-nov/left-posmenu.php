<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">  
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">



<div class="left_grid left_group_gray" id="header" >
    <div class="left_store">
       <div class="left_filter1" style="border: none;">

           <!--<h1><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-arrow-left"></i> Back To Store</a></h1>
		   

           <h1><a href="#" class="buyerboard">Buyer Dashboard</a></h1>-->
           <div class="dashbids">
		   
		   <?php 
		    $st= new _spuser;
									$st1=$st->readdatabybuyerid($_SESSION['uid']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
		   	$n = new _notification;	
		$to_id=$_SESSION['pid'];
		$module='store';
		$by_seller_or_buyer=1;
		$resnoti = $n->readNotification($to_id,$module,$by_seller_or_buyer);
		//var_dump($resnoti);
		if($account_status!=1){
		if($resnoti!=false){
		$noti= $resnoti->num_rows;
		} }else{
		$noti=0;
		}
		   ?>
		   

		     <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/customer.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/customer.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Customer table &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
			 
			  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/vendor.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/vendor.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Vendord table &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
			  
			   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/po.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/po.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>PO table &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
			   
			    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/sales.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/sales.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Sales details table  &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
				
				 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/inventory.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/inventory.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Inventory table  &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
				 
				  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/Membership.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/Membership.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Membership table  &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
           
		   
		      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/current_membership.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/current_membership.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Current Membership Transaction  &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>
               
			 <!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/pos_dashboard/customer_membership.php")?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/store/pos_dashboard/customer_membership.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>Customer Membership   &nbsp;<span style="color:#0f8f46; font-size:18px;"></span></a></li>-->
               


           

            




          

             

                 
		  
		
		  
		   
		  
		  
		 

             </div>

            <!-- <h1><a href="<?php //echo $BaseUrl.'/store/dashboard/faq.php'; ?>">FAQ</a></h1>-->
            

         </div>
     </div>
 </div>

 