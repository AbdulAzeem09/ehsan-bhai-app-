<?php
//die('+++==========11');
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../../univ/baseurl.php');
session_start();
//die('+++++++++++++++++++');
//print_r($_SESSION);die;

if (!isset($_SESSION['pid'])) {

    $_SESSION['afterlogin'] = "store/";
    include_once("../../authentication/islogin.php");
} else {
    function sp_autoloader($class)
    {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $re = new _redirect;
    $p = new _productposting;
    /*
  if($_SESSION['ptid'] == 2 ||  $_SESSION['ptid'] == 5){
  $redirctUrl = $BaseUrl . "/store/storeindex.php";
  $_SESSION['count'] = 0;
  $_SESSION['msg'] = "Selling not allowed on this profile. Please switch to other one.";
  $re->redirect($redirctUrl);
  }
  */

    if (($_SESSION['ptid'] == 2) || ($_SESSION['ptid'] == 5) || ($_SESSION['ptid'] == 6)) {


        header("Location: $BaseUrl/store/storeindex.php?folder=home");
    }

    $_GET["module"] = "1";
    $_GET["categoryid"] = "1";
    $_GET["profiletype"] = "1";
    $_GET["categoryname"] = "Sell";

    //echo "<pre>";
    //print_r($_SESSION);

    if ($_SESSION['ptid'] == 1) {


        $f = new _spuser;

        // $de = $f->de();
        // print_r($de);
        // die('xxxxx');
        // while ($row = mysqli_fetch_assoc($de)) {
        // 	print_r($row);

        // }


        $fil = $f->read1($_SESSION['pid']);
        //print_r($fil);die("================");
        if ($fil) {
            $r = mysqli_fetch_assoc($fil);
            //print_r($r); die("-----------------");
            $pid = $r['sp_pid'];
            //echo $pid;die('====');
            if ($r['status'] != 2) {
                header("Location: $BaseUrl/store/dashboard/?msg=notverified");
            }
        } else {
            header("Location: $BaseUrl/store/dashboard/?msg=notverified");
        }
    }

    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if ($res != false) {
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"];
        $userstate = $ruser["spUserState"];
        $usercity = $ruser["spUserCity"];
    }
    // THIS IS POSTING DETAIL

    $profileid = "";
    $eCountry = "";
    $eCity = "";
    $eCityID = "";
    $eCategory = "";
    $eSubCategoryID = "";
    $eSubCategory = "";
    $ePostTitle = "";
    $ePostNotes = "";
    $eExDt = "";
    $ePrice = "";
    $shipping = "";
    $visibility = "";

    if (isset($_GET["postid"])) {

        $r = $p->read($_GET["postid"]);
        //echo $p->ta->sql;
        if ($r != false) {
            while ($row = mysqli_fetch_assoc($r)) {
                // print_r($row);
                //die('=====');
                $ePostTitle     = $row["spPostingTitle"];
                $ePostNotes     = $row["spPostingNotes"];
                $specification   = $row["specification"];
                $description     = $row["description"];
                $eExDt          = $row["spPostingExpDt"];
                $ePostDate      = $row['spPostingDate'];
                $ePrice         = $row["spPostingPrice"];
                $profileid      = $row['spProfiles_idspProfiles'];
                $postingflag    = $row['spPostingsFlag'];

                $category    = $row['subcategory'];
                $barcode    = $row['barcode'];


                $quantitytype = $row['quantitytype'];
                //$phone = $row['spPostingPhone'];
                $shipping       = $row['sppostingShippingCharge'];
                $eCountry       = $row['spPostingsCountry'];
                $eCity          = $row['spPostingsCity'];
                $visibility     = $row['spPostingVisibility'];
            }
        }

        $po = new _productposting;

        $result_fel = $po->read($_GET['postid']);
        //echo $po->ta->sql;
        $ItemCondition = '';
        $ExpiryDate = '';



        if ($result_fel != false) {
            while ($row_fel = mysqli_fetch_assoc($result_fel)) {


                $auctionStatus = $row_fel['auctionStatus'];

                $spOrderQty_11    = $row_fel['spOrderQty'];
                $wholesaleQuantity    = $row_fel['wholesaleQuantity'];


                $selltype = $row_fel['sellType'];

                $retailQuantity = $row_fel['retailQuantity'];
                $retailSpecDiscount = $row_fel['retailSpecDiscount'];
                $retailDiscount = $row_fel['retailDiscount'];
                $retailStatus = $row_fel['retailStatus'];
                $producttype = $row_fel['product_type'];


                if ($selltype == "Auction") {

                    $Quantity = $row_fel['auctionQuantity'];
                } elseif ($selltype == "Retail") {

                    $Quantity = $row_fel['retailQuantity'];
                } elseif ($selltype == "Wholesale") {

                    $Quantity = $row_fel['supplyability'];
                }

                if ($selltype == "Auction") {

                    $ItemCondition = $row_fel['auctionStatus'];
                } elseif ($selltype == "Retail") {

                    $ItemCondition = $row_fel['retailStatus'];
                }

                $price = $row_fel['spPostingPrice'];

                if ($selltype == "Auction") {

                    $ExpiryDate = $row_fel['spPostingExpDt'];
                } elseif ($selltype == "Retail") {

                    $ExpiryDate = $row_fel['spPostingExpDt'];
                }



                $minorderqty = $row_fel['minorderqty'];
                $supplyability = $row_fel['supplyability'];
                $paymentterm = $row_fel['paymentterm'];
                $industryType = $row_fel['industryType'];
                $sippingcharge = $row_fel['sippingcharge'];
                $fixedamount = $row_fel['fixedamount'];
                $weight_shipping = $row_fel['weight_shipping'];
                $height_shipping = $row_fel['height_shipping'];
                $depth_shipping = $row_fel['depth_shipping'];
                $width_shipping = $row_fel['width_shipping'];

                /*   $cancel= $row_fel['is_cancel'];
        $refund= $row_fel['is_refund'];
        $refundwithin= $row_fel['refund_within'];*/
            }
        }


        $or = new _order;
        $total = 0;
        $res = $or->quantityavailable($_GET["postid"]);
        if ($res != false) {
            while ($order = mysqli_fetch_assoc($res)) {
                if ($order["spOrderStatus"] == 0) {
                    $soldquantity += $order["spOrderQty"];
                }
            }
        }

        if (isset($soldquantity)) {
            $available = $totalquantity - $soldquantity;
        } else {
            $available = 0;
        }
    }
    $p = new _spprofiles;
    $res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

    if ($res != false) {
        $r = mysqli_fetch_assoc($res);
        $profileid = $r['idspProfiles'];
        $country = $r["spProfilesCountry"];
        $city = $r["spProfilesCity"];
    }
    if (isset($_GET["postid"])) {
        $p1 = new _productposting;

        $res = $p1->read($_GET["postid"]);
        $cp = $res->num_rows;
        //var_dump($cp);die;
        //echo $cp;
        //die("ssss");
        if ($cp == false) {

            header("Location: $BaseUrl/store/dashboard/active_product.php?msg=notacess");
        }

        if ($res != false) {
            while ($row = mysqli_fetch_assoc($res)) {
                $spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];

                if ($_SESSION['pid'] != $spProfiles_idspProfiles) {

                    header("Location: $BaseUrl/store/dashboard/active_product.php?msg=notacess");
                }
            }
        }
    }
    /*
  $objpost = new _postenquiry;
  $result = $objpost->readpost($_SESSION['uid']);
  if($result !=false){
  while($row=mysqli_fetch_assoc($result)){
  $result4=$row['sp_pid'];
  $result5=$row['spProfileType_idspProfileType'];
  //print_r($row);
  //die('kkkkkk');













  $objpr=new _postenquiry;
  $result98=$objpr->read98($result4);
  $row98=mysqli_fetch_assoc($result98);
  //echo $row98['spProfileEmail'];
  //die('kkkkkk');




  //$result99=$objpr->read99($result5);
  //$row99=mysqli_fetch_assoc($result99);
  //print_r($row99);
  //die('mmmm');


  if($row['status'] != 2){

  //die('kkkkkkk');
  //header("Location: $BaseUrl/store/storeindex.php?msg=notverified");
  //header("location:posting.php");
  }
  }
  }else{
  //die('kkkk555kkk');
  header("Location: $BaseUrl/store/storeindex.php?msg=notverified");

  }
  */
    //echo $_GET["groupid"]."jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";

    ?>

    <?php


    if ($_SESSION['ptid'] == 1) {


        if (empty($_GET['postid'])) {
            //	if(($final_date >= 90) ){

            $mb = new _spmembership;
            $result = $mb->readpid($_SESSION['pid']);
            if ($result != false) {

                while ($rows = mysqli_fetch_assoc($result)) {
                    //print_r($rows);
                    $payment_date = $rows["createdon"];
                    $duration = $rows['duration'];

                    /*$res = $mb->readmember($rows["membership_id"]);
          if($res != false)
          {
          $row = mysqli_fetch_assoc($res);
          //echo $row["spMembershipName"]."<br>";
          //$count=$row["spMembershipPostlimit"];
          $duration=$row["duration"];*/

                    //print_r($row);
                    $date7 =  date('Y-m-d H:i:s');
                    $date8 = date('Y-m-d', strtotime($date7));
                    $date5 = date('Y-m-d', strtotime($payment_date));
                    $date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
                    //echo  $date5."<br>".$date6."<br>".$date8; die;
                    if (!(($date5 <= $date8)  && ($date6 >=  $date8))) { ?>
                        <script>
                            // alert('eeeeeee');
                            // window.location.replace("/membership?msg=notaccess");
                        </script>

                        <?php
                    }
                    //}
                }
            } else {

                $mb = new _spmembership;
                $result_1 = $mb->read_data($_SESSION['pid']);
                $num = 0;
                if ($result_1) {
                    $num = mysqli_num_rows($result_1);
                }

                if ($num >= 2) {


                    ?>
                    <script>
                        window.location.replace("/membership?msg=notaccess");
                    </script>
                    <?php
                }
            }
            //	}



        }
    }
    ?>








    <style>
        #btnmobSet {
            margin-left: 209px !important;
            margin-top: 11px !important;

        #sppreviewSaveDraftStore {
            padding-bottom: 5px !important;

        }

        #sell_can {
            padding-bottom: 5px !important;
        }

        #postingtype {
            padding-bottom: 5px !important;
        }

        a:focus,
        a:hover {
            color: #09200a !important;
            text-decoration: underline;
        }
    </style>


    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="The SharePage">


        <title>The SharePage</title>

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

        <link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">

        <!--Bootstrap core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!--Font awesome core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!--custom css jis ki wja say issue ho rha tha form submit main-->
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo $BaseUrl;  ?>/assets/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" />


        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!-- PAGE SCRIPT -->
        <?php $aa = rand(10, 100); ?>
        <!--<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/posting/store.js?<?php echo $aa; ?>"></script>

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
        <!-- DATE AND TIME PICKER -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
        <!--post group button on btm of the form-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style type="text/css">
            .bootstrap-tagsinput .tag {
                margin-right: 2px;
                color: white !important;
                background-color: #0d6efd;
                padding: 0.2rem;
            }
        </style>

        <script>
            function numericFilter(txb) {
                txb.value = txb.value.replace(/[^\0-9]/ig, "");
            }
        </script>
        <script type="text/javascript">
            $(function() {

                $('#sppostingShippingCharge').keypress(function(event) {
                    if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                        event.preventDefault(); //stop character from entering input
                    }
                });
            });


        </script>
        <?php
        $urlCustomCss = $BaseUrl . '/component/custom.css.php';
        include $urlCustomCss;
        ?>
        <link href="<?php echo $BaseUrl; ?>/assets/css/design.css" rel="stylesheet" type="text/css">
        <style type="text/css" media="screen">
            .btn:focus {
                ouline: 0px;
            }
            body {
                font-family: "Open Sans";
            }
            body {
                font-size: 14px !important;
            }
            .form-control{
                font-size: 14px !important;
            }

            #wrapper {

                display: inline;


            }

            #wrapper1 {

                display: inline;



            }

            .inner_top_form button {


                padding:9px!important;
            }
            .needs-validation .add_form_body .radio,
            .needs-validation .add_form_body input[type=date], .needs-validation
            .add_form_body input[type=number],
            .needs-validation .add_form_body input[type=text],
            .needs-validation .add_form_body input[type=time],
            .needs-validation .add_form_body select,
            .needs-validation .add_form_body textarea {
                border: 1px solid #dee2e6;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                background-color: #fff;
            }
            .select2-container {
                display: block !important;
                width: 100% !important ;
            }

        </style>
    </head>

    <body onload="pageOnload('post')">

    <?php
    $header_store = "header_store";
    include_once("../../header.php");


    $p = new _spprofiles;

    $res = $p->read($_SESSION['pid']);
    if ($res != false) {

        $r = mysqli_fetch_assoc($res);
        //echo "<pre>";
        //print_r($_SESSION['ptid']);
        //print_r($r); die("-----------");
        $name = ucwords(strtolower($r['spProfileName']));
        $icon = $r['spprofiletypeicon'];
        $spProfileType_idspProfileType = $r['spProfileType_idspProfileType'];
        $spdate_created = $r['spdate_created'];
        $Date =  $spdate_created;
        $date1 =  strtotime($Date);

        $date2 =  date('Y-m-d H:i:s');
        $date3 = strtotime($date2);
        //echo $date1."<br>".$date3;



        $datediff = $date3  -  $date1;
        //echo "<br>";
        $final_date = round($datediff / (60 * 60 * 24));
    } else {

        $name = "Select Profile";
        $icon = "<i class='fa fa-user'></i>";
    }
    $resultOfProfile  = $p->read($_SESSION["pid"]);
    if ($resultOfProfile != false) {
        $sprows = mysqli_fetch_assoc($resultOfProfile);
        $profileType = $sprows["spProfileType_idspProfileType"];
    }


    /*if(empty($_GET['postid'])){
$mb = new _spmembership;
if($_SESSION['ptid'] == 1 ){

if(($final_date >= 90) ){


$result = $mb->readpid($_SESSION['pid']);


if($result != false){
while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$payment_date = $rows["createdon"];

$res = $mb->readmember($rows["membership_id"]);
if($res != false)
{
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
$count=$row["spMembershipPostlimit"]."<br>";
$duration=$row["spMembershipDuration"];

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8=date('Y-m-d', strtotime($date7));
$date5= date('Y-m-d', strtotime($payment_date));
$date6= date('Y-m-d', strtotime($payment_date. ' +'. $duration.' days'));
// echo   $date5."<br>".$date6."<br>".$date8;
if(!(($date5 <= $date8)  && ($date6 >=  $date8))){ ?>
<script>
window.location.replace("/membership?msg=notaccess");
</script>

<?php   }



}

}}

else {





?>

<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php

}


}
} }*/

    ?>
    <style>
        #car1 {
            margin-top: 10px;

        }

    </style>
    <div class="loadbox">
        <div class="loader"></div>
    </div>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 no-padding hidden-xs">
                    <div class="left_saa">
                        <img src="<?php echo $BaseUrl; ?>/assets/images/submit-add/l-sadd.jpg" class="img-responsive" alt="" />
                    </div>
                </div>

                <div class="col-md-9 col-xs-12">

                    <div class="row">
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" class="needs-validation" novalidate action="<?php echo $BaseUrl ?>/post-ad/dopostproduct.php" method="post" id="sp-form-post" name="postform">
                                <div class="modTitle" style="padding-left: 15px;">
                                    <h2><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color: #337ab7!important;font-size:12.5px"><span>RETURN TO STORE</span></a></h2>
                                </div>
                                <div class="add_form bradius-15" style="border-radius: 20px;border-top-left-radius: 20px;border-top-right-radius: 20px; ">
                                    <?php


                                    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
                                        if ($visibility == 0) {
                                            $lblpage = "This is a draft posting";
                                        } else if ($visibility == -2) {
                                            $lblpage = "De-Activate Product";
                                        } else if (isset($_GET['exp']) && $_GET['exp'] == 1) {
                                            $lblpage = "Expird Post";
                                        } else {
                                            $lblpage = "Update post";
                                        }
                                    } else {
                                        //$lblpage = "SUBMIT AN AD";
                                        $lblpage = "SELL YOUR ITEMS";
                                    }
                                    ?>
                                    <h3 style="border-top-left-radius: 20px!important;border-top-right-radius: 20px!important;font-size: 20px;background-color: #cef5cf!important;"><i class="fa fa-pencil"></i> <b><?php echo $lblpage; ?></b> <a href="<?php echo $BaseUrl . '/store/dashboard'; ?>" class="pull-right stordashclr" style="color: #0a160a;;"><i class="fa fa-dashboard"></i> Dashboard</a></h3>

                                    <div class="add_form_body">
                                        <?php if ($profileType == '2' || $profileType == '5') {
                                            echo "Please choose other profile for selling products.";
                                            exit;
                                        } ?>
                                        <div class="">
                                            <div class="">
                                                <div style="padding-bottom: 0px;padding-top: 11px;">
                                                    <div class="row no-margin">
                                                        <div class="col-md-3 no-padding">

                                                        </div>

                                                        <div class="col-md-6 col-xs-12 ">
                                                            <?php
                                                            echo "<input type='hidden' id='postprofile' value='" . $profileid . "'>";

                                                            ?>
                                                            <div class="addcustomsell ">
                                                                <div class="form-group">
                                                                    <div class="sell_rad" style="padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px; <?php if (isset($_GET['postid'])) {
                                                                        echo "text-align: center;";
                                                                    } ?>">


                                                                        <?php if (isset($_GET['postid'])) { ?>

                                                                            <label for="sellType_" class="">Selected Sell Type :&nbsp;</label>
                                                                            <label><?php echo $selltype; ?></label>
                                                                            <input type="hidden" id="sellType_" name="sellType" value="<?php echo $selltype; ?>">


                                                                        <?php } else { ?>

                                                                            <label for="sellType_" class="">Select Sell Type :&nbsp;</label>
                                                                            <select class="form-control spPostField" data-filter="1" name="sellType" id="sellType_" style="width: 133px;display: inline;border-radius: 17px;border: 2px solid #5cb85c;" <?php if (!empty($selltype)) {
                                                                                echo "disabled";
                                                                            } ?>>

                                                                                <option value="0">Select Type</option>
                                                                                <?php
                                                                                if ($_SESSION['ptid'] == 1) { ?>


                                                                                    <option value="Auction" <?php if ($selltype == "Auction") {
                                                                                        echo "selected";
                                                                                    } ?>>Auction</option>


                                                                                    <option value="Retail" <?php if ($selltype == "Retail") {
                                                                                        echo "selected";
                                                                                    } ?>>Retail</option>

                                                                                    <option value="Wholesale" <?php if ($selltype == "Wholesale") {
                                                                                        echo "selected";
                                                                                    } ?>>Wholesale</option>
                                                                                <?php } else { ?>


                                                                                    <option value="Personal" <?php if ($selltype == "Personal") {
                                                                                        echo "selected";
                                                                                    } ?>>Personal</option>


                                                                                    <option value="Auction" <?php if ($selltype == "Auction") {
                                                                                        echo "selected";
                                                                                    } ?>>Auction</option>
                                                                                <?php } ?>
                                                                            </select>

                                                                        <?php } ?>

                                                                    </div>




                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-3 col-xs-12" style="padding-top: 10px;">



                                                            <div class="dropdown profilecentr pull-right <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>">

                                                            </div>

                                                            <?php if (isset($_GET['postid'])) { ?>
                                                                <h5 style="float: right;"> Product Id : <?php echo $_GET['postid']; ?></h5>

                                                            <?php } ?>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="space"></div>
                                                <?php if (isset($_GET['postid'])) { ?>

                                                <div id="sell_frm">

                                                    <?php  } else { ?>


                                                    <div id="sell_frm" style="display:none;">


                                                        <?php  } ?>


                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <input type="hidden" id="postid" value="<?php if (isset($_GET['postid'])) {
                                                                    echo $_GET["postid"];
                                                                } ?>">

                                                                <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">

                                                                <input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">

                                                                <input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">

                                                                <input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
                                                                <?php
                                                                $userid = $_SESSION['uid'];
                                                                //$profid=$_SESSION['pid'];
                                                                $c = new _spuser;
                                                                $currency = $c->getcurrency($userid);
                                                                if ($currency) {
                                                                    $res = mysqli_fetch_assoc($currency);
                                                                    $curre = $res['currency'];
                                                                }
                                                                ?>


                                                                <!--<div class="form-group">
                              <!--<label for="default-currency" >Default Currency<span>* <span class="lbl_1"></span></span></label>
                              <label for="spPostingTitle" >Currency <span>* <span class="lbl_1"></span></span></label>


                              </div>-->
                                                                <input type="hidden" class="form-control" readonly id="default_currency" name="default_currency" value="<?php echo $curre; ?>" placeholder="" required />

                                                                <input id='idspPostings' name='idspPostings' value="<?php echo $_GET["postid"]; ?>" type='hidden'>

                                                                <div class="row no-margin">
