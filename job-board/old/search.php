<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    $pr     = new _spprofiles;
    $prof   = new _profilefield;

    if(isset($_POST['btnJobSearch'])){
        if(isset($_POST['txtJobTitle'])){
            $txtJobTitle    = $_POST['txtJobTitle'];
        }else{
            $txtJobTitle = '';
        }
        if(isset($_POST['txtJobCity'])){
            $txtJobCity     = $_POST['txtJobCity'];
        }else{
            $txtJobCity = '';
        }
        if(isset($_POST['txtSalaryFrom'])){
            $txtSalaryFrom = $_POST['txtSalaryFrom'];
        }else{
            $txtSalaryFrom = '';
        }
        if(isset($_POST['txtSalaryTo'])){
            $txtSalaryTo = $_POST['txtSalaryTo'];
        }else{
            $txtSalaryTo = '';
        }

        if(isset($_POST['txtJobLoc'])){
            $txtJobLoc      = $_POST['txtJobLoc'];
        }else{
            $txtJobLoc = '';
        }
        if(isset($_POST['txtJobLevel'])){
            $txtJobLevel    = $_POST['txtJobLevel'];
        }else{
            $txtJobLevel = '';
        }

    }else if(isset($_POST['btndashboard'])){

        if(isset($_POST['txtYear'])){
            $txtSearchYear    = $_POST['txtYear'];
        }else{
            $txtSearchYear = '';
        }
        if(isset($_POST['txtMonth'])){
            $txtMonth     = $_POST['txtMonth'];
        }else{
            $txtMonth = '';
        }
        $monthofpost = "";
        $i = 1;
		
        foreach($_POST['txtMonth'] as $value){
            if($i == 1){
                $monthofpost = $monthofpost . "month(t.spPostingDate) = ".$value;
            }else{
                $monthofpost = $monthofpost . " OR month(t.spPostingDate) = ".$value;
            }
            $i++;
        }
        //echo $monthofpost;

    }else{
        
        if(isset($_GET['level']) && $_GET['level'] != ''){
            $txtJobLevel = $_GET['level'];
            $txtJobTitle = '';
            $txtJobCity = '';
            $txtJobLoc = '';
        }


    }
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
                        <?php include('../component/left-jobboard.php');?>
                    </div>
                    <div class="col-md-9 no-padding">
                        <?php
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        <div class="row">
                            <div class="col-sm-12 jobseakrhead">
                                <?php
                                $limit = 4;
                                $p   = new _postingview;
                                $pf  = new _postfield;
                                if(isset($_POST['btndashboard'])){
                                    //echo $txtSearchYear;
                                    $ress = $p->monthwise($txtSearchYear, $monthofpost);
                                }else{
                                    $ress = $p->readJobSearch(2, $txtJobTitle,$txtJobCity, $txtJobLoc, $txtJobLevel,$txtSalaryFrom, $txtSalaryTo);    
                                }
                                
                                //$res = $p->publicpost_skill(2, $_SESSION['pid'], $skillMatch);
                                //$res = $p->publicpost_jobBoard($limit, 2);
                                //echo $p->ta->sql;
                                if($ress){
                                    while ($row = mysqli_fetch_assoc($ress)) { 
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
                                                    if($skill != ''){
                                                        if(count($skill) >0){
                                                            foreach($skill as $key => $value){
                                                                if($value != ''){
                                                                    echo "<span class='skills-tags'>".$value."</span>";
                                                                }
                                                               
                                                            }
                                                        }
                                                    }else{
                                                        echo "<span class='skills-tags'>No skill define</span>";
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
                                    echo "<div class='whiteboardmain' style='min-height: 300px;'>No results found.</div>";
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
