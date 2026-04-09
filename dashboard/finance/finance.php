<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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

$pageactive = 50;
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
 <link rel="stylesheet" href="/bashar_design/misc/css/bootstrap.min.css">
 <link rel="stylesheet" href="/bashar_design/misc/css/finance.css">
    <script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
    <link href="http://api.highcharts.com/highcharts">
  <link rel="stylesheet" href="css/bootstrap.min.css">
 <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
 <!-- Latest compiled and minified JavaScript 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <style type="text/css">
 .bg_events:hover{
	 color:black;
	 
 }
 img {
    border: 0px;
}
.panel-heading {
    margin-bottom: 5px;
	margin-left: -30px;
	position:inherit;
}
.tr{background-color:#f3a0a0!important;}
.bon{background-color:#a5e06e!important;}
.leftDashboard.sidebar {
    padding-bottom: 10px;
}
.tr2{background-color:#07bfc3!important;}
.bon{background-color:#a5e06e!important;}
.leftDashboard.sidebar {
    padding-bottom: 10px;
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
                <div class="col-md-10 no_pad_left" style="background-color:white">
                    <div class="rightContent">
                        <!-- breadcrumb -->
                        <section class="content-header">
                            <h1>Finance</h1>
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
				   
				   
				   
				   <?php  
	
	
	$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet($_SESSION['uid']);
//echo $_SESSION['uid'];
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount1+=$r['amount'];
	
	}}?>
	
	<?php  
	$module = "event";
	 $w= new _orderSuccess;
	 $res= $w->readid($_SESSION['uid'],$module); 
	 //var_dump($res);
	 if($res!=false){ 
	//$amount=0;
	while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);
	
	$amount2+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount2==0)
	{
$amount2=0;
	}
	}
	//echo $amount2;
	
	 }
	
	//echo $amount3.'======';
	
	 $amount3 = ($amount1 - $amount2);
	?>
	
	<?php    
	//echo $_SESSION['uid'];
		 $sp= new _spuser;
		 $result = $sp->readcurrency($_SESSION['uid']);
		 
		  if($result!=false){ 
	
	while($row_n=mysqli_fetch_assoc($result)){

	
	 $currency=$row_n['currency'];

	
	}
		  }
	
	?>
               <div class="row">
                   <div class="col-md-4">
				   <div class="panel">
				   <div class="panel-heading bg-event">
                            <h3 class="panel-title"><img src="cal4.png" class="img-responsive"></h3>
                        </div>
                        <!-- small box -->
                      
						 <div class="panel-body border-event" style="padding-top:30px">
						   <div class="small-box bg_events">
                            <div class="inner">
                              <h3><?php  if($amount1 > 0 ){ echo $currency.' '.$amount1; }else{ echo $currency.' '.'0' ; } ?></h3>
                              <p>Event Total Earning </p>
                          </div>
                          <div class="summary">                              
                              <p>Earnings: <b><?php  if($amount1 > 0 ){ echo $currency.' '.$amount1; }else{ echo $currency.' '.'0' ; } ?></b></p>
                              <p>Withdraw: <b><?php $amut=0;  if($amount2){  echo $currency.' '.$amount2; } else { echo $currency.' '.$amut;} ?></b></p>
                              <p>Balance: <b><?php if($amount3) {echo $currency.' '.$amount3; } else {  echo $currency.' '.'0'; } ?></b></p>
                          </div>
                          <div class="icon">
                              <i class="fa fa-dollar"></i>
                          </div>
						  </div>
					 </div>
						  <div class="panel-footer bg-event"> 
                          <a href="<?php echo $BaseUrl.'/dashboard/finance/event_wallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Event </a>
                      </div>   
                     				  
                  </div>
				  </div>
                  <?php  
                      $oi= new _spcustomers_basket;
                      $oid= $oi->readid($_SESSION['uid']);
                      if($oid!=false){
						 // die('==');
    	               //$amount=0;
                       while($r=mysqli_fetch_assoc($oid)){
    	               //print_r($r);
                           $amount8+=$r['amount'];
				
					  }}
					  if($amount8==""){
						  $amount8=0;
					  }
					  //echo $amount8;
						 // die('==');
					  
					  ?>
                       <?php  
                       $module = "store";
                       $w= new _orderSuccess;
                       $res= $w->readid($_SESSION['uid'],$module); 
                       if($res!=false){ 
    	               //$amount=0;
                           while($ra=mysqli_fetch_assoc($res)){
    	               //print_r($r);

                               $amount9+=$ra['amount'];
                    	//$dated = $ra['date'];
                    	//echo $dated;

                           }
    	               //echo $amount2;
                           $amount10 = ($amount8 - $amount9); 
                       }
                   ?>
                   <!-- ./col -->
                    <div class="col-md-4">
					<div class="panel">
				   <div class="panel-heading bg-store">
                            <h3 class="panel-title"><img src="/bashar_design/misc/img/store100.png" class="img-responsive"></h3>
                        </div>
                        <!-- small box -->
                        <div class="panel-body border-store" style="padding-top:30px">
						   <div class="small-box bg_events">
                            <div class="inner">
                                <h3><?php   if($amount8 > 0 ){ echo $currency.' '.$amount8; }else{ echo $currency.' '."0" ; }?></h3>
                                <p>Store Total Earning </p>
                            </div>
                            <div class="summary">                              
                              <p>Earnings: <b><?php echo $currency.' '.$amount8;?></b></p>
                              <p>Withdraw: <b><?php $amut=0;  if($amount9){  echo $currency.' '.$amount9; } else { echo $currency.' '.$amut;} ?></b></p>
                              <p>Balance: <b><?php //echo $amount10;?><?php if($amount10) {echo $currency.' '.$amount10; } else {  echo $currency.' '.$amount8; }?></b></p>
                          </div>
                            <div class="icon">
                              <i class="fa fa-dollar"></i>
                            </div>
							</div>
							</div>
							 <div class="panel-footer bg-store"> 
                            <a href="<?php echo $BaseUrl.'/dashboard/finance/store_wallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Store </a>
                        </div>
						</div>
                    </div>
                    <!-- ./col --> 
                   
                    <!-- ./col -->
                   <?php 
				  