<!--                                                                    <div id="invalid"></div>-->
                                                                    <h1>Add Product</h1>

                                                                    <div class="col-8">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control" id="floatingInput" autofocus required>
                                                                            <label for="floatingInput">Find Barcode (GTIN, UPC, EAN, JAN or ISBN)</label>
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="productType" id="productType1" checked>
                                                                            <label class="form-check-label" for="productType1">
                                                                                Simple
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="productType" id="productType2">
                                                                            <label class="form-check-label" for="productType2">
                                                                                Variable
                                                                            </label>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks Good
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 mb-2">
                                                                        <label for="exampleFormControlInput1" class="form-label">Select Brand</label>
                                                                        <select class="form-select select2" aria-label="Default select example" required>
                                                                            <option selected>Select Brand</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Select Category</label>
                                                                        <select class="form-select select2" aria-label="Default select example" required>
                                                                            <option selected>Select Category</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mb-3">
                                                                            <label for="spPostingTitle" class="form-label">Product Title<span>* <span class="lbl_1"></span></span></label>
                                                                            <input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" maxlength="40" value="<?php echo $ePostTitle ?>" placeholder="" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label for="exampleFormControlTextarea1" class="form-label">Short Description<span>* <span class="lbl_1"></span></span></label>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-3">
                                                                        <label for="exampleFormControlTextarea1" class="form-label">Details<span>* <span class="lbl_1"></span></span></label>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Weight in Kgs<span>* <span class="lbl_1"></span></span></label>
                                                                        <input type="text" class="form-control"placeholder="kgs" required>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Dimensions in cm</label>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">Length<span>* <span class="lbl_1"></span></span></span>
                                                                            <input type="text" class="form-control" placeholder="Length" aria-label="Length" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                            <span class="input-group-text" id="basic-addon1">Width<span>* <span class="lbl_1"></span></span></span>
                                                                            <input type="text" class="form-control" placeholder="Width" aria-label="Width" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                            <span class="input-group-text" id="basic-addon1">Height<span>* <span class="lbl_1"></span></span></span>
                                                                            <input type="text" class="form-control" placeholder="Height" aria-label="Height" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Stock Availability<span>* <span class="lbl_1"></span></span></label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="stockAvail" id="stockAvail1" checked>
                                                                            <label class="form-check-label" for="stockAvail1">
                                                                                Yes
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="stockAvail" id="stockAvail2">
                                                                            <label class="form-check-label" for="stockAvail2">
                                                                                No
                                                                            </label>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks Good
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Min Stock Alert<span>* <span class="lbl_1"></span></span></label>
                                                                        <input type="number" class="form-control" id="exampleFormControlInput1" required>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Available Stock<span>* <span class="lbl_1"></span></span></label>
                                                                        <input name='number' class="form-control" required>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="exampleFormControlInput1" class="form-label">Sale Duration</label>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">Start Sale<span>* <span class="lbl_1"></span></span></span>
                                                                            <input type="date" class="form-control" placeholder="Width" aria-label="Width" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                            <span class="input-group-text" id="basic-addon1">End Sale<span>* <span class="lbl_1"></span></span></span>
                                                                            <input type="date" class="form-control" placeholder="Height" aria-label="Height" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Prices</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" placeholder="Ragular Price" aria-label="Ragular Price" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                            <input type="text" class="form-control" placeholder="Sale Price" aria-label="Sale Price" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                            <input type="text" class="form-control" placeholder="Wholesale Price" aria-label="Wholesale Price" aria-describedby="basic-addon1" required>
                                                                            <div class="invalid-feedback">
                                                                                Field is Require
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="exampleFormControlInput1" class="form-label">Customer Can Cancel</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="customerCanCancel" id="customerCanCancel1" checked>
                                                                            <label class="form-check-label" for="customerCanCancel1">
                                                                                Yes
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="customerCanCancel" id="customerCanCancel2">
                                                                            <label class="form-check-label" for="customerCanCancel2">
                                                                                No
                                                                            </label>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks Good
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="exampleFormControlInput1" class="form-label">Customer Can Review</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="customerCanReview" id="customerCanReview1" checked>
                                                                            <label class="form-check-label" for="customerCanReview1">
                                                                                Yes
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="customerCanReview" id="customerCanReview2">
                                                                            <label class="form-check-label" for="customerCanReview2">
                                                                                No
                                                                            </label>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks Good
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="exampleFormControlInput1" class="form-label">Product Tags<span>* <span class="lbl_1"></span></span></label>
                                                                        <input name='tags' class="form-control" required>
                                                                        <div class="invalid-feedback">
                                                                            Field is Require
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Primary Image</label>
                                                                        <input type="file" name="">
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="exampleFormControlInput1" class="form-label">Secondary Image</label>
                                                                        <input type="file" name="">
                                                                    </div>
                                                                    <input type="submit" name="">

                                                        </div>


                                                        <?php if (isset($_GET['postid'])) { ?>


                                                        <div class="row no-margin" id="bootomsellfrm" style="padding: 15px;">

                                                            <?php  } else { ?>




                                                            <div class="row">
                                                                <div class="col-md-4" style="margin-left:30px;">
                                                                    <div id="sp-group-container" class="input-group hidden">
                                                                        <input class="form-control publicbtn" id='group_' name="group" type="text" placeholder="Type to Select Group...">

                                                                        <span class="input-group-btn">
                                            <a href="../../my-groups/" class="btn btn-default publicbtn_drpdown" type="button">Add New</a>
                                          </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row no-margin" id="bootomsellfrm" style="padding: 15px;;display:none;">


                                                                <?php  } ?>


                                                                <div class="col-md-3 col-xs-12">
                                                                    <div class="btn-group">
                                                                        <button id="postingtype" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="button" style="padding-bottom: 5px; border-radius:50px;" class="  btn btn-success  <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public &nbsp;<span class="caret"></span></button>


                                                                        <!--  <button type="button" style="padding-bottom: 21px;" class="btn  btn-success dropdown-toggle publicbtn_drpdown yle<?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>"  style="height: 34px;"></button>-->
                                                                        <ul class="dropdown-menu posttype" style="    border-radius: 15px!important;">
                                                                            <li><a id="postpublic" style="cursor:pointer;" class="publicselect">Public</a></li>
                                                                            <li><a id="postgroup" style="cursor:pointer;" class="publicselect">Group</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-8  col-xs-12" id="btnmobSet " style="margin-left: 50px;
