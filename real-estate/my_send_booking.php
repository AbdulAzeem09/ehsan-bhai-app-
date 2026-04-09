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
                            <h2><span>My Send Booking</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">My Send Booking</li>
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
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" style="min-height: 400px;">
                            <table class="table tabe-striped realTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th>Property Title</th>
                                        <th style="text-align: center;">Per</th>
                                        <th style="text-align: center;">Price</th>
                                        <th style="text-align: center;">Cleaning Charges</th>
                                        <th style="text-align: center;">Service Charges</th>
                                        <th style="text-align: center;">Booking Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p = new _bookRoom;
                                    $pv = new _postingview;
                                    $result2 = $p->readMyBooking($_SESSION['pid']);
                                    
                                    $i = 1;
                                    if($result2 != false){
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $dt = new DateTime($row2['spBookDate']);


                                            $pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['spPosting_idspPosting'];   
                                            
                                            ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo $pageLink;?>">
                                                        <?php 
                                                        $result3 = $pv->singletimelines($row2['spPosting_idspPosting']);
                                                        if ($result3) {
                                                            $row3 = mysqli_fetch_assoc($result3);
                                                             echo $row3['spPostingtitle'];
                                                        }
                                                       
                                                        ?>
                                                            
                                                    </a>
                                                </td>
                                                
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
                                                <td style="text-align: center;"><?php echo $dt->format('d-M-Y'); ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($row2['spStatus'] == 0) {
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn btn-info" style="color: #FFF;">Waiting</a>
                                                        <?php
                                                    }else if($row2['spStatus'] == 1){
                                                        ?>
                                                        <a href="javascript:void(0)" class="btn btn-success" style="color: #FFF;">Approved - Pay Now</a>
                                                        <?php
                                                    }else if ($row2['spStatus'] == 2) {
                                                        echo "<p>You are Rejected!</p>";
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
