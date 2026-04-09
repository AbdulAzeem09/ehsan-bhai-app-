<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
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
	//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->       
        <?php include('../../component/dashboard-link.php'); ?>
        
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
                    <!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 133;
                        //include('left-menu.php'); 
                        ?> 
                    </div> -->
                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-buyermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
						
						
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
						
						
                        $storeTitle = "Buyer Dashboard / My Orders";
                        $folder = "store";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row">
                           <!--   <div class="col-md-12">
                                    

                                     <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">My Order History</a></li>
                                  
                                    </ul>
                    


                                <div class="text-right" style="margin-top: -10px;">
                                       <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||$activePage == 133)?'active':''?>">Buyer Dashboard</a></li>
                                    </ul>
                              

                                </div>
                            </div>

                     
                         <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">My Order History</a></li>
                                     
                          </ul>
                            </div>

                           
                         <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" >ID</th>
                                                    <th class="text-center">Product Name</th>
                                                    
                                                    <th class="text-center">Product Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center" >Order Date</th>

                                                    <th  class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> -->
             <?php 
				 
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
					 
					
					}
				 
				 
				 
				 ?>                                   
												
												
										
					<?php
					
					if(isset($_POST['refund'])){
$status= array("is_refund"=>1 ,"reason"=>$_POST['reason'], "can_ref_date"=>date('Y-m-d H:i:s '));
					 $s=new _spcustomers_basket;
				     $st= $s->updatestatus($status,$_GET['postid']);
					 
					
					}
					if(isset($_POST['cancel'])){
				 $status= array("is_cancel"=>1, "reason"=>$_POST['reason'], "can_ref_date"=> date('Y-m-d H:i:s '));
					 $s=new _spcustomers_basket;
				     $st= $s->updatestatus($status,$_GET['postid']);
					
					}
					
												
												$st= new _orderSuccess;
                                                 $status= $st->readdetails($_GET['postid']);
			 
			 
			                                if($status!=false){
												//print_r($status);die;
												$i=1;
											while($r1=mysqli_fetch_assoc($status)){
											
										//print_r($r1);
										     $id=$r1['idspOrder'];
											 $prid=$r1['idspPostings'];
											 $bpid=$r1['spByuerProfileId'];
											 $buid=$r1['spBuyeruserId'];
											 $spid=$r1['spSellerProfileId'];
											 
											$price=$r1['sporderAmount'];
											$shipping_stat=$r1['shipping_status'];
											$qty=$r1['spOrderQty'];
											$can=$r1['is_cancel'];
											$ref=$r1['is_refund'];
											$date=$r1['can_ref_date'];
											
											$username= new _orderSuccess;
                                            $uname	= $username->readusername($r1['spByuerProfileId']);
						                 	while($r2=mysqli_fetch_assoc($uname)){
									//echo "<pre>";
									//print_r($r2);
								$name= $r2['spProfileName'];
								$userid=$r2['idspProfiles'];
							//	echo $name;
							}
												
												
												
												$productname= new _orderSuccess;
                                 $prname= $productname->readproductname($r1['idspPostings']);
								while($r3=mysqli_fetch_assoc($prname)){
									//echo "<pre>";
									//print_r($r3);
									$productname=$r3['spPostingTitle'];
									//echo $productname;
								}	
								
											
											
											
											
											
											
			 }}
		
											/*	?>
												<tr>
								<td class="text-center"><?php echo $i; ?></td>
								<td class="text-center"><?php echo $r1[''];?></td>
								<td class="text-center"><?php echo $r1['sporderAmount'];?></td>
								<td class="text-center"><?php echo $r1['spOrderQty'];?></td>
								<td class="text-center"><?php echo $r1['sporderdate'];?></td>

												
												

												
												<?php 
												$i++;
												
												}*/?>
											
												</tr>
												
												<!-- Button trigger modal -->


<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cancel</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="" method="post">
			<input type="hidden" name="cancel" id="cancel" value="<?php echo $cancel;?>" >
		 
			<!-- Button to Open the Modal -->

			 
			 <input type="textarea" name="reason" placeholder=" Why Are You Cancelling This?.."     class="form-control">
			
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <button type="submit" name="cancel"  class="btn btn-danger btn-sm ">Submit</button>
	  </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Refund</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form action="" method="post" enctype="multipart/form-data" >
			
			 <input type="hidden" name="idspOrder" id="idspOrder" value="<?php echo $id;?>" >
			 <input type="hidden" name="idspPostings" id="idspPostings" value="<?php echo $prid;?>" >
			 <input type="hidden" name="spByuerProfileId" id="spByuerProfileId" value="<?php echo $bpid;?>" >
			 <input type="hidden" name="spBuyeruserId" id="spBuyeruserId" value="<?php echo $buid;?>" >
			 <input type="hidden" name="spSellerProfileId" id="spSellerProfileId" value="<?php echo $spid;?>" >
			 
			 <!-- Button to Open the Modal -->

			
	  <input type="textarea" name="reason" placeholder=" Why Are You Returning This?.."     class="form-control">
	   <input  type="file" name="image[]" accept="image/*" multiple="multiple" style="display: block;" /> 
       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <button type="submit" name="refund"  class="btn btn-success btn-sm">Submit</button>
	   </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<span style="font-size:20px;">Order Details</span>
	<div class="col-md-11 pro_detail_box" style=" margin: 10px; ">
		<div class="row ticket-reply markdown-content staff">
			<div class="col-md-6">
            <div class="user">
                <span class="name">
                    Product Details
                </span>
            </div>
            <div class="message1">
			 
					<?php 
						
						echo 'Product Id : '.$prid; ?><br>
