<?php 
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="freelancer/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once "../common.php";
$f = new _spprofiles;
$sl = new _shortlist; 

$projid = isset($_GET['project']) ? (int) $_GET['project'] : 0;
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
$proDetails = mysqli_fetch_assoc($chekIsFreelancer);

// END

$_GET['categoryID'] = 5;
//echo $_SESSION["uid"]; exit;
$get_profile_id2 = new _spprofiles;
$get_profile_data2 = $get_profile_id2->readProfiles2($_SESSION["uid"]);
$row2 = mysqli_fetch_assoc($get_profile_data2);
$ids2 = array();
if ($get_profile_data2 != false){
while($row2 = mysqli_fetch_assoc($get_profile_data2)) {
$ids2[] = $row2["idspProfiles"];
//	echo "<pre>"; print_r($row2); 
}
//exit;
}

//print_r($ids2); exit;

?>
<style>
#bidPrice.form-control.activity {
  margin-bottom: 0;
}
#indent {
  padding: 8px 12px !important;
  }
.zoom1:hover {
//font-weight: bold;
font-size: 14px;
-ms-transform: scale(1.05); /* IE 9 */
-webkit-transform: scale(1.05); /* Safari 3-8 */
transform: scale(1.05); 
font: 20px/1 FontAwesome !important;
}
.projectdetails .back-to-projectlist .fa-chevron-left {
margin-top: -3px;
}
.fa {

font-size: medium !important;
}

element.style {
}
button, html input[type="button"], input[type="reset"], input[type="submit"] {
-webkit-appearance: button;
cursor: pointer;
}
button, html input[type="button"], input[type="reset"], input[type="submit"] {
-webkit-appearance: button;
cursor: pointer;
}
.projetproperty_btn {
border-radius: 30px!important;
}
.butn_mdl_submit {
background-image: -webkit-linear-gradient(90deg, #fd9321 0, #fd9321 39%, #fd9321 100%)!important;
background: #fd9321;
}
#profileDropDown li.active {
background-color: #c45508!important;
}
#profileDropDown li.active a {
color: #fff!important;
}
span#car1 {
margin-top: 10px;
}

</style>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectdetails">
<div class="col-xs-12 col-sm-12 nopadding">
<div class="row">
<div class="col-xs-12  nopadding"> 
<p class="back-to-projectlist">
<a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>"><span class="fa fa zoom1"><i class="fa fa-chevron-left zoom1"></i>Back to Project list</span></a>
</p>
<style>

.inner_top_form input[type=text] {
    width: 59%!important;
    float: left;
    margin-top: 5px;
    border-radius: 0;
    background-size: 25px;
}

#notification_count {
margin-top: -27px!important;


}
.swal2-popup {
        font-size:1.5rem!important;
      }


.butn_cancel {

background-color:#d31616!important;

}
#placebid_button{
background-color: #cb8d1b!important;
}
.projetbidclose_btn {
background-image: none!important;
border-radius: 30px!important
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

.mt_d{margin-top: 10px;}

</style>
<?php 

$sf  = new _freelancerposting;

$res = $sf->singletimelines1($projid);

//  $row = mysqli_fetch_assoc($res);

//   $title = $row['spPostingTitle'];


if($res!=false){
$row = mysqli_fetch_assoc($res);
//print_r($row);
$SellId     = $row['spProfiles_idspProfiles']; 

//echo $_SESSION['pid'];die;
if($SellId == $_SESSION['pid']){ 
?>

<!--<div class="alert alert-success">
<strong>This is my profile</strong>
</div> -->  <?php  } }?>

</div>
</div>





<div class="col-xs-12 col-sm-7 nopadding">
<div>
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="space"></div>
<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-9 nopadding">


<?php

//print_r($_GET['project']);
//  $p = new _postingview;


$sf  = new _freelancerposting;

$res = $sf->singletimelines1($projid);

//  $row = mysqli_fetch_assoc($res);

//   $title = $row['spPostingTitle'];

//[spProfiles_idspProfiles] => 997
//$datas = mysqli_fetch_assoc($res);
//echo "<pre>"; print_r($datas); exit;
//echo $sf->ta->sql;




if($res){

$Fixed = "";
$Category = "";
$hourly = "";

$row = mysqli_fetch_assoc($res);

/*  echo "<pre>";
print_r($_SESSION);*/
$title = $row['spPostingTitle'];
$overview = $row['spPostingNotes'];
$country = $row['spPostingsCountry'];//
$city = $row['spPostingsCity'];//
$price = $row['spPostingPrice'];
$spPostingSkill = $row['spPostingSkill']; 
$spPostExperienceLevl = $row['spPostExperienceLevl'];
$spPostInSubCategory = $row['spPostInSubCategory'];
$spPostingDate = strtotime($row['spPostingDate']);
$spPostingDate12 = strtotime($row['spPostingDate']);
$spPostingExpDt = strtotime($row['spPostingExpDt']);
$dt = new DateTime($row['spPostingDate']);


$clientId = $row['spProfiles_idspProfiles'];
$postedPerson = $row['spUser_idspUser'];


// $pf = new _postfield;


$sf  = new _freelancerposting;

//$result_pf = $pf->read($row['idspPostings']);


$result_pf = $sf->read1($row['idspPostings']);

// echo $pf->ta->sql;
// echo $sf->ta->sql;

// print_r($result_pf);

/*    if($result_pf){*/
if($result_pf == false){
$closingdate = "";

$skill = "";
$projectType = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {


//print_r($row2);

if($closingdate == ''){
if($row2['spPostFieldName'] == 'spClosingDate_'){
$closingdate = $row2['spPostFieldValue']; 
}
}
/* if($Fixed == ''){
if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
if($row2['spPostFieldValue'] == 1){
$Fixed = "Fixed Price";
}
}
}*/
/*if($Category == ''){
if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue']; 
}
}*/
/*if($hourly == ''){
if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
if($row2['spPostFieldValue'] == 1){
$hourly = "Rate Per hour";
}
}
}*/
if($skill == ''){
if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
}
}
if($projectType == ''){
if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
$projectid = $row2['spPostFieldValue'];
}
}

}

}


