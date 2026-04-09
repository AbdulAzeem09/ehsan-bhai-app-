<?php
// error_report ng(E_ALL);
// ini_set('display_errors', 'On');

if (!isset($_SESSION)) {
session_start();
}



include('../univ/baseurl.php');

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}



spl_autoload_register("sp_autoloader");
$t = new _firstlogin;
$vis = $t->chkModuleSeting($_SESSION['uid']);
?>
<!doctype html>
<html>

<head>
<?php include('../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<style>
.timlinepicture.text-center {
margin-top: 25px !important;
}
</style>
<style>
#Menu ul {
display: none;
}

#Menu {
list-style: none;
}

#Menu li:hover>ul {
display: flex;
margin-top: -70px;
}

#Menu li ul {
margin: 0;
padding: 0;
position: absolute;
z-index: 5;
/* padding-top: 6px;*/
}

#Menu li {
float: left;
margin-left: 10px;
}

#Menu li ul li {
float: none;
margin: 0;
display: inline;
}

#Menu li ul li a {
display: block;
padding: 6px 10px;
background: #333;
white-space: nowrap;
}

#Menu li {
display: list-item;
text-align: -webkit-match-parent;
}

#Menu ul {
border: 0;
font-size: 100%;
font: inherit;
vertical-align: baseline;
}


.nav ul {
margin: 0;
padding: 0;
list-style: none;
}

.nav ul {
display: inline-block;
vertical-align: top;
font-size: 14px;
}

.nav ul li {
position: relative;
float: left;
}

.nav ul li+li {
margin-left: 1px;
}

.nav ul li a {

display: inline-block;
text-decoration: none;
padding: 0px 20px;
-webkit-transition: all 0.1s ease-in;
-o-transition: all 0.1s ease-in;
transition: all 0.1s ease-in;
}


.nav ul li>ul {
display: none;
position: absolute;
width: 150px;
top: 100%;
left: -1px;
z-index: 5;
text-align: left;
}

.nav ul li>ul li {
float: none;
margin: -2px;
}

.nav ul li>ul li a {
display: flex;

}

#hover:hover {

background-color: green;
}


.nav ul li.active {
pointer-events: none;
}


.navigation :hover {
display: flex !important;

}

.searchkeywordbox {
padding-top: 6px !important;
}

.nav-tabs>li.active>a span {
border-bottom: none !important;
}

.sweet-alert h2 {
font-size: 25px;
}
</style>
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});

function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});
</script>
<!--This script for sticky left and right sidebar END-->
<?php if ($vis == 1) { ?>
<script type="text/javascript">
$(window).load(function() {
$('#alertNotEmpProfile').modal('show');
//$('#alertNotEmpProfile').modal('toggle');
$('#alertNotEmpProfile').modal({
backdrop: 'static',
keyboard: false

});
});
</script>
<?php
}
?>
</head>

<body class="bg_gray" onload="pageOnload('<?php
if (isset($_GET["globaltimeline"]) == 7) {
echo "timelines";
} elseif (isset($_GET["myfavorite"]) == 3) {
echo "favorite";
} elseif (isset($_GET["friendstore"]) == 4) {
echo "store";
} elseif (isset($_GET["groupstore"]) == 5) {
echo "store";
} elseif (isset($_GET["mystore"]) == 6) {
echo "store";
} elseif (isset($_GET["mytimeline"]) == 2) {
echo "mytimeline";
} else {
echo "store";
}
?>')">

<!-- this model is show when user is not a member of jobseekr -->
<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius sharestorepos">
<form class="no-margin" method="post" action="<?php echo $BaseUrl; ?>/album/savemod.php">

<div class="modal-header">
<b>
<h4 class="modal-title" id="userModalLabel" style="font-size: 20px!important;">MENU SELECTION </h4>
</b>(Uncheck the modules you want to hide for now)

