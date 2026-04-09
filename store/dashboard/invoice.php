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

    if (isset($_GET['order']) && $_GET['order'] > 0) {
        $cid = $_GET['order'];

        $p = new _orderSuccess;
        $result = $p->readCnfrmOrdr($cid);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $txnId = $row['txn_id'];
            $dt = new DateTime($row['payment_date']);
            $paymentEmail = $row['payer_email'];
        }

    }else{
        $re = new _redirect;
        $redirctUrl = $BaseUrl . "/store/dashboard/my_order.php";
        $re->redirect($redirctUrl);
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
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
                        $activePage = 15;
                        include('left-menu.php'); 
                        ?> 
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = " Dashboard / Invoice";
                        include('../top-dashboard.php');
                        include('../searchform.php');  
                        
                        
                        ?>
                        
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white">
                                    <p class="text-right">
                                        <?php echo $dt->format('d M Y H:m:A'); ?><br>
                                        Transaction ID: <?php echo $txnId; ?>
                                    </p>
                                    <p>Hello <?php echo ucwords($_SESSION['MyProfileName']); ?>,</p>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Unit Price</th>
                                                <th style="text-align: right;">Qty</th>
                                                <th style="text-align: right;">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $or = new _order;
                                            $result2 = $or->readOrderTxn($txnId, $_SESSION['pid']);
                                            //echo $or->ta->sql;
                                            $total = 0;
                                            if ($result2) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $total = $total + $row2['sporderAmount'] * $row2['spOrderQty'];
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $row2['spPostingTitle']; ?></td>
                                                        <td><?php echo '$ '. $row2['sporderAmount']; ?></td>
                                                        <td style="text-align: right;"><?php echo $row2['spOrderQty']; ?></td>
                                                        <td style="text-align: right;"><?php echo '$ '.$row2['sporderAmount'] * $row2['spOrderQty']; ?></td>
                                                   </tr>
                                                    <?php
                                                }                                                
                                            }
                                            ?>
                                            <tr style="font-weight: bold;">
                                                <td colspan="3" style="text-align: right;">Total</td>
                                                <td style="text-align: right;"><?php echo '$ '. $total; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="text-right" style="font-weight: bold;">Payment Sent from <?php echo $paymentEmail; ?></p>
                                </div>
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
}
?>