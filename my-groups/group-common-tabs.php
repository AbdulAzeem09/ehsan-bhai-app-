<?php if($searchFilterEnabled == true) { ?>
    <form id="groupForm" method="get" action="<?php echo $BaseUrl; ?>/my-groups/search-group.php">
<?php } ?>
    <div class="filters">
        <?php if($searchFilterEnabled == false) { ?> 
            <form id="groupForm" method="get" action="<?php echo $BaseUrl; ?>/my-groups/search-group.php"> 
        <?php } ?>
            <div class="search-box">
                <div class="search-box-wrapper">
                    <div class="icon">
                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />
                        </svg>
                    </div>
                    <input type="text" aria-describedby="basic-addon1" name="txtSearch" value="<?php if (isset($_GET['txtSearch'])) { echo $_GET['txtSearch'];} ?>" placeholder="Search by group title">
                    <?php if($searchFilterEnabled == false) { ?> <input type="hidden" name="group" value="all"> <?php } ?>
                </div>
                <button type="submit">SEARCH</button> 
                <?php if(isset($_GET['txtSearch']) && $_GET['txtSearch'] != ""){ ?>
                    <button type="button" style="width:0px; background:none;"><a href="/my-groups/search-group.php?txtSearch=&group=<?= $_GET['group'] ?? "all"?>">Clear</a></button>
                <?php } ?>
            </div>
        <?php if($searchFilterEnabled == false) { ?>
            </form>
        <?php } ?>

        <?php if($searchFilterEnabled == false) { ?> 
        <form id="groupForm2" method="get" action="<?php echo $BaseUrl; ?>/my-groups/">
        <?php } ?>
            <div class="group-filers">
                <span>
                    <input type="radio" id="all" name="group" value="all" <?php if ((isset($_GET['group']) && $_GET['group'] == 'all') || (!isset($_GET['group']) && $searchFilterEnabled == false )) echo 'checked'; ?>>
                    <label for="all" class="radio-label">All</label>
                </span>

                <span>
                    <input type="radio" id="public" name="group" value="public" <?php if (isset($_GET['group']) && $_GET['group'] == 'public') echo 'checked'; ?>>
                    <label for="public" class="radio-label">Public Groups</label>
                </span>

                <span>
                    <input type="radio" id="private" name="group" value="private" <?php if (isset($_GET['group']) && $_GET['group'] == 'private') echo 'checked'; ?>>
                    <label for="private" class="radio-label">Private Group</label>
                </span>
            </div>
        <?php if($searchFilterEnabled == false) { ?> 
        </form>
        <?php } ?>

        <?php if($_SESSION['ptid'] != 5) { ?>
            <div class="add-group-btn" data-bs-toggle="modal" data-bs-target="#add-group">
                <?php if (empty($_SESSION['guet_yes']) || (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] != 'yes')) { ?>
                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.625" y="0.25" width="16.5" height="16.5" rx="8.25" fill="white" />
                        <path d="M8.87428 13.5769V8.49996M8.87428 8.49996V3.42303M8.87428 8.49996L13.9204 8.49996M8.87428 8.49996H3.82812" stroke="#FB8308" stroke-width="2.25" stroke-linecap="round" />
                    </svg>
                    ADD GROUP
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php if($searchFilterEnabled == true) { ?>
</form>
<?php } ?>

<?php  
function groupDiv($row, $gimage, $flag = false){ 
    $pr = new _spprofiles;
    $g = new _spgroup;    
?>
    <div class="group">
        <span class="privacy_icon">            	
            <?php if($row['status'] == "draft"){ ?>
                <b>Draft</b> <img src="/assets/images/icon/edit.png" title="Draft" alt="Draft">
            <?php }elseif($flag){ ?>
                <b>Live</b>
            <?php } ?>
            <img src="<?php echo $row['spgroupflag'] == 1 ? '/grouptimelines/images/lock.svg' : '/grouptimelines/images/global.svg'; ?>" alt="">
        </span>
        <div class="img-wrapper">
            <?php
            if ($gimage == "") { ?>
                <img width="271" height="181" src="<?= $pr->random_image() ?>" alt="" />
            <?php } else { ?>
                <img width="271" height="181" src="<?php echo BASE_URL; ?>/uploadimage/<?php echo $gimage; ?>" alt="" />
            <?php } ?>
        </div>
        <div class="detail-wrapper">
            <div class="name">
                <?php echo substr(ucwords(strtolower($row['spGroupName'])), 0, 20); if(strlen($row['spGroupName']) > 20) { echo '...';} ?>
            </div>
            <div class="type">
                <img width="15px" src="../grouptimelines/images/users.svg" alt="">&nbsp;
                <span><?php echo ($row['spgroupflag'] == 1) ? 'Private Group' : 'Public Group'; ?></span>
            </div>
            <div class="type">
                <img width="15px" src="../grouptimelines/images/events.svg" alt="">&nbsp;
                <span><?php echo $row['CreatedDate'] ?></span>
            </div>
            <div class="members">
                <?php
                //count member old and new
                $result3 = $g->joinedMembersOfGroup($row['idspGroup']);
                $total_member = mysqli_num_rows($result3);
                ?>
                <div class="total">Total(<?php echo $total_member; ?>)</div>
                <div class="mutual">Mutual (<?= $g->countMutualMemberGroup($row['idspGroup'], $_SESSION['pid']) ?>)</div>
            </div>
        </div>
        <div class="join-group-wrapper">
            <?php 
            $isMember = $g->ismember($row['idspGroup'], $_SESSION['pid']);
            $invited = $g->isMemberInvited($row['idspGroup'], $_SESSION['pid']);
            $isAllowd = ($isMember != false || $invited != false) ? true : false;
            $buttonText = ($isMember) ? 'Open' : "Open";
            if($row['spgroupflag'] == 1 && $isAllowd == false) { ?>
                <a href="<?php echo BASE_URL; ?>/friends/?profileid=<?= $row['spProfiles_idspProfiles'] ?>"><button>Contact Admin</button></a>
            <?php }else{ ?>  
                <a href="<?php echo BASE_URL; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup']; ?>&groupname=<?php echo $row['spGroupName']; ?>&timeline&page=1"><button><?= $buttonText ?></button></a>
            <?php } ?>
            &nbsp;
            <?php if($flag == true && $row['status'] == "draft"){ ?>
                <a href="javascript:;void(0);" onclick='publishGroup("<?= $row["idspGroup"] ?>")'><button>Publish</button></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div class="group-navigation" id="group-specific">
    <?php if($searchFilterEnabled == true) { ?>
        <div class="link border-0 <?php if($searchFilterEnabled == true) { echo "active-link"; } ?>">Searched Group</div>
    <?php } ?>
    <div class="link border-0 <?php if($searchFilterEnabled == false) { echo "active-link"; } ?>">My Groups</div>
    <div class="link border-0">Pending Requests</div>
    <div class="link border-0">Suggested Groups</div>
    <div class="link border-0">Joined Groups</div>
    <div class="link border-0">Friends Group</div>
</div>
<style>
    .group-navigation2{
        margin-top: 10px;
        width: 100%;
        height: 40px;
        border: 1.5px solid #3E2048;
        font-size: 14px;
        color: #3E2048 !important;
        background: #3E2048;
    }
</style>
<div class="group-navigation2" id="group-specific">
    <?php if($searchFilterEnabled == true) { ?>
        <form id="groupForm3" method="get" action="<?php echo $BaseUrl; ?>/my-groups/search-group.php">
    <?php } else{ ?>
        <form id="groupForm3" method="get" action="<?php echo $BaseUrl; ?>/my-groups/">
    <?php } ?>
        <div class="border-0" style="line-height: 40px;padding: 0px 5px;float:right;color:#fff;"> 
            <select onchange="$('#groupForm3').submit();" name="status" style="color:#000">
                <option <?php if (isset($_GET['status']) && $_GET['status'] == 'all') echo 'selected'; ?> value="all">All</option>
                <option <?php if (isset($_GET['status']) && $_GET['status'] == 'active') echo 'selected'; ?> value="active">Live</option>
                <option <?php if (isset($_GET['status']) && $_GET['status'] == 'draft') echo 'selected'; ?> value="draft">Draft</option>
            </select>
        </div>
        <div class="border-0" style="line-height: 40px;padding: 0px 0px;float:right;color:#fff;">Filter By
            <select onchange="$('#groupForm3').submit();" name="group" style="color:#000">
                <option <?php if (isset($_GET['group']) && $_GET['group'] == 'all') echo 'selected'; ?> value="all">All</option>
                <option <?php if (isset($_GET['group']) && $_GET['group'] == 'public') echo 'selected'; ?> value="public">Public</option>
                <option <?php if (isset($_GET['group']) && $_GET['group'] == 'private') echo 'selected'; ?> value="private">Private</option>
            </select>            
        </div>
        <input type="hidden" name="txtSearch" value="<?= $_GET['txtSearch'] ?? "" ?>">
    </form>
</div>

<?php if($searchFilterEnabled == true) { ?>
<!-- search groups  -->
<div id="searchedgroup" class="group-list-wrapper">
    <?php
        $g = new _spgroup;
        $userAddress = $userAddress ?? "";
        if ($_GET['txtSearch'] != "" && $_GET['group'] == "all") {
            $txtTitle   = $_GET['txtSearch'];
            $spgroupStatus = $_GET['group'];
            $result = $g->groupmember_title($txtTitle, $userAddress, $spgroupStatus);
        } else if ($_GET['group'] != "all" && $_GET['txtSearch'] == "") {
            $txtStatus   = $_GET['group'];
            $result = $g->groupmember_status($txtStatus);
        } else if ($_GET['group'] == "all") {
            $result = $g->readAll_groupmember($groupStatus2);
        } else if ($_GET['group'] != "all" && $_GET['txtSearch'] != "") {
            $status = $_GET['group'];
            $title = $_GET['txtSearch'];
            $result = $g->groupmember_status_1($status, $title);
        } else {
            $result = $g->readAll_groupmember($groupStatus2);
        }

        if ($result != false) {
            $bg_clr = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($bg_clr == 1) {
                    $bg_clr_box = "bg_black";
                } else if ($bg_clr == 2) {
                    $bg_clr_box = "bg_green_dark";
                } else if ($bg_clr == 3) {
                    $bg_clr_box = "bg_pink_dark";
                } else if ($bg_clr == 4) {
                    $bg_clr_box = "bg_red_dark";
                } else if ($bg_clr == 5) {
                    $bg_clr_box = "bg_color_2";
                } else if ($bg_clr == 6) {
                    $bg_clr_box = "bg_color_1";
                }

                //GET GROP BANNER, GROP DESCRIPTION 
                $result2 = $g->groupdetailspublic($row['idspGroup']);
                if ($result2 != false) {
                    $row2 = mysqli_fetch_assoc($result2);
                    $gname = $row2["spGroupName"];
                    $gtag = $row2["spGroupTag"];
                    $gdes = $row2["spGroupAbout"];
                    $gtype = $row2["spgroupflag"];
                    $gcategory = $row2["spgroupCategory"];
                    $glocation = $row2["spgroupLocation"];
                    $gimage = $row2["spgroupimage"];
                }

                //GET ADMIN  NAME OR IMAGE\
                $rpvt = $g->members($row['idspGroup']);
                if ($rpvt != false) {
                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                        if ($row3['spUser_idspUser'] != NULL) {
                            $st = new _spuser;
                            $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                            if ($st1 != false) {
                                $stt = mysqli_fetch_assoc($st1);
                                $account_status = $stt['deactivate_status'];
                            }
                        }
                        if ($row3['spProfileIsAdmin'] == 0) {
                            $spProfilePic = $row3['spProfilePic'];
                            $Group_Admin_Name = $row3['spProfileName'];
                        }
                    }
                }

                if (isset($account_status) && $account_status != 1) {
                    echo groupDiv($row, $gimage);
                }
                if ($bg_clr < 6) {
                    $bg_clr++;
                } else {
                    $bg_clr = 1;
                }
            }
        } else {
            if (isset($txtTitle)) { ?>
                <div style='padding: 20px 0px 0px 8px;font-size: 16px;color:#000;'>
                    <h3>Search results for "<?php echo $txtTitle; ?>" not found.</h3>
                </div>
            <?php } elseif (isset($txtCategory)) { ?>
                <div style='padding: 20px 0px 0px 8px;font-size: 16px;color:#000;'>
                    <h3>Search results for "<?php echo $txtCategory; ?>" not found.</h3>
                </div>
            <?php } else { ?>
                <div style='padding: 20px 0px 0px 8px;font-size: 16px;color:#000;'>
                    <h3>Search results not found.</h3>
                </div>
            <?php  }
        ?>
    <?php } ?>
    <!--  </div> -->
    <div class="space"></div>
    <div class="space-md"></div>
    <div id="pagination-container"></div>
</div> 
<?php } ?>

<!-- all groups  -->
<div id="mygroup" class="group-list-wrapper <?php if($searchFilterEnabled == true) { echo "d-none"; } ?>">
    <?php
        $g = new _spgroup;
        $result = $g->profilegroupmember($_SESSION['pid'], $txtSearch, $groupStatus, $groupStatus2);
        $account_status  = $bg_clr = null;
        if ($result != false) {
            $bg_clr = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($bg_clr == 1) {
                    $bg_clr_box = "bg_black";
                } else if ($bg_clr == 2) {
                    $bg_clr_box = "bg_green_dark";
                } else if ($bg_clr == 3) {
                    $bg_clr_box = "bg_pink_dark";
                } else if ($bg_clr == 4) {
                    $bg_clr_box = "bg_red_dark";
                } else if ($bg_clr == 5) {
                    $bg_clr_box = "bg_color_2";
                } else if ($bg_clr == 6) {
                    $bg_clr_box = "bg_color_1";
                }
                $gdes = $row["spGroupAbout"] ?? '';
                $result2 = $g->groupdetailspublicprivate($row['idspGroup']);
                $baneer_iamge = $g->read_bannerimage($row['idspGroup']);
                $baneer_iamge_row = mysqli_fetch_assoc($baneer_iamge);
                $gimage = $baneer_iamge_row['spgroupimage'];

                if ($result2 != false) {
                    $row2 = mysqli_fetch_assoc($result2);
                    $gname = $row2["spGroupName"];
                    $gtag = $row2["spGroupTag"];
                    $gdes = $row2["spGroupAbout"];
                    $gtype = $row2["spgroupflag"];
                    $gcategory = $row2["spgroupCategory"];
                    $glocation = $row2["spgroupLocation"];
                }
                //GET ADMIN  NAME OR IMAGE
                $img = new _spprofiles;
                $rpvt = $img->read_img($_SESSION['pid']); 
                
                if ($rpvt != false) {
                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                        if ($row3['spUser_idspUser'] != NULL) {
                            $st = new _spuser;
                            $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                            if ($st1 != false) {
                                $stt = mysqli_fetch_assoc($st1);
                                $account_status = $stt['deactivate_status'];
                            }
                        }

                        $spProfilePic = $row3['spProfilePic'];
                        $Group_Admin_Name = $row3['spProfileName'];
                    }
                }

                if ($account_status != 1) {
                    echo groupDiv($row, $gimage, true);
                }
            }
        }else{
            echo "<h3>No Groups Found.</h3>";
        }
    ?>
