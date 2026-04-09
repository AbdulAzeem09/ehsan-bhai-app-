<?php
////error_reporting(E_ALL);
//ini_set('display_errors', 1);
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

// ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
$f = new _spprofiles;

$re = new _redirect;
//check profile is freelancer or not
$chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
if($chekIsFreelancer == false){
$redirctUrl = $BaseUrl . "/my-profile/";
$_SESSION['count'] = 0;
$_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
$re->redirect($redirctUrl);
}
// END


if(isset($_GET['profile']) && $_GET['profile'] > 0){
$profileId = $_GET['profile'];
}else{
$redirctUrl = $BaseUrl . "/freelancer/";
$re->redirect($redirctUrl);
} ?>
<!DOCTYPE html>
<html lang="en-US"> 

<head>
<?php include('../component/f_links.php');?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">


<style type="text/css">

.swal2-popup { 
font-size: medium!important;
}

.simple-pagination .current {
    background-color: #ff4700 !important;
}

.col-sm-6.col-lg-4.mb-2.interior {
margin-top: 10px;
margin-bottom: 10px;
}

.rating-box {
position:relative!important;
vertical-align: middle!important;
font-size: 18px;
font-family: FontAwesome;
display:inline-block!important;
color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before{
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute!important;
left:0;
top:0;
white-space:nowrap!important;
overflow:hidden!important;
color: Gold!important;

}
.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

#FormSubmitButton{
font-size: 20px;
color: #fff;
font-family: Marksimon;
border: 1px solid #959595;
padding: 20px 0;
line-height: 0;
}

.zoom2:hover {
-ms-transform: scale(1.05); /* IE 9 */
-webkit-transform: scale(1.05); /* Safari 3-8 */
transform: scale(1.05); 

}  
.aaa1{
border-radius: 50%;
width: 200px;
height: 200px;
margin-left: 26px;
}

.btn_fb{background-color:#3b5999;font-size:20px;color:white;padding: 7px 12px;
border-radius: 8px;}
.btn_fb:hover{color:white;background-color: #6178ab;}	
.btn_google{background-color:#3b5999;font-size:20px;color:white;padding: 7px 12px;
border-radius: 8px;}

.btn_tweet{background-color:#55acee;font-size:20px;color:white;padding: 7px 2px 7px 9px;
border-radius: 8px;}
.btn_tweet:hover{color:white;background-color: #6178ab;}	

.btn_linkdin{background-color:#3b5999;font-size:20px;color:white;padding: 7px 4px 7px 10px;border-radius: 8px; margin: 5px;}
.btn_linkdin:hover{color:white;background-color: #6178ab;}	

.btn_whatsapp{background-color:#0f8f46;font-size:20px;color:white;padding: 7px 12px;border-radius: 8px;}
.btn_whatsapp:hover{color:white;background-color: #35b96e;}	

span.label.label-default {
margin-top: 10px;
display: inline-flex;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #FF7182;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
}
@media(max-width:480px)
{
#img_fix{
  margin-top: 34px!important;
  margin-bottom: -55px!important;
}
#msize11{
  margin-left:50px!important;
}
#text_data{
  margin-left:30px!important;
}
#userdata{
  margin-left:153px!important;
}
}

#text_data{
  margin-left:40px!important;
}







</style>


</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../header.php");
?>











<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="cssfreelancer/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet" href="cssfreelancer/bootstrap-theme.min.css">
<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/cssfreelancer/font-awesome.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Latest compiled and minified JavaScript -->

<link rel="stylesheet" type="text/css" href="cssfreelancer/fl.css">
</head>

<style type="text/css">

    .skill-list{
        overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 150px;
  padding: 0px;
  margin-top: 0px;
    margin-bottom: 0px;
    }
    .sweet-alert h2 {
    margin: 25px 0 !important;
}

.sweet-alert p {
    margin-top: 5px !important;
    margin-bottom: 20px !important;
}  
</style>

<?php
$p =  new _spprofiles;
$result = $p->read($profileId);
//echo $p->ta->sql;
if($result){
$row = mysqli_fetch_assoc($result);
/* echo "<pre>";
print_r($row);*/
$Title = $row['spProfileName'];
$spProfilePhone = $row['spProfilePhone'];
$spProfileEmail = $row['spProfileEmail'];
$country = $row['spProfilesCountry'];
$state = $row['spProfilesState'];
$city = $row['spProfilesCity'];
$picture = $row['spProfilePic'];
$spprofilesAddress = $row['spprofilesAddress'];

$fi = new _spfreelancer_profile;
$result_fi = $fi->getType($row['idspProfiles']);


$fi = new _spfreelancer_profile;
$result_fi = $fi->read($row['idspProfiles']);
//echo $fi->ta->sql;
if($result_fi){
$ProjectName = '';
$perhour = '';
$skill = '';
$row_fi = mysqli_fetch_assoc($result_fi);
/* print_r($row_fi);*/
$skills = $row_fi['skill'];
$hourlyrate = $row_fi['hourlyrate'];
$overview = $row_fi['spProfileAbout'];
$certification = $row_fi['certification'];
$personalwebsite = $row_fi['personalwebsite'];
$languagefluency = $row_fi['languagefluency'];


/* while($row_fi = mysqli_fetch_assoc($result_fi)){
if($skill == ''){
if($row_fi['spProfileFieldName'] == 'skill_'){*/
$skill = explode(',', $skills);
/*       
}
}

}*/
}

}
?>



<body cz-shortcut-listen="true">
<section>
<div class="container">


<div class="row user-menu-container square">
<h4 class="back-to-projectlist" > 
<a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?> " class="" style="color: #f38d4e;"  ><i class="fa fa-chevron-left  zoom2" style="    margin-right: 8px;"></i> <span class="fa fa zoom2">Return to Freelancer list</span></a>
</h4>

<div class="col-md-7 user-details">
<div class="row coralbg white">
<div class="col-md-8 no-pad">
<div class="user-pad">                        
<h3 class="name"><?php echo ucwords(strtolower($Title));?></h3>

<?php  
// COUNTRY NAME
$co = new _country;
$result3 = $co->readCountryName($country);
//echo $co->ta->sql;
if($result3 && $result3->num_rows > 0){
$row3 = mysqli_fetch_assoc($result3);
$countryTitle = $row3['country_title'];
}else{
$countryTitle = "";
}
// CITY NAME
$ci = new _city;
$result4 = $ci->readCityName($city);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
$cityTitle = $row4['city_title'];
}else{
$cityTitle = "";
}