<a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=<?php echo$prid; ?>"><?php echo 'Product Title : '.$productname; ?></a><br>
					
					<?php echo 'Price : '.$price; ?><br>
					<?php echo 'Quantity : '.$qty; ?><br>
				<a href="https://dev.thesharepage.com/friends/?profileid=<?php echo $userid; ?>"><?php echo 'Buyer Name : '.$name; ?></a><br>
			
				
				
				<?php 
					
				
				
					
				 $sell=new _productposting;
				 $sellty= $sell->read($prid);
				 
				 if($sellty!=false){
				// die('====');
				 $selltype=mysqli_fetch_assoc($sellty);
				//die('=====agdfhft=====');
				//print_r($selltype);
					$cancel=$selltype['is_cancel'];
					$refund=$selltype['is_refund'];
				    $type=$selltype['sellType'];
					$refundwithin=$selltype['refund_within'];
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
					
					$read=mysqli_fetch_assoc($rad);
					
					$st=$read['status'];
						//echo $st;
						
						if($st==0){
						echo "Refund Status : Pending";
						}
						
						if($st==1){
						echo "Refund Status : Accepted";
						}
						
						
						if($st==2){
						echo "Refund Status : Rejected";
						}
						
						echo "<br>You have refunded the order on ".' '.$date;
						
						}
						}
						
						else{
						
						
					if($cancel== 1){
					$a= new _productposting;
					$an= $a->readshipstatus($_GET['postid']);
					
					if($an!=false){
					$anoop= mysqli_fetch_assoc($an);
					
					//print_r($anoop);
					$sta= $anoop['shipping_status'];
					}
					if($sta==0 || $sta== 2)
					{
				
					?>
					
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
  Cancel
</button>
					
					<?php }}
					if($refund == 1){
						if($sta==3){
						
						?>
					
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
  Refund
</button>
					
					
						<?php 		}}
					
						}?><br> 
						
					<?php 
					
					
					
					
					
					?>
					
				<?php 	}
					
					?>
					
					
             </div>
			<p><?php if($refund == "1"){echo "Refund within $refundwithin days";} ?></p>
			
			 
			 <?php 
				 if(isset($_POST['submit']))
				 
				 ?>
			 </div>
			 <?php $sptr = new _spevent_transection;
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
									<div class="col-md-3" style="padding:25px; margin-left: 20px;">
										<b>Shipping Address</b>
										<br>
										<h6><?= $addresss; ?><h6>
										</div>
										
										
										
										
			<div class="col-md-6">
			
			
			 <?php
			 if($shipping_stat == "2"){
				 echo "Your Order Status  :"." Product Has Been Shipped";
				 }elseif($shipping_stat == "0"){
				  echo "Your Order Status :"."In Proccess";
				 }elseif($shipping_stat == "3"){
				  echo "Your Order Status  :"."Product Has Been Delivered";
				 }
			 
			    $pic = new _postingpic;
				$res2 = $pic->read($prid);
				//print_r($res2);die;
			if($res2!=false){
		
				while ($rp = mysqli_fetch_assoc($res2)) {
					echo $rp['spPostingPic'];
					//print_r($rp);
						//$rp['spPostingPic'];
				}
					}
			 ?>
			 
<a href="/artandcraft/detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><img width="100px" src="<?php echo $rp['spPostingPic']; ?>" class="img-responsive"></a><br><br><br><br><br>&nbsp;
<?php echo 'Total : '.$qty*$price; ?>
			</div>
			<div class="col-md-6">
										
											<div class="row float-left">
											<div class="col-md-12">
												<div class="float-left" >Refunded Images</div>
												
												
												<?php if($ref==1)
												{
											
											$p= new _spprofiles;
			                                $pf= $p->readimg($_GET['postid']); 
											
											while($img=mysqli_fetch_assoc($pf)){
											//print_r($img);
											$image=$img['image'];
		echo  "   <div class='col-md-3' style='display: inline-block; padding-top:20px;'><img src='$BaseUrl/store/dashboard/images/".$image."' alt='image' width='100' height='100' />"; ?>
		
												</div>&nbsp;&nbsp;&nbsp;
											
										<?php 	} } ?>
											
												
											
				</div>
				</div>
				</div>
			    </div>
																		
			
        </div>
		
                                                
