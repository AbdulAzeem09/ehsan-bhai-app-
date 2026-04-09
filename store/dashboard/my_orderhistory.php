<?php
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
                        $activePage = 15;
                      //  include('left-menu.php'); 
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
                        $storeTitle = "Buyer Dashboard / My Orders";
                        $folder = "store";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row">

                        
                               <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard';?>">Seller Dashboard</a></li>
                                       <li><a href="#">My Order History</a></li>
                                     
                          </ul>
                            </div>
                            <!--  <div class="col-md-12">
                                    

                                     <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">My Order History</a></li>
                                     
                                    </ul>
                    


                                <div class="text-right" style="margin-top: -10px;">
                                       <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                    </ul>
                               

                                </div>
                            </div>
 -->
<!-- table list open -->
<!-- 
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>TXN Number</th>
                                                    <th>Payer Id</th>
                                                    <th class="text-center">Price</th>
                                                    <th>Order Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _orderSuccess;
                                                $or = new _order; 
                                                $result = $p->readmyOrder($_SESSION['pid']);
                                               //echo $p->ta->sql;


                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        $dt = new DateTime($payment_date);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td><?php echo $payer_id; ?></td>
                                                            <td class="text-center"><?php echo $currency.' '. $amount; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            <td>
                                                                <?php
                                                                $result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);

                                                                  //echo $or->ta->sql;


                                                                if ($result2) {
                                                                   
                                                                     while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                    if ($row2['spOrderStatus'] == 0) {
                                                                        echo "Wait for shipping";
                                                                    }else if($row2['spOrderStatus'] == 1){
                                                                        echo "Prepare Order To Ship";
                                                                    }else if($row2['spOrderStatus'] == 2){
                                                                        echo "On Way";
                                                                    }else if($row2['spOrderStatus'] == 3){
                                                                        echo "Delivered";
                                                                    }


                                                                    $sporderid = $row2['idspOrder'];
                                                                }
                                                            }
                                                                ?>
                                                            </td>
                                                            <td>
                                                  <a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>">Invoice</a>

                                                              
                                                              <?php 

                                                           $er = new _spstorereview_rating;
                                                           $re_res =  $er->read($_SESSION['pid'],$cid);

                                                            $row_re = mysqli_fetch_assoc($re_res);

                                                                                      
                                                                                
                                                     if($re_res->num_rows == 0){
                                                                                     ?>

  <a href="<?php echo $BaseUrl.'/store/dashboard/mystorereview.php?orderid='.$cid; ?>" class=""><i class="fa fa-star"></i></a>
     <?php
                                                                                }

                                                                                  ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                 else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="7">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
 -->

