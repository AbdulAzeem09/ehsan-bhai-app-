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
            <tr>
                <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete" class="hidden"><i class="fa fa-trash"></i></a></td>
                <td >                   
                    <?php
                        echo " <a href='javascript:void(0)' class='displayconversation' data-senderprofile='".$profileid."' ><img  alt='profile-Pic' class='img-responsive chat_img' src='" . (isset($picture) ? " " . ($picture) . "" : "../assets/images/icon/blank-img.png") . "' ><span class='frndname'>" . $Receiver_profileName . " </span></a>";
                    ?>                    
                </td>
                <td>
                    <?php
                    $result7 = $fc->lastMsg($value, $_SESSION['pid']);
                    if($result7){
                        $row7 = mysqli_fetch_assoc($result7);
                        $dt = new DateTime($row7['chat_date']); 
                        $date = $dt->format('d M Y h:m:s');

                        if(strlen($row7['chat_conversation']) < 15){
                            echo $row7['chat_conversation'];
                        }else{
                            echo substr($row7['chat_conversation'], 0,15); 
                        }

                    }else{
                        echo 'No Subject';
                        $date = "";
                    }
                    ?>
                </td>
                <td>
                    <?php echo $date; ?>
                </td>

            </tr>
         
            <?php
        }
    }
    else{
        echo "<center>No Record Found</center>";
    }

    
?>


