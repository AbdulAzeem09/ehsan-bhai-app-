<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../univ/baseurl.php");
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 57;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../component/f_links.php'); ?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
section.content-header {
margin-top: -10px;
padding-left: 30px;
margin-bottom: -5px;
}

ol.breadcrumb {
margin-right: 25px;
}
</style>
</head>

<body class="bg_gray">
<?php

include_once("../header.php");

?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">

<h1>Create Event</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Create Event</li>
</ol>
</section>



<div class="content">
<?php
if ($_GET['created'] == 1) {
?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success!</strong> Event Created Successfully.
</div>
<?php
}
?>
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">


<div class="container col-md-12">
<form method="post" action="createEventInsert.php">
<div class="row">


<div class="col-md-6">
<div class="form-group">
<label for="Event_title" class="control-label">Event Title</label>
<input required type="text" class="form-control" name="event_title" id="Event_title" value="">

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="location" class="control-label">Location</label>
<input required type="text" class="form-control" name="location" id="location" value="">

</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label for="Description" class="control-label">Description</label>
<textarea class="form-control" name="description" id="Description"> </textarea>

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="start_date" class="control-label">Start date and time</label>
<input required type="datetime-local" class="form-control" name="start_date" id="start_date" value="">

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="end_date" class="control-label">End date and time</label>
<input required type="datetime-local" class="form-control" name="end_date" id="end_date" value="">

</div>
</div>
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid']; ?>">
<input type="hidden" id="pid" name="pid" value="<?php echo $_SESSION['pid']; ?>">




<div class="row">
<div class="col-md-12">
<div class="col-md-12">
	<label for="Reminder1" class="control-label">Reminder1 (Before in Minutes) ? </label> 
<input type="radio" name="yes1" id="yes_Reminder1" value="1"><label for="yes_Reminder1" style="margin-left: 5px;">Yes</label>
&nbsp&nbsp&nbsp;
<input type="radio" name="yes1" id="no_Reminder1" value="0"><label for="no_Reminder1" style="margin-left: 5px;">No</label>

<div class="form-group" >

<span id="first_reminder" style="display:none;">  
<textarea type="number" class="form-control"  name="reminder" id="Reminder1" value=""></textarea> 
</span >
</div>
</div>

<div class="col-md-12">  
	<label for="email_reminder1" class="control-label">Email1 Reminder (Give in Days) ? </label>
<input type="radio" name="yes2" id="yes_email1" value="1"><label for="yes_email1" style="margin-left: 5px;">Yes</label>
&nbsp&nbsp&nbsp;
<input type="radio" name="yes2" id="no_email1" value="0"><label for="no_email1" style="margin-left: 5px;">No</label>

<div class="form-group" >

<span id="first_email" style="display:none;" >
<textarea type="number" class="form-control" name="email_reminder" id="email_reminder1" value=""></textarea>  
</span>
</div>
</div>
</div>
</div>
<!--		
<div class="row">
<div class="col-md-12">		
<div class="col-md-6">
<input type="radio" name="yes3" id="yes_Reminder2" value="1" >Yes
<input type="radio" name="yes3" id="no_Reminder2" value="0" >No

<div class="form-group" id="second_reminder">
<label for="Reminder2" class="control-label">Reminder2 (Before in Minutes)</label>
<input type="number" class="form-control" name="reminder2" id="Reminder2" value="" >

</div>
</div>

<div class="col-md-6">
<input type="radio" name="yes4" id="yes_email2" value="1">Yes
<input type="radio" name="yes4" id="no_email2" value="0" >No

<div class="form-group" id="second_email">
<label for="email_reminder2" class="control-label">Email Reminder2 (Give in Days)</label>
<input type="number" class="form-control" name="email_reminder2" id="email_reminder2" value="" >

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">		
<div class="col-md-6">
<input type="radio" name="yes5" id="yes_Reminder3" value="1">Yes
<input type="radio" name="yes5" id="no_Reminder3" value="0" >No

<div class="form-group" id="third_reminder">
<label for="Reminder3" class="control-label">Reminder3 (Before in Minutes)</label>
<input type="number" class="form-control" name="reminder3" id="Reminder3" value="" >

</div>
</div>

<div class="col-md-6">
<input type="radio" name="yes6" id="yes_email3" value="1">Yes
<input type="radio" name="yes6" id="no_email3" value="0" >No

<div class="form-group" id="third_email">
<label for="email_reminder3" class="control-label">Email Reminder3 (Give in Days)</label>
<input type="number" class="form-control" name="email_reminder3" id="email_reminder3" value="" >

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">		
<div class="col-md-6">
<input type="radio" name="yes7" id="yes_Reminder4" value="1" >Yes
<input type="radio" name="yes7" id="no_Reminder4" value="0" >No

<div class="form-group" id="foutrh_reminder">
<label for="Reminder4" class="control-label">Reminder4 (Before in Minutes)</label>
<input type="number" class="form-control" name="reminder4" id="Reminder4" value="" >

</div>
</div>

<div class="col-md-6">
<input type="radio" name="yes8" id="yes_email4" value="1">Yes
<input type="radio" name="yes8" id="no_email4" value="0">No

<div class="form-group" id="fourth_email">
<label for="email_reminder4" class="control-label">Email Reminder4 (Give in Days)</label>
<input type="number" class="form-control" name="email_reminder4" id="email_reminder4" value="" >

</div>
</div>
</div>
</div>-->

<div class="col-md-6">
<div class="form-group">
<button type="submit" style="margin-bottom:25px" id="apiDetail" class="btn btn-submit db_btn db_primarybtn">Submit</button>
</div>
</div>
</div>
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



<?php include('../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>
<script>
$(document).ready(function() {
$("#yes_Reminder1").click(function() {

$("#first_reminder").show();

});
$("#no_Reminder1").click(function() {
$("#first_reminder").hide();
});

$("#yes_email1").click(function() {
$("#first_email").show();

});
$("#no_email1").click(function() {
$("#first_email").hide();
});

/*
$("#yes_Reminder2").click(function(){
$("#second_reminder").show();

});
$("#no_Reminder2").click(function(){
$("#second_reminder").hide();
});	

$("#yes_email2").click(function(){
$("#second_email").show();

});
$("#no_email2").click(function(){
$("#second_email").hide();
});



$("#yes_Reminder3").click(function(){
$("#third_reminder").show();

});
$("#no_Reminder3").click(function(){
$("#third_reminder").hide();
});	

$("#yes_email3").click(function(){
$("#third_email").show();

});
$("#no_email3").click(function(){
$("#third_email").hide();
});


$("#yes_Reminder4").click(function(){
$("#foutrh_reminder").show();

});
$("#no_Reminder4").click(function(){
$("#foutrh_reminder").hide();
});	

$("#yes_email4").click(function(){
$("#fourth_email").show();

});
$("#no_email4").click(function(){
$("#fourth_email").hide();
});*/

});
</script>



</body>

</html>
<?php
} ?>