$pw = new _sprealEwallet;
$oid= $pw->readid_videos($_SESSION['uid']);

if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);

     $amount14+=$r['amount'];
		
}}
   
   // die('====');
   //echo $amount14;
   ?>


   <?php  
   $module = "Video";
   $w= new _orderSuccess;
   $res= $w->readid($_SESSION['uid'],$module); 
   if($res!=false){ 
	//$amount=0;
       while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);

           $amount15+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;

       }
	//echo $amount2;
       $amount16 = ($amount14 - $amount15); 
   }

   ?>
   <style>
   .aaa1{
	   background-color:#f1e0e0;
   }
   
   </style>
   <div class="col-md-4">
   	<div class="panel">
				   <div class="panel-heading aaa1">
                            <h3 class="panel-title  "><img src="vid.png" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
   <div class="panel-body border-store" style="padding-top:30px">
	  <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($amount14 > 0 ){ echo $currency.' '.$amount14; }else{ echo $currency.' '."0" ; }?></h3>
        <p>Videos Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($amount14 > 0 ){ echo $currency.' '.$amount14; }else{ echo $currency.' '."0" ; }?></b></p>
        <p>Withdraw: <b><?php //echo $amount15;?><?php $amut=0;  if($amount15){  echo $currency.' '.$amount15; } else { echo $currency.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount16;?><?php if($amount16) {echo $currency.' '.$amount16; } else {  echo $currency.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i>
  </div>
  </div>
  </div>
   <div class="panel-footer aaa" style=" margin-left: 0px!important;"> 
  <a href="<?php echo $BaseUrl.'/dashboard/finance/videos_wallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase; " >Videos</a>
</div>
</div>
</div>
                

     
    <!-- ./col -->
	
	<?php  
	
	//echo $_SESSION['uid'];die;
	$oi= new _spcustomers_basket;
