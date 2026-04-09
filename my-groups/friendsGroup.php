
    <div class="row no-margin">
        <?php
        $r = new _spprofilehasprofile;
       $res = $r->friends($_SESSION["uid"]);
 //$res = $r->readall($_SESSION["pid"]);

        //As a receiver
        //echo $r->ta->sql;
         //echo "here";
        //echo "<pre>";
               // print_r($res);


   

        if($res != false){
            while ($row4 = mysqli_fetch_assoc($res)) {

                 

                $g = new _spgroup;
                //$result = $g->groupmember($_SESSION['uid']);
                //show all group through spprofile
                $result5 = $g->group($row4['spProfiles_idspProfileSender']);
              //  echo $g->ta->sql;
                

                if ($result5 != false) {
                    
                    while($row5 = mysqli_fetch_assoc($result5)){
                        $result6 = $g->groupmember($_SESSION['uid']);
                        if($result6 != false){
                            $i = 0;
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                if($row5['idspGroup'] == $row6['idspGroup']){
                                    $i++;
                                }
                            }
                            //IF GROUP IS NOT FOUND THEN SHOW IT;
                            if($i == 0){
                                    $result2 = $g->groupdetails($row5['idspGroup']);
                                    if ($result2 != false) {
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $gdes = $row2["spGroupAbout"];
                                        $gimage = $row2["spgroupimage"];
                                    }
                                    //GET ADMIN  NAME OR IMAGE
                                    $rpvt = $g->members($row['idspGroup']);
                                    //echo $g->ta->sql;
                                    if ($rpvt != false) {
                                        while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                            if ($row3['spProfileIsAdmin'] == 0) {
                                                $spProfilePic = $row3['spProfilePic'];
                                                $Group_Admin_Name = $row3['spProfileName'];
                                            }
                                        }
                                    }
									if($row5['spgroupstatus']==0){
                                ?>
                                <div class="col-md-4 no-padding">
                                    <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row5['idspGroup']?>&groupname=<?php echo $row5['spGroupName']?>&timeline" >
                                    <div class="main_grop_box bg_brown_dark">
                                        <?php
                                        if($gimage == ""){ ?>
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-responsive group_banner" alt="" /><?php
                                        }else{ ?>
                                            <img src="<?php echo ($gimage); ?>" class="img-responsive group_banner" alt="" /><?php
                                        } 

                                        if($spProfilePic != ""){?>
                                            <img src="<?php echo ($spProfilePic);?>" class="img-circle group_create" alt="" /> <?php
                                        }else{?>
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="img-circle group_create" alt="" /> <?php
                                        } ?>
                                        
                                        <h4><?php echo $Group_Admin_Name;?></h4>
                                        <h2><?php echo ucwords(strtolower($row5['spGroupName']));?></h2>
                                        <?php
                                        //count member old and new
                                        $result3 = $g->allgrpmember($row5['idspGroup']);
                                        $total_member = mysqli_num_rows($result3);
                                        $result4 = $g->newgrpmember($row5['idspGroup']);
                                        //echo $g->tad->sql;
                                        if(!empty($result4)){
                                            $new_tot_member = mysqli_num_rows($result4);
                                        }else{
                                            $new_tot_member = 0;
                                        }
                                        ?>
                                        <h6><?php echo $total_member;?>   <?php
if($total_member>1){
	echo "members";
}
else{
		echo "member";
}?>  <?php echo $new_tot_member;?> new members</h6>
                                        <span class="btn pull-right btn_gray_light"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_multi_user_btn.png" class="img-responsive" alt="" />Timeline</span>
                                        
                                        
                                        
                                    </div>
                                    </a>
                                </div>
									<?php }
                            }
                            //echo $i."=============".$row5['idspGroup']."<br>";
                        }
                    }
                }
            }
        }else{
            echo "<p class='text-center'>Friend group not available.</p>";
        }
        ?>
    </div>
    <div class="space"></div>