</div>
<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
<!--  <h1><img src="<?php echo $BaseUrl . '/assets/images/logo/tsplogo.PNG' ?>" alt="logo" class="" /></h1> -->
<h2>The Sharepage gives you the option to customize your menu</h2>

<p>Please uncheck the modules you want to hide from your menu</p>
<div class="space-md"></div>
<div class="row text-left">
<div class="col-md-4">
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="group">Group</label> 
</div>


<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="jobboard">Job Board</label>
</div>
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="event">Events</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="trainging">Trainings</label>
</div>
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="service">My Business Space</label>
</div>
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="news">News Views</label>
</div>

</div>
<div class="col-md-4">
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="stores" disabled>Store</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="realestate">Real Estate</label>
</div>


<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="artgallery">Art and Craft</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="classfiedads">Classfied Ads</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="nft">NFT</label>
</div>


</div>
<div class="col-md-4">
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="freelance">Freelancer</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="rental">Rental</label>
</div>

<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="video">Videos</label>
</div>
<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="businessforsale">Business for Sale</label>
</div>



<div class="checkbox">
<label><input type="checkbox" value="0" checked="" name="date">Dating</label>
</div>

</div>
</div>


</div>
<div class="modal-footer">
<button type="submit" class="btn btn-default" id="hover" name="btnshowall">Show All Modules</button>
<button type="submit" class="btn btn-primary">Save Module</button>
</div>
</form>

</div>
</div>
</div>
<?php
include_once("../header.php");
//echo $_SESSION['count'];
//die('==');
if ($_GET['msg'] == 'alert') {
?>

<div class="alert alert-success" id="alert_d" role="alert">
<p>Please switch profile either Freelancer Profile or Business Profile.</p>  
</div>
<?php } ?>

<?php include('globaltimelineformEdit.php');
?>
<!--send timeline link to email popup-->

<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="sp-Profiles-idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">

<input type="hidden" id="checkdraft">
<section class="landing_page">
<div class="container pubpost">
<?php if ($_SESSION['cnf_msg'] == 1) {

unset($_SESSION['cnf_msg']);
?>
<span id="pop_msg">
<div class="alert alert-success" style="background:#3da133">
<span style="color:white"><strong>Shared Successfully !</strong> </span>
</div>
</span>



<script>
setTimeout(function() {
$('#pop_msg').html("");

}, 2000);
</script>
<?php } ?>


<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php');
?>
</div>
<?php //die();  
?>
<div class="col-md-7">

<div class="pop-up">
<p id="aboutprofile"></p>
</div>
<div class="<?php echo (isset($_GET["groupflag"]) ? "hidden" : ""); ?>">
<ul class="pagination <?php echo ((isset($_GET["groupstore"]) && $_GET["groupstore"] == 5) ? "" : "hidden"); ?>">
<li class="page-item">
<a class="page-link" href="#" aria-label="Previous">
<span aria-hidden="true">&laquo;</span>
<span class="sr-only">Previous</span>
</a>