margin-top: px;">
                                                                    <?php

                                                                    if (isset($_GET['postid']) && $_GET['postid'] > 0) {

                                                                        if ($visibility == 1) {
                                                                            ?>
                                                                            <button id="spPostSubmitStorepublish" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;  background-color: #4fa951!important;    margin-left: -97px; ">Publish</button>

                                                                            <button id="spprevieweditSaveDraftStore" type="button" class="btn butn_draf bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;">Save Draft</button>
                                                                            <button id="sppreviewSaveDraftStore" type="button" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(9 0deg,#1c6121 0,#1c6121 99%); padding-bottom: 5px;"> Preview</button>


                                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php/'; ?>" class="btn butn_cancel" style="border-radius: 20px!important;background-color: #e52f2f!important;">Cancel Post</a>
                                                                            <?php
                                                                        } else if ($visibility == -2) {
                                                                            ?>
                                                                            <button id="spPostSubmitStore" type="button" class="btn butn_draf" style="border-radius: 20px!important;;">Upadate & Activate Product</button>
                                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/deactive.php/'; ?>" class="btn butn_cancel bradius-20" style="border-radius: 20px!important;;">Cancel Post</a>
                                                                            <?php

                                                                        } else if (isset($_GET['exp']) && $_GET['exp'] == 1) {

                                                                            ?>
                                                                            <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Repost</button>
                                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/expire.php/'; ?>" class="btn butn_cancel" style="border-radius: 20px!important;;">Cancel Post</a>
                                                                            <?php

                                                                        } else {
                                                                            if ($visibility == 0) {

                                                                                ?>

                                                                                <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Publish</button>&nbsp;&nbsp;&nbsp;

                                                                                <button id="spPostSaveStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Save</button>&nbsp;&nbsp;&nbsp;
                                                                            <?php  } else { ?>
                                                                                <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Update</button>&nbsp;&nbsp;&nbsp;
                                                                            <?php  }
                                                                            ?>


                                                                            <?php
                                                                            if ($visibility == -1) { ?>
                                                                                <button id="spSaveDeactiveStore" type="button" class="btn butn_draf bradius-20" style="border-radius: 20px;">De-Activate</button>&nbsp;&nbsp;&nbsp;
                                                                                <?php
                                                                            }

                                                                            ?>





                                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php/'; ?>" class="btn butn_cancel bradius-20" style="border-radius: 20px!important;">Cancel Post</a>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>

                                                                        <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>" id="sell_can" class="btn butn_cancel bradius-20" style="border-radius: 20px;    background-color: #17b79c;">View All Drafts</a>&nbsp;&nbsp;


                                                                        <button id="sppreviewSaveDraftStore" type="button" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%); padding-bottom: 5px;"> Preview</button>

                                                                        <input type="submit" name="" value="Save into draft" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%); padding-bottom: 5px;">
<!--                                                                        <button id="spdraft" type="button" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%); padding-bottom: 5px;">Save into draft</button>-->


                                                                        <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" id="sell_can" class="btn butn_cancel bradius-20" style="border-radius: 20px;    background-color: #e12d2d;">Reset Post</a>

                                                                        <?php
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                    if (isset($_GET["postid"])) { ?>

                                                                        <a class='btn btn-info pull-right  btn-border-radius' onclick="return confirm('Are You Sure')" style='width: 125px;    background-color: #e52f2f!important;    border-color: white;' href='deletePost.php?postid=<?php echo  $_GET['postid'] ?> '>Delete post</a>
                                                                    <?php     } ?>




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
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php include('../../component/f_footer.php'); ?>

    <!-- bootstrap color picker -->
    <script src="<?php echo $BaseUrl . '/assets/colorpicker/bootstrap-colorpicker.min.js';  ?>" type="text/javascript"></script>
    <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
    <?php include('../../component/f_btm_script.php'); ?>
    <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

    <script type="text/javascript">
        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();
    </script>
    </body>

    </html>
    <?php
}
?>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $('#spPostingTitle').keypress(function() {

            $('.lbl_1').remove();

        });

        $('#filesaaa1').click(function() {

            var img = $('#filesaaa1').val();
            //alert("sfjdsfjd");
            if (img == "") {
                $('.lbl_15').remove();
            }
        });

        $('#sppreviewSaveDraftStore').click(function() {
            $("#invalid").hide();

        });

        //copy
        $('#spdraft').click(function() {
            $("#invalid").hide();

        });



    });
