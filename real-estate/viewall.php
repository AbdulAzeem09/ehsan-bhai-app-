<?php

include('../univ/baseurl.php');
session_start();
//print_r($_SESSION);
// echo $_SESSION['pid'];
// exit;
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "real-estate/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

   

    $f = new _spprofiles;
    $re = new _redirect;
    //check profile is freelancer or not
    if ($_SESSION['guet_yes'] != "yes") {



        $chekIsBusiness = $f->readBusiness($_SESSION['pid']);
        if ($chekIsBusiness == false) {
            $_SESSION['count'] = 0;
            $_SESSION['msg'] = "Only  Professional, Business and Personal Profile can create an ad in this module. Please create or switch to any of the mentioned profiles.";
        }
    }


    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $home = true;

?>


    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <?php include('../component/links.php'); ?>
        
        <!--This script for posting timeline data Start-->
       
         <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

        <!--This script for posting timeline data End-->

        <style type="text/css">

body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
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
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}   

.simple-pagination .current {
	color: #FFF;
	background-color: #7daa11;
	border-color: #7daa11;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #95ba3d;
}





            .app {
                border: 1px solid black;
                margin-left: 5px;
                height: 175px;
                width: 19%;
                float: left;
                overflow: hidden;
            }

            .space1 {
                margin-top: 30px;
            }

            .realBox .boxHead {
                background-color: #95ba3d;
                padding: 5px 10px;
            }

            #indent {
                margin-top: 5px;
                float: left;
            }

            #profileDropDown li a {
                padding: 0px !important;
            }

            span#car1 {
                margin-top: 12px;
            }

            #profileDropDown li.active {
                background-color: #95ba3d !important;
            }

            #profileDropDown li.active a {
                color: #fff !important;
            }

            .inner_top_form input[type=text] {
                width: 52% !important;
            }
        </style>
    </head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> -->
    <body class="bg_gray">
        <?php include_once("../header.php"); ?>
        <section class="main_box no-padding" id="art-page">
            <div class="RealEsmap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13931873.302173598!2d74.27075075!3d31.514923349999993!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1516348101457" frameborder="0" style="border:0" allowfullscreen></iframe>

                <p>
                    <?php
                    $p = new _postingview;
                    $fieldName = 'All';
                    $total = 0;
                    $result = $p->countTotalPost($_GET["categoryID"], $fieldName);
                    //echo $p->ta->sql;
                    if ($result != false) {
                        if ($result->num_rows > 0) {
                            echo $total = $result->num_rows;
                        } else {
                            echo $total = 0;
                        }
                    }
                    ?><br> <span>Global live events</span>
                </p>
            </div>
        <?php include('top-search.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="realTitle2 text-center">
                            <h3><span>900+</span> Real Estate & Homes for Sale</h3>
                            <!-- <a href="<?php echo $BaseUrl . '/real-estate/all-property.php'; ?>">View all listings</a> -->
                        </div>
                    </div>
                </div>
                <div class="space-lg"></div>
                <div class="row list-wrapper">
                    <?php

            $country=$_SESSION['spPostCountry'];
            $state=$_SESSION['spPostState'];
           $city=$_SESSION['spPostCity'];


                    $p = new _realstateposting;
                    $pf = new _postfield;
                    $type = "Sell";

                    $res = $p->showAllPropertyviewall($_GET["categoryID"], $type, $country, $state);
                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                    //echo $p->ta->sql;
                    if ($res != false) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            //print_r($row);
                            if ($row['spuser_idspuser'] != NULL) {
                                $st = new _spuser;
                                $st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
                                if ($st1 != false) {
                                    $stt = mysqli_fetch_assoc($st1);
                                    $account_status = $stt['deactivate_status'];
                                }
                            }
                            $pt = new _productposting;
                            $postids = $row['idspPostings'];
                            $flagcmd = $pt->flagcount(3, $postids);
                            $flagnums = $flagcmd->num_rows;
                            if ($flagnums == '9') {
                                $updatestatus = $pt->realstatus($idposting);
                            }
                            $address = $row['spPostingAddress'];
                            $bedroom = $row['spPostingBedroom'];
                            $bathroom = $row['spPostingBathroom'];
                            $sqrfoot = $row['spPostingSqurefoot'];
                            $basement = $row['spPostBasement'];
                            $propertyType = $row['spPostingPropertyType'];
                            $price = $row['spPostingPrice'];

                            //posting fields
                            $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            /*  if($result_pf){
                                  
                                    
                                    while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                        
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
                                        
                                    }
                                    
                                }*/
                            if ($account_status != 1) {
                    ?>
                                <div class="col-md-3 list-item">
                                    <div class="realBox">
                                        <a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row['idspPostings']; ?>">
                                            <div class="boxHead">
                                                <h2 class="text1"><?php echo $row['spPostingTitle']; ?></h2>
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
                                                    <li title="Square Foot"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0) ? $sqrfoot : 0; ?></li>
                                                    <li title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? $bedroom : 0; ?></li>
                                                    <li title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? $bathroom : 0; ?></li>
                                                    <li title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement : 0; ?></li>
                                                </ul>
                                            </div>
                                            <div class="boxFoot bg_white text-center">
                                                <p class="proType text1"><?php echo $propertyType; ?></p>
                                                <p class="text1"><span><?php echo $row['defaltcurrency'] . ' ' . number_format($price); ?></span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div> <?php }
                                    $limit++;
                                    if ($limit > 8) {
                                        break;
                                    }
                                }
                            }
                                        ?>



                </div>
                <div id="pagination-container"></div>
                <div class="space"></div>
            </div>
        </section>
       
       
        <!-- <section class="searchBoxReal space1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>Find Your <span>Neighbourhood</span></h3>
                            <p>Does it have pet-friendly rentals? Get important local information on the area you're most interested in.</p>
                            <form method="POST" action="search.php" >
                                <div class="form-group">
                                    <input type="text" name="txtAddress" class="form-control" placeholder="Search for a property">
                                    <input type="submit" name="btnAdresSearch" class="btn" value="Search Local">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>-->
        
        

        <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                <?php
                if (isset($_SESSION['msg']) && $_SESSION['count'] == 0) {
                ?>
                    $.notify({
                        title: "<?php echo '<strong>' . $_SESSION['msg'] . '</strong>' ?>",
                        icon: '',
                        message: ""
                    }, {
                        type: 'success',
                        animate: {
                            enter: 'animated fadeInUp',
                            exit: 'animated fadeOutRight'
                        },
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                    });
                <?php
                    $_SESSION['count']++;
                    unset($_SESSION['err']);
                }
                ?>
            });
        </script>
        <?php
        include('../component/footer.php');
        include('../component/btm_script.php');

        ?>
    </body>

    </html>
<?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 8;

    items.slice(perPage).hide();
    if(perPage>numItems){
        $('#pagination-container').hide();
    }else{
        $('#pagination-container').show();
    }
    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });
</script>