<!-- table data close -->
                            <!-- new design -->
                             <div class="col-md-12 ">
                              <div class="store_detailcenter_1 bg_white">
                                <div class="row">
                                <div class="col-md-4">
                              <h3 class="eventcapitalize">My Order History</h3>
                            </div>
                              
                            <form method="POST" action="my_orderhistory.php">
                                <div class="col-md-6" style="margin-top: 10px;">
        
            <div id="custom-search-input">
              
                <div class="input-group col-md-12">
                  <input type="hidden" name="txtSearchCategory" value="1">

                    <input type="text" class="form-control input-lg" name="txtStoreSearch"  value="<?php if(isset($_POST['txtStoreSearch'])){ echo $_POST['txtStoreSearch'];}?>" style="height: 36px;"placeholder="Search All Orders" />
                                    

                                      
 
                    <span class="input-group-btn">
                        <button type="submit" name="btnSearchStore" class="btn btn-info btn-lg">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>


            
            </div>
          </div>
            <div class="col-md-2" style="margin-top: 10px;">
            <button type="submit" name="btnSearchStore" class="btn searchorder_butn" id="Buynow" style="border-radius: 10px; font-weight: bolder;">Search Orders</button>
        </div>
         </form>
        </div>
                           
         <?php   $p = new _orderSuccess;
                  $or = new _order; 
            $result = $p->readmyOrder($_SESSION['pid']);

               if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

              //  $searchprofileId   = $cid;

            
               
                                    //public store
                           $result2 = $or->searchreadOrderTxn($_SESSION['pid'],$txtStoreSearch);
                            //  echo $or->ta->sql;

                         //  print_r($result);

                              }/*else if ($result) {
                               $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                 extract($row);
                              $dt = new DateTime($payment_date);*/

                               else{

                                  $result2 = $or->readOrderTxn($_GET['txnid'], $_SESSION['pid']);

                                    // echo $or->ta->sql;

                                    }               

                                     //echo $or->ta->sql;

                                          
                                  if ($result2) {
                                                  $i = 1;                   
                                            while ($row2 = mysqli_fetch_assoc($result2)) {

                                            //  echo "<pre>";

                                            // print_r($row2);

                                                       

                                             $txn_id = $row2['txn_id'];

                                                                
                                             $buyerprofilid = $row2['spByuerProfileId'];

                                              $sellerprofilid = $row2['spSellerProfileId'];

                                             $sellpostid = $row2["idspPostings"];
                                                              
                                             $sellproducttitle = $row2["spPostingTitle"];

                                               $sporderAmount = $row2["sporderAmount"];
                                                                
                                               $idspOrder = $row2["idspOrder"];
                                                   $spOrderQty = $row2['spOrderQty'];

                                                    $sporderdate = $row2['sporderdate'];


                                                      $ordt = new DateTime($sporderdate);

                                                   



                                                                    $sp = new _spprofiles;

                                                                 $spbuyresult  = $sp->read($buyerprofilid);
                                                                    if($spbuyresult != false)
                                                                       {
                                                              $buyrow = mysqli_fetch_assoc($spbuyresult);
                                                              $buyername = $buyrow["spProfileName"];
   

                                                                    
                                                                }

                                                                 $spsellresult  = $sp->read($sellerprofilid);
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

                                                                ?>
                               
          <div class="row">
           <div class="col-md-12" style="margin-top: 15px;">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading" style="padding: 22px 10px;">
                        <ul class="nav nav-tabs">
                          <div class="col-md-3">
                            <li class="active">Order Placed  <br>
                               <?php echo $ordt->format('d-M-Y'); ?></li>
                            </div>

                             <div class="col-md-3">
                            <li>TOTAL <br>
                               <?php echo'$'. $sporderAmount; ?>
                             </li>
                            </div>

                             <div class="col-md-3">
                            <li class="eventcapitalize">SHIP TO  <br>
                               <?php echo $buyername;?></li>
                            </div>

                             <div class="col-md-3">
                            <li>ORDER <?php echo $txn_id; ?><br>
                              <!--  <a href="">Order Detail</a> | <a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>">Invoice</a></li> -->
                            </div>

                           
                            <!-- <li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4info" data-toggle="tab">Info 4</a></li>
                                    <li><a href="#tab5info" data-toggle="tab">Info 5</a></li>
                                </ul>
                            </li> -->
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
         <div class="row" style="margin-top: 30px;margin-bottom: 20px;">
                    <div class="col-md-8">
                      
                    <!--  <h4 style="padding-bottom: 10px;padding-left: 10px;">Arriving 4May-26May</h4> -->
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
                      <h3 class="eventcapitalize" style="margin-top: 0px;"><?php echo $sellproducttitle;?></h3>
                      <p class="eventcapitalize">Sold By: <?php echo $sellername;?></p>

                       <p>Quantity: <?php echo  $spOrderQty;?></p>  
                       <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$sellpostid;?>" class="btn btnbuyagain">Buy it again</a>


                     </div>
                    </div>
                                         
                     
                     <div class="col-md-4">
                          <a href="javascript:void(0)"data-toggle="modal" data-target="#track<?php echo $idspOrder;?>" class="btn btntrackorder">Track Package</a>
    <!-- Modal -->
<div class="modal fade" id=track<?php echo $idspOrder;?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" style="width: 840px!important;">

       <!--     <form id="sellerreplyform" enctype="multipart/form-data"> -->
            <div class="modal-content no-radius bradius-15">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h3 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Track Order</h3>

                </div>
                   <div class="modal-body">


                <table class="table tbl_store_setting">
                    <thead>
                        <tr>
                            <!-- <th>Order#</th> -->
                            
                            <th>Ship Company Name</th>
                            <th>Track ID</th>
                            <th>Ship Date</th>
                            <th  class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                      <?php   

                      $ord = new _order;
                            $resultord = $ord->TrackmyOrder($idspOrder,$txn_id);

                           //  echo $ord->ta->sql;
                        if ($resultord) {
                          $i = 1;
                          while ($roword = mysqli_fetch_assoc($resultord)) {
                             extract($roword); 
                                                        
                          $dt = new DateTime($ship_date);
                                                        ?>
                                                        <tr>
                                 <!--  <td><?php echo $idspOrder; ?></td> -->
                                  
                                   <td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
                                    <td><?php echo $ship_track_id; ?></td>
                                     <td><?php echo $dt->format('d-M-Y'); ?></td>

                                     <?php

                                      $result_p = $ord->TrackmyprepareOrder($idspOrder,1);
                                      $row_p = mysqli_fetch_assoc($result_p);

                                       $result_s = $ord->TrackmyshipOrder($idspOrder,2);
                                         $row_s = mysqli_fetch_assoc($result_s);

                                         $result_d = $ord->TrackmydeliverdOrder($idspOrder,3);
                                           $row_d = mysqli_fetch_assoc($result_d);

                                           // echo $ord->ta->sql;

                                         ?> <td  class="text-center">


                                          <?php  if ($row_p){
                                             echo "<a href='#'>Prepare for Shipment</a>";

                                           }else if ($row_s) {
                                             echo "<a href='#'>Shipped Order</a>";
                                           }else if ($row_d) {
                                             echo "<a href='#'>Delivered Order</a>";
                                            
                                           }else{
                                            echo "Waiting";

                                           }

                                            ?>
                                           </td>


                                     
                                                            
                                                            
                                                          <!--  
                                                                <a href="#">Prepare for shipment</a>
                                                                <span>|</span>
                                                                <a href="#">Shipped Order</a>
                                                                 <span>|</span>
                                                                <a href="#">Delivered Order</a>
                                                            </td>
                                                             -->
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Available</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                    </tbody>
                </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
                   <!--  <button type="button" class="btn btn-primary" 
                   
                    onclick="get_commentdata(<?php echo $idspOrder;?>)"  style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button> -->
                </div>
            </div>
     <!--   </form>  -->
        </div>
    </div>
 
</div>                        

                  <a href="javascript:void(0)"data-toggle="modal" data-target="#myproblem<?php echo $idspOrder;?>" class="btn btnwithorder">Problem with order</a>
                       
                       <a href="<?php echo $BaseUrl.'/store/dashboard/storereturn_item.php?orderid='.$cid?>" class="btn btnreturnitem">Return or replace items</a>
     <!-- Modal -->
<div class="modal fade" id=myproblem<?php echo $idspOrder;?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">

       <!--     <form id="sellerreplyform" enctype="multipart/form-data"> -->
            <div class="modal-content no-radius bradius-15">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h3 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Problem With Order</h3>

                </div>
                <div class="modal-body">
                 <!--   <input type="hidden" name="cid" value="<?php echo $row['id'];?>"> -->
      

                 <input type="hidden" name="order_id" id="order_id<?php echo $idspOrder;?>" value="<?php echo $idspOrder;?>">

                   <input type="hidden" name="txn_id" id="txn_id<?php echo $idspOrder;?>" value="<?php echo $txn_id;?>">

                     <input type="hidden" name="buyerprofil_id" id="buyerprofil_id<?php echo $idspOrder;?>" value="<?php echo $buyerprofilid ;?>">

                       <input type="hidden" name="sellerprofil_id" id="sellerprofil_id<?php echo $idspOrder;?>" value="<?php echo $sellerprofilid;?>">


                 
  


           
                  <div class="form-group">
            <label for="sell1">Send a message to seller if you have any problem with order<span class="red">*</span></label> 
             <textarea class="form-control" name="buyerproblem" id="buyerproblemid<?php echo $idspOrder;?>" rows="4"></textarea>
             <span id="sellercommentid_error" style="color:red;"></span>

              </div>
                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
                    <button type="button" class="btn btn-primary" 
                   
                    onclick="get_commentdata(<?php echo $idspOrder;?>)"  style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
                </div>
            </div>
     <!--   </form>  -->
        </div>
    </div>
 
</div>                
                           <?php 

                            $er = new _spstorereview_rating;
                            $re_res =  $er->read($_SESSION['pid'],$cid);

                           $row_re = mysqli_fetch_assoc($re_res);

                                                                                      
                                                                                
                           if($re_res->num_rows == 0){
                                                                                     ?>

  <a href="<?php echo $BaseUrl.'/store/dashboard/mystorereview.php?orderid='.$cid; ?>" class="btn btnrsellfeed">Leave seller feedback</a>
     <?php
                                                                                }

                                                                                  ?>

                       
                     </div>
                    </div>   


   </div>
                </div>
            </div>
        </div>
        </div>

         <?php
            
              }
            }/*else{  ?>
                
                                               
                     <center><div style='min-height: 300px; font-size: 16px;  padding-top: 80px;' >
               Search Results for "<?php echo $txtStoreSearch; ?>" : No products were found matching your orders.</div></center>
                                                      
                       <?php }*/
         // $i++;  
                     
            
         else{  ?>
                                            
                     <center><div style='min-height: 300px; font-size: 16px; padding-top: 100px;' >No Record Available</div></center>
                                               
              
                                                      
                       <?php }  ?>
                                               
        

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
        ?>




<script type="text/javascript">
//function get_approvedata(id){

 function get_commentdata(id){
//alert();

       
var order_id = $("#order_id"+id).val()

var txn_id = $("#txn_id"+id).val()

var buyerprofil_id = $("#buyerprofil_id"+id).val()

var sellerprofil_id = $("#sellerprofil_id"+id).val()


 var buyerproblemid = $("#buyerproblemid"+id).val()

// alert(txn_id);
// alert(buyerprofil_id);
// alert(sellerprofil_id);

if (buyerproblemid == "") {
            
            $("#sellercommentid_error").text("Please Enter Message.");
             $("#buyerproblemid").focus();


             return false;
 }else{
   $.ajax({
            type: 'POST',
            url: 'addproblemwithorder.php',
            data: {order_id: order_id, txn_id: txn_id, buyerprofil_id: buyerprofil_id, sellerprofil_id: sellerprofil_id,buyerproblem: buyerproblemid},
            
                
            success: function(response){ 

                         //console.log(data);

                                 swal({

                                  title: "Message Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location = "<?php echo $BaseUrl.'/store/dashboard/my-problemwithorder.php';?>";

                                  });

  
            }
        });

 }


  }



</script>

<!--         
<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#sellerreplyform").on('submit', function(e){
    // alert();
        e.preventDefault();

           var sellercommentid = $("#sellercommentid").val()

           if (sellercommentid == "") {
            
            $("#sellercommentid_error").text("Please Enter Comment.");
             $("#sellercommentid").focus();


             return false;
           }else{

        $.ajax({
            type: 'POST',
            url: 'addproblemwithorder.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
                
            success: function(response){ 

                         //console.log(data);


                                 swal({

                                  title: "Message Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {


                                 window.location = "<?php echo $BaseUrl.'/store/dashboard/my-problemwithorder.php';?>";

                                       

                                  });

  
            }
        });
      }

    });
});

</script> -->
    </body>
</html>
<?php
}
?>