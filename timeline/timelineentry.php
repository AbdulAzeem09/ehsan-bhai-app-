<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<style>
.left_profile_timeline img {
height: 60px !important;
width: 60px !important;
}


.title_profile h4,
.title_profile h4 a {
margin-left: 10px !important;
}

.title_profile h5 {
margin-left: 80px !important;
}

.nav ul {
margin: 0;
padding: 0;
list-style: none;
}

.post_footer ul li {
width: 20%;
}

.post_footer ul li:nth-child(1) {
width: 15%;
}

.post_footer ul li:nth-child(4) {
width: 15%;
margin-right: 20px;
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
display: block;

}



.nav ul li.active {
pointer-events: none;
}


.navigation : hover {
display: flex !important;

}

</style>
<div class="post" id="postMainId<?php echo $timeline['idspPostings']; ?>" style="font-weight:bold;">
<?php
//echo 1111;
error_reporting(1);

include('../univ/baseurl.php');
include("../univ/main.php");


// ob_start();
//   echo "here";
//session_start();

if (isset($_GET["js"])) {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$grouptimelines = $_GET["js"];
}

$conn = _data::getConnection();
$p2 = new _postings;

/*    print_r($grouptimelines);*/
/* print_r($_GET["timelineid"]);*/

/*print_r($proid);
print_r($sharedesc);*/

if (isset($grouptimelines) && $grouptimelines == 1) {

// $res2 = $p2->allgrouptimelines($_GET["timelineid"]);
//$res2 = $p2->allgrouptimelinesPost($_GET["timelineid"]);
//
/*echo $p2->ta->sql;*/
/* $res2 = $p2->allgrouptimelinesPost($_GET["groupid"]);*/
$res2 = $p2->singletimelinespost($_GET["timelineid"]);
//echo "here1";

} else {

$res2 = $p2->singletimelinespost($_GET["timelineid"]);
//echo "here2";
/*echo "here2";*/
}
//echo $p2->ta->sql;
?>

<?php

//echo $p2->ta->sql;
if ($res2 != false)
while ($rows = mysqli_fetch_assoc($res2)) {
//print_r($rows);
$post_pid = $rows['spProfiles_idspProfiles'];
$sp = new _spprofiles;
$sp1 = $sp->readprofileid22($rows['spProfiles_idspProfiles']);
if ($sp1 != false) {
$rrr = mysqli_fetch_assoc($sp1);
$spUser_idspUser = $rrr['spUser_idspUser'];
}

if ($spUser_idspUser != '') {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($spUser_idspUser);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
if ($account_status == 1) {
continue;
}
}
}
$postingid = $rows['spPostings_idspPostings'];

$np = new _postings;
$rec = $np->readposting($postingid);
$spnum = 0;
if($rec !== false){
  $spnum = $rec->num_rows;
}
if ($spnum == 9) {
$poststatus = $np->flagposts($postingid);
}
$sql35 = "SELECT * FROM share WHERE  timelineid = " . $rows['idspPostings'];
/*echo $sql3;*/
$res35 = mysqli_query($conn, $sql35);
if ($res35 != false) {
$row35  = mysqli_fetch_assoc($res35);

//print_r($row35);

$sharedesc = $row35['spShareComment'];
$shareproid = $row35['spPostings_idspPostings'];
}

/*$postingDate = $p2->spPostingDate($rows["spPostingDate"]); */
/*print_r($rows["spPostingDate"]);*/
$time_ago = strtotime($rows["spPostingDate"]);

/*$time_ago = strtotime($rows["spPostingDate"]);
$datetime1 = new DateTime();
$datetime2 = new DateTime($rows["spPostingDate"]);
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
echo $elapsed;*/
/*print_r($time_ago);*/
//echo date("Y-m-d H:i:s");
$postingDate = $p2->spPostingDate($rows["spPostingDate"]);


?>



<div class="post_timeline post_timeline_all_post searchable deldiv_<?php echo $rows['idspPostings']; ?>">
<div class="row ">
<div class="col-md-8">

