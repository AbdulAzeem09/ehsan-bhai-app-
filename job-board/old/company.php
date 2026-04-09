<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

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
            $ProjectName    = '';
            $perhour        = '';
            $skill          = '';
            $CmpnyName      = "";
            $CmpnyDesc      = "";
            $CmpSize        = "";
            $YearFounded    = "";


            while($row_fi = mysqli_fetch_assoc($result_fi)){
                if($CmpnyName == ''){
                    if($row_fi['spProfileFieldName'] == 'companyname_'){
                        $CmpnyName = $row_fi['spProfileFieldValue'];
                    }
                }
                if($CmpnyDesc == ''){
                    if($row_fi['spProfileFieldName'] == 'CompanyOverview_'){
                        $CmpnyDesc = $row_fi['spProfileFieldValue'];
                    }
                }
                if($CmpSize == ''){
                    if($row_fi['spProfileFieldName'] == 'CompanySize_'){
                        $CmpSize = $row_fi['spProfileFieldValue'];
                    }
                }
                if($YearFounded == ''){
                    if($row_fi['spProfileFieldName'] == 'yearFounded_'){
                        $YearFounded = $row_fi['spProfileFieldValue'];
                    }
                }
                if($skill == ''){
                    if($row_fi['spProfileFieldName'] == 'skill_'){
                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                        
                    }
                }
            }
        }
    }
   
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
            <div class="container userprofile" id="jobUserDetail">
                <div class="row">
                    <div class="col-md-3">
                        <?php include('../component/left-jobboard.php');?>
                    </div>
                    <div class="col-md-9 no-padding ">
                        <?php 
                        //include('top-job-search.php');
                        
                        ?>
                        <div class="row no-margin profile-detail" style="padding: 15px;">
                            <div class="col-sm-12 no-padding">
                                <div class="row">
                                    <div class="col-md-2">
                                        <?php
                                        if(isset($picture)){
                                            echo "<img  alt='Posting Pic' class='img-responsive freelancerImg' src=' ".($picture)."' >" ;
                                        }else{
                                            echo "<img  alt='Posting Pic' class='img-responsive freelancerImg' src='../img/default-profile.png' >" ;
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-9 freelancer-details no-padding">
                                        <p class="name"><?php echo $CmpnyName;?></p>
                                        <p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $city. ', '.$country; ?></p>
                                        <p><?php echo $CmpnyDesc;?></p>
                                        <div class="professional-skills">
                                            
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
                                </div>

                                <div class="panel panel-primary m_top_15 no-radius">
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul class='nav nav-tabs' id='navtabprofile'>
                                                    <li class="<?php echo (isset($_GET['job']))?'':'active';?>" role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Company Oerview</a></li>
                                                    <li class="<?php if(isset($_GET['job'])){echo "active";}?>" role='presentation'><a href='#aboutshipping'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Job Posted</a></li>
                                                    <li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>News</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    
                                        <!--Testing-->
                                        <div class="tab-content" style="margin-left:10px; margin-right:20px;">
                                            <div role="tabpanel" class="tab-pane <?php echo (isset($_GET['job']))?'':'active';?>  store"  id="aboutstore" >
                                                <h4>Company Overview</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped tbl_profile">
                                                        <tbody>
                                                            
                                                            
                                                            <!--Testing XTRA FIELDS-->
                                                            <?php
                                                            $c = new _profilefield;
                                                            $r = $c->read($profileId);
                                                            if($r != false){
                                                                while($rw = mysqli_fetch_assoc($r)){
                                                                    if($rw["spProfileFieldName"] == 'operatinghours_' || $rw["spProfileFieldName"] == 'skill_'){

                                                                    }else if($rw["spProfileFieldName"] == 'CompanyWebsite_'){
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $rw["spProfileFieldLabel"];?></td>
                                                                            <td><a href="http://<?php echo $rw["spProfileFieldValue"];?>" target="_blank"><?php echo $rw["spProfileFieldValue"];?></a></td>
                                                                        </tr>
                                                                        <?php
                                                                    }else{ ?>
                                                                        <tr>
                                                                            <td><?php echo $rw["spProfileFieldLabel"];?></td>
                                                                            <td><?php echo $rw["spProfileFieldValue"];?></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <div role="tabpanel"  class= "tab-pane <?php if(isset($_GET['job'])){echo "active";}?> store"  id="aboutshipping" >
                                                <h4>Job Posted</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped tbl_jobboard text-center">
                                                        <thead class="">
                                                            <tr>
                                                                <th>Job Title</th>
                                                                <th>Date Posted</th>
                                                                <th>Close Date</th>
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
                                                                        <td><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" ><?php echo $row['spPostingtitle'];?></a></td>
                                                                        <td><?php echo $postDate->format('d-M-Y');?></td>
                                                                        <td><?php echo $expirePostDate->format('d-M-Y');?></td>
                                                                        <td>
                                                                            <a>
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
                                                                            <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="btn btn-success">Detail</a>
                                                                            
                                                                        </td>
                                                                    </tr> <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <div role="tabpanel"  class= "tab-pane returnrefund"  id="aboutreturn" >
                                                <h4>All News</h4>
                                                <?php
                                                $cn = new _company_news;
                                                $result1 = $cn->readMyNews($_GET['cmpyid']);
                                                //echo $cn->ta->sql;
                                                if($result1){
                                                    while ($row = mysqli_fetch_assoc($result1)) { ?>
                                                        <div class="">
                                                            <h3><?php echo $row['cmpanynewsTitle']?></h3>
                                                            <p><?php echo $row['cmpanynewsDesc']?></p>
                                                            <hr>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!--Testing Complete-->
                                
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
