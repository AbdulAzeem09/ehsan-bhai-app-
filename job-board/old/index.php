<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    

?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/percentage.css">

        <!-- responsive tabs -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/easy-responsive-tabs.css">
        <link href="<?php echo $BaseUrl;?>/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/easy-responsive-tabs.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/dropzone.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/dropzone.min.css">
        <script>
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                autoPlay: true,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 7,
                    nav: false
                  }
                }
              });
                $('#horizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion           
                    width: 'auto', //auto or any width like 600px
                    fit: true,   // 100% fit in a container
                    closed: 'accordion', // Start closed if in accordion view
                    activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                    }
                });
            });
            
        </script>
        
    </head>

    <body class="bg_gray">
        
        <?php
        $header_jobBoard = "header_jobBoard";
        include_once("../header.php");
        ?>
        <section class="jobboard">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-12">
                        <div class="home_top_job">
                            <h1>Its Time TO <img src="<?php echo $BaseUrl;?>/assets/images/jobboard/heart.png" class="img-responsive" alt="heart" /> <span>love</span> Mondays</h1>
                            
                            <?php
                            if($_SESSION['ptid'] == 1){
                                $u = new _spuser;
                                $p_result = $u->isverify($_SESSION['uid']);
                                if ($p_result == 1) {
                                    ?>
                                    <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a>
                                    <?php
                                }
                            } ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="midjob">
            <div class="container">
                <form class="job_search" method="post" action="search.php">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group no-margin">
                                        <input type="text" name="txtJobTitle" class="form-control"  placeholder="Job Title" required="" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group no-margin">
                                        <input type="text" name="txtJobLoc" class="form-control"  placeholder="Location" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group no-margin">
                                        <select class="form-control" name="txtJobLevel" >
                                            <option value="">Select Job Level</option>
                                            <?php
                                                $m = new _masterdetails;
                                                $masterid = 2;
                                                $result = $m->read($masterid);
                                                if($result != false){
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
                                                    }
                                                }
                                            ?>
                                      </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="btnJobSearch" class="btn btn-default">Seaarch</button>
                        </div>
                    
                    </div>
                </form>
            </div>
        </section>
        <section class="landing_page bg_white" style="border-top: 1px solid #CCC">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="dashboardlink" id="jobboardDashHome">
                            <li><a href="<?php echo $BaseUrl.'/job-board/all-jobs.php';?>">Browse all Jobs</a></li>
                            <li><span>|</span></li>
                            <li><a href="<?php echo $BaseUrl.'/job-board/all-jobseeker.php';?>">Browse all Job Seekers</a></li>
                            <li><span>|</span></li>
                            <?php 
                            if($_SESSION['ptid'] == 5 ){ ?>
                                <li><a href="<?php echo $BaseUrl.'/job-board/all-jobs.php';?>">My job account</a></li> <?php
                            }
                            if($_SESSION['ptid'] == 1){ ?>
                                <li><a href="<?php echo $BaseUrl.'/job-board/dashboard.php';?>">My Dashboard</a></li> <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 jobboardleft no-padding">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                          Job Level
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <?php
                                                $m = new _masterdetails;
                                                $masterid = 2;
                                                $result = $m->read($masterid);
                                                if($result != false){
                                                    while($rows = mysqli_fetch_assoc($result)){ ?>
                                                        <li><a href="<?php echo $BaseUrl.'/job-board/search.php?level='.$rows["masterDetails"];?>"><?php echo $rows["masterDetails"];?></a></li>
                                                        <?php
                                                        //echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
                                                    }
                                                }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="<?php echo $BaseUrl.'/job-board/find-a-job.php'?>">Find a job</a>
                                    </h4>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                        <div class="left_main_btm text-center">

                            <img src="<?php echo $BaseUrl;?>/assets/images/jobboard/hiring.png" class="img-responsive center-block">
                            <h4>SINCE 2017.</h4>
                            <p>We’ve connected thousands of creative professionals with great companies and outstanding work opportunities.</p>
                        </div>
                        <div class="space-lg"></div>
                    </div>
                    <div class="col-md-9 bg_white cmp_brdr">
                        <div class="right_main_top">
                            <?php
                            $limit = 4;
                            $p   = new _postingview;
                            $pf  = new _postfield;
                            $res = $p->publicpost_jobBoard($limit, 2);
                            //echo $p->ta->sql;
                            if($res){
                                while ($row = mysqli_fetch_assoc($res)) { 
                                    $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                    //read posting field
                                    $result_pf = $pf->read($row['idspPostings']);
                                    //echo $pf->ta->sql."<br>";
                                    if($result_pf){
                                        $skill = "";
                                        while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                            if($skill == ''){
                                                if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                                    $skill = explode(',', $row2['spPostFieldValue']);
                                                }
                                            }
                                        }
                                        $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                    }
                                    // company profile information
                                    $u = new _profilefield;
                                    $result3 = $u->read($row['idspProfiles']);
                                    if ($result3) {
                                        $cmpnyName = "";
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            if($cmpnyName == ''){
                                                if($row3['spProfileFieldName'] == 'companyname_'){
                                                    $cmpnyName = $row3['spProfileFieldValue']; 
                                                }
                                            }
                                        }
                                    }
                                    // ========================END======================
                                    ?>
                                    <div class="row">
                                        <div class="col-md-1 text-center">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="col-md-1">
                                            <img src="<?php echo $BaseUrl;?>/assets/images/jobboard/plane.png" class="img-responsive" alt="" />
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?>&nbsp;<span>New</span></a></h3>
                                            <p class="desc">@ <?php echo $cmpnyName;?></p>
                                            <?php
                                            //print_r($skill);
                                            if($skill != ''){
                                                if(count($skill) > 0){
                                                    foreach($skill as $key => $value){
                                                        if($value != ''){
                                                            echo "<span>".$value."</span>";
                                                        }
                                                    }
                                                }
                                            }else{
                                                echo "<span>No Skills required!</span>";
                                            }
                                            
                                            ?>
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <h4><?php echo $postingDate;?></h4>
                                            <?php
                                            $rc = new _country; 
                                            $result_cntry = $rc->readCountryName($row['spPostingsCountry']);
                                            if ($result_cntry) {
                                                $row4 = mysqli_fetch_assoc($result_cntry);
                                                $countryName = $row4['country_title'];
                                            }

                                            $rcty = new _city;
                                            $result_cty = $rcty->readCityName($row['spPostingsCity']);
                                            if ($result_cty) {
                                                $row5 = mysqli_fetch_assoc($result_cty);
                                                $cityName = $row5['city_title'];
                                            }
                                            ?>
                                            <p><?php echo $cityName.', '.$countryName;?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            
                            
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <div class="space"></div>
        <section class="bg_white job_search">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 right_left_jobboard">
                        <h1>Trending Companies (<a href="<?php echo $BaseUrl.'/job-board/trend-cmpany.php';?>">View All</a>)</h1>
                        <div class="space-lg"></div>
                        <?php
                        $limitpr = 3;
                        $p = new _postingview;
                        $pro = new _spprofiles;
                        $result3 = $pro->readBusProfiles($limitpr);
                        //echo $pro->ta->sql;
                        if($result3){
                            while ($row3 = mysqli_fetch_assoc($result3)) {

                                //get company
                                $c = new _profilefield;
                                $r = $c->read($row3['idspProfiles']);
                                if($r){
                                    $cmpnyName = '';
                                    $CmpnySize = '';
                                    while ($row4 = mysqli_fetch_assoc($r)) {
                                        if($cmpnyName == ''){
                                            if($row4['spProfileFieldName'] == 'companyname_'){
                                                $cmpnyName = $row4['spProfileFieldValue']; 
                                            }
                                        }
                                        if($CmpnySize == ''){
                                            if($row4['spProfileFieldName'] == 'CompanySize_'){
                                                $CmpnySize = $row4['spProfileFieldValue']; 
                                            }
                                        }
                                    }
                                }else{
                                    $cmpnyName = "Not Define";
                                }

                                //get the total post which is open 
                                $result5 = $p->readOpenJobs($row3['idspProfiles']);
                                //echo $p->ta->sql;
                                if($result5){
                                    $totalJob = $result5->num_rows;
                                }else{
                                    $totalJob = 0;
                                }
                                
                                ?>
                                 <div class="trndpost">
                                    <?php
                                    $result4 = $pro->read($row3['idspProfiles']);
                                    if ($result4 != false) {
                                        $row4 = mysqli_fetch_assoc($result4);
                                        if (isset($row4["spProfilePic"])){
                                            echo "<img alt='profile pic' class='img-responsive' src=' " . ($row4["spProfilePic"]) . "'  >";
                                        }else{
                                            echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                                        }
                                    }
                                    ?>
                                    <div class="">
                                        <p class="titlejob">
                                            <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$row4['idspProfiles'];?>"><?php echo $cmpnyName;?></a> 
                                            <span class="pull-right">
                                                <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$row4['idspProfiles'];?>"><?php echo $totalJob; ?> Position openings </a>
                                            </span>
                                        </p>
                                        <p class="postingng">Company Size: <?php echo ($CmpnySize == '')? "Not Define": $CmpnySize;?></p>
                                    </div>
                                </div><?php
                            }
                        }
                        ?>
                       
                        

                    </div>
                    <div class="col-md-6 right_left_jobboard">
                        <h1>Recent Job Offers (<a href="<?php echo $BaseUrl.'/job-board/all-jobs.php';?>">View All</a>)</h1>
                        <div class="space-lg"></div>
                        <?php
                            $limit = 3;
                            $p   = new _postingview;
                            $pf  = new _postfield;
                            $res = $p->publicpost_jobBoard($limit, 2);
                            //echo $p->ta->sql;
                            if($res){
                                while ($row = mysqli_fetch_assoc($res)) { 
                                    $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                    $exdt = new DateTime($row['spPostingExpDt']);

                                    $result6 = $p->readPostCmpnySize($row['idspPostings']);
                                    // echo $p->ta->sql;
                                    if($result6){
                                        $row6 = mysqli_fetch_assoc($result6);
                                        $CmpnySize = "Over".$row6['spPostFieldValue'];
                                    }else{
                                        $CmpnySize = "Not Define";
                                    }
                                    ?>
                                    <div class="trndpost">
                                        <?php
                                        $result4 = $pro->read($row['idspProfiles']);
                                        if ($result4 != false) {
                                            $row4 = mysqli_fetch_assoc($result4);
                                            if (isset($row4["spProfilePic"])){
                                                echo "<img alt='profile pic' class='img-responsive' src=' " . ($row4["spProfilePic"]) . "' style='display:inline'; >";
                                            }else{
                                                echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='display:inline'; >";
                                            }
                                        }
                                        ?>
                                        
                                        <p class="aplyjob pull-right"><?php echo $exdt->format('d M, Y') ?></p>
                                        <div class="">
                                            <p class="titlejob"><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a> <span class="pull-right">Apply</span></p>
                                            <p class="postingng">Company Size: <?php echo $CmpnySize;?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="jobbox">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-offset-1 col-md-5 no-padding">
                        <div class="blue_left">
                            <h1>Hire an employee</h1>
                            <?php
                            $all = new _spAllStoreForm;
                            $result4 = $all->readContent(2);
                            if ($result4) {
                                $row4 = mysqli_fetch_assoc($result4);
                                echo "<p>".$row4['contDesc']."</p>";
                            }
                            ?>
                            
                            <a href="<?php echo $BaseUrl.'/job-board/all-jobseeker.php';?>" >Hire Today</a>
                        </div>
                    </div>
                    <div class="col-md-5 no-padding">
                        <div class="darkblue_right">
                            <h1>Looking for a job</h1>
                            <?php
                            $all = new _spAllStoreForm;
                            $result4 = $all->readContent(3);
                            if ($result4) {
                                $row4 = mysqli_fetch_assoc($result4);
                                echo "<p>".$row4['contDesc']."</p>";
                            }
                            ?>
                            
                            <a href="<?php echo $BaseUrl.'/job-board/all-jobs.php';?>" >Find Job</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="findCandidate">
            <div class="container">
                <div class="row">
                    <h2>Find your <span>Best Candidate</span> at Sharepage</h2>
                    <div class="col-xs-12 search-freelancer" id="jobboard">
                        <div class="">
                            <p class="desc">Donec tincidunt felis quam, eu tempus purus finibus in. Curabitur hendrerit, odio in viverra interdum, lorem velit scelerisque ipsum, a sagittis ligula leo in dolor. Etiam vestibulum.</p>
                            <div class="col-xs-12 freelancers-ids">
                                <div class="owl-carousel owl-theme">
                                    <?php
                                    $pro = new _spprofiles;
                                    $result7 = $pro->profileTypePerson(5, $_SESSION['uid']);
                                    //echo $pro->ta->sql;
                                    if($result7){
                                        while($rows = mysqli_fetch_assoc($result7)){ ?>
                                            <div class="item">
                                                <div class="freelancer-content">
                                                    <div class="avatar">
                                                        <a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$rows['idspProfiles'];?>">
                                                        <?php 
                                                        $picture = $rows['spProfilePic'];
                                                        if(isset($picture)){
                                                            echo "<img  alt='Posting Pic' class='img-responsive' src=' ".($picture)."' >" ;
                                                        }else{
                                                            echo "<img  alt='Posting Pic' class='img-responsive' src='../img/default-profile.png' >" ;
                                                        }
                                                        
                                                        ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-12 nopadding">
                                                        <h5 class="freelancer-name" id="jobseaker-name"><a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$rows['idspProfiles'];?>"><?php echo $rows["spProfileName"];?></a></h5>
                                                        <?php
                                                        $fi = new _profilefield;
                                                        $result_fi = $fi->getType($rows['idspProfiles']);
                                                        //echo $fi->ta->sql;
                                                        if($result_fi){
                                                            $row_fi = mysqli_fetch_assoc($result_fi);
                                                            $pro = new _projecttype;
                                                            $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                            //echo $pro->ta->sql;
                                                            if($result_pro){
                                                                $row_pr = mysqli_fetch_assoc($result_pro);
                                                                $ProjectName = $row_pr['project_title'];
                                                            }else{
                                                                $ProjectName = "Not Define";
                                                            }
                                                        }else{
                                                            $ProjectName = "Not Define";
                                                        }
                                                        //gettotal skills
                                                        $result_sk = $fi->getSkill($rows['idspProfiles']);
                                                        if($result_sk){
                                                            $row_sk = mysqli_fetch_assoc($result_sk);
                                                            $string_sk = explode(',', $row_sk['spProfileFieldValue']);
                                                            $totalSkil = count($string_sk);
                                                            //print_r($string_sk);
                                                        }else{
                                                            $totalSkil = 0;
                                                        }
                                                        ?>
                                                        <p class="freelancer-designation"><?php echo $ProjectName;?></p>
                                                        <p class="skill-rating">Skills: (<span><?php echo $totalSkil;?> Skills</span>)</p>
                                                        <div class="progress-wrap progress" data-progress-percent="25">
                                                          <div class="progress-bar progress"></div>
                                                        </div>
                                                        <!--<p class="job-success">Job Success <span>70%</span></p>
                                                        <div class="progress-wrap progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                                              <span class="sr-only">70% Complete</span>
                                                            </div>
                                                        </div>-->
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                    

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