</div>

<!-- all pending  -->
<div id="pendinggroup" class="group-list-wrapper d-none">
    <?php                                 
        $g = new _spgroup;
        $result = $g->readpendingrequest($_SESSION['pid'], 'invitation', $txtSearch, $groupStatus, $groupStatus2);
        if ($result != false) {
            $bg_clr = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                //-- unclear purpose - ganesh
                if ($row['spProfiles_idspProfiles'] != NULL) {
                    $st = new _spuser;
                    $st1 = $st->readdatabybuyerid($row['spProfiles_idspProfiles']);
                    if ($st1 != false) {
                        $stt = mysqli_fetch_assoc($st1);
                        $account_status = $stt['deactivate_status'];
                    }
                }

                //-- unclear purpose - ganesh
                $id = $row['id'];
                //grpimage
                if ($bg_clr == 1) {
                    $bg_clr_box = "bg_black";
                } else if ($bg_clr == 2) {
                    $bg_clr_box = "bg_green_dark";
                } else if ($bg_clr == 3) {
                    $bg_clr_box = "bg_pink_dark";
                } else if ($bg_clr == 4) {
                    $bg_clr_box = "bg_red_dark";
                } else if ($bg_clr == 5) {
                    $bg_clr_box = "bg_color_2";
                } else if ($bg_clr == 6) {
                    $bg_clr_box = "bg_color_1";
                }

                $gimage = $row['spgroupimage'] ?? ""; 
                $rpvt = $g->members($row['idspGroup']);
                if ($rpvt != false) {
                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                        if ($row3['spProfileIsAdmin'] == 0) {
                            $spProfilePic = $row3['spProfilePic'];
                            $Group_Admin_Name = $row3['spProfileName'];
                        }
                        if ($row3['spgroupstatus'] == 0) {
                            if ($account_status != 1) {
                            } // if end
                        } // row3 end
                    } //while end
                } // rpvt end 


                echo groupDiv($row, $gimage);
            } //top while row end
        }else{
            echo "<h3>No Pending Request Found.</h3>";
        }
                                            
        if ($bg_clr < 6) {
            $bg_clr++;
        } else {
            $bg_clr = 1;
        }
    ?>                                  
