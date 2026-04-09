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
	


<form action="add_membership_detail.php" method="post" enctype="multipart/form-data" class="" >  

<input type="hidden" name="currency" value="<?php echo $currency; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

<div class="form-group">
<label class="add_shippinglabel" for="shipp_username">Select type:<span class="red"></span></label>
<select id="type" class="form-control" name="type">
    <option  value="0">Select Option</option>
    <option  value="1">a </option>
    <option  value="2"> b</option>
    <option  value="3"> c</option>
    
  </select><span id="shippname_error" style="color:red;"></span>
  </div>

<div class="form-group">
<label class="add_shippinglabel" for="shipp_username">Membership Name:<span class="red"></span></label>

<input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)||(event.charCode==32)"  id="shipp_username"  name="fullname"> 
<span id="shippname_error" style="color:red;"></span>
</div>

<div class="form-group"><?php //echo $currency;?>
<label class="add_shippinglabel" for="shipp_address">Membership Price :<span class="red"></span></label>
<input type="text" class="form-control" id="price" 
name="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
<span id="shippaddress_error" style="color:red;"></span>
</div>


<div class="form-group">
<label for="spUserEmail" class="control-label">Membership quantity: <span class="red"></span>


</label>
<input type="text" class="form-control" id="duration" 
name="quantity"  >

</div>


<div class="form-group">
<label class="add_shippinglabel" for="shipp_zipcode">Membership Status:<span class="red"></span></label><br>
<input type="radio"  name="status" value="1">&nbsp;&nbsp;Active<br>
<input type="radio"  name="status" value="0">&nbsp;&nbsp;Inactive
<span id="shippzipcode_error" style="color:red;"></span>
</div>

<!--<div class="form-group">
<label class="add_shippinglabel" for="respUserEphone">Phone Number:<span class="red"></span></label>

<input type="text" class="form-control"  id="respUserEphone" placeholder="
Enter phone number" name="phone">
<span id="shippphone_error" style="color:red;"></span>

</div>

<div class="form-group">
<label for="yourName" class="control-label contact">Primary Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row[2])) {echo "disabled";  }?> />

</div>

<div class="form-group">
<label for="yourName" class="control-label contact">Secondary Photo<span class="red"></span><span style="font-size: 12px;"> </span></label>
<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity1" id="uploadidentity1"  <?php if (!empty($row[2])) {echo "disabled";  }?> />

</div>-->
<div class="form-group">        
<div class="">
<button type="submit" class="btn btn-default Add_adderess">Add Membership</button>  
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