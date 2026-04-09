<style>
.thumbnail {
margin-right: 6px !important;
}

.post_footer ul li {

margin-right: -103px;
}

@media(max-width:480px) {
.post_footer ul li {

width: 40% !important;
}

}
</style>

<div class="tab-content no-radius otherTimleineBody social post social_fre">
<!--Timeline-->
<?php
if ($checkIsBlocked == false && $checkIsBlocked2 == false) { ?>
<div role="tabpanel" class="tab-pane active" id="srchtimeline" style="padding-left: 10px;padding-right: 10px;">
<div class="row m_top_10">
<div class="col-md-12">

<div class="post_timeline post_timeline_all_post searchable deldiv_2203">
<?php
$pp = new _spprofiles;
$rpvt = $pp->read($rows["spProfiles_idspProfiles"]);
//echo $p->ta->sql;
if ($rpvt != false) {

$row = mysqli_fetch_assoc($rpvt);
// print_r($row);
$name       = $row["spProfileName"];
$picture    = $row['spProfilePic'];
$about      = $row["spProfileAbout"];
$phone      = $row["spProfilePhone"];
$phonestatus        = $row["phone_status"];
$emailstatus        = $row["email_status"];
$relationship_status        = $row["relationship_status"];
$uid = $row["spUser_idspUser"];

$city       = $row["spProfilesCity"];
$profiletype        = $row["spProfileType_idspProfileType"];
$profileTypeName    = $row['spProfileTypeName'];
$icon       = $row["spprofiletypeicon"];
$ptypeid    = $row["idspProfileType"];
$email      = $row["spProfileEmail"];
$location   = $row["spprofilesLocation"];
$language   = $row["spprofilesLanguage"];
$address    = $row["spprofilesAddress"];
$profileaddress     = $row["address"];
$userImage = ($picture);
}

?>

<div class="row ">
<div class="col-md-11">
<div class="left_profile_timeline">
<img id="profilepicture" alt="Profile Pic" class="img-responsive img-circle" src="<?php echo ((isset($userImage) && $userImage != '') ? " " . $userImage . "" : "../assets/images/icon/blank-img.png"); ?>">
</div>
<div class="title_profile" style="margin-left:65px;">

<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows["spProfiles_idspProfiles"]; ?>">
<h4><?php echo ucwords($name); ?> </h4>
</a>
<?php
$p2 = new _postings;
$postingDate = $p2->spPostingDate($rows["sharePostTime"]);
echo $postingDate;
?>

</div>
</div>
<?php if (isset($rows["idspPostings"]) && !empty($rows["idspPostings"])) {   ?>
<script type="text/javascript">
document.getElementById("posttimeago" + <?php echo $rows["idspPostings"]; ?>).innerHTML = get_post_time(<?php echo $rows["idspPostings"]; ?>, <?php echo "'" . $rows["sharePostTime"] . "'"; ?>);

function get_post_time(postid, postdate) {

var countDownDate = new Date(postdate)
var today = new Date();
var now = new Date();
var distance = countDownDate - now;
var seconds = Math.floor((now - (countDownDate)) / 1000);
var minutes = Math.floor(seconds / 60);
var hours = Math.floor(minutes / 60);
var days = Math.floor(hours / 24);

var hours = hours - (days * 24);
var minutes = minutes - (days * 24 * 60) - (hours * 60);
var seconds = seconds - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);

if (days > 0) {

var ago = days + " days ago";

} else if (days <= 0 && hours > 0) {

var ago = hours + " hours ago";
} else if (days <= 0 && hours <= 0 && minutes > 0) {

var ago = minutes + " minutes ago";
} else if (days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0) {

var ago = seconds + " seconds ago";
}

return ago;

}
</script>


<?php } ?>
<?php
if ($_SESSION['guet_yes'] != 'yes') { ?>
<div>
<div class="col-md-1">
<div class="dropdown pull-right right_profile_timeline">
<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<?php

if (isset($_SESSION['pid'])) {
$sp = new _savepost;
$p6 = new _spprofiles;
$rpvt6 = $p6->read($_GET["profileid"]);
$gk = $_GET["profileid"];
$resultr2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);

if ($resultr2) {
if ($resultr2->num_rows > 0) { ?>
<li><span id="savefun<?php echo $rows['idspPostings'];  ?>" style="margin-left:14px!important;"><a onclick="myUnsave('<?php echo $rows['idspPostings']; ?>','<?php echo $gk; ?>')"><i class="fa fa-save"></i> Unsave Post</a></span></li> <?php
                                                                                                                                                                                                                } else { ?>
<!-- 74747474374 -->
<li><a href="<?php echo $BaseUrl . '/friends/savePPost.php?postid=' . $rows['idspPostings'] . '&profileid=' . $gk; ?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                            } else { ?>
<!-- 7474747757575 -->
<li style="cursor:pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a class="profile_section" onclick="myFun('<?php echo $rows['idspPostings']; ?>','<?php echo $gk; ?>')"><i class="fa fa-save">&nbsp;</i> Save Post</a></li> <?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } else { ?>
<!-- 74747476767676 -->
<li><a href="<?php echo '../friends/savePPost.php?postid=' . $rows['idspPostings'] . '&profileid=' . $gk; ?>"><i class="fa fa-floppy-o">&nbsp;</i> Save Post</a></li> <?php
                                                                                                                                                                                                        }
                                                                                                                                                                                                        if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) {
                                                                                                                                        ?>

<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings'];  ?>" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a></li> <?php
                                                                                                                                                                                                        }

                                                                                                                                                                                                        ?>


<!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
<?php
//Delete timeline by poster//
if (isset($_SESSION['uid'])) {
$pr = new _spprofiles;
$pres = $pr->checkprofile1($_SESSION['pid'], $rows['idspPostings']);
$profile = $_SESSION['pid'];

if ($pres != false) {

?>
<?php

$urldata = '/post-ad/deletePost.php?postid=' . $rows['idspPostings'] . '&flag=3&timeline=1&profile=' . $profile;


?>

<li><a onclick="deletepost('<?php echo $BaseUrl . $urldata ?>')"><i class='fa fa-trash'></i> Delete Post</a></li>
<?php

}
} else {
echo "<li><a href='../post-ad/deletePost.php?postid=" . $rows['idspPostings'] . "&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
}

?>


</ul>
</div>
</div>
</div>
<?php } ?>
<div class="col-md-12 " style="margin-top:20px;margin-left:20px;">

