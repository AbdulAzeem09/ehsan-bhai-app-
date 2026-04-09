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
        $re->redirect("index.php");
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
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
                    <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        <?php 
                        $activePage = 8;
                        $storeTitle = " (<small>RFQ Detail</small>)";
                        include('top-dashboard.php');
                        
                        $r = new _rfq;
                        $result = $r->rfqRead($_GET['rfq']);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                        }
                        
                        ?>
                        <div class="bg_white_border quoteDetail">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php
                                                if(!empty($row['rfqImage'])){ ?>                                            
                                                    <img alt='RFQ Img' class='img-responsive imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$row['rfqImage']; ?>' > 
                                                    <?php
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-9">
                                            <h2><?php echo $row['rfqTitle'];?></h2>
                                            <p class="text-justify"><?php echo $row['rfqDesc']; ?></p>
                                        </div>
                                    </div>
                                    <div class="space"></div>
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
                                                    <td><?php echo $row['rfqQty']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Delivered (Days)</td>
                                                    <td><?php echo $row['rfqDelivered']; ?> Days</td>
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
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                        $r = new _rfq;
                        $result2 = $r->readMyQuote($_GET['rfq']);
                        if ($result2) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $dt = new DateTime($row2['rfqDate']);
                        }
                        ?>
                        <div class="bg_white_border quoteDetail">
                            <h2>You Have Submited The Following Quotes On <?php echo $dt->format('d M Y'); ?>!</h2>
                            <div class="row m_top_15">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr >
                                                    <td style="width: 200px;">Product Name</td>
                                                    <td><?php echo $row2['rfqcProductName']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Model Number</td>
                                                    <td><?php echo $row2['rfqcModelNum']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Cost Per Item/Piece</td>
                                                    <td>$<?php echo $row2['rfqPrice']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Minimum Order</td>
                                                    <td><?php echo $row2['rfqcMinOrder']; ?>Qty</td>
                                                </tr>
                                                <tr>
                                                    <td>Maximum Order</td>
                                                    <td><?php echo $row2['rfqcMaxOrder']; ?>Qty</td>
                                                </tr>
                                                <tr>
                                                    <td>Product Link</td>
                                                    <td><?php echo $row2['rfqcLinkProduct']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td><?php echo $row2['rfqDesc']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
