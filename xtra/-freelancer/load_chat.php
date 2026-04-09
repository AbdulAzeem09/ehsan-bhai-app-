<?php
    $fc = new _freelance_chat;
    $p = new _spprofiles;
    $sl = new _shortlist;
   
    $chat = array();
    $finalChat = array();
    $i = 0;

    //read all unread msgs and then show first 
    $result6 = $fc->chekunreadmessage($_SESSION['pid']);
    //echo $fc->ta->sql;
    if($result6){
        while ($row6 = mysqli_fetch_assoc($result6)) {
            array_push($chat, $row6['sender_idspProfiles']);
        }
    }

    $result5 = $fc->getAllReceiverConversation($_SESSION['pid']);
    //echo $fc->ta->sql;
    if($result5){
        while ($row5 = mysqli_fetch_assoc($result5)) {
            array_push($chat, $row5['sender_idspProfiles']);
        }
    }
    $result2 = $fc->getAllSenderConversation($_SESSION['pid']);
    //echo $fc->ta->sql;
    if($result2){
        while($row4 = mysqli_fetch_assoc($result2)){
            array_push($chat, $row4['receiver_idspProfiles']);
        }
    }
    
    
    $finalChat = array_unique($chat);

    //print_r($finalChat);
    //print_r($receiver);

    //echo $fc->ta->sql;
    if(count($finalChat) > 0){
        foreach($finalChat as $key => $value){ 
            $result3 = $p->read($value);
            if($result3){
                $row3 = mysqli_fetch_assoc($result3);
                $Receiver_profileName = $row3['spProfileName'];
                $picture = $row3['spProfilePic'];
                $profileid = $row3['idspProfiles'];
            }
            ?>
            <div class="col-xs-12 nopadding chat-user-profile freelanceconversation">
                <div class="col-xs-3 nopadding">
                    <?php
                    if (isset($picture)){
                        echo "<img alt='profilepic' class='img-responsive' src=' " . ($picture) . "' style='height:70px;width:126px;' >";
                    }else{
                        echo "<img alt='profilepic' class='img-circle' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='height:70px;width:126px;'  >";
                    }
                    ?>
                </div>
                <div class="col-xs-9">
                    
                    <?php
                    $result6 = $fc->chkNewChat($value, $_SESSION['pid']);
                    //echo $fc->ta->sql;
                    if($result6){
                        echo '<h3 class="chat-user displayconversation newchat"  data-senderprofile=" '. $profileid.' " >'.$Receiver_profileName .'</h3>';
                    }else{
                        echo '<h3 class="chat-user displayconversation"  data-senderprofile=" '. $profileid.' " >'.$Receiver_profileName .'</h3>';
                    }
                    $result7 = $fc->lastMsg($value, $_SESSION['pid']);
                    if($result7){
                        $row7 = mysqli_fetch_assoc($result7);
                        if(strlen($row7['chat_conversation']) < 15){
                            echo '<p class="chat-detail">'.$row7['chat_conversation'].'</p>';
                        }else{
                            echo '<p class="chat-detail">'. substr($row7['chat_conversation'], 0,15).'...</p>'; 
                        }
                        
                    }else{
                        echo '<p class="chat-detail">No Subject</p>';
                    }
                    ?>
                    
                    
                </div>
            </div>
            <?php
        }
    }

    
?>