<input type="hidden" id="postid" value="<?php echo $rows["idspPostings"]; ?>">
<input type="hidden" id="postdate" value="<?php echo $rows["spPostingDate"]; ?>">
<?php

if (!empty($rows['sharetype'])) {


$pro = new _spprofiles;
$result3 = $pro->readUserId($shareby);

if ($result3 != false) {
$row3 = mysqli_fetch_assoc($result3);

$postingDate3 = $p2->spPostingDate($rows["spPostingDate"]); ?>
<div class="left_profile_timeline">
<?php
$picture3 = $row3["spProfilePic"];
$profilename3 = $row3["spProfileName"];

if (isset($picture3)) {
echo "<img alt='profilepic' class='img-circle' src='" . ($picture3) . "'>";
} else {
echo "<img alt='profilepic'  class='' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
}
$sharedProfile = $BaseUrl . "/friends/?profileid=" . $shareby;
$PostProfile = $BaseUrl . "/friends/?profileid=" . $rows['spProfiles_idspProfiles'];
?>
</div>
<div class="title_profile">
<!--  <h4><?php echo "<a href='" . ucwords(strtolower($sharedProfile)) . "'>" . ucwords(strtolower($profilename3)) . "</a> Shared <a href='" . $PostProfile . "'>" . ucwords(strtolower($profilename)) . "</a> Post"; ?> </h4> -->
<h4><?php echo "<a href='" . ucwords(strtolower($sharedProfile)) . "'>" . ucwords(strtolower($profilename3)) . "</a> Shared  Post"; ?> </h4>
<h5 id="posttimeago<?php echo $rows["idspPostings"]; ?> 33"><?php echo $postingDate3; ?> <i class="fa fa-globe"></i></h5>
</div>
<?php
}
} else {

/*print_r($rows);*/
$prof = new _spprofiles;
$result32 = $prof->readUserId($rows["spProfiles_idspProfiles"]);

//echo $prof->ta->sql;
/*print_r($result31);*/
if ($result32 != false) {
/*echo "here";*/
$row32 = mysqli_fetch_assoc($result32);
$picture = $row32["spProfilePic"];
$profilename = $row32["spProfileName"];
/* $postingDate = $p2->get_timeago(strtotime($rows["spPostingDate"]));*/

/*print_r($row3);*/
?>
<div class="left_profile_timeline">
<?php


if (isset($picture)) {
echo "<img alt='profilepic '  class='img-circle' src='" . ($picture) . "'>";
} else {
echo "<img alt='profilepic'  class='' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
}
?>
</div>
<div class="title_profile">
<h4><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['spProfiles_idspProfiles']; ?>">
<?php

if (strlen($profilename) > 0) {

echo ucwords(strtolower(substr($profilename, 0, 20)));
} else {
echo ucwords(strtolower($profilename));
}



?>
<?php
if (isset($rows['spGroupName']) &&  !empty($rows['spGroupName'])) {

?>
<!-- <span style="font-size: 14px;">(<?php echo $rows['spGroupName']; ?>)</span> -->
<?php
}
?>

</a></h4>
<h5 id="posttimeago<?php echo $rows["idspPostings"]; ?> 77"><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
</div> <?php
}
}  ?>

</div>
<div class="col-md-4">


<div class="dropdown pull-right right_profile_timeline">
<?php

$con = mysqli_connect(DBHOST, UNAME, PASS);

if (!$con) {
die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}

//echo "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='".$rows['idspPostings']."' OR spProfile_idspProfile='".$_SESSION['pid']."'";

$query = mysqli_query($con, "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='" . $rows['idspPostings'] . "' AND spProfile_idspProfile='" . $_SESSION['pid'] . "'");

