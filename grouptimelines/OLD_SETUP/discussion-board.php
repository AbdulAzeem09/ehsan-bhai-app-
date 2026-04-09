<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">

    <?php include('../component/links.php'); ?>
    <!--This script for posting timeline data Start-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    <!--This script for posting timeline data End-->
    <!--This script for sticky left and right sidebar STart-->

    <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
    <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
    <script>
        function execute(settings) {
            $('#sidebar').hcSticky(settings);
        }
        // if page called directly
        jQuery(document).ready(function($) {
            if (top === self) {
                execute({
                    top: 20,
                    bottom: 50
                });
            }
        });

        function execute_right(settings) {
            $('#sidebar_right').hcSticky(settings);
        }
        // if page called directly
        jQuery(document).ready(function($) {
            if (top === self) {
                execute_right({
                    top: 20,
                    bottom: 50
                });
            }
        });
    </script>
    <style type="text/css">
        .selldiscusshead {
            background-color: #1c4994 !important;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        btn:hover {
            color: #f3e6f2 !important;
            opacity: .8;
        }

        .zoom1:hover {
            -ms-transform: scale(1.15);
            /* IE 9 */
            -webkit-transform: scale(1.15);
            /* Safari 3-8 */
            transform: scale(1.15);
        }

        #new1:hover {
            color: white !important;
            opacity: .8;
        }

        .db_primarybtn {
            background: #83319f !important;
            border: 1px solid transparent !important;
        }

        .zoom2:hover {
            -ms-transform: scale(1.10);
            /* IE 9 */
            -webkit-transform: scale(1.10);
            /* Safari 3-8 */
            transform: scale(1.10);
        }
    </style>

</head>

