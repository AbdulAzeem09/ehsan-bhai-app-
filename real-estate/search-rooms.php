<?php

include('../univ/baseurl.php');
session_start();
$_SESSION['checkin_realestate'] = $_POST['fromdate'];

$_SESSION['checkout_realestate'] = $_POST['todate'];

$_SESSION['No_of_People'] = $_POST['guests'];

$_SESSION['rent_session__realestate'] = $_POST['spPostDurstion'];
$_SESSION['txtAddress'] = $_POST['txtAddress'];

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "real-estate/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if ($res != false) {
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"];
        $userstate = $ruser["spUserState"];
        $usercity = $ruser["spUserCity"];
    }
    // echo $_POST['spPostingsState'];
    // echo $_POST['spUserCity'];
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
        <link rel="stylesheet" type="text/css" href="../bashar_design/css/realsetate.css">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .iconss {
                padding-left: 25px;
                background: url("https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-location-icon-png-image_956422.jpg") no-repeat left;
                background-size: 20px;
            }

            input#spPostingAddress_ {
                background-color: white;
            }

            .artEventBox p.date,
            .ui-widget-header {
                background-color: gray !important;
            }

            .ratings i {
                font-size: 16px;
                color: black;
            }

            .form-control:focus {
                border-color: #66afe9;
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(102 175 233 / 60%);
                box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(102 175 233 / 60%);
            }

            a {
                color: #eff1f5;
                text-decoration: none;
            }

            a:hover,
            a:focus {
                color: #09090a;
                text-decoration: underline;
            }
        </style>
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php"); ?>
        <section class="realTopBread">
            <div class="container">
                <div class="row">

                    <!---<div class="col-md-12">
<div class="heading07 text-center">
<h2>Search</h2>
</div>
</div>
<div class="col-md-12">
<div class="agentbreadCrumb text-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/real-estate'; ?>">Home</a></li>
<li class="breadcrumb-item active">Search</li>
</ol>
</div>
</div>--->


                    <form class="searchReal" method="POST" action="<?php echo $BaseUrl; ?>/real-estate/search-rooms.php">



                        <!--<form class="searchReal" method="POST" action="search-rooms.php">