$oid= $oi->readfromgewallet($_SESSION['uid']);
//echo $_SESSION['uid'];
  //var_dump($oid);
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount21+=$r['amount'];
	
	}}
	//echo $amount1;
	?>
	
	<?php  
	$module = "groupevent";
	 $w= new _orderSuccess;
	 $res= $w->readid($_SESSION['uid'],$module); 
	 //var_dump($res);
	 if($res!=false){ 
	//$amount=0;
	while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);
	
	$amount22+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount22==0)
	{
$amount22=0;
	}
	}
	//echo $amount22;
	 $amount23 = ($amount21 - $amount22);
	 }
	
	//echo $amount3.'======';
	 
	?>
	
	
	
    <div class="col-md-4">
	<div class="panel">
				   <div class="panel-heading bg-gevent">
                            <h3 class="panel-title"><img src="/bashar_design/misc/img/events100.png" class="img-responsive"></h3>
                        </div>
        <!-- small box -->
         <div class="panel-body border-gevent" style="padding-top:30px">
			 <div class="small-box bg_events">
            <div class="inner">
             <h3><?php   if($amount21 > 0 ){ echo $currency.' '.$amount21; }else{ echo $currency.' '."0" ; } ?></h3>
               <p>Group Event Total Earning </p>
           </div>
            <div class="summary">                              
                <p>Earnings: <b><?php   if($amount21 > 0 ){ echo $currency.' '.$amount21; }else{ echo $currency.' '."0" ; } ?></b></p>
                <p>Withdraw: <b><?php $amut=0;  if($amount22){  echo $currency.' '.$amount22; } else { echo $currency.' '.$amut;} ?></b></p>
                <p>Balance: <b><?php //echo $amount10;?><?php if($amount23) {echo $currency.' '.$amount23; } else {  echo $currency.' '.'0'; }?></b></p>
            </div>
           <div class="icon">
              <i class="fa fa-dollar"></i>
          </div>
		  </div>
		  </div>
		   <div class="panel-footer bg-gevent"> 
          <a href="<?php echo $BaseUrl.'/dashboard/finance/group_event_wallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Group Event</a>
      </div>
	  </div>
    </div>
    <!-- ./col -->
    <div class="col-md-4">
	<div class="panel">
				   <div class="panel-heading bg-artcart">
                            <h3 class="panel-title"><img src="/bashar_design/misc/img/arts100.png" class="img-responsive"></h3>
                        </div>
     <?php
     $user_id = $_SESSION['pid'];											  		
     $o = new _artcraftOrder;
     $resultOrder = $o->readSellerOrdertotalpronew($user_id);	
     if($resultOrder){	
         $roworder = mysqli_fetch_array($resultOrder);
         $resultStatus = $o->existStatus($roworder['id']);	
         if($resultStatus){	
             $rowststus = mysqli_fetch_array($resultStatus);
             if($rowststus['Delivered']==1 && $rowststus['Cancel'] == 0){
                 $spPostings_idspPostings = $roworder['spPostings_idspPostings']; 
                 $p = new _postingview;
                 $pres = $p->singletimelines($spPostings_idspPostings);
                 $resrp = mysqli_fetch_array($pres);
			//print_r($resrp); die;
            //echo $spPostings_idspPostings;
                 if($resrp['return_if_applicable']== 1){  
                    $now = time(); 
                    $your_date = strtotime($roworder['checkout_date']);
                    $datediff = $now - $your_date;
                    $days_between = round($datediff / (60 * 60 * 24));
                //echo $days_between; die;
                    if($days_between >= $resrp['return_within']){
                       $price = $roworder['price'];
                       $spOrderQty = $roworder['spOrderQty'];
                       $amount = $price * $spOrderQty;
                       $w = new _artandcraftWallet;	
                       $resultWallet = $w->readartandcraftWallet($user_id);	
                       $action = 1;
                       if(!$resultWallet){	
                         $o->updateBuyerOrderstatus($roworder['id'],$action);
                         $w->createartandcraftWallet($user_id,$amount);	
                     }else{
                         $rowwallet = mysqli_fetch_array($resultWallet);
                         $amount = $rowwallet['amount']+$amount;
                         $o->updateBuyerOrderstatus($roworder['id'],$action);
                         $w->updateartandcraftWallet($user_id,$amount);	
                         }
                     }
                 }
             }
         }
     }
     $w = new _artandcraftWallet;	
     $resultWallet = $w->readartandcraftWallet($user_id);	
     if($resultWallet){	
       $rowwallet = mysqli_fetch_array($resultWallet);
       $amount = $rowwallet['amount'];
    }
    ?>
    <!---artandcraft earning --->
    <?php  
    $oi= new _spcustomers_basket;
    $oid= $oi->readiddd($_SESSION['uid']);
    if($oid!=false){
        	//$amount=0;
       while($r=mysqli_fetch_assoc($oid)){
        	//print_r($r);
         $amount11+=(int)$r['amount'];
		 //echo $amount11;
		 //die("==");
     }
	 
     ?>
     <?php  
     $module = "artandcraft";
     $w= new _orderSuccess;
     $res= $w->readid($_SESSION['uid'],$module); 
     if($res!=false){ 
        	//$amount=0;
         while($ra=mysqli_fetch_assoc($res)){
        	//print_r($r);
             $amount12+=$ra['amount'];
        	//$dated = $ra['date'];
        	//echo $dated;
         }
        	//echo $amount2;
         $amount13 = ($amount11 - $amount12); 
     }
    } 
	
	if($amount11==""){
		 $amount11=0;
	 }
    ?>
        <!-- artandcraft earning  -->
         <div class="panel-body border-artcart" style="padding-top:30px">
			 <div class="small-box bg_events">
            <div class="inner">
                <h3><?php  if($amount11 > 0 ){ echo $currency.' '.$amount11; }else{ echo $currency.' '."0" ; } ?></h3>
                <p>Art And Craft Earning </p>
            </div>
            <div class="summary">                              
                <p>Earnings: <b><?php echo $currency.' '.$amount11;?></b></p>
                <p>Withdraw: <b><?php //echo $amount12;?> <?php $amut=0;  if($amount12){  echo $currency.' '.$amount12; } else { echo $currency.' '.$amut;} ?></b></p>
                <p>Balance: <b><?php //echo $amount13;?><?php if($amount13) {echo $currency.' '.$amount13; } else {  echo $currency.' '.$amount11; }?></b></p>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
			</div>
			</div>
			  <div class="panel-footer bg-artcart">
            <a href="/dashboard/finance/artandcraft.php" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Art And Craft </a>
        </div>
		</div>
    </div>



 

