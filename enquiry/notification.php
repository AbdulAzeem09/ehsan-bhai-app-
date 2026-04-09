<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();
//print_r($_SESSION);
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "timeline/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _postenquiry;
$resup = $p->updatenotificationallnoti();
//print_r($_SESSION);die('rrrrrrr');

$NotiId = isset($_GET['NotiId']) ? (int) $_GET['NotiId'] : 0;
if( $NotiId){
    $resNoti = $p->delete_notification($NotiId);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../component/f_links.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">



</head>

<style>
.acpt_req, .rjct_req {
    border: none; background: none;
}
.acpt_req img {width: 25px;}
.rjct_req img {width: 29px;}


div#notification_section .panel.panel-default {
background: #EAEAEA;
}

div#notification_section .panel .panel-heading {
text-align: center;
padding: 16px 10px;
font-size: 22px;
color: #000;
font-weight: 600;
letter-spacing: 0.5px;
font-family: 'Marksimon';
}

div#notification_section .panel .panel-heading i.fa.fa-bell {
font-size: 20px;
margin-right: 4px;
}

div#notification_section .panel .panel-body {
padding: 10px;
}

div#notification_section .panel .panel-body .table thead tr {
background: #fff;
display: table;
width: 100%;
margin: 0rem auto;
}

div#notification_section .panel .panel-body .table thead tr th {
padding: 14px 10px;
color: #2e2eb7d4;
font-size: 15px;
width: 74px;
}

div#notification_section .panel .panel-body .table tbody tr {
display: table;
width: 100%;
margin: 1rem auto;
background: #fff;
}

div#notification_section .panel .panel-body .table tbody tr td {
padding: 14px 10px;
font-size: 14px;
width: 130px;
}

div#notification_section .panel .panel-body .notif_table tbody tr td {
padding: 14px 10px;
font-size: 14px;
width: 74px;
}

div#notification_section .panel .panel-body .table tbody tr td img.img-circle {
width: 38px;
height: 38px;
}

div#notification_section .panel .panel-body .table tbody tr td img.img-circle-grp {
width: 38px;
height: 38px;
border-radius: 50px;
}

div#notification_section .panel button.btn.btn-primary {
border-radius: 50px;
color: #fff;
cursor: pointer;
text-align: center;
border: none;
background-size: 300% 100%;
moz-transition: all .4s ease-in-out;
-o-transition: all .4s ease-in-out;
-webkit-transition: all .4s ease-in-out;
transition: all .4s ease-in-out;
background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
}

div#notification_section .panel .panel-body .table thead tr th ul.main {
margin: 0;
padding: 0;
}

div#notification_section .panel .panel-body .table tbody tr td ul {
padding: 0;
margin: 0;
}

div#notification_section .panel .panel-body .table thead tr th ul.main li {
display: block;
font-size: 15px;

color: #2e2eb7d4;
}

div#notification_section .panel .panel-body .table thead tr th ul.main li input#select_all {
position: relative;
top: 1px;
}

div#notification_section .panel .panel-body .table tbody tr td img.img-circle {
float: left;
margin-right: 10px;
margin-left:-20px;
}

div#notification_section .panel .panel-body .table tbody tr td img.img-circle-grp {
float: left;
margin-right: 10px;
margin-left: 10px;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(1) {
max-width: 66px;
}

div#notification_section .panel .panel-body .grp_noti .table tbody tr td:nth-child(1) {
max-width: 90px;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(2) {
max-width: 114px;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(3) {
max-width: 130px;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(4) {
max-width: 86px;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(5) {
max-width: 94px;
}

@media only screen and (max-width: 767px) {

div#notification_section .panel .panel-heading {
display: inline-block;
}

div#notification_section .panel button.btn.btn-primary {
float: none !important;
margin-top: 10px;
}

div#notification_section .panel .panel-body .table thead tr th {
width: auto;
}

div#notification_section .panel .panel-body .table tbody tr td {
width: auto;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(1) {
max-width: inherit;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(2) {
max-width: inherit;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(3) {
max-width: inherit;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(4) {
max-width: inherit;
}

div#notification_section .panel .panel-body .table tbody tr td:nth-child(5) {
max-width: inherit;
}

#select_all {
margin-bottom: 7px !important;
}
}


div#notification_section .panel .panel-body .table tbody tr td {
    width: 100px !important;
}
</style>

<body class="bg_gray" onload="pageOnload('notification')">

<?php include_once("../header.php"); ?>
<section class="landing_page">
<div class="container pubpost">
<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php'); ?>
</div>
<div class="col-md-10" id="notification_section">
<div class="row m_top_10">
<div class="col-md-12">
<form action="delete_notification.php" method="POST">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-bell"></i> YOUR NOTIFICATIONS

