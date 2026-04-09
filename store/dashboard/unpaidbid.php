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
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 51;
                       // include('left-menu.php'); 
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
                        ?>
                        
                        <div class="row">
<!-- 
                                    <div class="col-md-12">
                                          <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Unpaid Bid</a></li>

                                    </ul>
                                

                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||  $activePage = 50 ||  $activePage = 51)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            
                            </div> -->
                              <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Unpaid Bid</a></li>
                                     
                          </ul>
                            </div>






                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">ID</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>My Bid</th>
                                                    <th>Last Bid</th>
                                                    <th>Posting Date</th>
                                                    <th>Expiry Date</th>
                                                     <th>Pay</th>
                                                    
                                                   <!--  <th class="text-center">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //$p = new _postingview;
                                               $p = new _productposting;

                                                /*$result = $p->mydeactiveauctionbid($_SESSION['pid']);*/
                                                $result = $p->getexpiredproductbid($_SESSION['pid']);

                                               /* echo $p->ta->sql;*/

                                                           

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                     /*    print_r($_SESSION['pid']);
                                                        echo"<pre>";*/
                                                  //    echo "here";  print_r($row);

                                                        $b = new _spauctionbid;

                                                        $result1 = $b->auctionhighestbid($row['idspPostings']);

                                                         /*echo $p->ta->sql;*/

                                                        $row1 = mysqli_fetch_assoc($result1);



                                                        $result2 = $p->read($row['idspPostings']);
                                                         $row2 = mysqli_fetch_assoc($result2);

                                                        /*print_r($row2);*/

                                          if($row1['spProfiles_idspProfiles'] == $_SESSION['pid'] && $row1['status'] == 0 ){

                                                        $dt = new DateTime($row['spPostingDate']);
                                                        $edt = new DateTime($row['spPostingExpDt']);



                                                        
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td><a href="<?php echo $BaseUrl.'/my-store/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>
                                                            <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                            <td>$<?php echo $row['auctionPrice']; ?></td>
                                                            <td>$<?php echo $row['lastBid']; ?></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <td><?php echo $edt->format('d M Y'); ?></td>
                                                    <td class="text-center">
                                                                
                                                                                                  <?php
                                // ===PAYPAL ACCOUNT LIVE SETTING
                                // RETURN CANCEL LINK
                                  $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
                                // RETURN SUCCESS LINK
                                  $success_return = $BaseUrl."/paymentstatus/auction_payment_success.php?postid=".$row['idspPostings']."&sellid=".$row2['spProfiles_idspProfiles']."&bidid=".$row1['id'];

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



                                                echo "<input type='hidden' name='item_name_1' value='".$row['spPostingTitle']."'>";
                                                echo "<input type='hidden' name='item_number' value='143' >";
                                                echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_1' value='".$row['auctionPrice']."'>";
                                                
                                                echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
                                    ?>
                               <button type="submit" class="btn btn-submit" id="Buynow"  style="border-radius: 25px;    min-width: 71px;float: left;">Pay</button>

                                          <!--   <div class="form-group price">
                                                <span style="font-size: 20px;">Ticket Price: <span class="red_clr"><strong>$<?php echo $row['auctionPrice'];?></strong></span></span>
                                            </div> -->
                                            
                                            <!-- <div class="form-group price">
                                                <span style="font-size: 20px;">Quantity</span>
                                                <input type="hidden" id="spOrderQty" value="<?php echo (isset($Quantity))?$Quantity:'1';?>"> 
                                                <input type="number" class="form-control no-radius" style="width: 60px;margin-right: 5px" id="newValue" name="spOrderQty" placeholder="" value="1" onkeyup="checkqty(this.value);" >
                                            </div> -->
                         

</form>





                                                            </td>

                                                         <!--    <td class="text-center">
                                                              
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['idspPostings']; ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                                <a href="<?php echo $BaseUrl.'/post-ad/sell/?postid='.$row['idspPostings']; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" ></a>
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" ></a>
                                                            </td> -->
                                                        </tr>
                                                       <?php
                                                       $i++;

                                                       }else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="8">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                

                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="8">
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
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
} ?>