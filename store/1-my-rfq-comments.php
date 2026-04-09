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
    if (isset($_GET['rfq']) && $_GET['rfq'] > 0) {
        
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
                        $storeTitle = " (<small>My RFQ Comments</small>)";
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
                                    <h2><?php echo $row['rfqTitle'];?></h2>
                                    <p><?php echo $row['rfqDesc']; ?></p>
                                    

                                    
                                </div>
                            </div>
                        </div>
                        

                        <?php
                        $q = new _rfq;
                        $p = new _spprofiles;
                        $result2 = $q->readRfqComment($_GET['rfq']);
                        if ($result2) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $dt = new DateTime($row2['rfqDate']);

                                if ($row2['spProfiles_idspProfiles'] == $row['spProfile_idspProfiles']) {
                                    ?>
                                    <div class="row m_top_20">
                                        <div class="col-sm-1">
                                            <div class="thumbnail">
                                                <?php
                                                    
                                                    $result5 = $p->read($row2['spProfiles_idspProfiles']);
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
                                                        $result4 = $p->read($row2['spProfiles_idspProfiles']);
                                                        if ($result4) {
                                                            $row4 = mysqli_fetch_assoc($result4);
                                                            echo $row4['spProfileName'];
                                                        }
                                                        ?>
                                                    </strong>: <span class="text-muted">commented <?php echo $dt->format('d M Y'); ?></span>
                                                </div>
                                                <div class="panel-body">
                                                    <?php echo $row2['rfqDesc']; ?>
                                                </div><!-- /panel-body -->
                                            </div><!-- /panel panel-default -->
                                        </div><!-- /col-sm-5 -->
                                    </div><!-- /row -->
                                    <?php
                                }else{
                                    ?>
                                    <div class="row m_top_20">
                                        <div class="col-sm-11">
                                            <div class="panel panel-default">
                                                <div class="panel-heading panalheading2">
                                                    <strong>
                                                        <?php
                                                        $result4 = $p->read($row2['spProfiles_idspProfiles']);
                                                        if ($result4) {
                                                            $row4 = mysqli_fetch_assoc($result4);
                                                            echo $row4['spProfileName'];
                                                        }
                                                        ?>
                                                    </strong>: <span class="text-muted">commented <?php echo $dt->format('d M Y'); ?></span>
                                                    <a href="<?php echo $BaseUrl.'/store/my-rfq-detail.php?rfq='.$row['idspRfq'].'&pid='.$row2['spProfiles_idspProfiles']; ?>" class="pull-right">Conversation</a>
                                                </div>
                                                <div class="panel-body">
                                                    <?php echo $row2['rfqDesc']; ?>
                                                </div><!-- /panel-body -->
                                            </div><!-- /panel panel-default -->
                                        </div><!-- /col-sm-5 -->
                                        <div class="col-sm-1">
                                            <div class="thumbnail">
                                                <?php
                                                    $p = new _spprofiles;
                                                    $result5 = $p->read($row2['spProfiles_idspProfiles']);
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
                        ?>

                        
                        
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
