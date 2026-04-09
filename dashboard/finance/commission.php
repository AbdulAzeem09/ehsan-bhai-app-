<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

    include('../../univ/baseurl.php');
    session_start();
	//print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin'] = "dashboard/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
	 
    
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
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        
		   <style type="text/css">


body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}

            .bg-store {
    background: #8cf6ba;
}

           .bg-freelance {
    background: rgba(255,215,190);
}
            .bg_jobboard{
                background-color: <?php echo $jobboard_clr; ?>;
            }
            .bg_realestate{
                background-color: <?php echo $realEstate_clr; ?>;
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
			.tagLine-max-char {
	
	font-size: smaller;
	font-weight: 600;

	}
	.panel-footer > a {
                color: #000;
                text-transform: uppercase;
                text-decoration: none;
                padding: 10px 10px;
                font-size: 20px;
                font-weight: bolder;
            }
	.bg-event {
    background: #ff8ab8;
}
.panel-body {

    border-radius: 25px 25px 0 0;
    border: 1px solid;
    box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
}
.border-event {
    border-color: #ff8ab8;
}
.panel-footer {

    box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
    border-radius: 0 0 25px 25px;
    text-align: center;
}
.border-freelance {
    border-color: rgba(255,215,190);
}
.border-store {
    border-color: rgb(140,246,186); 
}
 
.bg_events:hover{color:#000}
.rightContent{
	background-color:#fff; 
}
        </style>
		<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
       // $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                  <div class="col-md-2 no_pad_right">
                        <?php include('../../component/left-dashboard.php'); ?>

                    </div>
                    <div class="col-md-10 no_pad_left">                        
                        

                        <?php 
                      //  $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');                       
                        ?>
                        
                        <div class="row">

                                    <div class="col-md-12">
                                          <ul class="breadcrumb" style="background-color: #fff;">
                                      <!--<li><a href="<?php //echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>-->
                                      	
					<div class="row text-center">
                                            <h2>My Earnings - Commission Module</h2>
												</div>
                                    <!-- <li><a href="#">Summer 15</a></li>
                                      <li>Italy</li> -->
                                    </ul>
                            <!--    <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php //echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php //echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php //echo $BaseUrl.'/store/dashboard/';?>" class="<?php //echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div> -->
	<span style="font-size:13px;margin-left:20px;"><a  href="<?php echo $BaseUrl.'/dashboard/finance/finance.php'; ?>"><i class="fa fa-arrow-left"></i> Return to My Finance Homepage</a></span>
								</div>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
}
#example_filter{
	    margin-bottom: 5px;
    margin-right: 5px;
	
}

.tbl_store_setting thead {
    background-color: #3e2048;
    color: #fff;
}
.panel{
	
	border-radius: 30px;
}
</style>
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


    $result2=$mb->ashish($_SESSION['uid']);
    $total_withdrwal = 0;
  if($result2){
        while($row=mysqli_fetch_assoc($result2)){

         $total_withdrwal =$total_withdrwal + $row['withdraw_amount'];
}
  }

  $total3=$total-$total_withdrwal;


  
















 ?>








<?php  
	
	//echo $_SESSION['uid'];die;
	$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet_bonus($_SESSION['uid']);
//echo $_SESSION['uid'];
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount1+=$r['amount'];
	
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
	
	$amount2+=$ra['amount'];
	//$dated = $ra['date'];
	//echo $dated;
	if($amount2==0)
	{
$amount2=0;
	}
	}
	//echo $amount2;
	 $amount3 = ($amount1 - $amount2);
	 }
	
	//echo $amount3.'======';
	 
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
	
	<br>
	<div class="row">
	  <div class="col-md-4">
					<div class="panel" style="margin-left:22px;">
					<div class="panel-body border-event">
					<div class="small-box bg_events">
					<div class="inner">
					<h3><?php  if($total > 0 ){ echo 'USD'.' '.round($total,2); }else{ echo 'USD'.' '.'0' ; } ?></h3>
					</div>

					<div class="icon">
					<i class="fa fa-dollar"></i>
					</div>
					</div>
					</div>
					<div class="panel-footer bg-event">
					<a>Lifetime Sale </a>
					</div>
					</div>
					</div>
	 
	
   
	
	  <div class="col-md-4" style="margin-left: -16px;">
                        <div class="panel" style="margin-left:22px;">
                            <div class="panel-body border-freelance">
                                <div class="small-box bg_events">
                                    <div class="inner">
                                        <h3><?php $amut=0;  if($total_withdrwal){  echo 'USD'.' '.round($total_withdrwal,2); } else { echo 'USD'.' '.$amut;} ?></h3>
                                    </div>

                                    <div class="icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer bg-freelance">
                                <a>Total Withdrawal </a>
                            </div>
                        </div>
                    </div>
	 
	 <div class="col-md-4" style="margin-left:-10px;">
                        <div class="panel" style="margin-left:22px;">
                            <div class="panel-body border-store">
                                <div class="small-box bg_events">
                                    <div class="inner">
                                        <h3><?php  if($total3) {echo 'USD'.' '.
                                        round($total3,2); } else {  echo 'USD'.' '.'0'; }
	
	?></h3>
                                    </div>

                                    <div class="icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer bg-store">
                                <a>Total Amount left</a>
                            </div>
                        </div>
                    </div>
	 
	 
	 </div>


