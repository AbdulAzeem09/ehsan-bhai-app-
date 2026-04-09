<!--  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/csactionbtn forths/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;
                                                //die('---------------');

                                                ?>/assets/css/font_animate.css"> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

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
<div class="post" style="font-weight:bold;">
    <?php
    //echo 1111;
    /*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


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
    $pfd = $p2->getrecord($_GET["timelineid"]);

    if ($pfd != false) {
        while ($row111 = mysqli_fetch_assoc($pfd)) {
            /*    print_r($grouptimelines);*/
            /* print_r($_GET["timelineid"]);*/

            /*print_r($proid);
print_r($sharedesc);*/


            //if (isset($grouptimelines) && $grouptimelines == 1) 
            if ($row111['spPostingVisibility'] == -1) {

                $res2 = $p2->singletimelinespost($_GET["timelineid"]);

                //$res2 = $p2->allgrouptimelines($_GET["timelineid"]);

                //
                /*echo $p2->ta->sql;*/
                /* $res2 = $p2->allgrouptimelinesPost($_GET["groupid"]);*/
                //$res2 = $p2->singletimelinespost($_GET["timelineid"]);
                //echo "here1";

            } else {
                //$res2 = $p2->allgrouptimelinesPost($_GET["timelineid"]);  
                $res2 = $p2->singletimelinespost($_GET["timelineid"]);
                //			$res2 = $p2->singletimelinespost($_GET["timelineid"]);

                /*echo "here2";*/
            }
        }
    }
    //echo $p2->ta->sql;
    ?>

    <?php

    //echo $p2->ta->sql;
    if ($res2 != false)
        while ($rows = mysqli_fetch_assoc($res2)) {
            //print_r($rows);
            $postingid = $rows['spPostings_idspPostings'];

            $np = new _postings;
            $rec = $np->readposting($postingid);
            $spnum = $rec->num_rows;
            if ($spnum == 9) {
                $poststatus = $np->flagposts($postingid);
            }
            $sql35 = "SELECT * FROM share WHERE  timelineid = " . $rows['idspPostings'];
            /*echo $sql3;*/
            $res35 = mysqli_query($conn, $sql35);
            if ($res35 != false) {
                $row35  = mysqli_fetch_assoc($res35);

                /*print_r($row35);*/

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



        <div class=" post_timeline post_timeline_all_post searchable deldiv_<?php echo $rows['idspPostings']; ?>">
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
                                <h5 id="posttimeago<?php echo $rows["idspPostings"]; ?> 44"><?php echo $postingDate3; ?> <i class="fa fa-globe"></i></h5>
                            </div>
                        <?php
                        }
                    } else {

                        $prof = new _spprofiles;
                        $result32 = $prof->readUserId($rows["spProfiles_idspProfiles"]);

                        if ($result32 != false) {
                            $row32 = mysqli_fetch_assoc($result32);
                            $picture = $row32["spProfilePic"];
                            $profilename = $row32["spProfileName"];
                            $postingDate = $p2->spPostingDate($rows["spPostingDate"]);



                        ?>
                            <div class="left_profile_timeline">
                                <?php


                                if (isset($picture)) {
                                    echo "<img alt='profilepic '  class='img-circle' style='width:38px!important;height:38px!important;margin-top:10px' src='" . ($picture) . "'>";
                                } else {
                                    echo "<img alt='profilepic'  class='' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' style='width:38px!important;height:38px!important'  >";
                                }
                                ?>
                            </div>
                            <div class="title_profile">
                                <h4 style="margin-top:0;"><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['spProfiles_idspProfiles']; ?>">
                                        <?php echo ucwords(strtolower($profilename)); ?>
                                        <?php
                                        if (isset($rows['spGroupName']) &&  !empty($rows['spGroupName'])) {

                                        ?>
                                            <!-- <span style="font-size: 14px;">(<?php echo $rows['spGroupName']; ?>)</span> -->
                                        <?php
                                        }
                                        ?>

                                    </a>
                                    <img src="../assets/images/inner_group/like-svg.svg" alt="thumbs up" style="margin-top: 20px; margin-left:20px" />
                                </h4>
                                <h5 style="margin-left:55px!important;margin-top:-10px" id="posttimeago<?php echo $rows["idspPostings"]; ?>"><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
                            </div> <?php
                                }
                            }

                                    ?>


                </div>
                <div class="col-md-4">


                    <div class="dropdown pull-right right_profile_timeline">
                        <?php

                        $con = mysqli_connect(DBHOST, UNAME, PASS);

                        if (!$con) {
                            die('Not Connected To Server');
                        }

                        if (!mysqli_select_db($con, DBNAME)) {
                            echo 'Database Not Selected';
                        }

                        $query = mysqli_query($con, "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='" . $rows['idspPostings'] . "' AND spProfile_idspProfile='" . $_SESSION['pid'] . "'");

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



                                                <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <input type="hidden" name="userid" value="<?php echo $_SESSION['uid']; ?>">
                                                <input type="hidden" name="flagpostprofileid" value="<?php echo $rows['idspProfiles']; ?>">
                                                <input type="hidden" name="flagpostuserid" value="<?php echo $rows['spUser_idspUser']; ?>">
                                                <input type="hidden" name="spPosting_idspPosting" value="<?php echo $rows['idspPostings']; ?>">


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
                                            <button type="button" class="btn btn_gray db_btn db_orangebtn" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn_blue db_btn db_primarybtn" onclick="flagpost(<?php echo $rows['idspPostings']; ?>);" name="btnReport" id="flagtimelinepost">Submit</button>
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



                        <button class="btn dropdown-toggle 4444445555566" type="button" data-toggle="dropdown"><img aria-hidden="true" src="../assets/images/dot-2.svg" /></button>
                        <ul class="dropdown-menu">
                            <?php
                            if (isset($_SESSION['pid'])) {
                                $sp = new _savepost;
                                $result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
                                if ($result2) {
                                    if ($result2->num_rows > 0) { ?>

                                        <li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a onclick="myUnsave('<?php echo $rows['idspPostings']; ?>')"><img src="../assets/images/inner_group/save.svg" style="margin-right: 10px;" />Unsave Post</a></li>

                                        <li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"></li>
                                    <?php
                                    } else { ?>
                                        <li><a href="<?php echo $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings']; ?>"><img src="../assets/images/inner_group/save.svg" style="margin-right: 10px;" />Save Post33</a></li> <?php
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                    } else { ?>


                                    <li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a class="profile_section" onclick="myFun('<?php echo $rows['idspPostings']; ?>')"><img src="../assets/images/inner_group/save.svg" style="margin-right: 10px;" />Save Post</a></li>


                                <?php
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                } else { ?>
                                <li style="cursor: pointer;" id="savefun<?php echo $rows['idspPostings'];  ?>"><a class="profile_section" onclick="myFun('<?php echo $rows['idspPostings']; ?>')"><img src="../assets/images/inner_group/save.svg" style="margin-right: 10px;" />Save Post</a></li> <?php
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) { ?>
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings']; ?>" class="sendPostidEdit"><img src="../assets/images/inner_group/edit-3.svg" style="margin-right: 10px;" aria-hidden="true" /> Edit Post</a></li> <?php
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                    ?>


                            <?php
                            if (isset($_SESSION['uid'])) {
                                $pr = new _spprofiles;
                                $pres = $pr->checkprofile($_SESSION['uid'], $rows['spProfiles_idspProfiles']);
                                if ($pres != false) {
                            ?>




                                <?php

                                }
                            } else {
                                $groupId = isset($rows['groupid']) ? $rows['groupid'] : 0;
                                $groupName = isset($rows['spGroupName']) ? $rows['spGroupName'] : '';
                                echo "<li><a onclick=\"deletePost(" . $rows['idspPostings'] . "," . $groupId . ",'" . $groupName . "')\"'" . $rows['idspPostings'] . "&flag=1' style='cursor:pointer;' ><img src='../assets/images/inner_group/delete.svg' style='margin-right:10px' /> Delete Post</a></li>";
                                echo "<li><a href='javascript:void(0)' data-toggle='modal' data-target='#myPostEdit' data-postid='" . $rows['idspPostings'] . "' class='sendPostidEdit'><img src='../assets/images/inner_group/edit-3.svg' style='margin-right: 10px;' aria-hidden='true'/>  Edit Post</a></li>";
                            }
                            //hide post from timeline
                            if ($_SESSION['pid'] != $rows['spProfiles_idspProfiles']) {
                                echo "<li><a href='" . $BaseUrl . "/post-ad/hidePost.php?postid=" . $rows['idspPostings'] . "&flag=1' ><i class='fa fa-minus-square-o' style=' color: #FB8308;font-size: 20px;margin-right: 12px;'></i> Hide Post</a></li>";
                            }
                            if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) {
                                ?>

                                <li><a style="cursor:pointer;" onclick="deletePost(<?php echo $rows['idspPostings'] ?>);"><img src='../assets/images/inner_group/delete.svg' style='margin-right:10px' /> Delete Post55</a></li>
                            <?php
                            }
                            ?>

                            <?php if (mysqli_num_rows($query) > 0) { ?>

                                <li>
                                    <a>

                                        <i class="fa fa-flag danger" style="margin-left: 3px; margin-right:10px;color: #FB8308;  " data-toggle="tooltip" data-placement="top" title="Post Flaged" id="unflag<?php echo $rows['idspPostings']; ?>"> <span style="margin-left: 10px; color:black">Flage</span>
                                        </i>

                                    </a>
                                </li>
                            <?php } else { ?>

                                
                                <?php if ($_SESSION['pid'] == $rows['spProfiles_idspProfiles']) { ?>
                                    <li>
                                        <a>
                                            <i class="fa fa-flag" id="flag<?php echo $rows['idspPostings']; ?>" data-toggle="tooltip" data-placement="top" title="You Cannot Flag This Post!" disable> <span style="margin-left: 10px; color:black"> Flage </span>
                                            </i>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a>
                                            <i class="fa fa-flag" style="margin-left: 3px; margin-right:10px;color: #FB8308;  " id="flag<?php echo $rows['idspPostings']; ?>" data-placement="top" title="Flag Post" data-toggle="modal" data-target="#myModal<?php echo $rows['idspPostings']; ?>"> <span style="margin-left: 10px; color:black"> Flage</span>
                                            </i>

                                        </a>
                                    </li>
                            <?php

                                }
                            }
                            $query1 = mysqli_query($con, "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='" . $rows['idspPostings'] . "'");
                            $flaged_count = mysqli_num_rows($query1);
                            /*print_r($flaged_count);*/
    
                            if ($flaged_count > 0) {
                                echo "($flaged_count)";
                            }
                            ?>

                        </ul>

                    </div>
                </div>

                <div class="col-md-12 ">
                    <h2 style="word-wrap: break-word;">
                        <?php
                        ?>


                        <?php

                        if (!empty($rows['sharetype'])) {


                            echo "<p>" . $sharedesc . "</p>";
                        } else {
                            echo $text = $p2->turnUrlIntoHyperlink($rows['spPostingNotes']);
                        }

                        ?>
                    </h2>
                    <?php





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

                                echo "<div class='timlinepicture text-center'>";
                                echo "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 50%;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
                                echo "</div>";
                            }
                        }
                    } else {
                        $pict = NULL;
                    }


                    $media = new _postingalbum;
                    $result = $media->read($rows['idspPostings']);


                    if ($result != false) {
                        while ($r = mysqli_fetch_assoc($result)) {

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
                            } else if ($sppostingmediaExt == 'mp4' || $sppostingmediaExt == 'webm') {
                            ?>

                                <div style='margin-left:15px;margin-right:15px;'>
                                    <video 2222 style='max-height:300px;width: 100%;border-radius: 17px;90879' controls>
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
                                        <a href="<?php echo $sppostingmediaTitle; ?>" target="_blank" download>Preview</a>




                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } else {
                    } ?>

                </div>

                <div>
                    <?php $c = new _comment;  ?>

                    <div id="comments_<?php echo $rows['idspPostings']; ?>">


                        <div class="timelinecmnt_<?php echo $rows['idspPostings']; ?>">


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
                                    } ?>

                                    <!-- <div class="col-md-12">
                                        <?php
                                        echo "<a class='float-right'  href='../publicpost/post_comment_details.php?postid=" . $rows['idspPostings'] . "' ><span class='morecomment' data-postid='" . $rows['idspPostings'] . "' >View all comments <span class='tltcmt'>(" . $totalcmt . ")</span></span></a>";
                                        ?>
                                    </div> -->

                                <?php
                                }
                                ?>


                            </div>
                        </div>




                        <?php //} 
                        ?>
                    </div>

                </div>

                <div class="col-md-12 px-0">

                    <div class="post_footer">
                        <ul>


                            <?php
                            $rection =  "&#128077;&#127995;";
                            $like = "0";
                            $pl = new _postlike;
                            $r = $pl->likeread($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);



                            $react_count =  $r->num_rows;


                            $count = 0;
                            if ($r->num_rows == "") {
                                $rection =  "&#128077;&#127995;";
                                $count_react = 0;
                            } else {
                                $count_react = 1;

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

                            ?>


                            <li class="like_btn">

                                <nav class="nav">
                                    <ul>
                                        <input type="hidden" id="usid" value="<?php echo $_SESSION['uid']; ?>">
                                        <input type="hidden" id="prid" value="<?php echo $_SESSION['pid']; ?>">
                                        <li>

                                            <?php if ($r->num_rows == '') {

                                            ?>


                                                <div style="margin-left:-40px" id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" style="font-size: 25px!important;margin-top: -5px;" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn 1111" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7"><?php echo $rection; ?></a> </div>


                                            <?php  } ?>


                                            <?php if ($r->num_rows == '1') { ?>
                                                <div id="new_data_<?php echo $rows['idspPostings'];  ?>"> <a onclick="mfunction(this)" id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);" class="reactionbtn_remove " data-postid="<?= $rows['idspPostings']; ?>" style="font-size: 25px;margin-top: -5px;"><?php echo $rection; ?></a> </div>
                                            <?php  } ?>



                                            <ul class="">

                                                <li 11 value="7" class="reactionbtn 11" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7">&#128077;</li>

                                                <li value="1" class="reactionbtn" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="1">&#128525;</li>
                                                <li value="2" class="reactionbtn" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="2">&#128512;</li>
                                                <li value="3" class="reactionbtn thrd" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="3">&#128546;</li>
                                                <li value="4" class="reactionbtn forth" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="4">&#129315;</li>
                                                <li value="5" class="reactionbtn" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="5">&#128563;</li>
                                                <li value="6" class="reactionbtn" onclick="myfunction(this)" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="6">&#128545;</li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </li>
                            <li>
                                <a class="rcount" onclick="getreacion()" style="margin-right: 47px;" id='rcount' data-postidr="<?= $rows['idspPostings']; ?>" data-toggle="modal" data-target="#myModal">
                                    <?php $read_like_cont = $c->read_like($rows['idspPostings']);

                                    if ($read_like_cont->num_rows == "") {
                                        echo "<span style='font-size:15px;margin-right: 131px;margin-top: 5px !important; margin-left:-15px!important' id='cuer" . $rows['idspPostings'] . "'>(0)</span>";
                                    } else {
                                        echo "<span style='font-size:15px;margin-right: 131px;margin-top: 5px !important; margin-left:-15px!important' id='cuer" . $rows['idspPostings'] . "'>(" . $read_like_cont->num_rows . ")</span>";
                                    }

                                    ?> </a>
                            </li>

                            <script>
                                function getreacion() {

                                    const element = document.getElementById("rcount");
                                    let text = element.getAttribute("data-postidr");


                                    var postidr = text;

                                    $.ajax({
                                        url: "../social/getReaction.php",
                                        type: "POST",
                                        data: {
                                            spPostings_idspPostings: postidr
                                        },
                                        success: function(response) {

                                            $('#top_reaction').html(response);
                                        },

                                    });
                                    $.ajax({
                                        url: "../social/getReaction1.php",
                                        type: "POST",
                                        data: {
                                            spPostings_idspPostings: postidr
                                        },
                                        success: function(response) {

                                            $('#bottom_reaction').html(response);
                                        },

                                    });
                                }

                                $(document).ready(function() {

                                    $('#cuer').css('cursor');
                                });
                            </script>

                            <li>

                                <a href="../publicpost/post_comment_details.php?postid=<?php echo $rows['idspPostings']; ?>&loadcom">
                                    <img src="../assets/images/mini-07.svg" width="28px" height="24px" aria-hidden="true" style="font-size:20px; margin-right: 75px;" />
                                    <span>
                                        <?php
                                        echo "<span class='tltcmt' style='margin-left:-120px!important;'>(" . $totalcmt + $replytotalcmt . ")</span>";
                                        ?></span>

                                </a>

                            </li>

                            <li>
                                <?php
                                $pl = new _favorites;
                                $re = $pl->read($rows['idspPostings']);
                                //echo $pl->ta->sql;
                                if ($re != false) {
                                    $i = 0;
                                    while ($rw = mysqli_fetch_assoc($re)) {
                                        if ($rw['spUserid'] == $_SESSION['uid']) {
                                            echo "<span style='font-size:20px;margin-right: -6px;' id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-count='" . $count . "' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span><span class=' show-modal' onclick=\"postfunction(" . $rows['idspPostings'] . ")\" id='delid" . $rows['idspPostings'] . "' style='font-size:15px;margin-left:5px;float:right'>($count) </span> " >
                                                $i++;
                                        }
                                    }
                                } else {

                                    echo "<span id='spFavouritePost' style='font-size:20px;margin-right: -6px; color:#7649B3' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated' data-postid='" . $rows['idspPostings'] . "' data-count='" . $count . "' ><span  class='font_regular'></span></span><span class=' show-modal' onclick=\"postfunction(" . $rows['idspPostings'] . ")\" id='delid" . $rows['idspPostings'] . "' style='font-size:14px;margin-left:5px; float:right'>($count)</span> ";
                                } ?>
                            </li>
                            <li style="margin-left: 40px;"><a href="javascript:void(0);" data-toggle='modal' data-target='#myshare' 2222><span class='sp-share' data-toggle='tooltip' data-placement='bottom' title='Share' data-postid='<?php echo $rows['idspPostings']; ?>' src='<?php echo ($pict); ?>'>
                                        <img src="../assets/images/mini-09.svg" alt="share" width="28px" height="24px" />
                                    </span></a><span class="show-modal-share" onclick="openshare(<?php echo $rows['idspPostings']; ?>)" style='font-size:14px;margin-left:5px;'><?php echo "($sharecount)"; ?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 no-padding">
                    <div class="commt_box timeline_comm_box commentbox_<?php echo $rows['idspPostings']; ?>">
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
                            } ?>

                        <?php
                        } ?>
                    </div>

                </div>
            </div>
        </div>
    <?php
        } ?>