</script>
<script type="text/javascript">
    $(function() {

        $(".addcustomsell").on("change", "#sellType_", function(e) {



            if ($(this).val() == "Auction") {



                $(".hidbuy").load("../auction.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(2);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);

                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "Wholesale") {

                //wholesale panel
                $(".hidbuy").load("../wholesell.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(0);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);
                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "Retail") {

                $(".hidbuy").load("../retail.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(2);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);
                });

                $("#sell_frm").show(1000);


            } else if ($(this).val() == "Personal") {

                $(".hidbuy").load("../personalSell.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(2);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);
                    $("#bar_c").hide();
                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "0") {

                $("#sell_frm").hide(1000);
                $("#bootomsellfrm").hide(1000);

            }

        });



        //$(".sell_frm").on('change',"#protype", function(){

        //var protype = $(this).val();
        //alert('jjj');
        if (protype == 1) {

            $("#showvarients").show();

        } else {
            $("#showvarients").hide();
        }
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#auctionPrice').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });

        $('#auctionQuantity_').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });

        $('.size').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });


    });
</script>

<script>
    function myFunction(browser) {
        document.getElementById("selltype").value = browser;
    }

    $("#preview_product").click(function() {
        var selltype = $("#sellType_").val();
        var spPostingTitle = $("#spPostingTitle").val();
        var auctionQuantity_ = $("#auctionQuantity_").val();
        var auctionStatus_ = $("#auctionStatus_").val();
        var auctionPrice = $("#auctionPrice").val();
        var spPostingNotes = $("#spPostingNotes").val();

    });


    $("#spPostSubmitStorepublish").click(function() {

        var postid = "<?php echo $_GET["postid"]; ?>"
        var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";

        $.ajax({
            url: MAINURL + "/store/prevpublish.php",
            type: "POST",
            data: 'postid=' + postid,

            success: function(vi) {


                window.location.href = MAINURL + "/post-ad/sell/posting.php?postid=" + postid.trim();

            },
            error: function(error) {

            }
        });


    });

    function so_input() {
        $('#refund').show();
    }

    function so_out() {
        $('#refund').hide();
    }


    function loadDocReturn(id) {

        if (id == 0) {
            document.getElementById("ifYes").style.display = "none";
            $('#return_within_iid').val('');
        }
        if (id == 1) {
            document.getElementById("ifYes").style.display = "block";
        }
    }


    $('#forfreeshipping').click(function() {
        $("#forhideandshowshipping").hide();
        $("#forhideandshowshippingforbhak").hide();
    });
    $('#forfixedamountshipping').click(function() {
        $("#forhideandshowshipping").hide();
        $("#forhideandshowshippingforbhak").show();
    });
    $('#forpercompanyahipping').click(function() {
        $("#forhideandshowshipping").show();
        $("#forhideandshowshippingforbhak").hide();
    });
    if ($('#forfreeshipping').is(':checked')) {
        document.getElementById("forhideandshowshipping").style.display = "none";
        document.getElementById("forhideandshowshippingforbhak").style.display = "none";
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=tags]');

    // initialize Tagify on the above input node reference
    new Tagify(input)
</script>
<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>