$postingDate = $sf->get_timeago1(strtotime($row["spPostingDate"]));
//echo $sf->ta->sql;




if($Category == ''){
/*if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue']; 
}*/

$Category = $row['spPostingCategory']; 
}


if($Fixed == ''){
/*if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){*/
if($row['spPostingPriceFixed'] == 1){
$Fixed = "Fixed Rate";
}else{
$hourly ="Hourly Rate ";                                                  }

}



}
//$bp = new _spbusiness_profile;

$bprofile = $f->readUserId11($clientId);
$companyName = '';
if($bprofile != false){
  $pro = mysqli_fetch_assoc($bprofile);
  $companyName = $pro['companyname'];
}
$total_project = $sf->myAllProject1(5,$clientId);
if($total_project){
$totalpost = $total_project->num_rows;
}else{
$totalpost = 0;
}
$awarded = selectQ("select count(*) as count from ( select * from freelance_project_status where employer_pid = ? and fps_status = ? group by spPosting_idspPostings) as accepted_project", "is", [$clientId, 'Accepted']);
$awardedCount = 0;
if($awarded && $awarded[0]){
  $awardedCount = $awarded[0]['count'];
}
$open = selectQ("select count(*) as count from spfreelancer where spProfiles_idspProfiles = ? and complete_status = ?", "ii", [$clientId, 0]);
$openCount = 0;
if($open && $open[0]){
  $openCount = $open[0]['count'];
}
?>
<div class="col-xs-12 freelancer-post-detail about_postbanner">
<div class= "row">
<div class="col-md-6">
<h2 class="designation-heading"><?php echo $title;?></h2>
<p class="timing-week">

<?php echo ($Fixed != '')? $Fixed: $hourly;?>:<?php echo $row['Default_Currency']; ?>&nbsp;<?php echo $row['spPostingPrice']; ?> </p>

<p class="timing-week">
<?php if($row['complete_status'] == 1){
echo "project has been closed";
}else{
echo "project active";

}   
?>
</p>
<div class="col-xs-12 nopadding">
<?php
if (isset($skill)) {

if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags freelancer_uppercase skillborder skillfont'>".$value."</span>";
}

}
}
}
?>

</div>
<!--<div class="col-xs-12 nopadding margin-top-13">-->
<!--<div class="col-xs-12 col-sm-6 nopadding">-->
<!--  <div class="col-xs-2 col-sm-1 nopadding">
<img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
</div> -->
<!-- <div class="col-xs-10 col-sm-11 nopadding">-->
<p><span class="time-level"><strong>Category</strong>: <?php echo $Category;?></span></p>

<!--</div>-->
</div>
<div class="col-xs-12 col-sm-6 nopadding">
<div class="col-xs-2 col-sm-1 nopadding">

</div>
<div class="col-xs-10 col-sm-11 nopadding">
<p><span class="time-level"><!-- <strong>Price</strong>: --> <?php //echo $price.'a';?></span></p>
</div>
</div>
<!--</div>-->
<!--</div>-->
<div class="col-md-6">
<span>
<p style="margin-left: 170px;">CREATION DATE: <?php echo date("d-M-Y", $spPostingDate); ?></p>
<p style="margin-left: 140px;">PROJECTS EXIPIRING : <?php echo date("d-M-Y", $spPostingExpDt); ?></p>    
</span>
<span style="border rounded p-3">  
<h2 class="designation-heading" style="margin-left: 140px;"><?php echo $companyName; ?></h2>
<p style="margin-left: 140px;">PROJECTS POSTED : <?php echo $totalpost; ?></p>
<p style="margin-left: 140px;">PROJECTS AWARDED : <?php echo $awardedCount; ?></p>
<p style="margin-left: 140px;">OPEN PROJECTS: <?php echo $openCount; ?></p>
<p style="margin-left: 140px;">LAST LOGIN: <?php if(isset($proDetails['spProfilesLastLogin'])) {echo $proDetails['spProfilesLastLogin'];} ?></p>
</span>
</div>
</div>
<div class="col-xs-12 detail-description text-center">
<p class="freelancer_capitalize" style="word-break: break-all;"><?php echo $overview;?></p>
<a href="#bids" class="activity-on-this-job">Activity on this Job</a>
<a href="#files" class="activity-on-this-job">Files</a>
</div>
<div class="col-xs-12 col-sm-4 padding-5">
<?php 
//$po = new _postfield;

