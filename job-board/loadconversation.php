<?php
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    $fc = new _post_chat;
    $p = new _spprofiles;
    $ptype = 5;

    $result2 = $fc->readChat($_POST['txtSendrProId'], $_SESSION['pid'], $ptype);
    //echo $fc->ta->sql;
    $result3 = $p->read($_POST['txtSendrProId']);
    if($result3){
        $row3 = mysqli_fetch_assoc($result3);
        $Receiver_profileName = $row3['spProfileName'];
        $picture = $row3['spProfilePic'];
        $profileid = $row3['idspProfiles'];
    }
   
    date_default_timezone_set('Asia/Karachi');

    $ProfileId3 = $_POST['txtSendrProId'];
    $currentDateTime = date('Y-m-d h:i a');
?>
    <div class="panel panel-primary no-radius no-margin" style="border-color: #EAEAEA;">
        <div class="panel-heading no-radius inboxFriend">
            <div class="row">
                <div class="col-md-12">
                    <div id="friendlist">
                        <!--Adding Friend-->
                        <a href="javascript:void(0)"> <?php echo $Receiver_profileName; ?></a>
                    </div>
                </div>  
                
            </div>  
        </div>
        <div class="panel-body no-padding">
            <!--Previous Message-->
            <div class="chattingsystem" >
                <div style="overflow-y: auto; overflow-x: hidden;" class="friend_message">
                    <div class="messages">
                        <ul id="loadtxtmsg"> 
                            <?php
                            if($result2){
                                $rowcount = mysqli_num_rows($result2);
                                foreach ($result2 as $key => $value) {
                                    // read profile
                                    $result = $p->read($value['sender_idspProfiles']);
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        if ($row['spProfilePic'] != '') {
                                            $sender_img = '<img src="'.($row['spProfilePic']).' " class="img-responsive">';
                                        }else{
                                            $sender_img = "<img src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
                                        }
                                    }else{
                                        $sender_img = "<img src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
                                    }
                                    
                                    $dt = new DateTime($value['chat_date']);

                                    $d = strtotime($value['chat_date']);
                                    if ($value['sender_idspProfiles'] == $_SESSION['pid']) {
                                        ?>
                                        <li class="sent">
                                            <?php echo $sender_img; ?> 
                                            <p><?php echo $value['chat_conversation'];?></p>
                                        </li>
                                        <?php
                                    }else{
                                        ?>
                                        <li class="replies">
                                            <?php echo $sender_img; ?> 
                                            <p><?php echo $value['chat_conversation'];?></p>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            
                            
                        </ul>
                    </div>
                </div>

                <!--Complete  action="sendmessage.php" method="post"-->
                <div class="chat_form">
                    <form method="post" action="addconversation.php" id="myform">
                        <input type="hidden" name="receiver_idspProfiles" value="<?php echo $ProfileId3; ?>"/>
                        <input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid']; ?> "/>
                        <input type="hidden" name="chat_date" value="<?php echo $currentDateTime; ?>"/>
                        <input type="hidden" name="spProfileType_idspProfileType" value="5" >

                        
                        <textarea class="form-control chat_conversation" name="chat_conversation" placeholder="Type your message here..." style="height: 76px;" />
                        <button class="addfreelanceChat btn btn-success pull-right" type="button" data-senderid="<?php echo $ProfileId3 ;?>" style="width: 7%;height: 76px;"><i class="fa fa-paper-plane"></i></button>                        
                    </form>
                </div>
                
            </div>
        </div>
    </div>







