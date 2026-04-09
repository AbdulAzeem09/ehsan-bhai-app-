<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
//====================
//my friend list
//====================
//sender
$f = new _spprofilehasprofile;
$totalFrnd = array();
$arrayForFriendSorting = array();

$result3 = $f->readallfriend($_SESSION['pid']);

if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
//echo $row3['spProfiles_idspProfilesReceiver'].',';
if ($row3['spUser_idspUser'] != '') {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
if ($account_status == 0) {


array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
$arrayForFriendSorting[$row3['spProfiles_idspProfilesReceiver']] = $row3['spProfileName'];
}
}
}
}
}

//receiver
$result4 = $f->readall($_SESSION['pid']);
if ($result4 != false) {
while ($row4 = mysqli_fetch_assoc($result4)) {
//print_r($row4);
array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
$arrayForFriendSorting[$row4['spProfiles_idspProfileSender']] = $row4['spProfileName'];
}
}


if (!empty($totalFrnd)) {
$totalFriendsofId = count($totalFrnd);
// asort($arrayForFriendSorting);
} else {
$totalFriendsofId = 0;
}
//print_r($totalFrnd);
//print_r($arrayForFriendSorting);
//exit;
//====end my frnd list 
?>
<style>
.pull-right {
font-size: 13px !important;
}
</style>


<style>
    
.col-md-6 {
    width: 50%;
    margin: 0px !important;
}

* {
box-sizing: border-box;
}

.zoom {
// padding: 50px;
// background-color: green;
transition: transform .2s;
font-size: 5px;
//width: 19px;
//height: 19px;
//margin: 0 auto;
}


.zoom:hover {
-ms-transform: scale(1.1);/ IE 9 / -webkit-transform: scale(1.1);/ Safari 3-8 / transform: scale(1.1);
}
.right_create {
    background-color: #fff;
    padding: 10px 20px;
    border: 0px solid #ccc;
}

.join_timeline_main h4 {
margin-bottom: 5px;
margin-top: 0;
}
.carousel {
    margin-bottom: 2rem;
    margin-top: 0rem;
}

.panel-body {
    height: auto !important;
}

.m_top_20 {
/* margin-top: 5px; */
margin-bottom: -5px;
}

/* .green_clr:hover {
font-size: 14px;
color: #3e2048 !important;
} */

</style>
<div class="row">
<div class="col-md-12">

<div class="right_box_timeline right_sidebar ">
<h2><a class="links" href="<?php echo $BaseUrl . '/my-friend'; ?>">My Friends  (<?php echo $totalFriendsofId; ?>)</a><span class="pull-right zoom"><a data-toggle="collapse" href="#collapse1">See All <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/dropdown_arrow_black.png" class="img-responsive" /></a></span></h2>
<div class="panel-group">
<div class="panel panel-default">
<div id="collapse1" class="panel-collapse collapse">
<div class="panel-body no-padding">

<div class="rightscrooler">
<?php
if ($totalFriendsofId > 0) {

foreach ($arrayForFriendSorting as $key => $frndId) {
$profileid = $key;
if (strlen($profileid) > 0 && is_numeric($profileid)) {
$f = new _spprofiles;
$res = $f->read($profileid);
//echo $f->ta->sql;

if ($res != false) {
$row = mysqli_fetch_array($res);
//print_r($row);

if ($row['spUser_idspUser'] != '') {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spUser_idspUser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
if ($account_status == 1) {
continue;
}
}
}


$proftype = $row['spProfileType_idspProfileType'];
$profileIdRight = $row['idspProfiles'];
$NameRight = $row['spProfileName'];
$pict = $row['spProfilePic'];
$profileNote = $row['spProfileAbout'];
//$SubDate = $row['spProfileSubscriptionDate'];
$dt = new DateTime($row['spProfileSubscriptionDate']);
$pt = new _profiletypes;
$pt1 = $pt->readProfileType($proftype);
$rows12 = mysqli_fetch_array($pt1);
$profile_type = $rows12['spProfileTypeName'];
//echo $account_status.'==';
if ($account_status == 0) {
?>
<div class="row m_top_20 news_feed no-margin 11111111111">
<div class="col-md-3 no-padding">
<?php
if (isset($pict)) {
echo "<img alt='profilepic'  class='img-responsive' src='" . ($pict) . "'>";
} else {
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} ?>
</div>
<div class="col-md-9 no-padding join_timeline_main">
<h4><a style="width:163px;" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileIdRight; ?>"><?php echo ucfirst($NameRight); ?></a></h4>
<h3><?= $profile_type; ?> Profile</h3>
</div>
</div>
<?php }
}
}
}
} else {
?>
<p style="margin-top: 15px;">No record available</p>
<?php
}

