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
 <style> 
     
        .buyer{
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
    </style> 
      
        
    </head>

    <script type="text/javascript">
      
function OnButton1()
{
    var checkboxes = document.getElementsByName('check[]');
    var checkedCount = 0;
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        checkedCount++;
      }
    }
    if(checkedCount == 0){
      alert("No data selected to be deleted");
      return false;
    }
    document.Form1.action = "deleterfqrecord.php"
    document.Form1.target = "_blank";    

    document.Form1.submit();             // Submit the page
    return true;
}
    </script>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 56;
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
                        $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');     
/*
                              $activePage = 52;    */    
                              $activePage = 54;          
                        ?>
                        
                      

                                <div class="col-md-12">
                                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Quotation List</a></li>
                                     
                          </ul>
                                      </div>

                                   <!--  <div class="col-md-12">
                                          <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Paid Bid</a></li>
                                      
                                    </ul> -->
                                

                                <!-- <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>

                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||  $activePage = 50 ||  $activePage = 51 ||  $activePage = 52 ||  $activePage = 54 ||$activePage = 56)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div> -->
                              <!--   <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                       
                                       <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionactive_product.php'; ?>" class="<?php echo ($activePage == 22)?'active':''?>">Open</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionclose_product.php';?>" class="<?php echo ($activePage == 24)?'active':''?>">Closed</a></li>
                                       
                                       </ul>
                                </div> -->
                        