$st = new _state;
$result5 = $st->readStateName($state);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
$stateTitle = $row5['state_title'];
}else{
$stateTitle = "";
}

?>
<?php if(!empty($countryTitle)){  ?>
<h4 class="country  white" ><i class="fa fa-map-marker"></i>&nbsp;<?php echo $cityTitle.' ,'.$stateTitle.' ,'. $countryTitle;?></h4>
<?php }?>

<!-- <h4 class="white"><i class="fa fa-twitter"></i> CoolesOCool</h4> -->
<?php 
$m = new _subcategory;
$profileid = $row['idspProfiles'];
$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];

$result11 = $m->read_review_rating_usernewprofile($profileid);
$total_rating = 0;
$total_rating_count = 0;
$avg = 0; 
if($result11!= false){
$total_rating_count = $result11->num_rows;

while($storedata11 = mysqli_fetch_assoc($result11))
{
  if($storedata11){
  $total_rating = $total_rating + $storedata11['rating'];
  }
    
}
}
if ($total_rating_count > 0) {
  $avg = $total_rating / $total_rating_count;
}


$totalreviewrate1 = $avg;





?>
<?php


$mr = new _freelance_recomndation;

// echo $row['idspProfiles'].'+++++';
// $resultsum1 = $mr->readfreelancerating($row['idspProfiles']);

// // echo $mr->ta->sql;

// $totalreviewrate1 = 0;
// $totalmyreviews1 = 0;

// if($resultsum1 != false){



// $totalmyreviews1 = $resultsum1->num_rows;

// //echo"here";  
// //  echo $totalreviews;


// while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

// //  print_r($rowreview1);

// $sumrevrating1 += $rowreview1['recomnd_rating'];

// $rateingarr1[] =  $rowreview1['recomnd_rating'];

// }  

// $count1 = count($rateingarr1);

// $reviewaveragerate1 = $sumrevrating1 / $count1;

// $totalreviewrate1  = round($reviewaveragerate1, 1);

// /*echo $totalreviewrate1;
// */
// }      






// ?>

<?php 


//$m_data =  $row['idspProfiles'];
//$mmkk11 = $mr->show_status_m($m_data);
//$mstore_11 = mysqli_fetch_assoc($mmkk11);    
?>