</div>

<!-- all suggested  -->
<div id="suggestedgroup" class="group-list-wrapper d-none">
    <?php
    $g = new _spgroup;
    $intr = new _groupsponsor;
    $data = $intr->get_id($_SESSION["pid"]);
    $aa = [];

    if ($data != false) {
        while ($row = mysqli_fetch_assoc($data)) {
            $aa[] = $row['intrest_id'];
        }
    }

    $suggest = $g->suggest_group($_SESSION["pid"], $aa, $txtSearch, $groupStatus, $groupStatus2);
    $count = $suggest->num_rows ?? 0;
    if ($suggest != false) {
        while ($row2 = mysqli_fetch_assoc($suggest)) {
            $gname = $row2["spGroupName"];
            $gtag = $row2["spGroupTag"];
            $gdes = $row2["spGroupAbout"];
            $gtype = $row2["spgroupflag"];
            $gcategory = $row2["spgroupCategory"];
            $glocation = $row2["spgroupLocation"];
            $gimage = $row2["spgroupimage"];
            $sp_group = $row2['idspGroup'];
            $sp_images = "";
            $kk = new _spgroup;
            $rshow = $kk->skk_gg($sp_group);
            if ($rshow) {
                $ressult11 = mysqli_fetch_assoc($rshow);
                $pidd = $ressult11['spProfiles_idspProfiles'];
                $mhk = $kk->smmkk($pidd);
                if ($mhk != false) {
                    $result33 = mysqli_fetch_assoc($mhk);
                    $sp_images = $result33['spProfilePic'];
                }
            }
            
            echo groupDiv($row2, $gimage);
        }
    }else{
        echo "<h3>No Groups Found.</h3>";
    }
    ?>
