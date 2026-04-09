<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/islogin.php");
        $_SESSION['afterlogin']="timeline/";
    }else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $activePage = 1;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
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
                            <h2><span>REAL ESTATES DASHBOARD</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">REAL ESTATES DASHBOARD</li>
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
                                        <th>Price</th>
                                        <th>Property Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $p = new _realstateposting;
                                        $pf  = new _postfield;
                                        $type = "Sell";
                                        $i = 1;
                                        $result2 = $p->myAllSellActiveProperty($_GET['categoryID'], $_SESSION['pid'], $type);
                                        //$result2 = $p->publicpost_event($_GET['categoryID']);
                                        //$result2 = $p->getAgetsReal($_GET['categoryID']);
                                        //echo $p->ta->sql;
                                        if($result2 != false){
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $propertyType = "";
                                                    $proStatus = "";
                                                
                                                $propertyType = $row2['spPostingPropertyType'];
                                                $proStatus = $row2['spPostingPropStatus'];


                                                //print_r($row2);

                                                /*$result_pf = $pf->read($row2['idspPostings']);
                                                if($result_pf){
                                                    $propertyType = "";
                                                    $proStatus = "";

                                                    while ($row3 = mysqli_fetch_assoc($result_pf)) {
                                                        
                                                        if($propertyType == ''){
                                                            if($row3['spPostFieldName'] == 'spPostingPropertyType_'){
                                                                $propertyType = $row3['spPostFieldValue'];
                                                            }
                                                        }
                                                        if($proStatus == ''){
                                                            if($row3['spPostFieldName'] == 'spPostingPropStatus_'){
                                                                $proStatus = $row3['spPostFieldValue'];
                                                            }
                                                        }
                                                    }
                                                }*/
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row2['idspPostings'];?>"><?php echo $row2['spPostingTitle'];?></a>
                                                    </td>
                                                    <td>$<?php echo $row2['spPostingPrice'];?></td>
                                                    <td><?php echo $propertyType;?></td>
                                                    <td><?php echo $proStatus;?></td>
                                                    <td><a href="<?php echo $BaseUrl.'/post-ad/real-estate/?type=0&postid='.$row2['idspPostings'];?>">Edit</a></td>
                                                </tr>                                            
                                                <?php
                                                $i++;
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
<?php
}
?>