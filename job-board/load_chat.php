<?php
    $fc = new _post_chat;
    $p = new _spprofiles;
    $sl = new _shortlist;
   
    $chat = array();
    $finalChat = array();
    $i = 0;
    $ptype = 5;

    //read all unread msgs and then show first 
    $result6 = $fc->chekunreadmessage($_SESSION['pid'], $ptype);
    //echo $fc->ta->sql;
    if($result6){
        while ($row6 = mysqli_fetch_assoc($result6)) {
            array_push($chat, $row6['sender_idspProfiles']);
        }
    }

    $result5 = $fc->getAllReceiverConversation($_SESSION['pid'], $ptype);
    //echo $fc->ta->sql;
    if($result5){
        while ($row5 = mysqli_fetch_assoc($result5)) {
            array_push($chat, $row5['sender_idspProfiles']);
        }
    }
    $result2 = $fc->getAllSenderConversation($_SESSION['pid'], $ptype);
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
            
            <tr>
                <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete" class="hidden"><i class="fa fa-trash"></i></a></td>
                <?php
                $result6 = $fc->chkNewChat($value, $_SESSION['pid'], $ptype);
                //echo $fc->ta->sql;
                if($result6){
                    echo '<td><a href="javascript:void(0)" class="chat-user displayconversation newchat" data-senderprofile=" '. $profileid.' " data-toggle="tooltip" data-placement="top" title="Start Chat" >'.ucfirst(strtolower($Receiver_profileName)) .'</a></td>';
                }else{
                    echo '<td><a href="javascript:void(0)" class="chat-user displayconversation" data-senderprofile=" '. $profileid.' " data-toggle="tooltip" data-placement="top" title="Start Chat" >'.ucfirst(strtolower($Receiver_profileName)) .'</a></td>';
                }
                // READ LAST MESSAGE
                $result7 = $fc->lastMsg($value, $_SESSION['pid']);
                //echo $fc->ta->sql;
                if($result7){
                    $row7 = mysqli_fetch_assoc($result7);
                    $dt = new DateTime($row7['chat_date']); 
                    if(strlen($row7['chat_conversation']) < 15){
                        echo '<td>'.$row7['chat_conversation'].'</td>';
                    }else{
                        echo '<td>'.substr($row7['chat_conversation'], 0,15).'</td>';
                    }
                }else{
                    echo '<td>No Subject</td>';
                }
                ?>                
                <td><?php echo $dt->format('d M Y'); ?></td>
            </tr>

            <?php
        }
    }
?>


