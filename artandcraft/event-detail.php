<?php 
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "photos/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = 9;
if(isset($_GET['postid']) && $_GET['postid'] > 0){

$p = new _postingview;
$pf  = new _postfield;

$result = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);
$ProTitle   = $row['spPostingtitle'];
$ProDes     = $row['spPostingNotes'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];

$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
if($result3 == 0){
$level = '1st Connection';
}else if($result3 == 1){
$level = '1st Connection';
}else if($result3 == 2){
$level = '2nd Connection';
}else if($result3 == 3){
$level = '3rd Connection';
}else{
$level = '';
}

$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$venu = "";
$startDate = "";
$endDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";
$eventcategory = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($eventcategory == ''){
if($row2['spPostFieldName'] == 'eventcategory_'){
$eventcategory = $row2['spPostFieldValue'];

}
}
if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($endDate == ''){
if($row2['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row2['spPostFieldValue'];

}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue'];

}
}
if($OrganizerName == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgName_'){
$OrganizerName = $row2['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}
}

//rating
$r = new _sppostrating;
$res = $r->read($_SESSION["pid"],$_GET["postid"]);
if($res != false){
$rows = mysqli_fetch_assoc($res);
$rat = $rows["spPostRating"];
}else{
$rat = 0;
}

$result = $r->review($_GET["postid"]);
if($result != false){
$total = 0;
$count = $result->num_rows;
while($rows = mysqli_fetch_assoc($result)){
$total += $rows["spPostRating"];
}
$ratings = $total/$count;
}else{
$ratings = 0;
}
$r = new _sppostreview;
$result = $r->review($_GET["postid"]);
if($result != false)
{
$rows = mysqli_fetch_assoc($result);
$review = $result->num_rows;
}
else
$review = 0;
}else{
$re = new _redirect;
$redirctUrl = "../photos";
$re->redirect($redirctUrl);
//header('location:../photos/');
}



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<script>
function checkqty(txb) {
//alert(txb.value);
var qty = txb.value;
if(qty < 1){
txb.value = "1";
}
}
</script>
</head>

<body class="bg_gray">
<?php 
$header_photo = "header_photo";
include_once("../header.php");
?>
<section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>
</div>
</section>  
<!--Write Reviews-->
<div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../review/addreview.php" method="POST" class="sharestorepos">
<input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']?>"/>
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
<input type="hidden" name="spPostRating" id="spPostRating" value="<?php echo $rat;?>">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="exampleModalLabel"><b>Write Review</b></h3>
</div>
<div class="modal-body">
<?php
if(isset($folder)){
$_SESSION['folder'] = $folder;
}else{
$_SESSION['folder'] = "photos";
}
?>
<div class="form-group">
<textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..." rows="5"></textarea>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary writereview btn-border-radius">Add Review</button>
</div>
</form>
</div>
</div>
</div>
<!--Reviews Complete-->
<div class="space"></div>
<section class="m_btm_40">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/events';?>">Events</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo $ProTitle;?></li>
</ol>
</nav>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="detialBox">
<?php
$pic = new _postingpic;
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive img-big' src=' " . ($pic2) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive img-big'>";
}

?>

<div class="btmartBox">
<ul class="social">
<li><a href="javascrpit:void(0)" class="addtoboard" data-postid="<?php echo $_GET['postid']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive">Add to Board</a></li>

<li><a href="<?php echo ($pic2);?>" download="event-gallery.png"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive">Download Composition</a></li>
<li><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive">Share</span></a></li>
</ul>
</div>
</div>
</div>
<div class="col-md-6">
<div class="detailBoxRight">
<h2><?php echo $ProTitle;?></h2>
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
<tr>
<td>Reference</td>
<td><?php echo "Art-00".$_GET['postid'];?></td>
</tr>
<tr>
<td>Artist</td>
<td><a class="title" href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>"><?php echo $ArtistName;?></a></td>
</tr>
<tr>
<td>Category</td>
<td><?php echo $eventcategory; ?></td>
</tr>
<tr>
<td>Country</td>
<td><?php echo $country; ?></td>
</tr>
<tr>
<td>Location</td>
<td><?php echo $city; ?></td>
</tr>

