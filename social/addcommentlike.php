<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$cl = new _commentlike;
    $liked_by = isset($_POST["liked_by"]) ? (int)$_POST["liked_by"] : 0;
	if(isset($_POST['postAction'])) {
        $cid = $_POST["comment_id"];
		if ($_POST['postAction'] == 'add_like') {
			$result = $cl->readLike($_POST["post_id"],$_POST["comment_id"],$liked_by);
			if($result==false){			
			    $cl->addlike(array("post_id" => $_POST["post_id"], "comment_id" => $_POST["comment_id"], "liked_by" => $liked_by));
			}
		}
		else if ($_POST['postAction'] == 'remove_like') {
			$cl->unlike($_POST["post_id"], $_POST["comment_id"], $liked_by);
		}

		$commentTotalLikes =  $cl->getTotalLikes($_POST["comment_id"]);
        $isCommentLikedByUser = $cl->isCommentLikedByUser($_POST["comment_id"],$liked_by);

        // Set classes dynamically
        if ($isCommentLikedByUser) { 
            $likeClass = 'comment_like';
            $postAction = 'remove_like';
        } else {
            $likeClass = 'comment_like';
            $postAction = 'add_like';
        }

        $text = '<img id="likeImg31" src="../assets/images/mini-06.svg" alt="">'." (".$commentTotalLikes.")";

        $likedPost = '<a style="color:#7649B3;" href="javascript:void(0);" class="'.$likeClass.'" id="cmnt_like_'.$cid.'" data-postid="'.$_POST['post_id'].'" data-commentId="'.$_POST['comment_id'].'" data-userId="'.$liked_by.'" data-postAction="'.$postAction.'"><span id="spLikePost">'.$text.'</span></a>';

        echo json_encode(array('commentId'=>$_POST['comment_id'],'postId'=>$_POST['post_id'],'userid'=>$liked_by,'liked' => $likedPost));
	}
	
?>