$sf  = new _freelancerposting;
$sfbid = new  _freelance_placebid;

// $respos = $pos->totalbids($_GET['project']);

//$respos = $sfbid->totalbids1($_GET['project']);
// $bids = $po->totalbids($_GET['project']);

$bids = $sfbid->totalbids1($projid);
//echo $sf->ta->sql;
if($bids){
$totalbids = $bids->num_rows;
}else{
$totalbids = 0;
}
?>
<p class="activities-on-job">Proposals: <?php echo $totalbids;?></p>
</div>
<div class="col-xs-12 col-sm-4 padding-5">
<?php 
$result2 = $sl->getshortlist($projid);
// echo $sl->ta->sql;

if($result2){
$interview = $result2->num_rows;
}else{
$interview = 0;
}
?>


<!-- <p class="activities-on-job">Interviewing: <?php echo $interview; ?></p> -->
</div>
<div class="col-xs-12 col-sm-4 padding-5">
<!--<p class="activities-on-job"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p>-->
</div>

</div>


<!--
<div class="col-xs-12 other-open-job">
<h2 class="other-open-job-h2">Other open jobs by this client (2)</h2>
<p><span>Data Entry Needed -</span> Hourly</p>
<p><span>Looking for amazing Graphic Designer -</span> Hourly</p>
</div>
--> 


<?php
// $post = new _postings;

$sf  = new _freelancerposting;

// $result = $post->chkProjectStatus($_GET['project']);

$result = $sf->chkProjectStatus1($projid);

//echo $post->ta->sql;

//  echo $sf->ta->sql;


// print_r($result1);

// if($result == false){


