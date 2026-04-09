<?php
    include('../univ/baseurl.php');
    session_start();

    if(!isset($_SESSION['pid'])){ 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (isset($_GET['rfq']) && $_GET['rfq'] > 0 && $_GET['pid'] > 0) {
        
    }else{
        $re = new _redirect;
        $re->redirect("my-send-rfq.php");
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        
                        
                        <?php 
                        $activePage = 8;
                        $storeTitle = " (<small>My RFQ Conversation</small>)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');

                        $r = new _rfq;
                        $result = $r->rfqRead($_GET['rfq']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }

                        
                        ?>
                        <div class="bg_white_border quoteDetail">
                            <div class="row no-margin">
                                <div class="col-md-12">
                                    <h2><a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq']; ?>"><?php echo $row['rfqTitle'];?></a></h2>
                                    <p><?php echo $row['rfqDesc']; ?></p>
                                    <h2>Features</h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Category</td>
                                                    <td><?php echo $row['rfqCategory']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Quantity required</td>
                                                    <td><?php echo $row['rfqQty']; ?> Days</td>
                                                </tr>
                                                <tr>
                                                    <td>Delivered (Days)</td>
                                                    <td>$<?php echo $row['rfqDelivered']; ?> Days</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>
                                                        <?php
                                                        $rc = new _country; 
                                                        $result_cntry = $rc->readCountryName($row['rfqCountry']);
                                                        if ($result_cntry) {
                                                            $row4 = mysqli_fetch_assoc($result_cntry);
                                                            echo $row4['country_title'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>
                                                        <?php
                                                        $st = new _state;
                                                        $result_stat = $st->readStateName($row['rfqState']);
                                                        if ($result_stat) {
                                                            $row6 = mysqli_fetch_assoc($result_stat);
                                                            echo $stateName = $row6['state_title'];
                                                        }
                                                        ?>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>
                                                        <?php
                                                        $rcty = new _city;
                                                        $result_cty = $rcty->readCityName($row['rfqCity']);
                                                        if ($result_cty) {
                                                            $row5 = mysqli_fetch_assoc($result_cty);
                                                            echo $cityName = $row5['city_title'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    $result6 = $r->readFavourtCmpy($_GET['rfq'], $_GET['pid'], $_SESSION['pid']);
                                    if ($result6) {
                                        ?>
                                        <a href="<?php echo $BaseUrl.'/store/favourite.php?action=remove&rfq='.$_GET['rfq'].'&pid='.$_GET['pid'];?>" class="btn butn_draf">Remove Favourite This Company</a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="<?php echo $BaseUrl.'/store/favourite.php?action=add&rfq='.$_GET['rfq'].'&pid='.$_GET['pid'];?>" class="btn butn_draf">Add To Favourite This Company</a>
                                        <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        $q = new _rfq;
                        $p = new _spprofiles;
                        $result2 = $q->readRfqConv($_GET['rfq']);
                        //echo $q->rfc->sql;
                        if ($result2) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $dt = new DateTime($row2['rfqConvDate']);

                                if ($row2['idspProfile_sender'] == $row['spProfile_idspProfiles']) {
                                    if ($_GET['pid'] == $row2['idspProfile_receiver']) {
                                        ?>
                                        <div class="row m_top_20">
                                            <div class="col-sm-1">
                                                <div class="thumbnail">
                                                    <?php
                                                        
                                                        $result5 = $p->read($row2['idspProfile_sender']);
                                                        if ($result5 != false) {
                                                            $row5 = mysqli_fetch_assoc($result5);
                                                            if (isset($row5["spProfilePic"]))
                                                                echo "<img alt='profilepic' class='user-photo img-responsive' src=' " . ($row5["spProfilePic"]) . "'  >";
                                                            else
                                                                echo "<img alt='profilepic' class='user-photo img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                                        }
                                                    ?>
                                                </div><!-- /thumbnail -->
                                            </div><!-- /col-sm-1 -->
                                            <div class="col-sm-11">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panalheading3" >
                                                        <strong>
                                                            <?php
                                                            $result4 = $p->read($row2['idspProfile_sender']);
                                                            if ($result4) {
                                                                $row4 = mysqli_fetch_assoc($result4);
                                                                echo $row4['spProfileName'];
                                                            }
                                                            ?>
                                                        </strong>: <span class="text-muted">commented <?php echo $dt->format('d M Y'); ?></span>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php echo $row2['rfqConvComment']; ?>
                                                    </div><!-- /panel-body -->
                                                </div><!-- /panel panel-default -->
                                            </div><!-- /col-sm-5 -->
                                        </div><!-- /row -->
                                        <?php
                                    }
                                    
                                }else{
                                    if ($_GET['pid'] == $row2['idspProfile_sender']) {
                                        ?>
                                        <div class="row m_top_20">
                                            <div class="col-sm-11">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panalheading2">
                                                        <strong>
                                                            <?php
                                                            $result4 = $p->read($row2['idspProfile_sender']);
                                                            if ($result4) {
                                                                $row4 = mysqli_fetch_assoc($result4);
                                                                echo $row4['spProfileName'];
                                                            }
                                                            ?>
                                                        </strong>: <span class="text-muted">commented <?php echo $dt->format('d M Y'); ?></span>
                                                        
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php echo $row2['rfqConvComment']; ?>
                                                    </div><!-- /panel-body -->
                                                </div><!-- /panel panel-default -->
                                            </div><!-- /col-sm-5 -->
                                            <div class="col-sm-1">
                                                <div class="thumbnail">
                                                    <?php
                                                        $p = new _spprofiles;
                                                        $result5 = $p->read($row2['idspProfile_sender']);
                                                        if ($result5 != false) {
                                                            $row5 = mysqli_fetch_assoc($result5);
                                                            if (isset($row5["spProfilePic"]))
                                                                echo "<img alt='profilepic' class='user-photo img-responsive' src=' " . ($row5["spProfilePic"]) . "'  >";
                                                            else
                                                                echo "<img alt='profilepic' class='user-photo img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                                        }
                                                    ?>
                                                </div><!-- /thumbnail -->
                                            </div><!-- /col-sm-1 -->
                                        </div><!-- /row -->
                                        <?php
                                    }
                                    
                                }
                                
                            }
                        }
                        ?>
                       
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-area no-padding blank">
                                    <div class="status-upload">
                                        <form action="addrfqConv.php" method="post" >
                                            <input type="hidden" name="spRfq_idspRfq" value="<?php echo $_GET['rfq']; ?>">
                                            <input type="hidden" name="idspProfile_sender" value="<?php echo $_SESSION['pid']; ?>">
                                            <input type="hidden" name="idspProfile_receiver" value="<?php echo $_GET['pid']; ?>">
                                            <textarea placeholder="Post a comment." name="rfqConvComment"></textarea>
                                            <button type="submit" class="btn btn-success green">Post Comment</button>
                                        </form>
                                    </div>
                                </div>
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