<?php
if ($rows["spPostingNotes"] != '') {

echo "<div style='color:#333'>" . $rows["spPostingNotes"] . "</div>";
}

$pic = new _postingpic;
$res = $pic->read_timeline($rows['idspPostings']);
if ($res != false) {
$rp = mysqli_fetch_assoc($res);
$pic = $rp['spPostingPic'];
echo "<div class='row no-margin text-center'>";
echo "<a class='thumbnail mag' data-effect='mfp-newspaper' href=' " . ($pic) . "' style='border: 0px solid #ddd;'><img alt='Posting Pic' src=' " . ($pic) . "' style='height: 50%;width: 50%;' class='postpic img-thumbnail img-responsive center-block bradius-15' ></a>";
echo "</div>";
}


$media = new _postingalbum;
$resultr2 = $media->read($rows['idspPostings']);
if ($resultr2 != false) {

$r = mysqli_fetch_assoc($resultr2);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp3') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<audio controls>
<source src="<?php echo $sppostingmediaTitle; ?>" type="audio/<?php echo $sppostingmediaExt; ?>">
Your browser does not support the audio element.
</audio>
</div>
<?php
} else if ($sppostingmediaExt == 'mp4') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<video style='max-height:300px;width: 100%' controls>
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
<h3><?php echo $sppostingmediaTitle; ?></h3>
<small><?php echo $sppostingmediaExt; ?></small>
<a href="<?php echo $sppostingmediaTitle; ?>" target="_blank">preview</a>
</div>
</div>