<?php  $p = new _spuser;
	$p1=$p->read_bonus_uid($_SESSION['uid']);
	if($p1!=false){
$table="example";
	}else{
	$table='';
	}
	?>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="container-fluid">
      <div class="header_wrap">
        <div class="num_rows">
		
				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 
						 
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="30">30</option>
						 <option value="40">40</option>
						 <option value="50">50</option>
            <option value="100">Show ALL Rows</option>
						</select>
			 		
			  	</div>
        </div>
        <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
      </div>


								
              <div class="col-md-12" style="margin-left: 10px;padding-right: 35px;">
							
                                <div class="">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-class" id= "table-id">
                                    <!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- 
<th></th>          
<th>Id</th> -->
<th>User Name</th>
<!--<th>Currency</th>-->
<th>Sale Amount</th>
<th> My Commission Amount</th>
<th> SpCommission Amount</th>
<th>Module</th>
<th>Sale Type</th>
<th>Date</th>
</tr>
</thead>
<tbody>

<?php


$mb = new _spmembership;
$u = new _spuser;

if(isset($_POST['filtersubmit']))
{
	$startdate=$_POST['date1'];
	$enddate=$_POST['date2'];

	$result=$mb->readcommission_filter($_SESSION['uid'],$startdate,$enddate);
}
else{

$result=$mb->readcommission($_SESSION['uid']);
}
$total=0;
if($result !=false){ 
$i=1;
while($row=mysqli_fetch_assoc($result)){
//$row['purchaser_user'];
$rr=$u->read_name($row['purchaser_user_id']);
if($rr){
$row1=mysqli_fetch_assoc($rr);
}
 $int1=$row['spuser_commission'];
 $total=$total+$int1;
//die('======1111');
 


?>
<tr>
<!-- <td>
</td>
<td></?php echo $i; ?></td> -->
<td><?php  echo $row1['spUserName']; ?></td>
<!--<td  style="text-align: center;"><?php  //echo $row['currency']; ?></td>-->
<td style="text-align: center;"><?php  echo $row['purcahse_amount']; ?></td>
<td style="text-align: center;"><?php echo round($row['spuser_commission'],2); ?></td>
<td style="text-align: center;"><?php echo round($row['spadmin_commission'],2); ?></td>
<td><?php  echo $row['module']; ?></td>
<td><?php  echo $row['sale_type']; ?></td>

<td><?php  echo $row['date']; ?></td>

</tr>

<?php

$i++;
}
}

?>
</tbody>
</table>
<!--		Start Pagination -->
<div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>

</div> <!-- 		End of Container -->
<?php  
    $mb = new _spmembership;

 date_default_timezone_set("Asia/Bangkok");
 $date = date('m-d-Y');
 if(isset($_POST['total_submit'])){
    $amount=$_POST['amount'];
    $arr=array(
  "pid"=>$_SESSION['pid'],
  "uid"=>$_SESSION['uid'],
  "withdraw_amount"=>$amount,
  "status"=>'0',
  "requested_date"=>$date 

    );

    $result1=$mb->withraw_com($arr);
    //print_r($result);
    //die('==========');
    
 
 }
?>

<form action="" method="post">
<div class="col-md-8 form-group float-right">
    <div class="row">
    <div class="col-md-5">

</div>
<div class="col-md-5">
    <span style="font-weight: bold; font-size: 13px;"> Enter Amount To Withdraw</span>