if($result == true){
$proData = mysqli_fetch_assoc($result);
?>
<div class="col-sm-12 similar-job about_postbanner" id="files" style="display: none;">
<h2 class="similar-job-h2">Files</h2>
<div class="col-xs-12 dashboardtable no-padding">
<div class="table-responsive">
<table class="table table-stripped">
<thead>
<tr style="font-size: 17px;">
<th>File Name</th>
</tr>
</thead>
<tbody>
<?php
$fileData = selectQ('select * from spfreelancerfile where spPostings_idspPostings = ?', 'i', [$projid]);
if(count($fileData) > 0){
foreach($fileData as $file) {
?>
<tr>
<td >
<a href="<?php echo $file['spPostingFile']; ?>"><?php echo $file['spFileName']; ?></a>
</td>
</tr> <?php
}
}else{ ?> 
<td colspan="3" style="text-align: center;">No Files Found</td>

<?php } 

?>

</tbody>
</table>
</div>
</div>
</div>
<div class="col-sm-12 similar-job about_postbanner" id="bids">
<h2 class="similar-job-h2">Bids</h2>
<div class="col-xs-12 dashboardtable no-padding">
<!-- <div class="table-responsive"> -->
<?php
$sf = new  _freelance_placebid;
$respos = $sf->readallbids_home($projid);
if($respos == true){
while ($row3 = mysqli_fetch_assoc($respos)) {
$d = new _spprofiles;
$freelancerData = $d->readprofileid($row3['spProfiles_idspProfiles']);
$freelancerName = 'Freelancer Removed';
$freelancerPic = $BaseUrl.'/assets/images/icon/blank-img.png';
if($freelancerData == true){
  $freelancerPro = mysqli_fetch_assoc($freelancerData);
  if(isset($freelancerPro['spProfileName'])){
    $freelancerName = $freelancerPro['spProfileName'];
  }
  if(isset($freelancerPro['spProfilePic'])){
    $freelancerPic = $freelancerPro['spProfilePic'];
  }
}
$bidPrice = "";
$totalDays = "";
if($bidPrice == ""){
$bidPrice = $row3['bidPrice'];
}
if($totalDays == ""){
$totalDays = $row3['totalDays'];
}
?>
<div class="row">
  <div class="col-sm-12">
    <div class="card" style="border: 1px solid #000;height: 200px;">
      <div class="card-body" id="cardBody">
        <div class="row">
          <div class="col-md-9" style="margin-top: 30px;">
            <img alt='profilepic' class='img-responsive' src='<?php echo $freelancerPic; ?>' style='width: 40px; height: 40px;' >
            <h3 class="card-title"><a class=" freelancer_capitalize" style="color:#c45508;"
href="<?php echo $BaseUrl.'/freelancer/user-newprofile.php?profile='.$row3['spProfiles_idspProfiles'];?> "><?php echo $freelancerName;?></a></h3>
            <div class="rating-box">
            <?php
              $mr = new _freelance_recomndation;
              $resultsum1 = $mr->readfreelancerating($row3['spProfiles_idspProfiles']);
              $totalreviewrate1 = 0;
              $totalmyreviews1 = 0;
              $starPercentage = 0;
              if($resultsum1 != false){
                $totalmyreviews1 = $resultsum1->num_rows;
                while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
                  $sumrevrating1 += $rowreview1['recomnd_rating'];
                  $rateingarr1[] =  $rowreview1['recomnd_rating'];
                }  
                $count1 = count($rateingarr1);
                $reviewaveragerate1 = $sumrevrating1 / $count1;
                $totalreviewrate1  = round($reviewaveragerate1, 1);
                $starPercentage = ($totalreviewrate1 / 5) * 100;
              }
              echo '<div class="ratings" style="width: ' . $starPercentage . '%;"></div>';
            ?>
            </div>
            <span><?php echo $totalreviewrate1; ?></span>
            <?php
            $letter = $sf->allbids1($row3['spProfiles_idspProfiles'], $projid);
            $cletter = "";
            if($letter == true){
              $response = mysqli_fetch_assoc($letter);
              $cletter = $response['coverLetter'];
            }
            ?>
            <div class="card-text" id="cletter">
            <div class="short-text"  style="display: inline;"><?php echo substr($cletter, 0, 100); ?></div>
            <?php if(strlen($cletter) > 100): ?>
            <button class="btn btn-link see-more-btn" style="display: inline;">See more</button>
            <?php endif; ?>
            <div class="full-text" style="display: none;"><?php echo $cletter; ?></div>
            </div>
            </div>
          <div class="col-md-3" style="margin-top: 30px;height:80%;font-size: larger;">
            <span><?php echo "<strong>".$row['Default_Currency']." ".$bidPrice."</strong>"; if($proData['spPostingPriceFixed'] == 1) { echo"<br> per hour"; } ?></span></br>
            <?php
              $fps = new _freelance_project_status;
              $result5 = $fps->readAceptid($projid, $row3['spProfiles_idspProfiles']);
              if ($result5 == false) { 
                if ($_SESSION["pid"] == $row['spProfiles_idspProfiles']) {
              ?>
                  <button class="btn btn-info" style="margin-top:20px" onclick="awarded_status('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $projid . '&pid=' .  $row3['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Award</button>
            <?php
                } else {
                  echo "<p style='margin-top:20px'>N/A</p>";
                }
              }else {
                $row5 = mysqli_fetch_assoc($result5);
                $fps_sta = $row5['fps_status'];
                echo "<p style='margin-top:20px'>".$fps_sta."</p>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  }
} else { ?> 
<div class="text-center">
    <strong>No Bid Found</strong>
  </div>
<?php } 
?>
<!-- <div class="table-responsive">
<table class="table table-stripped">
<thead>
<tr style="font-size: 17px;">
<th>Freelancer Name</th>
<th>Bid</th>
<th>Days Delivered</th>
<th>Status</th>
</tr>
</thead>
<tbody>



<?php




//$pos = new _postfield;

//  $sf  = new _freelance_placebid;

$sf = new  _freelance_placebid;

// $respos = $pos->totalbids($_GET['project']);

$respos = $sf->readallbids_home($_GET['project']);


//echo $sf->ta->sql;

//echo $sf->ta->sql;


//exit();

// print_r($respos);

if($respos == true){

while ($row3 = mysqli_fetch_assoc($respos)) {

// print_r($row3);
//get bid detail

$d = new _spprofiles;
$freelancerName = $d->getProfileName($row3['spProfiles_idspProfiles']);

//echo $d->ta->sql;

/*$result_pf = $pos->allbids($row3['spProfiles_idspProfiles'], $_GET['project']);*/

/*  $bd = new  _freelance_placebid;

// print_r( $row3['idspPostings']);

$result_pf = $bd->readallbids($_GET['project']);
*/

//echo "here";

// echo $bd->ta->sql;


//  if($result_pf){
$bidPrice = "";
$totalDays = "";

//$row2 = mysqli_fetch_assoc($result_pf);
/*   
echo  "<pre>";
print_r($row2);*/

/* while($row2 = mysqli_fetch_assoc($result_pf)){*/


if($bidPrice == ""){
/*if($row2['spPostFieldName'] == 'bidPrice'){*/
$bidPrice = $row3['bidPrice'];
/*}*/
}
if($totalDays == ""){
/*if($row2['spPostFieldName'] == 'totalDays'){*/
$totalDays = $row3['totalDays'];
/* }*/
}

//} 
/*  print_r($bidPrice);
print_r($totalDays);*/


?>
<tr>
<td >
  <?php if($freelancerName){ ?>
<a class=" freelancer_capitalize" style="color:#c45508;"
href="<?php echo $BaseUrl.'/freelancer/user-newprofile.php?profile='.$row3['spProfiles_idspProfiles'];?> "><?php echo $freelancerName;?></a>
<?php }else{

  echo "Freelancer Removed";
}?>

</td>


<td><?php echo $row['Default_Currency'].' '.$bidPrice;?></td>
<td><?php echo $totalDays;?> Days</td>

<td>
                    <?php
					$fps = new _freelance_project_status;

                    $result5 = $fps->readAceptid($_GET['project'], $row3['spProfiles_idspProfiles']);
                    if ($result5 == false) {
                    if ($_SESSION["pid"] == $row['spProfiles_idspProfiles']) {
                    ?>
                        <!-- <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['project'] . '&pid=' . $row3['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-info">Award</a> -->

                        <!--<button class="btn btn-info" onclick="awarded_status('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['project'] . '&pid=' .  $row3['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Award</button>-->

        

                        <!-- <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=reject&postid=' . $_GET['project'] . '&pid=' . $row3['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-danger">Reject</a> -->

                        <!-- <button class="btn btn-danger" onclick="rejected_status('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=reject&postid=' . $_GET['project'] . '&pid=' .  $row3['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Reject</button> -->




                    <!--<?php
                    } else {
                        echo "N/A";
                    }
                    } else {
                    $row5 = mysqli_fetch_assoc($result5);
                    $fps_sta = $row5['fps_status'];
                    echo $fps_sta;
                    ?>
                    <?php
                    }
                    ?>
                </td>

</tr> <?php
// }
}
}else{ ?> 
<td colspan="3" style="text-align: center;">No Bid Found</td>

<?php } 

?>

</tbody>
</table>
</div>-->
</div>
</div> <?php
} ?>


<!--        <div class="col-xs-12 similar-job about_postbanner">
<?php
//$p = new _postingview;

$sf  = new _freelancerposting;

//print_r($clientId);

// $res = $p->client_publicpost(5, $clientId);

$res = $sf->client_publicpost1(5, $clientId);

//echo $sf->ta->sql;

if($res){
$total = $res->num_rows; ?>
<h2 class="similar-job-h2">Other open jobs by this client(<?php echo $total;?> )</h2>
<?php
while($rows = mysqli_fetch_assoc($res)){ ?>
<span><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$rows['idspPostings'];?>" 
class="freelancer_capitalize">

<?php echo $rows['spPostingTitle'];?></a></span>
<p class="freelancer_capitalize">
<?php
if(strlen($rows['spPostingNotes']) < 200){
echo $rows['spPostingNotes'].'....';
}else{
echo substr($row['spPostingNotes'], 0,200).'....';

} ?>
</p> <?php
}
}
else{ ?>
<h2 class="similar-job-h2">Other open jobs by this client(<?php echo $total;?>)</h2>
<?php 
echo "<center>No Record Found</center>";
}?>

</div> -->
</div>

<div class="col-xs-12 col-sm-3">
<div class="col-xs-12 nopadding ">
<!-- <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$_GET['project'];?>" class="post-job-like-this btn" style="border-radius: 35px;">Post a Job Like this</a>
-->
<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" id="flagform" class="sharestorepos" >
<div class="modal-content proposal_dialogbox">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $projid;?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']; ?>">
<div class="modal-header proposalheader_topborder">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Flag Post</h4>
</div>
<div class="modal-body">
<div class="radio">
<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
</div> 

<!-- <label>Why flag this post?</label> -->
<textarea class="form-control" name="flag_desc" id="flagcomment" placeholder="Add Comments"></textarea>
<span id="flag_desc_err" style="color:red;"></span>
</div>
<div class="modal-footer proposalheader_bottomborder">
<button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Cancel</button>
<input type="button" name="Submit" value="Submit" id="flag_project" class="btn butn_mdl_submit projetproperty_btn">

</div>
</div>
</form>
</div>
</div>

<?php

//print_r($clientId);
//print_r($_SESSION['pid']);





if($clientId != $_SESSION['pid']){

//  $field = new _postfield;

//$sf  = new _freelancerposting;

//print_r($_SESSION['pid']);
//print_r($_GET['project']);



//$chkBidPost = $field->allbids($_SESSION['pid'], $_GET['project']);

$bd  = new _freelance_placebid;



$chkBidPost = $bd->allbids1($_SESSION['pid'], $projid);

//echo $bd->ta->sql;


//print_r($_SESSION['ptid']); die("---");


if($chkBidPost){ ?>
<a href="javascript:void(0);" class="post-job-like-this btn" style="border-radius: 35px;" >Bid Posted Already</a>


<?php
}else if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 2) {

//echo "<pre>"; echo $clientId; print_r($ids2); exit;
?>
<?php if(in_array($clientId, $ids2)) {?>
<a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;">Own Project</a>
<?php } else { ?>

	<?php 

	$sf = new _freelancerposting;

$res = $sf->myBidProject_hide_submit(5, $projid);

if (!empty($res)) {


$row = mysqli_fetch_assoc($res);

   $bid_status = $row['status']; 
	}

if($bid_status == 0){  
	?>

<a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;" data-toggle='modal' data-categoryid='5' data-postid='".$projid."' data-target='#bid-system' data-profileid='".$_SESSION["pid"]."' >Submit a proposal</a> 
<?php } } ?>
<?php
}else{?>
<?php if(in_array($clientId, $ids2)) {?>
<a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;">Own Project</a>
<?php } else { ?>



<?php } ?>
<?php }



}

?>

<div class="col-xs-12 about-client about_postbanner ">
<p class="about-client-heading postbannerheading freelancer_capitalize" style="margin:-1px;">About the Client</p>
<div class="col-xs-12 about-client-content">
<div class="imgFeeBox">
<?php
if ($clientId > 0) {
$result3 = $f->read($clientId);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
// print_r($row3);
if (isset($row3["spProfilePic"])){
echo "<img alt='profilepic' class='img-responsive' src=' " . ($row3["spProfilePic"]) . "' style='width: 40px; height: 40px;' >";
}else{
echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
}
?>
<a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$clientId; ?>" style = "color: #282828;"><?php echo $row3['spProfileName'];?></a>
<!-- <a href="#" class="freelancername"><?php echo $row3['spProfileName'];?></a> -->
<!-- <p><?php echo $row3['spProfileName'];?></p> -->
<?php
}
}
?>


