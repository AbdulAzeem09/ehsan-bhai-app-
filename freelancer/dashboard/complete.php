<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/





include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="freelancer/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 15;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style>
#example1_length{margin:10px;}
#example1_filter{padding-top: 8px;padding-right: 10px;}
#example1_info{margin-left: 10px;}
#profileDropDown li.active {
background-color: #c45508;
margin-top:-1px;
}
#profileDropDown li.active a {
color: #fff;
}
ul#profileDropDown {
border: none;
}	
</style>
</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage" style="margin-top: 10px;">

<div class="sidebar col-xs-3 col-sm-3" id="sidebar" >

<?php include('left-menu.php');?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">

<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li>Completed Projects</li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
</ul>
</div>
</div>

<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
<li>Complete Projects</li>

</ul>
</div>
</div> -->




<div class="col-xs-12 nopadding dashboard-section">



<ul class="nav nav-tabs">
<!--<li class="active"><a data-toggle="tab" href="#home">Completed Project11</a></li>
<li><a data-toggle="tab" href="#menu1">Hire Freelancer Project</a></li>-->
<!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
<li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
</ul>
<?php 
$sf  = new _freelancerposting;

//   $res = $p->myCmpPro(5, $_SESSION['pid']);

$res = $sf->myCmpleteincompletePro1(5, $_SESSION['pid']);
$table= $res->num_rows;
// echo $table; 

if($table!=""){
$example="example1";
}
else{
$example="example"; 
}
?>

<div class="col-xs-12 dashboardtable">
<div class="table-responsive">
<?php if($res!=false){
$example ="example";
}else{
$example =" ";
}
	?>


<div class="tab-content">
<div style="margin-top:10px" id="home" class="tab-pane fade in active">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table  id="<?php echo $example; ?>" class="table text-center tbl_activebid display" >
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th></th>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Project Name</th>
<th style="color:#fff;">Total Bids</th>
<th style="color:#fff;">Price</th>
<!--<th style="color:#fff;">status</th>-->
<!-- <th  style="color:#fff;">Review</th> -->
<th  style="color:#fff;">Start Date</th>
<th  style="color:#fff;">Completion Date</th>
</tr>
</thead>
<tbody>
<?php

// $p = new _postings;

//var_dump($res);

// echo $sf->ta->sql;

