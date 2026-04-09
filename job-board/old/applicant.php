<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    $f = new _spprofiles;
    $sl = new _shortlist;

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
    </head>

    <body class="bg_gray">
        <?php
        include_once("../header.php");
        ?>
        <section class="" style="border-bottom: 2px solid #CCC">
            <div class="container">

                <?php
                    $p = new _postingview;
                    $res = $p->singletimelines($_GET['postid']);
                    //echo $p->ta->sql;
                    if($res){
                        $row = mysqli_fetch_assoc($res);
                        $title      = $row['spPostingtitle'];
                        $overview   = $row['spPostingNotes'];
                        $country    = $row['spPostingsCountry'];
                        $city       = $row['spPostingsCity'];
                        $dt         = new DateTime($row['spPostingDate']);
                        $postingDate    = $p-> spPostingDate($row["spPostingDate"]);
                        $clientId       = $row['idspProfiles'];
                        $postedPerson   = $row['spUser_idspUser'];

                        $c = new _profilefield;
                        $r = $c->read($clientId);
                        if($r != false){
                            $CmpnyName  = "";
                            $CmpnyDesc  = "";
                            $CmpSize    = "";
                            $YearFounded    = "";
                            while($rw = mysqli_fetch_assoc($r)){
                                if($CmpnyName == ''){
                                    if($rw['spProfileFieldName'] == 'companyname_'){
                                        $CmpnyName = $rw['spProfileFieldValue'];
                                    }
                                }
                                if($CmpnyDesc == ''){
                                    if($rw['spProfileFieldName'] == 'CompanyOverview_'){
                                        $CmpnyDesc = $rw['spProfileFieldValue'];
                                    }
                                }
                                if($CmpSize == ''){
                                    if($rw['spProfileFieldName'] == 'CompanySize_'){
                                        $CmpSize = $rw['spProfileFieldValue'];
                                    }
                                }
                                if($YearFounded == ''){
                                    if($rw['spProfileFieldName'] == 'yearFounded_'){
                                        $YearFounded = $rw['spProfileFieldValue'];
                                    }
                                }
                            }
                        }

                        $pf = new _postfield;
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if($result_pf){
                            

                            $skill      = "";
                            $jobType    = "";
                            $jobLevel   = "";
                            $location   = "";
                            $CloseDate  = "";
                            $salaryStrt = "";
                            $salaryEnd  = "";
                            $Experience = "";                            
                            $noOfPos    = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {

                                if($noOfPos == ''){
                                    if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
                                        $noOfPos = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($Experience == ''){
                                    if($row2['spPostFieldName'] == 'spPostingExperience_'){
                                        $Experience = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($salaryEnd == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
                                        $salaryEnd = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($salaryStrt == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
                                        $salaryStrt = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($CloseDate == ''){
                                    if($row2['spPostFieldName'] == 'spPostingClosing_'){
                                        $CloseDate = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($CmpnyName == ''){
                                    if($row2['spPostFieldName'] == 'spPostingCompany_'){
                                        $CmpnyName = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($skill == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                        $skill = explode(',', $row2['spPostFieldValue']);
                                    }
                                }
                                if($jobType == ''){
                                    if($row2['spPostFieldName'] == 'spPostingJobType_'){
                                        $jobType = $row2['spPostFieldValue'];
                                    }
                                }
                                if($jobLevel == ''){
                                    if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
                                        $jobLevel = $row2['spPostFieldValue'];
                                    }
                                }
                                if($location == ''){
                                    if($row2['spPostFieldName'] == 'spPostingLocation_'){
                                        $location = $row2['spPostFieldValue'];
                                    }
                                }

                            }
                            $postingDate = $p-> spPostingDate($row["spPostingDate"]);

                            
                            


                        }
                    } 
                    //total aplicant
                    $ac = new _sppost_has_spprofile;
                    $countAplicant = $ac->job($_GET["postid"]);
                    if($countAplicant){
                        $aplicant = $countAplicant->num_rows;
                    }else{
                        $aplicant = 0;
                    }
                    //total shortlisted
                    $sl = new _shortlist;
                    $countShortList = $sl->getshortlist($_GET["postid"]);
                    if($countShortList){
                        $shrtList = $countShortList->num_rows;
                    }else{
                        $shrtList = 0;
                    }
                    ?>
                  



                <div class="row top_detail_board m_top_20">
                    <div class="col-md-3">
                        <a href="<?php echo $BaseUrl;?>/job-board/all-jobs.php"><i class="fa fa-angle-left"></i> Back to Jobs</a>
                    </div>
                    <div class="col-md-7">
                        <h1><?php echo $title;?></h1>
                        <p class="btmjobtitle">@ <?php echo $CmpnyName;?></p>
                    </div>
                    <div class="col-md-2">
                        <?php
                        if($_SESSION['ptid'] == 1){?>
                            <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a> <?php
                        } ?> 
                        <p class="lightrightjob">Posted <?php echo $postingDate;?></p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-3 no-padding">
                        <div class="left_detail_job">
                            <p><i class="fa fa-briefcase"></i> <?php echo $jobType;?></p>
                            <p><i class="fa fa-clock-o"></i> &nbsp;<?php echo $jobLevel;?></p>
                            <p><i class="fa fa-map-marker"></i> &nbsp;&nbsp;<?php echo $location;?></p>
                            <h3>Skills</h3>
                            <ul>
                                <?php
                                if(count($skill) >0){
                                    foreach($skill as $key => $value){
                                        if($value != ''){
                                            echo "<li><i class='fa fa-tag'></i> ".$value."</li>";
                                        }
                                       
                                    }
                                }
                                ?>
                                
                            </ul>
                           
                            
                            
                        </div>
                        
                    </div>
                    <div class="col-md-9 no-padding">
                        <div class="right_detail_job">
                            <h2>Job Description</h2>
                            <p><?php echo $overview;?></p>
                        </div>
                        <!-- repeat able box -->
                        <div class="whiteboardmain m_top_10">
                            <div class="row top_job_head text-center">
                                <!-- 
                                <div class="col-md-12">
                                    <h1>Offered salary: <?php echo $salaryEnd .' - '.$salaryStrt; ?>  Posted by: <?php echo $CmpnyName; ?></h1>
                                </div>
                                 -->
                                <div class="col-sm-12">
                                    <div class="center-block">
                                        <ul style="width: 90%; margin: 0 auto;height: 50px;border-bottom: 1px solid #CCC;">
                                            <li><?php echo $location;?> <br>Location</li>
                                            <li>|</li>
                                            <li><?php echo $salaryEnd .' - '.$salaryStrt; ?> <br>Average salary</li>
                                            <li>|</li>
                                            <li><?php echo $jobLevel; ?> <br>Job Level</li>
                                            <li>|</li>
                                            <li><?php echo $Experience; ?> <br>Experience</li>
                                            <li>|</li>
                                            <li><?php echo $CloseDate; ?> <br>Closing Date</li>
                                        </ul>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="wizard">
                                        <div class="wizard-inner">
                                            <div class="connecting-line"></div>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation">
                                                    <a href="" >
                                                        <span class="round-tab tab_blue">
                                                            <?php echo $aplicant;?>
                                                        </span>
                                                    </a>
                                                    <p>Applied</p>
                                                </li>
                                                <li role="presentation" >
                                                    <a href="#" >
                                                        <span class="round-tab tab_dark_green">
                                                            <?php echo $shrtList;?>
                                                        </span>
                                                    </a>
                                                    <p>Shortlisted</p>
                                                </li>
                                                <!-- <li role="presentation" >
                                                    <a href="#" >
                                                        <span class="round-tab tab_green">
                                                           <?php echo $noOfPos; ?>
                                                        </span>
                                                    </a>
                                                    <p>Company Positions</p>
                                                </li>
                                                
                                                <li role="presentation" >
                                                    <a href="#">
                                                        <span class="round-tab tab_orange">
                                                            <?php echo $YearFounded;?>
                                                        </span>
                                                    </a>
                                                    <p>Year Founded</p>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        
                        <!-- repeat able box end -->
                        <div class="right_detail_job m_top_10">
                            <div class="title_job">
                                <h2>Applicant's</h2>
                                <div class="space"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped tbl_jobboard text-center">
                                                <thead class="">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Download Cv</th>
                                                        <th>Shortlist</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $ac = new _sppost_has_spprofile;
                                                    $pc = new _postingalbum;

                                                    $result3 = $ac->job($_GET['postid']);
                                                    //echo $ac->ta->sql;
                                                    if($result3){
                                                        while ($row3 = mysqli_fetch_assoc($result3)) { 
                                                            $result4 = $pc->resume($row3['sppostingResume']);
                                                            //echo $pc->ta->sql;
                                                            if ($result4 != false){
                                                                $rw = mysqli_fetch_assoc($result4);
                                                                //create destination and then show it
                                                                $resume = $rw["spPostingMedia"];
                                                                $ext = $rw['sppostingmediaExtension'];
                                                                $previewfile =$rw['sppostingmediaTitle'].$rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";                                                           
                                                                file_put_contents("../resume/".$previewfile, $resume);

                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row3['spProfileName']; ?></td>
                                                                <td>
                                                                    <a href="<?php echo $BaseUrl.'/resume/'.$previewfile; ?>" target="_blank" >Download</a>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $sl = new _shortlist;
                                                                    $result4 = $sl->chekShortlist($_GET['postid'], $row3['spProfiles_idspProfiles']);
                                                                    //echo $sl->ta->sql;
                                                                    if($result4){ ?>
                                                                        <a href="javascript:void(0);">Shortlisted</a> <?php
                                                                    }else{ ?>
                                                                        <a href="<?php echo $BaseUrl.'/job-board/shortlist.php?user='.$row3['spProfiles_idspProfiles'].'&postid='.$row3['spPostings_idspPostings'].'&accept';?>">Shortlist</a> <?php
                                                                    }?>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </section>


        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
