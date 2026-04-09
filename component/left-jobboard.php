
    <div class="left_jobboard">
        <?php
        $p = new _spprofiles;
        if($_SESSION['ptid'] == 1 OR $_SESSION['ptid'] == 5){ ?>
            <div class="row no-margin">
                <div class="col-md-4 no-padding ">
                    <?php
                    $result = $p->read($_SESSION['pid']);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        if (isset($row["spProfilePic"])){
                            echo "<img alt='profilepic' class='img-responsive propic center-block' src=' " . ($row["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-responsive img-circle propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    }
                    ?>
                </div>
                <div class="col-md-8 left_freelance_top">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo ucfirst($_SESSION['MyProfileName']) ; ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det">
                            <?php
                            $rpvt = $p->readProfiles($_SESSION["uid"]);
                            //echo $p->ta->sql;
                            if ($rpvt != false){
                                while($row = mysqli_fetch_assoc($rpvt)) {
                                    if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 5){
                                        ?>
                                        <li>
                                            <a id='makedefaultprofile' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >
                                                <img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive"> <?php echo $row['spProfileName'];?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php

        }?>
        <p class="sitename"><a href="<?php echo $BaseUrl.'/job-board/';?>"><i class="fa fa-arrow-left"></i> Back To Home</a></p>
        <!-- 
        <div class="blakjobbox text-center">
            <?php
            $p = new _spprofiles;
            $result = $p->read($_SESSION['pid']);
            if ($result != false) {
                $row = mysqli_fetch_assoc($result);
                if (isset($row["spProfilePic"])){
                    echo "<img alt='profilepic' class='img-responsive img-circle center-block' src=' " . ($row["spProfilePic"]) . "'  >";
                }else{
                    echo "<img alt='profilepic' class='img-responsive center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                }
            }
            ?>
            <h2><?php echo $_SESSION['MyProfileName'];?></h2>
            <p><?php echo ($_SESSION['ptid'] == 1)? 'Administrator': 'Job Seeker';?></p>
        </div>
         -->
        <div class="whitejobbox text-center">
        <?php
        if($_SESSION['ptid'] == 1){ ?>
            <a href="<?php echo $BaseUrl.'/job-board/news.php';?>"><p>Company News</p></a>
            <?php
        }
        ?>
        <a href="<?php echo $BaseUrl.'/job-board/showsavejobs.php';?>"><p>Saved Jobs</p></a>
        </div>
        <div class="m_btm_15">
            <?php
            $limit = 3;
            $p   = new _postingview;
            
            $sql = $p->publicpost_left_company($limit, 2);
            //echo $p->ta->sql;
            
            if($sql){
                while ($sql_res = mysqli_fetch_assoc($sql)) {
                    //my active jobs
                    $result2 = $p->myProfilejobpost($sql_res['idspProfiles']);
                    if($result2){
                        $Myactivejob = $result2->num_rows;
                    }else{
                        $Myactivejob = 0;
                    }?>
                    <div class="leftPostCmpny text-center"> 
                        <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$sql_res['idspProfiles'];?>">
                            <div class="boxGraph">
                                <h2><?php echo $sql_res['spProfileFieldValue'];?></h2>
                                <p><?php echo $Myactivejob;?> posting jobs</p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
                