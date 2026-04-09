<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>

<?php
$g = new _spgroup;
$result = $g->members_pending_reply($_GET["groupid"], $_SESSION['pid']);
//echo $g->ta->sql;
if ($result == true) {
header("Location: " . $BaseUrl . "/my-groups/");
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<!-- this script for slider art -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

<style type="text/css">
.rating-box {
position: relative !important;
vertical-align: middle !important;
font-size: 18px;
font-family: FontAwesome;
display: inline-block !important;
color: lighten(@grayLight, 25%);
padding-bottom: 10px;
}

.rating-box:before {
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute !important;
left: 0;
top: 0;
white-space: nowrap !important;
overflow: hidden !important;
color: Gold !important;

}

.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.selldiscusshead {
background-color: #1c4994 !important;
color: #fff;
border-top-left-radius: 15px;
border-top-right-radius: 15px;
}
</style>



</head>

<body class="bg_gray">
<?php include_once("../header.php");


$g = new _spgroup;
$result12 = $g->groupdetails($_GET["groupid"]);
//echo $g->ta->sql;
if ($result12 != false) {
$row12 = mysqli_fetch_assoc($result12);

// print_r($row12);
$groupname = $row12["spGroupName"];
}
?>


<?php $p = new _spgroupmessage;
$messageid = isset($_GET['messageid']) ? (int) $_GET['messageid'] : 0;
$res1 = $p->readmessage($messageid);

if ($res1 != false) {
$row1 = mysqli_fetch_assoc($res1);

// echo "<pre>";
// print_r($row1['spGroup_idspGroup']);

$groupid = $row1['spGroup_idspGroup'];
}



$g = new _spgroup;

$resgp = $g->groupdetails($row1['spGroup_idspGroup']);

if ($resgp != false) {
$rowgp = mysqli_fetch_assoc($resgp);

// echo "<pre>";
// print_r($rowgp['spGroupName']);

$group_name = $rowgp['spGroupName'];
}




?>
<section class="main_box">
<div class="container">


<div class="row">


<div class="col-md-12">
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">


<!--   <?php print_r($_SESSION['pid']); ?>

<?php print_r($_SESSION['uid']); ?> -->

<!--  <?php print_r($_GET["postid"]); ?>  -->

<div class="row">
<div class="showeventrating">

<ol class="breadcrumb" style="padding: 8px 0px;margin-bottom: 0px!important;list-style: none;background-color: unset!important;border-radius: 4px;">
<li><a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $groupid; ?>&groupname=<?php echo $group_name; ?>&timeline"><i class="fa fa-home"></i> Timeline</a></li>
<li><a href="<?php echo $BaseUrl; ?>/grouptimelines/discussion-board.php?groupid=<?php echo $groupid; ?>&groupname=<?php echo $group_name; ?>&disc">Discussion Board</a></li>
<li class="active ">Replies</li>
</ol>



<div>


<!-- <img src="<?php //echo $BaseUrl;
?>/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 70px;"><p style="font-size: 30px;">The SharePage</p></div>-->


<?php

$gc = new _groupconversation;


$result2 = $gc->readCreaterMsg($row1["idspGroupMessage"]);
if ($result2 != false) {
$row2 = mysqli_fetch_assoc($result2);
}

$r = new _groupdiscussreply;

$sumres = $r->readdiscussmsg($messageid);

//echo $r->ta->sql; 

//print_r($sumres->num_rows); 

$totalreplies = $sumres->num_rows;







?>

<div class="row ">
<div class="col-md-12">
<p class="eventcapitalize" style="font-size: 16px; margin-bottom: -14px;">Group Name :<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $groupid; ?>&groupname=<?php echo $group_name; ?>"> <?php echo $group_name; ?></a></p><br>
<p class=" eventcapitalize" style="font-size: 16px; margin-bottom: -14px;">Topic : <?php echo $row1['spGroupMessage']; ?></p>
<p class="eventcapitalize" style="font-size: 16px; padding-top: 14px;">Message : <?php echo $row2['spGroupConversationText']; ?></p>
<br>
</div>
</div>
<div class="row ">
<div class="col-md-12">
<!-- <div style="position: absolute; top: 4px; right: 16px;"> -->
<div style="float: right; top: 4px; right: 16px;">



<p style=" padding-left: 3px; font-size: 20px; text-align: right ;">Replies <?php if ($totalreplies > 0) {
echo $totalreplies;
} else {
echo "0";
} ?></p>
</div>
</div>
</div>



</div>

<h4 style="text-align: left;">Replies</h4>


<?php $pro = new _spprofiles;



$r = new _groupdiscussreply;

$res = $r->readdiscussmsg($messageid);
// echo $r->ta->sql;  

//print_r($res);

if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {


$result = $pro->read($row['spreplyerProfileId']);

//echo $pro->ta->sql; 

$picture = $profilerow["spProfilePic"];

$row3 = mysqli_fetch_assoc($result);

$postingDate = $r->spreplyPostingDate($row["currentdate"]);

$picture = $row3["spProfilePic"];

?>




<div class="row">
<div class="col-md-2" style="width: 11%!important;">


<?php
if (isset($picture) && $picture != '') {
?>
<img id="profilepic" data-media="<?php echo (isset($picture) ? "1" : "0"); ?>" src="<?php echo (isset($picture)) ? ($picture) : ''; ?>" alt="Profile Pic" class="img-responsive" style="height: 70px;
border-radius: 100%;
width: 75px;">
<?php
} else {
?>
<img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 70px;
border-radius: 100%;
width: 75px;">
<?php
}
?>
</div>





<div class="col-md-10">

<p class="eventcapitalize"><b><a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $row3['spProfileName']; ?></a></b></p>
<p><?php echo $row['currentdate']; ?></p>
<p><?php echo $row['sellercomments']; ?></p>

</div>






</div>
<br>

<?php  }
} else { ?>

<div style="text-align: left;">No Reply Available</div>

<?php  }