<button type="submit" class="btn btn-primary" onclick="return checkCheckbox()" style="float:right">Clear Notifications</button>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<th>
<ul class='main'>
<li style=""><input type="checkbox" id="select_all" /></li>
</ul>
</th>
<th>SENDER</th>
<th>RECEIVER</th>
<th>DESCRIPTION</th>
<th>MODULE</th>
<th>DATE</th>
<th>ACTION</th>

</thead>
<tbody>
<?php
$p = new _postenquiry;
$sf = new _freelancerposting;
$res = $p->readnotification($_SESSION['uid']);


$gp = new _sppostenquiry;
$gpn = $gp->group_notification($_SESSION['pid']);

//var_dump($res);
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) { 
//print_r($row);
//die('==');
$iddd = $row['id'];

$postid = $row['spPostings_idspPostings'];



$cre = date("d-m-Y", strtotime($row["created"]));
$profile_type = "";
if ($row['spProfileType_idspProfileType'] == 1) {
$profile_type = "Bussiness Profile";
} else if ($row['spProfileType_idspProfileType'] == 2) {
$profile_type = "Freelancer Profile";
} else if ($row['spProfileType_idspProfileType'] == 3) {
$profile_type = "Professional Profile";
} else if ($row['spProfileType_idspProfileType'] == 4) {
$profile_type = "Personal Profile";
} else if ($row['spProfileType_idspProfileType'] == 5) {
$profile_type = "Employement Profile";
} else if ($row['spProfileType_idspProfileType'] == 6) {
$profile_type = "Family Profile";
}
$picture = $row['spProfilePic'];
$buyerProfileid = $row['sellerProfileid'];
$resbuyer = $p->buyerProfileName($buyerProfileid);
if($resbuyer){
$rowbuyer = mysqli_fetch_assoc($resbuyer);
}
$profile_buyer = "";
if ($rowbuyer['spProfileType_idspProfileType'] == 1) {
$profile_buyer = "Bussiness Profile";
} else if ($rowbuyer['spProfileType_idspProfileType'] == 2) {
$profile_buyer = "Freelancer Profile";
} else if ($rowbuyer['spProfileType_idspProfileType'] == 3) {
$profile_buyer = "Professional Profile";
} else if ($rowbuyer['spProfileType_idspProfileType'] == 4) {
$profile_buyer = "Personal Profile";
} else if ($rowbuyer['spProfileType_idspProfileType'] == 5) {
$profile_buyer = "Employement Profile";
} else if ($rowbuyer['spProfileType_idspProfileType'] == 6) {
$profile_buyer = "Family Profile";
}
if($rowbuyer['spProfilePic']){
$picturebuyer = $rowbuyer['spProfilePic'];
}else{
$picturebuyer = "../../img/default-profile.png";
}
echo "<tr>";
if (isset($row['spProfilePic'])) {
echo "<td>
<ul>
<li><input type='checkbox' class='checkbox' name='del[]' value='$iddd'/></li>
</ul>
</td>";
echo "<div><td><img alt='Posting Pic 1111' width='50' height='40' class='img-circle' src=' " . ($picture) . "'><a href='" . $BaseUrl . "/friends/?profileid=" . $row['idspProfiles'] . "'>
" . $row['spProfileName'] . "</a><p style='font-size:9px;'>" . $profile_type . "</p></td></div>";
// echo "<td><img alt='Posting Pic' width='50' height='40' class='img-circle' src=' ".($picture)."'></td>";
echo "<div><td><img alt='Posting Pic 1111' width='50' height='40' class='img-circle' src=' " . ($picturebuyer) . "'><a href='" . $BaseUrl . "/friends/?profileid=" . $rowbuyer['idspProfiles'] . "'>
" . $rowbuyer['spProfileName'] . "</a><p style='font-size:9px;'>" . $profile_buyer . "</p></td></div>";

// echo "<td>".$rowbuyer['spProfileName']."<br><span style='font-size:9px;'>".$profile_type."</span></td>";

$sendername=$row['spProfileName'];
if ($row["module"] == "Store") {
echo "<td><a href='" . $BaseUrl . "/store/detail.php?catid=1&postid=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/store/storeindex.php?condition=All&folder=home'>" . ucfirst($row["module"]) . "</a></td>";
}
elseif ($row["module"] == "Event"){
    echo "<td><a href='" . $BaseUrl . "/events/event-detail.php?postid=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/events/'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "Services"){
    echo "<td><a href='" . $BaseUrl . "/services/detail.php?postid=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/services/'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "Video"){
    echo "<td><a href='" . $BaseUrl . "/videos/watch.php?video_id=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/videos/index.php?page=1'>" . ucfirst($row["module"]) . "</a></td>";      



} elseif ($row["module"] == "Job board") {
    echo "<td><a href='" . $BaseUrl . "/job-board/job-detail.php?postid=" . $iddd . "'>" . $row['message'] . "</a></td>";
    echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/job-board'>" . ucfirst($row["module"]) . "</a></td>";
    }elseif ($row["module"] == "Timeline") {
        echo "<td><a href='" . $BaseUrl . "/publicpost/post_comment_details.php?postid=" . $postid . "&loadcom'>" . $row['message'] . "</a></td>";
        echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/timeline/'>" . ucfirst($row["module"]) . "</a></td>";
        }else {
echo "<td><a href='" . $BaseUrl . "/freelancer/project-detail.php?project=" . $iddd . "'>" . $row['message'] . "</a></td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/freelancer'>" . ucfirst($row["module"]) . "</a></td>";
}
echo "<td style='text-align: center;'>" . $cre . "</td>";
} else {

echo "<td>
<ul>
<li><input type='checkbox' class='checkbox' name='del[]' value='$iddd'/></li>
</ul>
</td>";
echo "<div><td><img alt='Posting Pic' width='50' height='40' class='img-circle' src='../../img/default-profile.png'><a href='" . $BaseUrl . "/friends/?profileid=" . $row['idspProfiles'] . "'>
" . $row['spProfileName'] . "</a><p style='font-size:9px;'>" . $profile_type . "</p></td></div>";

// echo "<td><img alt='Posting Pic' width='50' height='40' class='img-circle' src=' ".($picture)."'></td>";
echo "<div><td><img alt='Posting Pic 1111' width='50' height='40' class='img-circle' src=' " . ($picturebuyer) . "'><a href='" . $BaseUrl . "/friends/?profileid=" . $rowbuyer['idspProfiles'] . "'>
" . $rowbuyer['spProfileName'] . "</a><p style='font-size:9px;'>" . $profile_buyer . "</p></td></div>";

if ($row["module"] == "Store") {
echo "<td><a href='" . $BaseUrl . "/store/detail.php?catid=1&postid=" . $postid . "'>" . $row['message'] .  "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/store/storeindex.php?condition=All&folder=home'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "Event"){
    echo "<td><a href='" . $BaseUrl . "/events/event-detail.php?postid=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/events/'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "Services"){
    echo "<td><a href='" . $BaseUrl . "/services/detail.php?postid=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/services/'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "Video"){
    echo "<td><a href='" . $BaseUrl . "/videos/watch.php?video_id=" . $postid . "'>" . $sendername.' '.$row['message'] . "</a> to check!</td>";
    echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/videos/index.php?page=1'>" . ucfirst($row["module"]) . "</a></td>";
} elseif ($row["module"] == "job board") {
echo "<td><a href='" . $BaseUrl . "/job-board/job-detail.php?postid=" . $iddd . "'>" . $row['message'] . "</a></td>";
echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/job-board'>" . ucfirst($row["module"]) . "</a></td>";
}elseif ($row["module"] == "Timeline") {
    echo "<td><a href='" . $BaseUrl . "/publicpost/post_comment_details.php?postid=" . $postid . "&loadcom'>" . $row['message'] . "</a></td>";
    echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/timeline/'>" . ucfirst($row["module"]) . "</a></td>";
    } else {
    echo "<td><a href='" . $BaseUrl . "/freelancer/project-detail.php?project=" . $iddd . "'>" . $row['message'] . "</a></td>";
    echo "<td style='text-align: right;'><a href='" . $BaseUrl . "/freelancer'>" . ucfirst($row["module"]) . "</a></td>";
    }
echo "<td style='text-align: center;'>" . $cre . "</td>";
}
$href = "notification.php?NotiId=" . $row['id'];
echo "<td style='text-align: center;'><a onclick=\"permanentDelete('" . $href . "');\" class='btn btn-danger'>Remove</a></td>";



echo "</tr>";
}
}
?>
</form>
</tbody>
</table>

