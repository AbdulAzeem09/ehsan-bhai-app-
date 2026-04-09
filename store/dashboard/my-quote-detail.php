<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <?php include('../../component/dashboard-link.php'); ?>
        
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php
                            $activePage = 8;
                            include('left-menu.php'); 
                        ?>
                    </div>
                    <div class="col-md-10">
                        <?php 
                        
                        $storeTitle = " Dashboard (<small>Quote Detail</small>)";
                        include('../top-dashboard.php');
                        include('../searchform.php');
                        
                        ?>
                        
                        
                        <?php 
                       
                        $en     = new _spquotation;
                        $p      = new _spprofiles;
                        $pst    = new _postingview;
                        $result = $en->readQuote($_GET['quote']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $dt = new DateTime($row['spQuotationDate']);
                        }
                        ?>
                        <div class="bg_white_border quoteDetail">
                            <div class="row no-margin">
                                <div class="col-md-12">
                                    <h2>
                                        <a href="<?php echo $BaseUrl.'/wholesale/detail.php?catid=1&postid='.$row['spPostings_idspPostings']; ?>">
                                        <?php 
                                        $result3 = $pst->singletimelines($row['spPostings_idspPostings']);
                                        if ($result3) {
                                            $row3 = mysqli_fetch_assoc($result3);
                                            echo ucwords(strtolower($row3['spPostingtitle']));
                                        }
                                        ?>
                                        </a>
                                    </h2>
                                    <p><?php echo $row['spQuotatioProductDetails']; ?></p>
                                    <h2>Features</h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Quantity Required</td>
                                                    <td><?php echo $row['spQuotationTotalQty']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Delivery (Days)</td>
                                                    <td><?php echo $row['spQuotationDelevery']; ?> Days</td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td>
                                                        <?php
                                                        $rc = new _country; 
                                                        $result_cntry = $rc->readCountryName($row['spQuotationCountry']);
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
                                                        $result_stat = $st->readStateName($row['spQuotationState']);
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
                                                        $result_cty = $rcty->readCityName($row['spQuotationCity']);
                                                        if ($result_cty) {
                                                            $row5 = mysqli_fetch_assoc($result_cty);
                                                            echo $cityName = $row5['city_title'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Posted Date</td>
                                                    <td><?php echo $dt->format('d M Y'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Seller Name</td>
                                                    <td>
                                                        <a href="<?php echo $BaseUrl.'/wholesale/friend.php?pid='.$row['spQuotationSellerid']; ?>">
                                                            <?php 
                                                            $result2 = $p->read($row['spQuotationSellerid']);
                                                            if ($result2) {
                                                                $row2 = mysqli_fetch_assoc($result2);
                                                                echo $row2['spProfileName'];
                                                            }
                                                            ?>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $q = new _spAllStoreForm;
                        $result2 = $q->readComment($_GET['quote']);
                        if ($result2) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $dt = new DateTime($row2['spQuotionDate']);

                                if ($row2['spProfiles_idspProfiles'] == $row['spQuotationBuyerid']) {
                                    ?>
                                    <div class="row m_top_20">
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
                                                    <?php echo $row2['spQuotionDesc']; ?>
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
                                                </div>
                                                <div class="panel-body">
                                                    <?php echo $row2['spQuotionDesc']; ?>
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
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-area no-padding blank">
                                    <div class="status-upload">
                                        <form action="addquotecomment.php" method="post" >
                                            <input type="hidden" name="idspQuotation" value="<?php echo $_GET['quote']; ?>">
                                            <input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
                                            <textarea placeholder="Post a comment." name="spQuotionDesc"></textarea>
                                            <button type="submit" class="btn btn-success green">Post Comment</button>
                                        </form>
                                    </div><!-- Status Upload  -->
                                </div><!-- Widget Area -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
}?>