<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION);die('===========');
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

<style type="text/css">
.list-wrapper {
/* padding: 15px; */
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
background-color: #008000;
border-color: #FFF;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #008000;
}


.buyer {
max-width: 100px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}

.modal {}

.vertical-alignment-helper {
display: table;
height: 100%;
width: 100%;
}

.vertical-align-center {

display: table-cell;
vertical-align: middle;
}

.modal-content {

width: inherit;
height: inherit;

margin: 0 auto;
}

.notification-container {
margin: auto;
padding: 30px;
width: 80%;
display: flex;
flex-flow: column;
}

.row .card {
width: 100%;
margin-bottom: 5px;
display: block;
transition: opacity 0.3s;
}

.card-body {
padding: 0.5rem;
}

.card-body table {
width: 100%;
}

.card-body table tr {
display: flex;
}

.card-body table tr td a.btn {
font-size: 0.8rem;
padding: 3px;
}

.card-body table tr td:nth-child(2) {
text-align: right;
justify-content: space-around;
}

.card-title:before {
display: inline-block;
font-family: "Font Awesome 5 Free";
font-weight: 900;
font-size: 1.1rem;
text-align: center;
border: 2px solid grey;
border-radius: 100px;
width: 30px;
height: 30px;
padding-bottom: 3px;
margin-right: 10px;
}

.notification-invitation .card-body .card-title:before {
color: #90CAF9;
border-color: #90CAF9;
content: "";
}

.notification-warning .card-body .card-title:before {
color: #FFE082;
border-color: #FFE082;
content: "";
}

.notification-danger .card-body .card-title:before {
color: #FFAB91;
border-color: #FFAB91;
content: "";
}

.notification-reminder .card-body .card-title:before {
color: #CE93D8;
border-color: #CE93D8;
content: "";
}

.card.display-none {
display: none;
transition: opacity 2s;
}

.card-body {
padding: 0.5rem;
border: 1px solid;
border-radius: 10px;
height: 100%;
line-height: 30px;
}

.notification-reminder .card-body .card-title:before {
color: #CE93D8;
border-color: #CE93D8;
content: "";
line-height: 30px;
}

.card-body table tr td a.btn {
font-size: 17px;
padding: 7px;
}

#profileDropDown li.active {
background-color: #0f8f46;
}

#profileDropDown li.active a {
color: white;
}
</style>
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 24;
//include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php');
?>
</div>
</div>
<div class="col-md-10">



<?php

$storeTitle = " Dashboard / My Send Enquires";
// include('../top-dashboard.php');
// include('../searchform.php');

?>

<div class="row" style="border-style: solid; border-width: 2px;margin:10px">
<!-- 
<div class="col-md-12">

<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></li>
<li><a href="#">My Send Enquiries</a></li>

</ul>


<div class="text-right" style="margin-top: -10px;">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21) ? 'active' : '' ?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24) ? 'active' : '' ?>">Buyer Dashboard</a></li>
</ul>

</div>
</div> -->
<div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></li>
<li><a href="#">Notifications</a></li>

</ul>
</div>
<div class="row notification-container">
<div class="col-md-12">

<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
//echo $account_status;
}


$n = new _notification;
$to_id = $_SESSION['pid'];
$module = 'store';
$by_seller_or_buyer = 1;
$resnoti = $n->readNotification($to_id, $module, $by_seller_or_buyer);
//var_dump($resnoti);
//print_r($resnoti);
//die('=====');
$noti = $resnoti->num_rows;
//echo $noti;
//die('====');

if ($account_status != 1) {
if ($resnoti != false) {
?>
<p class="dismiss text-right"><a id="dismiss-all" style=" cursor: pointer; " onclick="loadDocAll(<?php echo $_SESSION['pid']; ?>)">Dismiss All</a></p>

<?php
while ($rownoti = mysqli_fetch_assoc($resnoti)) {
//print_r($rownoti);
///die('==');

?>

<div class="list-wrapper" id="hide">


<div class="list-item">
<div class="card notification-card notification-reminder">
<div class="card-body">
<table>
<tr>
<td style="width:90%;">
<div class="card-title"><?php echo $rownoti['message'] . " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "<b>" . $rownoti['date_and_time'] . "</b>"; ?></div>
</td>
<td>
<a class="btn btn-danger dismiss-notification1" onclick="loadDoc(<?php echo $rownoti['id']; ?>)">Dismiss</a>
</td>
</tr>
</table>
</div>
</div>
</div>


</div>
<?php
}
//$resnoti++;
} ?>

<?php   if ($resnoti != false) { ?>
<div id="pagination-container">
<?php

} else {
echo "<center>No New Notifications !</center>";
}

?>
</div>

<?php } ?>


<?php

if (isset($_GET['readall'])) {
$to_id = $_SESSION['pid'];
$n = new _notification;
$module = 'store';
$by_seller_or_buyer = 1;
$n->updatereadAllCreatenotificationcount($to_id, $by_seller_or_buyer, $module);
}


if (isset($_GET['id'])) {
$id = $_GET['id'];
$n = new _notification;

$n->updatereadCreatenotification($id);
}
if (isset($_GET['to_idup'])) {
$to_id = $_GET['to_idup'];
$n = new _notification;
$by_seller_or_buyer = 1;
$module = 'store';
$n->updatereadAllCreatenotification($to_id, $by_seller_or_buyer, $module);
//echo $n->ta->sql; die;
}

?>

</div>
</div>
</div>

</div>
</div>
</div>
</section>



<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>

</body>

</html>
<?php
} ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 5;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function(pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});
</script>
<!-- partial -->

<script>
const dismissAll = document.getElementById('dismiss-all');
const dismissBtns = Array.from(document.querySelectorAll('.dismiss-notification'));

const notificationCards = document.querySelectorAll('.notification-card');

dismissBtns.forEach(btn => {
btn.addEventListener('click', function(e) {
e.preventDefault;
var parent = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
parent.classList.add('display-none');
})
});

/*dismissAll.addEventListener('click', function(e){
e.preventDefault;
notificationCards.forEach(card => {
card.classList.add('display-none');
});
const row = document.querySelector('.notification-container');
const message = document.createElement('h4');
message.classList.add('text-center');
message.innerHTML = 'All caught up!';
row.appendChild(message);
})*/





function loadDoc(id) {
//alert(id);
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
// document.getElementById("demo").innerHTML = this.responseText;
}
xhttp.open("GET", "/artandcraft/dashboard/seller-notification.php?id=" + id);
xhttp.send();
//alert('====');
location.reload();
}

function loadDocAll(to_id) {

$("#hide").hide();

//alert(to_id);
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
// document.getElementById("demo").innerHTML = this.responseText;
}
xhttp.open("GET", "/store/dashboard/my_buyer_notification.php?to_idup=" + to_id);
xhttp.send();

}
$(document).ready(function() {

$("#pagination-container").click(function() {

$("#hide").show();
});

});
</script>