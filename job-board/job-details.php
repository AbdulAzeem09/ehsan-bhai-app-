 <div class="imp-links">
                        <div class="top-detail">
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/category.svg" alt="">
                                </span>
                                Category : <?php echo ($jobCategory == '') ? 'Not Define' : $jobCategory; ?>
                            </div>
                            <?php if($jobLevel) { ?>
                                <div class="link">
                                    <span>
                                        <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/level.svg" alt="">
                                    </span>
                                    Level : <span class="skill"><?php echo $jobLevel; ?></span>
                                </div>
                            <?php } ?>
                        
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/type.svg" alt="">
                                </span>
                                Type : Hybrid
                            </div>
                            <div class="link">
                                <span>
                                <img src="<?php echo $BaseUrl; ?>/job-board/assets/svgs/postjob/map.svg" alt="">
                                </span>
                                Company Name : <a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId; ?>"><?php echo $CmpnyName; ?></a>
                            </div>
                            <!--div class="link">
                                <span>
                                <img src="<?php echo $BaseUrl; ?>/job-board/assets/svgs/postjob/map.svg" alt="">
                                </span>
                                Company Size : <?php echo $CmpSize; ?>
                            </div-->
                            <!-- <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/salary-type.svg" alt="">
                                </span>
                                Salary Type : Monthly
                            </div> -->
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                                </span>
                                No of Position : <?php echo ($noOfPos > 0) ? $noOfPos : 'Not Define'; ?>
                            </div>
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                                </span>
                                Closing Date : <?php echo $CloseDate; ?>
                            </div>
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                                </span>
                                Min Experience : <?php echo ($Experience == '') ? 'Not Define' : $Experience . ' Years'; ?>
                            </div>
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/location.svg" alt="">
                                </span>
                                Location : <?php echo $tbl_city4;?>
                            </div>
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/state.svg" alt="">
                                </span>
                                State: <?php echo $statename;?>
                            </div>
                            <div class="link">
                                <span>
                                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/state.svg" alt="">
                                </span>
                                Country : <?php echo $countryname;?>
                            </div>
                        </div>
                        <div class="more-links">
                            <div class="title">
                                Actions
                            </div>
                                <?php
	                             if ($_SESSION['guet_yes'] != 'yes') {
	                             $sj = new _save_job;
	                             $result2 = $sj->chekJobSave($postId, $_SESSION['pid']);
	                             if ($result2) {
	                             if ($result2->num_rows > 0) {
	                             $row2 = mysqli_fetch_assoc($result2);
	                               ?>
                                    <div id="savefun<?php echo $row2['save_id'];  ?>"><a href="javascript:void(0);" onclick="myUnsave('<?php echo $row2['save_id']; ?>')">Unsave</a></div>
                                    <?php
                                    } else { ?>
                                        <div><a href="<?php echo $BaseUrl . '/job-board/savejob.php?postid=' . $postId; ?>">Save</a></div>
                                    </a> 
                                    <?php
                                    }
                                } else { ?>
                                    <div id="savefun<?php echo $postId;  ?>"><a href="javascript:void(0);" onclick="myFun('<?php echo $postId; ?>')">Save</a></div>
                                <?php
                                }
                            }
                            ?>
                            <?php
                            if ($_SESSION['ptid'] != 5) { ?>
                            <div><a href="javascript:openModel('fwdjob', <?php echo $postId;?>);">Forward</a></div>
                            <?php
                            }
                            ?>
                            <div><a href="javascript:void(0);" onclick="printContent('printArea')">Print</a></div>
                            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId; ?>">View Company Detail</a></div>
                            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId . '&job=posted'; ?>">View all jobs</a></div> 
                            <?php
                            if ($_SESSION['pid'] != $clientId) {
                                $sppids = $_SESSION['pid'];
                                $sp = new _flagpost;
                                $spflag = $sp->readflag2($sppids, $postId);
                                if ($spflag != false) { 
                                    if ($_SESSION['guet_yes'] != 'yes') { ?>
                                        <div class="sel_chat" ><a><i class="fa fa-flag" style="color: #035049; font-size: 15px;"></i> &nbsp; Flag this post</a></div>
                                    <?php } ?>
                                    <div id="flags" style="color:red;"></div>
                                <?php
                                } else { ?>
                                    <div><a href="javascript:openModel('flagPost', <?php echo $postId;?>);">Flag This Job</a></div>
                                <?php
                                }
                            }
                            ?>       
                            <!-- <a href="#">Add To Favorite</a> -->
                            <div class="icons-wrapper">            
                                <a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/facebook.svg" alt=""></a>            
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/insta.svg" alt=""></a>           
                                <a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/tweet.svg" alt=""></a>            
                                <a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/whatsapp.svg" alt=""></a>            
                            </div>
                        </div>
                    </div>