<tr>
<td>Start Date</td>
<td><?php echo $startDate; ?></td>
</tr>
<tr>
<td>End Date</td>
<td><?php echo $endDate; ?></td>
</tr>
<tr>
<td>Start Time</td>
<td><?php echo date("h:i A", $dtstrtTime); ?></td>
</tr>
<tr>
<td>End Time</td>
<td><?php echo date("h:i A", $dtendTime); ?></td>
</tr>

</tbody>
</table>
</div>


<hr>
<div class="space"></div>
<span class="price"> <span class="purple"><?php echo ($price == '')?'Free Download': '$'.$price;?></span></span>
<div class="row reviewdetail">
<p>
<fieldset id='postrating' class="rating">
<input class="stars" type="radio" id="star5" name="rating" value="5" />
<label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
<input class="stars" type="radio" id="star4" name="rating" value="4" />
<label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
<input class="stars" type="radio" id="star3" name="rating" value="3" />
<label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
<input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" />
<label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
<input class="stars" type="radio" id="star1" name="rating" value="1" />
<label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>


</p>
<p class="col-md-12">
<?php  echo "Rating: <span id='rate'>".round($ratings,2)."</span>"; ?>
</p>
</div>
<form action="../cart/addorder.php" method="post">
<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET['postid'];?>">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'];?>">                                    
<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo ($price>0)?$price:'0';?>">
<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php echo $ArtistId;?>">

<?php
$buyerid = $_SESSION['pid'];
$od = new  _order;
$res = $od->checkorder($_GET["postid"] , $buyerid);
if ($res != false){ ?>
<button type="button" class="btn btn_morePhoto disabled btn-border-radius" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Added to cart</button>
<?php
//echo "<button type='button' class='btn btn_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Added to cart</button>";
}else{ ?>
<button type="submit" class="btn btn_morePhoto btn-border-radius" id="addtocart" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  <?php echo ($price > 0)?'Buy Ticket':'Free Ticket';?></button>
<?php
//echo "<button type='submit' class='btn btn_cart".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Add to cart</button>";
}
?>
<a href="<?php echo $BaseUrl.'/photos/enquiry.php?event='.$_GET["postid"];?>" class="btn btn_morePhoto btn-border-radius">Enquiry</a>

</form>

</div>
</div>
</div>
<div class="space-lg"></div>


<div class="row">
<div class="col-md-12">
<div class="fulmainarttab">
<ul class='nav nav-tabs' id='navtabart' style="width: 55%">
<li role="presentation" class="active"><a href="#aboutArtist" aria-controls="home" role="tab" data-toggle="tab">About Artist</a></li> 
<li role="presentation"><a href="#aboutWork" aria-controls="home" role="tab" data-toggle="tab" >About the work</a></li>


<li role="presentation"><a href="#aboutart" aria-controls="home" role="tab" data-toggle="tab">Art Gallery</a></li>                                
</ul>
<div class="linebtm"></div>
</div>
</div>
<div class="col-md-12">
<div class="tab-content no-radius otherTimleineBody m_top_20">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active" id="aboutArtist">
<div class="row">
<div class="descbOx">
<div class="col-md-2">
<?php
if(isset($ArtistPic)){ ?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>">
<img src=" <?php echo ($ArtistPic);?>" class="img-responsive">
</a> <?php
}else{ ?>
<img src="../img/noman.png" class="img-responsive">
<?php
}
?>
</div>
<div class="col-md-10">
<h2><a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>"><?php echo $ArtistName; ?></a> <small><?php echo $level;?></small></h2>
<p><?php echo $ArtistAbout;?></p>
</div>
</div>
</div>
</div>
<!--About the art-->
<div role="tabpanel" class="tab-pane" id="aboutWork">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<h3>About the work</h3>
<p><?php echo $ProDes;?></p>
</div>
</div>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="videoReview">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<h3>Video</h3>
<div class="row">
<?php
$media = new _postingalbum;
$result = $media->read($_GET['postid']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if($sppostingmediaExt == 'mp4'){ ?>
<div class="col-md-offset-3 col-md-6">
<div style='margin-left:15px;margin-right:15px;'>
<video  style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
</video>
</div>
</div>
<?php
}
} ?>
</div>
</div>
</div>
</div>
</div>
<!--Reviews-->
<div role="tabpanel" class="tab-pane " id="aboutReview">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<?php
$r = new _sppostrating;
$res = $r->read($_SESSION["pid"],$_GET["postid"]);
if($res != false){
$rows = mysqli_fetch_assoc($res);
$rat = $rows["spPostRating"];
}else{
$rat = 0;
}
?>

