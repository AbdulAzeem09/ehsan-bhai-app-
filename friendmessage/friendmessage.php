<!--Find sender id who is friend of receiver -->
<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

// echo date_default_timezone_get();
// exit;
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

//when receiver click on sender then update message read
$m = new _friendchatting;
$p = new _spprofiles;
$r = new _spprofilehasprofile;

$senderId   = isset($_POST["friendid"]) ? (int)$_POST["friendid"] : 0; //friend id
$receiverId = $_SESSION['pid']; //myid
//echo $receiverId;

$data = array("spfriendChattingUnread" => 1);
$m->unreadMsg($data, $senderId, $receiverId);
//echo $m->ta->sql;
// SENDER INFORMATION
$sms_send = $p->read($receiverId);
//echo $p->ta->sql;

if ($sms_send != false) {
    $sms_snd_rw = mysqli_fetch_assoc($sms_send);
    $sender_msg_name = $sms_snd_rw["spProfileName"];
    $sender_msg_img = $sms_snd_rw["spProfilePic"];
}
// RECEIVER INFORMATION
$sms_rec = $p->read($senderId);
if ($sms_rec != false) {
    $sms_rec_rw = mysqli_fetch_assoc($sms_rec);
    $rec_msg_name = $sms_rec_rw["spProfileName"];
    $rec_msg_img = $sms_rec_rw["spProfilePic"];
}
// END


if (isset($_POST["myid"]) && $_POST['myid'] != '') {
    $myid = (int)$_POST["myid"];
}

if (isset($_POST["myid"])) {

    $result = $p->read((int)$_POST["myid"]);
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $myname = $row["spProfileName"];
        $icon = $row["spprofiletypeicon"];
    }
}
//echo $myname."-".$icon;





?>


<style>
    .message-body {
        width: 60% !important;
    }
</style>

