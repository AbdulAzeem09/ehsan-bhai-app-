<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 4;
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

        <?php include_once("../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Sponsor List</h3>
                    </div>
                </div>
            </div>
        </section>
        <!--Add album size-->
        <div class="modal fade" id="sponsorEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos no-radius">
                    <form action="../album/createsponsor.php" method="post" id="sp-create-album" class="no-margin">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor5</b></h4>
                        </div>
                        <div class="modal-body">
                        
                            <div class="row">
                                
                                <div class="col-md-12">
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
        
        <section class="main_box no-padding">
            
            <div class="container eventExplrthefun">
                <?php include('top-button-dashboard.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <h1>Explore the <span>fun</span></h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php include('search-form.php');?>
                    </div>
                </div>
            </div>
            
        </section>
        
        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 eventDashboard no-padding">
                        <nav class="navbar navbar_free">
                            <div class="container-fluid nopadding">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <?php
                                include('top-dashboard.php');
                                ?>
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table tabe-striped eventTable" id="sponsorTab">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Website</th>
                                        <th>Category</th>
                                        <th>Profile</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sp  = new _sponsorpic;
                                    $res = $sp->readAll($_SESSION['pid']);
                                    //$res = $p->draftEvent($_GET['categoryID']);
                                    //echo $p->ta->sql;
                                    if($res != false){
                                        while ($row = mysqli_fetch_assoc($res)) { 

                                            ?>
                                            <tr>
                                                <td><?php echo $row['sponsorTitle'];?></a></td>
                                                <td><a href="<?php echo $row['sponsorWebsite']?>" target="_blank" ><?php echo $row['sponsorWebsite'];?></a></td>
                                                <td><?php echo $row['sponsorCategory'];?></td>
                                                <td><?php 
                                                    $p = new _spprofiles;
                                                    $result = $p->readUserId($row['spProfile_idspProfile']);
                                                    //echo $p->ta->sql;
                                                    if($result != false){
                                                        $row2 = mysqli_fetch_assoc($result);
                                                        echo "<a href='javascript:void(0)' >".$row2['spProfileName']."</a>";
                                                       
                                                        
                                                    }
                                                ?></td>
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
                                        
                                        }
                                    }  ?>
                                    
                                    
                                </tbody>
                            </table>
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
