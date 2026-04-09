<?php 
include('../univ/baseurl.php');
session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$f = new _spprofiles;
$sl = new _shortlist;

//check profile is freelancer or not
$chekIsFreelancer = $f->readfreelancer($_SESSION['uid']);
if($chekIsFreelancer == false){
header('location:'.$BaseUrl.'/my-profile/');
}
$_GET['categoryID'] = 5;

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/links.php');?>

<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->

</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectdetails">
<p class="back-to-projectlist">
<a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>"><i class="fa fa-chevron-left"></i>Back to Project list</a>
</p>
<div class="col-xs-12 col-sm-9 nopadding">
<?php
$p = new _postingview;
$res = $p->singletimelines($_GET['project']);
//echo $p->ta->sql;
if($res){
$row = mysqli_fetch_assoc($res);
$title = $row['spPostingtitle'];
$overview = $row['spPostingNotes'];
$country = $row['spPostingsCountry'];
$city = $row['spPostingsCity'];
$price = $row['spPostingPrice'];
$dt = new DateTime($row['spPostingDate']);
$member = new DateTime($row['spProfileSubscriptionDate']);
$clientId = $row['idspProfiles'];
$postedPerson = $row['spUser_idspUser'];


$pf = new _postfield;

$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$closingdate = "";
$Fixed = "";
$Category = "";
$hourly = "";
$skill = "";
$projectType = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($closingdate == ''){
if($row2['spPostFieldName'] == 'spClosingDate_'){
$closingdate = $row2['spPostFieldValue']; 
}
}
if($Fixed == ''){
if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
if($row2['spPostFieldValue'] == 1){
$Fixed = "Fixed Price";
}
}
}
if($Category == ''){
if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue']; 
}
}
if($hourly == ''){
if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
if($row2['spPostFieldValue'] == 1){
$hourly = "Rate Per hour";
}
}
}
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

$postingDate = $p->get_timeago(strtotime($row["spPostingDate"]));


}
} ?>
<div class="col-xs-12 freelancer-post-detail">
<h2 class="designation-haeding"><?php echo $title;?></h2>
<p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
<div class="col-xs-12 nopadding">
<?php
if (isset($skill)) {

if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags'>".$value."</span>";
}

}
}
}
?>

</div>
<div class="col-xs-12 nopadding margin-top-13">
<div class="col-xs-12 col-sm-6 nopadding">
<div class="col-xs-2 col-sm-1 nopadding">
<img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
</div>
<div class="col-xs-10 col-sm-11 nopadding">
<p><span class="time-level">Category</span>
</p>
<p class="time-level-detail"><?php echo $Category;?></p>

</div>
</div>
<div class="col-xs-12 col-sm-6 nopadding">
<div class="col-xs-2 col-sm-1 nopadding">

</div>
<div class="col-xs-10 col-sm-11 nopadding">
<p><span class="time-level">Price ($<?php echo $price;?>)</span>
</p>

</div>
</div>
</div>
<div class="col-xs-12 detail-description text-center">
<p><?php echo $overview;?></p>
<a href="javascript:void(0);" class="btn activity-on-this-job">Activity on this Job</a>
</div>
<div class="col-xs-12 col-sm-4 padding-5">
<?php 
$po = new _postfield;
$bids = $po->totalbids($_GET['project']);
//echo $po->ta->sql;
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
$result2 = $sl->getshortlist($_GET['project']);
//echo $sl->ta->sql;
if($result2){
$interview = $result2->num_rows;
}else{
$interview = 0;
}
?>
<p class="activities-on-job">Interviewing: <?php echo $interview; ?></p>
</div>
<div class="col-xs-12 col-sm-4 padding-5">
<p class="activities-on-job"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p>
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
$post = new _postings;
$result = $post->chkProjectStatus($_GET['project']);
//echo $post->ta->sql;
if($result == false){
?>

<div class="col-md-12 similar-job">
<h2 class="similar-job-h2">Bids</h2>
<div class="col-xs-12 dashboardtable no-padding">
<div class="table-responsive">
<table class="table text-center tbl_activebid">
<thead>
<tr>
<th>Freelancer Name</th>
<th>Bid</th>
<th>Days Delivered</th>
</tr>
</thead>
<tbody>
<?php
$pos = new _postfield;
$respos = $pos->totalbids($_GET['project']);
//echo $p->ta->sql;
if($respos){
while ($row3 = mysqli_fetch_assoc($respos)) {
//get bid detail

$d = new _spprofiles;
$freelancerName = $d->getProfileName($row3['spProfiles_idspProfiles']);

$result_pf = $pos->allbids($row3['spProfiles_idspProfiles'], $_GET['project']);
//echo $p->ta->sql;
if($result_pf){
$bidPrice = "";
$totalDays = "";

while($row2 = mysqli_fetch_assoc($result_pf)){
if($bidPrice == ""){
if($row2['spPostFieldName'] == 'bidPrice'){
$bidPrice = $row2['spPostFieldValue'];
}
}
if($totalDays == ""){
if($row2['spPostFieldName'] == 'totalDays'){
$totalDays = $row2['spPostFieldValue'];
}
}

} ?>
<tr>
<td ><a class="red" href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row3['spProfiles_idspProfiles'];?>"><?php echo $freelancerName;?></td>
<td>$<?php echo $bidPrice;?></td>
<td><?php echo $totalDays;?> Days</td>
</tr> <?php
}
}
} ?>

</tbody>
</table>
</div>
</div>
</div> <?php
} ?>