<div class="grp_noti table-responsive">
   <div class="panel-heading"><i class="fa fa-bell"></i> GROUP NOTIFICATIONS

<button type="submit" class="btn btn-primary" onclick="" style="float:right">Clear Notifications</button>
</div>
<?php 

    //echo $gpn;

    $gnoti='';

    if ($gpn != false) {
        while ($row = mysqli_fetch_assoc($gpn)) { 

            $pflnk = "href='/friends/?profileid=".$row['pid']."'";
            $pfim = "<img class='img-circle-grp img-responsive' src='".$row["pic"]."'/>";
            $grp = "<a class='grplnk_".$row['inv_id']."' href='/grouptimelines/?groupid=".$row['gid']."&groupname=".$row['group']."&timeline&page=1'>".$row['group']."</a>";

            $gnoti.="<tr><td><a $pflnk >".$pfim . $row['name']."</a></td>";
            $gnoti.="<td> You are invited to join</td>";
            $gnoti.="<td class='text-center'>".$grp."</td>";
            $gnoti.="<td>".$row['invdate']."</td>";
            $gnoti.="<td>                    
            <span onclick='action_invitation(this,".$row['inv_id'].")' class='acpt_req' title='Accept'><img src='../grouptimelines/images/accept.png'></span> &nbsp;&nbsp;&nbsp;
               <span onclick='action_invitation(this,".$row['inv_id'].")' title='Reject' class='rjct_req'><img src='../grouptimelines/images/reject.png'></span></td>";
            $gnoti.="</tr>";

        }
    }