if($res!=false){

while($row = mysqli_fetch_assoc($res)){

//print_r($row);


$dt = new DateTime($row['spPostingExpDt']);

//$pf = new _postfield;

// totalbids1


//$result_pf = $pf->totalbids($row['idspPostings']);
$sfbid = new  _freelance_placebid;

// $respos = $pos->totalbids($_GET['project']);

//$respos = $sfbid->totalbids1($_GET['project']);
// $bids = $po->totalbids($_GET['project']);

$bids = $sfbid->totalbids1($row['idspPostings']);
//echo $sf->ta->sql;
if($bids){
$totalbids = $bids->num_rows;
}else{
$totalbids = 0;
}

?>
<tr>
<!-- Modal -->
<div id="myproject-<?php echo $row['idspPostings'];?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addmilestone.php">
<div class="modal-content no-radius milestone_modal">
<div class="modal-header">
<button type="button" class="close " data-dismiss="modal">&times;</button>
<h4 class="modal-title freelancer_capitalize"><?php echo $row['spPostingTitle'];?></h4>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
<input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $row['idspProfiles']; ?>">
<input type="hidden" name="milestoneStatus" value="0" >
<input type="hidden" name="milestoneSubmitDate" value="<?php echo date('Y-m-d'); ?>">
<div class="row add_form_body">
<div class="col-md-6">
<div class="form-group">
<label for="Amount">Amount</label>
<input type="text" class="form-control" name="milestonePrice" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="Deliver Day">Deliver Day</label>
<input type="date" class="form-control" name="milestoneDeliverDay" >
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label for="Description">Description</label>
<textarea name="milestoneDescription" class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default realeseclose_btn" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary realesesave_btn"  >Save</button>
</div>
</div>
</form>
</div>
</div>
<td><?php //echo $row['idspPostings'];?></td>
<td><?php echo $row['idspPostings'];?></td>
<td ><a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a></td>
<td><?php echo $totalbids;?></td>
<td><?php echo $row['Default_Currency']." ". $row['spPostingPrice'];?></td>
<!--<td><?php 


if($row['complete_status'] == 1){

echo "Completed";

}else{

echo "In-Completed";

}


/* echo $dt->format('M d, Y'); */




?></td>-->

<td >

<?php 

$fps = new _freelance_project_status;
$acceptpr = $fps->readAceptproject($row['idspPostings']);
if($acceptpr!=false){
$projectrow = mysqli_fetch_assoc($acceptpr);
}

?>


<div id="submitReco<?php echo $row['idspPostings']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="../addrecomndation.php">
<div class="modal-content no-radius">
<div class="modal-header text-left">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Write a Review</h4>
</div>
<div class="modal-body text-left">
<div class="row">
<div class="col-sm-12">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings'];?>" />
<input type="hidden" name="postProject_idspProfiles" value="<?php echo $row['spProfiles_idspProfiles']; ?>" />

<input type="hidden" name="freelanceProject_idspProfiles" value="<?php echo $projectrow['spProfiles_idspProfiles']; ?>" />
<input type="hidden" name="hired" value="0" />
<input type="hidden" name=" recomnd_date" value="<?php echo date('Y-m-d h:s'); ?>" />
<?php

/*   $res2 = $p->singletimelines($_GET['postid']);
if($res2){
$row2 = mysqli_fetch_assoc($res2);
if($_SESSION['pid'] == $row2['idspProfiles']){ 
//jis ny post kiya project ?>
<input type="hidden" name="recomnd_status" value="1" /> <?php
//header('location:'.$BaseUrl.'/freelancer');
}else{
//freelancer ?>
<input type="hidden" name="recomnd_status" value="0" /> <?php
}
}*/
?>

<div class="form-group">
<label for="email">Write a Review</label>
<textarea class="form-control no-radius" maxlength="100" name="desc_recomndation"></textarea>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label for="email">Rating</label><br>
<div class="radio">
<label><input type="radio" name="recomnd_rating" value="1">1</label>
<label><input type="radio" name="recomnd_rating" value="2">2</label>
<label><input type="radio" name="recomnd_rating" value="3">3</label>
<label><input type="radio" name="recomnd_rating" value="4">4</label>
<label><input type="radio" name="recomnd_rating" value="5">5</label>
</div>


</div>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary" >Save</button>
</div>
</div>
</form>
</div>
</div>


<?php 

$fc = new _freelance_recomndation;
$check = $fc->checkpostedreview($_SESSION['pid'],$row['idspPostings']);

/*  print_r($check);*/
if($check!=false){
$row21 = mysqli_fetch_assoc($check);
if($check->num_rows <= 0){
?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#submitReco<?php echo $row['idspPostings']; ?>" class="btn btn-info"> Review</a>

<?php }else{

?>

<div id="reviewgivenhire<?php echo $row['idspPostings']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="../addrecomndation.php">
<div class="modal-content no-radius">
<div class="modal-header text-left">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Review</h4>
</div>
<div class="modal-body text-left">
<div class="row">
<div class="col-sm-12">


<div class="form-group">

<p><?php echo $row21['desc_recomndation']; ?></p>
</div>
</div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</form>
</div>
</div>




<?php }} ?>    

<?php
//$post = new _postings;

$sf  = new _freelancerposting;
//$result = $post->chkProjectStatus($row['idspPostings']);
$result = $sf->chkProjectStatus1($row['idspPostings']);

// echo $sf->ta->sql;




?>

</td>
<?php if($row['spPostingDate'] != "") { ?>
<td><?php $accept_date = date("d-m-Y", strtotime($row['spPostingDate']));  echo $accept_date; ?></td>
<?php } else { ?>
<td>--</td>
<?php } ?>
<?php if($row['complete_date'] != "") { ?>
<td><?php $complete_date = date("d-m-Y", strtotime($row['complete_date']));  echo $complete_date; ?></td>
<?php } else { ?>
<td>--</td>
<?php } ?>
</tr> <?php
}
}else{
echo "<td colspan='8'><center>No Record Found</center></td>";
}
?>


</tbody>
</table>

</div>

<!--
<div id="menu1" class="tab-pane fade">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table text-center tbl_activebid display" id="example2">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Project Title</th>
<th style="color:#fff;">Price</th>
<th style="color:#fff;">status</th>
<th class="action text-center" style="color:#fff;text-align: center;">Review</th>
</tr>
</thead>
<tbody>-->


<?php

$sf  = new _freelance_chat_project;

$res = $sf->completedincompletedproject($_SESSION['pid']);

