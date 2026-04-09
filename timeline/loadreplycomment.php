<?php 
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
require_once '../common.php';
require_once './../classes/Base.php';
require_once "./../classes/Timeline.php";

$timeline = new Timeline();
$cid = $_REQUEST['cid'];
$result = selectQ("select * from comment AS t inner join spprofiles as d on t.spprofiles_idspprofiles = d.idspprofiles where t.idComment =? limit 1", "i", [$cid]);
$row = $result[0] ?? null;
if($row){
    $postId = $row['spPostings_idspPostings'];
?>
<form id="recomments<?php echo $cid; ?>" method="post" action="../publicpost/reply_comment.php" onsubmit="return false;">
    <div clas="card row height d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card-body">
                <h6 class="card-title">Reply</h6>
                <div class="row">
                    <div class="">
                        <div class="plan-icon d-flex justify-content-center align-items-center" style="position: absolute;margin-top: 6px;right: 38px;"><button data-cid="<?php echo $cid; ?>" type="button" class="replycomment btn btnPosting pull-right editing db_btn db_primarybtn"><img src="https://sharepage_codes.test/assets/images/post-icon.svg" class="img-fluid" alt=""></button></div>
                        <input type="text" class="form-control" id="message<?php echo $cid; ?>" name="replycomment" required value="" placeholder="Enter your comment...">
                        <input name="idComment" id="idComment<?php echo $cid; ?>" type="hidden" value="<?php echo $cid; ?>">
                        <input name="spPostings_idspPostings" id="spPostings_idspPostings<?php echo $cid; ?>" type="hidden" value="<?php echo $postId ?>">
                        <input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles<?php echo $cid; ?>" type="hidden" value="<?php echo $_SESSION["pid"]; ?>">
                        <input name="userid" id="userid<?php echo $cid; ?>" type="hidden" value="<?php echo $_SESSION["uid"]; ?>">
                        <input name="redirect" type="hidden" value="ajax">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    $recomment = new _comment_reply;
    $result_rc = $recomment->read($cid);
    if ($result_rc != false) {
        while ($rowss = mysqli_fetch_assoc($result_rc)) {
        ?>
            <div class="repcmtdiv<?php echo $rowss["id"]; ?>" id="repcmtdiv<?php echo $rowss["id"]; ?>">
                <?php
                    $profilename1 = $rowss["spProfileName"];
                    $comment1 = $rowss["replycomment"];
                    $picture1 = $rowss["spProfilePic"] ?? '../assets/images/icon/blank-img.png';
                    $c_date1 = $rowss["comment_reply_date"];
                    $cid1 = $rowss["idComment"];
                    $repid1 = $rowss["id"];
                    $pro_ids1 = $rowss["spProfiles_idspProfiles"];
                    $href_profile1 = $BaseUrl . "/friends/?profileid=" . $pro_ids1;
                    $time = $timeline->spPostingDate($rowss['comment_reply_date']);

                    if ($cid1 == $cid) { ?>
                        <div class="d-flex flex-row px-3 py-2 cmtdiv<?php echo $rowss['id'];  ?>">
                            <img src="<?php echo ($picture1); ?>" width="40" height="40" class="rounded-circle mx-3">
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-grid grid-row align-items-center">
                                        <span class="me-2"><?= ucfirst($profilename1); ?></span>
                                        <small class="time"><?= $time; ?></small>
                                    </div>
                                    <?php if ($_SESSION['pid'] == $pro_ids1) {
                                    ?>
                                        <div class="dropdown">
                                            <a class="text-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <span class="edit_reply_comment_<?= $repid1 ?> dropdown-item show_repl_edit_comment editreplycomment <?php ($_SESSION["uid"] == $row["userid"] ? "" : "hidden") ?>" data-commentid="<?= $repid1 ?>" data-commenttext="<?= $comment1 ?>"><span class='fa fa-pencil ' > </span></span>
                                                </li>
                                                <li>
                                                    <span onclick='deletecommentreply("<?= $repid1 ?>")' class="dropdown-item deletecmt <?php ($_SESSION["uid"] == $row["userid"] ? "" : "hidden") ?>" data-commentid="<?= $repid1 ?>"><span class='fa fa-trash '>  </span></span>
                                                </li>
                                            </ul>
                                        </div>   
                                    <?php } ?>
                                </div>
                                <p class="text-justify comment-text mb-0 edit_comment_reply_box_<?= $repid1; ?>">
                                    <?= html_entity_decode($comment1) ?>
                                </p>
                            </div>
                        </div>
                <?php } ?>
            </div>
    <?php }
    } 
}
?>