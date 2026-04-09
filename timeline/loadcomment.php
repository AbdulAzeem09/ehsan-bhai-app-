<?php 

include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

session_start();
require_once '../common.php';
require_once './../classes/Base.php';
require_once "./../classes/Timeline.php";

$timeline = new Timeline();
$postId = $_REQUEST['id'];
$limit = (isset($_REQUEST['ajaxComment']) && $_REQUEST['ajaxComment'] == "yes") ? 2 : 10;
$groupid = (isset($_REQUEST['groupid']) && $_REQUEST['groupid'] > 0) ? $_REQUEST['groupid'] : 0;

$singlepost = $timeline->singletimelinespost($postId, $groupid);
$timelinepost = $singlepost['data'][0];
$obj = $timelinepost;

$spprofiles = new _spprofiles;
$profileImage = $spprofiles->getProfileImage($_SESSION['pid']) ?? '../assets/images/icon/blank-img.png';

if(isset($singlepost['data']) && count($singlepost['data']) > 0){
    foreach($singlepost['data'] as $row) {
        $sp1 = $timeline->readprofiles($row['spProfiles_idspProfiles']);
        if(isset($sp1['data']) && isset($sp1['data']['spUser_idspUser']) && $sp1['data']['spUser_idspUser'] != ""){
            $st1 = $timeline->readdatabybuyerid($sp1['data']['spUser_idspUser']);
            if(isset($st1['data'])){
                if ($st1['data']['deactivate_status'] == 1) {
                    continue;
                }
            }
        }
        $shareData = $timeline->shareData($timelinepost['idspPostings']);
        if(!empty($shareData['data'])){
            $sharedesc = $shareData['data']['spShareComment'];
            $shareproid = $shareData['data']['spPostings_idspPostings'];
        }
        
        $postObject = $timeline->getPost($timelinepost['idspPostings'], $groupid);
        if($postObject){
            $obj['spProfiles_idspProfiles'] = $postObject['data']["spProfiles_idspProfiles"];
            $userData = $timeline->readUserId($postObject['data']["spProfiles_idspProfiles"]);
        }
        if(isset($userData['data'])){
            $picture = $userData['data']["spProfilePic"];
            $profilename = $userData['data']["spProfileName"];
        }
        $time = $timeline->spPostingDate($timelinepost["spPostingDate"]);
    }

    $timlinepostpic = $timeline->readImagePost($timelinepost['idspPostings'], 0, $groupid);
    $album = $timeline->readAlbum($timelinepost['idspPostings']);
    if($timelinepost['bday_post'] == 1){
        $bdayUser = $timeline->UserInfo($timelinepost['bday_pid']);
        if(isset($bdayUser['data']) && isset($bdayUser['data']['spProfileName'])){
            $obj['bdayPid'] = $timelinepost['bday_pid'];
            $obj['bdayUser'] = $bdayUser['data']['spProfileName'];
        }
    }
    if(isset($album['data']) && !empty($album['data'])){
        $obj['media']['picture'] = $album['data']['spPostingMedia'];
        $obj['media']['sppostingmediaTitle'] = $album['data']['sppostingmediaTitle'];
        $obj['media']['original_name'] = $album['data']['original_name'];
        $obj['media']['sppostingmediaExt'] = $album['data']['sppostingmediaExt'];
    }

    if(isset($picture)){
        $obj['picture'] = $picture;
    }else{
        $obj['picture'] = '../assets/images/icon/blank-img.png';
    }
    if(isset($profilename)){
        $obj['profilename'] = $profilename;
    }
    if(isset($time)){
        $obj['time'] = $time;
    }
    if(isset($timlinepostpic)){
        $obj['timlinepostpic'] = $timlinepostpic;
    }
    $likeCount = $timeline->getLikesCount($timelinepost['idspPostings']);
    $isLiked = false;
    $obj['likeCount'] = 0;
    if(isset($likeCount['total'])){
        $obj['likeCount'] = $likeCount['total'];
        $isLiked = $timeline->checkIfLiked($timelinepost['idspPostings']);
    }
    $obj['isLiked'] = $isLiked;
    $obj['commentsCount'] = 0;
    $commentsCount = $timeline->getCommentsCount($timelinepost['idspPostings']);
    $isCommented = false;
    $obj['comments'] = null;
    if(isset($commentsCount['total'])){
        $obj['commentsCount'] = $commentsCount['total'];
        $isCommented = $timeline->checkIfCommented($timelinepost['idspPostings']);
        $comments = $timeline->getCommented($timelinepost['idspPostings'],$limit);
        foreach($comments as $comment){
            $comment['commentdate'] = $timeline->spPostingDate($comment['commentdate']);
            $comment['comment'] = ucfirst($comment['comment']);
            $comment['pic'] = "../assets/images/icon/blank-img.png";
            $comment['name'] = '';
            $comment['pid'] = $_SESSION['pid'];
            $recomment = new _comment;
            $cresult = $recomment->read_by_id($comment["idComment"]);
            if($cresult != false){
                $cresult = mysqli_fetch_assoc($recomment->read_by_id($comment["idComment"]));
                if(!empty($cresult['spProfilePic'])){
                    $comment['pic'] = $cresult['spProfilePic'];
                }
                $comment['name'] = $cresult['spProfileName'];
            }
            $obj['comments'][] = $comment;
        }
    }
    $obj['isCommented'] = $isCommented;
    $loveCount = $timeline->getLovesCount($timelinepost['idspPostings']);
    $isLoved = false;
    $obj['loveCount'] = 0;
    if(isset($loveCount['total'])){
        $obj['loveCount'] = $loveCount['total'];
        $isLoved = $timeline->checkIfLoved($timelinepost['idspPostings']);  
    }
    $obj['isLoved'] = $isLoved;
    $shareCount = $timeline->getSharesCount($timelinepost['idspPostings']);
    $isShared = false;
    $obj['shareCount'] = 0;
    if(isset($shareCount['total'])){
        $obj['shareCount'] = $shareCount['total'];
        $isShared = $timeline->checkIfShared($timelinepost['idspPostings']);  
    }
    $obj['isShared'] = $isShared;
    $obj['isFollowing'] = false;
    $obj['isFollowing'] = $timeline->checkFollowing($timelinepost['spProfiles_idspProfiles']);
}

