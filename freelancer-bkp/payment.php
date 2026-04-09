<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 4;

    $p      = new _postingview;
    $fa     = new _freelance_account;
    // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
    $f = new _spprofiles;
    $re = new _redirect;
    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }
    // END
?>
<!DOCTYPE html>
<html lang="en-US">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">

    <head>
        <?php include('../component/f_links.php');?>
        
    </head>

    <body class="bg_gray">
    	<?php
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                
                <div class="col-xs-12 col-sm-3">
                    <div class="leftsidebar ">
                        <?php include('../component/left-freelancer.php');?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12  dashboard-section payment_margin bradius-15">
                        <div class="dashboardbreadcrum">
                            
                            <?php
                            $result3 = $fa->readProBlnc($_SESSION['pid']);
                            if($result3){
                                $row3 = mysqli_fetch_assoc($result3);
                                $myBlnc = $row3['fa_current_amount'];
                            }
                            ?>
                            <!-- Modal -->
                            <div id="addPayment" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content sharestorepos proposal_dialogbox">
                                        <form action="" method="post">
                                        
                                            
                                            <input type="hidden" name="email" value="sharepage_receiver@jouple.com">
                                           
                                            <input type="hidden" name="currencyCode" value="USD">
                                            <input type="hidden" name="cancelUrl" value="http://localhost/share-page/freelancer/payment_cancel.php"/>
                                            <input type="hidden" name="returnUrl" value="http://localhost/share-page/freelancer/payment_success.php">
                                            <input type="hidden" name="requestEnvelope.errorLanguage" value="en_US">
                                                                                   
                                            
                                            <div class="modal-header proposalheader_topborder">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Deposit Amount</h4>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <div class="form-group">
                                                    <label for="Amount">Amount in Dollar ($)</label>
                                                    <input type="text" class="form-control no-radius" id="amount" required="" name="amount" />
                                                </div>
                                            </div>
                                            <div class="modal-footer proposalheader_bottomborder">
                                                <button type="button" class="btn butn_cancel projetproperty_btn" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success projetproperty_btn" style="min-width: 130px;">Deposit Now</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn_freelancer pull-right" style="margin-top: 5px; border-radius: 30px!important;" data-toggle="modal" data-target="#addPayment">Deposit Amount</button>
                            <p class="pull-right" >My Balance : <span>$<?php echo isset($myBlnc)?$myBlnc:'0';?></span></p> 
                        </div>
                    </div>
                    <div class="col-xs-12 nopadding dashboard-section  bradius-15 " style="margin-top: 5px;">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive" style="height: auto; border-radius:15px;">
                                
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

                                        if(!empty($result)){
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
                                                        <a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-project-detail.php?postid='.$postId;?>" class="red freelancer_capitalize"><?php echo $ProjectName;?></a>
                                                    </td>
                                                    <td>$<?php echo $debit;?></td>
                                                    <td>$<?php echo $credit;?></td>
                                                    <td><?php echo $current_amt;?>$</td>
                                                    <td><?php echo $status;?></td>
                                                    <td><?php echo $dt->format('d M, Y');?></td>
                                                </tr><?php


                                            }
                                        }
                                        else{

                                            echo"
                                            
                                            <td colspan='6'>No Record Found</td>";
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
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>