<style>
	span.msgNotify.noti{
    margin-left: 5px!important;
}

.sidenav {
    height: 100%;
    width: 100%;
    z-index: 1;
    left: 0;
    background-color: #666 !important;
    overflow-x: hidden;
}

.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 16px;
  color: white;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.innerPhoto {
    background-color: #2c7be5 !important;
}
li.activepage a {
    font-size: 22px;
}

.container-fluid {
    padding-left: 0px;
}

   .cxgfbfbhdfgfb{ 
	  display:none;
	 }
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 16px;}
}
@media screen and (max-width: 450px) {
   .cxgfbfbhgfb{ 
	  display:none;
	 }
   .cxgfbfbhdfgfb{ 
	  display:block;
	 }
}
.notifiy_n{
	margin-top:3px !important;
}
</style>  
 <?php
    $pageLink = "/artandcraft/dashboard/";
	
		$n = new _notification;	
		$to_id=$_SESSION['pid'];
		$module='artcraft';
		$by_buyer=1;
		$by_seller=2;
		$resnotibuyer = $n->readNotification($to_id,$module,$by_buyer);
		///var_dump($resnotibuyer);
		$resnotiseller = $n->readNotification($to_id,$module,$by_seller);
		 if($resnotibuyer=="")
		 {
			 $noticountbuyer="";
		 }
		 else{
		$noticountbuyer = mysqli_num_rows($resnotibuyer); 
		if($resnotiseller!=false){
		$noticountseller = mysqli_num_rows($resnotiseller); 
		}
		 } ?> 
	
	
  <div id="demo" class="cxgfbfbhdfgfb" style="background-color: #99068a;height: 36px;line-height: 36px;color: white;">
	       <i class="fa fa-bars "  style="cursor: pointer;margin-left: 10px;font-size: 25px;line-height: 39px;" onclick="w3_open()"></i>
	 </div>

<!-- Sidebar -->
<div class="cxgfbfbhgfb" id="mySidebar">
	<div class="sidenav">
    

    <?php
    $pageLink = "/artandcraft/dashboard/";
    ?>

    <ul class="sidebar-menu">
        <!-- seller dashboard by default -->
        <li class="treeview <?php echo ($activePage == 1 || $activePage == 2 || $activePage == 5 || $activePage == 6)?'active' : '';?>">
            <a href="/artandcraft/" style=" text-align: ; background-color: gray !important;font-family:times">
                <span><i class="fa fa-home" aria-hidden="true"></i>  Back To Art and Craft Home</span> 
            </a>
			
            <a href="#" style=" text-align: end; background-color: #959595 !important; ">
                <span><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Buyer</span> 
            </a>
			
                <li class="<?php echo ($activePage == 1)?'activepage' : '';?>">
				
				<a href="<?php echo $BaseUrl.$pageLink;?>"><i class="fa fa-tachometer" aria-hidden="true"></i>  Dashboard </a>
				
				</li>

                <li class="<?php echo ($activePage == 2)?'activepage' : '';?>">
				
				<a href="<?php echo $BaseUrl.$pageLink.'my_order.php'; ?>" >
				
				<i class="fa fa-product-hunt" aria-hidden="true"></i>  My Orders</a>
				
				</li>
                <li class="<?php echo ($activePage == 3)?'activepage' : '';?>">
				
				<a href="<?php echo $BaseUrl.$pageLink.'cancel_order.php'; ?>" ><i class="fa fa-ban" aria-hidden="true"></i>  Cancelled Orders</a>
				
				</li>
                <li class="<?php echo ($activePage == 4)?'activepage' : '';?>">
				
				<a href="<?php echo $BaseUrl.$pageLink.'return_request.php'; ?>" ><i class="fa fa-reply" aria-hidden="true"></i>  Refund Request</a>
				
				</li>
                <li class="<?php echo ($activePage == 5)?'activepage' : '';?>">
				
				<a href="<?php echo $BaseUrl.$pageLink.'your_board.php?page=1';?>"><i class="fa fa-bookmark" aria-hidden="true"></i>  Your Board</a>
				
				</li>
				
                <li class="<?php echo ($activePage == 6)?'activepage' : '';?>">
				
