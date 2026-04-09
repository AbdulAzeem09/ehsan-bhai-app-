<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 2;

    $pr     = new _spprofiles;
    $prof   = new _profilefield;

    $result_pr = $pr->mySpeceficAccount(5, $_SESSION['uid']);
    //echo $pr->ta->sql;
    $skillMatch = '';
    if($result_pr){
        while ($row_pr = mysqli_fetch_assoc($result_pr)) {
            $result_prof = $prof->getSkill($row_pr['idspProfiles']);
            //echo $prof->ta->sql;
            if($result_prof){
                $row_prof = mysqli_fetch_assoc($result_prof);
                $skill = $row_prof['spProfileFieldValue'];
                if($skill != ''){
                    $skillMatch = $skillMatch .','. $skill;
                }
            }
        }
    }
    //echo $skillMatch;
     $header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
    </head>

    <body class="bg_gray">
        <?php
        include_once("../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                        include('../component/left-jobboard.php');
                        if($_SESSION['ptid'] == 5){
                            include('left-btm-jobseakr.php');
                        }
                        ?>
                    </div>
                    <div class="col-md-9 no-padding">
                        <?php
                        include('top-job-search.php');
						include('inner-breadcrumb.php');
                        ?>
                        <script>
                            function getjobs(sortby) {
                                $.ajax({
                                    type: "POST",
                                    url: "sortjob.php",
                                    data:'sortby='+ sortby,
                                    success: function(html){
                                        $("#sortjob").html(html);
                                    }
                                });
                            }
                        </script>
                        <div class="whiteboardmain m_btm_15" style="padding: 5px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Total Jobs Posted (<span style="color: #31ace3">
                                        <?php
                                        $sql = $m->alljobposted(2);
                                        if($sql){
                                            echo $sql->num_rows;
                                        }else{
                                            echo 0;
                                        }
                                        ?>
                                    </span>)</h4>
                                </div>
                                <div class="col-md-offset-2 col-md-4 text-right no-padding">
                                    
                                        <div class="form-group no-margin">
                                            <select class="form-control no-radius" onchange="getjobs(this.value);">
                                                <option value="">Sort By</option>
                                                <option value="ASC">ASC</option>
                                                <option value="DESC">DESC</option>
                                                <option value="posted-Date">Posted Date</option>
                                                <option value="closing-Date">Closing Date</option>
                                            </select>
                                        </div>
                                        
                                    
                                </div>
                                <div class="col-md-3 text-right ">
                                    <a  href="<?php echo $BaseUrl.'/job-board/find-a-job.php';?>" style="display: block; padding-right: 5px;" class="btn btn_jobboard" >Advance Search</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 jobseakrhead" id="sortjob">
                                <?php
                                $limit = 4;
                                $p   = new _postingview;
                                $pf  = new _postfield;
                                $res = $p->jobBoard_post(2, $_SESSION['pid']);
                                //$res = $p->publicpost_jobBoard($limit, 2);
                                //echo $p->ta->sql;
                                if($res){
                                    while ($row = mysqli_fetch_assoc($res)) { 
                                        $result_pf = $pf->read($row['idspPostings']);
                                        //echo $pf->ta->sql."<br>";
                                        $closingdate = new DateTime($row['spPostingExpDt']);
                                        if($result_pf){
                                            
                                            $skill = "";
                                            $cmpnyName = "";
                                            $strtSalry = "";
                                            $endSalry = "";
                                            $jobLevel = "";

                                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                // if($closingdate == ''){
                                                //     if($row2['spPostFieldName'] == 'spPostingClosing_'){
                                                //         $closingdate = new DateTime($row2['spPostFieldValue']); 
                                                //     }
                                                // }
                                                if($cmpnyName == ''){
                                                    if($row2['spPostFieldName'] == 'spPostingCompany_'){
                                                        $cmpnyName = $row2['spPostFieldValue'];
                                                    }
                                                }
                                                if($strtSalry == ''){
                                                    if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
                                                        $strtSalry = $row2['spPostFieldValue'];
                                                    }
                                                }
                                                if($endSalry == ''){
                                                    if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
                                                        $endSalry = $row2['spPostFieldValue'];
                                                    }
                                                }
                                                if($skill == ''){
                                                    if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                                        $skill = explode(',', $row2['spPostFieldValue']);
                                                    }
                                                }
                                                if($jobLevel == ''){
                                                    if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
                                                        $jobLevel = $row2['spPostFieldValue'];
                                                    }
                                                }

                                            }
                                            $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                        }
                                        ?>
                                        <!-- repeat able box -->
                                        <div class="whiteboardmain m_btm_15">
                                            <div class="row top_job_head">
                                                <div class="col-sm-12 jobboradlist">
                                                    <h2><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?> </a></h2>
                                                    <h1><?php echo $cmpnyName.' ,'. $row['spPostingsCity']. ','.$row['spPostingsCountry'];?></h1>
                                                    <p>
                                                        <?php
                                                        if(strlen($row['spPostingNotes']) < 400){
                                                            echo $row['spPostingNotes'];
                                                        }else{
                                                            echo substr($row['spPostingNotes'], 0,400);
                                                            
                                                        } ?>
                                                        <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="readmore">...Read More</a>
                                                    </p>
                                                    <?php
                                                    if(count($skill) >0){
                                                        foreach($skill as $key => $value){
                                                            if($value != ''){
                                                                echo "<span class='skills-tags'>".$value."</span>";
                                                            }
                                                           
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                                                        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="footer_job">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Last Date To Apply'><i class="fa fa-calendar"></i> <?php echo $closingdate->format('d-M-Y');?></a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Experience'><i class="fa fa-floppy-o"></i> 2 Years</a>
                                                        </div>
                                                        <div class="col-md-3 text-center">
                                                            <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Salary'><i class="fa fa-money"></i> <?php echo $endSalry.' - '.$strtSalry;?></a>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Job Level'><i class="fa fa-briefcase"></i> <?php echo $jobLevel;?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- repeat able box end -->
                                        <?php
                                    }
                                }else{
									?>
                                    <div class="whiteboardmain" style="min-height: 300px;">
                                        <p>No Jobs Found!</p>
                                    </div>
                                    <?php
								}
                                ?>
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
