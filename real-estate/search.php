<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "real-estate/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    include_once "../common.php";

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if ($res != false) {
        $ruser = mysqli_fetch_assoc($res);
//print_r($ruser);
// die("+++++====");
        $usercountry = $ruser["spUserCountry"];
        $userstate = $ruser["spUserState"];
        $usercity = $ruser["spUserCity"];
    }
// echo $_GET['spPostingsState'];
// echo $_GET['spUserCity'];
// exit;


    ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <?php include('../component/f_links.php'); ?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

        <style>
            .leftArt.pro_detail_box {
                padding-left: 40px;
                padding-top: 15px;
                padding-bottom: 18px;
                margin-bottom: 100px;
                border-radius: 7px;
            }

            #datalist p:nth-child(n+6) {
                display: none;
            }

            button#addtofavouriteevent {
                margin-top: -48px;
                margin-right: 3px;
            }

            button#remtofavoritesevent {
                margin-top: -48px;
                margin-right: 3px;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #95ba3d;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #95ba3d;
                border-color: #95ba3d;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #95ba3d;
            }

            .realBox img.imgMain {
                width: 100%;
                height: 210px;
            }

            .realBox .boxHead {
                background-color: #95ba3d;

            }

            .btn-sm,
            .btn-group-sm>.btn {
                padding: 5px 10px;
                font-size: 12px;
                line-height: 1;

            }

            button#indent {
                display: none;
            }

            .btn_searchArt1 {
                background-color: #3ea941;
            }

            .btn_searchArt1:hover {
                background-color: #2d842f;
            }

            .btn_latest {
                width: 100%;

            }


            .midLayer ul li:nth-child(4) {
                width: 25% !important;
            }
        </style>



    </head>

    <body class="bg_gray">
        <?php include_once("../header.php"); ?>
        <section class="realTopBread">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-top:22px">
                            <div class="col-md-6" style="margin-top:15px;margin-bottom:-15px;}">
                                <div class="text-left agentbreadCrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a style="font-size: 14px;" href="<?php echo $BaseUrl . '/real-estate'; ?>">Home</a></li>
                                        <li style="font-size: 14px;" class="breadcrumb-item active">Search</li>
                                    </ol>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="text-right">
                                    <?php include_once("top-buttons.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <style>
            .realTopBread {
                padding: 0px;
                / background-image: url(../images/real/in-bg-real.jpg);/ background-color: #6a7e3b;
                background-size: cover;
            }

            .iconss {
                padding-left: 25px;
                background: url("https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-location-icon-png-image_956422.jpg") no-repeat left;
                background-size: 20px;
            }

            input#spPostingAddress_ {
                background-color: white;
            }

            .mrtop {
                margin-top: 13px;
            }
        </style>
        <div class="container">

            <section class="row" style="padding: 20px;">

                <div class="col-md-4">
                    <div class="bg_white">
                        <div class="row">
                            <form class="searchReal" action="search.php">

                                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
                                <div class="col-md-1"></div>
                                <div class="col-md-9 pr-0">
                                    <div class="form-group">
                                        <label for="spPostingAddress_" class="lbl_16">
                                        </label>
                                        <?php
                                        if ($_SESSION['realstate_default_address'] != " " and isset($_GET['btnAdresSearch'])) {
                //$_SESSION['realstate_default_address'] = $_GET['txtAddress'];

                                            $defaultnewaddress = $_GET['txtAddress'];
                                            $Lists = explode(',', $defaultnewaddress);


                                            $defcount =  count($Lists);
                                            $_SESSION['realstate_default_country'] = $Lists[$defcount - 1];
                                            $_SESSION['realstate_default_state'] = $Lists[$defcount - 2];
                                            $_SESSION['realstate_default_city'] = $Lists[$defcount - 3];
                                        }
                                        ?>
                                        <input style="border-radius: 4px;" type="text" class="form-control spPostField iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php echo (isset($_GET['txtAddress']) && $_GET['txtAddress'] != '') ? $_GET['txtAddress'] : ''; ?>" autocomplete="off" maxlength="40" required />

                                    </div>
                                </div>

                                <script>
                                    var input = document.getElementById('spPostingAddress_');
                                    var autocomplete = new google.maps.places.Autocomplete(input);
                                </script>

                                <div class="location-search">
                                    <button type="submit" class="btn" name="btnAdresSearch" value="" style="margin-top: 4px;"> <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                                <?php
    //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                ?>
                            </form>
                        </div>

                    </div>


                    <form>
                        <input type="hidden" name="txtAddress" value="<?php echo $_GET['txtAddress']; ?>">

                        <div class="leftArt pro_detail_box">

                            <div class="dropdown">
                                <button style="margin-bottom: 24px;width: 100%;margin-left: -18px;color:white;background-color: #3ea941 !important;" class="btn btn-primary dropdown-toggle btn-border-radius" type="button" data-toggle="dropdown">Sort
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="submit" class="btn" name="ltoh" value="1">
                                                Price Low to High
                                            </button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn" name="htol" value="1">
                                                Price High to Low
                                            </button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn_latest" name="latest" value="1">
                                                Latest
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <label>Property Type</label>
                                <select name="spPostingPropertyType" class="form-control" style="width: 100%; margin-left: -18px; ">
                                    <option value="">Select</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Condo') {
                                        echo "selected";
                                    } ?> value="Condo">Condo</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Detached House') {
                                        echo "selected";
                                    } ?> value="Detached House">Detached House</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Duplex') {
                                        echo "selected";
                                    } ?> value="Duplex">Duplex</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Land/lot') {
                                        echo "selected";
                                    } ?> value="Land/lot">Land/lot</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Mobile Home') {
                                        echo "selected";
                                    } ?> value="Mobile Home">Mobile Home</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Other') {
                                        echo "selected";
                                    } ?> value="Other">Other</option>
                                    <option <?php if ($_GET['spPostingPropertyType'] == 'Town House') {
                                        echo "selected";
                                    } ?> value="Town House">Town House</option>
                                </select>

                                <div class="row mrtop">
                                    <div class="col-md-6">
                                        <label>Price from</label>
                                        <select name="pricefrom" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any Min Price</option>
                                            <option <?php if ($_GET['pricefrom'] == '200000') {
                                                echo "selected";
                                            } ?> value="200000">$200000</option>
                                            <option <?php if ($_GET['pricefrom'] == '300000') {
                                                echo "selected";
                                            } ?> value="300000">$300000</option>
                                            <option <?php if ($_GET['pricefrom'] == '350000') {
                                                echo "selected";
                                            } ?> value="350000">$350000</option>
                                            <option <?php if ($_GET['pricefrom'] == '400000') {
                                                echo "selected";
                                            } ?> value="400000">$400000</option>
                                            <option <?php if ($_GET['pricefrom'] == '450000') {
                                                echo "selected";
                                            } ?> value="450000">$450000</option>
                                            <option <?php if ($_GET['pricefrom'] == '500000') {
                                                echo "selected";
                                            } ?> value="500000">$500000</option>
                                            <option <?php if ($_GET['pricefrom'] == '550000') {
                                                echo "selected";
                                            } ?> value="550000">$550000</option>
                                            <option <?php if ($_GET['pricefrom'] == '600000') {
                                                echo "selected";
                                            } ?> value="600000">$600000</option>
                                            <option <?php if ($_GET['pricefrom'] == '650000') {
                                                echo "selected";
                                            } ?> value="650000">$650000</option>
                                            <option <?php if ($_GET['pricefrom'] == '700000') {
                                                echo "selected";
                                            } ?> value="700000">$700000</option>
                                            <option <?php if ($_GET['pricefrom'] == '750000') {
                                                echo "selected";
                                            } ?> value="750000">$750000</option>
                                            <option <?php if ($_GET['pricefrom'] == '800000') {
                                                echo "selected";
                                            } ?> value="800000">$800000</option>
                                            <option <?php if ($_GET['pricefrom'] == '850000') {
                                                echo "selected";
                                            } ?> value="850000">$850000</option>
                                            <option <?php if ($_GET['pricefrom'] == '900000') {
                                                echo "selected";
                                            } ?> value="900000">$900000</option>
                                            <option <?php if ($_GET['pricefrom'] == '950000') {
                                                echo "selected";
                                            } ?> value="950000">$950000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1000000') {
                                                echo "selected";
                                            } ?> value="1000000">$1000000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1100000') {
                                                echo "selected";
                                            } ?> value="1100000">$1100000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1200000') {
                                                echo "selected";
                                            } ?> value="1200000">$1200000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1300000') {
                                                echo "selected";
                                            } ?> value="1300000">$1300000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1400000') {
                                                echo "selected";
                                            } ?> value="1400000">$1400000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1500000') {
                                                echo "selected";
                                            } ?> value="1500000">$1500000</option>
                                            <option <?php if ($_GET['pricefrom'] == '1750000') {
                                                echo "selected";
                                            } ?> value="1750000">$1750000</option>
                                            <option <?php if ($_GET['pricefrom'] == '2000000') {
                                                echo "selected";
                                            } ?> value="2000000">$2000000</option>
                                            <option <?php if ($_GET['pricefrom'] == '2500000') {
                                                echo "selected";
                                            } ?> value="2500000">$2500000</option>
                                            <option <?php if ($_GET['pricefrom'] == '3000000') {
                                                echo "selected";
                                            } ?> value="3000000">$3000000</option>
                                            <option <?php if ($_GET['pricefrom'] == '4000000') {
                                                echo "selected";
                                            } ?> value="4000000">$4000000</option>
                                            <option <?php if ($_GET['pricefrom'] == '5000000') {
                                                echo "selected";
                                            } ?> value="5000000">$5000000</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Price to</label>
                                        <select name="priceto" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any Max Price</option>
                                            <option <?php if ($_GET['priceto'] == '200000') {
                                                echo "selected";
                                            } ?> value="200000">$200000</option>
                                            <option <?php if ($_GET['priceto'] == '300000') {
                                                echo "selected";
                                            } ?> value="300000">$300000</option>
                                            <option <?php if ($_GET['priceto'] == '350000') {
                                                echo "selected";
                                            } ?> value="350000">$350000</option>
                                            <option <?php if ($_GET['priceto'] == '400000') {
                                                echo "selected";
                                            } ?> value="400000">$400000</option>
                                            <option <?php if ($_GET['priceto'] == '450000') {
                                                echo "selected";
                                            } ?> value="450000">$450000</option>
                                            <option <?php if ($_GET['priceto'] == '500000') {
                                                echo "selected";
                                            } ?> value="500000">$500000</option>
                                            <option <?php if ($_GET['priceto'] == '550000') {
                                                echo "selected";
                                            } ?> value="550000">$550000</option>
                                            <option <?php if ($_GET['priceto'] == '600000') {
                                                echo "selected";
                                            } ?> value="600000">$600000</option>
                                            <option <?php if ($_GET['priceto'] == '650000') {
                                                echo "selected";
                                            } ?> value="650000">$650000</option>
                                            <option <?php if ($_GET['priceto'] == '700000') {
                                                echo "selected";
                                            } ?> value="700000">$700000</option>
                                            <option <?php if ($_GET['priceto'] == '750000') {
                                                echo "selected";
                                            } ?> value="750000">$750000</option>
                                            <option <?php if ($_GET['priceto'] == '800000') {
                                                echo "selected";
                                            } ?> value="800000">$800000</option>
                                            <option <?php if ($_GET['priceto'] == '850000') {
                                                echo "selected";
                                            } ?> value="850000">$850000</option>
                                            <option <?php if ($_GET['priceto'] == '900000') {
                                                echo "selected";
                                            } ?> value="900000">$900000</option>
                                            <option <?php if ($_GET['priceto'] == '950000') {
                                                echo "selected";
                                            } ?> value="950000">$950000</option>
                                            <option <?php if ($_GET['priceto'] == '1000000') {
                                                echo "selected";
                                            } ?> value="1000000">$1000000</option>
                                            <option <?php if ($_GET['priceto'] == '1100000') {
                                                echo "selected";
                                            } ?> value="1100000">$1100000</option>
                                            <option <?php if ($_GET['priceto'] == '1200000') {
                                                echo "selected";
                                            } ?> value="1200000">$1200000</option>
                                            <option <?php if ($_GET['priceto'] == '1300000') {
                                                echo "selected";
                                            } ?> value="1300000">$1300000</option>
                                            <option <?php if ($_GET['priceto'] == '1400000') {
                                                echo "selected";
                                            } ?> value="1400000">$1400000</option>
                                            <option <?php if ($_GET['priceto'] == '1500000') {
                                                echo "selected";
                                            } ?> value="1500000">$1500000</option>
                                            <option <?php if ($_GET['priceto'] == '1750000') {
                                                echo "selected";
                                            } ?> value="1750000">$1750000</option>
                                            <option <?php if ($_GET['priceto'] == '2000000') {
                                                echo "selected";
                                            } ?> value="2000000">$2000000</option>
                                            <option <?php if ($_GET['priceto'] == '2500000') {
                                                echo "selected";
                                            } ?> value="2500000">$2500000</option>
                                            <option <?php if ($_GET['priceto'] == '3000000') {
                                                echo "selected";
                                            } ?> value="3000000">$3000000</option>
                                            <option <?php if ($_GET['priceto'] == '4000000') {
                                                echo "selected";
                                            } ?> value="4000000">$4000000</option>
                                            <option <?php if ($_GET['priceto'] == '5000000') {
                                                echo "selected";
                                            } ?> value="5000000">$5000000</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mrtop">
                                    <div class="col-md-6">
                                        <label>Bedrooms</label>
                                        <select name="spPostingBedroom" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any beds</option>
                                            <option <?php if ($_GET['spPostingBedroom'] == '1') {
                                                echo "selected";
                                            } ?> value="1">1+ beds</option>
                                            <option <?php if ($_GET['spPostingBedroom'] == '2') {
                                                echo "selected";
                                            } ?> value="2">2+ beds</option>
                                            <option <?php if ($_GET['spPostingBedroom'] == '3') {
                                                echo "selected";
                                            } ?> value="3">3+ beds</option>
                                            <option <?php if ($_GET['spPostingBedroom'] == '4') {
                                                echo "selected";
                                            } ?> value="4">4+ beds</option>
                                            <option <?php if ($_GET['spPostingBedroom'] == '5') {
                                                echo "selected";
                                            } ?> value="5">5+ beds</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Bathrooms</label>
                                        <select name="spPostingBathroom" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any baths</option>
                                            <option <?php if ($_GET['spPostingBathroom'] == '1') {
                                                echo "selected";
                                            } ?> value="1">1+ baths</option>
                                            <option <?php if ($_GET['spPostingBathroom'] == '2') {
                                                echo "selected";
                                            } ?> value="2">2+ baths</option>
                                            <option <?php if ($_GET['spPostingBathroom'] == '3') {
                                                echo "selected";
                                            } ?> value="3">3+ baths</option>
                                            <option <?php if ($_GET['spPostingBathroom'] == '4') {
                                                echo "selected";
                                            } ?> value="4">4+ baths</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mrtop">
                                    <div class="col-md-6">
                                        <label>Sq. Feet from</label>
                                        <select name="Squrefootfrom" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any Min SqFt</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '500') {
                                                echo "selected";
                                            } ?> value="500">500</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '750') {
                                                echo "selected";
                                            } ?> value="750">750</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '1000') {
                                                echo "selected";
                                            } ?> value="1000">1,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '1250') {
                                                echo "selected";
                                            } ?> value="1250">1,250</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '1500') {
                                                echo "selected";
                                            } ?> value="1500">1,500</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '1750') {
                                                echo "selected";
                                            } ?> value="1750">1,750</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '2000') {
                                                echo "selected";
                                            } ?> value="2000">2,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '2250') {
                                                echo "selected";
                                            } ?> value="2250">2,250</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '2500') {
                                                echo "selected";
                                            } ?> value="2500">2,500</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '2750') {
                                                echo "selected";
                                            } ?> value="2750">2,750</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '3000') {
                                                echo "selected";
                                            } ?> value="3000">3,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '3250') {
                                                echo "selected";
                                            } ?> value="3250">3,250</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '3500') {
                                                echo "selected";
                                            } ?> value="3500">3,500</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '4000') {
                                                echo "selected";
                                            } ?> value="4000">4,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '4500') {
                                                echo "selected";
                                            } ?> value="4500">4,500</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '5000') {
                                                echo "selected";
                                            } ?> value="5000">5,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '6000') {
                                                echo "selected";
                                            } ?> value="6000">6,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '7000') {
                                                echo "selected";
                                            } ?> value="7000">7,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '8000') {
                                                echo "selected";
                                            } ?> value="8000">8,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '9000') {
                                                echo "selected";
                                            } ?> value="9000">9,000</option>
                                            <option <?php if ($_GET['Squrefootfrom'] == '10000') {
                                                echo "selected";
                                            } ?> value="10000">10,000</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Sq. Feet to</label>
                                        <select name="Squrefootto" class="form-control" style="width: 100%; margin-left: -18px; ">
                                            <option value="">Any Max SqFt</option>
                                            <option <?php if ($_GET['Squrefootto'] == '500') {
                                                echo "selected";
                                            } ?> value="500">500</option>
                                            <option <?php if ($_GET['Squrefootto'] == '750') {
                                                echo "selected";
                                            } ?> value="750">750</option>
                                            <option <?php if ($_GET['Squrefootto'] == '1000') {
                                                echo "selected";
                                            } ?> value="1000">1,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '1250') {
                                                echo "selected";
                                            } ?> value="1250">1,250</option>
                                            <option <?php if ($_GET['Squrefootto'] == '1500') {
                                                echo "selected";
                                            } ?> value="1500">1,500</option>
                                            <option <?php if ($_GET['Squrefootto'] == '1750') {
                                                echo "selected";
                                            } ?> value="1750">1,750</option>
                                            <option <?php if ($_GET['Squrefootto'] == '2000') {
                                                echo "selected";
                                            } ?> value="2000">2,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '2250') {
                                                echo "selected";
                                            } ?> value="2250">2,250</option>
                                            <option <?php if ($_GET['Squrefootto'] == '2500') {
                                                echo "selected";
                                            } ?> value="2500">2,500</option>
                                            <option <?php if ($_GET['Squrefootto'] == '2750') {
                                                echo "selected";
                                            } ?> value="2750">2,750</option>
                                            <option <?php if ($_GET['Squrefootto'] == '3000') {
                                                echo "selected";
                                            } ?> value="3000">3,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '3250') {
                                                echo "selected";
                                            } ?> value="3250">3,250</option>
                                            <option <?php if ($_GET['Squrefootto'] == '3500') {
                                                echo "selected";
                                            } ?> value="3500">3,500</option>
                                            <option <?php if ($_GET['Squrefootto'] == '4000') {
                                                echo "selected";
                                            } ?> value="4000">4,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '4500') {
                                                echo "selected";
                                            } ?> value="4500">4,500</option>
                                            <option <?php if ($_GET['Squrefootto'] == '5000') {
                                                echo "selected";
                                            } ?> value="5000">5,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '6000') {
                                                echo "selected";
                                            } ?> value="6000">6,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '7000') {
                                                echo "selected";
                                            } ?> value="7000">7,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '8000') {
                                                echo "selected";
                                            } ?> value="8000">8,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '9000') {
                                                echo "selected";
                                            } ?> value="9000">9,000</option>
                                            <option <?php if ($_GET['Squrefootto'] == '10000') {
                                                echo "selected";
                                            } ?> value="10000">10,000</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mrtop">
                                    <div class="col-md-12">
                                        <label>Keywords</label>
                                        <input style="width: 100%; margin-left: -18px; " type="text" name="spPostingTitle" class="form-control" value="<?php echo $_GET['spPostingTitle']; ?>">
                                    </div>
                                </div>

                                <div class="row mrtop">
                                    <input type="checkbox" value="Yes" name="spPostingOpenHouse" <?php if ($_GET['spPostingOpenHouse'] == 'Yes') {
                                        echo "checked";
                                    } ?>>
                                    <label>Open Houses</label>
                                </div>

                                <input type="submit" class="btn btn_searchArt1 btn-border-radius" value="Filter" name="btnAdresSearch" style="margin-top: 10px;width: 100%;margin-left: -18px;color:white;">
                                <a href="<?php echo $BaseUrl; ?>/real-estate/search.php?txtAddress=<?php echo $_GET['txtAddress']; ?>&btnAdresSearch=" class="btn btn_searchArt1 btn-border-radius" style="margin-top: 5px;width: 100%;margin-left: -18px;color:white;">
                                    Reset
                                </a>

                            </div>

                        </form>

                    </div>

                    <div class="col-md-8">
                    
                        <?php
                        
                        $headlineContent = "";
                        if(!empty($_GET['cityId'])){
                          $countryOut = selectQ('select a.city_title, b.state_title, c.country_title from tbl_city as a inner join tbl_state as b on a.state_id=b.state_id inner join tbl_country as c on a.country_id=c.country_id where a.city_id=?', "i", [$_GET['cityId']], 'one');
                          if($countryOut){
                            $headlineContent = '<h3>Search Result for "'.$countryOut['city_title'].'" in '.$countryOut['state_title'].', '.$countryOut['country_title'].'</h3>'; 
                          }                          
                        }
                        elseif(!empty($_GET['listingId'])){
                          $headlineContent = '<h3>Search Result for Listing ID "'.$_GET['listingId'].'"</h3>';
                        }
                        elseif(!empty($_GET['community'])){
                          $headlineContent = '<h3>Search Result for Community "'.$_GET['community'].'"</h3>';
                        }
                        elseif(!empty($_GET['txtAddress'])){
                          $headlineContent = '<h3>Search Result for Location "'.$_GET['txtAddress'].'"</h3>';
                        }
                        elseif(!empty($_GET['spPostingTitle'])){
                          $headlineContent = '<h3>Search Result for Keywords "'.$_GET['spPostingTitle'].'"</h3>';
                        }
                        
                        echo $headlineContent;
                        $start = 0;
                        $limit = 1;

                        $p      = new _realstateposting;
                        $pf     = new _postfield;
                        $pic = new _realstatepic;

                        $res = $p->findAddress();
                        

                        if ($res) { 
                            $count = count($res);
                            ?>
                            <div class="list-wrapper hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh">
                                <?php
                                foreach($res as $row){ ?>
                                    <div class="list-item">
                                        <?php
                                        $address = "";
                                        $bedroom = "";
                                        $bathroom = "";
                                        $sqrfoot = "";
                                        $basement = "";
                                        $postListing = "";
                                        $postListing = $row['spPostListing'];
                                        $propertyType = $row['spPostingPropertyType'];

                                        $address = $row['spPostingAddress'];
                                        $bedroom = $row['spPostingBedroom'];
                                        $bathroom = $row['spPostingBathroom'];

                                        $sqrfoot = $row['spPostingSqurefoot'];
                                        $basement = $row['spPostBasement'];
                                        $result_pf = $p->read($row['idspPostings']);
                                        ?>
                                        <div class="col-md-6">
                                            <div class="realBox" style="height:300px;">
                                                <a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?catid=1&postid=' . $row['idspPostings']; ?>">
                                                    <div class="boxHead">
                                                        <h2><?php $in =  $row['spPostingTitle'];
                                                        $out = strlen($in) > 25 ? substr($in, 0, 25) . "..." : $in;
                                                        echo $out; ?></h2>
                                                        <p>
                                                            <i class="fa fa-map-marker"></i>
                                                            <?php
                                                            if (strlen($address) < 30) {
                                                                echo $address;
                                                            } else {
                                                                echo substr($address, 0, 30) . "...";
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                    $res2 = $pic->readFeature($row['idspPostings']);
                                                    if ($res2 != false) {
                                                        if ($res2->num_rows > 0) {
                                                            if ($res2 != false) {
                                                                $rp = mysqli_fetch_assoc($res2);
                                                                $pic2 = $rp['spPostingPic'];
                                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                            }
                                                        } else {
                                                            $res2 = $pic->read($row['idspPostings']);
                                                            if ($res2 != false) {
                                                                $rp = mysqli_fetch_assoc($res2);
                                                                $pic2 = $rp['spPostingPic'];
                                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                            }
                                                        }
                                                    } else {
                                                        $res2 = $pic->read($row['idspPostings']);
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                        } else {
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
                                                        }
                                                    } ?>
                                                    <div class="midLayer">
                                                        <ul>
                                                            <li data-toggle="tooltip" title="Square Foot" style="text-align: center;"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0) ? $sqrfoot : 0; ?></li>
                                                            <?php if ($propertyType != 'Land/lot') { ?>
                                                                <li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? $bedroom : 0; ?></li>
                                                                <li data-toggle="tooltip" title="Bath Room" class="text-center" style="width: 25%;"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? $bathroom : 0; ?></li>
                                                            <?php } ?>
                                                            <li data-toggle="tooltip" title="Basement" style="text-align: center;"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement : 0; ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="boxFoot bg_white text-center">
                                                        <p class="proType boxRealEstate"><?php echo $propertyType; ?>
                                                        <?php if ($row['spPostingPrice'] != '') { ?>
                                                            &nbsp;<span style="font-size:18px;">(<?php echo $row['defaltcurrency'] . ' ' . number_format($row['spPostingPrice']); ?>)</span>
                                                        <?php } ?>
                                                    </p>




                                                </div>
                                            </a>
                                            <div class="text-right bokmarktabsssss">
                                                <div id="sssssssssssssss<?php echo $row['idspPostings']; ?>">
                                                    <?php
                                                    $fv = new _favorites;
                                                    $res_fv = $fv->chekFavourite($row['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
                        //echo $fv->ta->sql;
                                                    if ($res_fv != false) { ?>
                                                        <button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                            <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-outline-primary btn-sm" id="addtofavouriteevent" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                            <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div> 
                                    </div>
                                    <?php
                                } ?>
                            </div>

                            <div class="list-item">
                                <?php
                            } else {
                                echo "<h3>There are no properties found with your searched words, please search again.</h3>";
                            }
                            ?>


                        </div>&nbsp;

                    </section>
                    <?php 
                    if($count>=10){
                        ?>
                        <div style="margin-left:400px" id="pagination-container">
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
                include('../component/f_footer.php');
                include('../component/f_btm_script.php');
                ?>

            </body>

            </html>
            <?php
        }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>




        <script type="text/javascript">

          $(function(){
          
            //Adding keypress in necessary because else ENTER key doesnt work correctly
            $('#spPostingAddress_').keypress(function(e) {
              if (e.which == 13) {
                return false;
              }
            });
          
            autocomplete.addListener('place_changed', function () {
              var place = autocomplete.getPlace();
              var city = "";
              var state = "";
              var country = "";

              for (var i = 0; i < place.address_components.length; i++) {
                var component = place.address_components[i];
                if (component.types.includes('locality')) {
                  city = component.long_name;
                } else if (component.types.includes('administrative_area_level_1')) {
                  state = component.long_name;
                } else if (component.types.includes('country')) {
                  country = component.long_name;
                }
              }
              
              var currentUrl = new URL(window.location.href);

              if(country){
                currentUrl.searchParams.set('country', country);              
              }
              if(state){
                currentUrl.searchParams.set('state', state);
              }
              if(city){
                currentUrl.searchParams.set('city', city);
              }
              currentUrl.searchParams.set('txtAddress', place.formatted_address);
              
              document.location = currentUrl;
            });
          });
		      
        

            var items = $(".list-wrapper .list-item");
            var numItems = items.length;
            var perPage = 10;

            items.slice(perPage).hide();

            $('#pagination-container').pagination({
                items: numItems, 
                itemsOnPage: perPage,
                prevText: "&laquo;",
                nextText: "&raquo;",
                onPageClick: function(pageNumber) {
                    var showFrom = perPage * (pageNumber - 1);
                    var showTo = showFrom + perPage;
                    items.hide().slice(showFrom, showTo).show();
                }
            });
        </script>




        <script type="text/javascript">
            $(".bokmarktabsssss").on("click", "#addtofavouriteevent", function() {


                var postid = $(this).data('postid');

//alert(postid);


                var pid = $(this).data('pid');

                var model1 = "real";

// alert(pid);

                $.post(MAINURL + "/social/addfavorites.php", {
                    postid: postid,
                    pid: pid,
                    model1: model1
                }, function(response) {
//$("#addtofavouriteeve").html("<i class='fa fa-heart' aria-hidden='true'></span>");
                    $("#sssssssssssssss" + postid).html('<button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="' + postid + '" data-pid="' + pid + '"  ><span id="removetofavouriteeve"><i class="fa fa-heart"></i></span></button>');
//window.location.reload();
                });
            });

            $(".bokmarktabsssss").on("click", "#remtofavoritesevent", function() {
                var postid = $(this).data('postid');
                var pid = $(this).data('pid');
                var model1 = "real";
                var btnremovefavorites = this;

                $.post(MAINURL + "/social/deletefavorites.php", {
                    postid: postid,
                    model1: model1
                }, function(response) {
//$("#removetofavouriteeve").html("<i class='fa fa-heart-o' aria-hidden='true'></span>");
//window.location.reload();
                    $("#sssssssssssssss" + postid).html('<button class="btn btn-outline-primary btn-sm" id="addtofavouriteevent" data-postid="' + postid + '" data-pid="' + pid + '"  ><span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span></button>');
                });
            });




            $(document).ready(function() {
                $(".usercountry").hide();
            });
//==========ON CHANGE LOAD CITY==========
            $(".spPostingsState").on("change", function() {

//alert(this.value);
                var state = this.value;
                $.post("loadUserCity.php", {
                    state: state
                }, function(r) {
//alert(r);
                    $(".loadCity").html(r);
                });

            });
//==========ON CHANGE LOAD CITY==========
        </script>
