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
        $re->redirect("my-received-rfq.php");
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
                         $r = new _rfq;
                        $result = $r->rfqRead($_GET['rfq']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }

                        $activePage = 8;
                        $storeTitle = " (<small>". $row['rfqTitle']."</small>)";
                        //$storeTitle = " (<small>My RFQ Comments</small>)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');

                        ?>
                        <div class="bg_white_border quoteDetail">
                            <div class="row no-margin">
                                <div class="col-md-12">
                                    <h2><a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq']; ?>"><?php echo $row['rfqTitle'];?></a></h2>
                                    <p><?php echo $row['rfqDesc']; ?></p>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row m_top_20">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">id</th>
                                                <th>Company Name</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Quote Price</th>
                                                <th class="text-center">Chat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $q = new _rfq;
                                            $p = new _spprofiles;
                                            //$result2 = $q->readRfqComment($_GET['rfq']);
                                            $result2 = $q->readRfqQuoteRecCount($row['idspRfq']);
                                            //echo $q->tcd->sql;
                                            if ($result2) {
                                                $i = 1;
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $dt = new DateTime($row2['rfqDate']);
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td style="text-align: left;">
                                                            <a href="<?php echo $BaseUrl.'/wholesale/friend.php?pid='.$row2['spProfiles_idspProfiles']; ?>">
                                                            <?php
                                                            $result4 = $p->read($row2['spProfiles_idspProfiles']);
                                                            if ($result4) {
                                                                $row4 = mysqli_fetch_assoc($result4);
                                                                echo $row4['spProfileName'];
                                                            }
                                                            ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $dt->format('d M Y'); ?></td>
                                                        <td>$<?php echo $row2['rfqPrice'];?></td>
                                                        <td>
                                                            <?php
                                                            if ($row2['spProfiles_idspProfiles'] != $row['spProfile_idspProfiles']) {
                                                                ?>
                                                                <a href="<?php echo $BaseUrl.'/store/my-rfq-detail.php?rfq='.$row['idspRfq'].'&pid='.$row2['spProfiles_idspProfiles']; ?>" ><i class="fa fa-commenting black_clr" aria-hidden="true"></i></a>
                                                                <?php
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
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
