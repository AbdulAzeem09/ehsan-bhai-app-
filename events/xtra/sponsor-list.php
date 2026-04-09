<?php 
    include('../../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 5;
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="bg_gray">

        <?php include_once("../../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Sponsor List</h3>
                    </div>
                </div>
            </div>
        </section>
        <!--Add album size-->
        <div class="modal fade" id="sponsorEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos no-radius">
                    <form action="createsponsor.php" method="post" id="sp-create-album" class="no-margin">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor2</b></h4>
                        </div>
                        <div class="modal-body">
                        
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="sp-sponsor-edit">
                                        
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="spaddSponsor" type="submit" class="btn btn-primary editing">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <section class="m_top_15">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_event_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="main_box eventExplrthefun" >
                            <?php include('../top-button-dashboard.php'); ?>
                            
                        </div>
                        <div class="row">
                            <!--Add album size-->
                            <div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content sharestorepos no-radius">
                                        <form action="createsponsor.php" method="post" id="sp-create-album" class="no-margin">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsort</b></h4>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorTitle">Title</label>
                                                            <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorWebsite">Company Website</label>
                                                            <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="spsponsorPrice">Price</label>
                                                            <input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" required="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorCategory">Sponsorship Category</label>
                                                            <select class="form-control" name="sponsorCategory">
                                                                <option class="General">General</option>
                                                                <option class="Prime">Prime</option>
                                                                <option class="Platinum">Platinum</option>
                                                                <option class="Gold">Gold</option>
                                                                <option class="Silver">Silver</option>
                                                                <option class="Media">Media</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="sponsorDesc">Short Description</label>
                                                            <textarea class="form-control" name="sponsorDesc"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="spSponsorPic">Add Logo</label>
                                                                    <input type="file" class="sponsorPic" name="sponsorImg">
                                                                    <p class="help-block"><small>Browse files from your device</small></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <label for="sponsorPreview">Logo Preview</label>
                                                                    <div id="sponsorPreview"></div>
                                                                    <div id="postingsponsorPreview">
                                                                        <div class="row">
                                                                            <div id="spPreview" >
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button id="addSponser" type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Done-->
                            <div class="col-sm-12 text-right" style="padding-top: 10px;padding-bottom: 10px;">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-primary">Add Sponsor</a>
                            </div>
                            <div class="col-sm-12">
                                <div class="table-responsive bg_white">
                                    <table class="table table-striped eventTable" id="sponMod">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Website</th>
                                                <th>Category</th>
                                                <th>Profile</th>
                                                <th>Price</th>
                                                <th>Logo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sp  = new _sponsorpic;
                                            $p = new _spprofiles;

                                            $result = $sp->readAll($_SESSION['pid']);
                                            //$res = $p->draftEvent($_GET['categoryID']);
                                            //echo $sp->ta->sql;
                                            $i = 1;
                                            if($result){
                                                while ($row = mysqli_fetch_assoc($result)) { 
                                                   
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['sponsorTitle'];?></td>
                                                        <td><a href="<?php echo $row['sponsorWebsite']?>" target="_blank" ><?php echo $row['sponsorWebsite'];?></a></td>
                                                        <td><?php echo $row['sponsorCategory'];?></td>
                                                        <td><?php 
                                                            
                                                            $result2 = $p->readUserId($row['spProfile_idspProfile']);
                                                            //echo $p->ta->sql;
                                                            if($result2){
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                echo "<a href='javascript:void(0)' >".$row2['spProfileName']."</a>";                                                                
                                                            }
                                                        ?></td>
                                                        <td><?php echo ($row['spsponsorPrice'] > 0)?'$'.$row['spsponsorPrice']:'';?></td>
                                                        <td>
                                                            <?php
                                                            if(isset($row['sponsorImg'])){
                                                                echo '<img src="'.($row['sponsorImg']).'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
                                                            }else{
                                                                echo '<img src="../assets/images/noname.png" class="img-responsive" alt="">';
                                                            }
                                                            ?>
                                                            
                                                        </td>
                                                        <td><a class='sendSponsorEdit' href='javascript:void(0)' data-toggle='modal' data-target='#sponsorEdit' data-sponsor="<?php echo $row['idspSponsor'];?>"><i class="fa fa-edit"></i> Edit</a></td>
                                                    </tr> <?php
                                                    $i++;
                                                
                                                }
                                            }  ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="space"></div>
        <?php 
        include('../../component/footer.php');
        include('../../component/btm_script.php'); 
        ?>
	</body>
</html>