<div class="col-xs-12 similar-job">
<?php
$p = new _postingview;
$res = $p->client_publicpost(5, $clientId);
//echo $p->ta->sql;
if($res){
$total = $res->num_rows; ?>
<h2 class="similar-job-h2">Other open jobs by this client ( <?php echo $total;?> )</h2>
<?php
while($rows = mysqli_fetch_assoc($res)){ ?>
<span><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$rows['idspPostings'];?>"><?php echo $rows['spPostingtitle'];?></a></span>
<p>
<?php
if(strlen($rows['spPostingNotes']) < 200){
echo $rows['spPostingNotes'].'....';
}else{
echo substr($row['spPostingNotes'], 0,200).'....';

} ?>
</p> <?php
}
}
?>

</div>
</div>

<div class="col-xs-12 col-sm-3">
<div class="col-xs-12 nopadding">
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$_GET['project'];?>" class="post-job-like-this btn">Post a Job Like this</a>

<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" class="sharestorepos">
<div class="modal-content no-radius">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['project'];?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']; ?>">
<div class="modal-header">
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
<textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
</div>
<div class="modal-footer">
<input type="submit" name="" class="btn butn_mdl_submit ">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>
</div>
</div>

<?php
if($_SESSION['uid'] != $postedPerson){
$field = new _postfield;
$chkBidPost = $field->allbids($_SESSION['pid'], $_GET['project']);
if($chkBidPost){ ?>
<a href="javascript:void(0);" class="submit-a-proposal btn"  >Already Post Bid</a><?php
}else{
?>
<a href="javascript:void(0);" class="submit-a-proposal btn" data-toggle='modal' data-categoryid='5' data-postid='".$_GET["project"]."' data-target='#bid-system' data-profileid='".$_SESSION["pid"]."' >Submit a proposal</a><?php
}
}
?>

<div class="col-xs-12 about-client">
<p class="about-client-heading">About the Client</p>
<div class="col-xs-12 about-client-content">
<p class="country"><?php echo $country;?></p>

<p><?php echo $total;?> Job Posted</p>
<p class="hire-rate">0% Hire Rate, <?php echo $total;?> Open Jobs</p>
<p>Member Since <?php echo $member->format('d-m-Y');?> </p>
</div>
</div>
<div class="col-md-12 text-center">
<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="btnFlag_Frelance" ><i class="fa fa-flag"></i> Flag This Post</a>    
</div>





</div>
</div>
</div>
</section>


<!--Bid System on freelancer Post-->
<div class="modal fade" id="bid-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span></h3>
</div>
<form method="post" class="freelancebidform">
<div class="modal-body">
<!--Hidden attribute-->
<input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET["project"];?>">

<input type="hidden" id="spPostFieldBidFlag" value="1">

<input type="hidden" class="freelancercat" value="5">

<input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>"> 
<!--Complete-->
<?php
$p = new _postfield;
$res = $p->readfield($_GET["project"]);
if ($res != false)
{
while($rows = mysqli_fetch_assoc($res))
{
if($rows["spPostFieldLabel"] == "Closing Date")
$bidclosingdate = $rows["spPostFieldValue"];
}
}   
?>
<input type="hidden" class="closingdate" value="<?php echo $bidclosingdate;?>" >
<div class="row">
<div class="col-md-6">
<label for="bidPrice" class="contact">Your bid</label>
<div class="input-group " >
<input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." aria-describedby="basic-addon1">
<span class="input-group-addon no-radius" id="basic-addon1">$</span>
</div><br>
</div>
<div class="col-md-6">
<label for="initialPercentage" class="contact">Upfront</label>
<div class="input-group" >
<input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0">
<span class="input-group-addon no-radius" id="basic-addon2">20-100%</span>
</div><br>
</div>
<div class="col-md-12">
<label for="totalDays" class="contact">In how many days can you deliver a completed project?*</label>
<div class="input-group" >
<input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0">
<span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
</div><br>
</div>
<div class="col-md-12">
<div class="form-group" >
<label for="bidPrice" class="contact">Cover Letter</label>
<textarea class="form-control activity" id="coverLetter" name="coverLetter" placeholder="Type Cover Letter..."></textarea>
</div>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" class="placebid btn btn-primary btn-border-radius" data-postid="<?php echo $_GET["postid"]; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $catid; ?>">Place Bid</button>
</div>
</form>   
</div>
</div>
</div>
<!--Bid System on freelancer Post has completed-->
<?php 
include('../component/footer.php');
include('../component/btm_script.php'); 
?>
</body>
</html>