</div>
<?php

$us = new _spuser;
$user = $us->read($_SESSION['uid']);
$user_detail = mysqli_fetch_assoc($user);
// print_r($user_detail['spUserRegDate']);
$member = new DateTime($user_detail['spUserRegDate']);//


?>
<!-- <p class="country"><?php echo $country;?></p> -->
<p><?php echo $totalpost;?> Posted</p>
<!-- <p class="hire-rate">0% Hire Rate, <?php echo $total;?> Open Jobs</p> -->
<p>Member Since <?php echo $member->format('d-m-Y');?> </p>
</div>

</div>
<?php if($clientId != $_SESSION['pid']){ ?>
<div class="col-sm-12 text-center">

<?php

$profid=$_SESSION['pid'];
//print_r($_SESSION);
$uid=$_SESSION['uid'];




$f = new _flagpost;

$id = $f->read_fav_project($profid,$uid,$projid);
//die('444');
//print_r($id);
//$data=mysqli_fetch_assoc($id);
//$res=mysqli_num_rows($data);
if($id->num_rows>0){?>
<span id="favorete_<?php echo $projid; ?>">		
<a onclick="unfavorite1('<?php echo $projid; ?>')" class="icon-favorites fa fa-heart">Unfavorite</a></span>
<?php	//header("location: project-detail.php");
//href="delfav.php?postid=<?php echo $_GET['project']; "
?>
<?php
}
else{?>
<span id="favorete_<?php echo $projid; ?>">
<a onclick="favorete1('<?php echo $projid; ?>','<?php echo $profid; ?>')" 
 class="icon-favorites fa fa-heart-o sp-favorites faa-pulse animated">Favorite</a></span>
<?php	//header("location:project-detail.php");  
//href="addfav.php?postid=<?php echo $_GET['project']; "
?>
<?php } ?>

<?php
$postid=$projid;
$pids=$_SESSION['pid'];
$sp=new _flagpost;
$spflag=$sp->readflag2($pids,$postid);
if($spflag!=false){
?>
<span class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
font-size: 15px;"></i> &nbsp; <a>Flag this post</a></span>

<p id="flags"style="color:red;font-size:15px"></p>
<?php  }	
else{ 		?>
<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="btnFlag_Frelance pull-right" class="pull-right"><i class="fa fa-flag"></i> Flag This Post</a>    

<?php } ?>


<?php
//$title="whatsapp";

$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>	

<div id="social-share" class="mt_d">
<div>
<strong><span>Sharing is caring</span></strong>

<i class="fa fa-share-alt"></i>
</div>
<br>&nbsp;&nbsp;
<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
</div>




</div>



<?php } ?>