<?php
}
}
?>
</div>
<?php
$c = new _comment;
$rll = $c->read($rows['idspPostings']);
$totalcomment  = 0;
if ($rll != false) {
$totalcomment = $rll->num_rows;
//echo $totalcomment;
//die("jhgf");


} else {
?>


<?php } ?>
<a id="removec_<?php echo $rows['idspPostings']; ?>" href="/publicpost/post_comment_details.php?postid=<?php echo $rows['idspPostings']; ?>" style="float:right;padding:20px;"><span class='morecomment'>View all comments <span class='tltcmt'>(<?php echo $totalcomment; ?>)</span></span></a>



<!---------footer -------------------->

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

//echo "<a class='float-right'  href='../publicpost/post_comment_details.php?postid=".$rows['idspPostings']."' ><span class='morecomment' data-postid='" . $rows['idspPostings'] . "' >View all comments <span class='tltcmt'>" . $totalcmt . "</span></span></a>";
?>
</div>

<?php
}  //else {
?>
</div>
</div>
<?php //} 
?>
</div>
<div class="col-md-6">

</div>
</div>



<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<div class="col-md-12 social social_fre">
<div class="col-md-12">
<div class="post_footer 5454">
<ul>
<?php

$rection =  "&#128077;&#127995;";
$like = "0";
$pl = new _postlike;
$r = $pl->likeread($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
$react_count =  $r->num_rows;
$count = 0;
if ($r->num_rows == 0) {

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
<li>
<nav class="nav">
<ul id="Menu">
<input type="hidden" id="usid" value="<?= $_SESSION['uid']; ?>">
<input type="hidden" id="prid" value="<?= $_SESSION['pid']; ?>">
<li>

<?php if ($r->num_rows == '') { ?>


<div id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7" style="font-size: 25px;margin-top: -10px;"><?php echo $rection; ?></a>


</div>


<?php  } ?>


<?php if ($r->num_rows == '1') { ?>
<div id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn_remove" data-postid="<?= $rows['idspPostings']; ?>" style="font-size: 25px;margin-top: -10px;"><?php echo $rection; ?></a> </div>
<?php  } ?>



<ul class="" style="margin-top: -79px;">

<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="7" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7">&#128077;</li>&nbsp;&nbsp;&nbsp;&nbsp;

<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="1" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="1">&#128525;</li>&nbsp;&nbsp;&nbsp;&nbsp;
<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="2" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="2">&#128512;</li>&nbsp;&nbsp;&nbsp;&nbsp;
<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="3" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="3">&#128546;</li>&nbsp;&nbsp;&nbsp;&nbsp;
<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="4" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="4">&#129315;</li>&nbsp;&nbsp;&nbsp;&nbsp;
<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="5" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="5">&#128563;</li>&nbsp;&nbsp;&nbsp;&nbsp;
<li style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="6" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="6">&#128545;</li>
</ul>
</li>

</ul>
</nav>
</li>

<li>
<li> <a class="rcount pull-left" id='rcount' data-postidr="<?= $rows['idspPostings']; ?>" data-toggle="modal" data-target="#myModal">
<?php $read_like_cont = $c->read_like($rows['idspPostings']);

if ($read_like_cont->num_rows == "") {
echo " (<span id = 'cuer" . $rows['idspPostings'] . "'>0</span>)";
} else {
echo "(<span id='cuer" . $rows['idspPostings'] . "'>" . $read_like_cont->num_rows . "</span>)";

}
?> </a>
</li>

<i class="fa fa-comment" aria-hidden="true" style="font-size: 20px;float:right; margin-right:60px"></i>
<!--<span class='font_regular'>Comment</span>-->
</li>
<li id="like_<?php echo $rows['idspPostings']; ?>">
<?php
$pl = new _favorites;
$re = $pl->read_fav($rows['idspPostings'], $_SESSION['uid']);



$resultsfav = $pl->read_fav_count($rows['idspPostings']);

$count = 0;
if ($resultsfav) {
$count = $resultsfav->num_rows;
if ($count != false) {
//echo $count;
}
}
if ($re != false) {
$i = 0;
while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spUserid'] == $_SESSION['uid']) {
echo "<span id='" . $rows['idspPostings'] . "' data-toggle='tooltip' onclick='fav(" . $rows['idspPostings'] . "," . $count . ")' style='font-size: 20px;float:right' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites_fre' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span><span onclick=\"postfunction(" . $rows['idspPostings'] . ")\" class='show-modal' id='delid" . $rows['idspPostings'] . "' style='font-size:14px;float:right;margin-right:-42px;'>(" . $count . ")</span>";

$i++;
} else {
//Favourite

echo "<span id='spFavouritePost' onclick='unfav(" . $rows['idspPostings'] . "," . $count . ")' data-toggle='tooltip' style='font-size: 20px;' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites_fre' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span><span  onclick=\"postfunction(" . $rows['idspPostings'] . ")\" class='show-modal'  id='delid" . $rows['idspPostings'] . "' style='font-size:14px;'>(" . $count . ")</span>";
}
}
// if ($i == 0) {
// echo "<span id='spFavouritePost' data-toggle='tooltip' style='
// font-size: 20px;' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites_fre' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span><span id='delid".$rows['idspPostings']."' style='font-size:14px;'>(".$count.")</span></span>";
// }
} else {

echo "<span id='spFavouritePost' onclick='unfav(" . $rows['idspPostings'] . "," . $count . ")' data-toggle='tooltip' style='font-size: 20px;float:right' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites_fre' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span><span class='show-modal' onclick=\"postfunction(" . $rows['idspPostings'] . ")\" id='delid" . $rows['idspPostings'] . "' style='font-size:14px; float:right; margin-right:-40px;'>(" . $count . ")</span>";

} ?>
</li>
<!-- <li><a href="javascript:void(0);"  data-toggle='modal' data-target='#myshare1'><span class='sp-share' data-postid='<?php echo $rows['idspPostings']; ?>' src='<?php echo ($pict); ?>'><i class="fa fa-share-alt"></i> <span class='font_regular'>Share</span></span></a></li> -->
</ul>
</div>
</div>







