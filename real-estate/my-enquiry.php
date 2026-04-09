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
    $activePage = 5;
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
                            <h2><span>My Enquiry</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">My Enquiry</li>
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
                                        <th>Profile</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p = new _postingview;
                                    $pf  = new _postfield;
                                    $type = "Sell";
                                    //$result2 = $p->myAllSellReal($_GET['categoryID'], $_SESSION['pid'], $type);
                                    $result2 = $p->myEnquery($_GET['categoryID'], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    if($result2 != false){
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            if($row2['sprealType'] == 0){
                                                $pageLink = $BaseUrl."/real-estate/property-detail.php?postid=".$row2['idspPostings'];
                                            }else{
                                                $pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['idspPostings'];   
                                            }
                                            
                                            ?>
                                            <tr>
                                                <td>

                                                    <a href="<?php echo $pageLink;?>"><?php echo $row2['spPostingtitle'];?></a>
                                                </td>
                                                <td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row2['spProfile_idspProfile'];?>"><?php echo $row2['sprealName'];?></a></td>
                                                <td><?php echo $row2['sprealEmail'];?></td>
                                                <td><?php echo $row2['sprealPhone'];?></td>
                                                <td><?php echo $row2['sprealMessage'];?></td>
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
