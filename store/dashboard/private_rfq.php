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
          <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


<style type="text/css">
.buyer{
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
}
.vertical-align-center {

    display: table-cell;
    vertical-align: middle;
}
.modal-content {
 
    width:inherit;
    height:inherit;
    
    margin: 0 auto;
}
</style>        
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
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php
                            $activePage = 24;
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
                        
                        $storeTitle = " Dashboard / My Send Enquires";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');
                        
                        ?>
                        
                        <div class="row">
<!-- 
                            <div class="col-md-12">

                                  <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">My Send Enquiries</a></li>
                                    
                                    </ul>


                                <div class="text-right" style="margin-top: -10px;">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>

                                </div>
                            </div> -->
                            <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Private RFQ</a></li>
                                     
                          </ul>
                            </div>

                            
                            <div class="col-md-12 ">
                               <!--  <div class=""> -->
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>

                                                    <!-- <th>Image</th> -->
                                                   
                                                    <th>Whats are looking for every where</th>

                                                   <!--  <th>Title</th> -->
                                                 
                                                    <th>Quantity</th>
                                                    <th>Date and Time</th>
                                                    <th>Price</th>
                                                     <th>Comment</th>
                                                    <!--  <th>Status</th> -->
                                                     <th>Seller message</th>
                                                      <th>Status</th>
                                                     <th class="text-center">Action</th>>
                                                  <!--   <th class="text-center">Action</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $en = new _spquotation;
                                             $result = $en->getbuyerquotation($_SESSION['pid']);
                                               //echo $en->ta->sql;

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {


                                                 
                                                    
                                                      $ch = new _rfqchat;
                                                $commresult  = $ch->getsellercomment($row['idspQuotation']);
                                                        // echo $ch->ta->sql;            

                                                       if($commresult != false)
                                                                 {
                                                   while ($commrow = mysqli_fetch_assoc($commresult)) {

                                                  //  print_r($commrow);

                                                      $Sellercomment = $commrow["sellercomments"];
                                                      $Scommentid = $commrow["id"];
                                                        $commid = $commrow["comment_id"];                                                                    
                                                            
                                                             }
                                                           }
                                                                             

 
                                                                                     
                                                            
     
                                                       ?>
                                                       <tr>
                                                 <td class="text-center"><?php echo $i; ?></td>

                                               <!--   <td>  <?php  

                                                 $pic = new _productpic;
                                                       $resultpic = $pic->read($row['spPostings_idspPostings']);

                                                      if ($resultpic != false) {
                                                      $rowpic = mysqli_fetch_assoc($resultpic);
                                                      $picture = $rowpic['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' style='height:70px; width:80px;'>";
                                                  } else{
                                                      echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                                 ?></td> -->
                                                            
                                          <td class="eventcapitalize">
                                                            
                                        


                                           <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['spPostings_idspPostings']?>">
                                                                  
                                                   <?php 
                                                    $pst = new _productposting;
                                          $result3 = $pst->read($row['spPostings_idspPostings']);



                                                      if ($result3) {
                                                      $row3 = mysqli_fetch_assoc($result3);
                                                          echo $row3['spPostingTitle'];
                                                                        }
                                                                    ?>
                                                                </td>
                                                           

                                       <!--  <td class="eventcapitalize"><?php echo $row['spQuotationProductName'];?></td> -->
                                                           
                                        <td><?php echo $row['spQuotationTotalQty'];?></td>
                                           <td><?php echo $row['createddatetime'];?></td>
                                             <td><?php if ($row['spQuotationPrice'] >= 0) {
                                             echo $row['spQuotationPrice'];
                                             }else{

                                              echo "0";

                                           }?></td>

                                           
         
     <!-- Modal -->
<div class="modal fade" id="<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
           <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Comment</h4>

                </div>
                <div class="modal-body"><p style="padding: 8px;"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                                                                            
                                            <td class="buyer">
                                            <a href="" data-toggle="modal" data-target="#<?php echo $row['idspQuotation'];?>"><?php echo substr($row['spQuotatioProductDetails'], 0, 50); ?></a>
                                            </td>

                                          <!--   <td>status</td> -->
   
   <!-- Modal -->
<div class="modal fade" id="p<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content no-radius bradius-15 ">
                <div class="modal-header sellbuyhead">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                 <h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Message</h4>

                </div>
          <div class="modal-body"><p style="padding: 8px;"><?php echo $Sellercomment; ?>

        </p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
                  <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>                                                                 
                                                <td class="buyer">    
                                                           
                                              <?php if (isset($Sellercomment) && $row['idspQuotation'] == $commid) { ?>
                                                 <a href=""data-toggle="modal" data-target="#p<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>
                                                          
                                                      <?php  }else{ ?>
                                                          <p>No Message</p>
                                                       <?php } ?>

                                                        
                                              </td>

                                                <td>


                                          <?php   $qu = new _quotation_transection;
                                                $quote_res  = $qu->getrfqorder($row['idspQuotation']);

                                           //   echo $qu->ta->sql;

                                          if ($quote_res) {
                                           $quote_row = mysqli_fetch_assoc($quote_res);
                                                  //echo $quote_row['spPostingTitle'];

                                           echo "Pyament Successful";
                                           }else{
                                            echo "Waiting for reply";
                                           } ?></td>  


                                            <td>
                                <?php   

                                // ===PAYPAL ACCOUNT LIVE SETTING
                                // RETURN CANCEL LINK
                $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
                                // RETURN SUCCESS LINK
                   
                   $success_return = $BaseUrl."/paymentstatus/quotation_payment_success.php?idspQuotation=".$row['idspQuotation']."&sell_idquotation=".$row['spQuotationSellerid'];


                                // print_r($success_return);
                                // ===END
                                // ===LOCAL ACCOUNT SETTING
                                // RETURN CANCEL LINK
                                //$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
                                // RETURN SUCCESS LINK
                                //$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
                                // ===END



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


  
                                <form action="<?php echo $paypal_url; ?>" method="post" class="form-inline text-right">
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



                                                echo "<input type='hidden' name='item_name_1' value='".$row3['spPostingTitle']."'>";
                                              
                                                echo "<input type='hidden' name='item_number' value='143' >";
                                              
                                                echo "<input type='hidden' class='".$row['idspQuotation']."' name='amount_1' value='".$row['spQuotationPrice']."'>";
                                                
                                                echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                                    ?>
                               
                         


      <?php 

     // print_r($row['idspQuotation']);

                            $ch = new _rfqchat;
                            $ch_res =  $ch->getsellercomment($row['idspQuotation']);
                           // print_r($ch_res);
                           $row_ch = mysqli_fetch_assoc($ch_res);
                             //echo $ch->ta->sql; 
                          //    echo "here";    print_r($row_ch);
                                                    
                           if($ch_res->num_rows == 0){ ?>

                                                                                     
             <a href="#"  data-toggle='tooltippay' title="The button will activate after seller response." class="btn" style="background-color: #00c0ef;
    color: #fff; font-size: 10px; height: 38px;" disabled>Pay</a>

  <a href="#" data-toggle='tooltippay' title="The button will activate after seller response." class="btn" style="background-color: #55C94D; color: #fff;   font-size: 9px; max-width: 58px;
   "  data-target="#myquotation<?php echo $row['idspQuotation'];?>" disabled>Re-submit<br>Quote</a>
            
  <?php  }else{ ?>
                                                                          
             <button type="submit" class="btn" style="background-color: #00c0ef;
    color: #fff; font-size: 10px; height: 38px;">Pay</button>

  <a href="#" data-toggle='modal' class="btn" style="background-color: #55C94D; color: #fff;  font-size: 9px;  max-width: 58px;"  data-target="#myquotation<?php echo $row['idspQuotation'];?>">Re-submit<br>Quote</a>
  <?php  }  ?>
                                                                               

                                                                                 

</form>
  <!--  <button type="submit" class="btn" style="background-color: #00c0ef;
    color: #fff;"> -->
 
</td>

 <div class="modal fade" id="myquotation<?php echo $row['idspQuotation'];?>" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content no-radius sharestorepos bradius-15">
                    <div class="modal-header bg-white br_radius_top">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="quotationModalLabel"><b>Request For Quotations(Private RFQ)</b></h3>
                    </div>
                   <!--  <form enctype="multipart/form-data" action="../buy-sell/sendquotationprice.php" method="post" id="quotationform"> -->

                        <?php $timestamp = time();?>
                        <div class="modal-body">
                            <input type="hidden" name="buyeremail_" value=""/>
                            <input type="hidden" name="buyername_" value=""/>
                            <!-- ==================== -->
                            <!-- jo product buy kr raha ha -->
                           <!--  <input type="hidden" name="spQuotationBuyerid" value="<?php echo $_SESSION['pid']?>" /> -->

                            <!-- jo product sale kr raha ha -->
                         <!--    <input type="hidden" class="dynamic-pid" name="spQuotationSellerid" id="spQuotationSellerid" value="" />
 -->
                         <!--    <input type="hidden" name="spPostings_idspPostings" id="spPosting" value="<?php echo $rows['idspPostings']?>">

                             <input type="hidden" class="dynamic-pid" name="createddatetime"  value="<?php echo(date("F d, Y h:i:s", $timestamp));?>" /> -->

 <input type="hidden" name="quote_id" id="quote_id<?php echo $row['idspQuotation'];?>" value="<?php echo $row['idspQuotation'];?>">    
                            <div class="row">
                                <!-- <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="productname" class="control-label contact">Product Name <span class="red">*</span></label>
                                    <span id="spQuotationProduct_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>

                                    <input type="text" class="form-control" name="spQuotationProductName" value=""  id="spQuotationProduct" onkeyup="keyupQuotationfun()">

                                  </div>
                                </div> -->
                             
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="spQuotationTotalQty" class="control-label contact">Quantity Required <span class="red">*</span></label>
                                    <span id="spQuotationTotalQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                        <input type="number" class="form-control" id="spQuotationTotalQty" name="spQuotationTotalQty" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationTotalQty']; ?>">
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deleverytime" class="control-label contact">Delivery (Days) <span class="red">*</span></label>
                                          <span id="deleverytime_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                        <input type="number" class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationTotalQty']; ?>">
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="deleveryprice" class="control-label contact">Payment <span class="red">*</span></label>
                                          <span id="deleveryprice_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                        <input type="number" class="form-control" id="deleveryprice<?php echo $row['idspQuotation'];?>" name="spQuotationPrice" min="1" max="50" onkeyup="keyupQuotationfun()" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="spPostingCountry">Country <span class="red">*</span></label>
                                         <span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                       <!--  <select id="spUserCountry" class="form-control " name="spQuotationCountry" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotationDelevery']; ?>">
                                            <option value="">Select Country</option>
                                            <?php
                                            $co = new _country;
                                            $result3 = $co->readCountry();
                                            if($result3 != false){
                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                    ?>
                                                    <option value='<?php echo $row3['country_id'];?>' ><?php echo $row3['country_title'];?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select> -->

                                     
                                           <?php
                                                        $rc = new _country; 
                                                        $result_cntry = $rc->readCountryName($row['spQuotationCountry']);
                                                        if ($result_cntry) {
                                                            $row4 = mysqli_fetch_assoc($result_cntry); ?>
                                                           
                                                             <input type="text" id="spUserCountry" class="form-control " name="spQuotationCountry" value="<?php echo $row4['country_title'];?>">
                                                    <?php  }
                                                        ?>

                                         

                                     
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="loadUserState">
                                        <div class="form-group">
                                            <label for="spPostingCity">State <span class="red">*</span></label>
                                             <span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                 <!--    <select class="form-control" name="spQuotationState" id="spUserState" onkeyup="keyupQuotationfun()">
                                                <option value="">Select State</option>
                                            </select> -->
                                             

                                                 <?php
                                                        $st = new _state;
                                                        $result_stat = $st->readStateName($row['spQuotationState']);
                                                        if ($result_stat) {
                                                            $row6 = mysqli_fetch_assoc($result_stat);?>
                                                           

                                                             <input type="text" id="spUserState" class="form-control " name="spQuotationState" value="<?php echo $row6['state_title']; ?>">
                                                     <?php   }
                                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="loadCity">
                                        <div class="form-group">
                                            <label for="spPostingCity">City <span class="red">*</span></label>
                                            <span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                        <!--  <select class="form-control" name="spQuotationCity" id="spUserCity" onkeyup="keyupQuotationfun()">
                                                <option value="">Select City</option>
                                            </select> -->

                                             <?php
                                                        $rcty = new _city;
                                                        $result_cty = $rcty->readCityName($row['spQuotationCity']);
                                                        if ($result_cty) {
                                                            $row5 = mysqli_fetch_assoc($result_cty);?>
                                                         
                                                       <input type="text" id="spUserCity" class="form-control " name="spQuotationCity" value="<?php echo $row5['city_title']; ?>">
                                                      <?php  }
                                                        ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                    <label for="productdetails" class="control-label contact">Comments <span class="red">*</span></label>
                                      <span id="productdetails_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                    <textarea class="form-control" id="productdetails" name="spQuotatioProductDetails" onkeyup="keyupQuotationfun()" value="<?php echo $row['spQuotatioProductDetails']; ?>"><?php echo $row['spQuotatioProductDetails']; ?></textarea>

                                  </div>
                                </div>
                            </div>
                           
                          
                        </div>
                        <div class="modal-footer bg-white br_radius_bottom">
                            <button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-submit  db_btn db_primarybtn" id="quotationsubmit"  onclick="get_Quotationdata(<?php echo $row['idspQuotation'];?>)">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal For Quatation Complete-->

                                                       

                                                                        
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
                                                }
                                               else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="9">
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
                       <!--  </div>
 -->
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


$(document).ready(function(){
  $('[data-toggle="tooltippay"]').tooltip();   
});




 function get_Quotationdata(id){
//alert();

       
var quote_id = $("#quote_id"+id).val()
 
 var deleveryprice = $("#deleveryprice"+id).val()

if (deleveryprice == "") {
            
            $("#deleveryprice_error").text("Please Enter Price.");
             $("#deleveryprice").focus();


             return false;
 }else{
   $.ajax({
            type: 'POST',
            url: '../../buy-sell/sendquotation.php',
            data: {quote_id: quote_id, deleveryprice: deleveryprice},
            
                
            success: function(response){ 

                         //console.log(data);

                                 swal({

                                  title: "Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

  
            }
        });

 }
}

  



</script>   
    </body>
</html>
<?php
}?>