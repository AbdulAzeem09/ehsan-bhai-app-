<?php

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){   
include_once ("../../authentication/check.php");
$_SESSION['afterlogin']="post-ad/sell/";
}
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  $_SESSION['afterMembership']="/post-ad/real-estate/posting.php?postid=".$_GET['postid'];
  header('location:'.$BaseUrl.'/membership/dash_index.php');
}

$_GET["module"] = "1";
$_GET["categoryid"]="1";
$_GET["profiletype"]="1";
$_GET["categoryname"]="Sell";

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if($res != false){
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"]; 
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"]; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">



<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">

<title>The SharePage.</title>
<!--Bootstrap core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/tsp_trans.png'?>" sizes="16x16" type="image/png">



<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

<!-- skills added typehead -->
<link href="<?php echo $BaseUrl;?>/assets/css/token_field/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
<link href="<?php echo $BaseUrl;?>/assets/css/token_field/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">

<?php 
$urlCustomCss = $BaseUrl.'/component/custom.css.php';
include $urlCustomCss;
?>
<!-- Design.css -->

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>
<body onload="pageOnload('post')" class="bg_gray">
<?php 

$header_jobBoard = "header_jobBoard";
include_once("../../header.php");
$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$res = $p->readprofilepic(1,$_SESSION['uid']);
if ($res != false){
$r = mysqli_fetch_assoc($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];
}

?>

<div class="loadbox" >
<div class="loader"></div>
</div>
<section class="landing_page" style="min-height: 650px;">
<div class="container">
<div class="row">
<div class="col-md-9">
<div class="row">
<div class="col-md-12">
<div class="about_banner about_postbanner">
<div class="top_heading_group jobHead postbannerheading">
<div class="row">
<div class="col-md-6">
<h3>What would like to do now?</h3>
</div>
</div>
</div>
<div class="event_form">
<div class="row">
<div class="col-md-4">
<?php if($_GET['postType'] == 'Sell'){?>
<a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?catid=1&postid='.$_GET['postid'];?>">
<div class="postBoxThree about_postbanner">
<i class="fa fa-info-circle"></i>
<p class="postparagraph">View the property</p>
</div>
</a>
<?php }else{ ?>
<a href="<?php echo $BaseUrl.'/real-estate/room-detail.php?postid='.$_GET['postid'];?>">
<div class="postBoxThree about_postbanner">
<i class="fa fa-info-circle"></i>
<p class="postparagraph">View the property</p>
</div>
</a>
<?php }?>
</div>
<div class="col-md-4">
<a href="<?php echo $BaseUrl.'/post-ad/real-estate/?post';?>">
<div class="postBoxThree about_postbanner">
<i class="fa fa-plus-square"></i>
<p class="postparagraph">Post another property</p>
</div>
</a>
</div>
<div class="col-md-4">
<a href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>">
<div class="postBoxThree about_postbanner">
<i class="fa fa-dashboard"></i>
<p class="postparagraph"> Go to dashboard</p>
</div>
</a>
</div>


</div>
</div>
</div>
</div>
</div>



</div>
<div class="col-md-3">
<div class="postJob" id="postJobBoard">
<div class="col-xs-12 nopadding its-free-post-job about_postbanner">
<h2 class="heading postbannerheading">It’s Free to Post a Product</h2>
<div class="col-xs-12 content">
<div class="col-xs-2 nopadding"><i class="fa fa-check">&nbsp;</i></div>
<div class="col-xs-10 nopadding"><p class="content-p">Simply tell us what you need to have done.</p></div>
<div class="col-xs-2 nopadding"><i class="fa fa-check">&nbsp;</i></div>
<div class="col-xs-10 nopadding"><p class="content-p">Open your job to all freelancers or privately hand-pick them.</p></div>
<div class="col-xs-2 nopadding"><i class="fa fa-check">&nbsp;</i></div>
<div class="col-xs-10 nopadding"><p class="content-p">Watch quotes roll in, typically within 24 hours.</p></div>

</div>
</div>
</div>
</div>
</div>


</div>
</section>
<?php include('../../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/btm_script.php'); ?>
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
$(".form_datetime2").datetimepicker({
format: "dd MM yyyy - hh:ii P",
autoclose: true,
todayBtn: true,
pickerPosition: "bottom-left"
});

$('.form_datetime').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
forceParse: 0,
minView: 2,
});

$('.form_time_3').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 1,
forceParse: 0,
showMeridian: 1
});
</script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/bootstrap-tokenfield.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/affix.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/typeahead.bundle.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/docs.min.js" charset="UTF-8"></script>
</body>
</html>
