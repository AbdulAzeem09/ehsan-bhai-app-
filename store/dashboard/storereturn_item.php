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

          <script type="text/javascript">
          
function CheckColors(val){
//  alert();
 var element=document.getElementById('sel1').value;;
 // alert(element);
 if(val=='pick a color'||val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script> 
        
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>

     <?php


    if (isset($_GET['orderid']) && $_GET['orderid'] > 0) {
        $cid = $_GET['orderid'];

        $p = new _orderSuccess;
        $result = $p->readCnfrmOrdr($cid);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $txnId = $row['txn_id'];
            $dt = new DateTime($row['payment_date']);
            $paymentEmail = $row['payer_email'];
             $currency = $row['currency'];
        }

    }else{
        $re = new _redirect;
        $redirctUrl = $BaseUrl . "/store/dashboard/my_orderhistory.php";
        $re->redirect($redirctUrl);
    } ?>                   

                               
        <section class="main_box">
            <div class="container">
                <div class="row">
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 15;
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
                        $storeTitle = "Buyer Dashboard / My Orders";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row">
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
                            </div> -->
                             <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                           <li><a href="#">My Order History</a></li>
                                     
                          </ul>
                            </div>

 

<?php 
             $or = new _order;
            $result1 = $or->readOrderTxn($txnId, $_SESSION['pid']);   

          //  echo $or->ta->sql;  
           
                if ($result1) {
             //  while ($row1 = mysqli_fetch_assoc($result1)) {
              /*  echo "<pre>";
                print_r($row1);*/
                      $row1 = mysqli_fetch_assoc($result1);
                  
                        $ProductTitle   = $row1['spPostingTitle'];
                         $orderpostid   = $row1['spPostings_idspPostings'];
                         $sporderAmount  = $row1['sporderAmount'];

                          $sellerpid  = $row1['spSellerProfileId'];

                           $buyerpid  = $row1['spByuerProfileId'];
                           $buyeruserid  = $row1['spBuyeruserId'];

                            $transectionid  = $row1['txn_id'];

                           
                        
                          $spOrderQty = $row1['spOrderQty'];

    

    $bp = new _spbusiness_profile;

    $rpvt = $bp->read($sellerpid);


    //echo $p->ta->sql;
    if ($rpvt != false){
      $row3 = mysqli_fetch_assoc($rpvt);
      $refunddata = $row3['spProfilerefund'];
     
            // echo "<pre>";
      //print_r($row);
      
    }


            $pp = new _productpic;  
             $result2 = $pp->read($orderpostid);
       // echo $pp->ta->sql;
        if($result2 != false){
          
                        $row2 = mysqli_fetch_assoc($result2);
                        $Productimg   = $row2['spPostingPic'];
                        
                        

                         }  ?>        




<!-- Modal -->
<div class="modal fade" id="RefundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px; ">
      <div class="modal-header" style="border-top-left-radius: 10px; border-top-right-radius: 10px;background: #DAF2C2;">
        <h4 class="modal-title" id="exampleModalLabel" style="padding-left: 5px; padding-top: 5px; font-size: 20px;">Refund Policy</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                     <?php 
                                     if ($refunddata) { ?>
                                       <p><?php echo  $refunddata;?></p> 

                                    <?php }else{ ?>
                                       <p>No Refund Policy</p>
                                   <?php  } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #A1D98D;color: #fff;">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
                          <div class="col-md-12">
                              <div class="store_return_1 bg_white">
                               
                                <h2>Choose items to return </h2>
                                <div class="row" style="margin-top: 30px; margin-bottom: 20px;">
                                  <div class="col-md-3">

                             

                                      <?php  
                                     if ($Productimg) {
                                       echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($Productimg) . "' style='height: 130px;' >";

                                     }else{
                                       echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive' style='height: 130px;'>";
                                     } 



                                    

                                     ?>
                                  <!--  <li class="dropdown"> -->
                               <!--  <a href="#" data-toggle="dropdown">Details<span class="caret"></span></a> -->
                           <!--    </li> -->
                                  </div>
                                  <div class="col-md-4">
                                  <h4 class="eventcapitalize" style="margin-top: 0px;"><?php echo $ProductTitle; ?> </h4> 

                                     <p><?php echo '$'. $sporderAmount; ?></p> 

                                      <p>Quantity: <?php echo  $spOrderQty;?></p>  

                                        <a href=""  data-toggle="modal" data-target="#RefundModal" style="font-weight: bold; text-decoration: underline;">Refund Policy</a>
                                  </div>
                               <!--   <select name="color" onchange='CheckColors(this.value);'> 
    <option>pick a color</option>  
    <option value="red">RED</option>
    <option value="blue">BLUE</option>
    <option value="others">others</option>
  </select>
 -->
      <form id="reviewratingform" enctype="multipart/form-data" >
          
           <input type="hidden" name="spByuerProfileId" value="<?php echo $buyerpid ; ?>">
          <input type="hidden" name="spBuyeruserId" value="<?php echo $buyeruserid ; ?>">

         <input type="hidden" name="spSellerProfileId" value="<?php echo $sellerpid; ?>">

           <input type="hidden" name="cid" value="<?php echo $cid; ?>">

        
           <input type="hidden" name="txn_id" value="<?php echo $transectionid; ?>">
           <input type="hidden" name="spproduct_title" value="<?php echo $ProductTitle; ?>">

                                   <div class="col-md-5">
                                <div class="form-group">
      <label for="sel1">Why are you returning this?<span style="color:red;">*</span></label>
      <select class="form-control" id="responseid" name="response" onchange="keyupresponsefun()" style="background: #E8E8E8;  border-radius: 5px; border: none;">
        <option value="">Choose a response</option>
        <option>Bought by mistake Better price available</option>
        <option>Performance or quality not adequate Incompatible or not useful</option>
        <option>Product damaged, but shipping box OK</option>
        <option>Item arrived too late</option>
        <option>Missing parts or accessories</option>
        <option>Product and shipping box both damaged</option>
        <option>Wrong item was sent</option>
        <option>Item defective or doesn't work Received extra item I didn't buy (no refund needed)</option>
        <option>No longer needed</option>
        <option>Didn't approve purchase Inaccurate website description</option>
      </select>
        <span id="response_error" style="color:red; font-size: 14px;"></span>
      </div>
        
         <div class="form-group">
             <label for="sel2">Comments(Optional) : </label>
             <textarea class="form-control"name="comments" rows="4"> </textarea>
         </div>

         <p><span style="font-weight: bold;">NOTE:</span> We aren't able to offer policy exceptions in response to comments. Do not include personal information as these comments may be shared with external service providers to identify product defects.
         </p>

    <!--   <input type="text" name="color" id="color" style='display:none;'/> -->
            <!--    <a href="" type="submit" class="btn btntcountine">Continue</a> -->

               <button type="submit" class="btn btntcountine">Submit</button>
      </div>

      </form>  
                              </div>

                             </div>
                          </div>  





     
      <?php }?>








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
   
  $(document).ready(function(e){

    // Submit form data via Ajax
    $("#reviewratingform").on('submit', function(e){

    
      var responsedata = $('#responseid').val();

//alert(responsedata);

if(responsedata == ""){

   $("#response_error").text("Select any response.");
  return false;
}else{
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'addreturn_response.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
            success: function(response){ 

                       //  console.log(data);


                                 swal({

                                  title: "Your response hasbeen submitted successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                      //  window.location.reload();
                            location.href = "<?php echo $BaseUrl;?>/store/dashboard/my-returningitem.php";

                                  });
            }
        });

      }





    });




});



 </script>


  <script type="text/javascript">
          
function keyupresponsefun() {

  //alert();

        var responsedata = $("#responseid").val();

//alert(responsedata.length);

   if(responsedata.length != 0)
  {
    $('#response_error').text(" ");
    
  }

  }
        </script>

      
    </body>
</html>
<?php
}
?>