?>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="right_box_timeline right_sidebar">
<h2 style="    font-size: 13px;"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/stores_icon_ad.png" class="img-responsive" alt="" /> Stores <span class="pull-right zoom"><a href="<?php echo $BaseUrl; ?>/store/">See All</a></span></h2>
<div id="carousel-example-generic" class="carousel slide carousel-fade">
<!-- SLIDER START -->
<div class="carousel-inner" role="listbox">
<?php
$active = 0;
for ($i = 0; $i <= 5; $i++) {
?>
<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<?php
/*	$c= new _spproducts;
$cu=$c->read_currecy($_SESSION['pid']);
$cur=mysqli_fetch_assoc($cu);
;*/
//echo $curr;die('===========');

$count = 0;
$p = new _productposting;
$query = $p->publicpost_two();
//  echo $p->ta->sql;
if ($query != false) {
while ($row_store = mysqli_fetch_assoc($query)) {
//echo "<pre>";
//print_r($row_store);
//die('======');
if ($row_store['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row_store['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$curr = $row_store['default_currency'];
if ($row_store['retailSpecDiscount']) {
//echo 1;
$price = $row_store['retailSpecDiscount'];
}
if ($row_store['spPostingPrice']) {
$price = $row_store['spPostingPrice'];
}
$dt = new DateTime($row_store['spPostingExpDt']);
$pro = new _spprofiles;
$result = $pro->read($row_store['spProfiles_idspProfiles']);
if ($result) {
$row = mysqli_fetch_assoc($result);

$ProfileName = $row['spProfileName'];
}
if ($account_status == 0) {
if ($count == 0) {
?>
<div class="row m_top_20" style="">
<div class="col-md-4 store_img">
<?php
$pic = new _productpic;

$result_pic = $pic->read($row_store['idspPostings']);
if($result_pic){
//echo $pic->ta->sql;
if ($row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} 
}else {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} ?>

</div>
<div class="col-md-6 no-padding-left">
<?php
if (!empty($row_store['spPostingTitle'])) {
if (strlen($row_store['spPostingTitle']) < 15) {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo $row_store['spPostingTitle']; ?></a></h3><?php

} else {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo substr($row_store['spPostingTitle'], 0, 15) . '...'; ?></a>
<h3><?php
}
} else {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>">No-Title</a>
<h3><?php
}
?>

<h5 style="margin-top: 7px; 22">
<?php if (($row_store['retailSpecDiscount'] != '') && ($row_store['sellType'] == "Retail")) {
echo $curr . ' ' . $row_store['retailSpecDiscount']; ?>&nbsp;<del class="text-success" style="color:green;"><?php echo $curr . ' ' . $row_store['spPostingPrice']; ?></del>

<?php
} else {
//echo $price;die;
//$row_store['spPostingPrice'];
if ($price != '') {

echo $curr . ' ' . $price;
} else {
$dt = new DateTime($row_store['spPostingExpDt']);
echo "Expires on " . $dt->format('d M y');
}
}
?>
<br>
<!-- <?php //echo $dt->format('d M'); 
?> -->
</h5>
<?php if (strlen($ProfileName) < 15) { ?>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" style="color:green;" >by <?php   echo substr($ProfileName, 0, 10) . '...';  ?></a>
<?php } else { ?>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" style="color:green;" >by <?php   echo substr($ProfileName, 0, 10) . '...'; ?></a>
<?php } ?>                                           
</div>                               
<div class="col-md-2 no-padding-left">   

<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>"  style="margin-top: 30px;">View</a>

</div>
</div>
<?php
$count = 1;
} else {
?>
<div class="row m_top_20" style="">
<div class="col-md-4 store_img">
<?php
$pic = new _productpic;
$result_pic = $pic->read($row_store['idspPostings']);
//echo $pic->ta->sql;
if (isset($row_store['idspCategory']) && $row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} else {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src='" . ($picture) . "' >";
} else
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} ?>

</div>
<div class="col-md-6 no-padding-left">
<?php
if (!empty($row_store['spPostingTitle'])) {
if (strlen($row_store['spPostingTitle']) < 15) {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>">
<?php echo $row_store['spPostingTitle']; ?></a></h3><?php

} else {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingTitle']; ?>"><?php echo substr($row_store['spPostingTitle'], 0, 15) . '...'; ?></a>
<h3><?php
}
} else {
?><h3><a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>">No-Title</a>
<h3><?php
}
?>

<h5 style="margin-top: 7px; 11">
<?php if (($row_store['retailSpecDiscount'] != '') && ($row_store['sellType'] == "Retail" || $row_store['sellType'] == "Personal")) {
echo $curr . ' ' . $row_store['retailSpecDiscount']; ?>&nbsp;<del class="text-success" style="color:green;"><?php echo $curr . ' ' . $row_store['spPostingPrice']; ?></del>

<?php
} else {

if ($price != '') {
   $discounted_ = $row_store['discounted_price'];
   $price_disc = $price - $discounted_;
echo $curr . ' ' . $price_disc;
} else {
$dt = new DateTime($row_store['spPostingExpDt']);
echo "Expires on " . $dt->format('d M y');
}
}
?>
<br>
<!--   <?php echo $dt->format('d M'); ?> -->
</h5>
<?php if (strlen($ProfileName) < 15) { ?>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" style="color:green;" >by <?php echo substr($ProfileName, 0, 10) . '...'; ?></a>
<?php } else { ?>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row_store['spProfiles_idspProfiles'] ?>" style="color:green;" >by <?php   echo substr($ProfileName, 0, 10) . '...'; ?></a>
<?php } ?>                                                             
</div>
<div class="col-md-2 no-padding-left">
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $row_store['idspPostings']; ?>"  style="margin-top: 30px;">View</a>

</div>
</div>
<?php
$count = 0;
}
}
}    ?>
<?php
}
?>
</div>
<?php
$active++;
} ?>
</div>
</div><!-- SLIDER END -->
</div>
</div>
</div>

<!-- group comment Start 15-05-2023 -->


<!-- <div class="row">
<div class="col-md-12">
<div class="right_box_timeline gropHeight right_sidebar">
<h2 style="font-size:13px;"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/group_icon_ad.png" class="img-responsive" alt="" /> Groups <span class="pull-right zoom"><a href="<?php echo $BaseUrl ?>/my-groups/">See All</a></span></h2>

<div id="carousel-example-group" class="carousel slide carousel-fade">
<div class="" role="listbox">
<div class="right_create join_timeline_main  right_sidebar_group">
<?php
$g = new _spgroup;
$result = $g->publicgroup_two();
//echo $notgrp->ta->sql;
if ($result != false) {
    $count=0;

while ($row = mysqli_fetch_assoc($result)) {

    $pro = $g->read_grop_profile($row['idspGroup']);
    if($pro){
    $row_2 = mysqli_fetch_assoc($pro);
    $sppro=$row_2['spProfiles_idspProfiles'];

    $res = $g->read_profile_id($sppro);
    if($res){ 
        $row_3 = mysqli_fetch_assoc($res);
        //print_r($row_3);
       $pro_id=$row_3['spUser_idspUser']; 
        if($pro_id==$_SESSION['uid']){
           
            continue;

        }

    }
    
}

   





    $st_1 = $g->read_group_status_1($_SESSION['pid'],$row['idspGroup']);

    
    if($st_1){
        continue;
    }
    if($count==3){
        break;

    }
//print_r($row);
?>
<div class="explore_box row">
<div class="righ_img">

<?php

$result2 = $g->groupdetails($row['idspGroup']);

if ($result2 != false) {


$row2 = mysqli_fetch_assoc($result2);
//print_r($row2);

$con = mysqli_connect(DOMAIN, UNAME, PASS);

if (!$con) {

die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}



$query1 = mysqli_query($con, "SELECT group_category_icon FROM group_category WHERE group_category_name = '" . $row2['spgroupCategory'] . "'");


$Category_img = mysqli_fetch_assoc($query1);
if(isset($Category_img['group_category_icon'])){
  $catimg = $Category_img['group_category_icon'];
}
// echo $catimg;

$gimage = $row2["spgroupimage"];


}



if ($catimg != false) { ?>
<img src="<?php echo $BaseUrl; ?>/upload/content/group_c/<?php echo $catimg; ?>" class="img-circle main_grp_img" alt="" /><?php
} elseif($gimage) {  ?>

<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-circle main_grp_img" alt="" /><?php

}
else{ ?>
	<img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp" class="img-circle main_grp_img" alt="" />
 <?php }
?>

</div>


<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline" class="join_timeline btn view_right_joinbtn" data-pid="<?php echo $_SESSION['pid'] ?>" data-gid="<?php echo $row['idspGroup'] ?>" id="addmemontimeline1"> Join </a>

<h3>
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline" data-toggle="tooltip" title="<?php echo $row["spGroupName"]; ?>">
<?php
if (strlen($row["spGroupName"]) > 12) {
echo $string = substr($row["spGroupName"], 0, 12) . '...';
} else {
echo $row["spGroupName"];
} ?>
</a>
</h3>
<?php
if (isset($row['spgroupflag']) && $row['spgroupflag'] == 1) {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-lock"></i> Private</h6>';
} else {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-globe"></i> Public</h6>';
}
?>

</div> <?php
$count++;
}
}

?>


</div>

</div>
</div>
</div>
</div>
</div> -->



<!-- group comment end 15-05-2023 -->


<script>
function poopups() {
swal("join", "Join Successfully", "success");
}
</script>
<!--  < div class="row">
<div class="col-md-12">
<div class="right_box_timeline right_sidebar">
<h2><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/event_icon_ad.png" class="img-responsive" alt="" /> Events <span class="pull-right"><a href="<?php echo $BaseUrl ?>/events/">See All</a></span></h2>
<div id="carousel-example-event" class="carousel slide carousel-fade">
<div class="carousel-inner" role="listbox">
<?php
$active3 = 0;
for ($i = 0; $i < 2; $i++) {
?>
<div class="item <?php echo ($active3 == 0) ? 'active' : ''; ?>" >
<?php

//SHOW EVENTS ON SPECEFIC PEOPELE
$p = new _postingview;
$res_eve = $p->publicpost_two_event();
//echo $p->ta->sql;
if ($res_eve) {
while ($row3 = mysqli_fetch_assoc($res_eve)) { ?>
<div class="row m_top_20">
<div class="col-md-4 even_ban">
<?php
$pic = new _postingpic;
$result_pic = $pic->read($row3['idspPostings']);
//echo $pic->ta->sql;
if ($row3['idspCategory'] == 9) {
if ($result_pic != false) {
$rp = mysqli_fetch_assoc($result_pic);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-circle' src='" . ($picture) . "' >";
} else
echo "<img alt='profilepic'  class='img-responsive' src='" . $BaseUrl . "/assets/images/blank-img/1.png' >";
} ?>

</div>
<div class="col-md-8 no-padding-left join_timeline_main">
<a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row3['idspPostings']; ?>" class="icon-right pull-right"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/tick.png" class="img-responsive" alt=""></a>
<h3><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row3['idspPostings']; ?>"><?php echo $row3['spPostingtitle'] ?></a></h3>
<h5>399 Members</h5>
<p><?php
if (strlen($row3['spPostingNotes']) > 100) {
// truncate string
$stringCut = substr($row3['spPostingNotes'], 0, 100);
// make sure it ends in a word so assassinate doesn't become ass...
echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
} else {
echo $row3['spPostingNotes'];
} ?>
</p>
</div>
</div> <?php
}
}

?>



</div> 
<?php
$active3++;
}
?>


</div>

</div>


</div>
</div>
</div>

-->
