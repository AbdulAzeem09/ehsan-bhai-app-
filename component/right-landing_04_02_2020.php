    <?php

    //====================
    //my friend list
    //====================
    //sender
    $f = new _spprofilehasprofile;
    $totalFrnd = array();
    $result3 = $f->readallfriend($_SESSION['pid']);
    if($result3 != false){
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
        }
    }
    //receiver
    $result4 = $f->readall($_SESSION['pid']);
    if($result4 != false){
        while ($row4 = mysqli_fetch_assoc($result4)) {
            array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
        }
    }
    //print_r($totalFrnd);
    if(!empty($totalFrnd)){
        $totalFriendsofId = count($totalFrnd);
    }else{
        $totalFriendsofId = 0;
    }
    //====end my frnd list 
    ?>
    <div class="row">
        <div class="col-md-12">
            
            <div class="right_box_timeline">
                <h2><a class="links" href="<?php echo $BaseUrl.'/my-friend';?>">My Friends (<?php echo $totalFriendsofId;?>)</a><span class="pull-right"><a data-toggle="collapse" href="#collapse1">Show all <img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/dropdown_arrow_black.png" class="img-responsive" /></a></span></h2>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body no-padding">
                                
                                <div class="rightscrooler">                                    
                                    <?php
                                    if ($totalFriendsofId > 0) {
                                        foreach ($totalFrnd as $key => $frndId) { 
                                            //echo $frndId."<br>";
                                            $profileid = $frndId;
                                            $f = new _spprofiles;
                                            $res = $f->read($profileid);
                                            //echo $f->ta->sql;
                                            if($res != false){
                                                $row = mysqli_fetch_array($res);
                                                $profileIdRight = $row['idspProfiles'];
                                                $NameRight = $row['spProfileName'];
                                                $pict = $row['spProfilePic'];
                                                $profileNote = $row['spProfileAbout'];
                                                //$SubDate = $row['spProfileSubscriptionDate'];
                                                $dt = new DateTime($row['spProfileSubscriptionDate']);
                                            }?>
                                            <div class="row m_top_20 news_feed no-margin">
                                                <div class="col-md-3 no-padding">
                                                    <?php
                                                    if (isset($pict)) {
                                                        echo "<img alt='profilepic'  class='img-responsive' src=' " . ($pict) . "'>";
                                                    }else{
                                                        echo "<img alt='profilepic'  class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                                                    } ?>
                                                </div>
                                                <div class="col-md-9 no-padding join_timeline_main">
                                                    <h4><a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileIdRight;?>"><?php echo $NameRight;?></a></h4>
                                                    
                                                </div>
                                            </div> <?php                                            
                                        }
                                    }else{
                                        ?>
                                        <p style="margin-top: 15px;">No record available</p>
                                        <?php
                                    }
                                    
                                    ?>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="right_box_timeline ">
                <h2><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/stores_icon_ad.png" class="img-responsive" alt="" /> Stores <span class="pull-right"><a href="<?php echo $BaseUrl;?>/store/">See All</a></span></h2>
                <div id="carousel-example-generic" class="carousel slide carousel-fade"><!-- SLIDER START -->
                    <div class="carousel-inner" role="listbox" >
                        <?php
                        $active = 0;
                        for($i = 0; $i <= 5; $i++){
                            ?>
                            <div class="item <?php echo ($active == 0)? 'active': '';?>"  >
                                <?php
                                $count = 0;
                                $p = new _postingview;
                                $query = $p->publicpost_two();
                                //echo $p->ta->sql;
                                if($query != false){
                                    while ($row_store = mysqli_fetch_assoc($query)) {
                                        $dt = new DateTime($row_store['spPostingExpDt']);
                                        if($count == 0){
                                            ?>
                                            <div class="row m_top_20" style="">
                                                <div class="col-md-4 store_img">
                                                    <?php
                                                    $pic = new _postingpic;
                                                    $result_pic = $pic->read($row_store['idspPostings']);
                                                    //echo $pic->ta->sql;
                                                    if ($row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
                                                        if ($result_pic != false) {
                                                            $rp = mysqli_fetch_assoc($result_pic);
                                                            $picture = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        } else
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }else{
                                                        if ($result_pic != false) {
                                                            $rp = mysqli_fetch_assoc($result_pic);
                                                            $picture = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        } else
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    } ?>
                                                    
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    <?php
                                                    if(!empty($row_store['spPostingtitle'])){
                                                        if(strlen($row_store['spPostingtitle']) < 15){
                                                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingtitle']; ?>"><?php echo $row_store['spPostingtitle']; ?></a></h3><?php
                                                            
                                                        }else{
                                                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingtitle']; ?>"><?php echo substr($row_store['spPostingtitle'], 0,15).'...'; ?></a><h3><?php
                                                        }
                                                    }else{
                                                        ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>">No-Title</a><h3><?php
                                                    }
                                                    ?>
                                                    
                                                    <h5>
                                                        <?php
                                                        if ($row_store['spPostingPrice'] != false) {
                                                            echo $row_store['spPostingPrice'] . " Dollar";
                                                        }else{
                                                            echo "Expires on ".$row_store['spPostingExpDt'];
                                                        }
                                                        ?>
                                                        <br>
                                                        <?php echo $dt->format('d M'); ?> @ <?php echo $row_store['spPostingsCity']; ?>
                                                    </h5>
                                                    <a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $row_store['idspProfiles']?>" class="green_clr">by <?php echo $row_store['spProfileName'];?></a>
                                                    <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" class="chat_timeline btn">View</a>

                                                </div>
                                            </div>
                                            <?php
                                            $count = 1;
                                        }else{
                                            ?>
                                            <div class="row m_top_20" style="">
                                                <div class="col-md-4 store_img">
                                                    <?php
                                                    $pic = new _postingpic;
                                                    $result_pic = $pic->read($row_store['idspPostings']);
                                                    //echo $pic->ta->sql;
                                                    if ($row_store['idspCategory'] != 5 && $row_store['idspCategory'] != 2) {
                                                        if ($result_pic != false) {
                                                            $rp = mysqli_fetch_assoc($result_pic);
                                                            $picture = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        } else
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }else{
                                                        if ($result_pic != false) {
                                                            $rp = mysqli_fetch_assoc($result_pic);
                                                            $picture = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        } else
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    } ?>
                                                    
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    <?php
                                                    if(!empty($row_store['spPostingtitle'])){
                                                        if(strlen($row_store['spPostingtitle']) < 15){
                                                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingtitle']; ?>"><?php echo $row_store['spPostingtitle']; ?></a></h3><?php
                                                            
                                                        }else{
                                                            ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row_store['spPostingtitle']; ?>"><?php echo substr($row_store['spPostingtitle'], 0,15).'...'; ?></a><h3><?php
                                                        }
                                                    }else{
                                                        ?><h3><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>">No-Title</a><h3><?php
                                                    }
                                                    ?>
                                                    
                                                    <h5>
                                                        <?php
                                                        if ($row_store['spPostingPrice'] != false) {
                                                            echo $row_store['spPostingPrice'] . " Dollar";
                                                        }else{
                                                            echo "Expires on ".$row_store['spPostingExpDt'];
                                                        }
                                                        ?>
                                                        <br>
                                                        <?php echo $dt->format('d M'); ?> @ <?php echo $row_store['spPostingsCity']; ?>
                                                    </h5>
                                                    <a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $row_store['idspProfiles']?>" class="green_clr">by <?php echo $row_store['spProfileName'];?></a>
                                                    <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='. $row_store['idspPostings']; ?>" class="chat_timeline btn">View</a>

                                                </div>
                                            </div>
                                            <?php
                                            $count = 0;
                                        }
                                    }    ?>
                                   <?php
                                }    
                                ?>
                            </div>
                            <?php
                            $active++;
                        } ?>     
                    </div>
                </div><!-- SLIDER END -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="right_box_timeline gropHeight">
                <h2><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/group_icon_ad.png" class="img-responsive" alt="" /> Groups <span class="pull-right"><a href="<?php echo $BaseUrl?>/my-groups/">See All</a></span></h2>
                
                <div id="carousel-example-group" class="carousel slide carousel-fade">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $active2 = 0;
                        for($i = 1; $i<= 2; $i++){
                            $g = new _spgroup;
                            $result9 = $g->publicgroup_two();
                            //echo $g->ta->sql;
                            if ($result9 != false) { ?>
                                <div class="item <?php echo ($active2 == 0)? 'active' : '';?>" >
                                    <?php
                                    $count_box = 0;
                                    $count_g = 0;
                                    while($row5 = mysqli_fetch_assoc($result9)){
                                        $result6 = $g->public_not_join($row5['idspGroup'], $_SESSION['pid']);
                                        if($result6 == false && $count_g < 2){
                                            //echo $row9['idspGroup'];
                                            $result2 = $g->groupdetails($row5['idspGroup']);
                                            if ($result2 != false) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $gdes = $row2["spGroupAbout"];
                                                $gimage = $row2["spgroupimage"];
                                            }
                                            //GET ADMIN  NAME OR IMAGE
                                            $rpvt = $g->members($row5['idspGroup']);
                                            //echo $g->ta->sql;
                                            if ($rpvt != false) {
                                                while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                    if ($row3['spProfileIsAdmin'] == 0) {
                                                        $spProfilePic = $row3['spProfilePic'];
                                                        $Group_Admin_Name = $row3['spProfileName'];
                                                    }
                                                }
                                            }

                                            if($count_box == 0){
                                                ?>
                                                <div class="row m_top_20">
                                                    <div class="col-md-4 right_grp">
                                                        <?php
                                                        if($gimage == ""){ ?>
                                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-circle" alt="" /><?php
                                                        }else{ ?>
                                                            <img src="<?php echo ($gimage); ?>" class="img-circle" alt="" /><?php
                                                        } ?>
                                                    </div>
                                                    <div class="col-md-8 no-padding-left join_timeline_main grp_min_height_80">
                                                        <button class="join_timeline btn" data-pid="<?php echo $_SESSION['pid'];?>" data-gid="<?php echo $row5['idspGroup']; ?>" id="addmemontimeline" >&nbsp;Join&nbsp;</button>
                                                        
                                                        <h3><?php echo $row5['spGroupName'];?></h3>
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
                                                        <h5><?php echo $total_member;?> members · <?php echo $new_tot_member;?> new members</h5>
                                                        <p><?php
                                                            if (strlen($gdes) > 50) {
                                                                // truncate string
                                                                $stringCut = substr($gdes, 0, 50);
                                                                // make sure it ends in a word so assassinate doesn't become ass...
                                                                echo substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                                            }else{
                                                                echo $gdes;
                                                            } ?>
                                                        </p>

                                                    </div>
                                                </div>
                                                <?php

                                                $count_box = 1;
                                            }else{
                                                ?>
                                                <div class="row m_top_20">
                                                    <div class="col-md-4 right_grp">
                                                        <?php
                                                        if($gimage == ""){ ?>
                                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-circle" alt="" /><?php
                                                        }else{ ?>
                                                            <img src="<?php echo ($gimage); ?>" class="img-circle" alt="" /><?php
                                                        } ?>
                                                        
                                                    </div>
                                                    <div class="col-md-8 no-padding-left join_timeline_main grp_min_height_80">
                                                        <button class="join_timeline btn" data-pid="<?php echo $_SESSION['pid'];?>" data-gid="<?php echo $row5['idspGroup']; ?>" id="addmemontimeline" >+1 Join</button>
                                                        
                                                        <h3><?php echo $row5['spGroupName'];?></h3>
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
                                                        <h5><?php echo $total_member;?> members · <?php echo $new_tot_member;?> new members</h5>
                                                        <p><?php
                                                            if (strlen($gdes) > 50) {
                                                                // truncate string
                                                                $stringCut = substr($gdes, 0, 50);
                                                                // make sure it ends in a word so assassinate doesn't become ass...
                                                                echo substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                                            }else{
                                                                echo $gdes;
                                                            } ?>
                                                        </p>

                                                    </div>
                                                </div>
                                                <?php

                                                $count_box = 0;
                                            }
                                            $count_g++;
                                            $active2++;
                                        }
                                    } ?>
                                </div> <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="right_box_timeline">
                <h2><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/event_icon_ad.png" class="img-responsive" alt="" /> Events <span class="pull-right"><a href="<?php echo $BaseUrl?>/events/">See All</a></span></h2>
                <div id="carousel-example-event" class="carousel slide carousel-fade">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $active3 = 0;
                        for($i = 0; $i< 2; $i++){
                            ?>
                            <div class="item <?php echo ($active3 == 0)?'active':'';?>" >
                               <?php

                                //SHOW EVENTS ON SPECEFIC PEOPELE
                                $p = new _postingview;
                                $res_eve = $p->publicpost_two_event();
                                //echo $p->ta->sql;
                                if ($res_eve) {
                                    while ($row3 = mysqli_fetch_assoc($res_eve)) { ?>
                                        <div class="row m_top_20">
                                            <div class="col-md-4 even_ban">
                                                <?php
                                                $pic = new _postingpic;
                                                $result_pic = $pic->read($row3['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($row3['idspCategory'] == 9) {
                                                    if ($result_pic != false) {
                                                        $rp = mysqli_fetch_assoc($result_pic);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-circle' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-circle'>";
                                                }?>
                                                                                
                                            </div>
                                            <div class="col-md-8 no-padding-left join_timeline_main">
                                                <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='. $row3['idspPostings']; ?>" class="icon-right pull-right"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/tick.png" class="img-responsive" alt=""></a>
                                                <h3><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='. $row3['idspPostings']; ?>"><?php echo $row3['spPostingtitle']?></a></h3>
                                                <h5>399 Members</h5>
                                                <p><?php
                                                    if (strlen($row3['spPostingNotes']) > 100) {
                                                        // truncate string
                                                        $stringCut = substr($row3['spPostingNotes'], 0, 100);
                                                        // make sure it ends in a word so assassinate doesn't become ass...
                                                        echo substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                                    }else{
                                                        echo $row3['spPostingNotes'];
                                                    } ?>
                                                </p>
                                            </div>
                                        </div> <?php
                                    }
                                }
                                
                                ?>

                              

                            </div> 
                            <?php
                            $active3++;
                        }
                        ?>
                        
                             
                    </div>
                
                </div>
                

            </div>
        </div>
    </div>
    