<!-- <p class="rating_box"> -->
<span><a href="<?php echo $BaseUrl.'/freelancer/showfreelancerating.php?postid='.$profileId;?>"><span class="white">&nbsp;&nbsp; Reviews : <?php echo $totalmyreviews1; ?>
</span></a></span>
<div class="rating-box">
<?php if($totalreviewrate1 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate1 > "4" && $totalreviewrate1 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate1 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate1 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate1 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate1 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate1 <= "0" ) { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>



<!-- </p> -->

</div>
</div>
<div class="col-md-4 no-pad">
<div class="user-image">

<?php
if($picture){
echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg aaa1' style='margin-left: 26px;    height: 200px;'  src=' ".($picture)."' >" ;
}else{
echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg aaa1'style='margin-left: 26px;    height: 200px;' src='https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg' >" ;
}
?>
<!-- <img src="https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg" class="img-responsive thumbnail">--> 
</div>
</div>

</div>
<div class="row overview p15">
<h3>Profile Overview</h3>

<div class="pull-right">
<?php	


$profid1=$_SESSION['pid'];
$uid1=$_SESSION['uid'];
$flid=$_GET['profile'];
$f = new _flagpost;
$id = $f->read_heart($profid1,$uid1,$flid);

if($id->num_rows>0){?>

<span id="addfav<?php echo $_GET['profile'];  ?>"><a onclick="myUnfav('<?php echo $_GET['profile']; ?>')" class="profile_section icon-favorites fa fa-heart fa-2x  sp-favorites " style="font-size:24px; color: red"></a></span>
<!-- </?php	header("location:user-newprofile.php");  ?> -->
<?php
}

else{ ?>
<span id="addfav<?php echo $_GET['profile'];  ?>"><a onclick="myFav('<?php echo $_GET['profile']; ?>')" class="profile_section icon-favorites fa fa-heart-o fa-2x  sp-favorites  " style="font-size:24px; color: red"></a></span>
<!-- </?php	header("location:user-newprofile.php");   ?> -->
<?php }


?>

<!--<a href="#"><i class="fa fa-share fa-2x color:purple "></i></a>
<a href="#"><i class="fa fa-flag fa-2x   color: red"></i> </a> -->                         
</div>
<ul class="user-menu-list">
<li>

<?php if(isset($hourlyrate)){
$pid_new=$row_fi['spprofiles_idspProfiles'];
   $result_new1 = $fi->read_currency_new1($pid_new);
   $row_uid = mysqli_fetch_assoc($result_new1);
 $user_id_new=$row_uid['spUser_idspUser'];
 
  $result_new2 = $fi->read_currency_new($user_id_new);
  if( $result_new2){
  $row_uid_new = mysqli_fetch_assoc($result_new2);
  }
   $currancys=$row_uid_new['currency'];

 ?>
<p><i class="fa fa-usd coral"></i>
<span class="">&nbsp;&nbsp;Hourly Rate:</span>
<span class="red "><?php if($currancys) { echo $currancys.' '.$hourlyrate; } else { echo 'USD'.' '.$hourlyrate;  }?>/hr</span></p>




<?php }  ?>

</li>
<li>

<?php if(isset($certification)){ ?>

<p><i class="fa fa-certificate coral"></i>
<span class="">&nbsp;&nbsp;Certification:</span>
<span class=""><?php echo $certification;?></span></p>

<?php }  ?>

</li>
<li>
<?php if(isset($languagefluency)){ ?>

<p><i class="fa fa-language coral"></i>
<span class="">Language fluency:</span><span class="">&nbsp;&nbsp;<?php echo $languagefluency;?></span></p>

<?php }  ?>

</li>
<li>
<p><i class="fa fa-address-card-o coral "></i> 
Profile Link:
<input type="text" name="" id="textcopy" class="profileLinkField " style="width:50%!important;" value="<?php echo $BaseUrl.'/freelancer/user-newprofile.php?profile='.$profileId;?>">
<i class="fa fa-copy" onclick="myfunction()" style="font-size:18px;"></i> 

</p>

</li>                        
</ul>

<?php
$title="whatsapp";

$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>	

<div id="social-share" class="mt_d">
<strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
</div>


</div>
</div>


<?php
?>



<div class="col-md-1 user-menu-btns">
<div class="btn-group-vertical square" id="responsive">
<a href="#" class="btn btn-block btn-default active">
<i class="fa fa-envelope fa-3x faicon"></i>
</a>
<a href="#" class="btn btn-default">
<i class="fa fa-laptop fa-3x faicon"></i>
</a>
<a href="#" class="btn btn-default">
<i class="fa fa-certificate fa-3x faicon"></i>
</a>
<a href="#" class="btn btn-default">
<i class="fa fa-check fa-3x faicon"></i>
</a>
<a href="#" class="btn btn-default">
<i class="fa fa-user fa-3x faicon"></i>
</a>
</div>
</div>
<div class="col-md-4 user-menu user-pad">
<div class="user-menu-content active">
<div class="col-xs-12 contact-marina-content contactcontent">
<form method="post" id="messageform" action="freelance_chat_project.php">
<!--<input type="hidden" name="chat_date" value="2022-02-12 10:02">
<input type="hidden" name="sender_idspProfiles" value="997">
<input type="hidden" name="receiver_idspProfiles" value="574">-->

<input type="hidden" name="chat_date" value="<?php echo date('Y-m-d h:m');?>">
<input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid'];?>" >
<input type="hidden" name="receiver_idspProfiles" value="<?php echo $_GET['profile']; ?>" >

<div class="form-group">
<label for="spPostingPrice_" class="price_label">Price</label><br>
<label class="radio-inline" for="spfixedPrice">

<input type="radio" class="spPostField fixedprice" data-filter="0" id="spfixedPrice" name="PriceFixed" checked="" value="Fixed" for="spfixedPrice">Fixed Price</label>

<label class="radio-inline" for="spfixedPrice1">

<input type="radio" class="spPostField hourlyrate" data-filter="0" id="spfixedPrice1" name="PriceFixed" value="Hourly" for="spfixedPrice1">Hourly Rate</label>

</div>
<div class="input-group" style="display: flex;">

<input type="text" class="form-control activity" id="bidPrice" style="width: 200px;"  onkeypress="return isNumber(event)" name="bidPrice" data-filter="0" placeholder="Bid Price" maxlength="8" aria-describedby="basic-addon1" required>  
 

<input type="text" class="form-control activity" id="currency" value="<?php if($currancys) { echo $currancys.' '.$hourlyrate; } else { echo 'USD'.' '.$hourlyrate;  }?>/hr"  name="currency" data-filter="0" aria-describedby="basic-addon1" readonly>  


</div>
<span style="color:red;display:none;" id="bidPrice_id" >Bid Price are Required .</span>


<!--<div class="form-group">
<textarea class="form-control inputField-textarea" id="myMessage" name="chat_conversation" placeholder="Message">                                
</textarea>
</div>-->

<div class="form-group">
<textarea class="form-control inputField-textarea" id="myMessage" name="chat_conversation" placeholder="Message" style="margin-top: 13px;"></textarea>
</div>


<div class="form-group">

<input type="button" id="FormSubmitButton" class="form-control inputSubmitField sendbtn" onclick="return message_submit()" value="HIRE NOW">
</div>
</form>
</div>
</div>
<div class="user-menu-content">
<h3>TOP Skills</h3>


<?php  

$fd= new _freelancerposting;

$free=$fd->freelanceget($_GET['profile']);	

// var_dump($free);

if($free){
while($free1= mysqli_fetch_assoc($free)){
//die("---------fret--dgfd----------");
  

$skills=$free1['skill'];
$ex= explode(",",$skills);
//echo $ex.'<br>';
foreach($ex as $i){ 
    $tooltip = "$i";
echo '<span class="label label-default" style="font-size:18px;margin-left:5px;" ><p class="skill-list" title="'.$tooltip.'">'.$i."  ".' </p></span>';
}
}
}
?>

</div>
<div class="user-menu-content">
<h3>Certifications</h3>

<!-- Left-aligned media object -->
<?php 
if($certification!= false){  
  
  ?>
  
<?php 
$certi= explode(",",$certification);
foreach($certi as $i1){ 
  $tooltip1 = "$i1";
echo '<span class="label label-default" style="font-size:18px;margin-left:5px;" ><p class="skill-list" title="'.$tooltip1.'">'.$i1."  ".' </p></span>';
}

// echo '<span class="label label-default color:white"  style="font-size:18px;">'.$certification."  ".'</span>'; 

?>
<?php }else {
  echo "<h4><b> No Certifications Found </b></h4>";

} ?>

<?php 
if($free){
while($free1= mysqli_fetch_assoc($free)){



$cert=$free1['certification'];   //die("---------frfhgf22et--dgfd----------");
$ex= explode(",",$cert);
//echo $ex.'<br>';
foreach($ex as $i){ 
echo '<span class="label label-default color:white"  style="font-size:18px;">'.$certification."  ".'</span>';
} 



}
}else{
  // echo "<h4><b>No Certificate Awarded </b></h4>";
}
//
$profileid = $_GET['profile'];
$resd = $fd->profilesread($profileid);

$shwuser = mysqli_fetch_assoc($resd);

$userid = $shwuser['spUser_idspUser'];






$fqqq=$fd->currency_code1($userid);
if($fqqq){
$rwww= mysqli_fetch_assoc($fqqq);
}
//print_r($rwww);die("dddddddddddd");
?>


</div> 
<div class="user-menu-content">
<h3>Verification</h3>
<ul class="user-menu-list">
<li>
<!--<h4><i class="fa fa-user coral"></i> Identity</h4> -->
</li>
<li>
<h4><i class="fa fa-phone coral"></i> Phone : <?php  if($rwww['is_phone_verify']== 1){ echo "<span style='color:green;'> Phone Verified</span> "; }else{ echo "<span style='color:red;'> Phone Not Verified </span>";}?></h4>
</li>
<li>
<h4><i class="fa fa-envelope-o coral"></i> Email : <?php if($rwww['is_email_verify']== 1){ echo "<span style='color:green;'>Email Verified</span>"; }else{ echo "<span style='color:red;'>Email Not Verified</span>";}?></h4>
</li>
<li>
<!-- <h4><i class="fa fa-usd coral"></i> Payment</h4> -->
</li>
</ul>
</div>

<div class="user-menu-content">
<h3>Review</h3>
<div id="review_rating_new" class="tabcontent">

            <div class="col-sm-12 nopadding dashboard-section" style="height:318px!important;overflow:auto;">
              <div class="col-xs-12 dashboardtable">
                <?php
            
                //$mmkk11 = ->show_status_m($m_data);
                
                // = mysqli_fetch_assoc($mmkk11);  
                $mr = new _freelance_recomndation;
            
                $m_data =  $row['idspProfiles'];
                $pid1 = $_SESSION['pid'];
                $uid1 = $_SESSION['uid'];
                $mstore_11 = $mr->read_review_rating_m($m_data);
                if ($mstore_11) {
                  while ($rating_view = mysqli_fetch_assoc($mstore_11)) {

                    $comment = $rating_view['description'];
                    $reting = $rating_view['rating'];
                    $date = $rating_view['date'];
                    $pid = $rating_view['pid'];

                    $sp = new _spprofiles;
                    $result = $sp->readname($pid);

                    if ($result != false) {
                      $row1 = mysqli_fetch_assoc($result);
                    }

                ?>
                    <div class="comment-section">
                      <div class="d-flex justify-content-between align-items-center">

                        <div class="row">
                          <div class="col-md-3 col-sm-2" class="no-padding" style="width: 13%;margin-top: 20px;">
                            <?php if ($row1['spProfilePic']) { ?>
                              <img src="<?php echo $row1['spProfilePic'];
                                        ?> " class="rounded-circle profile-image" style=" border-radius: 50%; height: 45px;width: 45px;margin-left: -28px;margin-top:-10px;">
                            <?php } else { ?>
                              <img src="<?php echo $BaseUrl ?>/assets/images/icon/blank-img.png" class="rounded-circle profile-image" style=" border-radius: 50%; height: 40px;width: 40px;margin-left: -28px;">
                            <?php } ?>
                          </div>
                          <div class="col-md-8 col-sm-10" class="no-padding" style="margin-top: 10px;padding-left:1px;">
                            <a href="<?php echo $BaseUrl ?>/freelancer/user-newprofile.php?profile=<?php echo $pid;
                                                                                ?>"><span class="username">
                                <?php echo $row1['spProfileName']; ?>
                              </span></a>
                          </div>

                        </div>
                        <br>
                        <div class="d-flex flex-column ml-1 comment-profile" style="margin-left: 19px;margin-top:-45px;">

                          <?php

                          $star = "<i class='fa fa-star'></i>  ";
                          $count = $reting;

                          for ($int = 1; $int <= $count; $int++) {
                            echo  "<span style='color:orange';>" . $star . "</span>";
                          }
                          echo "<br>";
                          ?>

                          <span class="username"><?php echo $comment; ?></span>
                        </div>

                        <div class="date" style="margin-left: 19px;">
                          <span class="text-muted"><?php echo $date; ?></span>
                        </div>
                      </div>
                    </div>
                    <br>

                <?php
                  }
                }
                else {

                    echo "<h3 class='text-center'>No Review available for this Profile</h3>";
                  }
                ?>
              </div>
            </div>
          </div>







<?php 


//$m_data =  $row['idspProfiles'];
//$mmkk11 = $mr->show_status_m($m_data);

//$mstore_11 = mysqli_fetch_assoc($mmkk11);   
?>

</div> 
</div>    


</div>

</section>
<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}

