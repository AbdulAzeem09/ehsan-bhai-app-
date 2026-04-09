<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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

if(isset($_POST['btnSearchProject'])){
$txtSearchProject = $_POST['txtSearchProject'];
$activePage = 1;
}else{ 
header('location:'.$BaseUrl.'/freelancer/');
}
$p      = new _freelancerposting;
$pf     = new _postfield;
$prof   = new _profilefield;
$pr     = new _spprofiles;

$pl     = new _postlike;
$p2     = new _favorites;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<style>
	body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
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
    background-color: #c45508;
    border-color: #c45508;
}

.simple-pagination .prev.current, 
.simple-pagination .next.current {
    background: #c45508;
}
</style>
</head>

<body class="bg_gray">
<?php

$header_select = "freelancers";
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist">

<div class="col-xs-12 col-sm-3">
<div class="leftsidebar">
<?php include('../component/left-freelancer.php');?>
</div>
</div>
<div class="col-xs-12 col-sm-9 nopadding">
<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">
<?php include('top-banner-freelancer.php');?>
<div class="col-xs-12 nopadding list-wrapper">
<?php
$p      = new _freelancerposting;
$res = $p->search_project($txtSearchProject);

// var_dump($res);

//echo $p->ta->sql;
if($res != false){

while ($row = mysqli_fetch_assoc($res)) {


$result_pf = $pf->read($row['idspPostings']);
$title=$row['spPostingTitle'];
//print_r($row);
//echo $pf->ta->sql."<br>";
if($result_pf){
$closingdate = "";
$Fixed = "";
$Category = "";
$hourly = "";
$skill = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($closingdate == ''){
if($row2['spPostFieldName'] == 'spClosingDate_'){
$closingdate = $row2['spPostFieldValue']; 
}
}

if($Fixed == ''){
if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
if($row2['spPostFieldValue'] == 1){
$Fixed = "Fixed Rate";
//echo $Fixed;
}
}
}
if($Category == ''){
if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue']; 
//	echo $Category;
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
$skill = explode(" ", $row2['spPostFieldValue']);
}
}

}
//$p      = new _freelancerposting;
//$postingDate = $p->spPostingDate($row["spPostingDate"]);
}
?>
<div class="col-xs-12 freelancer-post list-item">
<div class="col-xs-12 col-sm-9 nopadding">
<h2 class="designation-haeding"><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>"><?php echo $title;?></a></h2>
<!--<p class="timing-week"><?php echo ($Fixed != '')? $Fixed:$hourly;?> - <?php echo $Category;?> - <?php echo $row['spPostingDate'];?></p>-->
</div>
<div class="col-xs-12 col-sm-3 text-right social_freelancer1">
<?php
//liked
//$r = $pl->readnojoin($row['idspPostings']);
//if ($r != false) {
//$i = 0;
// $liked = $r->num_rows;
// while ($row2 = mysqli_fetch_assoc($r)) {
// if ($row2['spProfiles_idspProfiles'] == $_SESSION['pid']) {
// echo "<span data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike' data-postid='" . $row['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
// $i++;
// }
// }
// if ($i == 0) {
// echo "<span data-likeid='postid" . $row['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $row['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
// }
// } else {
// $liked = 0;
// echo "<span data-likeid='postid" . $row['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $row['idspPostings'] . "' data-liked='" . $liked . "'></span>";
// }
//favourites
$re = $p2->read($row['idspPostings']);

if ($re != false) {
$i = 0;
// print_r($re);
// die("fdjhd");

while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spUserid'] == $_SESSION['uid']) {
echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart removefavorites1' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
$i++;
}
}
if ($i == 0) {
echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites1' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
}
} else {

echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites1' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
}
?>

</div>
<style>
.projectslist .freelancer-post .post-details {

overflow: hidden;
}
p {
overflow:hidden;
}
</style>
<div class="col-xs-12 nopadding">
<p class="post-details">
	<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" style="color:black;">
<?php

if(strlen($row['spPostingNotes']) < 400){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,400);

} ?>
</a>
<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="readmore">...Read More</a>
</p>
<?php
$skill = explode(" ", $row2['spPostFieldValue']);
if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags'>".$value."</span>";
}

}
}
?>

</div>
<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" style="color:black;">

<div class="col-xs-12 nopadding margin-top-13">
<div class="col-xs-12 col-sm-4 nopadding">
<?php 

$bids = $pf->totalbids($row['idspPostings']);
//echo $po->ta->sql;
if($bids){
$totalbids = $bids->num_rows;
}else{
$totalbids = "Less then 0";
}
?>
<p><span class="proposals" >Proposals:</span><span class="noofproposal" >&nbsp;<?php echo $totalbids; ?></span></p>
<!-- <span class="margin-top-6">
<span class="glyphicon glyphicon-star-empty"></span>
<span class="glyphicon glyphicon-star-empty"></span>
<span class="glyphicon glyphicon-star-empty"></span>
<span class="glyphicon glyphicon-star-empty"></span>
<span class="glyphicon glyphicon-star-empty"></span>
</span> -->
</div>
<div class="col-xs-12 col-sm-4 nopadding">
<p><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/circle-tick.png">&nbsp;<span class="proposals">Client:</span><span class="noofproposal">&nbsp;Payment unverified</span></p>

</div>
<div class="col-xs-12 col-sm-4 nopadding">
<p class="proposals"><?php echo $row['Default_Currency']; ?> <?php echo ($row['spPostingPrice'] > 0)? $row['spPostingPrice']  : 0;?></p>
</div>
</div>
</a>
</div>
<?php
}
}
?>


</div>
<div id="pagination-container"></div>
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
} ?>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
<script src=' http://flaviusmatis.github.io/simplePagination.js'></script>
<script>// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 10;

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
    });</script>


<script>
	$(".social_freelancer1").on("click", ".sp-favorites1", function () {
    //alert('888888');
    var Postid = $(this).data('postid');
    var Pid = $(".dynamic-pid").val();
    var btnfavorites1 = this;
    //alert (Postid);
    //alert (Pid);
    $.post(MAINURL + "/social/addfavoritesfreelancer.php", {
    postid: Postid,
    pid: Pid
    }, function (response) {
    $(btnfavorites1).attr({
    class: 'icon-favorites fa fa-heart removefavorites1 faa-pulse animated'
    });
    $('#spFavouritePost').attr('data-original-title', 'Unfavourite');
    //document.getElementById("spFavouritePost").innerText = " Unfavourite";
    });
    }); 


//remove favorite

$(".social_freelancer1").on("click", ".removefavorites1", function () {
 //alert('33');
var Postid = $(this).data('postid'); 
// alert(Postid);
var btnremovefavorites1 = this;
$.post(MAINURL + "/social/deletefavoritesfreelancer.php", {
postid: Postid
}, function (response) {
//alert(response);
$(btnremovefavorites1).attr({
class: 'icon-favorites fa fa-heart-o sp-favorites1 faa-pulse animated'
});
$('#spFavouritePost').attr('data-original-title', 'Favourite');
//document.getElementById("spFavouritePost").innerText = " Favourite";
});
});
                                
</script>