<!--<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="pull-right"><i class="fa fa-flag"></i> Flag This Post</a>-->



</div>

<style type="text/css">
	.aand{margin-top: 10px;}
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
    content: "\2605 \0020 \2605 \0020 \2605 \0020 \2605 \0020 \2605";
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
    content: "\2605 \0020 \2605 \0020 \2605 \0020 \2605 \0020 \2605";
  }
</style>

<br><br> 

<div class="col-xs-12 nopadding  freelancer-post-detail about_postbanner aand">
	
	<p><b>Sub Category : </b><?php echo $spPostInSubCategory; ?> </p>
	<p><b>Experience Level : </b><?php echo $spPostExperienceLevl; ?> </p>

	<?php 
   $skill2      = explode(',', $spPostingSkill);
   if($skill2 != ''){
if(count($skill2) >0){
foreach($skill2 as $key => $value){
if($value != ''){
echo "<p><b>Skills : </b> ".$value."</p>";   
}

}
}
}

	?>



	<p><b>Posting date : </b><?php echo date("d-M-Y", $spPostingDate); ?> </p>     
	
</div>

</div>
</div>
</section>

<!-- 
<div id="Notabussiness" class="modal fade" role="dialog">
<div class="modal-dialog"> -->


<!--         <div class="modal-content no-radius sharestorepos bradius-10">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body nobusinessProfile">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Please switch to your bussiness profile to <span>post project.</span></h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
</div>
<div class="modal-footer br_radius_bottom bg-white">
<button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
-->