.sa-button-container button.confirm {
    background-color: #939aa4 !important;
}
</style>					  

<section>
<div class="container">
<div class="row user-menu-container square">
<div class="col-sm-12 p15">
<h4>Portfolio Items</h4>
<div class="col-12 text-center w-100">
<div class="form-row gallery list-wrapper ">


<?php         
//$pid = $_GET['profile'];
$profileid = $_GET['profile'];

$uid = $_SESSION['uid'];

$fp = new _freelance_chat;


$result = $fp->get_profile_portfolio($profileid);
$count = $result->num_rows;

if($result){ 
while($rowreview1 = mysqli_fetch_assoc($result))  {
    


    

$folioid= $rowreview1['id'];

// $folioid= $rowreview1['id'];
$pf = new _spPortfolio;
// die("------------");
$resimg = $pf->readimg_limit($folioid);

if ($resimg) {
$i = 1;
while ($row = mysqli_fetch_assoc($resimg)) {
    
$spImg =   $row['image'];


}}                         

?>
<div class="col-sm-6 col-lg-4 mb-2 interior list-item ">
<div class="portfolio-wrapper">
<div class="portfolio-image">
<img src="<?php  echo $baseurl."/dashboard/portfolio/image/". $spImg ; ?>" alt=""  height="200" width="200"/><br>
</div>
<div class="portfolio-overlay">
<div class="portfolio-content">
<a class="popimg portfolio-content " href="//<?php   echo $rowreview1['spWeblink'];  ?>">
<i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
<h4><span  class="smalldot"><?php  echo $rowreview1['spTitle']; ?></span></h4>

<h5><span  class="smalldot"><?php  echo $rowreview1['desPort']; ?></span></h5>
</a>


</div>
</div>
</div>
</div>

<?php  }
}
else {
    echo "<h4 style='float: left'> No Portfolio Found </h4>";
}
?>