$i=0;
if($res){

while($row = mysqli_fetch_assoc($res)){

$i++;

/* print_r($row);*/

$f = new _spprofiles;

$pro = $f->read($row['receiver_idspProfiles']);
if($pro!=false){
$pro_data = mysqli_fetch_assoc($pro);




$dtf = new DateTime($row['chat_date']);
?>
<tr>
<td><?php //echo $row['id']; ?></td>

<td >

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row['id'];?>" class="red freelancer_capitalize"  ><?php //echo "Project for " .ucfirst($pro_data['spProfileName']);?></a></td>

<td><?php //echo $row['bidPrice'];?></td>


<td><?php 


if($row['complete_status'] == 1){

//echo "Completed";

}else{

echo "In-Completed";

}


/* echo $dt->format('M d, Y'); */




?></td>
<td class="text-center">
<?php /*if($row['status'] == 0){

echo "Pending";

}elseif ($row['status'] == 1) {

echo "Accepted";
?>



<?php

}else{

echo "Rejected";
} */

}  ?> 

<div id="submitRec<?php echo $row['id']; ?>" class="modal fade" role="dialog">

<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="../addrecomndation.php">
<div class="modal-content no-radius">
<div class="modal-header text-left">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Write a Review</h4>
</div>
<div class="modal-body text-left">
<div class="row">
<div class="col-sm-12">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['id'];?>" />
<input type="hidden" name="postProject_idspProfiles" value="<?php echo $row['sender_idspProfiles']; ?>" />

<input type="hidden" name="freelanceProject_idspProfiles" value="<?php echo $row['receiver_idspProfiles']; ?>" />
<input type="hidden" name="hired" value="1" />
<input type="hidden" name=" recomnd_date" value="<?php echo date('Y-m-d h:s'); ?>" />
<?php

/*   $res2 = $p->singletimelines($_GET['postid']);
if($res2){
$row2 = mysqli_fetch_assoc($res2);
if($_SESSION['pid'] == $row2['idspProfiles']){ 
//jis ny post kiya project ?>
<input type="hidden" name="recomnd_status" value="1" /> <?php
//header('location:'.$BaseUrl.'/freelancer');
}else{
//freelancer ?>
<input type="hidden" name="recomnd_status" value="0" /> <?php
}
}*/
?>

<div class="form-group">
<label for="email">Write a Review</label>
<textarea class="form-control no-radius" maxlength="100" name="desc_recomndation"></textarea>
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label for="email">Rating</label><br>
<div class="radio">
<label><input type="radio" name="recomnd_rating" value="1">1</label>
<label><input type="radio" name="recomnd_rating" value="2">2</label>
<label><input type="radio" name="recomnd_rating" value="3">3</label>
<label><input type="radio" name="recomnd_rating" value="4">4</label>
<label><input type="radio" name="recomnd_rating" value="5">5</label>
</div>


</div>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary" >Save</button>
</div>
</div>
</form>
</div>
</div>



<?php   

$fc = new _freelance_recomndation;
$check = $fc->checkreview($_SESSION['pid'],$row['id']);



if(!empty($check )){

$row21 = mysqli_fetch_assoc($check);

?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#submitRec<?php echo $row['id']; ?>" class="btn btn-info"> Review</a>

<?php }else{
?>

<div id="reviewgiven<?php echo $row['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="../addrecomndation.php">
<div class="modal-content no-radius">
<div class="modal-header text-left">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Review</h4>
</div>
<div class="modal-body text-left">
<div class="row">
<div class="col-sm-12">


<div class="form-group">

<p><?php echo $row21['desc_recomndation']; ?></p>
</div>
</div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</form>
</div>
</div>



<?php   } ?>                  


<!--   <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red" ><i class="fa fa-eye"></i></a>
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'].'&exp=1'; ?>"><img src="<?php //echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" ></a> -->

</td> 


<?php

}
}else{
//echo "<td colspan='5'><center>No Record Found</center></td>";
}

?>
</tr>

</tbody>
</table>


</div>





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






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                paging: true, // Enable pagination
                select: false,
                columnDefs: [{
                    className: "Name",
                    targets: [0],
                    visible: false,
                    searchable: false
                }]
            });

            $('#example tbody').on('click', 'tr', function() {
                // Handle row click event here
            });
        });
    </script>





</body>
</html>
<?php
} ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script>
var table = $('#example1').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>	 
<script>
var table = $('#example2').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>	