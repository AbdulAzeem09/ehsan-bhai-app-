
    <div class="left_grid left_group_black" >
        <ul>
            <li><strong>
                <a href="<?php echo $BaseUrl;?>/profile/">
                    <?php
                        $p = new _spprofiles;
                        $result = $p->read($_SESSION['pid']);
                        if ($result != false) {
                            $row = mysqli_fetch_assoc($result);
                            if (isset($row["spProfilePic"]))
                                echo "<img alt='profilepic' class='img-circle img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
                            else
                                echo "<img alt='profilepic' class='img-circle' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                        }
                    ?>
                    
                    <p><?php echo (isset($_SESSION['myprofile']) ? ucwords(strtolower($_SESSION['myprofile'])) : "Profile "); ?></p>
                </a>
            </strong></li>
            <li><a href="<?php echo $BaseUrl;?>/dashboard/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/sm_dashboard.png" class="img-responsive" alt="" /><p>Dashboard</p></a></li>
            <li><a href="<?php echo $BaseUrl;?>/profile/index.php?favourite"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/sm_favourite.png" class="img-responsive" alt="" /><p>Favorites</p></a></li>
            <li><a href="<?php echo $BaseUrl;?>/friendmessage/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/messenger.png" class="img-responsive" alt="" /><p>Messenger</p></a></li>
        </ul>
        <h2>Explore</h2>
        <?php
        $as = new _spAllStoreForm;
        $result_as = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);
        if ($result_as) {
            $row = mysqli_fetch_assoc($result_as);
            $freelance = $row['freelance'];
            $jobboard = $row['jobboard'];
            $realestate = $row['realestate'];
            $event = $row['event'];
            $art = $row['art'];
            $music = $row['music'];
            $videos = $row['videos'];
            $trainings = $row['trainings'];
            $directory = $row['directory'];
            $groups = $row['groups'];
        }else{
            $freelance = 0;
            $jobboard = 0;
            $realestate = 0;
            $event = 0;
            $art = 0;
            $music = 0;
            $videos = 0;
            $trainings = 0;
            $directory = 0;
        }
        ?>
        <ul>
            <li class=""><a href="<?php echo $BaseUrl;?>/store/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/stores.png" class="img-responsive" alt="" /><p>Stores</p></a></li>
            <li class="<?php echo ($freelance == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/freelancer/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/freelancer.png" class="img-responsive" alt="" /><p>Freelancer</p></a></li>
            <li class="<?php echo ($jobboard == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/job-board/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/jobboard_icon.png" class="img-responsive" alt="" /><p>Job Board</p></a></li>
            <li class="<?php echo ($realestate == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/real-estate/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/real-estate.png" class="img-responsive" alt="" /><p>Real Estate</p></a></li>
            <li class="<?php echo ($event == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/events/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/events_icon.png" class="img-responsive" alt="" /><p>Events</p></a></li>
            <li class="<?php echo ($art == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/photos/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/art_gallery_icon.png" class="img-responsive" alt="" /><p>Art Gallery</p></a></li>
            <li class="<?php echo ($music == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/music/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/music.png" class="img-responsive" alt="" /><p>Music</p></a></li>
            <li class="<?php echo ($videos == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/videos/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/videos.png" class="img-responsive" alt="" /><p>Video</p></a></li>
            <li class="<?php echo ($trainings == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/trainings/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/training.png" class="img-responsive" alt="" /><p>Trainings</p></a></li>
            <li><a href="<?php echo $BaseUrl;?>/services/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/classified-ads.png" class="img-responsive" alt="" /><p>Classified ads</p></a></li>
            <li class="<?php echo ($directory == 1)?'hidden':''; ?>" ><a href="<?php echo $BaseUrl;?>/business-directory/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/services.png" class="img-responsive" alt="" /><p>Directory Services</p></a></li>
            <li class="<?php echo ($groups == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/my-groups/"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/groups.png" class="img-responsive" alt="" /><p>Groups</p></a></li>
            <li class="<?php echo ($groups == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/my-groups/campaign.php?email=email"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/email-campaign.png" class="img-responsive" alt="" /><p>Email Campaigns</p></a></li>
            <li class="<?php echo ($groups == 1)?'hidden':''; ?>"><a href="<?php echo $BaseUrl;?>/my-groups/campaign.php?sms=sms"><img src="<?php echo $BaseUrl;?>/assets/images/icon/home/sms-campaigns.png" class="img-responsive" alt="" /><p>SMS Campaigns</p></a></li>
            
        </ul>
        <!--
            HIDE FOR SOME TIME
        <h2>Create</h2>
        <div class="create_link">
            <a href="#">Advert</a> . <a href="#">Group</a> . <a href="#">Folder</a> . <a href="#">Event</a> . <a href="#">xyz</a>
        </div>
    -->
    </div>
