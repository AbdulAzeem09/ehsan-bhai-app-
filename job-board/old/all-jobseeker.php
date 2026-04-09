<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $f = new _spprofiles;

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 7;
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
                        
                        <div class="row category_tabs no-margin" id="jobseekrtab">
                            <div class="resp-tabs-container" style="border-top: 0px;" >
                                <div class="col-sm-12 nopadding">
                                    <?php
                                    $result = $f->profileTypePerson(5, $_SESSION['uid']);
                                    //$result = $f->freelancers($_SESSION['uid']);
                                    //echo $f->ta->sql;
                                    if($result){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $fi = new _profilefield;
                                            $result_fi = $fi->read($row['idspProfiles']);
                                            //echo $fi->ta->sql;
                                            if($result_fi){
                                                
                                                $skill = '';
                                                while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                    $pro = new _projecttype;
                                                    $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                    
                                                    if($skill == ''){
                                                        if($row_fi['spProfileFieldName'] == 'skill_'){
                                                            $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                            
                                                        }
                                                    }
                                                }  
                                                ?>
                                                
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 3){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }else{
                                                                    echo "<span>No Skills Define</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$row['idspProfiles'];?>" class="btn jobboard-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <?php
                                            }
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