</li>
<?php
$g = new _spgroup;
$result = $g->groupmember($_SESSION['uid']);
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) {

echo "<li class='" . (($row['idspGroup'] == $_GET["gid"]) ? "active" : "") . "'><a href='/private-store/?gid=" . $row['idspGroup'] . "&gname=" . $row['spGroupName'] . "&back=back' class='groupsearch' data-gid='" . $row['idspGroup'] . "' data-gname='" . $row['spGroupName'] . "'>" . $row['spGroupName'] . "</a></li>";
}
}
?>
<li class="page-item">
<a class="page-link" href="#" aria-label="Next">
<span aria-hidden="true">&raquo;</span>
<span class="sr-only">Next</span>
</a>
</li>
</ul>
</div>
<!-- Drop Down Complete-->
<?php
if (isset($_GET["categoryID"])) {
include_once("../Filter/index.php");
} else {
if (!isset($_GET["globaltimeline"])) {
//PRODUCT NAME
include_once("../Filter/storesearch.php");
include_once("../Filter/index.php");
}
}
?>
<div class="detailaboutfilter"></div>
<div id="current_search"> </div>
<!--Current Search-->
<div class="socials">
<!--Socials-->
<?php
if (isset($_GET["globaltimeline"])) {
if ($_GET["globaltimeline"] == 7) {
//timeline form code
//die('================');
include("globaltimelineform.php");
//die('=============');

//on timeline filter
?>
<div id="youtubevideolink"></div>
<!-- <div class="videoshow">
<img src="http://img.youtube.com/vi/JFcgOboQZ08/sddefault.jpg" class="img-responsive" />
<div class='titlebox'>
<a href="" target="_blank">You tube video</a>
</div>
</div> -->
<?php

// include("../Filter/timeline-filter.php");

if (isset($_GET['post-detail'])) {
include("../publicpost/singletimelines.php");
} else {
//die('===============');
include("globaltimelines.php");
//die('===============');
//echo "here";
}
}
}
?>
</div>
<div class="<?php echo ($_GET["globaltimeline"] == 7 ? "hidden" : "panel panel-success "); ?>">
<div class="panel-heading">
<div class="row">
<div class="col-md-8">
<p class="panel-title" style="font-size:160%;">
<?php
if (isset($_GET["categoryName"])) {
if ($_GET["categoryName"] == "Buy&Sell") {
if (!isset($_GET["profileid"])) {
echo "<div clas='row'>";
echo "<div class='col-md-6'>";
echo "<div class='btn-group' role='group' aria-label='...'>
<a href='../retail/' id='sellpost' class='btn btn-default buysell " . ($_GET["spPostingsFlag"] == 2 ? "active" : "") . "' role='button'>Retail</a>

<a href='../sell/' id='sellpost' class='btn btn-default buysell " . ($_GET["spPostingsFlag"] == 0 ? "active" : "") . "' role='button'>Wholesale</a>

</div></div>";
echo "</div>";
} else {
$p = new _spprofiles;
$res = $p->read($_GET["profileid"]);
if ($res != false) {
$rows = mysqli_fetch_assoc($res);
echo "<b>" . ucfirst($rows["spDynamicWholesell"]) . "</b>&nbsp;&nbsp;&nbsp; " . $rows["spProfileAbout"];
}
}
} else {
echo $_GET["categoryName"];
if ($_GET["categoryName"] == "Freelancers") {
echo "<button type='button' class='btn btn-success pull-right' id='browsefreelancer'> Browse Freelancers</button>";
}
}
} elseif (isset($_GET["globaltimeline"])) {
if ($_GET["globaltimeline"] == 7) {
echo "";
}
} elseif (isset($_GET["myfavorite"])) {
if ($_GET["myfavorite"] == 3) {
echo "Favorite";
}
} elseif (isset($_GET["friendstore"])) {
if ($_GET["friendstore"] == 4) {
echo "Friend's store";
}
} elseif (isset($_GET["groupstore"])) {
if ($_GET["groupstore"] == 5) {
echo "Group store  " . (isset($_GET["gname"]) ? "(" . $_GET["gname"] . ")" : "") . "";
}
} elseif (isset($_GET["mystore"])) {
if ($_GET["mystore"] == 6) {
echo "My store";
}
} elseif (isset($_GET["mytimeline"])) {
if ($_GET["mytimeline"] == 2) {
echo "My timeline";
}
} else {
echo "Public Post";
}
if (isset($_GET["categoryName"])) {
if (($_GET["categoryName"]) == "Events") { //Event in my city Filter
$p = new _spprofiles;
$res = $p->read($_SESSION["pid"]);
if ($res != false) {
$rows = mysqli_fetch_assoc($res);
echo "<button type='button' class='btn btn-primary btn-sm pull-right cityevent' data-city='" . $rows["spProfilesCity"] . "'>Events in my city</button>";
}
}
}
?>
<span class="btn-group pull-right <?php echo ((isset($_GET["categoryName"]) && $_GET["categoryName"] == "Trainings") ? "" : "hidden") ?>" role="group" aria-label="...">