</div>
										
												<?php 
												
												
												
                                                $p = new _orderSuccess;
                                                $or = new _order; 
                                                $result = $p->readmyOrder($_SESSION['pid']);
                                            //   echo $p->ta->sql;


                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                         
                                                      /*echo "<pre>";   
                                                      print_r($row);*/
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
                                       

                                    //   echo $or->ta->sql;
                                           if ($result2) {
                                                                   
                                            while ($row2 = mysqli_fetch_assoc($result2)) {

                                            // echo"<pre>";
                                            // print_r($row2);

                                                $buyerprofilid = $row2['spByuerProfileId'];

                                              $sellerprofilid = $row2['spSellerProfileId'];

                                               $orderdate = $row2['sporderdate'];

                                              $trancsectionid = $row2['txn_id'];
                                                        
                                                              
                                             $sellproducttitle = $row2["spPostingTitle"];

                                               $sporderAmount = $row2["sporderAmount"];
                                                                
                                            
                                                   $spOrderQty = $row2['spOrderQty'];


                                                      $sp = new _spprofiles;
                                                 $spsellresult  = $sp->read($sellerprofilid);
                                                                   
                                                    //  echo $sp->ta->sql;
                                                   if($spsellresult != false)
                                                                       {
                                                              $sellrow = mysqli_fetch_assoc($spsellresult);
                                                              $sellername = $sellrow["spProfileName"];
                                                    }
                                                     $pp = new _productpic;  

                                                 $sellpic = $pp->read($sellpostid);
                                                 // echo $pp->ta->sql;
                                                        if($sellpic != false){
          
                                                                  $sellrowpic = mysqli_fetch_assoc($sellpic);
                                                                  $sellProductimg   = $sellrowpic['spPostingPic'];
                        
                        

                                                                       }         

                                                                    
                                                        

                                                               // echo $orderdate;
                                                               // echo $trancsectionid;       
/*
 $Date = new DateTime($eventdetail['spPostingDate']);
 $startTime = $eventdetail['spPostingStartTime'];
 $dtstrtTime = strtotime($startTime);*/
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

                                                  <!--  <a href="<?php echo $BaseUrl.'/events/eventticket.pdf' ?>" class="" id="btnPDF"><i class="fa fa-file-pdf-o "></i></a> -->

                                                              
                                                  <a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php?txnid='.$txn_id?>" class="btn" style="color: #fff!important;background-color: #A2DE54;">Order Detail</a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                        $i++;



//echo $orderhtml;                                                    
                                                    }
                                                }
                                                /* else{
												 
                                                  ?>
                                                  <tr>
                                                      <td colspan="7">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }*/
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



















            <!-- new design -->
                            <!--  <div class="col-md-12 ">
                              <div class="store_detailcenter_1 bg_white">
                                <div class="row">
                                <div class="col-md-4">
                              <h3 class="eventcapitalize">My Order History</h3>
                            </div>
                     
        </div>
                           
         <?php   $p = new _orderSuccess;
                  $or = new _order; 
                 $result = $p->readmyOrder($_SESSION['pid']);
           //   echo $p->ta->sql;
            // print_r($result);

         if ($result) {
                               $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                 extract($row);
                              $dt = new DateTime($payment_date);

                        
                                    $result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);

                                                

// echo $or->ta->sql;
                                    if ($result2) {
                                                                   
                                   while ($row2 = mysqli_fetch_assoc($result2)) {

                                                       //print_r($row2);

                                                                
                                      $buyerprofilid = $row2['spByuerProfileId'];

                                     $sellerprofilid = $row2['spSellerProfileId'];
                                     $sellpostid = $row2["idspPostings"];

                                        $idspOrder = $row2["idspOrder"];

                                                                

                                        $spOrderQty = $row2['spOrderQty'];

                                             $sp = new _spprofiles;

                                              $spbuyresult  = $sp->read($buyerprofilid);
                                                 if($spbuyresult != false)
                                                                       {
                                                              $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                              $buyername = $buyrow["spProfileName"];
   

                                                                    
                                                                }



                                                         $pp = new _productpic;  

                                                      $sellpic = $pp->read($sellpostid);
                                                 // echo $pp->ta->sql;
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
          }else{  ?>
                                            
                     <center><div style='min-height: 300px; font-size: 16px; padding-top: 100px;' >No Record Found</div></center>
                                               
              
                                                      
                       <?php }  ?>
                                               
        

                             </div>   
                             </div> -->

                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
      
    <?php   
include '../../assets/mpdf/mpdf.php';

$mpdf = new mPDF();

//$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf

$mpdf->WriteHTML($orderhtml);

//$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("storeinvoice.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?>
  
    </body>
</html>
<?php
}
?>