<div id="testmodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Favourite Profiles Details</h4>

</div>
<div class="modal-body">
<p><b> </b><span id="user_name" style="font-size:18px;"></span></p>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<div id="testmodal-1" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Confirmation</h4>
</div>
<div class="modal-body">
<p>Do you want to save changes you made to document before closing?</p>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>





<script>
function postfunction(postid,username) {
//alert("===========");

$("#testmodal").modal('show');
//alert(postid);

$.ajax({
url: MAINURL"/timeline/timepost.php", 
type: "POST",
data: {

postid: postid

},
success: function(response) {

$("#user_name").html(response);

console.log(response); 
}

});
}
</script>





<div class="col-md-12 no-padding " id="timeline-container" style="margin-top: 10px;">
<div class="commt_box timeline_comm_box">
<?php
if (isset($_GET['idspprofile'])) {
$idspprofile = $_GET['idspprofile'];
} else {
$idspprofile = $_SESSION['pid'];
}

include 'profilecommentform.php';
?>
</div>
<div id="comments_<?php echo $rows['idspPostings']; ?>">
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
<div class="timelinecmnt_<?php echo $rows['idspPostings']; ?>">
<!--
<div class="row">
<div class="col-md-1">
<?php
if (isset($picture))
echo "<img alt='profilepic'  class='' src=' " . ($picture) . "' >";
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
<div class="col-md-12">

</div>
</div>
</div>

<?php
} ?>
</div>
</div>
</div>
<?php } ?>
<!--------footer end------------>

</div>
</div>
</div>
</div>



</div>
<!--- ENd the check is blocked. --->
<?php } ?>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
</button>
<!-- <h4 class="modal-title" id="myModalLabel">Total Reactions</h4> -->
<div role="tabpanel" id="total_reaction">
<!-- Nav tabs -->

<ul class="nav nav-tabs" role="tablist" id="top_reaction">


</ul>
<!-- Tab panes -->
<div class="tab-content" id="bottom_reaction" >



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

var a = $('#cuer' + postid).text();

var c = parseInt(a) - parseInt(response);
if (c >= 1) {
$('#cuer' + postid).text(c);
} else {
$('#cuer' + postid).text("0");
}
//      $('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');

//  $('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

},

});

}

$(document).ready(function() {
$('.sendPostidEdit').click(function(e) {
/*alert();*/
$(".posteditloader").css({
display: "block"
});
var postid = $(this).attr("data-postid");
//alert(postid);
$(".sp-post-edit").load(MAINURL + "/profile/postField.php", {
postid: postid
}, function(response) {
//alert(response);
$(".posteditloader").css({
display: "none"
});
});
});


});
</script>



