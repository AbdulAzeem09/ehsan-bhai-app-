
    <?php
    $r = new _spprofilehasprofile;
    $unread = new _friendchatting;
    $a = array();
    $res = $r->friends($_SESSION["uid"]); //As a receiver
    //echo $r->ta->sql;
    if ($res != false) {

        while ($rows = mysqli_fetch_assoc($res)) {

            $rslt = $g->friendprofile($_SESSION["uid"], $rows["spProfiles_idspProfileSender"]);
            $groupname = "";
            $groupid = 0;
            $g = new _spgroup;
            if ($rslt != false) {
                $rws = mysqli_fetch_assoc($rslt);
                $groupid = $rws["idspGroup"];
                $groupname = $rws["spGroupName"];
                $groupname = str_replace(' ', '', $groupname);
            }

            array_push($a, $rows["spProfiles_idspProfileSender"]);
            $p = new _spprofiles;

            $sender = $rows["spProfiles_idspProfileSender"]; //Friend
            $receiver = $rows["spProfiles_idspProfilesReceiver"]; //My
            $total = 0;
            $unres = $unread->unreadmessage($sender, $_SESSION["uid"]); //$receiver
            if ($unres != false) {
                $total = $unres->num_rows;
            }

            $result = $p->read($rows["spProfiles_idspProfileSender"]);
            if ($result != false) {
                $row = mysqli_fetch_assoc($result);
                if ($row['is_active'] == 1) {
                    ?>
                    <div class="who_is_online">
                        <span>
                            <?php
                            if(isset($row['spProfilePic'])){
                                echo "<img  alt='profile-Pic' class='online_img' src=' " . ($row['spProfilePic']) ."' >";
                            }else{ ?>
                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="online_img" alt="" />  <?php
                            }
                            ?>
                            <h2><?php echo $row["spProfileName"];?> <img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/online.png" class=""></h2>
                        </span>
                    </div>
                    <?php
                }
                //echo "<div style='padding:10px 0px;' class='list-group-item list-group-item-action friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "'>";
//               echo " <a href='#' class='list-group-item list-group-item-action friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "' data-friendname='" . $row["spProfileName"] . "' data-groupid='" . $groupid . "'>";
//              echo "</a>";

                //echo "<img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "' >"
               // . "<span class='frndname'>" . $row["spProfileName"] . " </span>";
                //. "<span class='" . $row["spprofiletypeicon"] . " frdicon' data-frndicon='" . $row["spprofiletypeicon"] . "'></span>";
                //".$BaseUrl."/friendmessage' class='friendchat myfriend
                //echo "<a href='" . $BaseUrl . "/friendmessage' class='friendchat myfriend " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "'data-groupid='" . $groupid . "'><span style='float:right;padding:2px 10px 0px 10px' class='glyphicon glyphicon-envelope'></span></a>";
                //echo '<a href="' . $BaseUrl . '/friends/?profileid=' . $row["idspProfiles"] . '"><span style="float:right;padding:2px 0px 0px 8px" class="glyphicon glyphicon-user"></span></a>';
                //if ($row['is_active'] == 1) {
                    //echo "<span style='float: right;'><img style='height:16px;width:16px'  src='" . $BaseUrl . "/img/green.png'></span>";
               // } else {
                    //echo "<span style='float: right;'><img style='height:16px;width:16px' src='" . $BaseUrl . "/img/gray.png'></span>";
                //}
               // echo '</div>';
                
            }
        }
    }
    ?>