<div class="Review_box">
<h3>All Reviews</h3>
<?php
$r = new _sppostreview;
$result = $r->review_profile($_GET["postid"]);
//echo $r->ta->sql;
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
?>
<div class="row mainreview no-margin">
<div class="col-md-1 no-padding-left">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['idspProfiles']; ?>">
<?php
if(isset($rows['spProfilePic'])){
echo "<img  alt='Profile Pic' class='img-responsive reviewImg' src=' ".($rows['spProfilePic'])."' >" ;
}else{
echo "<img  alt='Profile Pic' class='img-responsive reviewImg' src='../img/no.png' >" ;
}

?>
</a>
</div>
<div class="col-md-11">
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['idspProfiles']; ?>"><?php echo $rows['spProfileName']?></a></h3>
<p><?php echo $rows['spPostReviewText']?></p>
</div>
</div>
<?php
}
}
?>
</div>

</div>
</div>
</div>
</div>
<!--About the art-->
<div role="tabpanel" class="tab-pane" id="aboutart">
<div class="row">
<div class="">
<div class="col-md-12">
<h3>Art Gallery</h3>
</div>
<?php
$p = new _postingview;
$pf  = new _postfield;

$res = $p->joinEvent($_GET['postid']);
//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 
?>
<div class="col-md-3">
<div class="artBox">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>">

<?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";

} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 80){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,80)."...";

} ?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
echo '<span class="price">$ '.$row['spPostingPrice'].'</span>';
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul class="social">
<li><a href="javascrpit:void(0)" class="addtoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>
<!-- <li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li> -->
<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>
<li><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Add to cart"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-cart.png" alt="" class="img-responsive"></a></li>


</ul>
</div>
</div>
</div> <?php

}
}else{
echo "<p>No Art Join</p>";
}
?>


</div>
</div>
</div>


</div>    
</div>
</div>
</div>
</section>
<section class="section_event_art">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Artist <span>Accessories</span> <a href="<?php echo $BaseUrl.'/photos/artist-product.php?cat=1&artist='.$ArtistId;?>" class="pull-right">View All</a></h2>
</div>                    
</div>
<div class="row">
<?php
$p = new _postingview;
$result4 = $p->artistPost($ArtistId, 13);
if($result4 != false){
while ($row4 = mysqli_fetch_assoc($result4)) { ?>
<div class="col-md-3">
<div class="artistAcce">
<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row4['idspPostings'];?>">
<?php
$pic = new _postingpic;
$res2 = $pic->read($row4['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>

<?php
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>

<?php
} ?>
</a>

<?php
//posting fields
$result_pf = $pf->read($row4['idspPostings']);
if($result_pf){
$catName = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($catName == ''){
if($row2['spPostFieldName'] == 'photos_'){
$catNamee = $row2['spPostFieldValue'];
}
}
}
}
?>

<a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row4['idspPostings'];?>"><?php echo $row4['spPostingtitle'];?></a>
<hr>
<p class="price"><?php echo ($row4['spPostingPrice'] == '')? 'Free':'$'.$row4['spPostingPrice'];?> <span class="pull-right"><a href="<?php echo $BaseUrl.'/photos/detail.php?postid='.$row4['idspPostings'];?>"><i class="fa fa-shopping-cart"></i></a></span></p>
</div>
</div> <?php
}
}

?>


</div>
</div>

</section>
<section class="sameCate">
<div class="container">

<div class="row">
<div class="col-md-12 heading">
<h2>Keyword</h2>
</div>  
</div>
<div class="row keywordbox no-margin ">
<?php
$m = new _subcategory;
$catid = 13;
$result = $m->read($catid);
$p = new _postingview;
$masterid = 14;
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
$count = 0;
$res = $p->sameCategoryPic($rows["idsubCategory"], 13);
if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}

?>
<div class="col-md-3 no-padding">
<a href="<?php echo $BaseUrl.'/photos/shop-top-category.php?catName='.$rows['idsubCategory'];?>" class=""><?php echo $rows["subCategoryTitle"];?> <span>(<?php echo $count;?>)</span></a>
</div>
<?php
}
}
?>


</div>
</div>
</section>
<?php include('postshare.php');?>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
}
?>