<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>





<script>
function myFun(id, ide) {
Swal.fire({
title: 'Do you want to Save this post?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Accepted it!'
}).then((result) => {
if (result.isConfirmed) {


$.ajax({
url: "/friends/savePPost.php",
type: "GET",
data: {
save: id,
profileid: ide
},
success: function(response) {


$("#savefun" + id).html('<a class="profile_section" onclick="myUnsave(' + id + ',' + ide + ')"><i class="fa fa-save"></i> Unsave Post</a>');
}

});
}
});
}

function deletepost(id) {

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
//window.location.href = 'processRegUser.php?action=delete&userId=' + userId;
window.location.href = id;
}
});

}







//     function myFun(id,ide){
//     swal({
//     title: "Save Successfully!",
//     type: "warning",
//     confirmButtonClass: "sweet_ok",
//     confirmButtonText: "Yes",
//     cancelButtonClass: "sweet_cancel",
//     cancelButtonText: "Cancel",
//     showCancelButton: true,
//     },
//     function(isConfirm) {
//     if (isConfirm) {    

// $.ajax({
// url: "/friends/savePPost.php",
// type: "GET",
// data: {
// save: id,
// profileid: ide
// },
// success: function (response) {  


//     $("#savefun"+id).html('<a class="profile_section" onclick="myUnsave('+id+','+ide+')"><i class="fa fa-save"></i> Unsave Post</a>');
//     }

// });
// }
//     });
// }


function myUnsave(id, ide) {
Swal.fire({
title: 'Do you want to Unsave this post?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Accepted it!'
}).then((result) => {
if (result.isConfirmed) {

$.ajax({
url: "/friends/savePPost.php",
type: "GET",
data: {
unsave: id,
profileid: ide
//profileid: ide
},
success: function(response) {

$("#savefun" + id).html('<a class="profile_section" onclick="myFun(' + id + ',' + ide + ')"><i class="fa fa-save">&nbsp;</i>Save Post</a>');
}

});
}
});
}








// function myUnsave(id,ide){
//     swal({
//     title: "Unsave Successfully457547!",
//     type: "warning",
//     confirmButtonClass: "sweet_ok",
//     confirmButtonText: "Yes",
//     cancelButtonClass: "sweet_cancel",
//     cancelButtonText: "Cancel",
//     showCancelButton: true,
//     },
//     function(isConfirm) {
//     if (isConfirm) {    
// $.ajax({
// url: "/friends/savePPost.php",
// type: "GET",
// data: {
// unsave: id,
// profileid: ide
// },
// success: function (response) {  

//     $("#savefun"+id).html('<a class="profile_section" onclick="myFun('+id+','+ide+')"><i class="fa fa-save"></i>Save Post</a>');
//     }

// });
// }
//     });
// }
</script>
<script>
function fav(Postid, count) {
count--;
var Pid = $(".dynamic-pid").val();


$.post("remove_fav.php", {
postid: Postid,
pid: Pid
}, function(response) {


$('#like_' + Postid).html("<span id='spFavouritePost' onclick='unfav(" + Postid + "," + count + ")' data-toggle='tooltip' style='font-size:20px;float:right;' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o' ><span class='font_regular'></span></span><span onclick='postfunction(" + Postid +")' class='show-modal' id='delid" + Postid + "' style='font-size:14px;float:right;margin-right:-41px;'>(" + count + ")</span>");

});
}

function unfav(Postid, count) {
count++;
var Pid = $(".dynamic-pid").val();


$.post("addfav.php", {
postid: Postid,
pid: Pid
}, function(response) {


$('#like_' + Postid).html("<span  onclick='fav(" + Postid + "," + count + ")' data-toggle='tooltip' style='font-size: 20px;float:right;' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart '><span class='font_regular'></span></span><span   onclick='postfunction(" + Postid +")' class='show-modal' id='delid" + Postid + "' style='font-size:14px;float:right;margin-right:-43px'>(" + count + ")</span>");

});
}
</script>