<!-- 
<div class="col-md-12"> 
  <div class="store_dangerboxr_1"> -->
   <div class="col-md-12">
            <div class="panel with-nav-tabs panel-danger">
                <div class="panel-heading" style="padding: 0px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1danger" data-toggle="tab">All </a></li>
                            <li><a href="#tab2danger" data-toggle="tab">Short List</a></li>
                           <!--  <li><a href="#tab3danger" data-toggle="tab">Contact Seller</a></li> -->
                              <li><a href="#tab4danger" data-toggle="tab">Ordered</a></li>
                           <!--  <li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4danger" data-toggle="tab">Danger 4</a></li>
                                    <li><a href="#tab5danger" data-toggle="tab">Danger 5</a></li>
                                </ul>
                            </li> -->
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1danger">
                          <!-- table -->

                        <!--   <div class="col-md-12 ">
                                <div class=""> -->
                              <?php 


                               $r = new _rfq;
                               $res = $r->readRfq(isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0);
                             if ($res) {
                                 $row1 = mysqli_fetch_assoc($res);
                                 $rfqTitle = $row1['rfqTitle'];


                         
                             //  print_r($_POST['shortlist']);

                                  }
                               ?>

                             <h2 class="eventcapitalize" style="font-size: 22px; padding-bottom: 5px; color: #1c6121;font-weight: bold;">MY PUBLIC RFQ: <?php echo $rfqTitle; ?> </h2>




                <form name="Form1" method="post">
                      
                              <div class="allQuotetab">
                                
                                <p style="padding-left: 10px;"><input type="checkbox" id="checkAl"><span style="font-size: 20px; padding-left: 3px;">All</span> 

                                  <input type="submit" class="btn" name="save" style="background-color: #C2261B; color: #fff; font-size: 12px;" id="quotationdelete" onclick="return OnButton1();" 
                                  value="DELETE"/> 

                                  <input type="submit" class="btn" name="shortlist" value="SHORTLIST" style="background-color: #2ba805; color: #fff; font-size: 12px;" id="quotationshortlist"  onclick="return OnButton2();" />  

                                 </p>

                              </div> 
                              <input type="hidden" name="getidspRfq" value="<?php echo isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0;?>">

                               
                         
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                       <thead style="background-color: #7BBAB4; color: #fff;">
                                                <tr>
                          <th class="text-center" style="width: 50px;"></th>
                                              

                                             <th>IMAGE</th>
                                            <th class="text-center">RECEIVED QUOTATION</th>
                                                   
                                                    <th>PROFILE NAME</th>
                                                    <th>BUSSINESS NAME</th>
                                                    <th>MIN PRICE</th>
                                                    
                                                   <th class="text-center" >ACTION</th>
                                                </tr>
                                            </thead>

                                            <tbody style="background-color: #E8E8E8;">
                                        <?php

                                              

                                       $r = new _rfq;
                                      $result = $r->readRfqComment(isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0);
                                             
                                             

                                              /*echo $r->tcd->sql; */
                                                if ($result) {
                                                    $i = 1;
                                         while ($row = mysqli_fetch_assoc($result)) {
                                        //echo "<pre>";              
                                       // print_r($row);     
                                            
                               $pt = new _spprofiles;
                                             
                           $result_profile = $pt->read($row['spProfiles_idspProfiles']);
                          if ($result_profile) {
                                 $rowpro = mysqli_fetch_assoc($result_profile);
                                 $ProfileName = $rowpro['spProfileName'];
                                                        
                                              }

                                 $p = new _spbusiness_profile;

                               $rpvt = $p->read($row['spProfiles_idspProfiles']);
                                //echo $p->ta->sql;

   
                                    if ($rpvt != false){
                                 $rowB = mysqli_fetch_assoc($rpvt);
                                 

                                   $bussinessName = $rowB['spDynamicWholesell'];

                               }
     
                              ?>
                                                       <tr>
                                              
                                                 <!--   <td class="text-center" style="width: 25px;"><label class="main">  <input type="checkbox" checked="checked">  <span class="geekmark"></span>  </label> </td>  -->
                                                 <td align="center">
                                            
                                                   
                                                   <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["idspRfqComment"]; ?>">
                                                 </td>    
                                             <td>
                                              <?php
                                             $image = $row['rfqcImage'];

                                               $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                             }

                                                if(!empty($images)){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style="height: 60px; width: 70px;" > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
                                                }
                                            ?></td>

                                            <td class="text-center buyer">
                                              <a href="" data-toggle="modal" data-target="#<?php echo $row['idspRfqComment'];?>"><?php echo $row['rfqDesc']; ?></a>
                                            </td>
       <!-- Modal -->
<div class="modal fade" id="<?php echo $row['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">RECEIVED QUOTATION</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo $row['rfqDesc']; ?></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                     
                                      
                                                                  
                                                 
                                                                        
                                  <td  class="eventcapitalize"><a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $row['spProfiles_idspProfiles']?>"><?php echo $ProfileName; ?></a></td>

                                  <td  class="eventcapitalize"><?php echo $bussinessName; ?></td>

                                  <td><?php echo $row['rfqPrice']; ?></td>
 
</form>

        <td>
                        
        <?php   

                                // ===PAYPAL ACCOUNT LIVE SETTING
                                // RETURN CANCEL LINK
                $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
                                // RETURN SUCCESS LINK
                   
               /*    $success_return = $BaseUrl."/paymentstatus/quotation_payment_success.php?idspQuotation=".$row['idspQuotation']."&sell_idquotation=".$row['spQuotationSellerid'];*/

                
                     $success_return = $BaseUrl."/paymentstatus/store_payment_success.php?post_idspRfqComment=".$row['idspRfqComment']."&sell_idspRfq=".$row['idspRfq'];
                             


                                //Here we can use paypal url or sanbox url.
                                // sandbox
                     $paypal_url     = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                                // live payment
                                //$paypal_url       = 'https://www.paypal.com/cgi-bin/webscr';
                                //Here we can used seller email id. 
                           $merchant_email = 'developer-facilitator@thesharepage.com';
                                // live email
                                //$merchant_email = 'sharepagerevenue@gmail.com';
                                                                
                                //paypal call this file for ipn
                                //$notify_url   = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";



                ?>

  
                <form action="<?php echo $paypal_url; ?>" method="post" class="form-inline">
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

                  <!-- Redirect direct to card detail Page -->
                  
                  <input type="hidden" name="landing_page" value="billing">

                  <!-- Redirect direct to card detail Page End -->


                  <!-- Specify a Buy Now button. -->
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="upload" value="1">

                            
                  <?php



                      echo "<input type='hidden' name='item_name_1' value='".$row['rfqcProductName']."'>";
                        echo "<input type='hidden' name='item_number' value='143' >";
                        echo "<input type='hidden' class='".$row['idspRfqComment']."' name='amount_1' value='".$row['rfqPrice']."'>";
                        
                        echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                  ?>
  
                                  
<button type="submit" class="btn  btn-border-radius" style="background-color: #00c0ef;
    color: #fff;  min-width: 100px;">Pay</button>


 </form>

<a href="<?php echo $BaseUrl.'/store/dashboard/quotation_detail.php?idrfqcomment='.$row['idspRfqComment'];?>" class="btn  btn-border-radius" style="background-color: #55C94D; color: #fff;  margin-top: 8px;  min-width: 100px;">View Detail</a>

<br>
<a href="javascript:void(0)" class="btn btn-border-radius"  onclick="javascript:chatWith('<?php echo $row['spProfiles_idspProfiles']; ?>')" style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;  margin-top: 10px; min-width: 100px;">Chat</a>

 

 
</td>
                                      


                                                        </tr>
                                                       <?php
                                                       $i++;

                                                     ?>
                                                
                                                  <?php
                                              
                                                    }
                                               
                                                }else{
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
                               <!--  </div>
                            </div> -->


                              <!-- close table -->
                        </div>
                   
                        <div class="tab-pane fade" id="tab2danger">

                           
                             <h2 class="eventcapitalize" style="font-size: 22px; padding-bottom: 5px; color: #1c6121;font-weight: bold;">MY PUBLIC RFQ: <?php echo $rfqTitle; ?> </h2>


                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                       <thead style="background-color: #7BBAB4; color: #fff;">
                                                <tr>
                          <!-- <th class="text-center" style="width: 50px;"></th> -->
                                              

                                             <th>IMAGE</th>
                                            <th class="text-center">RECEIVED QUOTATION</th>
                                                   
                                                    <th>PROFILE NAME</th>
                                                    <th>BUSSINESS NAME</th>
                                                    <th>MIN PRICE</th>
                                                    
                                                    <th class="text-center" >ACTION</th>
                                                </tr>
                                            </thead>

                                            <tbody style="background-color: #E8E8E8;">
                       <?php 

                      // print_r($_GET['shortid']);


                        if(isset($_POST['shortlist'])){

                         // print_r($_POST['shortlist']);
                        $checkbox = $_POST['check'];
 /*print_r($_POST['check']);*/
                  for($i=0;$i<count($checkbox);$i++){
                 $del_id = $checkbox[$i]; 

                  /* echo $del_id;*/
    
                 $r = new _rfq;
                             $resultsort = $r->readRfqquotedetail($del_id);

                           // print_r($resultsort);
                                            
                                            
                                //  echo $r->tcd->sql; 
                                      

                                       if ($resultsort) {
                                        // $i = 1;
                                         $rowshort = mysqli_fetch_assoc($resultsort);

                                                        ?>
                                    

                                                       <tr>
                                              
                                               <!--   <td align="center">
                                            
                                                   
                                                   <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["idspRfqComment"]; ?>">
                                                 </td>     -->
                                             <td>
                                              <?php
                                             $image = $rowshort['rfqcImage'];

                                               $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                             }

                                                if(!empty($images)){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style="height: 60px; width: 70px;" > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
                                                }
                                            ?></td>

                                            <td class="text-center buyer">
                                              <a href="" data-toggle="modal" data-target="#s<?php echo $rowshort['idspRfqComment'];?>"><?php echo $rowshort['rfqDesc']; ?></a>
                                            </td>
       <!-- Modal -->
<div class="modal fade" id="s<?php echo $rowshort['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">RECEIVED QUOTATION</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo $rowshort['rfqDesc']; ?></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                     
                                                  
                                  <td  class="eventcapitalize"><a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $row['spProfiles_idspProfiles']?>"><?php echo $ProfileName; ?></a></td>

                                  <td  class="eventcapitalize"><?php echo $bussinessName; ?></td>

                                  <td><?php echo $rowshort['rfqPrice']; ?></td>
                                  
                                  
                              

                      <td>
                                <?php   

                                // ===PAYPAL ACCOUNT LIVE SETTING
                                // RETURN CANCEL LINK
                $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
                                // RETURN SUCCESS LINK
                   
               /*    $success_return = $BaseUrl."/paymentstatus/quotation_payment_success.php?idspQuotation=".$row['idspQuotation']."&sell_idquotation=".$row['spQuotationSellerid'];*/

                
                     $success_return = $BaseUrl."/paymentstatus/store_payment_success.php?post_idspRfqComment=".$rowshort['idspRfqComment']."&sell_idspRfq=".$rowshort['idspRfq'];
                             


                                //Here we can use paypal url or sanbox url.
                                // sandbox
                     $paypal_url     = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                                // live payment
                                //$paypal_url       = 'https://www.paypal.com/cgi-bin/webscr';
                                //Here we can used seller email id. 
                           $merchant_email = 'developer-facilitator@thesharepage.com';
                                // live email
                                //$merchant_email = 'sharepagerevenue@gmail.com';
                                                                
                                //paypal call this file for ipn
                                //$notify_url   = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";



                ?>

  
                <form action="<?php echo $paypal_url; ?>" method="post" class="form-inline">
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

                  <!-- Redirect direct to card detail Page -->
                  
                  <input type="hidden" name="landing_page" value="billing">

                  <!-- Redirect direct to card detail Page End -->


                  <!-- Specify a Buy Now button. -->
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="upload" value="1">

                            
                  <?php



                      echo "<input type='hidden' name='item_name_1' value='".$rowshort['rfqcProductName']."'>";
                        echo "<input type='hidden' name='item_number' value='143' >";
                        echo "<input type='hidden' class='".$rowshort['idspRfqComment']."' name='amount_1' value='".$rowshort['rfqPrice']."'>";
                        
                        echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                  ?>
  
                                  
<button type="submit" class="btn  btn-border-radius" style="background-color: #00c0ef;
    color: #fff; min-width: 100px;">Pay</button>
<br> 

<a href="<?php echo $BaseUrl.'/store/dashboard/quotation_detail.php?idrfqcomment='.$rowshort['idspRfqComment'];?>" class="btn btn-border-radius" style="background-color: #55C94D; color: #fff;  margin-top: 8px; min-width: 100px;">View Detail</a>

<br>
<a href="javascript:void(0)" class="btn  btn-border-radius"  onclick="javascript:chatWith('<?php echo $rowshort['spProfiles_idspProfiles']; ?>')" style="color: #fff!important;  background-color: #55C94D; border-radius: 8px;  margin-top: 10px; min-width: 100px;">Chat</a>

 

 </form>
 
</td>   
                                      


                                                        </tr>
                                      <?php 
                                      }
                                    }
                                  }else{
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
                      <!--   <div class="tab-pane fade" id="tab3danger">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                       <thead style="background-color: #7BBAB4; color: #fff;">
                                                <tr>
                       
                                             <th>IMAGE</th>
                                            <th class="text-center">RECEIVED QUOTATION</th>
                                                   
                                                    <th>PROFILE NAME</th>
                                                    <th>BUSSINESS NAME</th>
                                                    <th>MIN PRICE</th>
                                                    
                                                    <th class="text-center" >ACTION</th>
                                                </tr>
                                            </thead>

                                            <tbody style="background-color: #E8E8E8;">
                           <?php 

                           $r = new _rfq;
                                    
                                    
                               $result3 = $r->readRfqContact(isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0);
                                   // echo $r->rfqcon->sql; 
                                    if ($result3) {
                                                   
                                   while ($row3 = mysqli_fetch_assoc($result3)) {

                         
                                                           
                               $pt = new _spprofiles;
                                             
                           $result_profile3 = $pt->read($row3['spProfiles_idspProfiles']);
                          if ($result_profile3) {
                                 $rowpro3 = mysqli_fetch_assoc($result_profile3);
                                 $ProfileName3 = $rowpro3['spProfileName'];
                                                        
                                              }

                                 $p = new _spbusiness_profile;

                               $rpvt3 = $p->read($row3['spProfiles_idspProfiles']);
                                //echo $p->ta->sql;

   
                                    if ($rpvt3 != false){
                                 $rowB3 = mysqli_fetch_assoc($rpvt3);
                                 

                                   $bussinessName3 = $rowB3['spDynamicWholesell'];

                               }
                                          

                                                        ?>
                                    

                                                       <tr>
                                              
                                               
                                             <td>
                                              <?php
                                             $image = $row3['rfqcImage'];

                                               $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                             }

                                                if(!empty($images)){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style="height: 60px; width: 70px;" > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
                                                }
                                            ?></td>

                                            <td class="text-center buyer">
                                              <a href="" data-toggle="modal" data-target="#r<?php echo $row3['idspRfqComment'];?>"><?php echo $row3['rfqDesc']; ?></a>
                                            </td>
      
<div class="modal fade" id="r<?php echo $row3['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">RECEIVED QUOTATION</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo $row3['rfqDesc']; ?></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
            
                </div>
            </div>
        </div>
    </div>
</div>                                     
                                                  
                                  <td  class="eventcapitalize"><a href="<?php echo $BaseUrl.'/my-profile'?>"><?php echo $ProfileName3; ?></a></td>

                                <td  class="eventcapitalize"><?php echo $bussinessName3; ?></td>

                                  <td><?php echo $row3['rfqPrice']; ?></td>
                                  
                                  
                                  <td class="text-center" ><a href="" data-toggle="modal" data-target="#contact<?php echo $row3['idspRfqComment'];?>">Contact</a></td>    
                                      

     
<div class="modal fade" id="contact<?php echo $row3['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Contact Detail</h4>

                </div>
                <div class="modal-body">

                  <div><?php   if(!empty($row3['rfqcontactImg'])){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$row3['rfqcontactImg']; ?>' style="height: 60px; width: 70px;" > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
                                                }
                                            ?></div>

                  <h4>Title: <?php echo $row3['contact_title']; ?> </h3>

                   <h4>Description: <span style="font-size: 14px;"><?php echo $row3['contact_desc']; ?></span></h3>

                   

                

                                                                                     
                                                



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                 
                </div>
            </div>
        </div>
    </div>
</div>   
                                               <td><a href="javascript:void(0)"  onclick="javascript:chatWith('<?php echo $row1['spProfile_idspProfiles']; ?>')">Chat</a>
                                               </td>

                                                        </tr>
                                                   <?php
                                                       $i++;

                                                     ?>
                                                
                                                  <?php
                                              
                                                    }
                                               
                                                }else{
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
                                    </div>      </div> -->


                        <div class="tab-pane fade" id="tab4danger">
                           
                             <h2 class="eventcapitalize" style="font-size: 22px; padding-bottom: 5px; color: #1c6121;font-weight: bold;">MY PUBLIC RFQ: <?php echo $rfqTitle; ?> </h2>

                            <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                       <thead style="background-color: #7BBAB4; color: #fff;">
                                                <tr>
                        <!--   <th class="text-center" style="width: 50px;"></th> -->
                                              

                                             <th>IMAGE</th>
                                            <th class="text-center">RECEIVED QUOTATION</th>
                                                   <th>TRANSACTION ID</th>
                                                    <th>PROFILE NAME</th>
                                                    <th>BUSSINESS NAME</th>
                                                    <th>PRICE</th>
                                                    
                                                   
                                                </tr>
                                            </thead>

                                            <tbody style="background-color: #E8E8E8;">
                           <?php 

                           $rf = new _rfq_transection;
                                    
                                    
                               $result4 = $rf->readRfqtransection(isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0);
                                   // echo $rf->ta->sql; 
                                    if ($result4) {
                                                   
                                   while ($row4 = mysqli_fetch_assoc($result4)) {

                         
                                                           
                               $pt = new _spprofiles;
                                             
                           $result_profile4 = $pt->read($row4['spProfiles_idspProfiles']);
                          if ($result_profile4) {
                                 $rowpro4 = mysqli_fetch_assoc($result_profile4);
                                 $ProfileName4 = $rowpro4['spProfileName'];
                                                        
                                              }

                                 $p = new _spbusiness_profile;

                               $rpvt4 = $p->read($row4['spProfiles_idspProfiles']);
                                //echo $p->ta->sql;

   
                                    if ($rpvt4 != false){
                                 $rowB4 = mysqli_fetch_assoc($rpvt4);
                                 

                                   $bussinessName4 = $rowB4['spDynamicWholesell'];

                               }
                                          

                                                        ?>
                                    

                                                       <tr>
                                              
                                               <!--   <td align="center">
                                            
                                                   
                                                   <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["idspRfqComment"]; ?>">
                                                 </td>  -->   
                                             <td>
                                              <?php
                                             $image = $row4['rfqcImage'];

                                               $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                             }

                                                if(!empty($images)){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>' style="height: 60px; width: 70px;" > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 60px; width: 70px; '>";
                                                }
                                            ?></td>

                                            <td class="text-center buyer">
                                              <a href="" data-toggle="modal" data-target="#rf<?php echo $row4['idspRfqComment'];?>"><?php echo $row4['rfqDesc']; ?></a>
                                            </td>
       <!-- Modal -->
<div class="modal fade" id="rf<?php echo $row4['idspRfqComment'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">RECEIVED QUOTATION</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo $row4['rfqDesc']; ?></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                     
                                 <td><?php echo $row4['txn_id']; ?></td>             
                                  <td  class="eventcapitalize"><a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $row4['spProfiles_idspProfiles']?>"><?php echo $ProfileName4; ?></a></td>

                                <td  class="eventcapitalize"><?php echo $bussinessName4; ?></td>

                                  <td><?php echo $row4['payment_gross']; ?></td>
                                  
                                  
                               <!--    <td class="text-center" ><a href="" data-toggle="modal" data-target="#payment<?php echo $row4['idspRfqComment'];?>">Order</a></td>     -->
                                      

  
                                                        </tr>
                                                   <?php
                                                       $i++;

                                                     ?>
                                                
                                                  <?php
                                              
                                                    }
                                               
                                                }else{
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
                      <!--   <div class="tab-pane fade" id="tab5danger">Danger 5</div> -->
                    </div>
                </div>
            </div>
        </div>

<!-- </div>
</div>
 -->
<!--  -->




                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
  

        <script>
$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>


<script language="Javascript">


function OnButton2()
{
    //alert();

    document.Form1.action = "quotation_list.php?idspRfq="<?php echo isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0;?>
    document.Form1.target = "_blank";    // Open in a new window
    document.Form1.submit();             // Submit the page
    return true;
}
</script>
<!-- 
 <script type="text/javascript">
  
$(document).ready(function(e){
    // Submit form data via Ajax

$("#quotationshortlist").on("click", function () {

//alert();
$.ajax({
            type: 'POST',
            url: 'addsellercomment.php',
            data: {comment_id: comment_id, sellercomments: sellercommentid},
            
                
            success: function(response){ 

                         //console.log(data);

                                 swal({

                                  title: "Comment Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

  
            }
        });


});
}); 

</script>  -->
    </body>
</html>
<?php
} ?>