<?php  
$pw = new _sprealEwallet;
$oid= $pw->readid($_SESSION['uid']);

if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);

      $amount5+=$r['amount'];

} }?>


  <?php  
  $module = "realEstate";
  $w= new _orderSuccess;
  $res= $w->readid($_SESSION['uid'],$module); 
  if($res!=false){ 
	//$amount=0;
   while($ra=mysqli_fetch_assoc($res)){
	//print_r($r);

      $amount6+=$ra['amount'];

	//$dated = $ra['date'];
	//echo $dated;

  }
	//echo $amount2;
  $amount7 = ($amount5 - $amount6); 

}

?>


<!-- ./col -->

<div class="col-md-4">
<div class="panel">
				   <div class="panel-heading bg-realestate">
                            <h3 class="panel-title"><img src="/bashar_design/misc/img/realestate100.png" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
  <div class="panel-body border-realestate" style="padding-top:30px">
			 <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($amount5 > 0 ){ echo $currency.' '.$amount5; }else{ echo $currency.' '."0" ; } ?></h3>
        <p>RealEstate Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($amount5 > 0 ){ echo $currency.' '.$amount5; }else{ echo $currency.' '."0" ; } ?></b></p>
        <p>Withdraw: <b><?php //echo $amount6;?><?php $amut=0;  if($amount6){  echo $currency.' '.$amount6; } else { echo $currency.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount7;?><?php if($amount7) {echo $currency.' '.$amount7; } else {  echo $currency.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i>
  </div>
  </div>
  </div>
   <div class="panel-footer bg-realestate">
  <a href="<?php echo $BaseUrl.'/dashboard/finance/realEstate_wallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Real Estate</a>
</div>
</div>
</div>
 
<?php  
	
	//echo $_SESSION['uid'];die;
	$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet1($_SESSION['uid']);
//echo $_SESSION['uid'];
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount100+=$r['amount'];
	
	}}?>
	
	<?php  
	$module = "freelancer";
	 $w= new _orderSuccess;
	 $res= $w->readid($_SESSION['uid'],$module); 
	 //var_dump($res);
	 if($res!=false){ 
	//$amount=0;
	while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);
	
	$amount200+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount200==0)
	{
$amount200=0;
	}
	}
	//echo $amount2;
	
	 }
	 $amount300 = ($amount100 - $amount200);
	//echo $amount3.'======';
	 
	?>


