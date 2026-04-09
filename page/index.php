<?php
session_start();
include("../univ/baseurl.php" );
include("../backofadmin/library/config.php");
include("../backofadmin/library/functions.php");
require_once('../common.php');
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if (isset($_GET['page']) && $_GET['page'] != '') {
$paget = str_replace('_', ' ', strtolower($_GET['page'])) ;

$m = new _spAllStoreForm;

$result = $m->readPageTitle($paget);
if ($result) {
$row = mysqli_fetch_assoc($result);
$pageTitle = $row['page_title'];
$pageDesc = $row['page_content'];
}else{
$pageTitle = "";
$pageDesc = "";
}
}else{
$pageTitle = "";
$pageDesc = "";
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<link rel="stylesheet" href="../assets/css/landingpage/style.css">
    <link rel="stylesheet" href="../assets/css/landingpage/all.css"> <!-- fontawesome icon -->
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../image/logosharepage 1.png">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/time-line.css">
    <script src="<?php echo $BaseUrl?>/assets/js/jquery_3.5.1/jquery.min.js"></script> 
<?php include('../component/f_links.php');?>   
<style>
p.MsoNormal {
text-transform: capitalize;
}
.navright {
text-decoration: none;
line-height: 13px;
width: 195px;
font-size: 14pt!important;
font-family: tahoma;
margin-top: 1px;
margin-right: -126px;
position: absolute;
top: 53px;
right: 273px;
color: white;
}
.navright1 {
text-decoration: none;
font-family: tahoma;
position: absolute;
color: white;
}
.time{background-color:#17ab56; padding:13px 29px; border-radius:4px;    margin-top: -26px;margin-right: -278px;}
.mytime:hover{background-color:#15974c!important;}	
.mytime{background-color:#17ab56!important; padding:13px 29px; border-radius:4px;margin-top: -56px;margin-right: -278px;}
	.mytime:hover{background-color:#15974c!important;}	
    .nav{ margin-top: -25px!important;}
	.collapse_ ul li a.navright { padding: 10px!important; }  
#timeline1:hover{background-color:#17924c!important;}
.headers {
    min-height: 0px;
}
</style>
<style>
.nav{ margin-top: 0px!important;}
.collapse_ ul li a.navright { padding: 10px!important; }  

</style>  
</head>

<body>
<header class="header inr-logo">
        <div class="container-fluid">
            <nav class="row">
                <div class="col-md-3 logo">
                    <a href="<?php echo $BaseUrl; ?>">
                    <img src="../image/logosharepage 1.png" alt="logo">
                    <span class="a">The SharePage</span>
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-lg-end">
                        <div id="slide-bar" >
                            <div id="toggle" class="d-flex"></div>
                        </div>
                        <ul id="sidebar" class="row menu">
                            <li><a href="<?php echo $BaseUrl;?>" class="active">Home</a></li>
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=investment_opportunities">Investment Opportunities</a></li> -->
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=referral__commissions">Earning Opportunities</a></li>
                            <li><a href="<?php echo $BaseUrl;?>/page/event.php?page=event">Event</a></li>
                            <li><a href="<?php echo $BaseUrl;?>/page/howtos.php?page=howtos">How To</a></li> -->
                            <?php if (isset($_SESSION['uid'])) { ?>
                                <li><a href="<?php echo $BaseUrl . '/timeline'; ?>"  class="timeline btn-border-radius">My Timeline</a></li>
                                <li><a href="<?php echo $BaseUrl . '/authentication/logout.php'; ?>"  class="timeline btn-border-radius">Log Out</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                </div>
                <!-- <div class="col-md-2 bar">
                    <div class="bar-1"></div>
                    <div class="bar-2"></div>
                    <div class="bar-3"></div>
                </div> -->
            </nav>
        </div>
    </header>
<header class="headers">
<div class="container">

<nav class="navbar navbar_" style="margin-top: 20px;">
    <div class="">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle navbartog" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
            </button>
            
            <a class="navbar-brand navbarbnrand" href="<?php echo $BaseUrl;?>"><img src="../image/logo.png" alt="The SharePage" class="img-responsive" style="width:218px;"></a>
        </div>
        
        <div class="collapse navbar-collapse collapse_ pull-right" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php 
                if (isset($_SESSION['uid'])) { ?>
                    <li>
                    <!--<a href="<?php echo $BaseUrl;?>/timeline">MY TIMELINE</a>-->
                    <a href="<?php echo $BaseUrl;?>/timeline"  class="navright pull-right mytime btn-border-radius">MY TIMELINE</a></li>
                    <?php

                } else {
                    ?>
                    <li><a class="btn-border-radius" href="<?php echo $BaseUrl;?>/login.php" style="background-color:#17ab56!important; border-radius:4px;margin-right: 16px;">LOGIN</a></li>
                        
                    <li><a class="btn-border-radius" style="background-color:#17ab56!important; border-radius:4px" href="<?php echo $BaseUrl;?>/sign-up.php">REGISTER</a></li>
                    <?php
                }
                ?>
                
                <!-- <li><a href="<?php echo $BaseUrl.'/store'; ?>" class="btn btn-green">SUBMIT AN AD</a></li>  -->
            </ul>
            
        </div>
    </div>
</nav>
<div class="row">
<div class="col-md-12">
<div class="topsearch text-center">
    <!-- <h2>Your Pathway to Social & Business Success!</h2>
    <h3>The SharePage is not just a platform,it's a transformative movement.</h3> -->
<!-- <h2>Share Whats in your mind</h2>
<h3>Post what you like to share with your friends - message, photo,  audio/video or documents</h3> -->
</div>
</div>
<div style="display:none;" class="col-md-offset-1 col-md-10">
<form id="searchform" method="post" action="<?php echo $BaseUrl.'/search/search.php'?>" >
<div class="form-group">
<select class="form-control" name="txtCategory" id="searchdropbox">
<optgroup label="Profiles">
<option value="-p">All</option>
<?php
$pt = new _profiletypes;
$rpt = $pt->read();
while ($row = mysqli_fetch_assoc($rpt)) {
if ($row['idspProfileType'] != 6 && $row['idspProfileType'] != 5) {
?>
<option value="<?php echo $row['idspProfileType']; ?>-p" <?php
if (isset($categoryvalue)) {
if ($categoryvalue == $row['idspProfileType']) {
echo "selected";
}
}
?> ><?php echo $row['spProfileTypeName'] ?></option> <?php
}
}
?>
</optgroup>
<optgroup label="Product">
<option value="-c" <?php
if (isset($categoryvaluepro)) {
if ($categoryvaluepro == "") {
echo "selected";
}
}
?>>All</option>

<?php
$ca = new _categories;
$result = $ca->read();

if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
?>
<option value="<?php echo $rows['idspCategory']; ?>-c" <?php
if (isset($categoryvaluepro)) {
if ($categoryvaluepro == $rows['idspCategory']) {
echo "selected";
}
}
?>><?php echo $rows['spCategoryName']; ?></option> <?php
}
} ?>
</optgroup>
</select>
</div>
<div class="form-group">
<input type="text" name="txtSearchHome" id="sp-auto-post" class="form-control" placeholder="Search" />
<button class="btn searchbtnmob" name="btnSearchHome" id="btnsearch" type="submit"><i class="fa fa-search"></i></button>
</div>
</form>
</div>
</div>
</div>
</header>

<section class="contentpage">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php

?>


<h2><?php  echo $pageTitle; ?></h2>
<h4><?php echo $pageDesc; ?></h4>
<?php if(isset($_GET['page']) && $_GET['page'] == 'investment_opportunities')
{ ?>
<a href="<?php echo $BaseUrl;?>/contact.php">click here...</a>

<?php } ?>

</div>
</div>

</div>
</section>




<script>
    //side menu bar
    const toggle = document.getElementById('toggle');
    const sidebar = document.getElementById('sidebar');

    document.onclick = function(e){
        if(e.target.id !== 'sidebar' && e.target.id !== 'toggle')
        {
            toggle.classList.remove('active')
            sidebar.classList.remove('active')
        }
    }
    toggle.onclick = function () {
        toggle.classList.toggle('active');
        sidebar.classList.toggle('active');

    }
</script>
<?php 
// include('../component/f_footer.php');
 include_once("../views/common/footer.php");                        

include('../component/f_btm_script.php'); ?>

</body>
</html>
