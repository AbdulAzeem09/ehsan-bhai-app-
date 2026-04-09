<?php
    include('../univ/baseurl.php');
    session_start();
    if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] == 1){

    }else if(isset($_GET["postid"]) && $_GET["postid"] >0){
			
    }

    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET['categoryID'] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <!--THIS IS ZOOM PLUGIN FOR IMAGE DETAIL PAGES START -->
        <link href="<?php echo $BaseUrl; ?>/assets/zoom/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $BaseUrl; ?>/assets/zoom/lib/blowup.js"></script>
        <!--THIS IS ZOOM PLUGIN FOR IMAGE DETAIL PAGES END -->
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END--> 
        <!--CSS FOR MULTISELECTOR-->
        <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });
            
        </script>

        <script type="text/javascript">
             jQuery(document).ready(function($) {
                       
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

    <body class="bg_gray" lang="en">
        <?php
           
            
            //this is for store header
            $header_store = "header_store";

            include("../header.php");
            
            $p = new _postingview;
            $rd = $p->read($_GET["postid"]);
            //echo $p->ta->sql;
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);
                $PostTitle  = $row['spPostingtitle'];
                $price      = $row['spPostingPrice']; 
                $catid      = $row["idspCategory"];
                $wholesaleflag = $row["spPostingsFlag"];
                $button     = $row["spCategoriesButton"];
                $comment    = $row["sppostingscommentstatus"];
                $Country    = $row['spPostingsCountry'];
                $City       = $row['spPostingsCity'];
                $dt         = new DateTime($row['spPostingDate']);
                $desc       = $row['spPostingNotes'];
                //post add person info
                $SellName   = $row['spProfileName'];
                $SellEmail  = $row['spProfileEmail'];
                $SellPhone  = $row['spProfilePhone'];
                $SellAdres  = $row['spprofilesAddress'];
                $SellCity   = $row['spProfilesCity'];
                $SellCounty = $row['spProfilesCountry'];
                $SellId     = $row['idspProfiles'];
                $p = new _postingview;
                $result4 = $p->publicpost_count($SellId);
                //echo $p->ta->sql;
                if($result4 != false){
                    $SelProduct = mysqli_num_rows($result4);
                }else{
                    $SelProduct = 0;
                }
            }
            
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                             $storeTitle = "Public Store";
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                       
                        <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Store: <?php echo $storeTitle;?></h3>
                                </div>
                            </div>
                        </div>

                        
                        <div class="breadcrumb_box m_btm_10 row no-margin">
                            <div class="col-md-8 no-padding">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl;?>">Home</a></li>
                                    <?php
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                        $storeTitle = "My Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                        $storeTitle = "Group Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 4){
                                        $storeTitle = "Friend's Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 99){
                                        $storeTitle = "WholeSale Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else{
                                        $storeTitle = "Public Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    } 
                                    if(isset($_GET['grpName']) && $_GET['grpName'] != ''){
                                        $fieldValue = str_replace('_', ' ', $_GET['grpName']);
                                        $FinalTitle = str_replace('-', '&', $fieldValue);
                                        
                                        $storeTitle = $FinalTitle;

                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'/category.php?gid='.$_GET['gid'].'&gname='.$_GET['grpName'].'&back=back">'.$storeTitle.'</a></li>';
                                    } 

                                    if(isset($_GET['catName'])){ ?>
                                        <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/'.$folder.'/category.php?catName='.$_GET['catName'];?>"><?php echo $categoryTitle;?></a></li> <?php
                                    } ?>
                                    
                                    <li class="breadcrumb-item active"><?php echo $PostTitle?></li>
                                </ol>
                            </div>
                            <div class="col-md-4 text-right right_link" >
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a>
                            </div>
                        </div>
                        <?php include('searchform.php');?>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="pro_detail_box">
                                    <h2><?php echo $PostTitle; ?></h2>
                                    <div class="row no-margin">
                                        <div class="col-md-6 no-padding">
                                            
                                            <div class="product_slider_box social">
                                                <div id="carousel-bounding-box">
                                                    <div class="carousel slide" id="myCarousel">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner productslider">
                                                            <?php
                                                            $pc = new _postingpic;
                                                            $res = $pc->read($_GET["postid"]);
                                                            //echo $pc->ta->sql;
                                                            $active1 = 0;
                                                            if ($res != false) {
                                                                while($postr = mysqli_fetch_assoc($res)){
                                                                    $picture = $postr['spPostingPic']; ?>
                                                                    <script>
                                                                        $(document).ready(function () {
                                                                            $(".img_zoom_<?php echo $active1; ?>_t").blowup();
                                                                        });
                                                                    </script>
                                                                    <div class="<?php echo ($active1 == 0)?'active':'';?> item" data-slide-number="<?php echo $active1?>">
                                                                        <?php
                                                                        if(isset($picture)){ ?>
                                                                            <img class="img_zoom_<?php echo $active1; ?>_t img-responsive" src="<?php echo ($picture); ?>" alt="Posting Pic"  > <?php
                                                                        }else{ ?>
                                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > <?php
                                                                        }
                                                                        ?>
                                                                    </div> 
                                                                    <!--completed-->
                                                                    
                                                                    <?php
                                                                    $active1++;
                                                                }
                                                            }
                                                            ?>
                                                        </div><!-- Carousel nav -->
                                                                                     
                                                    </div>
                                                </div>
                                                <div class="hidden-xs" id="slider-thumbs">
                                                    <!-- Bottom switcher of slider -->
                                                    <ul class="row hide-bullets">
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

                                                <ul class="produc_quote_box social">
                                                    <li><a href="#" id="enquire" data-toggle="modal" data-target="#enqueryModal"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/enquiry.png"> Enquiry</a></li>
                                                    <?php
                                                    $fv = new _favorites;
                                                    $res_fv = $fv->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                                    //echo $fv->ta->sql;
                                                    if($res_fv != false){
                                                        echo '<li><a data-postid="'. $_GET["postid"].'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
                                                    }else{
                                                        echo '<li><a data-postid="'. $_GET["postid"].'" id="addtofavourite"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"> Favourite</a></li>';
                                                    }


                                                    $pc = new _postingpic;
                                                    $resp = $pc->read($_GET["postid"]);
                                                    //echo $pc->ta->sql;
                                                    if ($resp != false) {
                                                        $postrp = mysqli_fetch_assoc($resp);
                                                        $pictp = $postrp['spPostingPic']; 
                                                    }  ?>
                                                    <li><a href="#" data-toggle='modal' data-target='#myshare'><span class='sp-share' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pictp); ?>'><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/share.png"> Share</span></a></li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_detail_right">
                                                
                                                <p>Product Id : <strong>AEF-<?php echo $_GET['postid'];?></strong></p>
                                                <p>Last Updated Date: <strong><?php echo $dt->format('d M Y'); ?></strong></p>
                                                <?php
                                                //Quantity availability of this post
                                                $pr = new _postfield;
                                                $re = $pr->quantity($_GET["postid"]);
                                                //echo $pr->ta->sql;
                                                $soldquantity =0;
                                                if ($re != false) {
                                                    $i = 0;
                                                    $rw = mysqli_fetch_assoc($re);
                                                    $totalquantity = $rw["spPostFieldValue"];
                                                } else {
                                                    if ($catid == 8 || $catid == 10 || $catid == 11 || $catid == 13 || $catid == 14)
                                                        $totalquantity = INF;
                                                    else
                                                        $totalquantity = 1;
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
                                                }else{
                                                    $available = 0;
                                                }
                                                //check product is auction or not
                                                $po = new _postfield;
                                                $result_po = $po->checkAuction($_GET['postid']);
                                                if($result_po == true){
                                                    $result_fel = $po->field($_GET['postid']);
                                                    //echo $po->ta->sql;
                                                    $ItemCondition = '';
                                                    $ExpiryDate = '';
                                                    if($result_fel != false){
                                                        while ($row_fel = mysqli_fetch_assoc($result_fel)) {
                                                            //echo $row_fel['spPostFieldName']."<br>";
                                                            
                                                            if($row_fel['spPostFieldName'] == 'auctionStatus_'){
                                                                $ItemCondition = $row_fel['spPostFieldValue'];
                                                            }else{
                                                                if($ItemCondition == ''){
                                                                    $ItemCondition = "Not Define";
                                                                }
                                                            }
                                                            
                                                            if($row_fel['spPostFieldName'] == 'auctionEndDate_'){
                                                                $ExpiryDate = $row_fel['spPostFieldValue'];
                                                            }else{
                                                                if($ExpiryDate == ''){
                                                                    $ExpiryDate = "0000-00-00";
                                                                }
                                                            }
                                                            
                                                            
                                                            
                                                        }
                                                    }
                                                    $bid = new _postfield;
                                                    $result_bid = $bid->allauctionbid($_GET['postid']);
                                                    //echo $bid->ta->sql;
                                                    $result_au  = $bid->get_heigh_auction_price($_GET['postid']);
                                                    //echo $bid->ta->sql;
                                                    if($result_au != false){
                                                        $row_he = mysqli_fetch_assoc($result_au);
                                                        $HeighestBid = $row_he['spPostFieldValue'];
                                                    }else{
                                                        $HeighestBid = $price;
                                                    }

                                                    if($result_bid != false){
                                                        $totalBid = $result_bid->num_rows;
                                                    }else{
                                                        $totalBid = 0;
                                                    }
                                                    ?>
                                                    <div class="auction_box">
                                                        <p><strong>Item condition</strong> : <?php echo $ItemCondition;?></p>
                                                        <p><strong>Expired Date</strong> : <?php echo $ExpiryDate;?></p>
                                                        <p><strong>Total Bids</strong> : <?php echo $totalBid; ?></p>
                                                        <p><strong>Current bid</strong> : US $<?php echo $HeighestBid;?></p>

                                                    </div>
                                                    <?php
                                                }else{ ?>
                                                    <div class="price_box">
                                                        <p style="margin: 0px;">
                                                            <?php  
                                                            if ($price != false) {
                                                                $pr = new _postfield;
                                                                $re = $pr->readprice($_GET["postid"]);
                                                                if ($re != false) {
                                                                    ?>
                                                                    $<?php echo $price; ?> /hour
                                                                    <?php
                                                                } else {
                                                                    if ($catid == 9) {
                                                                        $ticketprice = $price;
                                                                        ?>
                                                                        Ticket Price $<?php echo $price; ?>
                                                                        <?php
                                                                    } else{
                                                                        echo '<strong>Price $'.$price.'</strong>'; 
                                                                    }
                                                                }
                                                            } ?>
                                                        </p>
                                                    </div>
                                                    <div class="space"></div>
                                                    <?php
                                                    //if($button == "Buy" && $catid != 3 )
                                                    if ($catid == 1 || $catid == 9 || $catid == 15){
                                                        //echo $available;
                                                        ?>
                                                        <div class="row  no-margin qtyBox">
                                                            <p><span class="qty_box">Quantity available: <input type="text" name="" value="<?php echo $available;?>" class="qtyavb" readonly /></span></p>
                                                            <p>
                                                                <span class="qty_box">Quantity: <input type="text" name="" value="0"  style="width: 50px;" maxlength="5" /></span>
                                                                
                                                            </p>

                                                            
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                
                                                
                                                <div class="btn_box">
                                                    <form action="<?php echo ($available == 0 ?" ":"../cart/addorder.php");?>" method="post">
                                                        <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
                                                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
                                                        <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
                                                        <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $row['idspProfiles'];?>"/>
                                                        
                                                        <?php
                                                            if($catid == 18){
                                                                echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#quotation'><span class='fa fa-quote-left' aria-hidden='true'></span> Send Quotation</button>";
                                                            
                                                            }elseif($catid == 2){
                                                                $p = new _postfield;
                                                                $res = $p->readfield($_GET["postid"]);
                                                                if ($res != false)
                                                                {
                                                                    while($rows = mysqli_fetch_assoc($res))
                                                                    {
                                                                        if($rows["spPostFieldLabel"] == "Closing Date")
                                                                            $closingdate = $rows["spPostFieldValue"];
                                                                    }
                                                                }
                                                                //Checking already applyed or not
                                                                $profile = new _spprofiles;
                                                                $profileid ="";
                                                                $result = $profile->readjobseeker($_SESSION["uid"]);
                                                                if($result != false)
                                                                {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $profileid = $row['idspProfiles'];
                                                                }
                                                                
                                                                $p = new _sppost_has_spprofile;
                                                                $res = $p->read($_GET["postid"], $profileid);
                                                                if($res != false)
                                                                {
                                                                    echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled'>Applied</button>";
                                                                }
                                                                else    
                                                                    echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#coverletter' id='applybtn'>Apply Job</button>";
                                                                
                                                                include("coverletter.php");
                                                            
                                                            }else if($catid == 5){
                                                                
                                                                echo "<button type='button' class='btn btn-success btn-sm pull-right' data-toggle='modal' data-categoryid='".$catid."' data-postid='".$_GET["postid"]."' data-target='#bid-system' data-profileid='".$_SESSION['pid']."'><span class='fa fa-hand-paper-o'> </span> Bid</button>";
                                                            
                                                            }else if($catid != 18 && $catid != 2 && $catid != 5 && $catid != 7 && $catid != 12) {
                                                                
                                                                if( $catid == 9){
                                                                    if($ticketprice > 0){
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);
                                                                        if ($res != false)
                                                                        {
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
                                                                        }
                                                                        else
                                                                            echo "<button type='submit' class='btn btn-primary btn-sm pull-right ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
                                                                    }else{
                                                                        
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkevent($_GET["postid"] , $buyerid);
                                                                        if ($res != false){
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Joined</button>";
                                                                        }
                                                                        else{
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right joinevent' data-profileid='".$_SESSION["pid"]."'  data-postid='".$_GET["postid"]."' data-seller='".$row['idspProfiles']."'>Join</button>";
                                                                        }
                                                                    }
                                                                    
                                                                }else{
                                                                    $po = new _postfield;
                                                                    $result_po = $po->checkAuction($_GET['postid']);
                                                                    if($result_po == true){

                                                                        echo "<button type='button' class='btn btn_cart' data-toggle='modal' data-target='#bid-auction' >Post Bid</button>";

                                                                    }else{
                                                                        echo "<button type='submit' class='btn btn_cart_buy".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='btnBuyNow'>Buy Now</button>";
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);
                                                                        if ($res != false){
                                                                            echo "<button type='button' class='btn btn_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Added to cart</button>";
                                                                        }else{
                                                                            echo "<button type='submit' class='btn btn_cart".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Add to cart</button>";
                                                                        }
                                                                    }
                                                                    
                                                                }
                                                            }

                                                        ?>
                                                    </form>

                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="space"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="panel with-nav-tabs panel-default main_panel_pro">
                                                <div class="panel-heading no-padding product_desc">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab1default" data-toggle="tab">Description</a></li>
                                                        <li><a href="#tab2default" data-toggle="tab">Specification</a></li>
                                                        <li><a href="#tab3default" data-toggle="tab">Reviews</a></li>
                                                        <?php 
                                                        $po = new _postfield;
                                                        $result_my_au = $po->checkMyAuction($_GET['postid'], $_SESSION['pid']);
                                                        //echo $po->ta->sql;
                                                        if($result_my_au == true){ ?>
                                                            <li><a href="#tab4default" data-toggle="tab">Your Bids</a></li> <?php    
                                                        }

                                                        ?>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active" id="tab1default">
                                                            <p><?php echo $desc;?></p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab2default">
                                                            <p>No-Specification</p>
                                                            
                                                        </div>
                                                        <div class="tab-pane fade" id="tab3default">
                                                            <?php
                                                            $r = new _sppostrating;
                                                            $res = $r->read($_SESSION["pid"],$_GET["postid"]);
                                                            if($res != false){
                                                                $rows = mysqli_fetch_assoc($res);
                                                                $rat = $rows["spPostRating"];
                                                            }else{
                                                                $rat = 0;
                                                            }
                                                            ?>
                                                            <!-- <h2>Post Review</h2>
                                                            <form action="../review/addreview.php" method="POST">
                                                                <input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']?>"/>
                                                                <input type="hidden" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
                                                                <input type="hidden" name="spPostRating" id="spPostRating" value="<?php echo $rat;?>">
                                                                <?php
                                                                if(isset($folder)){
                                                                    $_SESSION['folder'] = $folder;
                                                                }else{
                                                                    $_SESSION['folder'] = "store";
                                                                }
                                                                ?>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..." rows="5"></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary writereview">Add Review</button>

                                                                
                                                            </form> -->

                                                            <div class="Review_box">
                                                                <h2>All Review</h2>
                                                                <?php
                                                                $r = new _sppostreview;
                                                                $result = $r->review_profile($_GET["postid"]);
                                                                //echo $r->ta->sql;
                                                                if($result != false){
                                                                    while($rows = mysqli_fetch_assoc($result)){
                                                                        ?>
                                                                        <div class="row mainreview no-margin">
                                                                            <div class="col-md-1 no-padding-left">
                                                                                <?php
                                                                                if(isset($rows['spProfilePic'])){
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src=' ".($rows['spProfilePic'])."' >" ;
                                                                                }else{
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src='../img/no.png' >" ;
                                                                                }
                                                                            
                                                                                ?>
                                                                                
                                                                            </div>
                                                                            <div class="col-md-11 no-padding">
                                                                                <h3><?php echo $rows['spProfileName']?></h3>
                                                                                <p><?php echo $rows['spPostReviewText']?></p>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>


                                                        </div>
                                                        <div class="tab-pane fade" id="tab4default">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#SR</th>
                                                                            <th>Bid Person Name</th>
                                                                            <th>Bid Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $po = new _postfield;
                                                                        $result_bid = $po->allauctionbid($_GET['postid']);
                                                                        //echo $po->ta->sql;
                                                                        $i = 1;
                                                                        if($result_bid != false){
                                                                            while($row_bid = mysqli_fetch_assoc($result_bid)){ 
                                                                                $p = new _spprofiles;
                                                                                $NameOfProfile = $p->getProfileName($row_bid['spProfiles_idspProfiles']);
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo $i;?></td>
                                                                                    <td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row_bid['spProfiles_idspProfiles'];?>"><?php echo $NameOfProfile;?></a></td>
                                                                                    <td>$<?php echo $row_bid['spPostFieldValue'];?></td>
                                                                                </tr> <?php
                                                                                $i++;
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
                                        </div>
                                    </div>
                                </div>

                                <?php include('product-seller.php');?>


                            </div>
                            <div id="sidebar_right" class="col-md-3 no_pad_left_right">
                                <?php include('../component/seller-info-tips.php');?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>


        <?php include('postshare.php');?>
        <!--modal for Enquery-->
        <div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="enquireModalLabel" ><b>Send a Message</b></h3>
                    </div>
                    <form action="../enquiry/addenquire.php" method="post">
                        <div class="modal-body">
                            <?php
                                $e = new _postenquiry;
                                $re = $e->read($_GET["postid"]);
                                //echo $e->ta->sql;
                                if ($re != false){
                                    while($rw = mysqli_fetch_assoc($re)){
                                        $con = new _conversation;
                                        $result = $con->readconversation($rw["idspMessage"]);
                                        if ($result != false){
                                            while($row = mysqli_fetch_assoc($result)){
                                                
                                            }
                                        }
                                    }
                                }
                                $p = new _postings;
                                $res = $p->read($_GET['postid']);
                                //echo $p->ta->sql;
                                if($res != false){
                                    while ($row2 = mysqli_fetch_assoc($res)) {
                                        $spProfile = $row2['spProfiles_idspProfiles'];
                                    }
                                }

                            ?>
                            <input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid']?>"/>
                            <input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php  echo $spProfile;?>"/>
                            
                            <input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
                            
                            <div class="form-group">
                              <label for="message-text" class="form-control-label contact">Message</label>
                              <textarea class="form-control" id="message-text" name="message" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary postenquiry">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--complete-->
        <!--Auction bid system-->
        <div class="modal fade" id="bid-auction" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="bidModalLabel">Bid on Auction <span id="projecttitle" style="color:#1a936f;"></span></h4>
                    </div>
                    <form>
                        <div class="modal-body">
                        
                            <label for="AuctionPrice">Your bid for this post</label>
                            <div class="input-group" style="width:6cm;">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" class="form-control activity" id="AuctionPrice" name="AuctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin:0px;" />
                            </div>
                            <!--Hidden attribute-->
                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
                            <input type="hidden" id="spPostFieldBidFlag" value="1" >
                            <input type="hidden" class="auctioncat" value="1" />
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            <!--Complete-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary placebidAuction">Place Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        
        
    </body>
</html>