/*print_r($_SESSION['pid']);
print_r($rows['idspProfiles']);*/
if (mysqli_num_rows($query) > 0) {
?>


<i class="fa fa-flag danger" data-toggle="tooltip" data-placement="top" title="Post Flaged" id="unflag<?php echo $rows['idspPostings']; ?>"></i>


<?php } else { ?>


<i class="fa fa-flag danger" data-toggle="tooltip" data-placement="top" title="Post Flaged" style="color:red;display:none;" id="unflag<?php echo $rows['idspPostings']; ?>"></i>

<?php if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) { ?>
<i class="fa fa-flag" id="flag<?php echo $rows['idspPostings']; ?>" data-toggle="tooltip" data-placement="top" title="You Cannot Flag This Post!" disable></i>
<?php } else { ?>

<i class="fa fa-flag" id="flag<?php echo $rows['idspPostings']; ?>" data-placement="top" title="Flag Post" data-toggle="modal" data-target="#myModal<?php echo $rows['idspPostings']; ?>"></i>
</span>
<?php
}
}

// $query1 = mysqli_query($con, "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='" . $rows['idspPostings'] . "'");
// $flaged_count = mysqli_num_rows($query1);
// /*print_r($flaged_count);*/

// if ($flaged_count > 0) {
// echo "($flaged_count)";
// }
?>




<div id="myModal<?php echo $rows['idspPostings']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">


<div class="modal-content ">

<form class="" method="post" id="flagpostfrm<?php echo $rows['idspPostings']; ?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">×</button>
<h4 class="modal-title">Flag this Post</h4>
</div>
<div class="modal-body">
<div class="row">

<input type="hidden" name="spProfile_idspProfile" value="<?php if(isset($rows['pid'])){ echo $rows['pid']; } ?>">
<input type="hidden" name="userid" value="<?php if(isset($rows['uid'])){ echo $rows['uid']; } ?>">
<input type="hidden" name="flagpostprofileid" value="<?php if(isset($rows['idspProfiles'])){ echo $rows['idspProfiles']; } ?>">
<input type="hidden" name="flagpostuserid" value="<?php if(isset($rows['spUser_idspUser'])){ echo $rows['spUser_idspUser']; } ?>">
<input type="hidden" name="spPosting_idspPosting" value="<?php if(isset($rows['idspPostings'])){ echo $rows['idspPostings']; } ?>">


<div class="col-md-12" style="display: grid;">
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This person is annoying me">This post is annoying me</label>
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They're pretending to be me or someone I know">They're pretending to be me or someone I know</label>
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This is a fake account">This is a fake account Post</label>
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This profile represents a business or organization">This Post represents a business or organization</label>
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They're using a different name than they use in everyday life">They're using a different name than they use in everyday life</label>
<label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="Others">Others</label>

</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn_blue db_btn db_primarybtn" onclick="flagpost(<?php echo $rows['idspPostings']; ?>);" name="btnReport" id="flagtimelinepost">Submit</button>
<button type="button" class="btn btn_gray db_btn db_orangebtn" data-dismiss="modal">Close</button>
</div>
</form>

</div>

</div>
</div>
<style>
.zoom1:hover {
-ms-transform: scale(1.05);
/* IE 9 */
-webkit-transform: scale(1.05);
/* Safari 3-8 */
transform: scale(1.05);
}
</style>



<button class="btn dropdown-toggle 4444445555566" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h " aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<?php
if (isset($_SESSION['pid'])) {
$sp = new _savepost;
$result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
if ($result2) {
if ($result2->num_rows > 0) { ?>
<li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a onclick="myUnsave('<?php echo $rows['idspPostings']; ?>')"><i class="fa fa-save" style="color: black;"></i> Unsave Post</a></li>


<li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"></li> <?php

} else { ?>
<li style="cursor: pointer;"><a href="<?php echo $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings']; ?>"><i class="fa fa-save">&nbsp;</i> Save Post</a></li> <?php
}
} else {



?>



<li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a class="profile_section" onclick="myFun('<?php echo $rows['idspPostings']; ?>')"><i class="fa fa-save">&nbsp;</i> Save Post</a></li> <?php

}
}



if ($_SESSION['pid'] == $post_pid) { ?>
<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings']; ?>" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a></li> <?php
}
?>