?>

<?php function comments($timeline, $comment, $postId, $model = false){
    $commentLikes = new _commentlike;
?>
    <div class="d-flex flex-row px-3 py-2 cmtdiv<?php echo $comment['idComment'];  ?>">
        <img src="<?= $comment['pic']; ?>" width="40" height="40" class="rounded-circle mx-3">
        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-grid grid-row align-items-center">
                    <span class="me-2"><?= $comment['name']; ?></span>
                    <small class="time"><?= $comment['commentdate']; ?></small>
                </div>
                <?php 
                    $idComment = $comment['idComment'];
                    if ($_SESSION['pid'] == $comment["spProfiles_idspProfiles"]) {                        
                ?>
                    <div class="dropdown">
                        <a class="text-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <span class="editcomment_<?= $comment["idComment"] ?> dropdown-item show_edit_comment editcomment <?php ($_SESSION["uid"] == $comment["userid"] ? "" : "hidden") ?>" data-commentid="<?= $comment["idComment"] ?>" data-postid="<?= $postId?>" data-commenttext="<?= $comment["comment"] ?>"><span class='fa fa-pencil ' > </span></span>
                            </li>
                            <li>
                                <span onclick='deletecomment("<?= $idComment ?>")' class="dropdown-item deletecmt <?php ($_SESSION["uid"] == $comment["userid"] ? "" : "hidden") ?>" data-commentid="<?= $comment["idComment"] ?>"><span class='fa fa-trash '>  </span></span>
                            </li>
                        </ul>
                    </div>   
                <?php } ?>
            </div>
            <p class="text-justify comment-text mb-0 edit_comment_box_<?= $comment['idComment']; ?>">
                <?= html_entity_decode($comment['comment']) ?>
            </p>
                
            <div class="d-flex flex-row user-feed">
                <?php 
                    $commentTotalLikes =  $commentLikes->getTotalLikes($idComment);
                    $isCommentLikedByUser = $commentLikes->isCommentLikedByUser($idComment, $_SESSION['pid']);
                    if ($isCommentLikedByUser) {
                        $likeClass = 'comment_like';
                        $postAction = 'remove_like';
                    } else {
                        $likeClass = 'comment_like';
                        $postAction = 'add_like';
                    }
                ?>
                <span style="cursor:pointer;" class="wish comment_like_area_<?php echo $comment["idComment"]; ?>">
                    <a href="javascript:void(0);" style="color:#7649B3;" class="<?php echo $likeClass; ?>" id="cmnt_like_<?php echo $comment["idComment"]; ?>" data-postid="<?php echo $postId; ?>" data-commentId="<?php echo $comment["idComment"]; ?>" data-userId="<?php echo $_SESSION['pid']; ?>" data-postAction="<?php echo $postAction; ?>">
                        <span id='spLikePost'>
                            <img id="likeImg31" src="../assets/images/mini-06.svg" alt=""> (<?php echo $commentTotalLikes ?>)
                        </span>
                </a>
                </span>
                <!--- End section for like of comment --->
                <span style="cursor:pointer"; class="ms-3">
                    <span <?php if($model == true ) { ?> onclick="loadComment('<?php echo $postId; ?>')" <?php } else { ?> onclick="loadCommentReply('<?php echo $idComment; ?>')" <?php } ?>>
                        <div class='commentoverflow'><i class="fa fa-comment-dots me-2"></i> Reply</div>
                </span>
                </span>
            </div>

            <?php if($model == false){ ?>
                <div id="reply_comment_wrapper_<?php echo $comment['idComment'];  ?>"></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php if(isset($_REQUEST['ajaxComment']) && in_array($_REQUEST['ajaxComment'], ["yes", "no"])){ ?>
    <?php if($obj['comments']) {
        foreach($obj['comments'] as $comment){      
        $modal = true;
        if($_REQUEST['ajaxComment'] == "no"){
            $modal = false;
        }
    ?>
        <?php echo comments($timeline, $comment, $postId, $modal); ?>
    <?php }
    } ?>
<?php }else{ ?>
    <div class="modal fade" id="postComments" tabindex="-1" aria-labelledby="postCommentsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6> <?= $profilename ?>'s Message</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row height d-flex justify-content-center align-items-center">                    
                        <div class="col-md-12">                        
                            <div class="card">                            
                                <div class="p-3">
                                    <div class="d-flex justify-content-between align-items-lg-start mb-3">
                                        <div class="d-grid grid-row justify-content-around">
                                            <span class="me-2 fs-5">
                                                <img src="<?= $obj['picture'] ?>" width="40" height="40" class="rounded-circle me-2"> 
                                                <?= $obj['profilename'] ?>
                                            </span>                                             
                                            <small class="fs-sm time" style="position: relative;left: 53px;top: -7px;"><?= $obj['time'] ?></small>
                                        </div>                                 
                                    </div>
                                    <div class="d-flex">
                                        <small class="wish fs-sm me-3"><span id="post_total_count" ><?= $obj['commentsCount']; ?></span> Comments</small>
                                        <small class="wish fs-sm me-3"><?= $obj['likeCount']; ?> Likes</small>
                                    </div>
                                    <p class="comment-text">
                                        <?= html_entity_decode($obj['spPostingNotes']) ?>
                                        <?php 
                                            if(isset($timlinepostpic) && isset($timlinepostpic['data']) && count($timlinepostpic['data']) > 0 ){
                                                foreach($timlinepostpic['data'] as $item)
                                                  if(!empty($item['spPostingPic'])){ ?>
                                                    <div class="blog-img">
                                                        <img src="<?= $item['spPostingPic'] ?>" class="img-fluid center" alt="" />
                                                    </div>
                                            <?php }
                                            }
                                        ?>
                                        <?php if(!empty($obj['media'])){
                                            if($obj['media']['sppostingmediaExt'] == 'mp3'){
                                            $html = '<div style="margin-left:15px;margin-right:15px;"><audio class="center" style="width:90%" controls><source src="'.$obj['media']['sppostingmediaTitle'].'" type="audio/'.$obj['media']['sppostingmediaExt'].'">Your browser does not support the audio element.</audio></div>';
                                            } else if(in_array($obj['media']['sppostingmediaExt'], ['pdf','xls','doc','docx'])){
                                            $html = '<div class="row timelinefile" style="width:100%;"><div class="col-md-offset-1 col-md-1 no-padding"><img src="'.BASE_URL.'/assets/images/pdf.png" alt="pdf" class="img-fluid"/></div><div class="col-md-10"><h3>'.$obj['media']['original_name'].'</h3><small>'.$obj['media']['sppostingmediaExt'].'</small><a href="'.$obj['media']['sppostingmediaTitle'].'"  target="_blank" download>Preview</a></div></div>';
                                            } else if(in_array($obj['media']['sppostingmediaExt'], ['mp4', 'webm', "wmv"])) {
                                            $html = '<div style="margin-left:15px;margin-right:15px;"><video class="custom-video center" style="width: 65%;!important;" controls><source src="'.$obj['media']['sppostingmediaTitle'].'" type="video/'.$obj['media']['sppostingmediaExt'].'"></video></div>';
                                            }
                                            echo $html;
                                        }
                                        ?>
                                    </p>
                                </div>
                            
                                <div class="mt-2">
                                    <div id="load_modal_new_commnet_section_<?= $postId ?>">
                                        <?php if($obj['comments']) {
                                            foreach($obj['comments'] as $comment){      
                                        ?>
                                            <?php echo comments($timeline, $comment, $postId, false); ?>
                                        <?php }} ?>
                                    </div>

                                    <div class="mt-3 d-flex flex-row align-items-center p-3 form-color commentsBar">
                                        <img src="<?php echo $profileImage; ?>" width="50" height="50" class="rounded-circle me-2">
                                        <input type="text" id="model_input_message" class="form-control" placeholder="Enter your comment...">
                                        <div class="d-flex">                                            
                                            <div onclick="postModalComments('<?= $postId;?>')" class="plan-icon d-flex justify-content-center align-items-center" style="top: 24px;right: 22px;"><img src="https://sharepage_codes.test/assets/images/post-icon.svg" class="img-fluid" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>