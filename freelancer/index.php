<?php 
include('../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "freelancer/";    
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$f = new _spprofiles;
$re = new _redirect;

//check profile is freelancer or not
$chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
if($chekIsFreelancer == false){
$redirctUrl = $BaseUrl . "/my-profile/";
$_SESSION['count'] = 0;
$_SESSION['msg'] = " Only Freelancer and Business profiles can access this module. All other profiles can only see but not able to do anything ";
$re->redirect($redirctUrl);
}else{



?> 
<style>


#search1{
width: 75% !important;

}
#but1{
margin-top:-36px !important;
margin-right: -15px;
}
#car1{
margin-top:9px!important;

}

.dropdown-menu > li > a{
color:#52565d !important;
}
.how-itworks .how-itworks-content {
height: 250px;
}
#profileDropDown li.active {
background-color: #c45508 ! important;
}
#profileDropDown li.active a {
color: white !important;
}

.b2 {

position: inherit!important;
}
.caret
{
margin-top: 9px!important;
}
button#indent {
padding: 9px;
}
</style>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/f_links.php');?>


<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


<!-- owl carousel -->


<link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/percentage.css">

<!-- responsive tabs -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/easy-responsive-tabs.css">
<link href="<?php echo $BaseUrl;?>/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css">



<script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/js/easy-responsive-tabs.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/js/dropzone.min.js"></script>
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/dropzone.min.css">
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 7,
nav: false
}
}
});
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
});

</script>
<style>
.mt-40{
margin-bottom:50px;
}
.caret {
margin-top: 9px!important;
}

.our-clients .freelancerthansk{
padding: 13px 70px;
}
.our-clients .carousel-control-prev{width: 60px;}
.our-clients .carousel-control-next{top: 0px;
width: 60px;}
p.freelancername {
margin-left: 70px;
}
p.freelancerdesignation {
margin-left: 70px;
}
</style>

<?php 
$urlCustomCss = $BaseUrl.'/component/custom.css.php';

include $urlCustomCss;
?>  

</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../header.php");
?>

<section class="main_box" id="freelancers-page">
<div class="col-xs-12 freelancer_banner text-center">
<h1 class="find_freelancer">Find the top <span>freelancers</span> Globally</h1>
<?php


if($_SESSION['ptid']){


?>
<style>
#notification_count {
margin-top: -29px!important;
}



</style>
    <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
      <div class="modal-content no-radius">

       <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
         <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
           <h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business, Professional"</span> modules can sell property.</h2>
            <div class="space-md"></div>
             <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
              <a href="<?php echo $BaseUrl . '/freelancer'; ?>" class="btn">Back to Home</a>
             </div>
           </div>
        </div>
    </div>
<?php if ($_SESSION['ptid'] != 1 && $_SESSION['ptid'] != 3) { ?>
<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn post-project postproject">Post a project - It’s Free</a><?php
}else { ?>
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn post-project postproject">Post a project - It’s Free</a>
<?php
}

}else{ ?>
<!-- Modal -->
<div id="Notabussiness" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content no-radius sharestorepos bradius-10">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body nobusinessProfile">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Please switch to your bussiness profile 555to <span>post project.</span></h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button> 
</div> 
</div>

</div>
</div>
<!-- <a href="" class="btn post-project postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a>--><?php
}
?>

<p class="looking-for-freelancer">Looking for freelance work? - Review our benefits and apply for a profile</p>
</div>
<div class="col-xs-12 search-freelancer">
<div class="container">
<div class="searchbar col-xs-12 mt-40 bradius-10">
<form class="col-xs-12" method="post" action="search.php" >
<div class="form-group">

<input class="form-control  searchborder" name="txtSearchProject" placeholder="Search a project" id="search1" type="text" required="" />
<input class="btn search-freelancer-btn searchborder" value="Search" name="btnSearchProject" id="but1" type="submit">
</div>
</form>
<div class="col-xs-12 col-sm-10">
<ul class="dashboardlink">

<li><a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>">Browse all projects</a></li>
<li><span>|</span></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>">Browse all freelancer</a></li>

<li><span>|</span></li>
<?php
if($_SESSION['ptid'] == 1){ 
?>
<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>">My Dashboard</a></li>
<?php
}else{

?>

<li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>">My Dashboard</a></li>


<?php

}