<!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
<?php
//Delete timeline by poster//
if (isset($_SESSION['uid'])) {
$pr = new _spprofiles;
$pres = $pr->checkprofile($_SESSION['uid'], $rows['spProfiles_idspProfiles']);
 
if ($pres != false) {

?>
<!--<li><a href="javascript:void(0);" class="postdel" data-id="<?php echo $rows['idspPostings'] ?>" data-pid="<?php ?>" >
<i class="fa fa-trash-o" style="color:red"></i>  Delete Post11</a></li>-->
<?php
//echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
//echo "<li><a href='#'><i class='fa fa-trash'></i> Delete Post</a></li>";
}
} else {
echo "<li><a href='../post-ad/deletePost.php?postid=" . $rows['idspPostings'] . "&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
}
//hide post from timeline
if ($_SESSION['pid'] != $rows['spProfiles_idspProfiles']) {
$HiPost = $BaseUrl . "/post-ad/hidePost.php?postid=" . $rows['idspPostings'] . "&flag=1";
?>
<li><a onclick='Hide_Post("<?php echo $HiPost ?>")'><i class='fa fa-minus-square-o'></i> Hide Post</a></li>
<?php
}
if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) {
?>
<!--<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings']; ?>" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post11</a></li>-->
<li><a style="cursor:pointer;" onclick="deletePost(<?php echo $rows['idspPostings'] ?>);return false;" style="cursor:pointer;"><i class='fa fa-trash'></i> Delete Post</a></li>
<?php

}
?>
<!--<li><a href="javascript:void(0)" onclick="function_post(<?php echo $rows['idspPostings']; ?>)" ><i class='fa fa-trash'></i> Delete Post</a></li>
<!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> -->

</ul>

</div>
</div>

<div class="col-md-12 ">
<h2 style="word-wrap: break-word;" id="h2Postid<?php echo $rows['idspPostings'];?>">
<?php
if (!empty($rows['sharetype'])) {
  echo "<p>" . $sharedesc . "</p>";
} else {
  echo $text = $p2->turnUrlIntoHyperlink($rows['spPostingNotes']);
}

?>
</h2>
<?php


/*print_r($proid);
print_r($shareby);*/


if (!empty($rows['sharetype'])) {
if ($rows['sharetype'] == 'store') { ?>
<a href="<?php echo $BaseUrl . '/store/detail.php?catid=1&postid=' . $shareproid; ?>" target="_blank">View Product</a>
<br>
<br>
<?php }
if ($rows['sharetype'] == 'classified') { ?>
<a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $shareproid; ?>" target="_blank">View Product</a>
<br>
<br>
<?php }
} ?>
<?php
$pic = new _postingpic;
$result = $pic->read_timeline($rows['idspPostings']);
/*echo $pic->ta->sql;*/
if ($result != false) {
while ($rp = mysqli_fetch_assoc($result)) {
$pict = $rp['spPostingPic'];

if (isset($pict)) {
//die('abccccccccccc');

echo "<div class='timlinepicture text-center'>";
echo "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 50%;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
include("postingpic.php");
echo "</div>";
}
}
} else {
$pict = NULL;
}

//	echo $pict; die('xxxxxxxx');

$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);


//echo $media->ta->sql;
if ($result != false) {
$r = mysqli_fetch_assoc($result);

$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$original_name = $r['original_name'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp3') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<audio controls>
<source src="<?php echo $sppostingmediaTitle; ?>" type="audio/<?php echo $sppostingmediaExt; ?>">
Your browser does not support the audio element.
</audio>
</div>
<?php
} else if ($sppostingmediaExt == 'mp4' || $sppostingmediaExt == 'webm') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<video style='max-height:300px;width: 100%;border-radius: 17px; 747465' controls>
<source src='<?php echo $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
</video>
</div>
<?php
} else if ($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx') {
?>
<div class="row timelinefile">
<div class="col-md-offset-1 col-md-1 no-padding">
<img src="<?php echo $BaseUrl . '/assets/images/pdf.png' ?>" alt="pdf" class="img-responsive" />
</div>
<div class="col-md-10">
<h3><?php echo $original_name; ?></h3>
<small><?php echo $sppostingmediaExt; ?></small>
<a href="<?php echo $sppostingmediaTitle; ?>"  target="_blank" download>Preview</a>




</div>
</div>
<?php
}
} else {

/*if (isset($pict)) {

echo "<div class='timlinepicture text-center'>";
echo "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 50%;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
include("postingpic.php");
echo "</div>";

}*/
/* else
echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ; */
} ?>