<button type="button" class="btn btn-default btn-sm free-training active trainingv">Free</button>
<button type="button" class="btn btn-default btn-sm paid-training trainingv">Paid</button>
</span>
<!--Free Training and Paid Training-->
</p>
</div>
<div class="col-md-4">
<div class="<?php echo ($_GET["globaltimeline"] == 7 ? "hidden" : ""); ?>">
<div class="buttons btngrid2list pull-right">
<!--Sorting Testing-->
<span class="dropdown">
<button class='btn btn-primary dropdown-toggle autohover' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span id="sort"></span> <span class="fa fa-sort"></span></button>
<ul class="dropdown-menu dropdowncontent" aria-labelledby="dropdownMenu1">
<li><a href="#" class="sortable" id="leastexpensive">Least expensive</a></li>
<li><a href="#" class="sortable" id="mostexpensive">Most expensive</a></li>
<li><a href="#" class="sortable" id="freeshipping">Free Shipping</a></li>
<li><a href="#" id="newer" class="selected sortable">Most recently post</a></li>
<li><a href="#" id="older" class="sortable">Older Post</a></li>
<li><a href="#" class="sortable" id="mostreview">Most reviews</a></li>
<li><a href="#" class="sortable" id="bestrating">Best rating</a></li>
</ul>
</span>
<!--Sorting Testing Code Complete-->
<button class="btn btn-success btn-sm  grd devicemanage"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
<button class="btn btn-success btn-sm lst active devicemanage"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
</div>
</div>
</div>
</div>
</div>
<div class="panel-body social">
<div class="row">
<ul class="list-group ">
<?php
//TimeLine shared to me by other person

if (isset($_GET["globaltimeline"]) == 7) {
$_GET["publictimeline"] = 7;
include("public-timeline.php");
}


//My favourite Post
elseif (isset($_GET["myfavorite"]) == 3) {
$_GET["publictimeline"] = $_GET["myfavorite"];
include("public-timeline.php");
}

//Friend Store
elseif (isset($_GET["friendstore"]) == 4) {
$_GET["publictimeline"] = $_GET["friendstore"];
include("public-timeline.php");
}
//Group Store
elseif ($_GET["groupstore"] == 5) {
$_GET["publictimeline"] = $_GET["groupstore"];
include("public-timeline.php");
} elseif ($_GET["mystore"] == 6) {
$_GET["publictimeline"] = $_GET["mystore"];
include("public-timeline.php");
} elseif ($_GET["mytimeline"] == 2) {
$_GET["publictimeline"] = $_GET["mytimeline"];
include("public-timeline.php");
} elseif (isset($_GET["friendid"])) {
$_GET["publictimeline"] = 8;
include("public-timeline.php");
}
//public post
else {
$_GET["publictimeline"] = "1";
include("public-timeline.php");
}
?>
</ul>
</div>
<!--div class row-->
</div>
</div>
<!--modal-->
<?php include("postshare.php"); ?>
<!--modal complete-->

<!--  flagmodal -->
<!-- <?php include("postflagmodel.php"); ?> -->

<!--  flagmodal complete -->


