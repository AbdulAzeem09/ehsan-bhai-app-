<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_GET['pid']) && $_GET['pid'] >0){
        $profileId = $_GET['pid'];
    }else{
        header('location:'.$BaseUrl.'/job-board');
    }

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 7;

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
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectdetails userprofile" id="jobUserDetail">

                <p class="back-to-projectlist">
                    
                </p>
                <?php
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
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                        include('../component/left-jobboard.php');
                        if($_SESSION['pid'] != $_GET['pid']){

                            ?>
                            <div class="col-xs-12 contact-marina">
                                <p class="contact-marina-heading">Contact <?php echo $Title;?> to Discuss</p>
                                <div class="col-xs-12 contact-marina-content">
                                    <form method="post" action="addchat.php" >
                                        <input type="hidden" name="chat_date" value="<?php echo date('Y-m-d h:m');?>">
                                        <input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid'];?>" >
                                        <input type="hidden" name="receiver_idspProfiles" value="<?php echo $_GET['pid']; ?>" >
                                        <input type="hidden" name="spProfileType_idspProfileType" value="5" >
                                        
                                        <div class="form-group">
                                          <textarea class="form-control inputField-textarea" name="chat_conversation" placeholder="Message"></textarea>
                                        </div>
                                        <div class="form-group">
                                          <input type="submit" class="form-control inputSubmitField" value="Send Message">
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <?php
                        }
                        ?>
                        <div class="col-xs-12 profileLink">
                            <p>Profile Link</p>
                            <input type="text" name="" class="profileLinkField" value="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$profileId;?>">
                        </div>


                    </div>
                    <div class="col-md-9 no-left-padding">
                        <?php 
                            include('top-job-search.php');
                            include('inner-breadcrumb.php');
                        ?>
                        <div class="col-xs-12 profile-detail">

                            <div class="col-xs-12 col-sm-2 nopadding">
                                <?php
                                if(isset($picture)){
                                    echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
                                }else{
                                    echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
                                }
                                ?>
                            </div>
                            <div class="col-xs-12 col-sm-10 freelancer-details">
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
                                <p class="heading">Overviews</p>
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
                                                    $r = $c->read($_GET["pid"]);
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
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