</div>

<div>
<?php $c = new _comment;  ?>

<div id="comments_<?php echo $rows['idspPostings']; ?>">


<div class="timelinecmnt_<?php echo $rows['idspPostings']; ?>">
<!--
<div class="row">
<div class="col-md-1">
<?php
if (isset($picture))
echo "<img alt='profilepic'  class='' src='" . ($picture) . "' >";
else
echo "<img alt='profilepic'  class='' src='../assets/images/blank-img/default-profile.png' >";
?>
</div>
<div class="col-md-11">
<div class="right_coment_detail">
<a href="#"><?php echo $profilename; ?></a>
<p><?php echo $comment; ?></p>
</div>
</div>
</div>-->

<div class="row view_more_cmnt_<?php echo $rows['idspPostings']; ?> comment_align">

<?php $reply_data = $c->reply_res($rows['idspPostings']);
$replytotalcmt = $reply_data !== false ? $reply_data->num_rows : 0;
?>

<?php
$result = $c->read($rows['idspPostings']);
$totalcmt = 0;
if ($result != false) {
$totalcmt = $result->num_rows;

while ($row = mysqli_fetch_assoc($result)) {
$profilename = $row["spProfileName"];
$comment = $row["comment"];
$picture = $row["spProfilePic"];
//$date = $row["commentdate"];
} ?>

<div class="col-md-12">
<?php
echo "
  <a class='float-right'  href='../publicpost/post_comment_details.php?postid=" . $rows['idspPostings'] . "' >
    <span class='morecomment' data-postid='" .$rows['idspPostings'] . "' >View all comments <span class='tltcmt'>(" . ($totalcmt + $replytotalcmt) . ")</span></span>
 </a>";
?>
</div>

<?php
}
?>


</div>
</div>



</div>

</div>

<div class="col-md-12">

<div class="post_footer">
<ul>
<!--	<li>
//	<?php
//   $pl = new _postlike;
//    $r = $pl->readnojoin($rows['idspPostings']);

//echo $pl->ta->sql;
//  if ($r != false) {
//       $i = 0;
//        $liked = $r->num_rows;
//        while ($row = mysqli_fetch_assoc($r)) {

//        if ($row['spProfiles_idspProfiles'] == $_SESSION['pid']) {
//             echo "<a class='faa-parent '><span id='spLikePost' data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ") <span class='font_regular'>UnLike</span></span></a>";
//            $i++;
//			}
//		}
//        if ($i == 0) {
//           echo "<a class='faa-parent '><span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ") <span class='font_regular'>Like</span></span></a>";
//		}
//			} else {
//        $liked = 0;
//     echo "<a class='faa-parent '><span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $liked . "'> <span class='font_regular'>Like</span></span></a>";
//}
?>
</li> -->

<?php
$rection =  "&#128077;&#127995;";
$like = "0";
$pl = new _postlike;
$r = $pl->likeread($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);

$react_count = 0;

if($r !== false){
  $react_count =  $r->num_rows;
}

$count = 0;
if ($react_count == 0) {
$rection =  "&#128077;&#127995;";
$count_react = 0;
} else {
$count_react = 1;
// if($react_coun > 0) {
//echo "ppppppppppppp";
$row22 = mysqli_fetch_assoc($r);
$rid = $row22['Reaction_id'];
if ($rid == 1) {
$rection = "&#128525";
}

if ($rid == 2) {
$rection = "&#128512;";
}
if ($rid == 3) {
$rection = "&#128546;";
}
if ($rid == 4) {
$rection = "&#129315;";
}
if ($rid == 5) {
$rection = "&#128563;";
}
if ($rid == 6) {
$rection = "&#128545;";
}

if ($rid == 7) {
$rection = "&#128077";
}
}
// }
/*
else {
$rection =  "&#128077;&#127995;";
} */
?>


