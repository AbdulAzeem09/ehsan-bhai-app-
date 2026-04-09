<?php

/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);  */

session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

require_once "../common.php";

$p = new _comment;
//print_r($_POST);
//die('========');
$_POST['userid'] = $_SESSION["uid"];
$arrayToPassForInsert = [];
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
	$ruser = mysqli_fetch_assoc($res);

	$time_zone = $ruser["time_zone"];
}
//$date = date('Y-m-d H:i:s', strtotime($time_zone . 'hours'));
$date = date('Y-m-d H:i:s');

$_POST['commentdate'] = $date;
$arrayToPassForInsert = $_POST;

$spPostings_idspPostings = isset($_POST['spPostings_idspPostings']) ? (int)$_POST['spPostings_idspPostings'] : 0;
$callFromPostDetailPage = isset($_POST['callFromPostDetailPage']) ? (int) $_POST['callFromPostDetailPage'] : 0;

$isPageCallKeyExist = array_key_exists('callFromPostDetailPage', $arrayToPassForInsert);

if ($isPageCallKeyExist) {
	unset($arrayToPassForInsert["callFromPostDetailPage"]);
}
//print_r($arrayToPassForInsert);
$arr = [];
$arr[] = $spPostings_idspPostings;
$arr[] = isset($_POST['spProfiles_idspProfiles']) ? (int)$_POST['spProfiles_idspProfiles'] : 0;
$arr[] = isset($_POST['userid']) ? (int)$_POST['userid'] : 0;
$arr[] = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';
$arr[] = isset($_POST['commentdate']) ? $_POST['commentdate'] : date('Y-m-d H:i:s');
insertQ('insert into comment (spPostings_idspPostings, spProfiles_idspProfiles, userid, comment, commentdate) values (?, ?, ?, ?, ?)', 'iiiss', $arr);
//$p->comment($arrayToPassForInsert);

// $sql = "INSERT INTO comment (spPostings_idspPostings, spProfiles_idspProfiles, userid, comment) VALUES ('2815', '770', '385', 'ggggg')";
// if (!mysqli_query($conn,$sql)) {
//     die('error: ' . mysqli_error($conn));
// }
// $result = dbQuery($dbConn, $sql);

// echo $this->db->last_query(); exit();

$result = $p->read($spPostings_idspPostings);
$totalcmt = 0;
if ($result != false) {
	$totalcmt = $result->num_rows;
	// $comment = '';
	//echo $comment;
}
?>



<?php

$comment = new _comment;
$recomment = new _comment_reply;
$commentLikes = new _commentlike;

