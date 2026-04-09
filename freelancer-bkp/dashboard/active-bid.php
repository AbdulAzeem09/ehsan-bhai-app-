<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="freelancer/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 18;

    $fps = new _freelance_project_status;
    

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />


          <!-- Design css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    <?php include('left-menu.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">

                    <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
                              <li>ACTIVE PROJECTS</li>
                              <!-- <li><?php echo $title;?></li> -->
                            <!--  <a href="<?php// echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>  -->
                            </ul>
                        </div>
                    </div>
                    
                   <!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Active Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table text-center tbl_activebid">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Name</th>
                                            <th style="color:#fff;">Total Bids</th>
                                            <th style="color:#fff;">Bid Price ($)</th>
                                            <th style="color:#fff;">Expire Date</th>
                                            <th style="color:#fff;">Created Date</th>
                                            <th class="action" style="text-align: right;color:#fff;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                       // $p = new _postings;

                                  $sf  = new _freelancerposting;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);

                                    //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){
                                                
                                                $dt = new DateTime($row['spPostingExpDt']);

                                                 $cr = new DateTime($row['spPostingDate']);
                                               
                                            //   echo "<pre>";
                                            //   print_r($row);exit;

                                               // $pf = new _postfield;
                                                //$result_pf = $pf->totalbids($row['idspPostings']);

                                         $sfbid = new  _freelancerposting;

                                          // $respos = $pos->totalbids($_GET['project']);
///opt/lampp/htdocs/sharepagego/Sharepage/mlayer/_freelancerposting.class.php
                                          //$respos = $sfbid->totalbids1($_GET['project']);
                           // $bids = $po->totalbids($_GET['project']);

                             $bids = $sfbid->totalbids1($row['idspPostings']);


                            //echo $sf->ta->sql;
                            if($bids){
                                $totalbids = $bids->num_rows;
                            }else{
                                $totalbids = 0;
                            }
                                                ?>

                                                <tr>
                                                    <!-- Modal -->
                                                    <div id="myproject-<?php echo $row['idspPostings'];?>" class="modal fade" role="dialog">
                                                 <div class="modal-dialog sharestorepos" >
                                                            <!-- Modal content-->
                                                            <form method="post" action="addmilestone.php">
                                                                <div class="modal-content no-radius">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title"><?php echo $row['spPostingTitle'];?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
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
                                                                        <button type="submit" class="btn btn-primary"  >Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <td><?php echo $row['idspPostings']; ?></td>
                                                    <td width="20%"><!-- <a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a> -->
                                                        
                                                        <a href="javascript:void(0)" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a>

                                                   


                                                    </td>
                                                    <td width="5%"><?php echo $totalbids;?></td>
                                                    <td>$<?php echo $row['spPostingPrice'];?></td>
                                                    <td><?php echo $dt->format('M d, Y'); ?></td>
                                                    <td><?php echo $cr->format('M d, Y'); ?></td>
                                                    
                                                    <td  style="text-align: right;">
                                                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'];?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

                                                        <a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-red"> <i class="fa fa-eye"></i> </a>

                                                        <?php
                                                            // if ($sppostingscommentstatus == 1) {
                                                            //     ?>
                                                                <a href="javascript:deactive(<?php echo $sppostingscommentstatus; ?>)" data-original-title="De-active" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" ><i class="fa fa-ban"></i></a>
                                                             <?php
                                                            // }else{
                                                            //     ?>
                                                                 <a href="javascript:activate(<?php echo $sppostingscommentstatus; ?>)" data-original-title="Activate" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" ><i class="fa fa-unlock"></i></a>
                                                                <?php
                                                            // }
													    ?>
                                                        
                                                        <!-- <a href="<?php //echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red" >View Detail</a> -->


                                                  
                                                        
                                                    </td>
                                                </tr> <?php
                                                $i++;
                                            }
                                        }else{
                                            echo "<td colspan='6'><center>No Record Found</center></td>";
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
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>