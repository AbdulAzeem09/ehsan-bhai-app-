<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("../univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>   

<style type="text/css">
.mmaintab{
background: #FFF;
margin: 30px auto;
padding: 15px;
width: 100%;
}
.logo h1{
color: #000;
margin: 20px 0px 25px;;

}
.logo a img{
width: 100px;
}
.letstart{
background: #032350;
padding: 15px;
font-size: 20px;
color: #FFF;
margin: 15px 0px;
text-align: center;
}
.letstart h1{
font-size: 20px;
margin: 0px;
}
.btn{
background: #032350;
color: #FFF;
padding: 8px 15px;
display: inline-block;
margin-bottom: 15px;
text-decoration: none;
margin-top: 15px;
}
.foot{
border-top: 1px solid;
text-align: center;

}
.foot p{
margin: 0px;
color: #808080;
padding: 10px
}
.no-margin{
margin: 0px;
}	
.bg_white{
padding: 15px;
}		    	
</style>
</head>
<body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">

<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="bg_white">
<table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td align="center" class="logo" >
<a href="<?php echo $BaseUrl ?>/">
<img src="<?php echo $BaseUrl.'/assets/images/logo/tsplogo.PNG'?>" alt="logo" style="height: 100px;" class="img-responsive" />
<!-- 	<img src="<?php echo $BaseUrl ?>/assets/images/logo/tsplogo.PNG" alt="The SharePage" style=""> --></a>
<h1>The SharePage</h1>
</td>
</tr>


<tr>
<td align="center">
<?php

$u = new _spuser;
$res = $u->read($_GET['me']);
if($res != false){
    $row = mysqli_fetch_assoc($res);
    // if($row["email_verify_code"] == $_GET['active'] && $row['is_email_verify'] == 0){
    if($row['is_email_verify'] == 0){
    // echo $BaseUrl; exit;
        $result = $u->activate($_GET['me']);
        $_SESSION['chkuid'] = $row['idspUser'];
        $_SESSION["useridd"] = $row['idspUser'];
        $_SESSION["email"] = $row['spUserEmail'];
        if($row['default_profile_id'] != null && $row['default_profile_id'] != 0){
            $_SESSION["pid"] = $row['default_profile_id'];
        }
        $_SESSION['email_verified']= 1 ;
        header("Location: ../registration-steps.php");
        exit();
    ?>
        <p style="font-size:60px;color:green;margin: 0px;">&#10004;</p>
        <p></p>
        <h3>Your email address has been successfully verified. You can now sign in or complete your account registration.</h3>

        <?php

        $_SESSION['email_verified']= 1 ;
        $_SESSION["email"] =  $_GET['email'];
        $_SESSION['pageid'] = 1;
        $url = '/timeline';
        //echo "<h3>Your account is Activated. Go to <a href='".$BaseUrl."/my-profile/'> The SharePage.</a></h3>";

    } else if($row["is_email_verify"] == 1){
        header("Location: /");
        exit();
        //echo "<h3>Your account is already active. Go to your <a href='".$BaseUrl."/my-profile/'>The SharePage.</a></h3>";
        //else echo "You have invalid activation code. For activation assistance contact: <a href='mailto:" . CONTACT . "?Subject=activation-error-". $_GET['me'] . "," . $_GET['active'] . "'>" . CONTACT . "</a>.";
        $url = '/timeline';
    ?>
        <h3>Your email address has been successfully verified. You can now sign in or complete your account registration. </h3>
    <?php
    }
}
?>


<a style="color:white;text-align-last: center;" href="<?php echo $url; ?>" class="btn">LOGIN NOW</a>
</td>
</tr>

</tbody>

</table>
<div style="text-align: center;margin: 0 auto;">
<p style="margin-bottom: 10px;">© Copyright <?php echo date("Y"); ?> The SharePage. All rights reserved.</p>
<a href="<?php echo $BaseUrl ?>/page/?page=privacy_policy" style="color: #808080;">Privacy Policy</a> | <a href="<?php echo $BaseUrl ?>/page/?page=copyrights" style="color: #808080;">Terms & Conditions</a>
<div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php
include('../component/f_btm_script.php'); 
?>
</body>
</html>