</div>
<?php 
if($count > 6){ ?>
<div id="pagination-container"></div>
<?php } ?>
</div>
</div>
</div>

</div>
<div class="container">
<div class="row user-menu-container square">
<div class="col-sm-12 p15" style="height:510px!important;overflow:auto;">
<h4>Reviews</h4>
<!-- Left-aligned media object -->

<?php  
$p =  new _spprofiles;
$result = $p->read($profileId);
//echo $p->ta->sql;
if($result){
$row = mysqli_fetch_assoc($result);
/* echo "<pre>";
print_r($row);*/
$Title = $row['spProfileName'];
$country = $row['spProfilesCountry'];
$state = $row['spProfilesState'];
$city = $row['spProfilesCity'];
$picture = $row['spProfilePic'];



$mr = new _freelance_recomndation;
// echo  $row['idspProfiles'];
if($resultsum1) {
$resultsum1 = $mr->readfreelancerating($row['idspProfiles']);
}
// echo $mr->ta->sql;

$totalreviewrate1 = 0;
$totalmyreviews1 = 0;

$mr = new _freelance_recomndation;
            
$m_data =  $row['idspProfiles'];
$pid1 = $_SESSION['pid'];
$uid1 = $_SESSION['uid'];
$mstore_11 = $mr->read_review_rating_m($m_data);
if ($mstore_11) {
  while ($rating_view = mysqli_fetch_assoc($mstore_11)) {

    $comment = $rating_view['description'];
    $reting = $rating_view['rating'];
    $date = $rating_view['date'];
    $pid = $rating_view['pid'];

    $sp = new _spprofiles;
    $result = $sp->readname($pid);

    if ($result != false) {
      $row1 = mysqli_fetch_assoc($result);
    }

?>
    <div class="comment-section">
      <div class="d-flex justify-content-between align-items-center">

        <div class="row" style="margin-left:-105px!important;">
          <div class="col-md-3 col-sm-2" class="no-padding" id="img_fix" style="width: 13%;margin-top: 20px;">
            <?php if ($row1['spProfilePic']) { ?>
              <img src="<?php echo $row1['spProfilePic'];
                        ?> " class="rounded-circle profile-image" style=" border-radius: 50%; height: 45px;width: 45px;margin-left: 85px;margin-top:-10px;">
            <?php } else { ?>
              <img src="<?php echo $BaseUrl ?>/assets/images/icon/blank-img.png" class="rounded-circle profile-image" style=" border-radius: 50%; height: 40px;width: 40px;margin-left: 85px;">
            <?php } ?>
          </div>
          <div class="col-md-8 col-sm-10" class="no-padding" style="margin-top: 10px;padding-left:1px;">
            <a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $pid;
                                                                ?>"><span class="username" id="userdata">
                <?php echo $row1['spProfileName']; ?>
              </span></a>
          </div>

        </div>
        <br>
        <div class="d-flex flex-column ml-1 comment-profile" id="msize11" style="margin-left: 19px;margin-top:-45px;">

          <?php

          $star = "<i class='fa fa-star'></i>  ";
          $count = $reting;

          for ($int = 1; $int <= $count; $int++) {
            echo  "<span style='color:orange';>" . $star . "</span>";
          }
          echo "<br>";
          ?>

          <span class="username"><?php echo $comment; ?></span>
        </div>

        <div class="date" style="margin-left: 19px;">
          <span class="text-muted" id="text_data"><?php echo $date; ?></span>
        </div>
      </div>
    </div>
    <br>

<?php
  }
// die("-----------------"); 


// $totalmyreviews1 = $resultsum1->num_rows;

//echo"here";  
//  echo $totalreviews;

if($resultsum1){
while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

//  print_r($rowreview1);

// echo   $rowreview1['recomnd_rating'];

//$rateingarr1[] =  $rowreview1['recomnd_rating'];  

// $count1 = count($rateingarr1);

// $reviewaveragerate1 = $sumrevrating1 / $count1;

// $totalreviewrate1  = round($reviewaveragerate1, 1);
$totalreviewrate1  = round($rowreview1['recomnd_rating'], 1);



?>

<div class="media">
<div id="review_rating_new" class="tabcontent">

            <div class="col-sm-12 nopadding dashboard-section">
              <div class="col-xs-12 dashboardtable">
                <?php
            
                //$mmkk11 = ->show_status_m($m_data);
                
                // = mysqli_fetch_assoc($mmkk11);  
                $mr = new _freelance_recomndation;
            
                $m_data =  $row['idspProfiles'];
                $pid1 = $_SESSION['pid'];
                $uid1 = $_SESSION['uid'];
                $mstore_11 = $mr->read_review_rating_m($m_data);
                if ($mstore_11) {
                  while ($rating_view = mysqli_fetch_assoc($mstore_11)) {

                    $comment = $rating_view['description'];
                    $reting = $rating_view['rating'];
                    $date = $rating_view['date'];
                    $pid = $rating_view['pid'];

                    $sp = new _spprofiles;
                    $result = $sp->readname($pid);

                    if ($result != false) {
                      $row1 = mysqli_fetch_assoc($result);
                    }

                ?>
                    <div class="comment-section">
                      <div class="d-flex justify-content-between align-items-center">

                        <!-- <div class="row">
                          <div class="col-md-3 col-sm-2" class="no-padding" style="width: 13%;margin-top: 20px;">
                            <?php if ($row1['spProfilePic']) { ?>
                              <img src="<?php echo $row1['spProfilePic'];
                                        ?> " class="rounded-circle profile-image" style=" border-radius: 50%; height: 45px;width: 45px;margin-left: -28px;margin-top:-10px;">
                            <?php } else { ?>
                              <img src="<?php echo $BaseUrl ?>/assets/images/icon/blank-img.png" class="rounded-circle profile-image" style=" border-radius: 50%; height: 40px;width: 40px;margin-left: -28px;">
                            <?php } ?>
                          </div>
                          <div class="col-md-8 col-sm-10" class="no-padding" style="margin-top: 10px;padding-left:1px;">
                            <a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $pid;
                                                                                ?>"><span class="username">
                                </?php echo $row1['spProfileName']; ?>
                              </span></a>
                          </div>

                        </div>
                        <br>
                        <div class="d-flex flex-column ml-1 comment-profile" style="margin-left: 19px;margin-top:-45px;"> -->

                          <?php

                        //   $star = "<i class='fa fa-star'></i>  ";
                        //   $count = $reting;

                        //   for ($int = 1; $int <= $count; $int++) {
                        //     echo  "<span style='color:orange';>" . $star . "</span>";
                        //   }
                        //   echo "<br>";
                        //   ?>

                        <!-- //   <span class="username"></?php echo $comment; ?></span>
                        // </div>

                        // <div class="date" style="margin-left: 19px;">
                        //   <span class="text-muted"></?php echo $date; ?></span>
                        // </div> -->
                      </div>
                    </div>
                    <br>

                <?php
                  }
                }
                else {

                    echo "<h3 class='text-center'>No Review available for this Profile</h3>";
                  }
                ?>
              </div>
            </div>
          </div>
</div>
<hr>

<?php  }  

                }
/*echo $totalreviewrate1;
*/
}    else{
echo "<h4><b>No Reviews Found<b></h4>";
}


}  