?>
    <table class="table table-hover notif_table">
        <thead>
            <tr>
                <th>Sender</th>               
                <th>Message</th>
                <th>Group Name</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php echo $gnoti; ?>  

        </tbody>


    </table>
</div>


</div>
</div>
</div>
</div>
</div>

<?php if ($_GET["all"] == 1) { // this is old data get from the notification. 
?>
<div class="post_timeline m_top_10 no-padding" style="min-height: 550px;">
<div class="pop-up" style="margin-top:50px;">
<p id="aboutprofile"></p>

<!--Modal-->
<div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<form action="../conversation.php" method="post">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="enquireModalLabel">New message</h4>
</div>
<div class="modal-body">


<div id="senderdet">
<!--Dynamic load sender Details-->
</div>

<input type="hidden" id="messageid" name="spMessaging_idspMessage">

<input type="hidden" id="spConversationFlag" name="spConversationFlag" value="1" />

<div class="form-group">
<label for="message" class="form-control-label">Message</label>
<textarea class="form-control" id="message" rows="5" name="spConversation"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary sndnotification">Send message</button>
</div>
</form>
</div>
</div>
</div>
<!--collapes Complete-->

<?php

$p = new _postenquiry;
$res = $p->readnotification($_SESSION['uid']);
if ($res != false) {
echo "<div class='panel panel-default'>";
while ($row = mysqli_fetch_assoc($res)) {
print "<pre>";
print_r($row);
print "</pre>";


$cre = date("d-m-Y", strtotime($row["created"]));
//print_r($cre);

$picture = $row['spProfilePic'];
if (isset($row['spProfilePic']))
/*echo "<div class='panel-heading'><span style='cursor:pointer;' class='searchtimelines' data-profileid='".$row["idspProfiles"]."'><img alt='Posting Pic' width='50' height='40' class='img-circle' src=' ".($picture)."'>&nbsp;&nbsp;&nbsp<b style='color:#1a936f;'>(".$row["spProfileName"].")</b><strong></span>&nbsp&nbsp" .$row["message"]."</Strong></div>";*/
echo "<div class='panel-heading' style='padding-bottom: 29px;'><span style='cursor:pointer;' class='searchtimelines' data-profileid='" . $row["idspProfiles"] . "'><img alt='Posting Pic' width='50' height='40' class='img-circle' src=' " . ($picture) . "'>&nbsp;&nbsp;&nbsp<strong></span>&nbsp&nbsp" . $row["message"] . "</Strong><br><p> Date:" . $cre . "</p></div>";
else
/*echo "<div class='panel-heading'><img alt='Posting Pic' width='50' height='40' class='img-circle' src='../../img/default-profile.png' >&nbsp;&nbsp;&nbsp<b style='color:#1a936f;'>(".$row["spProfileName"].")</b><strong>&nbsp&nbsp" .$row["message"]."</Strong></div>";*/
echo "<div class='panel-heading' style='padding-bottom: 29px;'><img alt='Posting Pic' width='50' height='40' class='img-circle' src='../../img/default-profile.png' >&nbsp;&nbsp;&nbsp<strong>&nbsp&nbsp" . $row["message"] . "</Strong><br><p><span style='float:right;'> Date:" . $cre . " </span><br><span style='float:right;padding-top: 6px;'>" . ucfirst($row["module"]) . "</span></p>
</div>";

echo "<div class='panel-body'>";
echo "<div class='row'>";
echo "<div style='margin-left:1cm;'>";

echo "<div class='col-md-8'>";
echo "<div class='notify'>";
echo "<div class='allnotification'>";
$con = new _conversation;
$result = $con->readconversation($row["idspMessage"]);
if ($result != false) {
while ($rw = mysqli_fetch_assoc($result)) {
//wordwrap($rw['spConversation'],80,"<br>\n",true)
$reslt = $con->checkmessage($_SESSION["uid"], $rw['idspConversation']);
echo "<p class='" . ($rw['spConversationFlag'] == 1 && $reslt == false ? "fntstyle" : "") . "' style='word-wrap: break-word;max-width: 100%;'>" . $rw['spConversation'] . "</p>";
echo "<br>";
}
}
echo "</div>";
/*echo "<a href='#' class='replay' data-messageid='".$row["idspMessage"]."' data-toggle='modal' data-target='#conversationModal'> Reply</a><br><br>";*/
echo "</div>";

echo "</div>"; //col-md-8
echo "<div class='col-md-4'>";
echo "<div class='row'><div class='col-md-6 strong'>";
$p = new _postingview;
$r = $p->read($row["spPostings_idspPostings"]);
if ($r != false) {
while ($rows = mysqli_fetch_assoc($r)) {
echo $rows['spCategoryname'];
echo "<br>";
echo $rows['spPostingtitle'];
echo "<br>";
if ($rows['spPostingPrice'] == 0)
echo '0000';
else
echo $rows['spPostingPrice'];
}
}
echo "</div>";
echo "<div class='col-md-6'>";
/*$pic = new _postingpic;
$result = $pic->read($row["spPostings_idspPostings"]);
if($result!= false)
{
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' height='100' width='100' class='img-thumbnail post-img img-circle' src=' ".($picture)."' >" ;

}*/

echo "</div></div></div>";
echo "</div></div></div>";
}
echo "</div>";
}
?>


</div>


</div>
<?php } ?>
</div>
</div>
</section>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>

 <?php


    $js_files = ['/assets/js/jquery-confirm/jquery-confirm.min.js'];

        foreach ($js_files as $jsf) {
            // code...
            echo '<script src="'.$BaseUrl.$jsf.'"></script>';
        }

     $css_files = ['/assets/js/jquery-confirm/jquery-confirm.min.css'];           

        foreach ($css_files as $csf) {
            // code...            
            echo '<link href="'.$BaseUrl.$csf.'" rel="stylesheet">';
        }  

    ?>

