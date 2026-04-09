<?php 
    include('../univ/baseurl.php');
    session_start();
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 4;

    $p      = new _postingview;
    $fa     = new _freelance_account;
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
    	<?php
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12  dashboard-section">
                        <div class="dashboardbreadcrum">
                            <ul class="breadcrumb" style="display: inline-block;">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer/projects.php">Dashboard</a></li>
                                <li>Payment</li>

                            </ul>
                            <?php
                            $result3 = $fa->readUserBlnc($_SESSION['uid']);
                            if($result3){
                                $row3 = mysqli_fetch_assoc($result3);
                                $myBlnc = $row3['fa_current_amount'];
                            }
                            ?>
                            <!-- Modal -->
                            <div id="addPayment" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content no-radius">
                                        <form action="" method="post">
                                        
                                            
                                            <input type="hidden" name="email" value="sharepage_receiver@jouple.com">
                                           
                                            <input type="hidden" name="currencyCode" value="USD">
                                            <input type="hidden" name="cancelUrl" value="http://localhost/share-page/freelancer/payment_cancel.php"/>
                                            <input type="hidden" name="returnUrl" value="http://localhost/share-page/freelancer/payment_success.php">
                                            <input type="hidden" name="requestEnvelope.errorLanguage" value="en_US">
                                                                                   
                                            
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Deposit Amount</h4>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <div class="form-group">
                                                    <label for="Amount">Amount in Dollar ($)</label>
                                                    <input type="text" class="form-control no-radius" id="amount" required="" name="amount" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Deposit Now</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn_freelancer pull-right" style="margin-top: 5px;" data-toggle="modal" data-target="#addPayment">Deposit Amount</button>
                            <p class="pull-right" >My Balance : <span><?php echo isset($myBlnc)?$myBlnc:'';?>$</span></p> 
                        </div>
                    </div>
                    <div class="col-xs-12 nopadding dashboard-section">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive" style="min-height: 300px;">
                                
                                <table class="table text-center tbl_activebid">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th style="text-align: center;">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = $fa->readUser($_SESSION['uid']);
                                        if($result){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $postId     = $row['spPosting_idspPostings'];
                                                $debit      = $row['fa_debit'];
                                                $credit     = $row['fa_credit'];
                                                $current_amt = $row['fa_current_amount'];
                                                $status     = $row['fa_status'];
                                                $transrDate = $row['fa_date'];
                                                $dt = new DateTime($transrDate);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                        $result2 = $p->read($postId);
                                                        if($result2){
                                                            $row2 = mysqli_fetch_assoc($result2);
                                                            $ProjectName = $row2['spPostingtitle'];
                                                        }
                                                        
                                                        ?>
                                                        <a href="<?php echo $BaseUrl.'/freelancer/active-project-detail.php?postid='.$postId;?>" class="red"><?php echo $ProjectName;?></a>
                                                    </td>
                                                    <td>$<?php echo $debit;?></td>
                                                    <td>$<?php echo $credit;?></td>
                                                    <td><?php echo $current_amt;?>$</td>
                                                    <td><?php echo $status;?></td>
                                                    <td><?php echo $dt->format('d M, Y');?></td>
                                                </tr><?php


                                            }
                                        }

                                        ?>
                                        



                                    </tbody>
                                </table>
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
