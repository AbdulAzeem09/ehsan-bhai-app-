<div class="main-heading">
    <div class="text-wrapper">
        <div class="top-heading">
            <?php echo $_GET["groupname"]; ?>
            <?php if($group_row_data['status'] == "draft"){ ?>
                <span style="font-size:15px;">(Draft)</span>
            <?php } ?>
            <?php if(in_array($role, ['owner','admin'])) { ?>
                <?php if($group_row_data['status'] == "active"){ ?>
                    <a style="text-decoration: none;color: white;" href="javascript:;void(0);" onclick='publishGroup("<?= $group_row_data["idspGroup"] ?>", "draft")'><span class="share-btn">Mark As Draft</span></a>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="popup-detail">
            <div class="privacy">
                <?= $group_type ?> 
            </div>
            <span>.</span>
            <div class="member">
                <?php echo "Members $activeCounter "; ?> 
            </div>
        </div>
    </div>
    <?php
    if($group_row_data['status'] == "active"){
        $share_text = urlencode("Check this out!");
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];        
        $uri = $_SERVER['REQUEST_URI'];
        $full_url = $protocol . '://' . $host . $uri;
        $share_url = urlencode($full_url);
    ?>
        <div style="display: inline-flex;">
            <div class="share-btn" style="display: inline-flex;">
                <img class="share-button" src="./images/share-2.svg" alt="">
                <span style="padding:6px;">Share</span>
                <div class="more-link">
                    <div class="dropdown">
                        <a class="text-dark" type="button" id="dropdownMenuButtonPosting1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/dot-2.svg" class="img-fluid" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPosting1">
                            <li style="cursor:pointer;">
                                <span class="dropdown-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/facebook.svg" alt=""></a>   </span>
                                <span class="dropdown-item"><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/insta.svg" alt=""></a>  </span>
                                <span class="dropdown-item"><a href="https://twitter.com/intent/tweet?text=<?php echo $share_text . '&url=' . $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/tweet.svg" alt=""></a>  </span>
                                <span class="dropdown-item"><a href="https://api.whatsapp.com/send?text=<?php echo $share_text . '%20' . $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/whatsapp.svg" alt=""></a>   </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            &nbsp;

            <div class="share-btn more-link more-btn" id="explore-bar-access-more-link">
                <div class="dropdown">
                    <a class="text-dark" type="button" id="dropdownMenuButtonPosting1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/dot-2.svg" class="img-fluid" alt="">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPosting1">
                        <li style="cursor:pointer;">
                            <div class="exit-btn dropdown-item" style="display:none;" data-bs-toggle="modal" data-bs-target="#exit-group">
                                <i class="fa fa-sign-out"></i> Exit
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } else{ ?>
        <div class="share-btn social-share-container" onclick='publishGroup("<?= $group_row_data["idspGroup"] ?>")'>Publish Now</div>
    <?php }
    ?>
</div>
<div class="line"></div>

<style>
    .more-btn {
        border-radius: 75px;
        color: white;
        cursor: pointer;
        font-size: 14px;
        margin-top: 10px;
        padding: 5px 5px !important;
    }
    
    /* Button style */
    .share-button {
        color: white;
        cursor: pointer;
        padding: 6px;
        transition: background-color 0.3s ease;
    }
</style>


<script>
    function publishGroup(id, type = "active"){
        $("div.global_spanner").addClass("show");
        $("div.global_overlay").addClass("show");
        setTimeout(() => {
            // user accept the group invitation
            $.post("../grouptimelines/common/group_action.php", {
                id: id,
                publish_group: true,
                type : type
            }, function (r) {
                $("div.global_spanner").removeClass("show");
                $("div.global_overlay").removeClass("show");
                let res = JSON.parse(r);
                if(res.status == "publish_group"){
                    toastr.success('Group has been successfully published.');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
                else {
                    toastr.error(res.message);
                }   
            });
        }, 3000);
    }
</script>