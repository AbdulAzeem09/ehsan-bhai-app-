<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 2;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>//assets/js/jquery-1.11.4-ui.min.js"></script>
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
                    <div class="col-xs-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Successfull Work</li>
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 nopadding dashboard-section">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive" style="min-height: 300px">
                                
                                <table class="table text-center tbl_activebid">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Total Bids</th>
                                            <th>Price</th>
                                            <th>Milestone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $fps = new _freelance_project_status;
                                        $res = $fps->myAssignProject($_SESSION['pid']);
                                        //echo $fps->ta->sql;
                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['fps_start_date']);

                                                $p = new _postings;
                                                $result = $p->completeProject($row['spPosting_idspPostings']);
                                                //echo $p->ta->sql;
                                                if($result){
                                                    $row2 = mysqli_fetch_assoc($result);
                                                    ?>
                                                    <tr>
                                                        <!-- Modal -->
                                                        <div id="myproject-<?php echo $row['spPosting_idspPostings'];?>" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <form method="post" action="addmilestone.php">
                                                                    <div class="modal-content no-radius">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title"><?php echo $row2['spPostingTitle'];?></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['spPosting_idspPostings']; ?>">
                                                                            <input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $row['spProfiles_idspProfiles']; ?>">
                                                                            <input type="hidden" name="milestoneStatus" value="0" >
                                                                            <input type="hidden" name="milestoneSubmitDate" value="<?php echo date('Y-m-d'); ?>">
                                                                            <div class="row add_form_body">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Amount">Amount</label>
                                                                                        <input type="text" class="form-control" name="milestonePrice" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Deliver Day">Deliver Day</label>
                                                                                        <input type="date" class="form-control" name="milestoneDeliverDay" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="Description">Description</label>
                                                                                        <textarea name="milestoneDescription" class="form-control"></textarea>
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
                                                        <td ><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['spPosting_idspPostings'];?>" class="red"  ><?php echo $row2['spPostingTitle'];?></a></td>
                                                        <td>$<?php echo $row2['spPostingPrice'];?></td>
                                                        <td><?php echo $dt->format('M d, Y'); ?></td>
                                                        
                                                        <td>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/complete-milestone.php?postid='.$row['spPosting_idspPostings'];?>" class="red" >Complete Milestone</a>
                                                            
                                                        </td>
                                                    </tr> <?php
                                                }
                                                
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
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