</div>

<!-- joined group -->
<div id="joinedgroup" class="group-list-wrapper d-none">
    <?php
    $g = new _spgroup;
    $result = $g->joingroupmemberall($_SESSION['pid'], $txtSearch, $groupStatus, $groupStatus2);
    $count = $result->num->rows ?? 0;

    if ($result != false) {
        $bg_clr = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($bg_clr == 1) {
                $bg_clr_box = "bg_black";
            } else if ($bg_clr == 2) {
                $bg_clr_box = "bg_green_dark";
            } else if ($bg_clr == 3) {
                $bg_clr_box = "bg_pink_dark";
            } else if ($bg_clr == 4) {
                $bg_clr_box = "bg_red_dark";
            } else if ($bg_clr == 5) {
                $bg_clr_box = "bg_color_2";
            } else if ($bg_clr == 6) {
                $bg_clr_box = "bg_color_1";
            }
            $result2 = $g->groupdetailspublicprivate($row['idspGroup']);
            if ($result2 != false) {
                $row2 = mysqli_fetch_assoc($result2);
                $gname = $row2["spGroupName"];
                $gtag = $row2["spGroupTag"];
                $gdes = $row2["spGroupAbout"];
                $gtype = $row2["spgroupflag"];
                $gcategory = $row2["spgroupCategory"];
                $glocation = $row2["spgroupLocation"];
            }
            $rpvt = $g->members($row['idspGroup']);

            if ($rpvt != false) {
                while ($row3 = mysqli_fetch_assoc($rpvt)) {
                    if ($row3['spUser_idspUser'] != NULL) {
                        $st = new _spuser;
                        $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                        if ($st1 != false) {
                            $stt = mysqli_fetch_assoc($st1);
                            $account_status = $stt['deactivate_status'];
                        }
                    }
                    if ($row3['spProfileIsAdmin'] == 0) {
                        $spProfilePic = $row3['spProfilePic'];
                        $Group_Admin_Name = $row3['spProfileName'];
                    }
                }
            }

            if ($account_status != 1) {
                if ($row['spgroupstatus'] == 0) {
                    $gimage = $row["spgroupimage"] ?? "";
                }
                
                echo groupDiv($row, $gimage);
            }
            if ($bg_clr < 6) {
                $bg_clr++;
            } else {
                $bg_clr = 1;
            }
            /*  }*/
        }
    }
    else{
        echo "<h3>No Groups Found.</h3>";
    }
    ?>