</body>
<script type="text/javascript">
$(document).ready(function() {
$('#select_all').on('click', function() {
if (this.checked) {
$('.checkbox').each(function() {
this.checked = true;
});
} else {
$('.checkbox').each(function() {
this.checked = false;
});
}
});

$('.checkbox').on('click', function() {
if ($('.checkbox:checked').length == $('.checkbox').length) {
$('#select_all').prop('checked', true);
} else {
$('#select_all').prop('checked', false);
}
});
});

function action_invitation(e, inv_id){
       
      let action = e.title;
  

      $.post("/grouptimelines/common/group_action.php", {
        id: inv_id,  action_grp_invitation: true, action:action
        }, function (r) {
          let res = JSON.parse(r);

          console.log(res);
          
          if(res.status == 'action_grp_invitation'){
            //$("#rmv_"+item_id).closest(".three-dot").closest(".friend").hide();

            if(res.data == 'accept'){
                $.confirm({
                    title: 'Invitation accepted!',
                    content: 'Do you want to view the group page now?',
                    buttons: {
                        Yes: function () {
                            window.location.assign( $(".grplnk_"+inv_id).attr("href"));
                        },
                        Cancel: function () {
                            $(e).closest("tr").remove()
                        },                    
                    }
                });
            }
            if(res.data == 'reject'){
                $.alert({
                    title: 'Rejected!',
                    content: 'Invitation rejected successfully.',
                })
                $(e).closest("tr").remove();
            }               
          } //if block
          else { $.alert({ title: res.status,  content: "There is some error"  }); }
        });
}

</script>
<script> 
function checkCheckbox() {  
    var kl=0;
    var inputs = document.querySelectorAll('.checkbox');   
        for (var i = 0; i < inputs.length; i++) {   
            //inputs[i].checked = true;  
            if(inputs[i].checked) {
                kl=1;
                }
           
        } 
       // alert(kl);
        if(kl==1){
            return true;
        }
        else{
            Swal.fire(
  'Please choose atleast <br> 1 notification to clear')
  
 

          //  Swal.fire("Please choose atleast 1 notification to clear")

            
            return false;
            
            
        }
}
</script>

</html>
<?php
} ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function permanentDelete(userId) {
        Swal.fire({
        title: 'Are You Sure You Want to Delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }
    </script>
