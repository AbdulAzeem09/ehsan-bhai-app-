<?php 
    include('../univ/baseurl.php');
    session_start();
    //session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p = new _postingview;
    $fps = new _freelance_project_status;



    $res = $p->singletimelines($_GET['postid']);
    //echo $p->ta->sql;
    if($res){
        $row = mysqli_fetch_assoc($res);
        if($_SESSION['pid'] != $row['idspProfiles']){

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
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/active-project.php">Active Projects</a></li>
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
                                            <img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
                                        </div>
                                        <div class="col-xs-10 col-sm-11 nopadding">
                                            <p><span class="time-level">Category</span>
                                            </p>
                                            <p class="time-level-detail"><?php echo $Category;?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 nopadding">
                                        <div class="">
                                            <p>Price <i class="fa fa-dollar"></i> <?php echo $price;?></p>
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
                    //echo $fm->ta->sql;
                    if($result){
                        ?>
                        <h2>Milestone</h2>
                        <div class="col-md-12 nopadding dashboard-section">
                            <div class="table-responsive dashboardtable">
                                <table class="table tbl_activebid text-left">
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
                                                <td><?php echo $row3['milestoneDescription'];?></td>
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
                        $post = new _postings;
                        $result = $post->chkProjectStatus($row['idspPostings']);
                        if($result == false){
                            ?>
                            <!-- Modal -->
                            <div id="projectCancel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <form method="post" action="project-status.php">
                                        <div class="modal-content no-radius">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?php echo $row['spPostingtitle'];?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
                                                <div class="row add_form_body">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Description">Why cancel this project?</label>
                                                            <textarea name="txtCancelDescription" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="btnCancel">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <?php
                        }
                        
                        
                    }
                    ?>
                </div>
            </div>
        </section>


        <div class="space-lg"></div>
    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