<!----<div class="col-md-2">
<div class="form-group">
<label class="">Search for a room rent</label>
<input type="text" class="form-control" placeholder="Search for a room rent"  value="<?php echo $_POST['spPostingTitle']; ?>"  name="spPostingTitle" required>
</div>
</div>---->
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label for="spPostingAddress_" class="lbl_16">Location
                                        </label>

                                        <input type="text" class="form-control spPostField iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php echo (isset($_SESSION['txtAddress']) && $_SESSION['txtAddress'] != '') ? $_SESSION['txtAddress'] : ''; ?>" autocomplete="off" maxlength="40" required />

                                    </div>
                                </div>

                                <script>
                                    var input = document.getElementById('spPostingAddress_');
                                    var autocomplete = new google.maps.places.Autocomplete(input);
                                </script>



                                <?php //if($_SESSION['rent_session__realestate'] == '1'){
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dt1" class="lbl_3">Check IN</label>
                                        <input type="text" name="fromdate" class="form-control" id="dt1" value="<?php echo $_SESSION['checkin_realestate']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dt2" class="lbl_3">Check OUT</label>
                                        <input type="text" name="todate" class="form-control" id="dt2" value="<?php echo $_SESSION['checkout_realestate']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="">Guests</label>
                                        <select class="form-control" name="guests">
                                            <option value="1" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '1') ? 'selected' : ''; ?>>1</option>
                                            <option value="2" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '2') ? 'selected' : ''; ?>>2</option>
                                            <option value="3" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '3') ? 'selected' : ''; ?>>3</option>
                                            <option value="4" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '4') ? 'selected' : ''; ?>>4</option>
                                            <option value="5" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '5') ? 'selected' : ''; ?>>5</option>
                                            <option value="6" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '6') ? 'selected' : ''; ?>>6</option>
                                            <option value="7" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '7') ? 'selected' : ''; ?>>7</option>
                                            <option value="8" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '8') ? 'selected' : ''; ?>>8</option>
                                            <option value="9" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '9') ? 'selected' : ''; ?>>9</option>
                                            <option value="10" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '10') ? 'selected' : ''; ?>>10</option>
                                            <option value="11" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '11') ? 'selected' : ''; ?>>11</option>
                                            <option value="12" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '12') ? 'selected' : ''; ?>>12</option>
                                            <option value="13" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '13') ? 'selected' : ''; ?>>13</option>
                                            <option value="14" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '14') ? 'selected' : ''; ?>>14</option>
                                            <option value="15" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '15') ? 'selected' : ''; ?>>15</option>
                                            <option value="16" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '16') ? 'selected' : ''; ?>>16</option>
                                        </select>
                                    </div>
                                </div>



                                <?php if ($_SESSION['rent_session__realestate'] == '2') { ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dt1" class="lbl_3">Starting Date</label>
                                            <input type="text" name="fromdate" class="form-control" id="dt1" value="<?php echo $_SESSION['checkin_realestate']; ?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">
<div class="form-group">
<label for="dt2" class="lbl_3">Check OUT</label>
<input type="text" name="todate" class="form-control" id="dt2" value="<?php //echo $_SESSION['checkout_realestate']; 
                                                                        ?>" autocomplete="off"  required />
</div>
</div>-->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="">No.of People</label>
                                            <select class="form-control" name="guests">
                                                <option value="1" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '1') ? 'selected' : ''; ?>>1</option>
                                                <option value="2" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '2') ? 'selected' : ''; ?>>2</option>
                                                <option value="3" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '3') ? 'selected' : ''; ?>>3</option>
                                                <option value="4" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '4') ? 'selected' : ''; ?>>4</option>
                                                <option value="5" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '5') ? 'selected' : ''; ?>>5</option>
                                                <option value="6" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '6') ? 'selected' : ''; ?>>6</option>
                                                <option value="7" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '7') ? 'selected' : ''; ?>>7</option>
                                                <option value="8" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '8') ? 'selected' : ''; ?>>8</option>
                                                <option value="9" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '9') ? 'selected' : ''; ?>>9</option>
                                                <option value="10" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '10') ? 'selected' : ''; ?>>10</option>
                                                <option value="11" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '11') ? 'selected' : ''; ?>>11</option>
                                                <option value="12" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '12') ? 'selected' : ''; ?>>12</option>
                                                <option value="13" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '13') ? 'selected' : ''; ?>>13</option>
                                                <option value="14" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '14') ? 'selected' : ''; ?>>14</option>
                                                <option value="15" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '15') ? 'selected' : ''; ?>>15</option>
                                                <option value="16" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '16') ? 'selected' : ''; ?>>16</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!---
<div class="col-md-2">
<div class="">

<label for="spPostingCountry" class="lbl_2">Country</label>
<select id="spUserCountry" class="form-control " name="spPostingsCountry">
<option value="">Select Country</option>
<?php
    $co = new _country;
    $result3 = $co->readCountry();
    if ($result3 != false) {
        while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
        }
    }
?>
</select>

</div>
</div>

<div class="col-md-2">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spPostingsState">
<option>Select State</option>
<?php

    if (isset($userstate) && $userstate > 0) {
        $countryId = $usercountry;
        $pr = new _state;
        $result2 = $pr->readState($countryId);
        if ($result2 != false) {
            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
<?php
            }
        }
    }
?>
</select>
</div>
</div>
<div class="col-md-2">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" class="">City</label>
<select class="form-control" name="spUserCity" >
<option>Select City</option>
<?php
    $stateId = $userstate;
    $co = new _city;
    $result3 = $co->readCity($stateId);
    if ($result3 != false) {
        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?> ><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                            }
                                                                                                                                                                        } ?>
