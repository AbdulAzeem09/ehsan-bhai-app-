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
    $activePage = 7;
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
        <section class="realTopBread " >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <?php include_once("top-buttons.php");?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2><span>Flag Listing</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">Flag Listing</li>
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
                                        <th>Property Title</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p = new _postingview;
                                    $pf     = new _postfield;
                                    $profile = new _spprofiles;
                                    $result2 = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
                                    //$result2 = $p->readBooking($_GET['categoryID'], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    if($result2 != false){
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['idspPostings'];   
                                            
                                            $result_pf = $pf->read($row2['idspPostings']);
                                            //echo $pf->ta->sql."<br>";
                                            if($result_pf){
                                                $roomType = "";
                                                $addres = "";
                                                
                                                while ($row3 = mysqli_fetch_assoc($result_pf)) {
                                                    
                                                    if($roomType == ''){
                                                        if($row3['spPostFieldName'] == 'spPostListing_'){
                                                            $roomType = $row3['spPostFieldValue'];

                                                        }
                                                    }
                                                    if($addres == ''){
                                                        if($row3['spPostFieldName'] == 'spPostingAddress_'){
                                                            $addres = $row3['spPostFieldValue'];

                                                        }
                                                    }
                                                    
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo $pageLink;?>"><?php echo $row2['spPostingtitle'];?></a>
                                                </td>
                                                <td><?php echo $roomType;?></td>
                                                <td><?php echo $addres;?></td>
                                                
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