<!-- ./col -->
<style>

.bbb{
	background-color: #d6e6ed;
}

</style>

<div class="col-md-4">
<div class="panel">
				   <div class="panel-heading bbb">
                            <h3 class="panel-title"><img src="ev1.jpg" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
  <div class="panel-body border-realestate" style="padding-top:30px">
			 <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($amount100 > 0 ){ echo $currency.' '.$amount100; }else{ echo $currency.' '."0" ; } ?></h3>
        <p>Freelancer Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($amount100 > 0 ){ echo $currency.' '.$amount100; }else{ echo $currency.' '."0" ; } ?></b></p>
        <p>Withdraw: <b><?php //echo $amount6;?><?php $amut=0;  if($amount200){  echo $currency.' '.$amount200; } else { echo $currency.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount7;?><?php if($amount300) {echo $currency.' '.$amount300; } else {  echo $currency.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i> 
  </div>
  </div>
  </div>
   <div class="panel-footer bbb">
  <a href="<?php echo $BaseUrl.'/dashboard/finance/freelancerwallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Freelancer</a>
</div>
</div>
</div>

<?php  
	
	//echo $_SESSION['uid'];die;
	$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet_bonus($_SESSION['uid']);
//echo $_SESSION['uid'];
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount101+=$r['amount'];
	
	}}?>
	
	<?php  
	$module = "bonus";
	 $w= new _orderSuccess;
	 $res= $w->readid($_SESSION['uid'],$module); 
	 //var_dump($res);
	 if($res!=false){ 
	//$amount=0;
	while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);
	
	$amount201+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount201==0)
	{
$amount201=0;
	}
	}
	//echo $amount2;
	
	 }
	 $amount301 = ($amount101 - $amount201);
	//echo $amount3.'======';
	 
	?>
<?php 
$mb = new _spmembership;
$result=$mb->readcommission($_SESSION['uid']);
if($result !=false){ 
$total=0;
while($row=mysqli_fetch_assoc($result)){
     $int1=$row['spuser_commission'];
      $total=$total+$int1;
}
}
?>
<?php 
$result2=$mb->ashish($_SESSION['uid']);
$total_withdrwal = 0;
if($result2){
    while($row=mysqli_fetch_assoc($result2)){

     $total_withdrwal =$total_withdrwal + $row['withdraw_amount'];
}
}

$total3=$total-$total_withdrwal;

?>
<!-- ./col -->
<style>

.bbb{
	background-color: #d6e6ed;
}
.bbb2{
	background-color: #07bfc3!implements;
}
</style>
<div class="col-md-4">
	
	<div class="panel">
				   <div class="panel-heading bbb" style="background-color:#a5e06e">
                            <h3 class="panel-title"><img src="cal1.jpg" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
  <div class="panel-body border-realestate" style="padding-top:30px">
			 <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($total > 0 ){ echo 'USD'.' '.round($total,2); }else{ echo 'USD'.' '."0" ; } ?></h3>
        <p>Bonus Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($total > 0 ){ echo 'USD'.' '.round($total,2); }else{ echo 'USD'.' '."0" ; } ?></b></p>
        <p>Withdraw: <b><?php //echo $amount6;?><?php $amut=0;  if($total_withdrwal){  echo 'USD'.' '.round($total_withdrwal,2); } else { echo 'USD'.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount7;?><?php if($total3) {echo 'USD'.' '.round($total3,2); } else {  echo 'USD'.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i> 
  </div>
  </div>
  </div>
   <div class="panel-footer bbb bon">
  <a href="<?php echo $BaseUrl.'/dashboard/finance/commission.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >Commission</a>
</div>
</div>
	
	</div>
	
	
	
	
<?php  
	
	//echo $_SESSION['uid'];die;
	$oit= new _spcustomers_basket;
