<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 74;      
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}

</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../component/left-dashboard.php');
?>
</div>

<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->



<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}				
	

</style>


<?php

$p = new _spPoints;



$result = $p->editdata($id);

$row=mysqli_fetch_assoc($result);

print_r($row);


   



?>



<div class="content">
<div class="col-md-12 ">

<div class="container bg-white p-5">



<form action="" method="post">
  
<div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" name= "fname" class="form-control" id="exampleInputEmail1">
    
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text"  name= "lname"class="form-control" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary" name="submit1">Update</button>
</form>









</div>
</div>
</div>




<div class="container">








    



</div>





</div>
</div>
</div>





</div>
</section>


<?php include('../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->




















</body> 
</html>
<?php
} ?>





