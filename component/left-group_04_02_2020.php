    <?php
    $g = new _spgroup;
    if(isset($_GET['groupid'])){
        $result_grp_admin = $g->readgroupAdmin($_GET["groupid"]);
        //echo $g->ta->sql;
        if($result_grp_admin != false){
            $row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
            $admin_Id = $row_grp_admin['idspProfiles'];
            $admin_Name = $row_grp_admin['spProfileName'];
        }
    }
    
    ?>
    <div class="left_grid left_group_gray">
        <?php if(isset($_GET['groupname'])){ ?>
            <h2 class="no_margin"><?php echo $_GET['groupname'] ?></h2> <?php
        }?>
    	
        <ul>
            <li><a href="javascript:void(0);"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/public_icon.png" class="img-responsive" alt="" /><p>Public</p></a></li>
            <li><a href="javascript:void(0);"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/admin_icon_enable.png" class="img-responsive" alt="" /><p>Admin</p></a></li>
            
        </ul>
        <div class="space"></div>
        <ul>
            <li <?php if(isset($_GET['timeline'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&timeline"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/timeline_icon_enable.png" class="img-responsive" alt="" /><p>Timeline</p></a></li>
            <li <?php if(isset($_GET['members'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/member.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&members"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/members_icon_enable.png" class="img-responsive" alt="" /><p>Members</p></a></li>
            <?php
            if ($admin_Id == $_SESSION['pid']) {
                ?>
                <li <?php if(isset($_GET['smsCampaigns'])){echo "class='active_group'"; }?>><a href="<?php echo $BaseUrl?>/grouptimelines/addSms.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&smsCampaigns"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/smscamp_icon_enable.png" class="img-responsive" alt="" /><p>SMS Campaigns</p></a></li>            
                <li <?php if(isset($_GET['emailCampaigns'])){echo "class='active_group'"; }?>><a href="<?php echo $BaseUrl?>/grouptimelines/addEmail.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&emailCampaigns"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/emailcamp_icon_enable.png" class="img-responsive" alt="" /><p>Email Campaigns</p></a></li>
           
                <?php
            }
            ?>
             
            <li <?php if(isset($_GET['disc'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/discussion-board.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&disc"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/discussionboard_icon_enable.png" class="img-responsive" alt="" /><p>Discussion Board</p></a></li>
            <li <?php if(isset($_GET['photo'])){echo "class='active_group'"; }?>><a href="<?php echo $BaseUrl?>/grouptimelines/group-photo.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&photo"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/photos_icon_enable.png" class="img-responsive" alt="" /><p>Photos</p></a></li>
            <li <?php if(isset($_GET['video'])){echo "class='active_group'"; }?>><a href="<?php echo $BaseUrl?>/grouptimelines/group-video.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&video"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/videos_icon__enable.png" class="img-responsive" alt="" /><p>Videos</p></a></li>
            
            <li <?php if(isset($_GET['event'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/group-event.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&event"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/events_icon_enable.png" class="img-responsive" alt="" /><p>Events</p></a></li>
            <li <?php if(isset($_GET['files'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/group-folder.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&files"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/files_icon_enable.png" class="img-responsive" alt="" /><p>Files</p></a></li>            
            <li <?php if(isset($_GET['store'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/group-store.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&store"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/stores_icon_enable.png" class="img-responsive" alt="" /><p>Store</p></a></li>
            <li <?php if(isset($_GET['about'])){echo "class='active_group'"; }?> ><a href="<?php echo $BaseUrl?>/grouptimelines/about.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&about"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/about_icon_enable.png" class="img-responsive" alt="" /><p>About</p></a></li>
        </ul>
        <form class="group_search">
    	  	<div class="form-group">
    	    	<input type="text" class="form-control" placeholder="Search this group" />
    	  	</div>
    	  
    	</form>
    	<h2>Favorites</h2>
        <ul>
            <li><a href=""><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/favpurite_icon.png" class="img-responsive" alt="" /><p>Lego World</p></a></li>
            <li><a href=""><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/favpurite_icon.png" class="img-responsive" alt="" /><p>Nature</p></a></li>
            <li><a href=""><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/favpurite_icon.png" class="img-responsive" alt="" /><p>Photography</p></a></li>
            
        </ul>
    </div>