?>


<!-- <div class="media">
<div class="media-left">
<img src="img/google-certification.png" class="media-object img-round" style="width:60px">
</div>
<div class="media-body">
<div style="display: inline-block;">
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star-o coral"></i>
<span>4 Rating</span>
</div>
<h4 class="media-heading">Jhone</h4>
<p>Lorem ipsum dolor sit amet, </p>
<span class="pull-right bolder"><h2>$ 100</h2></span>
</div>
</div>
<hr>-->
<!-- Left-aligned media object -->
<!--<div class="media">
<div class="media-left">
<img src="img/google-certification.png" class="media-object img-round" style="width:60px">
</div>
<div class="media-body">
<div style="display: inline-block;">
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star coral"></i>
<i class="fa fa-star-o coral"></i>
<span>4 Rating</span>
</div>
<h4 class="media-heading">Jhone</h4>
<p>Lorem ipsum dolor sit amet, </p>
<span class="pull-right bolder"><h2>$ 100</h2></span>
</div>
</div>-->
</div>
</div>

</div>
<div class="container">
<div class="row user-menu-container square">
<div class="col-sm-12 p15">
<h4>Experience</h4>
<ul>
<h3>Head Of IT Department</h3>
<h4>IZMA Group</h4>
<li>Apr 2009 - Present</li>
<li>Leading IT Inhouse team.</li>
</ul>                
</div>
</div>        
</div>
<div class="container">
<div class="row user-menu-container square">
<div class="col-sm-12 p15">
<h4>Education</h4>
<ul>
<h3>Master Information Technology</h3>
<h4>Virtual University</h4>
<li>Apr 2000 - Aug 2000</li>
<li>Leanig Computer Programing</li>
</ul>                
</div>
</div>        
</div>
</section>