$tr1= $oit->readfromwallet_training($_SESSION['uid']);
//echo $_SESSION['uid'];
	//print_r($tr1);
	//die('-------');
	if($tr1!=false){
	//$amount=0;
	while($r1=mysqli_fetch_assoc($tr1)){
	//print_r($r1);
	//die('-------');
	
	$amount111+=$r1['amount'];  
	//echo $amount111;
	//die('-------');
	}}?>
	
	<?php  
	$module = "training";
	 $w= new _orderSuccess;
	 $res= $w->readid($_SESSION['uid'],$module); 
	 //var_dump($res);
	 if($res!=false){ 
	//$amount=0;
	while($ra=mysqli_fetch_assoc($res)){
	//print_r($ra);
	
	$amount222+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount222==0)
	{
$amount222=0;
	}
	}
	//echo $amount2;
	
	 }
	 $amount333 = ($amount111 - $amount222);
	//echo $amount3.'======';
	 
	?>









<div class="col-md-4">
<div class="panel">
				   <div class="panel-heading bbb" style="background-color:#f3a0a0">
                            <h3 class="panel-title"><img src="img1.png" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
  <div class="panel-body border-realestate" style="padding-top:30px">
			 <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($amount111 > 0 ){ echo $currency.' '.$amount111; }else{ echo $currency.' '."0" ; } ?></h3>
        <p>Training Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($amount111 > 0 ){ echo $currency.' '.$amount111; }else{ echo $currency.' '."0" ; } ?></b></p>
        <p>Withdraw: <b><?php //echo $amount6;?><?php $amut=0;  if($amount222){  echo $currency.' '.$amount222; } else { echo $currency.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount7;?><?php if($amount333) {echo $currency.' '.$amount333; } else {  echo $currency.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i> 
  </div>
  </div>
  </div>
   <div class="panel-footer bbb tr">
  <a href="<?php echo $BaseUrl.'/dashboard/finance/trainingwallet.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >TRAININGS</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="panel">
				   <div class="panel-heading bbb2" style="background-color:#07bfc3">
                            <h3 class="panel-title"><img src="img1.png" class="img-responsive"></h3>
                        </div>
    <!-- small box -->
    <?php 
 $objpoint = new _spPoints;
 $result=$objpoint->readpoint_all($_SESSION['uid']);
 //echo $_SESSION['pid'].'====55';
 //print_r($result);die('==');
 if($result !=false){ 
   $i=1;
   $total=0;
   $total1=0;
 while($row222=mysqli_fetch_assoc($result)){
   $amount=$row222['pointAmount']/100;


   $total=$total+$row222['pointAmount'];
   $total1=$total1+$amount;
 }
}



$amount22=0;
$total55=0;
$am99 = new _spprofiles;
$reash99 = $am99->shan_am99($_SESSION['uid']);
if($reash99){
while($reash00 = mysqli_fetch_assoc($reash99)){
$withdraw_amount = $reash00['withdraw_amount'];
$amount22=$amount22 + $withdraw_amount;
}
$total55=$total1-$amount22;
}
?>
  <div class="panel-body border-realestate" style="padding-top:30px">
			 <div class="small-box bg_events">
        <div class="inner">
            <h3><?php  if($total1 > 0 ){ echo 'USD'.' '.$total1; }else{ echo 'USD'.' '."0" ; } ?></h3>
        <p>SpPoints Total Earning </p>
    </div>
    <div class="summary">                              
        <p>Earnings: <b><?php  if($total1 > 0 ){ echo 'USD'.' '.$total1; }else{ echo 'USD'.' '."0" ; } ?></b></p>
        <p>Withdraw: <b><?php //echo $amount6;?><?php $amut=0;  if($amount22){  echo 'USD'.' '.$amount22; } else { echo 'USD'.' '.$amut;} ?></b></p>
        <p>Balance: <b><?php //echo $amount7;?><?php if($total55) {echo 'USD'.' '.$total55; } else {  echo 'USD'.' '.'0'; }?></b></p>
    </div>
    <div class="icon">
      <i class="fa fa-dollar"></i> 
  </div>
  </div>
  </div>
   <div class="panel-footer bbb tr2">
  <a href="<?php echo $BaseUrl.'/dashboard/sppoint/index.php';?>" class="small-box-footer" style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px; font-size: 20px; font-weight: bolder; text-transform: uppercase;" >SPPOINTS</a>
</div>
</div>
</div>










</div>

<!--<a href="<?php echo $BaseUrl; ?>/dashboard/finance/verifywithdraw.php" class="btn btn-info btn-lg mynewModalclass" style="float:right;">Withdraw Amount11</a> -->














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