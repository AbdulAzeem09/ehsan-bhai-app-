<?php
session_start();
include("univ/baseurl.php" );
include("backofadmin/library/config.php");
include("backofadmin/library/functions.php");
require_once('common.php');

function sp_autoloader($class) {
include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <link rel="stylesheet" href="assets/css/landingpage/style.css">
    <link rel="stylesheet" href="assets/css/landingpage/all.css">  <!-- fontawesome icon -->
    <link rel="stylesheet" href="image/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="image/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/time-line.css">
    <script src="<?php echo $BaseUrl?>/assets/js/jquery_3.5.1/jquery.min.js"></script> 
    <link rel="icon" type="image/x-icon" href="../image/logosharepage 1.png">
    <?php include('component/f_links.php');?>   

    <?php 
        $urlCustomCss = $_SERVER['DOCUMENT_ROOT'].'/component/custom.css.php';
        include $urlCustomCss;
    ?>
</head>
<style>
label[class^="spC"],label.captcha {
  font-weight: 400;
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
form.sharestorepos select.form-control {
    height: 33px !important;
}
.mytime{background-color:#17ab56; padding:13px 29px; border-radius:4px;margin-top: -26px;margin-right: -278px;}
#mtime:hover{background-color:#15974c!important;}


.nav{ margin-top: 0px!important;}
.collapse_ ul li a.navright { padding: 10px!important; } 
.headers {
    min-height: 0px !important;
}
</style>

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
                            <li><a href="#" class="active">Home</a></li>
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=investment_opportunities">Investment Opportunities</a></li>
                            <li><a href="<?php echo $BaseUrl;?>/page/?page=referral__commissions">Earning Opportunities</a></li>
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

<header class="headers inr-logo">
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
<div class="col-sm-12">
<div class="topsearch text-center">
    <!-- <h2>Your Pathway to Social & Business Success!</h2>
    <h3>The SharePage is not just a platform,it's a transformative movement.</h3> -->
<!-- <h2>Share Whats in your mind</h2>
<h3>Post what you like to share with your friends - message, photo,  audio/video or documents</h3> -->
</div>

</div>
<div style="display:none;" class="col-md-offset-1 col-md-10">
<form id="searchform" method="post" action="search/search.php" >
<div class="form-group">
<select class="form-control" name="txtCategory" id="searchdropbox">
<optgroup label="Profiles">
<option value="-p">All</option>
<?php
$pt = new _profiletypes;
$rpt = $pt->read();
while ($row = mysqli_fetch_assoc($rpt)) {
?>
<option value="<?php echo $row['idspProfileType']; ?>-p" <?php
if (isset($categoryvalue)) {
if ($categoryvalue == $row['idspProfileType']) {
echo "selected";
}
}
?> ><?php echo $row['spProfileTypeName'] ?></option> <?php
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
//echo $ca->ta->sql;
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
<section class="homepage">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="heading-home text-center">
<h2>Contact Us</h2>
</div>
</div>

</div>
<form class="sharestorepos" method="post" action="<?php echo $BaseUrl.'/album/contactscript.php';?>" >
<div class="row">
<div class="col-sm-12">
<?php
if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
<p class="alert alert-success error_show"><?php echo $_SESSION['err'];?></p><?php
$_SESSION['count']++;
unset($_SESSION['err']);
}
?>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Topic<span class="red">* <label class="spConTopic"></label></span></label>
<select class="form-control" name="spConTopic" id="spConTopic">
<option value="">Select Issue</option>
<?php
$p = new _contact;
$result2 = $p->readIsue();

if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) {
echo "<option value='".$row2['spContIsueTitle']."'>".$row2['spContIsueTitle']."</option>";
}
}
?>
<option value="Other">Other</option>

</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Name<span class="red">* <label class="spConName"></label></span></label>
<input type="text" class="form-control chekspvhar" name="spConName" id="spConName" maxlength="105" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Subject<span class="red">* <label class="spConSubj"></label></span></label>
<input type="text" class="form-control chekspvhar" name="spConSubj" id="spConSubj" maxlength="105" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Email<span class="red">* <label class="spConEmail"></label></span></label>
<input type="email" class="form-control" name="spConEmail" id="spConEmail" maxlength="150" />
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label>Message<span class="red">* <label class="spConDesc"></label></span></label>
<textarea class="form-control" rows="6" name="spConDesc" style="resize:none;" id="spConDesc" ></textarea>
</div>

</div>
<div class="col-sm-12">
<div class="form-group">
<label class="lbl_10">Human Verification<span class="red">* <a href="javascript:void(0);" class="refresh" ><i class="fa fa-refresh"></i></a></span></label><br>
<input type="text" id="captcha" class="form-control" style="width: 100px;float: left;border-radius: 0px;" maxlength="6" size="6"/>

<?php
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
?>
<div class="captchatext"><?php echo $ranStr;?></div><br>
<label class="captcha" style="margin-left:-100px;color:red; "></label>

<input type="hidden" id="txtCaptcha" value="<?php echo $ranStr; ?>">
</div>
</div>
<div class="col-sm-12">
<!-- btn btn-tsp -->
<button type="submit" class=" btn btn-primary btn-border-radius" id="btncont" name="btncont"><i class="fa fa-envelope "></i> Send Now</button>

</div>

</div>
</form>




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
// include('component/f_footer.php');
include_once("views/common/footer.php");                        
include('component/f_btm_script.php'); 
?>
<script type="text/javascript" src="<?php echo $BaseUrl.'/assets/js/custom.js'?>"></script>
</body>
</html>
