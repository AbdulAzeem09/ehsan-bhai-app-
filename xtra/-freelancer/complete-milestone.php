<?php 
    include('../univ/baseurl.php');
    session_start();
    //session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p = new _postingview;
    $res = $p->singletimelines($_GET['postid']);
    //echo $p->ta->sql;
    if($res){
        $row = mysqli_fetch_assoc($res);
        $projectpostid = $row['idspProfiles'];
        if($_SESSION['pid'] != $row['idspProfiles']){

            //header('location:'.$BaseUrl.'/freelancer');
        }
        $title = $row['spPostingtitle'];
    }else{
        header('location:'.$BaseUrl.'/freelancer');
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
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-md-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/archive-project.php">ARCHIVE PROJECT</a></li>
                              <li><?php echo $title;?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 nopadding dashboard-section">
                       
                        <div class="">
                            <?php
                            $p = new _postingview;
                            $res = $p->singletimelines($_GET['postid']);
                            //echo $p->ta->sql;
                            if($res){
                                $row = mysqli_fetch_assoc($res);
                                $title = $row['spPostingtitle'];
                                $overview = $row['spPostingNotes'];
                                $country = $row['spPostingsCountry'];
                                $city = $row['spPostingsCity'];
                                $price = $row['spPostingPrice'];
                                $dt = new DateTime($row['spPostingDate']);
                                $member = new DateTime($row['spProfileSubscriptionDate']);
                                $clientId = $row['idspProfiles'];

                                $pf = new _postfield;
                                
                                $result_pf = $pf->read($row['idspPostings']);
                                //echo $pf->ta->sql."<br>";
                                if($result_pf){
                                    $closingdate = "";
                                    $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";
                                    $projectType = "";

                                    while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                        if($closingdate == ''){
                                            if($row2['spPostFieldName'] == 'spClosingDate_'){
                                                $closingdate = $row2['spPostFieldValue']; 
                                            }
                                        }
                                        if($Fixed == ''){
                                            if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                                                if($row2['spPostFieldValue'] == 1){
                                                    $Fixed = "Fixed";
                                                }
                                            }
                                        }
                                        if($Category == ''){
                                            if($row2['spPostFieldName'] == 'spPostingCategory_'){
                                                $Category = $row2['spPostFieldValue']; 
                                            }
                                        }
                                        if($hourly == ''){
                                            if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
                                                if($row2['spPostFieldValue'] == 1){
                                                    $hourly = "Rate Per hour";
                                                }
                                            }
                                        }
                                        if($skill == ''){
                                            if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                                $skill = explode(',', $row2['spPostFieldValue']);
                                            }
                                        }
                                        if($projectType == ''){
                                            if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
                                                $projectid = $row2['spPostFieldValue'];
                                            }
                                        }

                                    }
                                    $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                }
                            } ?>
                            <div class="col-xs-12 freelancer-post-detail">
                                <h2 class="designation-haeding"><?php echo $title;?></h2>
                                <p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
                                <div class="col-xs-12 nopadding">
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
                                <div class="col-xs-12 nopadding margin-top-13">
                                    <div class="col-xs-12 col-sm-6 nopadding">
                                        <div class="col-xs-2 col-sm-1 nopadding">
                                            <img src="<?php echo $BaseUrl?>/assets/images/Freelancer/timer.png">
                                        </div>
                                        <div class="col-xs-10 col-sm-11 nopadding">
                                            <p><span class="time-level">Category</span>
                                            </p>
                                            <p class="time-level-detail"><?php echo $Category;?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 nopadding">
                                        <div class="col-xs-2 col-sm-1 nopadding">
                                            <i class="fa fa-map-marker" style="font-size: 20px;"></i>
                                        </div>
                                        <div class="col-xs-10 col-sm-11 nopadding">
                                            <p><span class="time-level">Location</span>
                                            </p>
                                            <p class="time-level-detail"><?php echo $city.', '.$country;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 detail-description text-justify">
                                    <p><?php echo $overview;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $fm = new _freelance_milestone;
                    $result = $fm->readMymilestone($_GET['postid']);
                    if($result){
                        ?>
                        <h2>Milestone</h2>
                        <div class="col-md-12 nopadding dashboard-section">
                            <div class="table-responsive dashboardtable">
                                <table class="table tbl_activebid text-center">
                                    <thead>
                                        <tr>
                                            <th>Freelancer Name</th>
                                            <th>Price</th>
                                            <th>Deliver Day</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row3 = mysqli_fetch_assoc($result)) {
                                            $d = new _spprofiles;
                                            $MileStonePersonName = $d->getProfileName($row3['spProfiles_idspProfiles']);
                                            ?>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row3['spProfiles_idspProfiles'];?>" class="red"><?php echo $MileStonePersonName;?></a></td>
                                                <td>$<?php echo $row3['milestonePrice'];?></td>
                                                <td><?php echo $row3['milestoneDeliverDay'];?></td>
                                                <td style="text-align: left"><?php echo $row3['milestoneDescription'];?></td>
                                                <td>
                                                    <?php
                                                    if($row3['milestoneStatus'] == 0){
                                                        echo "Pending";
                                                        
                                                    }else if($row3['milestoneStatus'] == 1){
                                                        echo "Completed";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        
                        
                    }
                    ?>
                    <?php
                    $fm = new _freelance_milestone;
                    $result = $fm->completeMymilestone($_GET['postid']);
                    if($result){
                        ?>
                        <h2>Accounts</h2>
                        <div class="col-md-12 nopadding dashboard-section">
                            <div class="table-responsive dashboardtable">
                                <table class="table tbl_activebid text-center">
                                    <thead>
                                        <tr>
                                            <th>Freelancer Name</th>
                                            <th>Deliver Day</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        while ($row3 = mysqli_fetch_assoc($result)) {
                                            $total = $total + $row3['milestonePrice'];
                                            $d = new _spprofiles;
                                            $MileStonePersonName = $d->getProfileName($row3['spProfiles_idspProfiles']);
                                            ?>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row3['spProfiles_idspProfiles'];?>" class="red"><?php echo $MileStonePersonName;?></a></td>
                                                
                                                <td ><?php echo $row3['milestoneDeliverDay'];?></td>
                                                <td>
                                                    <?php
                                                    if($row3['milestoneStatus'] == 0){
                                                        echo "Pending";
                                                        
                                                    }else if($row3['milestoneStatus'] == 1){
                                                        echo "Completed";
                                                    }
                                                    ?>
                                                </td>
                                                <td>$<?php echo $row3['milestonePrice'];?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">Sub Total</td>
                                            <td>$<?php echo  $total;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Remaing Amount</td>
                                            <td>$<?php echo $row['spPostingPrice'] - $total;?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        
                        
                    }
                    ?>
                    <div class="col-xs-12 nopadding text-center">
                        <!-- Modal -->
                        <div id="submitRec" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <form method="post" action="addrecomndation.php">
                                    <div class="modal-content no-radius">
                                        <div class="modal-header text-left">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Submit a Recomnedation</h4>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="spPosting_idspPostings" value="<?php echo $_GET['postid'];?>" />
                                                    <input type="hidden" name="postProject_idspProfiles" value="<?php echo $projectpostid; ?>" />
                                                    <?php
                                                    $fps = new _freelance_project_status;
                                                    $result2 = $fps->readFreelanceProject($_GET['postid']);
                                                    if($result2){
                                                        $row = mysqli_fetch_assoc($result2);
                                                        $freelanceId = $row['spProfiles_idspProfiles'];
                                                    }
                                                    ?>
                                                    <input type="hidden" name="freelanceProject_idspProfiles" value="<?php echo $freelanceId; ?>" />
                                                    <input type="hidden" name=" recomnd_date" value="<?php echo date('Y-m-d h:s'); ?>" />
                                                    <?php
                                                    
                                                    $res2 = $p->singletimelines($_GET['postid']);
                                                    if($res2){
                                                        $row2 = mysqli_fetch_assoc($res2);
                                                        if($_SESSION['pid'] == $row2['idspProfiles']){ 
                                                            //jis ny post kiya project ?>
                                                            <input type="hidden" name="recomnd_status" value="1" /> <?php
                                                            //header('location:'.$BaseUrl.'/freelancer');
                                                        }else{
                                                            //freelancer ?>
                                                            <input type="hidden" name="recomnd_status" value="0" /> <?php
                                                        }
                                                    }
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="email">Description</label>
                                                        <textarea class="form-control no-radius" name="desc_recomndation"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="email">Rating</label><br>
                                                        <div class="radio">
                                                            <label><input type="radio" name="recomnd_rating" value="1">1</label>
                                                            <label><input type="radio" name="recomnd_rating" value="2">2</label>
                                                            <label><input type="radio" name="recomnd_rating" value="3">3</label>
                                                            <label><input type="radio" name="recomnd_rating" value="4">4</label>
                                                            <label><input type="radio" name="recomnd_rating" value="5">5</label>
                                                        </div>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" >Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#submitRec" class="btn submit-recomnedation-btn"> Submit a Recomnedation</a>
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
