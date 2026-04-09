 
<?php
    $b = array();
    $g = new _spgroup;
    $r = new _spprofilehasprofile;
    $p = new _spprofiles;
    $res = $r->friends_two($_SESSION["pid"]); //As a receiver   
    //echo $r->ta->sql;         
    if ($res != false) {
        while ($rows = mysqli_fetch_assoc($res)) { 

            if ($rows["spProfiles_has_spProfileFlag"] == 1) {
                $p = new _spprofiles;
                $sender = $rows["spProfiles_idspProfileSender"];
                array_push($b, $sender);
            }
        }
    }
    //print_r($b);
    $res = $r->friend_two($_SESSION["pid"]); //As a sender
    //echo $r->ta->sql;
    if ($res != false) {
        while ($rows = mysqli_fetch_assoc($res)) {
            if ($rows["spProfiles_has_spProfileFlag"] != 0) {
                //echo $rows["spProfiles_idspProfilesReceiver"];
                $rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
                if ($rm == "") {
                    array_push($b, $rows["spProfiles_idspProfilesReceiver"]);
                    
                }
            }
        }
    }
    
    $rpvt = $g->members($_GET["groupid"]);
    //echo $p->ta->sql;
    $member = array();
    if($rpvt != false){
        while ($row2 = mysqli_fetch_assoc($rpvt)) {
            array_push($member, $row2['spProfiles_idspProfiles']);
        }
    }
    $count = 0;
    foreach ($b as $key => $value) {
        if(in_array($value, $member)){

        }else{
            
            $result = $p->read($value);
            if ($result != false) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="member_add">
                    <div class="">
                        <?php
                        if(isset($row['spProfilePic'])){
                            echo "<img  alt='profile-Pic' class='img-responsive' src=' " . ($row['spProfilePic']) . "' >";
                        }else{ ?>
                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="img-responsive" alt="" /> <?php
                        }  ?>
                        <h3><?php echo $row["spProfileName"];?></h3>
                        <a href="<?php echo $BaseUrl.'/my-friend/addtogroupmember.php?pid='.$row['idspProfiles'].'&gid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&timeline';?>" class="btn"><i class="fa fa-user"></i> Add Member</a>
                    </div>
                </div>
                <?php
            }
            $count++;
            if($count > 3){
                break;
            }
        }
    }
?>

