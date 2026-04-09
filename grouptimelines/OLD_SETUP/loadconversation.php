<?php
//die("====================");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $m = new _spgroupmessage;
    $gc = new _groupconversation;
    $res = $m->readSingleGroup($_GET["groupid"], $_GET['sendrid'], $_GET['gid']);
    if($res != false){
        $row = mysqli_fetch_assoc($res);
        $Title = $row['spGroupMessage'];

        $result1 = $gc->readCreaterMsg($row["idspGroupMessage"]);
        if($result1 != false){
            $row1 = mysqli_fetch_assoc($result1);
        }
    }
   

    $result2 = $gc->read($_GET['gid']);
    //echo $gc->ta->sql;
    $ProfileId3 = $_GET['sendrid'];
    $groupid3 = $_GET['gid'];
    $conversationid3 = $_GET['gid'];

    
    ?>
    <h2><?php echo $Title;?></h2>
    <div class="col-md-12">
        <p><?php echo $row1['spGroupConversationText'];?></p>
    </div>
    <div class="inner_load_conv">
    <?php
    echo '<form method="post" action="addconversation.php" style="margin-bottom: 50px;">';
    echo '<input type="hidden" name="spGroupConProfile" value="' . $ProfileId3 . '"/>';
    echo '<input type="hidden" id="spGroupMessage_idspGroupMessage" name="spGroupMessage_idspGroupMessage" value="' . $conversationid3 . '"/>            
                <div class="form-group">
                    <textarea class="form-control spGroupConversationText no-radius" name="spGroupConversationText" placeholder="Type your message here..." rows="4"></textarea>
                </div>
                <button class="addconversation btn btn_gray pull-right" type="button" data-gmesgid="' . $conversationid3 . '"><i class="fa fa-envelope"></i> Send Message</button><br>';
    echo '</form>';


echo '<div style="height: 280px;overflow:scroll;"><table class="table table-hover table-condensed"  id="myTable">
            <thead><tr><th>Participant</th><th>Message</th><th>Created Date</th></tr></thead>';
echo'<tbody id="loadtxtmsg">';

    if($result2){
        $rowcount = mysqli_num_rows($result2);
        foreach ($result2 as $key => $value) {
       
            $ProfileId = $value['idspProfiles'];
            $groupid = $value['spGroupMessage_idspGroupMessage'];
            $conversationid = $value['spGroupMessage_idspGroupMessage'];
            
            $dt = new DateTime($value['spGroupConversationDate']);
            $d = strtotime($value['spGroupConversationDate']);
            echo '<tr> 
                    
                    <td class="commentoverflow">
                        <b>' . $value["spProfileName"] . '</b>
                    </td>
                    <td style="word-wrap: break-word;">' . $value["spGroupConversationText"] . '</td>
                    <td style="width:100px;">' . $dt->format('d M') . "  " . date("H:i", $d) . '</td>
                </tr>                                                                      
            ';
        }
    }

    
    echo ' </tbody></table></div>';

//}
?>
    </div>