<input type="number" class="form-control  text-center" name="amount" value=""
min="50"  max="<?php echo round($total3,2); ?>" required/>
</div>
<div class="col-md-2">
<button class="btn btn-primary btn-border-radius" name="total_submit" style="margin-top: 20px;">Withdraw</button></div>
</div></div>
</form>

                                    </div>
                                </div>
								 <?php 
									 if(isset($_POST['submit']))
									 {
								  
								   $apikey = '6ad1c2c05c818bb3475c';
//echo $curr;
$amount=$_POST['amount'];
$from_currency = $curr;
$to_currency='USD';
  //die('aaaaa');


  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  
  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey=6ad1c2c05c818bb3475c");
 
  //$json = file_get_contents("https://api.currconv.com/api/v7/convert?q=INR_CAD&compact=ultra&apiKey=6ad1c2c05c818bb3475c");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
   number_format($total, 2, '.', '');
								// print_r($_POST);
								 //
								 $uid=$_SESSION['uid'];
								 $pid=$_SESSION['pid'];
										 
				$arr=array("user_id"=>$uid,
				"userprofile_id"=>$pid,
				"amount"=>$_POST['amount'],
				"module"=>$_POST['bonus'],
				"spBankusername"=>$_POST['spBankusername'],
				"spBankname"=>$_POST['spBankname'],
				"spBanknumber"=>$_POST['spBanknumber'],
				"spBranchnumber"=>$_POST['spBranchnumber'],
				"spAccountnumber"=>$_POST['spAccountnumber'],
				"spBankcode"=>$_POST['spBankcode'],
				"date"=> date('Y-m-d H:i:s'),
				"converted_currency"=>$total
				
				);	
				
				
				$w= new _orderSuccess;
				$wa= $w->createwithdrawalstore($arr);
									 
									 }		 
										
										 ?>
								
								
		<?php
										 
										 $w= new _orderSuccess;
										 $module='bonus';
											$res1 = $w->readREstatus($_SESSION['uid'],$module);
											if($res1!= True){  ?>
											<?php } else{ 
												
												while($r2 = mysqli_fetch_assoc($res1)){
												//print_r($r2);
												$dated = $r2['date'];
												//echo $dated;
												}
												?>
											
						<div class="alert alert-warning" role="alert">
								You Already Request Withdraw on (date <?php echo $dated; ?>) Please wait !
							</div>
							
											<?php } ?>
											<?php 
$u = new _spuser; 

$p_result = $u->isPhoneVerify($_SESSION['uid']);

if ($p_result) { 

$w= new _orderSuccess;
$module = "bonus";						 
$res1 = $w->readREstatus($_SESSION['uid'],$module);
if($res1!= True){ 
?> 



<!-- <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#exampleModal" style="margin-right:35px;margin-bottom:5px;margin-left:5px;">
Withdraw Amount
</button> -->
 
		<?php }} ?>	
                            </div>
                        </div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
 <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example1').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Withdrawal Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="post">
      
	 <div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
	  
				<input type="hidden" name="bonus" value="bonus"> 
				<label for="spBankusername" class="control-label">Amount<span class="red">*</span></label>
	   <input class="form-control" type="number" min="50" max="<?php if($amount3) {echo $amount3; } else {  echo $amount1; }?>" placeholder="Minimum 50 - Maximum <?php if($amount3) {echo $amount3; } else {  echo $amount1; }?>" name="amount" required>
</div></div><br>	   
																	<?php
																		$uid = $_SESSION['uid'];
													$b = new _spbankdetail;
											$data = $b->read($uid);
													if($data!=false){
																		$row = mysqli_fetch_array( $data );
																		}
																		//print_r($row);	
													 					?>
																		
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
													<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $pid; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $uid;?>">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankuser" name="spBankusername" value="<?php echo $row['spBankusername'];?>" required>
<span id="spBankuser_error" style="color:red;"></span>
																		</div>
																	</div>
																	</div>
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
									<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname" name="spBankname" value="<?php echo $row['spBankname'];?>" required>
<span id="spBankname_error" style="color:red;"></span>
																		</div>
																	</div>
																</div>
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
											<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber" name="spBanknumber" value="<?php echo $row['spBanknumber'];?>" required>
<span id="spBanknumber_error" style="color:red;"></span>
																		</div>
																	</div>
																	</div>
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
																		<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber" name="spBranchnumber" value="<?php echo $row['spBranchnumber'];?>" required>
<span id="spBranchnumber_error" style="color:red;"></span>
																		</div>
																	</div>
																</div>
																
																
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
											<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" value="<?php echo $row['spAccountnumber'];?>" required>
<span id="spAccountnumber_error" style="color:red;"></span>
																		</div>
																	</div>
																	</div>
																	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
														<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode" name="spBankcode" value="<?php echo $row['spBankcode'];?>" required>
	<span id="spBankcode_error" style="color:red;"></span>
																		</div>
																	</div>
																	

																	</div>
															
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
		 </form>
      </div>
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




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>

getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>