<li class="like_btn">

<nav class="nav">
<ul>
<input type="hidden" id="usid" value="<?= $_SESSION['uid']; ?>">
<input type="hidden" id="prid" value="<?= $_SESSION['pid']; ?>"> 
<li>

<?php if ($react_count == 0) { ?>


<div id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn 222" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7" ><?php echo $rection; ?></a> </div>


<?php  } ?>


<?php if ($react_count == '1') { ?>
<div id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn_remove" data-postid="<?= $rows['idspPostings']; ?>" style="font-size: 25px;margin-top: -5px;"><?php echo $rection; ?></a> </div>
<?php  } ?>



<ul class="" >

<li  value="7" onclick="newclick(7,<?= $rows['idspPostings']; ?>)" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7">&#128077;</li>
<li  value="1" onclick="newclick(1,<?= $rows['idspPostings']; ?>)" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="1">&#128525;</li>
<li  value="2" onclick="newclick(2,<?= $rows['idspPostings']; ?>)" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="2">&#128512;</li>
<li  value="3" onclick="newclick(3,<?= $rows['idspPostings']; ?>)" class="reactionbtn thrd" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="3">&#128546;</li>
<li  value="4" onclick="newclick(4,<?= $rows['idspPostings']; ?>)" class="reactionbtn forth" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="4">&#129315;</li>
<li  value="5" onclick="newclick(5,<?= $rows['idspPostings']; ?>)" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="5">&#128563;</li>
<li  value="6" onclick="newclick(6,<?= $rows['idspPostings']; ?>)" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="6">&#128545;</li>
</ul>
</li>

</ul>
</nav>
</li>
<li>
<a class="rcount" onclick="getreaction(<?= $rows['idspPostings']; ?>)" style="margin-right: 47px;" id='rcount' data-postidr="<?= $rows['idspPostings']; ?>" data-toggle="modal" data-target="#myModal" style="font-weight:normal; margin-right:41px;">
<?php $read_like_cont = $c->read_like($rows['idspPostings']); 
//	print_r($read_like_cont);  die('-----------');

if ($read_like_cont == false) {
echo " <span style='font-size:15px;margin-right: 131px;'  id = 'cuer" . $rows['idspPostings'] . "'>(0) </span> <span id='sp1'></span>";
} else {
echo "<span style='font-size:15px;margin-right: 131px;'  id = 'cuer" . $rows['idspPostings'] . "'>(" . $read_like_cont->num_rows . ") </span> ";
}

?>
</a>
</li>

<script>
// $(document).ready(function() {

// $('#cuer').css('cursor');
// });
</script>

<li>

<a href="../publicpost/post_comment_details.php?postid=<?php echo $rows['idspPostings']; ?>&loadcom">
<span class='sp-share' data-placement='bottom' title='Comment' data-postid='<?php echo $rows['idspPostings']; ?>'><i class="fa fa-comment 22" aria-hidden="true" style="font-size:20px; margin-right: 15px;"></i>
<span>
<?php
echo "<a class='float-right'  href='../publicpost/post_comment_details.php?postid=" . $rows['idspPostings'] . "' ><span class='tltcmt font_regular ' id='cmtmob1111'> (" . $totalcmt + $replytotalcmt . ") </span></a>";
?></span>
</span>
<!--<span class='font_regular'>Comment</span>-->
</a>

</li>

<li >
<?php
$pl = new _favorites;
$re = $pl->read_fav($rows['idspPostings'], $_SESSION['uid']);

$resultsfav = $pl->read_fav_count($rows['idspPostings']);
// $resdata = mysqli_fetch_assoc($resultsfav);
// $iddata = $resdata['id'];

$count = 0;
if ($resultsfav) {
$count = $resultsfav->num_rows;
if ($count != false) {
//echo $count;
}
}