</select>
</div>
</div>
</div>
---->
                                <div class="col-md-1">
                                    <div class="form-group text-center">
                                        <input style="margin-top: 23px;border-radius: 3px; background-color:#acdf31;" type="submit" class="btn btn-border-radius" name="btnAdresSearch" value="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-2" style="margin-top:23px;">

                                    <a href="<?php echo $BaseUrl . '/real-estate/'; ?>">Home</a>
                                </div>
                                <div class="col-md-3" style="margin-top:15px;">
                                    <a href="<?php echo $BaseUrl . '/real-estate/dashboard/'; ?>" class="btn butn_dash_real btn-border-radius"><i class="fa fa-dashboard"></i> Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </form>




                </div>

            </div>
        </section>

        <section class="" style="padding: 20px;">
            <div class="container">

                <h1 class="text-center">Search Result "<?php echo $_POST['txtAddress']; ?>"</h1>

                <div class="d-flex justify-content-center row">

                    <?php
                    $start = 0;
                    $limit = 1;

                    $p      = new _realstateposting;
                    $pf     = new _postfield;
                    //print_r($_POST);
                    if (isset($_POST['btnAdresSearch'])) {
                        $user_info = $p->GetAddress($_SESSION['uid']);
                        $Loggedin_user_row = mysqli_fetch_assoc($user_info);
                        //print_r($Loggedin_user_row);
                        $user_State = $_POST['spPostingsState'];
                        $user_City = $_POST['spUserCity'];
                        $txtAddress = $_POST['txtAddress'];
                        $sqlquerydate = "";
                        $sqlquerydatetitle = "";

                        if (isset($_POST['spPostingTitle'])) {
                            if (!empty($_POST['spPostingTitle'])) {
                                $spPostingTitle = $_POST['spPostingTitle'];
                                $sqlquerydatetitle = " AND t.spPostingTitle  like ('%" . $spPostingTitle . "%')";
                            }
                        }
                        if (isset($_POST['fromdate'])) {
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sqlquerydate = "and spPostAvailFrom <= '" . $fromdate . "' and spPostAvailTo >= '" . $todate . "'";
                                $sqlquerydatestart = "and spPostAvailFrom <= '" . $fromdate . "'";
                            }
                        }
                        // echo $user_City;
                        // exit;   
                        if (isset($_POST['txtAddress']) && $_POST['txtAddress'] != '') {

                            if ($_POST['spPostDurstion'] == '1') {
                                $res = $p->findRoomByAddress($_GET['categoryID'], $txtAddress, $sqlquerydate, $sqlquerydatetitle, $_POST['spPostDurstion']);
                            }

                            if ($_POST['spPostDurstion'] == '2') {
                                $res = $p->findRoomByAddress($_GET['categoryID'], $txtAddress, $sqlquerydatestart, $sqlquerydatetitle, $_POST['spPostDurstion']);
                            }
                            // echo "hello1";
                            // exit; 
                        } else {
                            $res = $p->findRoomByStateCity($_GET['categoryID'], $txtAddress, $sqlquerydate, $sqlquerydatetitle);
                            // echo "hello";
                            // exit;
                        }



                        // echo $p->ta->sql; die;
                    } else if (isset($_POST['btnSearchForm'])) {
                        if (isset($_POST['txtAddress']) && $_POST['txtAddress'] != '') {
                            $txtAddress = $_POST['txtAddress'];
                        } else {
                            $txtAddress = '';
                        }

                        if (isset($_POST['spPostingsState']) && $_POST['spPostingsState'] != '') {
                            $StateId = $_POST['spPostingsState'];
                            $cityId = $_POST['spUserCity'];
                        } else {
                            $StateId = '';
                            $cityId = '';
                        }

                        if (isset($_POST['txtProType']) && $_POST['txtProType'] != '') {
                            $txtProType = $_POST['txtProType'];
                        } else {
                            $txtProType = '';
                        }

                        if (isset($_POST['txtMinPrice']) && $_POST['txtMinPrice'] != '') {
                            $txtMinPrice = $_POST['txtMinPrice'];
                        } else {
                            $txtMinPrice = '';
                        }

                        if (isset($_POST['txtMaxPrice']) && $_POST['txtMaxPrice'] != '') {
                            $txtMaxPrice = $_POST['txtMaxPrice'];
                        } else {
                            $txtMaxPrice = '';
                        }

                        //$res = $p->searchMultiFielPro($txtAddress, $txtListid, $txtProType, $txtMinPrice, $txtMaxPrice);

                    } else {
                        //$res = $p->publicpost_event($_GET["categoryID"]);
                    }

                    //echo $p->ta->sql;
                    if ($res != false) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            /*echo "<pre>" ;
print_r($row);*/
                            $address = "";
                            $bedroom = "";
                            $bathroom = "";
                            $sqrfoot = "";
                            $basement = "";
                            $propertyType = "";
                            $postListing = "";
                            $postListing = $row['spPostListing'];
                            $propertyType = $row['spPostingPropertyType'];
                            $address = $row['spPostingAddress'];
                            $bedroom = $row['spPostingBedroom'];
                            $bathroom = $row['spPostingBathroom'];

                            $sqrfoot = $row['spPostingSqurefoot'];
                            $basement = $row['spPostBasement'];

                            //posting fields
                            $result_pf = $p->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            if ($result_pf) {


                                while ($row2 = mysqli_fetch_assoc($result_pf)) {

                                    // print_r($row2);
                                    // exit;

                                    /*                  
if($postListing == ''){
if($row2['spPostFieldName'] == 'spPostListing_'){
$postListing = $row2['spPostFieldValue'];
}
}
if($propertyType == ''){
if($row2['spPostFieldName'] == 'spPostingPropertyType_'){
$propertyType = $row2['spPostFieldValue'];
}
}
if($address == ''){
if($row2['spPostFieldName'] == 'spPostingAddress_'){
$address = $row2['spPostFieldValue'];
}
}
if($bedroom == ''){
if($row2['spPostFieldName'] == 'spPostingBedroom_'){
$bedroom = $row2['spPostFieldValue'];
}
}
if($bathroom == ''){
if($row2['spPostFieldName'] == 'spPostingBathroom_'){
$bathroom = $row2['spPostFieldValue'];
}
}
if($sqrfoot == ''){
if($row2['spPostFieldName'] == 'spPostingSqurefoot_'){
$sqrfoot = $row2['spPostFieldValue'];
}
}
if($basement == ''){
if($row2['spPostFieldName'] == 'spPostBasement_'){
$basement = $row2['spPostFieldValue'];
}
}
*/
                                }
                            }

                            //if ($postListing == 'Rent') {

                    ?>


                            <style>
                                .overimg {
                                    position: absolute;
                                    z-index: 100;
                                    background-color: #95ba3d;
                                    border-radius: 50%;
                                    padding: 5px;
                                    left: -50px;

                                }

                                .boxbg {
                                    background-color: #f7f7f7;
                                    padding: 15px;
                                    margin: 15px;
                                    border: 1px solid #ccc;
                                    border-radius: 5px;
                                    box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
                                }

                                .row {
                                    margin-right: -15px;
                                    margin-left: -15px;
                                }

                                .overimg img {
                                    width: 100px;

                                }

                                .img-circle {
                                    border-radius: 50%;

                                }

                                img {
                                    vertical-align: middle;
                                }

                                .col-md-6 {
                                    position: relative;
                                    min-height: 1px;
                                    padding-right: 15px;
                                    padding-left: 15px;
                                }
                            </style>
                                     
                            <div class="col-md-6">
                                <a href="<?php echo $BaseUrl . '/real-estate/room-detail.php?postid=' . $row['idspPostings']; ?>">     
                                <div class="boxbg" style="height: 241px;">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mainimg" style="height: 180px; display:flex;">
                                                <?php
                                                $pic = new _realstatepic;


                                                $res2 = $pic->readFeature($row['idspPostings']);
                                                if ($res2 != false) {
                                                    if ($res2->num_rows > 0) {
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            $imgmail =  "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                        }
                                                    } else {
                                                        $res2 = $pic->read($row['idspPostings']);
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            $imgmail = "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                        }
                                                    }
                                                } else {
                                                    $res2 = $pic->read($row['idspPostings']);
                                                    if ($res2 != false) {
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['spPostingPic'];
                                                        $imgmail = "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                    } else {
                                                        $imgmail = "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
                                                    }
                                                }
                                                if ($pic2) {
                                                ?>
                                                    <img class="img-fluid img-responsive rounded product-image" style="height:150px" src="<?php echo $pic2; ?>">
                                                <?php

                                                } else {
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
                                                }
                                                ?>

                                                <div class="overimg">


                                                    <?php
                                                    $OwnerId   = $row['spProfiles_idspProfiles'];
                                                    $poster_data = $p->getPosterData($OwnerId);

                                                    $poster = mysqli_fetch_assoc($poster_data);
                                                    //$print_r($poster); 
                                                    //die('============');

                                                    if ($poster) {
                                                        $OwnerPic  = $poster['spProfilePic'];
                                                    } else {
                                                        $OwnerPic  = "../img/no.png";
                                                    }
                                                    ?>
                                                    <a href="<?php echo $BaseUrl; ?>/real-estate/agent-detail.php?agentId=<?php echo $poster['idspProfiles']; ?>"><img src="<?php echo $OwnerPic; ?>" class="img-circle" style="width:100px; height:100px"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 pull-right">
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
                                        <div class="col-md-5">
                                            <h5><?php echo $row['spPostingTitle']; ?></h5>
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
                                            <div class="d-flex flex-row">
                                                <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                            </div>
                                            <p class="text-justify text-truncate para mb-0">

                                                <?php echo $propertyType; ?> <br>
                                                <?php $spPostingNotesz = $row['spPostingNotes']; ?>
                                                <?php
                                                if (strlen($spPostingNotesz) < 14) {
                                                    echo $spPostingNotesz;
                                                } else {
                                                    echo substr($spPostingNotesz, 0, 14) . "..."; 
                                                }
                                                ?>


                                            </p>

                                            <div class=" ">
                                                <div class="d-flex flex-row align-items-center">
                                                    <h4 class="mr-1">

                                                        <?php

                                                        $result_pf = $pf->read($row['idspPostings']);
                                                        //echo $pf->ta->sql."<br>";
                                                        if ($result_pf) {
                                                            $roomType = "";
                                                            $RentalWeek = "";
                                                            $RentalMonth = "";
                                                            $RentaNight = "";
                                                            $cleaningFee = 0;
                                                            $serviceFee = 0;
                                                            $roomShared = "";

                                                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                if ($RentalWeek == '') {
                                                                    if ($row2['spPostFieldName'] == 'spPostRentalWeek_' || $row2['spPostFieldName'] == 'spPostRentalWeek') {
                                                                        $RentalWeek = $row2['spPostFieldValue'];
                                                                    }
                                                                }
                                                                if ($RentaNight == '') {
                                                                    if ($row2['spPostFieldName'] == 'spPostRentalNight_' || $row2['spPostFieldName'] == 'spPostRentalNight') {
                                                                        $RentaNight = $row2['spPostFieldValue'];
                                                                    }
                                                                }
                                                                if ($RentalMonth == '') {
                                                                    if ($row2['spPostFieldName'] == 'spPostRentalMonth_' || $row2['spPostFieldName'] == 'spPostRentalMonth') {
                                                                        $RentalMonth = $row2['spPostFieldValue'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (!empty($RentalWeek)) {
                                                            $namemeans = "Price Per Week";
                                                            $priccee = $RentalWeek;
                                                        }
                                                        if (!empty($RentaNight)) {
                                                            $namemeans = "Price Per Night";
                                                            $priccee = $RentaNight;
                                                        }
                                                        if (!empty($RentalMonth)) {
                                                            $namemeans = "Price Per Month";
                                                            $priccee = $RentalMonth;
                                                        }
                                                        ?>

                                                        <?php if ($priccee != '') { ?>
                                                            <?php echo $row['defaltcurrency'] . ' ' . $priccee; ?>
                                                        <?php } ?>
                                                    </h4>

                                                </div>
                                                <h6 class="text-success">
                                                    <?php
                                                    echo $namemeans;
                                                    ?>

                                                </h6>

                                            </div>
                                        </div>






                                    </div>
                                    <a href="<?php echo $BaseUrl . '/real-estate/room-detail.php?postid=' . $row['idspPostings']; ?>" style=" float: right; margin-top: 0px;"> 
                                        <div class="d-flex flex-column mt-4" class="align-text-bottom"><button class="btn btn-success btn-sm" type="button">Book Room</button></div>
                                    </a>  
                                </div>
                               </a>
                            </div> 










                            <!---- <div class="col-md-3">
<div class="realBox" style="height:300px;">
<a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?catid=1&postid=' . $row['idspPostings']; ?>">
<div class="boxHead">
<h2><?php echo $row['spPostingTitle']; ?></h2>
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
                            $pic = new _realstatepic;

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
<li data-toggle="tooltip" title="Square Foot"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0) ? $sqrfoot : 0; ?></li>
<li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? $bedroom : 0; ?></li>
<li data-toggle="tooltip" title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? $bathroom : 0; ?></li>
<li data-toggle="tooltip" title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement : 0; ?></li>
</ul>
</div>
<div class="boxFoot bg_white text-center">
<p class="proType"><?php echo $propertyType; ?>
<?php if ($row['spPostingPrice'] != '') { ?>
&nbsp;<span>($<?php echo $row['spPostingPrice']; ?>)</span>
<?php } ?>
</p>
</div>
</a>
</div>
</div>----->

                    <?php
                            //}
                        }
                    } else {

                        echo "<h5 style=' text-align: center; '>There are no rentals found with your searched criteria, please search again.</h5>";
                    }
                    ?>





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
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script type="text/javascript">
    $(".bokmarktabsssss").on("click", "#addtofavouriteevent", function() {


        var postid = $(this).data('postid');

        //alert(postid);


        var pid = $(this).data('pid');

        // alert(pid);

        $.post(MAINURL + "/social/addfavorites.php", {
            postid: postid,
            pid: pid
        }, function(response) {
            //$("#addtofavouriteeve").html("<i class='fa fa-heart' aria-hidden='true'></span>");
            $("#sssssssssssssss" + postid).html('<button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="' + postid + '" data-pid="' + pid + '"  ><span id="removetofavouriteeve"><i class="fa fa-heart"></i></span></button>');
            //window.location.reload();
        });
    });
    $(".bokmarktabsssss").on("click", "#remtofavoritesevent", function() {
        var postid = $(this).data('postid');
        var pid = $(this).data('pid');
        var btnremovefavorites = this;

        $.post(MAINURL + "/social/deletefavorites.php", {
            postid: postid
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


    $(document).ready(function() {
        $("#dt1").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            onSelect: function() {
                var dt2 = $('#dt2');
                var startDate = $(this).datepicker('getDate');
                //add 30 days to selected date
                startDate.setDate(startDate.getDate() + 30);
                var minDate = $(this).datepicker('getDate');
                var dt2Date = dt2.datepicker('getDate');
                //difference in days. 86400 seconds in day, 1000 ms in second
                var dateDiff = (dt2Date - minDate) / (86400 * 1000);

                //dt2 not set or dt1 date is greater than dt2 date
                if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
                }
                //dt1 date is 30 days under dt2 date
                else if (dateDiff > 30) {
                    dt2.datepicker('setDate', startDate);
                }
                //sets dt2 maxDate to the last day of 30 days window
                dt2.datepicker('option', 'maxDate', startDate);
                //first day which can be selected in dt2 is selected date in dt1
                dt2.datepicker('option', 'minDate', minDate);
            }
        });
        $('#dt2').datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
    });
</script>