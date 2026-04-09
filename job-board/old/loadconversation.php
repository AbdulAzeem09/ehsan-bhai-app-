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
    ?>
    <h2 class=""><?php echo $Receiver_profileName;?></h2>
    <?php
    date_default_timezone_set('Asia/Karachi');

    $ProfileId3 = $_POST['txtSendrProId'];
    $currentDateTime = date('Y-m-d h:i a');
    


    echo '<form method="post" action="addconversation.php" class="conversationform">';
    echo '<input type="hidden" name="receiver_idspProfiles" value="' . $ProfileId3 . '"/>';
    echo '<input type="hidden" name="sender_idspProfiles" value="' . $_SESSION['pid'] . '"/>';
    echo '<input type="hidden" name="chat_date" value="' . $currentDateTime . '"/>';
    echo '<input type="hidden" name="spProfileType_idspProfileType" value="5" >';

    echo '<div class="form-group">
                <textarea class="form-control chat_conversation" name="chat_conversation" placeholder="Type your message here..." rows="4"></textarea>
            </div>
            <button class="addfreelanceChat btn butn_jobboard pull-right" type="button" data-senderid="' . $ProfileId3 . '" ><i class="fa fa-envelope"></i> Send</button><br>';
    echo '</form>';


echo '<div style="height: 280px;overflow:scroll;">
        <table class="table table-hover table-condensed"  id="myTable">
            <thead>
                <tr>
                    <th width="25%">Participant</th>
                    <th>Message</th>
                    <th style="width: 32%;">Date/Time</th>
                </tr>
            </thead>';
echo'<tbody id="loadtxtmsg">';

    if($result2){
        $rowcount = mysqli_num_rows($result2);
        foreach ($result2 as $key => $value) {
            
            $dt = new DateTime($value['chat_date']);

            $d = strtotime($value['chat_date']);
            ?>
            <tr> 
                
                <td class="commentoverflow">
                    <b><?php 
                    $PName = $p->getProfileName($value['sender_idspProfiles']);
                        echo $PName;
                    ?></b>
                </td>
                <td style="word-wrap: break-word;"><?php echo $value['chat_conversation'];?></td>
                <td><?php echo $dt->format('d M Y') . "  " . date("H:i A", $d); ?></td>
            </tr>                                                                      
            <?php
        }
    }

    
    echo ' </tbody></table></div>';

//}
?>