</div>









<!----------Modal--------------->

<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Fevourite Profiles Details</h4>

            </div>
            <div class="modal-body">
                <p><b> </b><span id="user_name" style="font-size:18px;"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!----------Modal End--------------->


<!----------Ajax Modal--------------->
<script>
    function postfunction(postid, username) {

        $("#testmodal").modal('show');

        $.ajax({
            url: MAINURL + "/timeline/timepost.php",
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
<!----------Ajax Modal End--------------->

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
    $('.thumbnail').magnificPopup({
        type: 'image'
    });
</script>

<script>
    function myFun(id) {
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
                    url: "/post-ad/savePost.php",
                    type: "GET",
                    data: {
                        save: id,
                        //profileid: ide
                    },
                    success: function(response) {


                        $("#savefun" + id).html('<a class="profile_section" onclick="myUnsave(' + id + ')" style="color: black; "><img src="../assets/images/inner_group/save.svg" style="margin-right: 10px;" />Unsave Post</a>');
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
            confirmButtonText: 'Yes, Accepted it!'
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

                        $("#savefun" + id).html('<a class="profile_section" onclick="myFun(' + id + ')" style="color: black; padding-left: 20px;"><i class="fa fa-save"></i>Save Post</a>');
                    }

                });
            }
        });
    }
