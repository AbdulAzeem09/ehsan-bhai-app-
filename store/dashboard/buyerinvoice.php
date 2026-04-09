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

    $re = new _redirect;


    if (isset($_GET['oid']) && $_GET['oid'] > 0) {
        $txnId = $_GET['oid'];

        $p = new _order;
        $result = $p->readTxnOrdBuy($txnId, $_SESSION['pid']);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $dt = new DateTime($row['sporderdate']);
            
        }else{
            $redirctUrl = $BaseUrl . "/store/dashboard/order_mang.php";
            $re->redirect($redirctUrl);
        }

    }else{
        
        $redirctUrl = $BaseUrl . "/store/dashboard/order_mang.php";
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
                        $activePage = 16;
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
                                            $result2 = $or->readTxnOrdBuy($txnId, $_SESSION['pid']);
                                            //echo $or->ta->sql;
                                            $total = 0;
                                            if ($result2) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $total = $total + $row2['sporderAmount'] * $row2['spOrderQty'];
                                                    $buyerId = $row2['spByuerProfileId'];
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $row2['spPostingTitle']; ?></td>
                                                        <td><?php echo "$".$row2['sporderAmount']; ?></td>
                                                        <td style="text-align: right;"><?php echo $row2['spOrderQty']; ?></td>
                                                        <td style="text-align: right;"><?php echo "$". $row2['sporderAmount'] * $row2['spOrderQty']; ?></td>
                                                   </tr>
                                                    <?php
                                                }                                                
                                            }
                                            ?>
                                            <tr style="font-weight: bold;">
                                                <td colspan="3" style="text-align: right;">Total</td>
                                                <td style="text-align: right;"><?php echo "$".$total; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <?php
                                $u = new _spuser;
                                $res = $u->readProfile($buyerId);
                                $us = new _spuser;

                                //echo $u->ta->sql;
                                if($res != false){
                                    $ruser = mysqli_fetch_assoc($res);
                                    // $username = $ruser["spUserName"]; 
                                    // $userpnone = $ruser["spUserPhone"]; 
                                    // $useremail = $ruser["spUserEmail"]; 
                                    // $useraddress = $ruser["spUserAddress"];
                                    // $usercountry = $ruser["spUserCountry"]; 
                                    // $userstate = $ruser["spUserState"]; 
                                    // $usercity = $ruser["spUserCity"]; 
                                    // $isPhoneVerify = $ruser["is_phone_verify"];
                                    $uid = $ruser['idspUser'];

                                    
                                    $result4 = $us->readship($uid);
                                    if ($result4) {
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $username       = $row4['shipName'];
                                        $userpnone      = $row4['shipPhone'];
                                        $useremail      = $row4["shipEmail"];
                                        $usercountry    = $row4['country_id'];
                                        $userstate      = $row4['state_id'];
                                        $usercity       = $row4['city_id'];
                                        $useraddress    = $row4['shipAddress'];
                                        
                                    }else{
                                        $username       = $ruser["spUserName"]; 
                                        $userpnone      = $ruser["spUserPhone"];
                                        $useremail      = $ruser["spUserEmail"];
                                        $usercountry    = $ruser["spUserCountry"];
                                        $userstate      = $ruser["spUserState"]; 
                                        $usercity       = $ruser["spUserCity"];
                                        $useraddress    = $ruser["spUserAddress"];
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div  class="col-md-6">
                                        <h4>Buyer Shipping Address</h4>
                                        <div class="table-responsive">
                                            <table class="table tbl_store_setting">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Name</strong></td>
                                                        <td><?php echo $username; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>City</strong></td>
                                                        <td><?php 
                                                            $co = new _city;
                                                            $result5 = $co->readCityName($usercity);
                                                            if ($result5) {
                                                                $row5 = mysqli_fetch_assoc($result5);
                                                                echo $row5['city_title'];
                                                            }
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>State</strong></td>
                                                        <td><?php 
                                                            $pr = new _state;
                                                            $result4 = $pr->readStateName($userstate);
                                                            if ($result4) {
                                                                $row4 = mysqli_fetch_assoc($result4);
                                                                echo $row4['state_title'];
                                                            }
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Country</strong></td>
                                                        <td><?php
                                                            $co = new _country;
                                                            $result3 = $co->readCountryName($usercountry);
                                                            if ($result3) {
                                                                $row3 = mysqli_fetch_assoc($result3);
                                                                echo $row3['country_title'];
                                                            }
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Phone Number</strong></td>
                                                        <td><?php echo $userpnone; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Address</strong></td>
                                                        <td><?php echo $useraddress; ?></td>
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
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
} ?>