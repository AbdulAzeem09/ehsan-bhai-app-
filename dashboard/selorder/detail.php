<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    

    $pageactive = 20;
    
    if (isset($_GET['orderid']) && $_GET['orderid'] > 0 ) {
        $orderid = $_GET['orderid'];
        $p = new _order;
        $c = new _categories;

        $result = $p->readOrder($orderid);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $title  = $row['spPostingTitle'];
            $desc   = $row['spPostingNotes'];
            $qtyBuy = $row['spOrderQty'];
            $qtyOrderAmt = $row['sporderAmount'];
            $orderDate = $row['sporderdate'];
            $txnId = $row['txn_id'];
            $postid = $row['idspPostings'];
            $status = $row['spOrderStatus'];
            $shipUserId = $row['spByuerProfileId'];
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        ;
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Product Detail</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Product Detail</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body proDetail">
                                                <h2><?php echo $title; ?></h2>
                                                <p><?php echo $desc; ?></p>
                                                <div class="row">
                                                    <?php
                                                    $pc = new _postingpic;
                                                    $res = $pc->read($postid);
                                                    //echo $pc->ta->sql;
                                                    if ($res) {
                                                        while($postr = mysqli_fetch_assoc($res)){
                                                            $picture = $postr['spPostingPic']; 
                                                            ?>
                                                            <div class="col-md-2 productPic">
                                                                <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" >
                                                            </div> <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="space"></div>
                                                <h2>Order Detail</h2>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-striped ">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Price</td>
                                                                    <td><?php echo $qtyOrderAmt; ?> USD</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Date / Time</td>
                                                                    <td><?php echo $orderDate; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Transcation Id</td>
                                                                    <td><?php echo $txnId; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Order Status</td>
                                                                    <td>
                                                                        <?php 
                                                                        if ($status == 1) {
                                                                            echo "Completed";
                                                                        }else{
                                                                            echo "Wating For Delivery";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Order Qty</td>
                                                                    <td><?php echo $qtyBuy; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <h2>Shipping Detail</h2>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <?php
                                                        $u = new _spuser;
                                                        $res = $u->readProfile($shipUserId);
                                                        //echo $u->ta->sql;
                                                        if($res != false){
                                                            $ruser = mysqli_fetch_assoc($res);
                                                            $username = $ruser["spUserName"]; 
                                                            $userpnone = $ruser["spUserPhone"]; 
                                                            $useremail = $ruser["spUserEmail"]; 
                                                            $useraddress = $ruser["spUserAddress"];
                                                            $usercountry = $ruser["spUserCountry"]; 
                                                            $userstate = $ruser["spUserState"]; 
                                                            $usercity = $ruser["spUserCity"]; 
                                                            $isPhoneVerify = $ruser["is_phone_verify"];
                                                        }
                                                        ?>
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td><?php echo $username; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td><?php echo $useremail; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Phone</td>
                                                                    <td><?php echo $userpnone; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Country</td>
                                                                    <td>
                                                                        <?php 
                                                                        $cn = new _country;
                                                                        $result4 = $cn->readCountryName($usercountry);
                                                                        if ($result4) {
                                                                            $row4 = mysqli_fetch_assoc($result4);
                                                                            echo $row4['country_title'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>State</td>
                                                                    <td>
                                                                        <?php 
                                                                        $pr = new _state;
                                                                        $result2 = $pr->readStateName($userstate);
                                                                        if ($result2) {
                                                                            $row2 = mysqli_fetch_assoc($result2);
                                                                            echo $row2['state_title'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>City</td>
                                                                    <td>
                                                                        <?php 
                                                                        $co = new _city;
                                                                        $result3 = $co->readCityName($usercity);
                                                                        if ($result3) {
                                                                            $row3 = mysqli_fetch_assoc($result3);
                                                                            echo $row3['city_title'];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Address</td>
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
                    </div>
                </div>
                




            </div>
        </section>

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <script>
            $(function() {
                $(':checkbox').checkboxpicker();
            });
        </script>
    </body> 
</html>
<?php
} ?>