<!--Bid System on business profile -->
<div class="modal fade" id="bidbusiness-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos proposal_dialogbox">
<div class="modal-header proposalheader_topborder">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>


<h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span>
<!-- <div class="col-md-6">-->


</h3>
</div>




<div class="modal-body nobusinessProfile">
<div style="text-align: center;">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Please switch to your freelancer profile to <span>Submit A Proposal.</span></h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
</div>
</div>


<div class="modal-footer proposalheader_bottomborder">
<!--<button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Close</button>


<button type="submit" id="placebid_button" class="placebid btn btn-submit projetplacebid_btn">ok</button> -->


</div>
</form>   
</div>
</div>
</div>
<!--Bid System on freelancer Post has completed-->


<!--Bid System on freelancer Post-->
<div class="modal fade" id="bid-system" >
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos proposal_dialogbox">
<div class="modal-header proposalheader_topborder">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span>
<p class="activities-on-job pull-right" style="margin-right: 10px"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: <?php echo $row['Default_Currency']; ?>&nbsp;<?php echo $price;?></p>
</h3>
</div>

<form  class="freelancebidform" id="freelancer_placebidform" action="addtoplacebid.php" method="post" >


<div class="modal-body">
<!--Hidden attribute-->

<!-- <?php echo $_GET["project"];?>

<?php echo $_SESSION['pid'];?>

<?php  echo $_SESSION['uid'];?>  -->



<input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $projid;?>">

<input type="hidden" id="spPostFieldBidFlag" value="1">

<input type="hidden" class="freelancercat" value="5">

<input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>"> 

<input class="dynamic-pid" name="idspUserProfiles" type="hidden" value="<?php echo $_SESSION['uid']?>"> 

<!--Complete-->

<?php

$sf  = new _freelancerposting;

//$p = new _postfield;

$res = $sf->readFields1($projid);
// echo $sf->ta->sql;

//print_r($res);

if ($res != false)
{
while($rows = mysqli_fetch_assoc($res))
{
//if($rows["spPostFieldLabel"] == "Closing Date")
$bidclosingdate = $rows["spPostingExpDt"];
//  print_r( $bidclosingdate);
}
}   
?>

<input type="hidden" class="closingdate" value="<?php echo $bidclosingdate;?>" >
<div class="row">
<div class="col-md-6">

<label for="bidPrice" class="lbl_1">Your bid<span class="red_clr">* <span id="bid_err" style="color: red;"></span></span></label>
<div class="input-group " >
<input type="number" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." maxlength="8" min="0" aria-describedby="basic-addon1">
<span class="input-group-addon no-radius" id="basic-addon1">$</span>
</div><br>
</div>
<div class="col-md-6">
<label for="totalDays" class="lbl_3">Timeline<span class="red_clr">* <span id="days_err" style="color: red;"></span></span></label>
<div class="input-group" >
<input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
<span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
</div><br>
</div>
<!--  <div class="col-md-6">
<label for="initialPercentage" class="lbl_2">Upfront<span class="red_clr">*</span></label>
<div class="input-group" >
<input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
<span class="input-group-addon no-radius" id="basic-addon2">20-100%</span>
</div><br>
</div> -->
<!--     <div class="col-md-12">
<label for="totalDays" class="lbl_3">In how many days can you deliver a completed project?<span class="red_clr">*</span></label>
<div class="input-group" >
<input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
<span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
</div><br>
</div> -->
<div class="col-sm-12">
<div class="form-group" >

<label for="bidPrice" class="lbl_4">SUBMIT PROPOSAL<span class="red_clr">* <span id="cover_err" style="color: red;"></span></span></label>
<textarea class="form-control activity" id="coverLetter" name="coverLetter" placeholder="Write an attracive proposal to win the bid"></textarea>

</div>
</div>
</div>

</div>


<div class="modal-footer proposalheader_bottomborder">

<button type="button" id="placebid_button" class="btn btn-submit projetplacebid_btn" data-postid="<?php echo $projid; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $_GET['categoryID']; ?>" style="background-color: #f7a206!important;">Place Bid</button>