///selec * from 
//echo $pl->ta->sql;  
if ($re != false) {
$i = 0;
//Unfavourite
while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spUserid'] == $_SESSION['uid']) {
echo "<span id='spFavouritePost' data-placement='bottom' title='Unfavourite' style='font-size: 20px;' class='icon-favorites fa fa-heart removefavorites faa-pulse animated1' data-postid='" . $rows['idspPostings'] . "' data-heartid='" . $count . "'></span><span id='text_" . $rows['idspPostings'] . "'>  <span class='font_regular'> </span><span onclick=\"postfunction(" . $rows['idspPostings'] . ")\" class='show-modal' id='delid" . $rows['idspPostings'] . "' style='font-size:14px;'>($count)</span>";



$i++;
} else {
//Favourite

echo "<span id='spFavouritePost' data-placement='bottom' title='Favourite' style='font-size: 20px;' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated1' data-postid='" . $rows['idspPostings'] . "'><span onclick='postfunction(" . $i . $rows['idspPostings'] . ")'</span> <span id='text_" . $rows['idspPostings'] . "'>  <span class='font_regular'></span></span>";

}
}
/*    if ($i == 0) {
echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span>";
}*/
} else {
//Favourite
echo "<span id='spFavouritePost' data-placement='bottom' title='Favourite' style='font-size: 20px;' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated1' data-postid='" . $rows['idspPostings'] . "'></span><span id='text_" . $rows['idspPostings'] . "'> <span class='font_regular'></span></span><span onclick='postfunction(" . $rows['idspPostings'] . ")' class='show-modal' id='delid" . $rows['idspPostings'] . "' style='margin-left:-15px!important;font-size:14px;'>(" . $count . ")</span>";
}

//Share  data-toggle="tooltip"
?>

</li>
<?php
$pl = new _postshare;
$sharedata = $pl->sharecount($rows['idspPostings']);
$sharecount = 0;
if ($sharedata) {
$sharecount = $sharedata->num_rows;
if ($sharecount != false) {
}
}


?>
<li class="li3"><a href="javascript:void(0);" data-toggle='modal' data-target='#myshare' 1111><span class='sp-share' data-placement='bottom' title='Share' data-postid='<?php echo $rows['idspPostings']; ?>' src='<?php echo ($pict); ?>'><i class="fa fa-share-alt" id="share_mobile_view"  ></i> <span class='font_regular'></span></span></a>&nbsp<span class="show-modal-share" onclick="openshare(<?php echo $rows['idspPostings'];?>)"><?php echo "($sharecount)"; ?></span></li>
</ul>
</div>
</div>
<div class="col-md-12 no-padding" >
<div class="commt_box timeline_comm_box commentbox_<?php echo $rows['idspPostings']; ?>" >
<?php
if (isset($_GET['idspprofile'])) {
$idspprofile = $_GET['idspprofile'];
} else {
$idspprofile = $_SESSION['pid'];
}
//print_r($_GET);
include("commentform.php");

?>

</div>
<div id=" comments_<?php echo $rows['idspPostings']; ?>">
<?php
$c = new _comment;
$result = $c->read($rows['idspPostings']);

$totalcmt = 0;
if ($result != false) {
$totalcmt = $result->num_rows;
while ($row = mysqli_fetch_assoc($result)) {
$profilename = $row["spProfileName"];
$comment = $row["comment"];
$picture = $row["spProfilePic"];
//$date = $row["commentdate"];
} ?>
<?php
} ?>
</div>

</div>
</div>

<?php } ?>


</div>













<?php
?>
</div>

<script type="text/javascript">
function flagpost(postid) {

/*$("#radReport").();

alert($("#radReport").val());*/
if ($('input[name="radReport"]:checked').length == 0) {
var logo = "../assets/images/logo/tsplogo.PNG";

swal({
title: "Please Select a Reason to Flag.",
imageUrl: logo
});
return false;
} else {
//alert("checked");

/*swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
*/
$.ajax({
url: "../publicpost/flagpost.php",
type: "POST",
data: $("#flagpostfrm" + postid).serialize(),
dataType: "text",
success: function(vi) {

$("#flag" + postid).hide();
$("#unflag" + postid).show();

$("#myModal" + postid).hide();
$(".modal-backdrop").remove();
$("body").removeClass("modal-open");

var logo = "../assets/images/logo/tsplogo.PNG";


swal({
title: "Flagged successfully.",
imageUrl: logo
});

},
error: function(error) {

}
});

//}
//})

}
}