<body onload="pageOnload('groupdd')" class="bg_gray">
    <?php

    $g = new _spgroup;
    $result = $g->groupdetails($group_id);
    //echo $g->ta->sql;
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);

        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];

        $sprofileid = $row['spProfiles_idspProfiles'];

        $assostadmin = $row['spAssistantAdmin'];
    }
    $pr = $g->admin_Member($_SESSION['pid'], $group_id);
    if ($pr != false) {
        $row = mysqli_fetch_assoc($pr);
        $admin = $row["spProfileIsAdmin"];
        $assistadmin = $row['spAssistantAdmin'];
    }
    ?>


    <div class="row">
        <div class="col-md-12">
            <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

            <input type="hidden" id="grpid" value="<?php echo $group_id; ?>">
            <input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
            <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
            <div class="discussions" id="ip6">
                <div class="heading-wrapper " id="ip6">
                    <div class="main-heading">
                        Discussions
                    </div>
                    <div class="more-btn">
                        <div class="btn">
                            <?php if ($admin == 0 || $assistadmin == 1) { ?>
                                <a href="#" data-toggle="modal" data-target="#conversationModal" id="new1" class="text-white"><img src="../assets/images/inner_group/add-4.svg" alt="">
                                    <span>Add Discussion</span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead id="bgcl">
                            <tr>
                                <th>Topic</th>
                                <th class="text-center">Post By</th>
                                <th class="text-center">Reply</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $profileid = $_SESSION['pid'];
                            $g = new _spgroup;
                            $pr = $g->admin_Member($profileid, $group_id);
                            if ($pr != false) {
                                $row = mysqli_fetch_assoc($pr);
                                $admin = $row["spProfileIsAdmin"];
                                $assistadmin = $row['spAssistantAdmin'];
                            }
                            $gc = new _groupconversation;
                            $m = new _spgroupmessage;
                            $res = $m->read($group_id);

                            if ($res != false) {
                                while ($rows = mysqli_fetch_assoc($res)) {


                                    $latestreply = "";
                                    $totalreply = 0;
                                    $result = $gc->read($rows["idspGroupMessage"]);


                                    $r = new _groupdiscussreply;

                                    $sumres = $r->readdiscussmsg($rows["idspGroupMessage"]);



                                    $totalreplies = $sumres->num_rows;


                                    if ($result != false) {

                                        $totalreply = $result->num_rows;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $latestreply = $row["spProfileName"];
                                            $datetime = $row["spGroupConversationDate"];
                                            $dt = new DateTime($datetime);
                                            $date = $dt->format('m/d/Y');
                                            $time = $dt->format('H:i:s A');
                                        }
                                    } else {
                                        $datetime = isset($rows["spGroupMessageDate"]);
                                        $latestreply = isset($rows["spProfileName"]);
                                        $datetime = isset($row["spGroupConversationDate"]);
                                        $dt = new DateTime($datetime);
                                        $date = $dt->format('m/d/Y');
                                        $time = $dt->format('H:i:s A');
                                    }
                                    $result1 = $gc->readCreaterMsg($rows["idspGroupMessage"]);
                                    if ($result1 != false) {
                                        $row1 = mysqli_fetch_assoc($result1);
                                    }

                                    if (isset($admin) == 0 && $rows["spGroupMessageFlag"] != 2 ) {
                            ?>
                                        <tr>
                                            <td style="padding-left: 20px;  color:black !important">
                                                <a style="color:black !important" href="<?php echo $BaseUrl; ?>/grouptimelines/discussion-chat.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&sendrid=<?php echo $profileid; ?>&gid=<?php echo $rows["idspGroupMessage"]; ?>&disc">
                                                    <?php echo $rows["spGroupMessage"]; ?>
                                                </a>
                                                <!-- <p><?php echo $row1['spGroupConversationText']; ?></p> -->
                                            </td>
                                            <td class="text-center">
                                                <a style="color:black !important" href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
                                            </td>
                                            <td class="text-center"><?php if ($totalreplies > 0) {
                                                                        echo $totalreplies;
                                                                    } else {
                                                                        echo "0";
                                                                    } ?></td>

                                            <td>
                                                <a href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage'] . '&groupid=' . $group_id; ?>" class=""></a>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        if ( $rows["spGroupMessageFlag"] == 0 ) {
                                        ?>
                                            <tr>
                                                <td style="padding-left: 20px;  color:black !important">
                                                        <a data-senderprofile="<?php echo $profileid; ?>" data-gid="<?php echo $rows["idspGroupMessage"]; ?>" style="color:black !important" href="<?php echo $BaseUrl . '/grouptimelines/show_discussedreply.php?messageid=' . $rows['idspGroupMessage'] . '&groupid=' . $group_id; ?>" class=""><?php echo $rows["spGroupMessage"]; ?></a>
                                                    <!-- <p style="word-wrap:break-word!important;width:500px!important;"><?php echo $row1['spGroupConversationText']; ?></p> -->
                                                </td>
                                                <td class="text-center">
                                                    <a style="color:black !important" href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $rows['idspProfiles'] ?>"><?php echo $rows["spProfileName"]; ?></a>
                                                </td>
                                                <td class="text-center"><?php if ($totalreplies > 0) {
                                                                            echo $totalreplies;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></td>
                                                <td class="action">
                                                    <img src="../assets/images/inner_group/dot-2.svg" alt="" class="dot  bg-white" style="border-right:none" onclick="threeDot(this)">
                                                    <div class="more-links" id="three-dot" style="display: none;">

                                                        <div class="link">
                                                        <a href="#" data-toggle="modal" data-target="#conversationModal1" data-postid="<?php echo $rows['idspGroupMessage']; ?>" data-textid="<?php echo $row1['idspGroupConversation']; ?>" data-spGroupMess="<?php echo $rows['spGroupMessage']; ?>" data-spGroupConver="<?php echo $row1['spGroupConversationText']; ?>" class="deldiscussion1">

                                                            <span class="img">
                                                                <img src="../assets/images/inner_group/edit-3.svg" alt="">
                                                            </span>
                                                            <span style="color:black !important">Edit</span>
                                                            </a>
                                                        </div>
                                                        <?php if ($admin == 0 || $assistadmin == 1) { ?>
                                                            <div class="link">
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspGroupMessage']; ?>" class="deldiscussion">
                                                                    <span class="img">
                                                                        <img src="../assets/images/inner_group/delete.svg" alt="">
                                                                    </span>
                                                                    <span style="color:black !important">Delete</span>
                                                                </a>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </td>
                                                <div class="modal fade" id="mycomment<?php echo $rows['idspGroupMessage']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                                    <div class="vertical-alignment-helper">
                                                        <div class="modal-dialog vertical-align-center">

                                                            <div class="modal-content no-radius bradius-15">
                                                                <div class="modal-header selldiscusshead">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                                                                    </button>
                                                                    <h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Reply</h3>

                                                                </div>
                                                                <div class="modal-body">


                                                                    <input type="hidden" name="spreplyerProfileId" id="spreplyerProfileId<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $_SESSION['pid']; ?>">

                                                                    <input type="hidden" name="comment_id" id="comment_id<?php echo $rows['idspGroupMessage']; ?>" value="<?php echo $rows['idspGroupMessage']; ?>">
                                                                    <div class="form-group">
                                                                        <label for="sell1">Enter your message <span class="red">*</span></label>
                                                                        <textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $rows['idspGroupMessage']; ?>" rows="4"></textarea>
                                                                        <span id="sellercommentid_error" style="color:red;"></span>

                                                                    </div>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style="background-color: #A60000; color: #fff; min-width: 100px;">Close</button>
                                                                    <button type="button" class="btn btn-primary btn-border-radius" onclick="get_commentdata(<?php echo $rows['idspGroupMessage']; ?>)" style="background-color: #1c4994; color: #fff;border: none; min-width: 100px;">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                            } else { ?>

                                <tr>
                                    <td colspan="4">

                                        <p class="text-center">No Discussion Found</p>
                                    <td>
                                </tr>

                            <?php  } ?>

                        </tbody>
                    </table>


                    <?php
                    ?>

                    <!--Conversation Subject-->
                    <div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content no-radius">
                                <div class="modal-header">
                                   
                                    <h4 class="modal-title float-start" id="enquireModalLabel"><b style="white-space: nowrap ;">New Conversation</b></h4>
                                    <button type="button" class="text-end float-end close ms-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background-color:white;">
                                    <form method="post" id="message_form">
                                        <!-- action="sendmessage.php"  -->
                                        <input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>" />


                                        <input type="hidden" id="starter" value="<?php echo $profilename; ?>" />

                                        <input type="hidden" name="spGroup_idspGroup" value="<?php echo $group_id ?>" />

                                        <input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>" />

                                        <input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">

                                        <div class="form-group">
                                            <label for="message" class="form-control-label">New Topic<span class="red">*</span> <span id="message_error" style="color:red;"></span></label>
                                            <input type="text" class="form-control" id="message" name="spGroupMessage" onkeyup="keyupsponsorfun()" />
                                        </div>

                                        <div class="form-group">
                                            <label for="message" class="form-control-label">Message<span class="red">*</span> <span id="description_error" style="color:red;"></span></label>
                                            <textarea class="form-control" id="description" rows="5" maxlength="150" name="conversationText_" onkeyup="keyupsponsorfun()"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style=" ">Cancel</button>
                                            <button type="button" id="groupconversation" class="btn btn-primary btn-border-radius">Start</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="conversationModal1" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content no-radius">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="enquireModalLabel"><b>Update Conversation</b></h4>
                </div>
                <div class="modal-body" style="background-color:white;">
                    <form action="updatemessage.php" method="post" id="message_form">
                        <input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>" />
                        <input type="hidden" id="starter" value="<?php echo $profilename; ?>" />
                        <input type="hidden" name="spGroup_idspGroup" value="<?php echo $group_id ?>" />
                        <input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>" />
                        <input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">
                        <input type="hidden" name="spGroup_idspGroup1" value="<?php echo $group_id ?>" />
                        <input type="hidden" name="groupname1_" value="<?php echo $_GET['groupname'] ?>" />
                        <input type="hidden" id="messageid1" name="messageid1" value="">
                        <input type="hidden" id="textid1" name="textid1" value="">
                        <div class="form-group">
                            <label for="message" class="form-control-label">New Topic<span class="red">*</span> <span id="message_error" style="color:red;"></span></label>
                            <input type="text" class="form-control" id="message11" name="spGroupMessage1" value="" onkeyup="keyupsponsorfun()" />
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-control-label">Message<span class="red">*</span> <span id="description_error" style="color:red;"></span></label>
                            <textarea class="form-control" id="description11" rows="5" maxlength="150" name="conversationText_" value="" onkeyup="keyupsponsorfun()"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="groupconversation" name="update" class="btn btn-primary btn-border-radius">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(".deldiscussion1").click(function() {
            var postid = $(this).attr("data-postid");
            var textid = $(this).attr("data-textid");
            var spGroupMess = $(this).attr("data-spGroupMess");
            var spGroupConver = $(this).attr("data-spGroupConver");


            $("#messageid1").val(postid);
            $("#textid1").val(textid);
            $("#message11").val(spGroupMess);
            $("#description11").val(spGroupConver);

        });
    </script>




















    <script type="text/javascript">
        $(document).ready(function(e) {
            // Submit form data via Ajax
            $("#groupconversation").on("click", function() {

                //alert();
                var msg = $("#message").val();

                var descrip = $("#description").val();
                var grpid = $('#grpid').val();
                var grpName = $('#grpName').val();

                //alert(msg);
                //alert(descrip);

                if (msg == "" && descrip == "") {

                    $("#message_error").text("This field is required.");
                    $("#message").focus();

                    $("#description_error").text("This field is required.");
                    $("#description").focus();


                    return false;
                } else if (msg == "") {

                    $("#message_error").text("This field is required.");
                    $("#message").focus();


                    return false;
                } else if (descrip == "") {

                    $("#description_error").text("This field is required.");
                    $("#description").focus();


                    return false;
                } else {
                    $("#message_form").submit();

                    //alert("Form Submitted Successfuly!");

                    return true;


                }

            });
        });

        $("#message_form").on('submit', function() {
            var formData = new FormData($("#message_form")[0]);

            $.ajax({
                url: 'sendmessage.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                },
                error: function(error) {

                }
            });
        })


        function keyupsponsorfun() {

            //alert();

            var msg = $("#message").val();

            var descrip = $("#description").val();


            //alert(category);
            //alert(category.length);

            if (msg != "") {
                $('#message_error').text(" ");

            }
            if (descrip != "") {
                $('#description_error').text(" ");
            }



        }
    </script>



</body>

</html>
<script>
    function threeDot(element) {
        var actionTd = element.closest('.action');
        var moreLinks = actionTd.querySelector('.more-links');
        if (moreLinks.style.display === 'none' || moreLinks.style.display === '') {
            document.querySelectorAll('.more-links').forEach(function(link) {
                link.style.display = 'none';
            });
            moreLinks.style.display = 'block';
        } else {
            moreLinks.style.display = 'none';
        }
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.action')) {
            document.querySelectorAll('.more-links').forEach(function(link) {
                link.style.display = 'none';
            });
        }
    });
</script>