$result_c = $comment->read_a($spPostings_idspPostings);
/*                            $result = $c->read($_POST['idspPostings']);
*/
//print_r($result_c);
//die('=============');
if ($result_c != false) {
	while ($row = mysqli_fetch_assoc($result_c)) {
		$profilename = $row["spProfileName"];
		$comment = $row["comment"];
		$picture = $row["spProfilePic"];
		$date = $row["commentdate"];
//echo $date;die;
		$cid = $row["idComment"];
		$pro_ids = $row["spProfiles_idspProfiles"];
		$href_profile = $BaseUrl . "/friends/?profileid=" . $pro_ids;

		$result_rc = $recomment->read($row["idComment"]);
		$commentTotalLikes =  $commentLikes->getTotalLikes($cid);
		$isCommentLikedByUser = $commentLikes->isCommentLikedByUser($cid, $_SESSION['pid']);

//Modal for edit any post 
		$comment_d ='';

		$comment_d = '<div id="mycmtEdit' . $cid . '" class="modal fade " role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content  bradius-15">
		<form method="post" action="editcomment.php" id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data">
		<div class="modal-header">

		<h4 class="modal-title">Edit Comment</h4>
		<button type="button" class="close " data-dismiss="modal" style="margin-right: 5px; margin-top: -25px !important;"> <span aria-hidden="true" id="span1">&times;</span>
		</button>
		</div>


		<div class="modal-body">
		<div class="row">
		<div class="col-md-12">
		<div class="posteditloader">
		<div class="loader"></div>
		</div>
		</div>
		<div class="col-md-12">

		<div class="">
		<input type="text" class="form-control" name="comment" value="' . $row["comment"] . '" >

		<input name="idComment" id="pid" type="hidden" value="' . $row["comment"] . '" >
		<input name="postid" id="pid" type="hidden" value=" ' . $spPostings_idspPostings . ' ">




		</div>

		</div>
		</div>
		</div>

		<div class="modal-footer">
		<button id="comment" onclick="editcomment(' . $row["idComment"] . ')" class="btn btnPosting pull-right editing db_btn db_primarybtn">Save</button>
		<button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>


		</div>
		</form>
		</div>
		</div>
		</div>

		<div id="replycomment' . $cid . '" class="modal fade " role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content  bradius-15">
		<form id="recomments' . $cid . '" name="recomments' . $cid . '" method="post" action="reply_comment.php">
		<div class="modal-header">

		<h4 class="modal-title">Reply Comment</h4>
		<button type="button" class="close " data-dismiss="modal" style="margin-right: 5px;"> <span aria-hidden="true">&times;</span>
		</button>
		</div>


		<div class="modal-body">
		<div class="row">
		<div class="col-md-12">
		<div class="posteditloader">
		<div class="loader"></div>
		</div>
		</div>
		<div class="col-md-12">

		<div class="">
		<input type="text" class="form-control" name="replycomment" required value="">

		<input name="idComment" id="idComment" type="hidden" value="' . $row["idComment"] . '">
		<input name="spPostings_idspPostings" id="spPostings_idspPostings" type="hidden" value="' . $spPostings_idspPostings . '" >
		<input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" type="hidden" value="' . $_SESSION["pid"] . '" >
		<input name="userid" id="userid" type="hidden" value="' . $_SESSION["uid"] . '">


		</div>

		</div>
		</div>
		</div>

		<div class="modal-footer">
		<button id="recomment" type="submit" class="btn btnPosting pull-right editing db_btn db_primarybtn">Save</button>
		<button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
		</div>
		</form>
		</div>
		</div>
		</div>
		<div>
		<div id="comment_field" class="cmtdiv' . $cid . '" style="padding: 0px 15px 0px 0px;">
		<div class="col-md-12">
		<div class="col-md-8">';

		if (isset($picture)) {
			$comment_d.= '<div  class="commentoverflow"><a href="' . $href_profile . '"><img alt="profilepic"  class="img-circle"  src="' . ($picture) . '" style="width: 40px; height: 40px;"><span style="color:#032350; font-size:15px;padding-left: 8px;"> ' . ucfirst($profilename) . '</span></a></div>';
		} else {
			$comment_d.= '<div  class="commentoverflow"><a href="' . $href_profile . '"><img alt="profilepic"  class="img-circle" src="../assets/images/icon/blank-img.png" style="width: 40px; height: 40px;">
			<span  style="color:#032350; font-size:15px;padding-left: 8px;">' . ucfirst($profilename) . '</span></a></div>';
		}
		$comment_d.= '       
		</div>';

		if ($_SESSION['pid'] == $row["spProfiles_idspProfiles"]) {

			$comment_d.= '<div class="dropdown pull-right right_profile_timeline">
			<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
			<i class="fa fa-ellipsis-h" aria-hidden="true">
			</i>
			</button>
			<ul class="dropdown-menu">
			<li><?php
			echo  "<button type="button" onclick="deletecomment(' . $row["idComment"] . ')" class="deletecmt btn btn1 ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '"  data-commentid="' . $row["idComment"] . '"><span class="fa fa-trash ">  </span> Delete Comment</button>

			</li>
			<li class="cpading">

			<button type="button"  data-toggle="modal" data-target"#mycmtEdit' . $cid . '" class="editcomment btn1 btn ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '" data-commentid="' . $row["idComment"] . '" data-commenttext="' . $row["comment"] . '"><span class="fa fa-pencil " > </span> Edit Comment</button>
			</li>
			</ul>
			</div>';
		}
		$comment_d.= '  
		</div>
		<div class="input-group" style="margin-top: 10px;    padding-bottom: 10px;">
		<div class="input-group-addon commentprofile inputgroupadon border_none" style="border-radius:20px">
		</div>
		<div id="ip10">
		<div id="comment1">

		<div class="col-md-12 commentoverflow" style="margin-top:11px;"><span style="color:#1c1e21;" >' . $comment . '</span></div>

		</div>
		</div>
		<div style="display: inline-flex;padding-left:55px; margin-top:7px; margin-bottom:10px">';
//////Start section for like of comment/////

		if ($isCommentLikedByUser) {
			$likeClass = 'comment_like';
			$postAction = 'remove_like';
		} else {
			$likeClass = 'comment_like';
			$postAction = 'add_like';
		}
		$comment_d.= '
		<span class="comment_like_area_' . $cid . '">
		<a href="javascript:void(0);" class="' . $likeClass . '" id="cmnt_like_' . $cid . '" data-postid="' . $_GET['postid'] . '" data-commentId="' . $cid . '" data-userId="' . $_SESSION['pid'] . '" data-postAction="' . $postAction . '">


		<span id="spLikePost">';

		if ($isCommentLikedByUser) {
			if ($commentTotalLikes > 0) {
				$comment_d = '
				<i class="icon-socialise fa fa-thumbs-up"></i> Unlike ( ' . $commentTotalLikes . ' )&nbsp;.&nbsp;';
			} else {
				$comment_d.= '
				<i class="icon-socialise fa fa-thumbs-up"></i> Unlike&nbsp;.&nbsp;';
			}
		} else {
			if ($commentTotalLikes > 0) {
				$comment_d.= '
				<i class="icon-socialise fa fa-thumbs-o-up"></i> Like (' . $commentTotalLikes . ')&nbsp;&nbsp;';
			} else {
				$comment_d.= '
				<i class="icon-socialise fa fa-thumbs-o-up"></i> Like&nbsp;&nbsp;';
			}
		}
		$comment_d.= '
		</span>
		</a>
		</span>
		<!--- End section for like of comment --->
		<a href="javascript:void(0);" data-toggle="modal" data-target="#replycomment' . $cid . '" id="rep_main_cmt">
		<div class=" commentoverflow">
		Reply
		</div>
		</a>
		<span style="color: #999;">
		&nbsp;

		' . ($date) . '

		</span>
		</div>';

		if ($result_rc != false) {
			while ($rowss = mysqli_fetch_assoc($result_rc)) {
				$comment_d.= '
				<div class="repcmtdiv' . $rowss["id"] . '" style="margin-bottom: 10px;">';


				$profilename1 = $rowss["spProfileName"];
				$comment1 = $rowss["replycomment"];
				$picture1 = $rowss["spProfilePic"];
				$c_date1 = $rowss["comment_reply_date"];
				$cid1 = $rowss["idComment"];
				$repid1 = $rowss["id"];
				$pro_ids1 = $rowss["spProfiles_idspProfiles"];
				$href_profile1 = $BaseUrl . "/friends/?profileid=" . $pro_ids1;
				if ($cid1 == $cid) {
					if (isset($picture1)) {
						$comment_d.= '
						<div style="padding-left:60px; padding-right:10px;margin-top:12px;" class="commentoverflow "><a href="' . $href_profile1 . '" ><img alt="profilepic" class="img-circle" src="' . ($picture1) . '" style="width: 40px; height: 40px;"><span style="color:#032350; font-size:15px; padding-left: 8px;">' . ucfirst($profilename1) . '</span></a>


						<div class="dropdown pull-right right_profile_timeline">
						<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">

						</div>';

						if ($_SESSION['pid'] == $pro_ids1) {
							$comment_d.= '
							<div class="dropdown pull-right right_profile_timeline">
							<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
							<i class="fa fa-ellipsis-h" aria-hidden="true">
							</i>
							</button>
							<ul class="dropdown-menu">
							<li>
							<button type="button" onclick="deletecommentreply(' . $repid1 . ')" class="deletecmt btn btn1 ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '" data-commentid="' . $repid1 . '"><span class="fa fa-trash ">  </span> Delete Comment</button>

							</li>
							<li class="cpading"> <button type="button"  data-toggle="modal" data-target="#mycmtEditrep' . $repid1 . '"
							class="editcommentrep btn1 btn ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '" data-commentid="' . $repid1 . '" data-commenttext="' . $repid1 . '"><span class="fa fa-pencil " > </span> Edit Comment</button>
							</li>
							</ul>
							</div>';
						}

						$comment_d.= ' </div>';
					} else {
//  echo $_SESSION['pid'] ;
//  echo $pro_ids1;
//die("=====");
						$comment_d.= '<div  style="padding-left:60px; padding-right:10px;margin-top:12px;" class="commentoverflow"><a href="' . $href_profile1 . '"><img alt="profilepic"  class="img-circle" src="../assets/images/icon/blank-img.png" style="width: 40px; height: 40px;">
						<span  style="color:#032350; font-size:15px; padding-left: 3px;">' . ucfirst($profilename1) . '</span></a>


						<div class="ropdown pull-right right_profile_timeline">
						<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">

						</div>';

						if ($_SESSION['pid '] == $pro_ids1) {
							$comment_d.= '
							<div class="dropdown pull-right right_profile_timeline">
							<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
							<i class="fa fa-ellipsis-h" aria-hidden="true">
							</i>
							</button>
							<ul class="dropdown-menu">
							<li>
							<button type="button" onclick="deletecommentreply(' . $repid1 . ')" class="deletecmt btn btn1 ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '" data-commentid="' . $repid1 . '"><span class="fa fa-trash ">  </span> Delete Comment</button>

							</li>


							<li class="cpading"> <button type="button"  data-toggle="modal" data-target="#mycmtEditrep' . $repid1 . '" class="editcommentrep btn1 btn ' . ($_SESSION["uid"] == $row["userid"] ? '' : "hidden") . '" data-commentid="' . $repid1 . '" data-commenttext="' . $repid1 . '"><span class="fa fa-pencil " > </span> Edit Comment</button>
							</li>
							</ul>
							</div>';
						}




						$comment_d.= ' </div>';
					}


					$comment_d.= '
					<div id="mycmtEditrep<?php echo $repid1;  ?>" class="modal fade " role="dialog">
					<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content  bradius-15">
					<form method="post" action="repeditcomments.php" id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data">
					<div class="modal-header">

					<h4 class="modal-title">Edit Comment</h4>
					<button type="button" class="close " data-dismiss="modal" style="margin-right: 5px;margin-top: -25px !important; "> <span aria-hidden="true" id="span1">&times;</span>
					</button>
					</div>


					<div class="modal-body">
					<div class="row">
					<div class="col-md-12">
					<div class="posteditloader">
					<div class="loader"></div>
					</div>
					</div>
					<div class="col-md-12">

					<div class="">
					<input type="text" class="form-control" name="replycomment" value="' . $comment1 . '">

					<input name="repid" id="pid" type="hidden" value="' . $repid1 . '">
					<input name="postid" id="pid" type="hidden" value="' . $spPostings_idspPostings . '">
					</div>
					</div>
					</div>
					</div>

					<div class="modal-footer">
					<button id="comment" onclick="editcomment(' . $repid1 . ')" class="btn btnPosting pull-right editing db_btn db_primarybtn">Save</button>
					<button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>


					</div>
					</form>
					</div>
					</div>
					</div>

					<div id="ip10">
					<div id="comment1">
					<div class="col-md-12 commentoverflow" style="margin-top:10px;"><span style="color:#1c1e21;" >' . $comment1 . '</span></div>
					</div>
					<h5 style="margin: 5px;color: #999;font-family: MarksimonRegular; padding-top: 10px;">

					</h5>

					</div>
					</div>';
				}
			}
		}
		$comment_d.= '
		<div style="display: none;padding-left:55px; margin-top:7px; margin-bottom:10px">';
////Start section for like of comment//
		if ($isCommentLikedByUser) {
			$likeClass = 'comment_like';
			$postAction = 'remove_like';
		} else {
			$likeClass = 'comment_like';
			$postAction = 'add_like';
		}
		$comment_d.= '
		<span class="comment_like_area_'.$cid.'">
		<a href="javascript:void(0);" class="'.$likeClass.'" id="cmnt_like_'. $cid.'" data-postid="'.$_GET['postid'].'" data-commentId="'.$cid.'" data-userId="'.$_SESSION['pid'].'" data-postAction="'.$postAction.'">


		<span id="spLikePost">';
		if ($isCommentLikedByUser) {  
			if ($commentTotalLikes > 0) {
				$comment_d .= '
				<i class="icon-socialise fa fa-thumbs-up"></i> Unlike ('.$commentTotalLikes.')&nbsp;.&nbsp;';
			} else {
				$comment_d .= '
				<i class="icon-socialise fa fa-thumbs-up"></i> Unlike&nbsp;.&nbsp;';
			}
		} else { 
			if ($commentTotalLikes > 0) {
				$comment_d .= '
				<i class="icon-socialise fa fa-thumbs-o-up"></i> Like ('.$commentTotalLikes.')&nbsp;&nbsp;';
			} else {
				$comment_d .= '
				<i class="icon-socialise fa fa-thumbs-o-up"></i> Like&nbsp;&nbsp;';
			}
		}
		$comment_d .= '
		</span>
		</a>
		</span>
		<!--- End section for like of comment --->
		<a href="javascript:void(0);" data-toggle="modal" data-target="#replycomment'.$cid.'" id="rep_main_cmt">
		<div class=" commentoverflow">
		Reply
		</div>
		</a>
		<span style="color: #999;">
		&nbsp;
		<?php
		echo ($date);
		?>
		</span>
		</div>
		</div>



		</div>


		</div>';

///////////////////loop close///////////////////

	}
}






//////////////loop close------->


?>



<?php


if ($callFromPostDetailPage == 1) {
	
	$r = new _redirect;
	$r->redirect("../publicpost/post_comment_details.php?postid=" . $spPostings_idspPostings . "");
} else { 
	
	$r = new _redirect;
	$r->redirect("../timeline/". "");
}
?>