<script type="text/javascript">
   function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;  
}
</script>

<script>

function message_submit(input) {
var msg = $('#myMessage').val();
var bidPrice = $('#bidPrice').val();

if(bidPrice == ""){
$('#bidPrice_id').show();
return false;     
}


if (msg.length == 0) {

swal({
title: "<img src='../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
text: " <b>Message can't be blank. </b>",
html: true,

})
return false;
}else{

swal({                     
title: "<img src='../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
text:  "<b>Request Sent Successfully. </b>",
html: true,
showConfirmButton: true
},

function() {
$("#messageform").submit();
//window.location = "<?php echo $BaseUrl;?>/freelancer";

});
}

/*return true;*/
}
</script>



<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function myfunction(){
var copyText = document.getElementById("textcopy");
copyText.select();
copyText.setSelectionRange(0, 99999);
// document.execCommand("copy");
 navigator.clipboard.writeText(copyText.value);
 Swal.fire(
'Copied Successfuly', 
)

}

</script>











<script>
$(document).ready(function() {
var $btnSets = $('#responsive'),
$btnLinks = $btnSets.find('a');

$btnLinks.click(function(e) {
e.preventDefault();
$(this).siblings('a.active').removeClass("active");
$(this).addClass("active");
var index = $(this).index();
$("div.user-menu>div.user-menu-content").removeClass("active");
$("div.user-menu>div.user-menu-content").eq(index).addClass("active");
});
});