<div id="sidebar_right" class="col-md-3 no-padding " style="left: auto;">
<?php include('../component/right-landing.php'); ?>
</div>
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
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <div role="tabpanel" id="total_reaction">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="top_reaction1"></ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="bottom_reaction" style="font-size: 27px;text-align: center;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
/*
$(".reactionbtn_remove").on("click", function () {
var rection = "&#128077;&#127995;";
var postid = $(this).attr("data-postid");
var prid = $("#prid").val();
var usid = $("#usid").val();

$.ajax({
url: "../social/remove_reaction.php",
type: "POST",
data: {
spPostings_idspPostings: postid,
spProfiles_idspProfiles: prid
},
success: function (response) {
$('#currentreaction_' + postid).html(rection);

var a= $('#cuer'+postid).text();

var c = parseInt(a) - parseInt(response);
if(c>=1){
$('#cuer'+postid).text(c);
}
else{
$('#cuer'+postid).text("0");
}
//		$('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');

//	$('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

},

});
});
*/
function mfunction(a) {
var rection = "&#128077;&#127995;";
var postid = $(a).attr("data-postid");
var prid = $(a).attr("data-pid");
var usid = document.getElementById("usid").value;


$.ajax({
url: "../social/remove_reaction.php",
type: "POST",
data: {
spPostings_idspPostings: postid,
spProfiles_idspProfiles: prid
},
success: function(response) {
$('#currentreaction_' + postid).html(rection);
var a = $('#cuer' + postid).text().replace('(', '').replace(')', '');

//var a = $('#cuer' + postid).text();

var c = parseInt(a) - parseInt(response);
if (c >= 1) {
$('#cuer' + postid).text('(' + c + ')');
} else {
$('#cuer' + postid).text('(0)');
}
//		$('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');

//	$('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

},

});

}

//$(".reactionbtn").on("click", function () 

function newclick(a, id) {
var postid = id;

var reaction = a;

var rid = a;

if (rid == 1) {
rection = "&#128525;";
}

if (rid == 2) {
rection = "&#128512;";
}
if (rid == 3) {
rection = "&#128546;";
}
if (rid == 4) {
rection = "&#129315;";
}
if (rid == 5) {
rection = "&#128563;";
}
if (rid == 6) {
rection = "&#128545;";
}

if (rid == 7) {
rection = "&#128077";
}
var usid = $("#usid").val();
var prid = $("#prid").val();

$.ajax({
url: "../social/addlike.php",
type: "POST",
data: {
spPostings_idspPostings: postid,
spProfiles_idspProfiles: prid,
uid: usid,
Reaction_id: reaction,
},
success: function(response) {
var a = $('#cuer' + postid).text().replace('(', '').replace(')', '');

//var a = $('#cuer' + postid).text();
var c = parseInt(a) + parseInt(response);
$('#cuer' + postid).text('(' + c + ')');

$('#currentreaction_' + postid).html(rection);
//	$('#new_data_'+postid).html('<a id="currentreaction_'+postid+'" class="reactionbtn_remove" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');
//				  $('#currentreaction_'+postid).removeClass('reactionbtn').addClass('reactionbtn_remove');

},

});
}
//);
</script>

<script>
$(".navigation li").hover(function() {
var isHovered = $(this).is(":hover");
if (isHovered) {
$(this).children("ul").stop().slideDown(300);
} else {
$(this).children("ul").stop().slideUp(300);
}
});
</script>

<script>
function addImage(pk) {
alert("addImage: " + pk);
}

$('#myModal .save').click(function(e) {
e.preventDefault();
addImage(5);
$('#myModal').modal('hide');
//$(this).tab('show')


return false;
});



function getreaction(postidr) {
var postidr = postidr;

$.ajax({
url: "../social/getReaction.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response) {


$('#top_reaction1').html(response);
},

});
$.ajax({
url: "../social/getReaction1.php",
type: "POST",
data: {
spPostings_idspPostings: postidr
},
success: function(response) {
//alert(response);
$('#bottom_reaction').html(response);

},

});

}
</script>

<script>
setTimeout(function() {
$("#alert_d").hide();
}, 5000);



$(".alert-button").on('click', function(event){
var postid = $(this).attr("data-id");

// var msg_data = $('#timeline_msg'+postid).val();

//var msg_data = "";
/*if(msg_data==""){

$('#text_error_'+postid).html('Please Enter Semething');

return false;
}

*/


});
</script>