?>



</ul>





</div>
</div>
<!--<div class="col-xs-12">
-->
<?php

$result_count = $f->freelancers($_SESSION['uid']);
$total_frelance = $result_count->num_rows;
?>



</div>

</div>
</div>
<?php include('btm-category.php'); ?>
<div class="col-xs-12 how-itworks">
<div class="container">
<h2>How it <span>works</span></h2>
<div class="col-xs-12 col-sm-3">
<div class="how-itworks-content br-15-overflow">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/find.png" class="img-responsive center-block">
<p class="how-itworks-name">Post a Project</p>
<p class="how-itworks-description pb-34">
Post a short term project that will be visible to anyone around the world . 
</p>
</div>
</div>
<div class="col-xs-12 col-sm-3 ">
<div class="how-itworks-content br-15-overflow">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/hire.png" class="img-responsive center-block">
<p class="how-itworks-name">BId on a Project</p>
<p class="how-itworks-description pb-34">
Freelancers start placing their bids on your project .
</p>
</div>
</div>
<div class="col-xs-12 col-sm-3 ">
<div class="how-itworks-content br-15-overflow">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/work.png" class="img-responsive center-block">
<p class="how-itworks-name">Chat</p>
<p class="how-itworks-description pb-34">
Discuss the project with the freelancers .
</p>
</div>
</div>
<div class="col-xs-12 col-sm-3 ">
<div class="how-itworks-content br-15-overflow">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/pay.png" class="img-responsive center-block">
<p class="how-itworks-name">Hire</p>
<p class="how-itworks-description">
Hire a freelancer for your project. You will only pay when the project is completed and you are satisfied! 
</p>
</div>
</div>
</div>
</div>
<div class="col-xs-12 our-clients">
<div class="container">
<h2 class="our-clients-heading">Hear what our <span>clients</span> have to say</h2>
<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
<!-- Carousel indicators -->
<ol class="carousel-indicators">
<li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
<li data-target="#fade-quote-carousel" data-slide-to="1"></li>
<li data-target="#fade-quote-carousel" data-slide-to="2"></li>
</ol>
<!-- Carousel items -->
<div class="carousel-inner">
<div class="item">
<div class="col-xs-12 col-sm-3">
<div class="profile-circle">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
</div>
<div style="margin-left: -20px;margin-top:10px;">
<p class="freelancername">Bev Flaxington</p>
<p class="freelancerdesignation">CEO of Innovative</p>
</div>
</div>
<div class="col-xs-12 col-sm-9">
<div>
<p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
<a data-slide="prev" href="#quote-carousel" class="carousel-control-prev">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/left-comas.png" class="img-responsive">
</a>
<a data-slide="next" href="#quote-carousel" class="carousel-control-next">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/right-comas.png" class="img-responsive">
</a>
</div>

</div>       
</div>
<div class="item">
<div class="col-xs-12 col-sm-3">
<div class="profile-circle">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
</div>
<div style="margin-left: -20px;margin-top:10px;">
<p class="freelancername">Bev Flaxington</p>
<p class="freelancerdesignation">CEO of Innovative</p>

</div>
</div>
<div class="col-xs-12 col-sm-9">
<div>
<p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
<a data-slide="prev" href="#quote-carousel" class="carousel-control-prev">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/left-comas.png" class="img-responsive">
</a>
<a data-slide="next" href="#quote-carousel" class="carousel-control-next">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/right-comas.png" class="img-responsive">
</a>
</div>

</div>
</div>
<div class="active item">
<div class="col-xs-12 col-sm-3">
<div class="profile-circle">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
</div>
<div style="margin-left: -20px;margin-top:10px;">
<p class="freelancername">Bev Flaxington</p>
<p class="freelancerdesignation">CEO of Innovative</p>
</div>
</div>
<div class="col-xs-12 col-sm-9">
<div>
<p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
<a data-slide="prev" href="#quote-carousel" class="carousel-control-prev">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/left-comas.png" class="img-responsive">
</a>
<a data-slide="next" href="#quote-carousel" class="carousel-control-next">
<img src="<?php echo $BaseUrl;?>/assets/images/freelancer/right-comas.png" class="img-responsive">
</a>
</div>

</div>
</div>
</div>
<!-- Carousel Buttons Next/Prev -->

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
}
}
?>
