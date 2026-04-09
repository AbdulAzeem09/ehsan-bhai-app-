<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    if(isset($_GET['cmpyid']) && $_GET['cmpyid'] > 0){

    }else{
        header('location:'.$BaseUrl.'/job-board');
    }


    if(isset($_GET['cmpyid']) && $_GET['cmpyid'] >0){
        $profileId = $_GET['cmpyid'];
    }else{
        header('location:'.$BaseUrl.'/job-board');
    }
    $p =  new _spprofiles;
    $result = $p->read($profileId);
    //echo $p->ta->sql;
    if($result){
        $row = mysqli_fetch_assoc($result);
        $Title = $row['spProfileName'];
        $country = $row['spProfilesCountry'];
        $city = $row['spProfilesCity'];
        $picture = $row['spProfilePic'];
        $overview = $row['spProfileAbout'];

        $fi = new _profilefield;
        $result_fi = $fi->read($row['idspProfiles']);
        //echo $fi->ta->sql;
        if($result_fi){
            $ProjectName = '';
            $perhour = '';
            $skill = '';
            while($row_fi = mysqli_fetch_assoc($result_fi)){
                if($skill == ''){
                    if($row_fi['spProfileFieldName'] == 'skill_'){
                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                        
                    }
                }
            }
        }
    }
   


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
            <div class="container userprofile" id="jobUserDetail">
                <div class="row">
                    <div class="col-md-3">
                        <?php include('../component/left-jobboard.php');?>
                    </div>
                    <div class="col-md-9 no-padding ">
                        <?php 
                        //include('top-job-search.php');
                        
                        ?>
                        <div class="row bg_white brdr_gray no-margin profile-detail">
                            <div class="col-sm-12 no-padding">
                                <div class="">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <?php
                                            if(isset($picture)){
                                                echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
                                            }else{
                                                echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-9 freelancer-details">
                                            <p class="name"><?php echo $Title;?></p>
                                            <p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $city. ', '.$country; ?></p>
                                        </div>
                                        <div class="col-xs-12 col-sm-offset-2 col-sm-10 nopadding professional-skills">
                                            <div class="col-xs-12 nopadding">
                                                <?php
                                                if(isset($skill) && $skill != ''){
                                                    foreach($skill as $key => $value){
                                                        echo "<span>".$value."</span>";
                                                    }
                                                }else{
                                                    echo "No Sills Define";
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xs-12 overview">
                                            <p class="heading">Overview</p>
                                            <p class="details-description"><?php echo $overview;?></p>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped tbl_profile">
                                                            <tbody>
                                                                
                                                                <tr>
                                                                    <td>Join Sharepage</td>
                                                                    <td>Dec 15, 2016</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Profile Type</td>
                                                                    <td><?php echo $row['spProfileTypeName'];?> Profile</td>
                                                                </tr>
                                                                <!--Testing XTRA FIELDS-->
                                                                <?php
                                                                $c = new _profilefield;
                                                                $r = $c->read($profileId);
                                                                if($r != false){
                                                                    while($rw = mysqli_fetch_assoc($r)){
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $rw["spProfileFieldLabel"];?></td>
                                                                            <td><?php echo $rw["spProfileFieldValue"];?></td>
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

                        <!-- repeat able box -->
                        <div class="whiteboardmain  m_top_15">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard text-center">
                                            <thead class="">
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Date Posted</th>
                                                    <th>Close Date</th>
                                                    <th>Status</th>
                                                    <th>Applicants</th>
                                                    
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $m = new  _postingview;
                                                $result = $m->myProfilejobpost($_GET['cmpyid']);
                                                //echo $m->ta->sql;
                                                if($result){
                                                    while ($row = mysqli_fetch_assoc($result)) { 
                                                        $postDate = new DateTime($row['spPostingDate']);
                                                        $expirePostDate = new DateTime($row['spPostingExpDt']);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['spPostingtitle'];?></td>
                                                            <td><?php echo $postDate->format('d-M-Y');?></td>
                                                            <td><?php echo $expirePostDate->format('d-M-Y');?></td>
                                                            <td>Open</td>
                                                            <td>
                                                                <a class="btn btn-info">
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
                                                                <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="btn btn-success">Apply Now</a>
                                                                
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
