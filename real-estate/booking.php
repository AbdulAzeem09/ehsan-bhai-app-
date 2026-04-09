<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin']="timeline/";
    }
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $activePage = 6;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="realTopBread" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <?php include_once("top-buttons.php");?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2><span>My Received Booking</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">My Received Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        
        <section class="" style="padding: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 realDashboard no-padding">
                        <?php include('top-dashboard.php');?>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content no-radius sharestorepos">
                            <form method="POST" action="addDiscount.php" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Discount</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                
                                    <input type="hidden" name="txtBokId" id="txtBokId" value="">
                                    <input type="hidden" id="txtOrgPrice" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount On</label>
                                                <input type="text" value="" id="txtBokTitle" class="form-control" readonly="">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount (%)</label>
                                                <input type="number" name="txtDiscount" id="txtDiscount" value="" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discounted Price ($)</label>
                                                <input type="text" name="txtDiscountPrice" id="txtDiscountPrice" readonly="" value="" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Discount And Approve</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" style="min-height: 400px;">
                            <table class="table tabe-striped realTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th>Property Title</th>
                                        <th>Profile</th>
                                        <th style="text-align: center;">Per</th>
                                        <th style="text-align: center;">Price</th>
                                        <th style="text-align: center;">Cleaning Charges</th>
                                        <th style="text-align: center;">Service Charges</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p = new _postingview;
                                    $profile = new _spprofiles;
                                    
                                    $result2 = $p->readBooking($_GET['categoryID'], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    $i = 1;
                                    if($result2 != false){
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['idspPostings'];   
                                            $spProfile = $row2['spProfile_idspProfile'];

                                            
                                            $result3 = $profile->read($spProfile);
                                            if($result3 != false){
                                                $row3 = mysqli_fetch_assoc($result3);
                                                $userProfileName = $row3['spProfileName'];
                                            }
                                            ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo $pageLink;?>"><?php echo $row2['spPostingtitle'];?></a>
                                                </td>
                                                <td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$spProfile;?>"><?php echo $userProfileName;?></a></td>
                                                <td style="text-align: center;"><?php echo $row2['spMonth'];?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($row2['spDiscountPrice'] > 0) {
                                                        echo '$'.$row2['spDiscountPrice'].' ('.$row2['spDiscountPer'].'% Discount)';
                                                    }else{
                                                        echo '$'.$row2['spPrice'];
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center;"><?php echo $row2['spCleaningChrg'];?></td>
                                                <td style="text-align: center;"><?php echo $row2['spServiceChrg'];?></td>
                                                <td style="text-align: center;" class="book">
                                                    <?php
                                                    if ($row2['spStatus'] == 0) {
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn butn_draf sp-book-room" data-price="<?php echo $row2['spPrice']; ?>" data-bokid="<?php echo $row2['idspRoomBook']; ?>" data-title="<?php echo $row2['spPostingtitle'];?>" style="color: #FFF;" data-toggle="modal" data-target="#exampleModal" >
                                                            Discount
                                                        </a>
                                                        <a href="<?php echo $BaseUrl.'/real-estate/status.php?action=app&boking='.$row2['idspRoomBook'];?>" class="btn btn-success" style="color: #FFF;">Approve</a>
                                                        <a href="<?php echo $BaseUrl.'/real-estate/status.php?action=rej&boking='.$row2['idspRoomBook'];?>" class="btn btn-danger" style="color: #FFF;">Reject</a>
                                                        <?php
                                                    }else if($row2['spStatus'] == 1){
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn btn-success" style="color: #FFF;">Waiting For Amount</a>
                                                        <?php
                                                    }else if ($row2['spStatus'] == 2) {
                                                        echo "<p>You Reject This Person</p>";
                                                    }
                                                    ?>
                                                    
                                                </td>
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
        </section>

        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
