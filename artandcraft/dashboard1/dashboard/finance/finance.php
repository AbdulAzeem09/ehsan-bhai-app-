<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once ("../authentication/check.php");
    
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
   
    $pageactive = 2;
    // background color
    
    
    $als = new _allSetting;
    $query = $als->showBanner(20);
    if ($query) {
        $row = mysqli_fetch_assoc($query);
        $home_banner = $row['spSettingBanner'];
    }
    // get color code of store
    $query2 = $als->showBanner(1);
    if ($query2) {
        $row2 = mysqli_fetch_assoc($query2);
        $store_clr = $row2['spSettingMainClr'];
        $store_btn_clr = $row2['spSettingBtnClr'];
    }
    //FREELANCE COLOR
    $query3 = $als->showBanner(5);
    if ($query3) {
        $row3 = mysqli_fetch_assoc($query3);
        $freelance_clr = $row3['spSettingMainClr'];
    }
    //JOB BOARD COLOR
    $query4 = $als->showBanner(2);
    if ($query4) {
        $row4 = mysqli_fetch_assoc($query4);
        $jobboard_clr = $row4['spSettingMainClr'];
    }
     //REAL ESTATE COLOR
    $query5 = $als->showBanner(3);
    if ($query5) {
        $row5 = mysqli_fetch_assoc($query5);
        $realEstate_clr = $row5['spSettingMainClr'];
    }
    // EVENTS COLOR
    $query6 = $als->showBanner(9);
    if ($query6) {
        $row6 = mysqli_fetch_assoc($query6);
        $event_clr = $row6['spSettingMainClr'];
    }
    // ART GALLERY COLOR
    $query7 = $als->showBanner(13);
    if ($query7) {
        $row7 = mysqli_fetch_assoc($query7);
        $photo_clr = $row7['spSettingMainClr'];
    }
    // MUSIC COLOR
    $query8 = $als->showBanner(14);
    if ($query8) {
        $row8 = mysqli_fetch_assoc($query8);
        $music_clr = $row8['spSettingMainClr'];
    }
    // VIDEOS COLOR
    $query9 = $als->showBanner(10);
    if ($query9) {
        $row9 = mysqli_fetch_assoc($query9);
        $videos_clr = $row9['spSettingMainClr'];
    }
    // TRAININGS COLOR
    $query10 = $als->showBanner(8);
    if ($query10) {
        $row10 = mysqli_fetch_assoc($query10);
        $train_clr = $row10['spSettingMainClr'];
    }
    // CLASIFIED ADD COLOR
    $query11 = $als->showBanner(7);
    if ($query11) {
        $row11 = mysqli_fetch_assoc($query11);
        $clasifiedAdd_clr = $row11['spSettingMainClr'];
    }
    // BUSINESS DIRECTORY ADD COLOR
    $query12 = $als->showBanner(19);
    if ($query12) {
        $row12 = mysqli_fetch_assoc($query12);
        $busDirctry_clr = $row12['spSettingMainClr'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- custom page script -->
        <?php include('../../component/dashboard-link.php'); ?>

        <script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
        <link href="http://api.highcharts.com/highcharts">
          
        <style type="text/css">
            .bg_store{
                background-color: <?php echo $store_clr; ?>;
            }
            .bg_freelance{
                background-color: <?php echo $freelance_clr; ?>;
            }
            .bg_jobboard{
                background-color: <?php echo $jobboard_clr; ?>;
            }
            .bg_realestate{
                background-color: <?php echo $realEstate_clr; ?>;
            }
            .bg_events{
                background-color: <?php echo $event_clr; ?>;
            }
            .bg_artgallery{
                background-color: <?php echo $photo_clr; ?>;
            }
            .bg_music{
                background-color: <?php echo $music_clr; ?>;
            }
            .bg_video{
                background-color: <?php echo $videos_clr; ?>;
            }
            .bg_training{
                background-color: <?php echo $train_clr; ?>;
            }
            .bg_clasifidedads{
                background-color: <?php echo $busDirctry_clr; ?>;
            }
            .bg_business{
                background-color: <?php echo $clasifiedAdd_clr; ?>;
            }
            .bg_groups{
                background-color: <?php echo $busDirctry_clr; ?>;
            }
        </style>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php include('../../component/left-dashboard.php'); ?>

                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Finance<small>Event</small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Finance</li>
                                </ol>
                            </section>

                            <div class="content">
                               
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <?php
                           /*print_r($_SESSION['uid']);*/
                                        // GROUPS
                                        $et = new _spevent_transection;
                                        $t_eventtotalearn = 0;
                                        $result12 = $et->readeventtransection($_SESSION['uid']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($result12){

                                            while ($row = mysqli_fetch_assoc($result12)) {


                                                $t_eventtotalearn += $row['payment_gross'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }


                                      $wt = new _spwithdraw;
                                       
                                        $result13 = $wt->withdrawreadevent($_SESSION['uid']);

                                        //print_r($result12);



                                       // echo $wt->ta->sql;

                                        if($result13){

                                            while ($row2 = mysqli_fetch_assoc($result13)) {


                                                $withdraw_amount += $row2['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $total_balance = $t_eventtotalearn - $withdraw_amount;


                                           // GROUPS
                                        $gpt = new _spgroupevent_transection;
                                        $t_groupeventtotal = 0;
                                        $resgp = $gpt->readgroupeventtransection($_SESSION['uid']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($resgp){

                                            while ($rowgp_ev = mysqli_fetch_assoc($resgp)) {


                                                $t_groupeventtotal += $rowgp_ev['payment_gross'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }


                                      $wt = new _spwithdraw;
                                       
                                        $resultgroup = $wt->withdrawreadgroupevent($_SESSION['uid']);

                                        //print_r($result12);



                                       // echo $wt->ta->sql;

                                        if($resultgroup){

                                            while ($rowgrp = mysqli_fetch_assoc($resultgroup)) {


                                                $withdrawgroup_amount += $rowgrp['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $totalgroup_balance = $t_groupeventtotal - $withdrawgroup_amount;


                                        

                                        //print_r($total_balance);
                                       

                                       

                                          // store product

                                     
                                        $or = new _orderSuccess;
                                        $t_storetotalearn = 0;
                                        $result15 = $or->readuserallOrder($_SESSION['uid']);

                                           // echo $or->ta->sql;

                                              if($result15){

                                        while ($row15 = mysqli_fetch_assoc($result15)){
                                             
                                           //  echo "<pre>";
                                          $amount  = $row15['amount'];

                                          //echo  $amount;

                                          $t_storetotalearn += $amount;

                                         


                                               }
                                           }

                             $wt = new _spwithdraw;
                                       
                             $result14 = $wt->withdrawreadstore($_SESSION['uid']);


                                    //echo $wt->ta->sql;
                             if($result14){

                                     while ($row14 = mysqli_fetch_assoc($result14)) {


                                     $withdraw_storeamount += $row14['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_storebalance = $t_storetotalearn - $withdraw_storeamount;
                                        //print_r($total_balance);



                            // GROUPS private rgq
                            $tr = new _quotation_transection;
                            $t_privatetotalearn = 0;

                            $result17 = $tr->readprivatetrans($_SESSION['uid']);

                                       
                                       // echo $tr->ta->sql;

                                    if($result17){

                                    while ($row17 = mysqli_fetch_assoc($result17)) {


                                    $t_privatetotalearn += $row17['payment_gross'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }

                                        
                                     // private rfq
                             $wt = new _spwithdraw;
                                       
                             $result18 = $wt->withdrawreadprivate($_SESSION['uid']);


                                    //echo $wt->ta->sql;
                             if($result18){

                                     while ($row18 = mysqli_fetch_assoc($result18)) {


                                     $withdraw_privateamount += $row18['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_privatebalance = $t_privatetotalearn - $withdraw_privateamount;
                                        //print_r($total_balance);



                           // GROUPS public rgq
                            $rf = new _rfq_transection;
                            $t_publictotalearn = 0;

                            $result19 = $rf->readpublictransection($_SESSION['uid']);

                                       
                                      // echo $rf->ta->sql;

                                    if($result19){

                                    while ($row19 = mysqli_fetch_assoc($result19)) {


                                    $t_publictotalearn += $row19['payment_gross'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }

                                        
                                     // private rfq
                             $wt = new _spwithdraw;
                                       
                             $result20 = $wt->withdrawreadpublic($_SESSION['uid']);


                                    //echo $wt->ta->sql;
                             if($result20){

                                     while ($row20 = mysqli_fetch_assoc($result20)) {


                                     $withdraw_publicamount += $row20['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_publicbalance = $t_publictotalearn - $withdraw_publicamount;
                                        //print_r($total_balance);



                                       $finance = new _financereferral;
                            $t_referalearn = 0;

                            $result21 = $finance->readreferral($_SESSION['uid']);

                                       
                                      // echo $rf->ta->sql;

                                    if($result21){

                                    while ($row21 = mysqli_fetch_assoc($result21)) {


                                    $t_referalearn += $row21['amount'];

                                     }

                                  //  echo $t_privatetotalearn;        
                                }


                               $wt = new _spwithdraw;
                                       
                             $result22 = $wt->withdrawreadreferral($_SESSION['uid']);


                                    //echo $wt->ta->sql;
                             if($result22){

                                     while ($row22 = mysqli_fetch_assoc($result22)) {


                                     $withdraw_referralamount += $row22['withdraw_amount'];

                                              }

                                        //echo $t_eventtotalearn;                     
                                        }
                                       
                     $total_referralbalance = $t_referalearn - $withdraw_referralamount;

                                        ?>

                                       
                                   
                                        <div class="row">
                                            

                                             <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #90EE90;border-radius: 20px;">
                                                    <div class="inner">
                                                      <h3>$<?php  if($total_balance > 0 ){ echo $total_balance; }else{ echo "0" ; } ?></h3>
                                                      <p>Event Total Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Event </a>
                                                </div>
                                            </div>


                                            





                                            <!-- ./col -->
 
                                             <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #90EE90;border-radius: 20px;">
                                                    <div class="inner">
                                                      <h3>$<?php  if($total_storebalance > 0 ){ echo $total_storebalance; }else{ echo "0" ; } ?></h3>
                                                      <p>Store Total Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Store </a>
                                                </div>
                                            </div><!-- ./col -->


                                                
                                             <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box public_m" id="public_m" style="background-color: #90EE90;border-radius: 20px;">
                                                    <div class="inner">
                                                      <h3>$<?php  if($total_publicbalance > 0 ){ echo $total_publicbalance; }else{ echo "0" ; } ?></h3>
                                                      <p>Public RFQ Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Public RFQ </a>
                                                </div>
                                            </div>

                                             <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box private_m" id="private_m" style="background-color: #90EE90;border-radius: 20px;">
                                                    <div class="inner"  style=" padding: 11px;">
                                                       <h3>$<?php  if($total_privatebalance > 0 ){ echo $total_privatebalance; }else{ echo "0" ; } ?></h3>
                                                      <p style="font-size: 12px;">Private RFQ Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Private RFQ </a>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #90EE90;border-radius: 20px;">
                                                <div class="inner" style=" padding: 11px;">
                                                      <h3>$0</h3>
                                                      <p style="font-size: 12px;">Freelancer Total Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Freelancer</a>
                                                </div>
                                            </div>

                                             <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #90EE90;border-radius: 20px;">
                                                <div class="inner" style=" padding: 11px;">
                                                     <h3>$<?php  if($totalgroup_balance > 0 ){ echo $totalgroup_balance; }else{ echo "0" ; } ?></h3>
                                                      <p style="font-size: 10px;">GroupEvent Total Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Group Event</a>
                                                </div>
                                            </div><!-- ./col -->

                                              </div>

                                              <div class="row">
                                                          <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #90EE90;border-radius: 20px;">
                                                    <div class="inner">
                                                      <h3>$<?php  if($total_referralbalance > 0 ){ echo $total_referralbalance; }else{ echo "0" ; } ?></h3>
                                                      <p>Referral Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;" >Refferal </a>
                                                </div>
                                            </div>
                                              </div>



 
  <a href="<?php echo $BaseUrl; ?>/dashboard/finance/verifywithdraw.php" class="btn btn-info btn-lg mynewModalclass" style="float:right;">Withdraw Amount</a> 


<div class="modal fade" id="mynewverifyModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="border-top-left-radius: 15px;   border-top-right-radius: 15px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-size: 24px;">AUTHENTICATION REQUIRED</h4>
          
        </div>
       
<form id="verifyWithdarwform" method="post" >


 <input type="hidden" name="uid" value="<?php echo $_SESSION['uid'];?>" id="logintxtuid">
        <div class="modal-body">
         
              <div class="form-group">
                                                        
                  <label class="text-left">Enter the SMS code</label>

                 <input type="text" class="form-control" name="verifycode"> 

              </div>
             <a href="#" onclick="get_loginresendcode(<?php print_r($uid);?>);"><p style="text-decoration: underline;"><b>Re-Send OTP</b></p></a>


              <!-- <div class="text-center">

             <button type="submit" id="" autocomplete="off" class="btn btn_sign">Submit Code</button>
                                                       
              </div> -->

        <!--  <a href="<?php echo $BaseUrl; ?>/dashboard/finance/term&condition.php"><p style="text-decoration: underline;"><b>The Sharepage Terms & Conditions.</b></p></a> -->
            

        </div>  
        <div class="modal-footer" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 30px;">Close</button>
          <button type="submit" class="btn btn-info codesubmit" id="submit" style="border-radius: 30px;">Submit Code</button>


          </form>
        </div>
      </div>
      
    </div>


  <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="border-top-left-radius: 15px;   border-top-right-radius: 15px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-size: 24px;">Withdraw Amount</h4>
          
        </div>
         
         <form action="add_withdraw.php" method="post" id="Withdarwform">
        <div class="modal-body">
         

         

              <div class="form-group">
                <label for="email">Enter Amount:<span class="red">*</span></label>
                <input type="text" class="form-control" name="withdraw_amount" min="0" min="5"
                 onkeyup="this.value = minmax(this.value, 0, <?php echo $total_balance;?>)" id="Withdarw_ammount">

                <p style="color: red;" id="head"></p> 
                <p id="head1" style="color: red;"></p>
                <input type="hidden" name="userid" value="<?php echo $_SESSION['uid'];  ?>">
                <input type="hidden" name="profile_id" value="<?php echo $_SESSION['pid'];  ?>">
                <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total_balance;  ?>">
                <input type="hidden" name="module" value="event">
                <input type="hidden" name="created" value="<?php echo  date('Y-m-d H:i:s');  ?>">
              </div>

              

              <a href="<?php echo $BaseUrl; ?>/dashboard/finance/term&condition.php"><p style="text-decoration: underline;"><b>The Sharepage Terms & Conditions.</b></p></a>
            

        </div>  
        <div class="modal-footer" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 30px;">Close</button>
          <button type="submit" class="btn btn-info" id="submit" style="border-radius: 30px;">Submit</button>
          </form>
        </div>
      </div>
      
    </div> 
  </div>
                                      



                                        <div class="row">
                                         
                                       

                                
                                        </div>
                                    </div>
                                    
                                    

                                </div><!-- /.row -->
                       
                                
                                                                            
                                

                                
                                       
                                

                                

                                

                                

                            

                                
                                <!-- END -->


                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        <!-- ChartJS 1.0.1 -->
      
       
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>

<!-- <script type="text/javascript">

   
$(document).ready(function(e){
   
 $(".mynewModalclass").on("click", function () {

      //  alert();

        var session_id = '<?php echo $_SESSION['uid'];?>';

      //  alert(session_id);

     //  e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'verifywithdraw.php',
            data: {'userid': session_id},
             
            success: function(data){ 

                         //console.log(data);
             $("#mynewverifyModal").modal("show");
  
            }
        });
    });
});

</script> -->

  
<script type="text/javascript">

$(document).ready(function(e){
   
 $(".codesubmit").on("click", function () {

       // alert();

      //  e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'successverifywithdraw.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
             
            success: function(data){ 

              //console.log(data);
             $("#myModal").modal("show");
  
            }
        });
    });
});

</script>

<script type="text/javascript">
    
     var number = document.getElementById('total_amount');

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
    //alert(max);
    //alert(parseInt(value));

   /* if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; */

         if(max <= 0){

            //alert('1');
          $('#head1').text(" ");   
        $('#head').text("Minimum amount is $100 for withdarw."); 
      return 0;
    
    }else if(parseInt(value) > 100 ){

        //alert('2');
        $('#head1').text(" ");
      return 100;
    
    } else if(parseInt(value) > max){
        
          $('#head1').text(" ");
        //alert('3');

return max;

    } else{

       // alert('4');
         $('#head1').text(" ");
         $('#head').text("Maximum Amount is $100 for withdarw."); 


          return value;
    } 
         
  
}
</script>

<script type="text/javascript">
    
$(document).ready(function() {
  //alert();
  $('#submit').click(function() {
    //alert();

var amount = $('#Withdarw_ammount').val();

//alert(amount);

if (amount.length == 0){
    $('#head1').text("This filed is required."); 
return false;
}else {
$("#Withdarwform").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});
</script>



        <!-- Sky Icons -->
      
      

        <!-- OTHER DASHBOARD STORE DETAIL -->
        <!-- Morris.js charts -->
   
        <!-- ALL DASHBOARD GRAPHS -->
        
        
        <!-- END -->

    </body>	
</html>
<?php
}
?>