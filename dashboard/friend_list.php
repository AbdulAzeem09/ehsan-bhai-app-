<?php


// error_reporting(E_ALL);
// ini_set('display_errors', '1');




require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$pageactive = 85;      
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}

</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../component/left-dashboard.php');
?>
</div>

<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->



<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}				


</style>






<div class="content">
<div class="col-md-12 ">




<div class="">

<form action="/dashboard/change_friends.php" method="post">

<div class="row">
<input type="hidden" name="send_id" value="<?php echo $id; ?>">
<div class="col-sm-8"></div>
<div class="col-sm-4" style="border:1px solid black; padding-top: 15px;
    padding-bottom: 15px;">
<div class="col-sm-6">
<select name="my_profile_id" id="" class="form-control" style="width:180px">
<?php  $p = new _spprofiles;
$get_profile_data2 = $p->readProfiles2($_SESSION['uid']);
if ($get_profile_data2 != false){

while($row2 = mysqli_fetch_assoc($get_profile_data2)) {?>

<option value="<?php echo $row2['idspProfiles'];  ?>" ><?php echo $row2['spProfileName'];  ?></option>



<?php }

}
?>


</select>

</div>


<div class="col-sm-6">
<input type="submit" class="btn btn-primary float-right" name="" value="Switch & Save">
</div>
</div>
</div>




<br><br>

</div>
<!--shashi-->
<?php
$g = new _spprofiles;
$get =$g->get($id);
$row = mysqli_fetch_assoc($get);

?>

<?php
$rec=$row['spProfileType_idspProfileType'];

$result31 = $g->person($rec);

$row1 = mysqli_fetch_assoc($result31);
    $friend= $row1['spProfileTypeName'];
?>


<h5>Currently connected with: <a href="<?php echo $BaseUrl . "/friends/?profileid=" . $row["idspProfiles"]; ?>"><?php print_r($row['spProfileName']); ?> (<?php echo $friend ?>) </a></h5><?php

?>	

<div style="width: 100%;" class="container bg-white p-5 mt-5 table-responsive">

<table class="table table-striped table-bordered table-hover" border="1" id= "example" cellspacing="0" cellpadding="">
	<thead>

<tr>
<th>Select</th>
<th>Profile Picture</th>
<th>Name</th>
<th>Profile Type</th>

</tr>
</thead>
<tbody>
<?php


$b = array();

$r = new _spprofilehasprofile;

$pv = new _postingview;

$res = $r->readall($id);

if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {

$p = new _spprofiles;

$sender = $rows["spProfiles_idspProfileSender"];
array_push($b, $sender);
$result = $p->read($rows["spProfiles_idspProfileSender"]);



if ($result != false) {
$row = mysqli_fetch_assoc($result);


$totalFrnd = $r->countTotalFrnd($row['idspProfiles']);
//get friend store
$result3 = $pv->singlefriendstore($sender);
if ($result3 != false) {
if (mysqli_num_rows($result3) > 0) {
$storeshow = mysqli_num_rows($result3);
} else {
$storeshow = 0;
}
} else {
$storeshow = 0;
}


//$row['spProfilePic']
//echo ucwords($row["spProfileName"]  
//$row["spProfileTypeName"]  
//$totalFrnd;

echo "<tr>";
echo "<td><input type='checkbox' value='".$row['idspProfiles']."'   name='profile_id[]'></td>";

echo "<td>";
if ($row['spProfilePic']) {
    echo "<img height='50px;' src=\"" . $row['spProfilePic'] . "\">";
} else {
    echo "<img height='50px;' src=\"" . $BaseUrl . "/img/noman.png\">"; 
}
echo "</td>";

echo "<td>".$row['spProfileName']."</td>";
echo "<td>".$row['spProfileTypeName']."</td>";



echo "</tr>";




}
}
}


$r = new _spprofilehasprofile;
$res = $r->readallfriend($_SESSION["pid"]); //As a sender
// print_r($res);
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {

$rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
if ($rm == "") {
$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];

$row = mysqli_fetch_assoc($result);
$totalFrnd2 = $r->countTotalFrnd($row['idspProfiles']);

//get friend store
$result3 = $pv->singlefriendstore($receive);
if ($result3 != false) {
if (mysqli_num_rows($result3) > 0) {
$storeshow = mysqli_num_rows($result3);
} else {
$storeshow = 0;
}
} else {
$storeshow = 0;
}

echo "<tr>";
echo "<td><input type='checkbox' value='".$row['idspProfiles']."'   name='profile_id[]'></td>";

if ($row['spProfilePic']) {
    echo "<td><img height='50px;' src='" . $row['spProfilePic'] . "'></td>";
} else {
    echo "<td><img height='50px;' src='" . $BaseUrl . "/assets/images/icon/blank-img.png'></td>";
}

echo '<td><a href="'. $BaseUrl . '/friends/?profileid=' . $row['idspProfiles'] . '">' . $row['spProfileName'] . '</a></td>';
echo "<td>".$row['spProfileTypeName']."</td>";



echo "</tr>";


}
}
}
} 
?>



</tbody>

</table>


</form>


</div>
</div>
</div>





</div>
</div>
</div>





</div>
</section>


<?php include('../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->



</body> 
</html>
<?php
} ?>





<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example1').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