</div>
</form>   
</div>
</div>
</div>
<!--Bid System on freelancer Post has completed-->


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<script>
$(document).ready(function(){
  $(document).on("click", ".activity-on-this-job", function(event){
    event.preventDefault();
    var target = $(this).attr("href");
    $(".similar-job").hide();
    $(target).show();
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var seeMoreBtns = document.querySelectorAll('.see-more-btn');
  seeMoreBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var cardText = this.parentNode;
      var shortText = cardText.querySelector('.short-text');
      var fullText = cardText.querySelector('.full-text');

      shortText.style.display = 'none';
      fullText.style.display = 'block';
      this.disabled = true;
      this.style.display = 'none';
    });
  });
});
</script>
<script>
function unfavorite1(postid){
   // alert('11');
$.post(MAINURL + "/social/deletefavoritesfreelancer.php", {
'postid': postid

}, function (response) { 
   // alert('22');
$("#favorete_"+ postid).html('<span id="favorete"><a onclick="favorete1('+postid+','+<?php echo $profid;  ?>+')" style=" text-align:left;"  class="icon-favorites fa fa-heart-o ">Favorite</a></span>');
});
}
function favorete1(postid,pid){
   // alert('33');
$.post(MAINURL + "/social/addfavoritesfreelancer.php", {
'postid': postid,
'pid':pid
}, function (response) { 
   // alert('44');
$("#favorete_"+ postid).html('<span id="unfavorite">	<a onclick="unfavorite1('+postid+')" style=" text-align:left;"  class="icon-favorites fa fa-heart">Unfavorite</a></span>');
});
}
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function awarded_status(url) {

Swal.fire({
  title: 'Are You Sure You Want to Award?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Accepted it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = url;
  }
});

}
//rejected swal it..
function rejected_status(url) {

Swal.fire({
  title: 'Are You Sure You Want to rejected?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, rejected it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = url;
  }
});

}
</script>
<script type="text/javascript">
function flags(){
document.getElementById('flags').innerText='you have already flagged this post from another profile';
}

</script>
<script type="text/javascript">


$(document).ready(function(e){
// Submit form data via Ajax
/* $("#freelancer_placebidform").on('submit', function(e){*/
$("#placebid_button").on('click', function(){


/* alert();*/

var  bidprice = $('#bidPrice').val();
var  totalDays = $('#totalDays').val();
var  coverLetter = $('#coverLetter').val();


//alert(bidprice);

if(bidprice == "" && totalDays == "" && coverLetter == ""){

$('#bid_err').text("Please enter Bid Price");
$('#days_err').text("Please enter Timeline");
$('#cover_err').text("Please enter Cover letter");

/* return false;
*/

}else if(bidprice == "" ){

$('#bid_err').text("Please enter Bid Price");
/* return false;*/


}else if(totalDays == ""){


$('#days_err').text("Please enter Timeline");
$('#bid_err').text("");
/*return false;*/


}else if(coverLetter == ""){


$('#days_err').text("");
$('#bid_err').text("");
$('#cover_err').text("Please enter Cover letter");
/*   return false;*/



}else{



$("#freelancer_placebidform").submit();

}


});



$("#flag_project").on('click', function(){


/* alert();*/

var  flagcomment = $('#flagcomment').val();


//alert(bidprice);

// if(flagcomment == "" ){

// $('#flag_desc_err').text("Please Enter Comment");


// /* return false;
// */

// }else{

// $("#flagform").submit();
// }


});










});


/*$(document).ready(function(e){
// Submit form data via Ajax
$("#freelancer_placebidform").on('submit', function(e){

var  bidprice = $('#bidPrice').val();
var  totalDays = $('#totalDays').val();
var  coverLetter = $('#coverLetter').val();



e.preventDefault();
$.ajax({
type: 'POST',
url: 'addtoplacebid.php',
data: new FormData(this),
processData: false,
contentType: false,


beforeSend: function(){

$('#placebid_button').attr("disabled","disabled");
$('#freelancer_placebid').css("opacity",".5");
},

success: function(response){ 

window.location.reload();
//console.log(data);




}
});


});
});*/

</script>

<!-- <script>
$("#freelancer_placebid").on("click", function () {
alert();



var bid= $('#bidPrice').val();
alert(bid);
var percentage = $('#initialPercentage').val();
alert(percentage);

var days = $('#totalDays').val();
alert(days);
var letter = $('#coverLetter').val();
alert(letter);


//alert(description.length);


if (bid == "" && percentage == "" && days == "" && letter == "") {

$(".lbl_1").addClass("label_error");
$(".lbl_2").addClass("label_error");
$(".lbl_3").addClass("label_error");
$(".lbl_4").addClass("label_error");

return false;
}
else if(bid == ""){
$(".lbl_1").addClass("label_error");
return false;
}
else if(percentage == ""){
$(".lbl_2").addClass("label_error");
return false;
}else if(days == ""){
$(".lbl_3").addClass("label_error");
return false;
}else if(letter == ""){
$(".lbl_4").addClass("label_error");
return false;
}
else{
swal({                     

title: "<img src='../../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
text:  "<b>Posted Successfully. </b>",
html: true,


showConfirmButton: true

},

function() {
$("#freelancer_bidform").submit();
alert();

window.location = "<?php echo $BaseUrl;?>/freelancer/project-detail.php";
}

}
});

</script> -->

<?php
} ?>