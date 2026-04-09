<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="my-posts/";
}
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_GET['pid']) && $_GET['pid'] > 0){
$pid = (int)$_GET['pid'];
$pr = new _spprofiles;
$res2 = $pr->read($pid);
if ($res2) {
$row2 = mysqli_fetch_assoc($res2);
if ($row2['spDynamicWholesell'] != '') {
$StoreName = $row2['spDynamicWholesell'];
}else{
$StoreName = $row2['spProfileName'];
}


}

} else {
  $pid = 0;
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<style>
.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	/* border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE; */
}

.list-item h4 {
	color: #15b95b;
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
	background-color: #07d35f;
	border-color: #07d35f;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #0f8f46;
}

</style>
</head>

<body class="bg_gray">
<?php
//this is for store header
$header_store = "header_store";
include_once("../header.php");            
?>
<section class="main_box">
<div class="container">
<div class="row">
<div class="col-md-2 no-padding">
<div class="left_store left_sidebar">

<h1>WHOLESALE:</h1>
<?php  
$p = new _postingview;
$res = $p-> mywholesellpost($pid, 1);

if($res != ""){ 
$wholasalecount = mysqli_num_rows ($res);
?>
<h5><b><?php echo $StoreName; ?> Store <?php echo " (".$wholasalecount.")";?></b> </h5>

<?php  }

?>


<span class="top_sharepage text-center">@sharepagestore</span>
<br>
<div class="btn-group categorydrp" role="group" >
<span  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span data-placement="bottom" style="text-transform: capitalize;">Stores <span class="caret"></span></span></span>
<ul class="dropdown-menu no-padding">
<li id="mystore"><a href="<?php echo $BaseUrl; ?>/my-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-suitcase"></span> My Store</a></li>
<li id="grouppost"><a href="<?php echo $BaseUrl; ?>/private-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-users"></span> Groups Store</a></li>
<li id='friendstore'><a href="<?php echo $BaseUrl; ?>/friend-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-user-plus "></span> Friend's Store</a></li>
<li id="publicpost"><a href="<?php echo $BaseUrl; ?>/store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-globe"></span> Public Store</a></li>
<li id="publicpost"><a href="<?php echo $BaseUrl; ?>/retail/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-globe"></span> Retail Store</a></li>
<?php
//session_start();
$p = new _spprofiles;
$res = $p->readProfiles($_SESSION["uid"]);
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
if (isset($rows["spDynamicWholesell"])){
$folder = $rows["spDynamicWholesell"];
$profileType = $rows['spProfileType_idspProfileType'];
}
$profileid = $rows["idspProfiles"];
}
}
if ($profileType == 1){
echo "<li id='wholesell'><a href='" . $BaseUrl . "/wholesale' class='stores' data-profileid='" . $_SESSION["pid"] . "' id='wholesaler'><span class='fa fa-cart-plus '></span> Wholesaler Store</a></li>";
}
?>
</ul>
</div>
<h3 class="heading04" style="text-transform: capitalize;">Categories</h3>
<?php
$p = new _postfield;
$catid = 1;
$result2 = $p->readlabel($catid);
//echo $p->ta->sql;
if ($result2 != false){
$catCount = 0;
$folder= "wholesale";
while($row2 = mysqli_fetch_assoc($result2)){
if($row2['spPostFieldLabel'] == 'Subcategory'){
if($catCount == 0){
?>
<ul class="left_store_bar"><?php
$values = $p->readvalues($catid, $row2['spPostFieldLabel']);
//echo $p->ta->sql;
if($values != false){
while($vals = mysqli_fetch_assoc($values)){
$fieldValue = str_replace(' ', '_', $vals["spPostFieldValue"]);
$FinalTitle = str_replace('&', '-', $fieldValue);
?>
<li><a href="<?php echo $BaseUrl.'/'.$folder.'/category.php?catName='.$FinalTitle;?>"><i class="fa fa-chevron-right"></i> <?php echo $vals["spPostFieldValue"];?></a></li>
<?php
}
}
?>
</ul>
<?php
}
}
}
} ?>
<div class="space"></div>


</div>
</div>
<div class="col-md-10" >
<div class="row no-margin">
<div class="col-md-12 no-padding">
<div class="top_banner">
<img src="<?php echo $BaseUrl;?>/assets/images/icon/store/cover/cover.jpg" class="img-responsive" alt="" />
</div>
</div>
</div>
<div class="retail_level_two m_btm_10 banner_btn">
<div class="row">
<div class="col-md-6">
<!-- <a href="#" class="notify">Follow <i class="fa fa-rss"></i></a> -->
<!--
<a href="#" class="notify">Notification <img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/tick.png" class="img-responsive" ></a>
<a href="#" class="notify">Recommend <i class="fa fa-commenting"></i></a>
<a href="#" class="notify"><i class="fa fa-ellipsis-h"></i></a>-->
</div>
<style>



