<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 3;
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
                        <?php include('../component/left-jobboard.php');?>
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
                                                    <th>Status</th>
                                                    <th>Applicants</th>
                                                    <th>Shortlisted</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $m = new  _postingview;
                                                //$result = $m->mycatProduct($_GET['categoryid'], $_SESSION['pid']);
                                                $result = $m->myProfilejobpost($_SESSION['pid']);
                                                //echo $m->ta->sql;
                                                if($result){
                                                    while ($row = mysqli_fetch_assoc($result)) { 
                                                        $postDate = new DateTime($row['spPostingDate'])
                                                        ?>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl.'/job-board/applicant.php?postid='.$row['idspPostings'];?>" ><?php echo $row['spPostingtitle'];?></a></td>
                                                            <td><?php echo $postDate->format('d-M-Y');?></td>
                                                            <td>Open</td>
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/job-board/applicant.php?postid='.$row['idspPostings'];?>" >
                                                                    <?php
                                                                    $ac = new _sppost_has_spprofile;
                                                                    $countAplicant = $ac->job($row["idspPostings"]);
                                                                    if($countAplicant){
                                                                        echo $countAplicant->num_rows;
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/job-board/applicant.php?postid='.$row['idspPostings'];?>" >
                                                                    <?php
                                                                    $sl = new _shortlist;
                                                                    $countShortList = $sl->getshortlist($row["idspPostings"]);
                                                                    if($countShortList){
                                                                        echo $countShortList->num_rows;
                                                                    }else{
                                                                        echo 0;
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?postid='.$row['idspPostings'].'&repost=1';?>" class="btn btn-info">Repost</a>
                                                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?postid='.$row['idspPostings'];?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                                <a href="<?php echo $BaseUrl.'/job-board/deletePost.php?postid='.$row['idspPostings'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
