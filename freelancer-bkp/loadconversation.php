<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    $fc = new _freelance_chat;
    $p = new _spprofiles;

    $result2 = $fc->readChat($_POST['txtSendrProId'], $_SESSION['pid']);
    //echo $fc->ta->sql;
    $result3 = $p->read($_POST['txtSendrProId']);
    if($result3){
        $row3 = mysqli_fetch_assoc($result3);
        $Receiver_profileName = $row3['spProfileName'];
        $picture = $row3['spProfilePic'];
        $profileid = $row3['idspProfiles'];
    }
    ?>
   
    <?php
    date_default_timezone_set('Asia/Karachi');

    $ProfileId3 = $_POST['txtSendrProId'];
    $currentDateTime = date('Y-m-d h:i a');

    $mypid = $_SESSION['pid'];
    // ===GET INFO OF SENDER
    $pr = $p->read($mypid);
    if ($pr != false) {
        $rw = mysqli_fetch_assoc($pr);
        $sender = $rw["spProfileName"];
        $sender_img = $rw["spProfilePic"];
    }
    // ===END


    ?>
    <div class="panel panel-primary no-radius no-margin" style="border-color: #EAEAEA;">
        <div class="panel-heading no-radius inboxFriend">
            <div class="row">
                <div class="col-md-12">
                    <div id="friendlist">
                        <a href="javascript:void(0)"><?php echo $Receiver_profileName;?></a>
                    </div>
                </div>  
                
            </div>  
        </div>
        <div class="panel-body no-padding">
            <!--Previous Message-->
            <div class="frelanceChatbox">
                <div style="overflow-y: auto; overflow-x: hidden;" class="friend_message">
                    <?php
                    echo '<div class="messages "><ul id="loadtxtmsg">';
                    if($result2){
                        $rowcount = mysqli_num_rows($result2);
                        foreach ($result2 as $key => $value) {
                            if ($value['sender_idspProfiles'] == $mypid) {
                                ?>
                                <li class="sent">
                                    <img src="<?php echo ($sender_img);?>" class="img-responsive">
                                    <p><?php echo $value["chat_conversation"] ; ?></p>
                                </li>
                                <?php
                            }else{
                                ?>
                                <li class="replies">
                                    <img src="<?php echo ($picture);?>" class="img-responsive">
                                    <p><?php echo $value["chat_conversation"] ; ?></p>
                                </li>
                                <?php
                            }
                        }
                    }

                    echo "</div></ul>";
                    ?>
                </div>
                <div class="chat_form">
                    <form method="post" action="addconversation.php" class="conversationform">
                        <input type="hidden" name="receiver_idspProfiles" value="<?php echo $ProfileId3; ?>"/>
                        <input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid']; ?>"/>
                        <input type="hidden" name="chat_date" value="<?php echo $currentDateTime; ?>"/>

                        
                        <textarea class="form-control chat_conversation" name="chat_conversation" placeholder="Type your message here..." style="height: 76px;" ></textarea>
                        <button class="addfreelanceChat btn btn-success pull-right" type="button" data-senderid="<?php echo $ProfileId3; ?>" style="width: 7%;height: 76px;" ><i class="fa fa-paper-plane"></i></button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    