</style>
<div class="col-md-6 text-right">
<a href="<?php echo $BaseUrl?>/store/storeindex.php?folder=home" class="btn butn_draf btn-border-radius" style="background-color: #0f8f46;" >Store Home</a>

<!-- <a href="<?php echo $BaseUrl?>/retail" class="btn butn_draf " style="background-color: #0f8f46;" >Retail</a> -->
<?php if($_SESSION['guet_yes']!='yes'){?>
<a href="<?php echo $BaseUrl.'/store/dashboard';?>" class="btn btn_st_dash btn-border-radius " style="background-color: #0f8f46;" >Dashboard</a>
<?php } ?>
<a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn btn_st_post text-right btn-border-radius"style="background-color: #0f8f46;">Sell Product</a>


</div>
</div>
</div>

<div class="row" style="min-height: 400px;">
<div class="col-md-12 list-wrapper">
<?php
$p = new _postingview;
$res = $p-> mywholesellpost($pid, 1);
//wholesale store
// $res = $p->allwholesellpost();
//echo $p->ta->sql;
//die('=============');
//die('wwwww=============');
if($res){
    //die('=============');
while ($rows = mysqli_fetch_assoc($res)) {

$SellName   = $rows['spProfileName'];
$SellEmail  = $rows['spProfileEmail'];
$SellPhone  = $rows['spProfilePhone'];
$SellAdres  = $rows['spprofilesAddress'];
$SellCity   = $rows['spProfilesCity'];
$SellCounty = $rows['spProfilesCountry'];
$SellId     = $rows['idspProfiles'];




?>
<div class="col-xs-5ths list-item">
<div class="featured_box " style="height: 310px !important;">

<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
<?php
$pic = new _postingpic;
$result = $pic->read($rows['idspPostings']);
if($result){
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' style='height: 100%;  width: 100%;' class='img-responsive' src=' " . ($picture) . "' >";
}else{
echo "<img alt='no-image' style='height: 100%;  width: 100%;' class='img-responsive' src='../img/no.png' />";
}
?>

</a>
</div>
<ul style="padding-left: 10px;display: grid;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px;">
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;"><?php echo ucwords(strtolower($rows['spPostingtitle']));?>
</a> <span class="pull-right"><?php echo $rows['default_currency'] . " " . $rows['spPostingPrice']; ?>
 / Piece</span></h4>
</li>
<li>
<p class="black_clr"><?= $rows['minorderqty'] ? $rows['minorderqty'] : "0" ?> Pieces <span>(min. order)</span>
</p>

</li>
<li>
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" class="anchor_default">View Detail</a>   
</li>                                      
</ul>
</div>

</div>



<?php
}
}
?>





</div>
<div id="pagination-container"></div>
<!--
<div class="col-md-3 no_pad_left_right">
<div class="seller_info">
<div class="row no-margin">
<div class="col-md-2 no-padding">
<?php
$p = new _spprofiles;
$result = $p->read($_SESSION['pid']);
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (isset($row["spProfilePic"]))
echo "<img alt='profilepic' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
else
echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px;' >";
}
?>

</div>
<div class="col-md-10">
<h4><?php echo $SellName;?></h4>

</div>
</div>
<div class="row no-margin">
<div class="col-md-12 no-padding">
<p class="active_site">&nbsp;</p>
<p class="adds">User Ads</p>
<p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/phone.png"> <?php echo $SellPhone; ?></p>
<p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/email.png"> <?php echo wordwrap($SellEmail , 26, "<br />\n", true);?></p>
<p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/location.png"> <?php echo $SellAdres.', '.$SellCounty;?></p>
<p class="sel_chat"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/chat.png"> <a href="">Lets Chat</a></p>

</div>
</div>
</div>

<div class="saftey_box">
<h2>Safety Tips for Buyers</h2>
<ol>
<li>Meet seller at a safe location</li>
<li>Check the item before you buy</li>
<li>Pay only after collecting item</li>
</ol>
</div>
</div> -->
</div>



</div>
</div>
</div>
</section>

<?php include('../store/postshare.php');?>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
    // 33jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 16;

    items.slice(perPage).hide();
    if(perPage>numItems){
        $('#pagination-container').hide();
    }else{
        $('#pagination-container').show();
    }

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
</body>
</html>