//    $( document ).ready(function() {
//     $("[rel='tooltip']").tooltip();    

//     $('.view').hover(
//      function(){
//         $(this).find('.caption').slideDown(250); //.fadeIn(250)
//     },
//     function(){
//         $(this).find('.caption').slideUp(250); //.fadeOut(205)
//     }
//     ); 
// });

</script>
</script>
<script>
function myFav(profile){

// swal({
// title: "Add Freelancer to Favorites?",  
// type: "",
// imageUrl: '../assets/images/logo/tsp_trans.png',
// imageWidth: 70,
// imageHeight: 70, 
// confirmButtonClass: "sweet_ok",
// confirmButtonText: "Yes",
// cancelButtonClass: "sweet_cancel",
// cancelButtonText: "Cancel",
// showCancelButton: true,
// },
// function(isConfirm) {
// if (isConfirm) {

$.ajax({
url: "addfav1.php",
type: "POST",
data: {
postid:profile
},
success: function (response) {  

$("#addfav"+profile).html('<a onclick="myUnfav('+profile+')" class=" icon-favorites fa fa-heart fa-2x  sp-favorites " style="font-size:24px; color: red"></a>'); 
//location.reload();
}


});
// }
// });
}

function myUnfav(profile){

// swal({
// title: "Do you want to Unfavorite?",
// type: "", 
// imageUrl: '../assets/images/logo/tsp_trans.png',
// imageWidth: 70,
// imageHeight: 70,   
// confirmButtonClass: "sweet_ok",
// confirmButtonText: "Yes",
// cancelButtonClass: "sweet_cancel",
// cancelButtonText: "Cancel",
// showCancelButton: true,
// },
// function(isConfirm) {
// if (isConfirm) {

$.ajax({
url: "delfav1.php",
type: "POST",
data: {
postid:profile
},
success: function (response) {  

$("#addfav"+profile).html('<a onclick="myFav('+profile+')" class="profile_section icon-favorites fa fa-heart-o fa-2x  sp-favorites " style="font-size:24px; color: red"></a>');

}

});
// }
// });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });


</script>


<br>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>

<?php
} ?>