</script>


<script>
    function deletePost(id, groupid = 0, groupname = '') {

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
                if (groupid > 0 && groupname != '') {
                    window.location.href = '../post-ad/deletePost.php?postid=' + id + '&groupId=' + groupid + '&groupname=' + groupname + '&flag=1&timeline=1';
                } else {
                    window.location.href = '../post-ad/deletePost.php?postid=' + id + '&flag=1&timeline=1';
                }
            }
        });

    }
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
                var a = $('#cuer' + postid).text().replace('(', '').replace(')', '');
                //var a = $('#cuer' + postid).text();

                var c = parseInt(a) - parseInt(response);
                if (c >= 1) {
                    $('#cuer' + postid).text('(' + c + ')');
                } else {
                    $('#cuer' + postid).text("(0)");
                }
                //		$('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');

                //	$('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');

            },

        });

    }


    function myfunction(a) {
        var postid = $(a).attr("data-postid");
        //	alert(postid);
        var reaction = $(a).attr("data-reaction");
        //alert(reaction);
        var rid = $(a).attr("data-reaction");

        if (rid == 1) {
            rection = "&#128525;";
        }

        if (rid == 2) {
            rection = "&#128512;";
        }
        if (rid == 3) {
            rection = "&#128546;";
        }
        if (rid == 4) {
            rection = "&#129315;";
        }
        if (rid == 5) {
            rection = "&#128563;";
        }
        if (rid == 6) {
            rection = "&#128545;";
        }

        if (rid == 7) {
            rection = "&#128077";
        }
        var usid = $("#usid").val();
        var prid = $("#prid").val();

        $.ajax({
            url: "../social/addlike.php",
            type: "POST",
            data: {
                spPostings_idspPostings: postid,
                spProfiles_idspProfiles: prid,
                uid: usid,
                Reaction_id: reaction,
            },
            success: function(response) {
                var a = $('#cuer' + postid).text().replace('(', '').replace(')', '');
                //var a = $('#cuer' + postid).text();
                var c = parseInt(a) + parseInt(response);

                $('#cuer' + postid).text('(' + c + ')');


                $('#currentreaction_' + postid).html(rection);
                //	$('#new_data_'+postid).html('<a id="currentreaction_'+postid+'" class="reactionbtn_remove" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');
                //				  $('#currentreaction_'+postid).removeClass('reactionbtn').addClass('reactionbtn_remove');

            },

        });
    };
</script>