?>






</div>
</div>





</div>



</div>


<!-- show discussion close -->
<div class="col-md-12">
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">

<div class="row" style="margin-left: 20px; margin-right: 20px; margin-top: 15px; margin-bottom: 10px;">

<div class="col-md-12">



<input type="hidden" name="spreplyerProfileId" id="spreplyerProfileId" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="comment_id" id="comment_id" value="<?php echo $messageid; ?>">
<div class="form-group">
<label for="sell1">Enter your message <span class="red">*</span></label>
<textarea class="form-control" name="sellercomments" id="sellercommentid" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>


<button type="button" class="btn btn-primary pull-right btn-border-radius" onclick="get_commentdata()" style="background-color: #1c4994; color: #fff; border: none; min-width: 100px; margin-top: 20px;">Submit</button>


</div>
</div>

</div>


</div>

</div>


<!-- 
<div class="col-md-12">
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">

<div class="table-responsive">
<table class="table table_black_head text-center grpconversation " style="margin-top: 15px;">
<thead id="bgcl">
<tr>
<th>Topic</th>
<th>Post By</th>
<th>Reply</th>                                                            
<th>Replies</th>
</tr>
</thead>
<tbody>
<?php
$profileid = $_SESSION['pid'];
//Admin Testing Complete
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $_GET["groupid"]);
//echo $g->tad->sql;
if ($pr != false) {
$row = mysqli_fetch_assoc($pr);
$admin = $row["spProfileIsAdmin"];
//  print_r($row);
}
$gc = new _groupconversation;
$m = new _spgroupmessage;
$res = $m->read($_GET["groupid"]);
//QUERY FOR CHEK HOW MANY PERSON IS ONLINE OR NOT
//echo $m->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$latestreply = "";
$totalreply = 0;
$result = $gc->read($rows["idspGroupMessage"]);


$r = new _groupdiscussreply;

$sumres = $r->readdiscussmsg($rows["idspGroupMessage"]);

//echo $r->ta->sql; 

//print_r($sumres->num_rows); 

$totalreplies = $sumres->num_rows;


