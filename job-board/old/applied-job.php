<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 10;

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
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain" style="min-height: 300px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard text-center">
                                            <thead class="">
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Date Posted</th>
                                                    <th>Applicants</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $m = new  _postingview;
                                                $result = $m->myAppliedJob($_SESSION['pid']);
                                                //$result = $m->myProfilejobpost($_SESSION['pid']);
                                                //echo $m->ta->sql;
                                                if($result){
                                                    while ($row = mysqli_fetch_assoc($result)) { 
                                                        $postDate = new DateTime($row['spPostingDate'])
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['spPostingtitle'];?></td>
                                                            <td><?php echo $postDate->format('d-M-Y');?></td>
                                                            
                                                            <td>
                                                                <span >
                                                                    <?php
                                                                    $ac = new _sppost_has_spprofile;
                                                                    $countAplicant = $ac->job($row["idspPostings"]);
                                                                    if($countAplicant){
                                                                        echo $countAplicant->num_rows;
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $sl = new _shortlist;
                                                                    $chkShortList = $sl->chekShortlist($row["idspPostings"], $_SESSION['pid']);
                                                                    if($chkShortList){
                                                                        echo '<a href="'.$BaseUrl.'/job-board/job-detail.php?postid='.$row["idspPostings"].'" class="btn btn-info">Shortlisted</a>';
                                                                    }else{
                                                                        echo '<a href="'.$BaseUrl.'/job-board/job-detail.php?postid='.$row["idspPostings"].'" class="btn btn-danger">Not Shortlisted</a>';
                                                                    }?>
                                                                                                                            
                                                            </td>
                                                        </tr> <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeat able box end -->
                        

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