<div class="panel panel-primary no-radius no-margin" style="border-color: #EAEAEA;">
    <div class="panel-heading no-radius inboxFriend">
        <div class="row">
            <div class="col-md-6">

                <div id="friendlist">
                </div>


            </div>
            <div class="col-md-6">

                <div class="panel-search-form info form-group has-feedback no-margin-bottom" style="display: inline-flex; float: right;">

                    <input type="text" class="form-control" name="search" placeholder="Search" id="message-search" style="margin-left:-15px;" value="">

                    <button type="submit" name="filter" style="border: none;"><span class="fa fa-search" style="padding: 4px;"></span></button>

                    </form>
                </div>

            </div>
        </div>
        </div>
        <div class="panel-body no-padding">
            <!--Previous Message-->
            <div class="chattingsystem">
                <div style="overflow-y: auto; overflow-x: hidden;" class="friend_message">

                    <?php
                      
                    $result = $m->read($receiverId, isset($_POST["friendid"]) ? (int)$_POST["friendid"] : 0);
                    //echo $m->ta->sql;
                    echo '<div class="messages"><ul>';
                    if ($result != false) {

                        while ($rows = mysqli_fetch_assoc($result)) {
                            //print_r($rows);
                            //$dt = new DateTime($rows['spMessageDate']); 
                            //profile-details//
                            // print_r($rows['spMessageDate']);
                            $pr = $p->read($rows["spprofiles_idspProfilesSender"]);
                            $idfriend=$rows["spprofiles_idspProfilesSender"];
                            //echo $m->ta->sql;
                            if ($pr != false) {
                                $rw = mysqli_fetch_assoc($pr);
                                $sender = $rw["spProfileName"];
                                $sender_img = $rw["spProfilePic"];
                            }

                            $archived = "";
                            $starred = "";
                            $delete = "";
                            $m = new _messageactivity;
                            $res = $m->read($rows["idspfriendChatting"], $_SESSION["uid"]);
                            if ($res != false) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    if ($row["idspMessageActivityFlag"] == 2)
                                        $archived = $row["idspMessageActivityFlag"];

                                    if ($row["idspMessageActivityFlag"] == 1)
                                        $starred = $row["idspMessageActivityFlag"];

                                    if ($row["idspMessageActivityFlag"] == 0)
                                        $delete = $row["idspMessageActivityFlag"];

                                    $myprofileid = $row["spMessageActivityProfile"];
                                }
                            }

                            if ($delete == "") {
                                if ($rows["spprofiles_idspProfilesSender"] == $myid) {
                    ?>
                                    <li class="replies">
                                        <?php
                                        if ($sender_img != '') {
                                            echo '<img src="' . ($sender_img) . ' " class="img-responsive" style="height:50px; width:50px;" >';
                                        } else {
                                            echo "<img src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
                                        }
                                        ?>

                                        <?php if ($rows["spprofiles_idspProfilesSender"]) { ?>
                                            <!-- <h6 style="margin-left:600px"><?php echo $rows["spMessageDate"] ?></h6> -->





                                            <div class="message my-message">

                                                <div class="message-body" style="background-color:edeef0!important; margin-top:7px;">
                                                    <div class="message-body-inner">
                                                   
                                                        <div class="message-info" style="float:left;">
                                                        <h5 style=" margin-right:10px!important;"><i class="fa fa-clock-o"></i> <?php
                                                                                                                                                            date_default_timezone_set('Asia/Kolkata');
                                                                                                                                                            echo  date('M j, Y h:i A', strtotime($rows["spMessageDate"]));
                                                                                                                                                            //echo  date('M j, Y h:i A', strtotime($rows["spMessageDate"]));  

                                                                                                                                                            ?></h5>
                                                      
                                                    <a href="<?php echo $BaseUrl?>friends/?profileid=<?php echo $idfriend ?>"><h5 style="float:right!important; margin-right:10px!important;font-weight:bold;"><?php echo $sender; ?></h5></a>
                                                            
                                                        </div>
                                                        <hr />
                                                        <?php if ($rows['msg_type'] == 1) { ?>
                                                            <div class="message-text" style="float:right!important;  word-break: break-all; width: 100%; white-space: normal;">
                                                                <?php echo $rows["spfriendChattingMessage"]; ?>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="message-text" style="float:right!important;  word-break: break-all; width: 100%; white-space: normal;">



                                                                <?php if ($rows['file_type'] == 1) { ?>
                                                                    <img src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>" style=" height: 50%;
    width: 100%; overflow-x:hidden; overflow-y:hidden;">
                                                                <?php }
                                                                if ($rows['file_type'] == 2) { ?>
                                                                    <audio width="100%" height="200" controls>
                                                                        <source src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>">
                                                                    </audio>
                                                                <?php }
                                                                if ($rows['file_type'] == 3) { ?>
                                                                    <video width="100%" height="240" controls>
                                                                        <source src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>">
                                                                    </video>
                                                                <?php }
                                                                if ($rows['file_type'] == 4) { ?>
                                                                    <a href="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>"><?php echo $rows['spfriendChattingMessage']; ?></a>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <br />

                                            </div>

                                        <?php

                                        } ?>

                                    </li>
                                    <?php if ($rows["spfriendChattingUnread"] == 1) { ?>
                                        <li>
                                            <h6 style="float: right;font-size: x-small;color: #008000a1;margin-top: -6px; padding: 0px 28px 0px 0px;">
                                                <i class="fa fa-check" style="font-size: xx-small;"></i>
                                                <?php echo "Seen"; ?>
                                            </h6>
                                        </li>
                                    <?php } ?>
                                <?php
                                } else {
                                ?>

                                    <hr>

                                    <li class="sent">
                                        <?php
                                        if ($rec_msg_img != '') {
                                            echo '<img src="' . ($rec_msg_img) . ' " class="img-responsive" style="height:50px; width:50px;">';
                                        } else {
                                            echo "<img = src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
                                        }
                                        ?>



                                        <div class="message info">

                                            <div class="message-body">
                                                <div class="message-info" style="margin-top: 8px;
    font-size: 13px;font-weight: bold;">
                                                <a href=" <?php echo $BaseUrl?>friends/?profileid=<?php echo $idfriend ?>" style="color:white;"><h5 style="float:left!important; margin-top:10px!important; margin-left:10px!important;font-weight:bold;"></h5><?php echo $sender; ?></h5></a>
                                                    <span style="float:right!important; margin-right:10px!important; "><i class="fa fa-clock-o"></i> <?php date_default_timezone_set('Asia/Kolkata');

                                                                                                                                                    echo  date('M j, Y h:i A', strtotime($rows["spMessageDate"]));
                                                                                                                                                    ?></span><br>
                                                </div>
                                                <hr>
                                                <!--<div class="message-text" style="font-size:15px;margin-left:80px; word-break: break-all;  width: 100%; white-space: normal;">
                                    <?php echo $rows["spfriendChattingMessage"]; ?>
                                    </div>-->
                                                <?php if ($rows['msg_type'] == 1) { ?>
                                                    <div class="message-text" style="float:right!important;  word-break: break-all; width: 100%; white-space: normal;">
                                                        <?php echo $rows["spfriendChattingMessage"]; ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="message-text" style="float:right!important;  word-break: break-all; width: 100%; white-space: normal;">



                                                        <?php if ($rows['file_type'] == 1) { ?>
                                                            <img src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>" style=" height: 50%;
    width: 100%; overflow-x:hidden; overflow-y:hidden;">
                                                        <?php }
                                                        if ($rows['file_type'] == 2) { ?>
                                                            <audio width="100%" height="200" controls>
                                                                <source src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>">
                                                            </audio>
                                                        <?php }
                                                        if ($rows['file_type'] == 3) { ?>
                                                            <video width="100%" height="240" controls>
                                                                <source src="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>">
                                                            </video>
                                                        <?php }
                                                        if ($rows['file_type'] == 4) { ?>
                                                            <a href="<?php echo $BaseUrl ?>/friendmessage/uploads/<?php echo $rows['spfriendChattingMessage']; ?>"><?php echo $rows['spfriendChattingMessage']; ?></a>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <br />
                                        </div>



                                    </li>
                                <?php

                                }
                                ?>

                    <?php
                            }
                        }
                    }
                    echo "</div>";
                    echo "</ul>";
                    ?>
                </div>

                <!--Complete  action="sendmessage.php" method="post"-->
                <div class="chat_form" style="display:none;">
                    <form method="post" id="myform">
                        <input type="hidden" id="sender" name="spprofiles_idspProfilesSender" value="<?php echo $myid; ?>" />
                        <?php
                        //date_default_timezone_set('Asia/Kolkata');
                        if ($sender_msg_img != '') {
                        ?>
                            <input type="hidden" id="mypic" value="<?php echo ($sender_msg_img); ?>">
                        <?php
                        } else {
                        ?>
                            <input type="hidden" id="mypic" value="../assets/images/blank-img/default-profile.png">
                        <?php
                        }
                        ?>
                        <input type="hidden" id="mydate" value="<?php date_default_timezone_set('Asia/Kolkata');
                                                                echo date("Y-m-d H:i:s"); ?>" />
                        <input type="hidden" id="myname" value="<?php echo $myname; ?>" />

                        <input type="hidden" id="receiver" name="spprofiles_idspProfilesReciver" value="<?php echo isset($_POST["friendid"]) ? (int)$_POST["friendid"] : 0; ?>">

                        <?php

                        $obj = new _friendchatting;
                        $result2 = $obj->readdraftmessage($myid, isset($_POST["friendid"]) ? (int)$_POST["friendid"] : 0);
                        if ($result2 != false) {
                            $roww = mysqli_fetch_assoc($result2);
                            $drftmessage = $roww['draft_message'];
                        } else {

                            $drftmessage = "";
                        }

                        $fv = new _spprofilefeature;
                        $checkIsBlocked = $fv->chkBlock($myid, isset($_POST["friendid"]) ? (int)$_POST["friendid"] : 0);
                        if ($checkIsBlocked == false) { ?>
                            <textarea class="form-control" id="freindmessage" name="spfriendChattingMessage" placeholder="Type your message here..." style="height: 76px;"><?php echo $drftmessage; ?></textarea>
                            <button class="sendmessagetofriend btn btn-success pull-right" type="button" style="height: 76px;width: 7%;"><i class="fa fa-paper-plane"></i></button>
                        <?php } else { ?>
                            <b class="text-muted" style="margin-left: 45px;">You can't send the message as the user is blocked.</b>
                        <?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <?php
    /*$obj=new _friendchatting;
	  $obj->updatemessagestatus($myid,$_POST["friendid"]); */
    ?>
    <script>
        $(document).ready(function() {

            $("#freindmessage").keyup(function() {

                var draf_message = $(this).val();
                var senderdid = $('#sender').val();
                var recieverdid = $('#receiver').val();


                // alert(draf_message);
                //alert(senderdid);
                //alert(receiverdid);  


                $.ajax({
                    url: "friendmessage/draft_message.php",
                    type: "POST",
                    cache: false,
                    data: {
                        'draf_message': draf_message,
                        'senderdid': senderdid,
                        'recieverdid': recieverdid
                    },
                    success: function(data) {
                        //alert(data);
                        //$('#freindmessage').html(data);	   

                        //location.reload();

                    }

                });





            });

        });
    </script>