/*    $('#timeline-container').on('click', ".sendPostidEdit", function (e) {
var MAINURL = "https://thesharepage.dbvertex.com/";

$(".posteditloader").css({ display: "block" });
var postid = $(this).attr("data-postid");

//alert(postid);
$(".sp-post-edit").load(MAINURL+"/profile/postField.php", {postid: postid}, function (response) {
//alert(response);
$(".posteditloader").css({ display: "none" });
});
});
*/
</script>
<script type="text/javascript">
// $('.thumbnail').magnificPopup({
// type: 'image'
// // other options
// });
</script>





<script type="text/javascript">
$(document).ready(function() {
//friend request send
$(".sendRequestOnSearch").click(function(i, e) {
var btn = this;
var senderId = $(this).data("sender");
var reciverId = $(this).data("reciver");
var profilename = $(this).data("profilename");
var flag = $(this).data("flag");
$.post('../friends/sendrequest.php', {
sender: senderId,
reciever: reciverId,
profilename: profilename,
flag: flag
}, function(d) {
//window.location.reload();
swal({
title: "Friend request has been sent successfully.",
type: "success",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Ok",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: false,
},
function(isConfirm) {
if (isConfirm) {
$("#send_profile_section_" + reciverId).html("");
$("#send_profile_section_" + reciverId).html('<span class="btn btnPosting" style="border-radius: 14px; background-color: green;">Request Sent</span>');
//location.href = "<?php echo $BaseUrl; ?>/timeline/index.php";
}
});
});
});
});
</script>

<script>
function function_post(a) {
alert(a);

swal({
title: "Do You Want Delete this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'delete_addclf.php?id=' + dataId + '&work=' + work;
}
});


}
</script>


<script>
function myFun(id) {
Swal.fire({
title: 'Do you want to Save this post?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes!'
}).then((result) => {
if (result.isConfirmed) {


$.ajax({
url: "/post-ad/savePost.php",
type: "GET",
data: {
save: id,
//profileid: ide
},
success: function(response) {


$("#savefun" + id).html('<a class="profile_section" onclick="myUnsave(' + id + ')" ><i class="fa fa-save">&nbsp;</i> Unsave Post</a>');
}

});
}
});
}

function myUnsave(id) {
Swal.fire({
title: 'Do you want to Unsave this post?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes!'
}).then((result) => {
if (result.isConfirmed) {

$.ajax({
url: "/post-ad/savePost.php",
type: "GET",
data: {
unsave: id,
//profileid: ide
},
success: function(response) {

$("#savefun" + id).html('<a class="profile_section" onclick="myFun(' + id + ')" ><i class="fa fa-save">&nbsp;</i>Save Post</a>');
}

});
}
});
}
</script>

<script src="<?php echo $BaseUrl?>/assets/js/sweetalert.js"></script>
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

<script>
function deletePost(id) {

    Swal.fire({
      title: 'Are you sure you want to delete ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes',
      cancelButtonColor: '#FF0000',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
        $(".timelineload").css({display: "block"});
        $.get('../post-ad/deletePost.php?postid=' + id + '&flag=1&timeline=1', function(data, status){
          $(".timelineload").css({display: "none"});  
          $("#postMainId"+id).hide();  
        });
      }
    });

  }


$(".alert-button").on('click', function(event) {

// var postid = $(this).attr("data-id");

// alert('vvvv');


});


function Hide_Post(id) {
//alert(id);
Swal.fire({
title: 'Are You Sure to Hide?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Hide it!'
}).then((result) => {
if (result.isConfirmed) {
//window.location.href = 'processRegUser.php?action=delete&userId=' + userId;
window.location.href = id;
}
});

}
</script>