</div>

<div id="friendsgroup" class="group-list-wrapper d-none">
    <?php
    $r = new _spprofilehasprofile;
    $res = $r->readallfriend($_SESSION["pid"]);
    $res2 = $r->readallfriendWithReverse($_SESSION["pid"]);
    $showMessage1 = false;
    $showMessage2 = false;
    if ($res != false || $res2 != false) {
        if($res != false){
            while ($rows = mysqli_fetch_assoc($res)) {
                $g = new _spgroup;
                $result = $g->profilegroupmember_d($rows['spProfiles_idspProfilesReceiver'], $txtSearch, $groupStatus, $groupStatus2);
                if ($result != false) {
                    $showMessage1 = true;
                    $bg_clr = 1;
                    while ($row5 = mysqli_fetch_assoc($result)) {
                        $r = new _spprofilehasprofile;
                        $result6 = $g->groupmember($_SESSION['uid']);
                        if ($result6 != false) {
                            $i = 0;
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                if ($row5['idspGroup'] == $row6['idspGroup']) {
                                    $i++;
                                }
                            }
                        }
                        $result2 = $g->groupdetails($row5['idspGroup']);
                        $gimage = "";
                        if ($result2 != false) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $gdes = $row2["spGroupAbout"];
                            $gimage = $row2["spgroupimage"];
                        }
                        //GET ADMIN  NAME OR IMAGE
                        $rpvt = $g->members($row5['idspGroup']);
                        if ($rpvt != false) {
                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                if ($row3['spUser_idspUser'] != NULL) {
                                    $st = new _spuser;
                                    $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                    if ($st1 != false) {
                                        $stt = mysqli_fetch_assoc($st1);
                                        $account_status = $stt['deactivate_status'];
                                    }
                                }
                                if ($row3['spProfileIsAdmin'] == 0) {
                                    $spProfilePic = $row3['spProfilePic'];
                                    $Group_Admin_Name = $row3['spProfileName'];
                                }
                            }
                        }
                        if (isset($account_status) && $account_status != 1) {
                            echo groupDiv($row5, $gimage);
                        }
                    }
                }
            }
        }

        if($res2 != false){
            while ($rows = mysqli_fetch_assoc($res2)) {
                $g = new _spgroup;
                $result = $g->profilegroupmember_d($rows['spProfiles_idspProfileSender'], $txtSearch, $groupStatus, $groupStatus2);
                if ($result != false) {
                    $bg_clr = 1;
                    $showMessage2 = true;
                    while ($row5 = mysqli_fetch_assoc($result)) {
                        $r = new _spprofilehasprofile;
                        $result6 = $g->groupmember($_SESSION['uid']);
                        if ($result6 != false) {
                            $i = 0;
                            while ($row6 = mysqli_fetch_assoc($result6)) {

                                if ($row5['idspGroup'] == $row6['idspGroup']) {
                                    $i++;
                                }
                            }
                        }
                        $result2 = $g->groupdetails($row5['idspGroup']);
                        $gimage = "";
                        if ($result2 != false) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $gdes = $row2["spGroupAbout"];
                            $gimage = $row2["spgroupimage"];
                        }
                        //GET ADMIN  NAME OR IMAGE
                        $rpvt = $g->members($row5['idspGroup']);
                        if ($rpvt != false) {
                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                if ($row3['spUser_idspUser'] != NULL) {
                                    $st = new _spuser;
                                    $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                    if ($st1 != false) {
                                        $stt = mysqli_fetch_assoc($st1);
                                        $account_status = $stt['deactivate_status'];
                                    }
                                }
                                if ($row3['spProfileIsAdmin'] == 0) {
                                    $spProfilePic = $row3['spProfilePic'];
                                    $Group_Admin_Name = $row3['spProfileName'];
                                }
                            }
                        }
                        if ($account_status != 1) {
                            echo groupDiv($row5, $gimage);
                        }
                    }
                }
            }
        }
    }
    
    if($showMessage1 == false && $showMessage2 == false){
        echo "<h3>No Groups Found.</h3>";
    }
    ?>
</div>

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
                    toastr.success(res.message);
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