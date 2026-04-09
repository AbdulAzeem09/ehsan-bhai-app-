<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
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

$_GET["categoryid"] = "1";
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

$activePage = 1;
//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>

<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-posmenu.php'); 

$p = new _pos;
$curr=$p->currency($_SESSION['uid']);
if($curr!=false){
	$c=mysqli_fetch_assoc($curr);
	$currency=$c['currency'];
	
}
?>
</div>
</div>

<label for="">Create Membership</label>
<div class="col-md-9 bg_white" style="padding-bottom: 15px; margin-top: 10px; margin-left: 10px;">
	


<form action="add_cust_detail.php" method="POST"   >  

<input type="hidden" name="currency" value="<?php echo $currency; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">


<div class="form-group">
<div class="col-md-6">
<label class="add_shippinglabel" for="shipp_username">Select type:<span class="red"></span></label>
<select id="qty" class="form-control" name="qty">
    <option  value="0">Qty</option>
    
  </select><span id="shippname_error" style="color:red;"></span>
  </div>
<div class="col-md-6">
<label class="add_shippinglabel" for="shipp_username">Select Customer:<span class="red"></span></label>

<select id="cust_name" class="form-control" name="cust_name">
<option  value="0">Select Option</option>
<?php
$p=new _spgroup;

 $v=$p->read_name($_SESSION['uid']);
 //print_r($v);
//die('==');
while($dt=mysqli_fetch_assoc($v)){
//print_r($dt);
//die('==');
?>

    <option  value="<?php echo $dt['id '];?>"><?php echo $dt['customer_name'];?></option>
	
<?php } ?>
    
  </select><span id="shippname_error" style="color:red;"></span>
  </div>
  
</div>
<p>Add varieties of Membership by quantity</p>
<div class="row form-group">
<div class="col-md-4">
<label for="spUserEmail" class="control-label">Type Name: </label>
<input type="text" class="form-control" id="name" name="name">
</div>
<div class="col-md-4">
<label for="spUserEmail" class="control-label">Type Quantity: </label>
<input type="text" class="form-control" id="quantity" name="quantity">
</div>
<div class="col-md-4">
<label for="spUserEmail" class="control-label">Type Price: </label>
<input type="text" class="form-control" id="price" name="price">
</div>


</div>




<div class="form-group">        
<div class="">
<button type="submit" name="btn" class="btn btn-default Add_adderess">Add Membership</button>  
</div>
</div>

</form>

</div>

</div>
</div>
</section>










<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
// <!-- ========DASHBOARD FOOTER CHARTS====== -->
include('../../component/dash_btm_script.php');
?>
</body>
</html>
<?php
}
?>