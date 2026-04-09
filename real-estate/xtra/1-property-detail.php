<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin']="timeline/";
    }
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $re = new _redirect;
    $p = new _postingview;
    $pf  = new _postfield;

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    if(isset($_GET['postid']) && $_GET['postid'] >0){


        //all detail of single product
        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $ProTitle   = $row['spPostingtitle'];
            $ProDes     = $row['spPostingNotes'];
            $OwnerName = $row['spProfileName'];
            $OwnerId   = $row['idspProfiles'];
            $OwnerAbout= $row['spProfileAbout'];
            $OwnerPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];
            $postDate = $row['spPostingDate'];

            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
                $address = "";
                $propertyId = "";
                $propertyType = "";
                $bedroom = "";
                $bathroom = "";
                $proStatus = "";
                $postalCode = "";
                $yearBuilt = "";
                $basement = "";
                $squarefoot = "";
                $unitNumber = "";
                $taxAmt = "";
                $taxYear = "";
                $housStylle = "";
                $keyword = "";

                
                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                    
                    if($proStatus == ''){
                        if($row2['spPostFieldName'] == 'spPostingPropStatus_'){
                            $proStatus = $row2['spPostFieldValue'];
                        }
                    }
                    if($keyword == ''){
                        if($row2['spPostFieldName'] == 'spPostingkeyword_'){
                            $keyword = $row2['spPostFieldValue'];
                        }
                    }
                    if($housStylle == ''){
                        if($row2['spPostFieldName'] == 'spPostingHouseStyle_'){
                            $housStylle = $row2['spPostFieldValue'];
                        }
                    }
                    if($taxYear == ''){
                        if($row2['spPostFieldName'] == 'spPostTaxYear_'){
                            $taxYear = $row2['spPostFieldValue'];
                        }
                    }
                    if($taxAmt == ''){
                        if($row2['spPostFieldName'] == 'spPostTaxAmt_'){
                            $taxAmt = $row2['spPostFieldValue'];
                        }
                    }
                    if($unitNumber == ''){
                        if($row2['spPostFieldName'] == 'spPostUnitNum_'){
                            $unitNumber = $row2['spPostFieldValue'];
                        }
                    }
                    if($squarefoot == ''){
                        if($row2['spPostFieldName'] == 'spPostingSqurefoot_'){
                            $squarefoot = $row2['spPostFieldValue'];
                        }
                    }
                    if($basement == ''){
                        if($row2['spPostFieldName'] == 'spPostBasement_'){
                            $basement = $row2['spPostFieldValue'];
                        }
                    }
                    if($yearBuilt == ''){
                        if($row2['spPostFieldName'] == 'spPostingYearBuilt_'){
                            $yearBuilt = $row2['spPostFieldValue'];
                        }
                    }
                    if($postalCode == ''){
                        if($row2['spPostFieldName'] == 'spPostingPostalcode_'){
                            $postalCode = $row2['spPostFieldValue'];
                        }
                    }
                    if($bathroom == ''){
                        if($row2['spPostFieldName'] == 'spPostingBathroom_'){
                            $bathroom = $row2['spPostFieldValue'];
                        }
                    }
                    if($bedroom == ''){
                        if($row2['spPostFieldName'] == 'spPostingBedroom_'){
                            $bedroom = $row2['spPostFieldValue'];
                        }
                    }
                    if($address == ''){
                        if($row2['spPostFieldName'] == 'spPostingAddress_'){
                            $address = $row2['spPostFieldValue'];
                        }
                    }
                    if($propertyId == ''){
                        if($row2['spPostFieldName'] == 'spPostListId_'){
                            $propertyId = $row2['spPostFieldValue'];
                        }
                    }
                    if($propertyType == ''){
                        if($row2['spPostFieldName'] == 'spPostingPropertyType_'){
                            $propertyType = $row2['spPostFieldValue'];
                        }
                    }
                    
                }
                //$dtstrtTime = strtotime($startTime);
                //$dtendTime = strtotime($endTime);
            }
        }

    }else{
        $redirctUrl = $BaseUrl."/real-estate";
        $re->redirect($redirctUrl);
    }
    $header_realEstate = "realEstate";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyC_DSpbYv4QzcI8x2nVaQ48CQE6QhVbGPI"></script>
        <script src="<?php echo $BaseUrl.'/assets/js/jquery.geocomplete.js';?>"></script>
        <script>
            $(function(){
                var options = {
                    map: ".map_canvas",
                    location: "<?php echo $address; ?>",
                    zoom: 13
                };
                $("#geocomplete").geocomplete(options);
            });
        </script>

        <script type="text/javascript">
             jQuery(document).ready(function($) {
                $('#myCarousel').carousel({
                        interval: 5000
                });         
                $('#carousel-text').html($('#slide-content-0').html());
                //Handles the carousel thumbnails
               $('[id^=carousel-selector-]').click( function(){
                    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                    var id = parseInt(id);
                    $('#myCarousel').carousel(id);
                });
                // When the carousel slides, auto update the text
                $('#myCarousel').on('slid.bs.carousel', function (e) {
                         var id = $('.item.active').data('slide-number');
                        $('#carousel-text').html($('#slide-content-'+id).html());
                });
            });
        </script>
        
        
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="realTopBread no-padding" >
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right" style="padding-top: 20px;">
                            <a href="<?php echo $BaseUrl.'/real-estate/all-property.php';?>" class="btn butn_find_room">Back to result</a>
                            <a href="<?php echo $BaseUrl.'/post-ad/real-estate/?post';?>" class="btn butn_save">Submit an Add</a>
                            <a href="<?php echo $BaseUrl.'/real-estate/find-a-room.php';?>" class="btn butn_find_room">Find A Room</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2><?php echo $ProTitle;?></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate/all-property.php';?>">Sell</a></li>
                                <li class="breadcrumb-item active"><?php echo $ProTitle;?></li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="layerPrprtyTop">
                <ul>
                    <li>Property Id: <span><?php echo $propertyId;?></span></li>
                    <li>Property Type <span><?php echo $propertyType;?></span></li>
                    <li>Updated ON <span><?php echo $postDate;?></span></li>
                </ul>
            </div>
        </section>
        <section class="">
            <div class="container">
                <div class="space-md"></div>
                <div class="bg_white setupProperty">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product_slider_box social" >
                                <div id="carousel-bounding-box">
                                    <div class="carousel slide" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner productslider" id="RealestateSlidr">
                                            <?php
                                            $pc = new _postingpic;
                                            $res = $pc->read($_GET["postid"]);
                                            //echo $pc->ta->sql;
                                            $active1 = 0;
                                            if ($res != false) {
                                                while($postr = mysqli_fetch_assoc($res)){
                                                    $picture = $postr['spPostingPic']; ?>
                                                    <div class="<?php echo ($active1 == 0)?'active':'';?> item" data-slide-number="<?php echo $active1?>">
                                                        <?php
                                                        if(isset($picture)){ ?>
                                                            <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" > <?php
                                                        }else{ ?>
                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > <?php
                                                        }
                                                        ?>
                                                    </div> <?php
                                                    $active1++;
                                                }
                                            }
                                            ?>
                                        </div><!-- Carousel nav -->
                                    </div>
                                </div>
                                <div class="hidden-xs" id="slider-thumbs">
                                    <!-- Bottom switcher of slider -->
                                    <ul class="row hide-bullets propertyImgAll">
                                        <?php
                                        $pc = new _postingpic;
                                        $res = $pc->read($_GET["postid"]);
                                        //echo $pc->ta->sql;
                                        $active1 = 0;
                                        if ($res != false) {
                                            $active2 = 0;
                                            while($postr = mysqli_fetch_assoc($res)){
                                                $picture = $postr['spPostingPic']; 
                                                if($active2 == 0){
                                                    $pic = $picture;
                                                }
                                                ?>
                                                <li class="col-sm-2 padding_5 thumb_box">
                                                    <a class="thumbnail" id="carousel-selector-<?php echo $active2;?>">
                                                        <?php
                                                        if(isset($picture)){ ?>
                                                            <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" > <?php
                                                        }else{ ?>
                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </li> <?php
                                                $active2++;
                                            }
                                        }else{?>
                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="margin: 0 auto;" ><?php
                                        }
                                        ?>
                                    </ul>                 
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <div class="rightProperty">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="leftH">Contact Agent for this property</h2>
                                        <form method="post" action="sendEnquiry.php" class="enqRealForm">
                                            <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
                                            <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid'];?>">
                                            <input type="hidden" name="sprealType" value="0">
                                            <input type="text" name="sprealName" class="form-control" placeholder="Full Name" required="">
                                            <input type="email" name="sprealEmail" class="form-control" placeholder="Email" required="">
                                            <input type="text" name="sprealPhone" class="form-control" placeholder="Phone" required="">
                                            <textarea class="form-control" name="sprealMessage" placeholder="I'm Intrested in this...."></textarea>
                                            <input type="submit" value="Send Enquiry" class="btn <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?> " <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?>>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="rightBoxpro">
                                            <h2 class="rightH"><i class="fa fa-calculator"></i> Calculate Price</h2>
                                            <form>
                                                <input type="text" name="txtPrice" id="txtPrice" class="form-control" readonly="" placeholder="Price" value="<?php echo $price;?>">
                                                <input type="text" name="txtAgentFee" id="txtAgentFee" class="form-control" placeholder="Agent Fee" value="">
                                                <input type="text" name="txtPercent" id="txtPercent" class="form-control" placeholder="Percent Down">
                                                <label style="font-size: 25px;">Total: $<span id="updatePrice"><?php echo $price;?></span></label>
                                                <!-- <input type="text" name="" class="form-control" placeholder="Interest Rate"> -->
                                                <!-- <input type="submit" name="" value="CALCULATE my mortage"> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
                <div class="bg_white setupPropertysetleft">
                    <div class="row">
                        <div class="col-md-5">
                            <h2>Summary</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Price</td>
                                            <td>$<?php echo $price;?></td>
                                        </tr>
                                        <tr>
                                            <td>Square Footage</td>
                                            <td><?php echo $squarefoot;?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><?php echo $proStatus;?></td>
                                        </tr>
                                        <tr>
                                            <td>Property Type</td>
                                            <td><?php echo $propertyType; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Location</td>
                                            <td><?php echo $address; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bedrooms</td>
                                            <td><?php echo ($bedroom > 0)?$bedroom:0;?></td>
                                        </tr>
                                        <tr>
                                            <td>Bathrooms</td>
                                            <td><?php echo ($bathroom > 0)?$bathroom: 0;?></td>
                                        </tr>
                                        <tr>
                                            <td>Basement</td>
                                            <td><?php echo ($basement > 0)?$basement: 0;?></td>
                                        </tr>
                                        <tr>
                                            <td>Postal Code</td>
                                            <td><?php echo $postalCode; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Year Built</td>
                                            <td><?php echo $yearBuilt; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Unit Number</td>
                                            <td><?php echo $unitNumber; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tax Amount</td>
                                            <td><?php echo $taxAmt; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tax year</td>
                                            <td><?php echo $taxYear; ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h2>Property Description</h2>
                            <p class="text-justify"><?php echo $ProDes;?></p>
                            <?php
                            $pf  = new _postfield;
                            $fieldName = "spPostListing_";
                            $filter = 1;
                            $chkRent = "";
                            //$result7 = $pf->readCustomPost($_GET['postid'], $fieldName);
                            $result7 = $pf->readCustomPostFilter($_GET['postid'], $fieldName, $filter);
                            //echo $pf->ta->sql;
                            if ($result7 != false) {

                                $row7 = mysqli_fetch_assoc($result7);
                                if($row7['spPostFieldValue'] != 'Rent'){
                                    ?>
                                    <h3>FEATURES</h3>
                                    <div class="bg_gray rightGrayFeature">
                                        <div class="row">
                                            <div class="col-md-12 proFeaturTag">
                                                <?php
                                                $pf  = new _postfield;
                                                $fieldName = "spPostHighLit_";
                                                $result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
                                                //echo $pf->ta->sql."<br>";
                                                if($result6 != false){
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        if($row6['spPostFieldValue'] != ''){
                                                            echo "<span>".$row6['spPostFieldValue']."</span>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            
                            <h3>House Style</h3>
                            <p class="text-justify"><?php echo $housStylle; ?></p>

                            <h3>Adress Map</h3>
                            <div class="row btmMappro">
                                <div class="col-md-12">
                                    <div class="map_canvas"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <section class="agentHome">
                <div class="row no-margin">
                    <div class="col-md-10 no-padding text-center">
                        <div class="leftBox">
                            <h2><?php echo $OwnerName; ?></h2>
                            <p class="desc"><?php echo $OwnerAbout; ?></p>
                        </div>
                    </div>
                    <div class="col-md-2 no-padding">
                        <?php
                        if ($OwnerPic != '') {
                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($OwnerPic) . "' >";
                        } else{
                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                        }
                        ?>
                    </div>
                </div>
            </section>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="realTitle text-center">
                            <h2>Agent <span>Listing</span></h2>
                        </div>
                    </div>
                    <?php

                    $start = 0;
                    $limit = 1;
                    $p      = new _postingview;
                    $pf     = new _postfield;
                    $res    = $p->getAgentList($_GET["categoryID"], $OwnerId);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) {
                            //posting fields
                            $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            if($result_pf){
                                $address = "";
                                $bedroom = "";
                                $bathroom = "";
                                $sqrfoot = "";
                                $basement = "";
                                $propertyType = "";
                                
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
                                
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="realBox">
                                    <a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row['idspPostings'];?>">
                                        <div class="boxHead">
                                            <h2><?php echo $row['spPostingtitle'];?></h2>
                                            <p>
                                                <i class="fa fa-map-marker"></i> 
                                                <?php
                                                if(strlen($address) < 30){
                                                    echo $address;
                                                }else{
                                                    echo substr($address, 0,30)."...";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <?php
                                        $pic = new _postingpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>"; 
                                            }
                                        }?>
                                        <div class="midLayer">
                                            <ul>
                                                <li data-toggle="tooltip" title="Square Foot"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0)?$sqrfoot:0; ?></li>
                                                <li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0)?$bedroom:0;?></li>
                                                <li data-toggle="tooltip" title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0)?$bathroom:0; ?></li>
                                                <li data-toggle="tooltip" title="Basement" class="text-right"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-4.png"><?php echo ($basement > 0)?$basement:0; ?></li>
                                            </ul>
                                        </div>
                                        <div class="boxFoot bg_white text-center">
                                            <p class="proType"><?php echo $propertyType;?></p>
                                            <p><span>$<?php echo $row['spPostingPrice'];?></span></p>
                                        </div>
                                    </a>
                                </div>
                            </div> <?php
                        }
                    }
                    ?>
                    
                
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading08 text-center">
                            <h2>similar <span>Listing</span></h2>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
                <div class="row">
                    <?php
                    $start = 0;
                    $limit = 1;
                    
                    $p      = new _postingview;
                    $pf     = new _postfield;
                    $res    = $p->getAgentList($_GET["categoryID"], $OwnerId);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div class="col-md-4">
                                <div class="featBoxReal">
                                    <a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row['idspPostings'];?>">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php
                                                $pic = new _postingpic;
                                                $res2 = $pic->readFeature($row['idspPostings']);
                                                if($res2 != false){
                                                    if($res2->num_rows > 0){
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                                        }
                                                    }else{
                                                        $res2 = $pic->read($row['idspPostings']);
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                                        }
                                                    }
                                                }else{
                                                    $res2 = $pic->read($row['idspPostings']);
                                                    if ($res2 != false) {
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                                    } else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
                                                    }
                                                }?>
                                                
                                            </div>
                                            <div class="col-md-7 no-padding">
                                                <h3><?php echo $row['spPostingtitle'];?></h3>
                                                <p class="city"><?php echo $row['spPostingsCity'];?></p>
                                                <p class="price">$<?php echo $row['spPostingPrice'];?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $limit++;
                            if($limit > 6){
                                break;
                            }
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </section>
        <div class="space-md"></div>
        <div class="hidden">
            <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
        </div>
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        
	</body>
</html>
