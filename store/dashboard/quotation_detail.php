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
             
.column {
  float: left;
  width: 12.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.myimgs::after {
  content: "";
  clear: both;
  display: table;
}

            input[type="file"] {
    display: block!important;
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
                    <!-- <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <?php
                           // include('../component/left-store.php');
                        ?>
                    </div> -->
                    <div class="col-md-12">
                        
                        <?php 
                        $activePage = 8;
                        $storeTitle = " (<small>RFQ Detail</small>)";
                      //  include('top-dashboard.php');
                        
                        $r = new _rfq;
                        $result = $r->readRfqquotedetail($_GET['idrfqcomment']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }
                        
                        ?>
                        <div class="row">
                                      <div class="col-md-12">
                                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 0px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/public_rfq'; ?>">Public RFQ</a></li>

                          <li><a href="<?php echo $BaseUrl.'/store/dashboard/quotation_detail.php?rfq='.$_GET['idrfqcomment'];?>">Quotation Detail</a></li>
                                     
                          </ul>
                                      </div>
                                  </div>  
                        <div class="bg_white_border quoteDetail bradius-15">
                            <div class="row">
                                <div class="col-md-12">
                                  
                                

                                     <div class="row">

                                        <div class="col-md-12">
                                        <h2 class="eventcapitalize" style="margin-top: 20px;"> <?php echo $row['rfqcProductName'];?></h2>
                                            <p class="text-justify"><?php echo $row['rfqDesc']; ?></p>
                                        </div>
                                    </div>

                                    <div class="space"></div>
                                    <h2>Features</h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th style=" width: 300px!important;">Cost per item/piece ($)</th>
                                                   
                                                    <td><?php echo $row['rfqPrice']; ?></td>

                                                </tr>
                                                <tr>
                                                    <th>Minimum order</th>
                                                    <td><?php echo $row['rfqcMinOrder']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Maximum supply per month</th>
                                                    <td><?php echo $row['rfqcMaxOrder']; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <th>link to product (from store)</th>
                                                    <td>
                                                     <?php echo $row['rfqcLinkProduct']; ?>  
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <th>Video Link</th>
                                                    <td>
                                                       <?php echo $row['rfqcvideoLink']; ?>
                                                    </td>
                                                    
                                                </tr>
                                               

                                            </tbody>
                                        </table>
                                    </div>


                                        <div class="row myimgs" style="margin-bottom: 22px;">
                                                 <div class="col-md-12">
                                             <?php

                      
                        $result1 = $r->readRfqquotedetail($_GET['idrfqcomment']);
                       /* if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }*/
                         if ($result1) {
                                                    $i = 1;
                                         while ($row1 = mysqli_fetch_array($result1)) {

                                            $image = $row1 ['rfqcImage'];

                                             $x=0;                                                
                                            $car_img = explode(",",$image);
                                            foreach($car_img as $images){                                                 
                                            $x+=1;

                                           // echo $images;


                                                if(!empty($images)){ ?>

                                               
                                                  <div class="column">                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $images; ?>' style="height: 100px; width: 110px;" >

                                                    </div>
                                                  
                                                    <?php
                                                }
                                                else{
                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive blank' style=' height: 100px; width: 110px; '>";
                                                }
                                            }

                                            }

                                        }
                                            ?>
                                            </div> 
                                      
                                    </div>


                            <!--     <?php   


                // ===PAYPAL ACCOUNT LIVE SETTING
                // RETURN CANCEL LINK
                $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
                // RETURN SUCCESS LINK
                $success_return = $BaseUrl."/paymentstatus/store_payment_success.php?post_idspRfqComment=".$row['idspRfqComment']."&sell_idspRfq=".$row['idspRfq'];



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
                $paypal_url   = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                // live payment
                //$paypal_url   = 'https://www.paypal.com/cgi-bin/webscr';
                //Here we can used seller email id. 
                $merchant_email = 'developer-facilitator@thesharepage.com';
                // live email
                //$merchant_email = 'sharepagerevenue@gmail.com';
                                
                //paypal call this file for ipn
                //$notify_url   = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
                ?>


  
                <form action="<?php echo $paypal_url; ?>" method="post" class="form-inline">
                  <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                
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

                 
                  <input type="hidden" name="landing_page" value="billing">

              

               
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="upload" value="1">

                            
                  <?php



                      echo "<input type='hidden' name='item_name_1' value='".$row['rfqcProductName']."'>";
                        echo "<input type='hidden' name='item_number' value='143' >";
                        echo "<input type='hidden' class='".$row['idspRfqComment']."' name='amount_1' value='".$row['rfqPrice']."'>";
                        
                        echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                  ?>
                          
             <button type="submit" class="btn butn_draf db_btn db_primarybtn">Pay</button>


             <a href="<?php echo $BaseUrl.'/store/dashboard/quote_contactform.php?idspRfqComment='.$row['idspRfqComment']; ?>"  class="btn butn_draf btnpublic_rfq" >Contact</a>
                         
                                            
                            

</form> -->
                                                    
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
<!-- 

<script type="text/javascript">
//function get_approvedata(id){

 function get_commentdata(id){
//alert();



       
var quoteTitle = $("#quoteTitle").val()
 
 var quotedescription = $("#quotedescription").val()
 var quoteMedia = $("#quoteMedia").val()

 var idspProfiles = $("#spProfiles_idspProfiles").val()

 

//alert(quoteTitle);
//alert(quotedescription);
 alert(quoteMedia);
/*
if (sellercommentid == "") {
            
            $("#sellercommentid_error").text("Please Enter Comment.");
             $("#sellercommentid").focus();


             return false;
 }else{*/
   $.ajax({
            type: 'POST',
            url: 'addquote_contactdetail.php',
            data: {contact_title: quoteTitle, contact_desc: quotedescription, spProfiles_idspProfiles: idspProfiles, contact_image: quoteMedia},
            
                
            success: function(response){ 

                         //console.log(data);

                              /*   swal({

                                  title: "Contact Detail Submitted Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });*/

  
            }
        });

 //}


  }



</script> -->
   </body>
</html>
<?php
} ?>