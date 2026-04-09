<?php

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 8;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-3">
<?php 
include('../component/left-jobboard.php');
if($_SESSION['ptid'] == 5){
include('left-btm-jobseakr.php');
}
?>
</div>
<div class="col-md-9 no-padding">
<?php 
include('top-job-search.php');
include('inner-breadcrumb.php');
?>

<div class="whiteboardmain">
<div class="row">
<div class="col-sm-12 notifyboard">
<p>Please enter one or more keywords that will help us fetch relevant result.</p>
</div>
<form class="job_search" method="post" action="search.php">
<div class="col-md-6">
<div class="form-group">
<input type="text" name="txtJobTitle" class="form-control"  placeholder="Job Title" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="txtJobCity" class="form-control"  placeholder="City" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="txtSalaryFrom" class="form-control"  placeholder="Salary From" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="txtSalaryTo" class="form-control"  placeholder="Salary To" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="txtJobLoc" class="form-control"  placeholder="Location" />
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<select class="form-control" name="txtJobLevel" >
<?php
$m = new _masterdetails;
$masterid = 2;
$result = $m->read($masterid);
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
}
}
?>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<button type="submit" name="btnJobSearch" class="btn btn-default">Search</button>
</div>
</div>
</form>
<div class="col-md-6">
<div class="" style="min-height: 300px;">
<img src="<?php echo $BaseUrl;?>/assets/images/jobboard/cartoon.png" class="img-responsive" />
</div>
</div>
</div>
</div>



</div>
</div>
</div>
</section>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
} ?>