<a href="<?php echo $BaseUrl.$pageLink.'my_favourite.php';?>"><i class="fa fa-gratipay" aria-hidden="true"></i> Favourite </a>
				
				</li>
        </li>
                <li class="<?php echo ($activePage == 14)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'my-enquiry.php'; ?>"><i class="fa fa-question-circle" aria-hidden="true"></i>  Enquiry</a></li>
				<li class="<?php echo ($activePage == 50)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'flag_post.php'; ?>"><i class="fa fa-flag" aria-hidden="true"></i>  Flag Post</a></li>
				
		<!--  	<li class="<?php echo ($activePage == 30)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'flag_post.php'; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>  Flag Post New</a></li> -->
				
                <li class="<?php echo ($activePage == 20)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'buyer-notification.php?readall'; ?>"><i class="fa fa-bell" aria-hidden="true"></i>  Notification<span class="msgNotify  noti notifiy_n"><?php if(!empty($noticountbuyer)){ echo $noticountbuyer; }else{ echo 0; }?></span></a></li>

        <li class="treeview <?php echo ($activePage == 11 || $activePage == 12 || $activePage == 13 || $activePage == 14 || $activePage == 15 || $activepage== 16)?'active' : '';?> ">
            
			
			<a href="#" style=" text-align: end; background-color: #959595 !important; ">
                <span><i class="fa fa-sellsy" aria-hidden="true"></i>  Seller</span> 
            </a>

				<li>
				
				<a  target="_blank" href="<?php echo $BaseUrl.'/post-ad/photos/?post';?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>  Sell Product </a>
				
				</li>
                <li class="<?php echo ($activePage == 11)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'view-order.php'; ?>"><i class="fa fa-first-order" aria-hidden="true"></i>  New Orders</a></li>
				<li class="<?php echo ($activePage == 24)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'shipped_order.php';?>" ><i class="fa fa-check-circle" aria-hidden="true"></i> Shipped Orders</a></li>
                <li class="<?php echo ($activePage == 25)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'delivered_order.php';?>" ><i class="fa fa-check-circle-o" aria-hidden="true"></i>  Delivered Orders</a></li>
				<li class="<?php echo ($activePage == 18)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'seller-cancel.php';?>" ><i class="fa fa-ban" aria-hidden="true"></i>  Cancelled Orders</a></li>
                <li class="<?php echo ($activePage == 19)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'seller-return.php';?>" ><i class="fa fa-undo" aria-hidden="true"></i>  Refunded Orders</a></li>
                
				<li class="<?php echo ($activePage == 12)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'active-art.php?page=1'; ?>" ><i class="fa fa-trophy" aria-hidden="true"></i>  Active Listing</a></li>
                <!-- <li class="<?php echo ($activePage == 13)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'past-art.php';?>" ><i class="fa fa-empire" aria-hidden="true"></i>  Expired Listing</a></li> -->
                <li class="<?php echo ($activePage == 17)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'seller-enquiry.php'; ?>"><i class="fa fa-question-circle" aria-hidden="true"></i>  Enquiry</a></li>
                <li class="<?php echo ($activePage == 16)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'save-draft.php?page=1';?>" ><i class="fa fa-deaf" aria-hidden="true"></i>  Draft Listing</a></li>
                
				
                <li class="<?php echo ($activePage == 21)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.$pageLink.'seller-notification.php?readall';?>" ><i class="fa fa-bell"aria-hidden="true"></i>  Notification<span class="msgNotify noti"><?php if(!empty($noticountseller)){ echo $noticountseller; }else{ echo 0; }?></span></a></li>
        
        </li>
        
    </ul> 
	</div>
</div>


<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
      document.getElementById("demo").innerHTML = '<i class="fa fa-times"  style="cursor: pointer;margin-left: 10px;font-size: 25px;line-height: 39px;"onclick="w3_close()"></i>';
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
      document.getElementById("demo").innerHTML = '<i class="fa fa-bars"  style="cursor: pointer;margin-left: 10px;font-size: 25px;line-height: 39px;" onclick="w3_open()"></i>';
}
</script>
     
</body>
</html> 