if ($result != false) {

$totalreply = $result->num_rows;
while ($row = mysqli_fetch_assoc($result)) {
$latestreply = $row["spProfileName"];
$datetime = $row["spGroupConversationDate"];
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
} else {
$datetime = isset($rows["spGroupMessageDate"]);
$latestreply = isset($rows["spProfileName"]);
$datetime = isset($row["spGroupConversationDate"]);
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
$result1 = $gc->readCreaterMsg($rows["idspGroupMessage"]);
if ($result1 != false) {
$row1 = mysqli_fetch_assoc($result1);
}

if (isset($admin) == 0 && $rows["spGroupMessageFlag"] != 2) { //Admin Approval And rejection
?>
<tr>
<td>
<a href="<?php echo $BaseUrl; ?>/grouptimelines/discussion-chat.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&sendrid=<?php echo $profileid; ?>&gid=<?php echo $rows["idspGroupMessage"]; ?>&disc"><h3 class="eventcapitalize"><?php echo $rows["spGroupMessage"]; ?></h3></a>
<p><?php echo $row1['spGroupConversationText']; ?></p>
</td>
<td>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
</td>



<td><?php if ($totalreplies > 0) {
echo $totalreplies;
} else {
echo "0";
} ?></td>

<td>


<a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage']; ?>" class=""><i class="fa fa-eye"></i></a>



</td>
</tr>  
<?php
} else { //Only Approved message seen by group Member
if ($rows["spGroupMessageFlag"] == 0) {
?>
<tr>
<td>
<h3  class="eventcapitalize"data-senderprofile ="<?php echo $profileid; ?>" data-gid = "<?php echo $rows["idspGroupMessage"]; ?>">
<a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage']; ?>" class=""><?php echo $rows["spGroupMessage"]; ?></a></h3>
<p><?php echo $row1['spGroupConversationText']; ?></p>
</td>
<td class="eventcapitalize">
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
</td>

<td><a href="" class="btn" data-toggle="modal"
data-target="#mycomment<?php echo $rows['idspGroupMessage']; ?>" style="color: #fff!important;  background-color: #1c4994; border-radius: 20px;">Reply</a></td> 


<td> 
<a href="javascript:void(0)" data-postid="<?php echo $rows['idspGroupMessage']; ?>" class="deldiscussion" ><i class="fa fa-trash"></i></a>


</td>


<div class="modal fade" id="mycomment<?php echo $rows['idspGroupMessage']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">


<div class="modal-content no-radius bradius-15">
<div class="modal-header selldiscusshead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Reply</h3>

</div>
<div class="modal-body">


<input type="hidden" name="spreplyerProfileId" id="spreplyerProfileId<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="comment_id" id="comment_id<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $rows['idspGroupMessage']; ?>">    
<div class="form-group">
<label for="sell1">Enter your message <span class="red">*</span></label> 
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $rows['idspGroupMessage']; ?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
<button type="button" class="btn btn-primary" 

onclick="get_commentdata(<?php echo $rows['idspGroupMessage']; ?>)" style="background-color: #1c4994; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
</div>
</div>

</div>
</div>

</div>                                                                   
</tr>  
<?php
}
}
}
} else { ?>

<tr>
<td colspan="4">

<p class="text-center">Discussion board result not available</p>
<td></tr>

<?php  } ?>

</tbody>
</table>
</div>
</div>
</div> -->

</div>
</div>

</section>


<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>

<script type="text/javascript">
function get_commentdata() {
//alert();


var comment_id = $("#comment_id").val()

var spreplyerPId = $("#spreplyerProfileId").val()

var sellercommentid = $("#sellercommentid").val()


//alert(comment_id);
//alert(spreplyerPId);
//alert(sellercommentid);

if (sellercommentid == "") {

$("#sellercommentid_error").text("Please Enter Message.");
$("#sellercommentid").focus();


return false;
} else {
$.ajax({
type: 'POST',
url: 'add-discussioncomment.php',
data: {
comment_id: comment_id,
spreplyerProfileId: spreplyerPId,
sellercomments: sellercommentid
},


success: function(response) {

//console.log(data);
window.location.reload();
// swal({

//         title: "Message Submitted Successfully!",
//         type: 'success',
//         showConfirmButton: true

//     },
//     function() {



//         /*    location.href = "<?php echo $BaseUrl; ?>/grouptimelines/discussion-board.php?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $groupname; ?>&disc";*/

//         /*   location.href = "<?php echo $BaseUrl; ?>/grouptimelines/show_discussedreply.php?groupid=".$$_GET["groupid"].'&groupname='.$groupname.';*/

//         /*  location.href = <?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?groupid=' . $_GET["groupid"] . '&groupname=' . $groupname . '&disc' ?>

//         */
//     });
var title = '<strong>Message Submitted Successfully!</strong>';

showNofification(title);

}
});

}


}
</script>
<script>
function showNofification(title) {
$.notify({
title: title,

message: ""
}, {
type: 'success',
animate: {
enter: 'animated fadeInUp',
exit: 'animated fadeOutRight'
},
placement: {
from: "top",
align: "right"
},
offset: 30,
spacing: 10,
z_index: 1031,
});
}
</script>

</body>

</html>
<?php
}
?>
