<?php
    include('../univ/baseurl.php');
    session_start();

    //print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
    
}else{


    if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] == 1){

    }else if(isset($_GET["postid"]) && $_GET["postid"] >0){
			
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
        <?php include('../component/f_links.php');?>
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <!--THIS IS ZOOM PLUGIN FOR IMAGE DETAIL PAGES END -->
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>

       <!--THIS IS ZOOM PLUGIN FOR IMAGE DETAIL PAGES START -->
        <link href="<?php echo $BaseUrl; ?>/assets/zoom/jquerysctipttop.css" rel="stylesheet" type="text/css">
         <script src="<?php echo $BaseUrl; ?>/assets/zoom/lib/blowup.js"></script>
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
                    $('#myCarousestore').carousel(id);
                });
                // When the carousel slides, auto update the text
                $('#myCarousestore').on('slid.bs.carousel', function (e) {
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
            /*echo get_include_path();
            echo"here";*/
            $p = new _productposting;
            $rd = $p->read($_GET["postid"]);
            //echo $p->ta->sql;
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);
                
                /*echo "<pre>";
                print_r($row);*/
                
              $auctionStatus = $row['auctionStatus'];
                 $selltype = $row['sellType'];
  
                if($selltype == "Auction"){
                   
                   $Quantity = $row['auctionQuantity'];
                
                }elseif($selltype == "Retail"){

                	 $Quantity = $row['retailQuantity'];
                }elseif($selltype == "Wholesaler"){

                	 $Quantity = $row['supplyability'];
                }

                 if($selltype == "Auction"){
                   
                   $ItemCondition = $row['auctionStatus'];
                
                }elseif($selltype == "Retail"){

                	 $ItemCondition = $row['retailStatus'];
                }/*elseif($selltype == "Wholesaler"){

                	 $ItemCondition = $row['supplyability'];
                }*/
                

                $price = $row['spPostingPrice'];

                if($selltype == "Auction"){
                   
                   $ExpiryDate = $row['spPostingExpDt'];
                
                }elseif($selltype == "Retail"){

                   $ExpiryDate = $row['spPostingExpDt'];
                }


              
               $minorderqty = $row['minorderqty'];
               $supplyability = $row['supplyability'];
               $paymentterm = $row['paymentterm'];
               $category     = $row['subcategory'];

              
               // $ItemCondition
                
                /*$auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];*/

                /*spPostingTitle*/

                $myuserid   = $row['spUser_idspUser'];

                $postingexpire = $row['spPostingExpDt'];
                $PostTitle  = $row['spPostingTitle'];
                $price      = $row['spPostingPrice']; 
                $catid      = $row["idspCategory"];
                $wholesaleflag = $row["spPostingsFlag"];
                $button     = $row["spCategoriesButton"];
                $comment    = $row["sppostingscommentstatus"];
                $Country    = $row['spPostingsCountry'];
                $City       = $row['spPostingsCity'];
                $dt         = new DateTime($row['spPostingDate']);
                $desc       = $row['spPostingNotes'];
                $specification       = $row['specification'];
                
                $SellName   = $row['spProfileName'];
                $SellEmail  = $row['spProfileEmail'];
                $SellPhone  = $row['spProfilePhone'];
                $SellAdres  = $row['spprofilesAddress'];
                $SellCity   = $row['spProfilesCity'];
                $SellCounty = $row['spProfilesCountry'];
                $SellId     = $row['idspProfiles'];
                /*$p = new _postingview;
                $result4 = $p->publicpost_count($SellId);
                //echo $p->ta->sql;
                if($result4 != false){
                    $SelProduct = mysqli_num_rows($result4);
                }else{
                    $SelProduct = 0;
                }*/
            }
            
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">

                    <div class="col-md-1"></div>
                  
                    <div class="col-md-10">
                        <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading" style="border-radius: 40px;
    padding-left: 14px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Preview Your <?php echo $selltype; ?> Product</h3>
                                    <input type="hidden" id="selltype" name="" value="<?php echo $selltype; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="pro_detail_box" style="margin-top: 10px;border-radius: 15px;">
                                <div class="row no-margin">
                                    <div class="col-md-5 no-padding" >
                                    <h2><?php echo ucwords($PostTitle); ?></h2>
                                    </div>
                                    <div class="col-md-7 previewdeatilproduct" >
                                        <table style="display: contents;">
                                            <tbody style="float: right;">
                                                       <tr>
                                                            <td style="font-size: 12px;"><!-- <strong style="font-size: larger;"> -->Product :  <!-- </strong> --></td>
                                                            <td style="font-size: 12px;"> AEF-<?php echo $_GET['postid'];?></td>
                                                        </tr>
                                             </tbody>
                                        </table>
                                    </div>
                                </div>
                                    <div class="row no-margin">
                                        <div class="col-md-6 no-padding">
                                            
                                            <div class="product_slider_box social bradius-20">
                                                <div id="carousel-bounding-box" style="width: 72%!important;
                                                        padding-left: 114px!important;">
                                                    <div class="carousel slide" id="myCarousestore">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner productslider">
                                                            <?php
                                                            $pc = new _productpic;
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
                                                                    <div class="<?php echo ($active1 == 0)?'active':'';?> item" data-slide-number="<?php echo $active1?>" style="height: auto!important;">
                                                                        <?php
                                                                        if(isset($picture)){ ?>
                                                                            <img class="img_zoom_<?php echo $active1; ?>_t img-responsive" src="<?php echo ($picture); ?>" alt="Posting Pic" style="border: 0px;"  > 

                                                                <?php }else{ ?>
                                                                            
                                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="border: 0px;" > <?php
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
                                                        $pc = new _productpic;
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
                                                                            <img src="<?php echo ($picture); ?>" alt="Posting Pic"  style="height: 56px;" class="img-responsive" > <?php
                                                                        }else{ ?>
                                                                            <img src="../img/no.png" alt="Posting Pic" style="height: 56px;" class="img-responsive" > <?php
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
                                                    <li><a href="#" id="enquire" data-toggle="modal" data-target="#enqueryModal"><i class="fa fa-comments"></i> Enquiry</a></li>
                                                    <?php
                                                    $fv = new _favorites;
                                                    $res_fv = $fv->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                                    //echo $fv->ta->sql;
                                                    if($res_fv != false){
                                                        echo '<li class="showfav"><a href="javascript:void(0)" data-postid="'. $_GET["postid"].'" class="remtofavorites1"><i class="fa fa-heart"></i> Unfavourite</a></li>';
                                                    }else{
                                                        echo '<li class="showfav"><a href="javascript:void(0)" data-postid="'. $_GET["postid"].'" class="addtofavourite1"><i class="fa fa-heart-o"></i> Favourite</a></li>';
                                                    }
                                                    $pc = new _productpic;
                                                    $resp = $pc->read($_GET["postid"]);
                                                    //echo $pc->ta->sql;
                                                    if ($resp != false) {
                                                        $postrp = mysqli_fetch_assoc($resp);
                                                        $pictp = $postrp['spPostingPic']; 
                                                    }  ?>
                                                    <li><a href="#" data-toggle='modal' data-target='#myshare1'><span class='sp-share' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pictp); ?>'><i class="fa fa-share-alt"></i> Share</span></a></li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_detail_right1">
                                                <table class="table table-striped table-hovered">
                                                    <tbody>
                                                       <!--  <tr>
                                                            <td><strong>Product Code</strong></td>
                                                            <td>AEF-<?php echo $_GET['postid'];?></td>

                                                        </tr> -->
                                                       <!--  <tr>
                                                            <td><strong>Last Updated Date</strong></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                        </tr> -->
                                                            

                                                        
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
                                                       /* print_r($_GET['postid']);*/
                                                        //check product is auction or not
                                                      

                                                        


                                                        if($selltype == "Auction"){
                                                           /* $result_fel = $po->field($_GET['postid']);*/
                                                            //echo $po->ta->sql;
                                                          //  $ItemCondition = '';
                                                           // $ExpiryDate = '';

                                                        /*    if($result_fel != false){
                                                                while ($row_fel = mysqli_fetch_assoc($result_fel)) {
                                                                  
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
                                                            }*/

                                                            $bid = new _postfield;
                                                            $result_bid = $bid->allauctionbid($_GET['postid']);
                                                            
                                                            // SHOW LATEST BID 
                                                            $result_au  = $bid->get_heigh_auction_price($_GET['postid']);
                                                           
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
                                                            	
                                                            	<input type="hidden" id="auctionexp" name="" value="<?php echo $postingexpire;?>">
                                                              
                                                           <!--  <p><strong>Expired Date</strong> :<span id="auction_enddate"> </span></p> -->

                                                             <p><strong>Expired Date</strong>: <?php echo $postingexpire;?> </p>
                                                               
                                                            <p><strong>Total Bids</strong>: <?php echo $totalBid; ?></p>
                                                            <p><strong>Current Bid</strong>: $<?php echo $HeighestBid;?></p>

                                                                  <?php  
                                                                   
                                                                  
                                                                   if($category == "Shoes"){

                                                                        $s = new _spproductsize;

                                                                        $allsize= $s->read($_GET["postid"]);
                                                                        $size = mysqli_fetch_assoc($allsize);
                                                                          
                                                                         /* print_r($size);*/

                                                                    ?>
 <p><strong style="color: #333333;">Size</strong> : 
                                                                   
                                                             <select>
                                                          <option>Select</option>
                                                           <option  style="<?php if($size['shoesize1'] <= 0){ echo "display: none;";   }  ?>">1</option>
                                                            <option  style="<?php if($size['shoesize2'] <= 0){ echo "display: none;";   }  ?>">2</option>
                                                            <option  style="<?php if($size['shoesize3'] <= 0){ echo "display: none;";   }  ?>">3</option>
                                                            <option  style="<?php if($size['shoesize4'] <= 0){ echo "display: none;";   }  ?>">4</option>
                                                            <option  style="<?php if($size['shoesize5'] <= 0){ echo "display: none;";   }  ?>">5</option>
                                                            <option  style="<?php if($size['shoesize6'] <= 0){ echo "display: none;";   }  ?>">6</option>
                                                            <option  style="<?php if($size['shoesize7'] <= 0){ echo "display: none;";   }  ?>">7</option>
                                                            <option  style="<?php if($size['shoesize8'] <= 0){ echo "display: none;";   }  ?>">8</option>
                                                            <option  style="<?php if($size['shoesize9'] <= 0){ echo "display: none;";   }  ?>">9</option>
                                                            <option  style="<?php if($size['shoesize10'] <= 0){ echo "display: none;";   }  ?>">10</option>
                                                            <option  style="<?php if($size['shoesize11'] <= 0){ echo "display: none;";   }  ?>">11</option>
                                                            <option  style="<?php if($size['shoesize12'] <= 0){ echo "display: none;";   }  ?>">12</option>
                                                            <option  style="<?php if($size['shoesize13'] <= 0){ echo "display: none;";   }  ?>">13</option>
                                                            <option  style="<?php if($size['shoesize14'] <= 0){ echo "display: none;";   }  ?>">14</option>
                                                          



                                                        </select>

    </p>


                                                                  <?php 

                                                                    }


                                                                    if($category == "Clothing"){

                                                                       $cs = new _spproductsize;

                                                                        $csize= $cs->read($_GET["postid"]);
                                                                        $clothsize = mysqli_fetch_assoc($csize);

                                                                  ?>



                                                      <p><strong style="color: #333333;">Size</strong> : 
                                                                   
                                                        <select>
                                                          <option>Select</option>
                                                           <option  style="<?php if($clothsize['sizeXS'] <= 0){ echo "display: none;";   }  ?>">XS</option>
                                                            <option  style="<?php if($clothsize['sizeS'] <= 0){ echo "display: none;";   }  ?>">S</option>
                                                            <option  style="<?php if($clothsize['sizeM'] <= 0){ echo "display: none;";   }  ?>">M</option>
                                                            <option  style="<?php if($clothsize['sizeL'] <= 0){ echo "display: none;";   }  ?>">L</option>
                                                            <option  style="<?php if($clothsize['sizeXL'] <= 0){ echo "display: none;";   }  ?>">XL</option>
                                                            <option  style="<?php if($clothsize['sizeXXL'] <= 0){ echo "display: none;";   }  ?>">XXL</option>
                                                            <option  style="<?php if($clothsize['sizeXXXL'] <= 0){ echo "display: none;";   }  ?>">XXXL</option>
                                                           
                                                          



                                                        </select>

                                                      </p>






                                                                  <?php 

                                                                   }


                                                                  ?>


                                                          <!--   <p><strong>Last Updated Date : </strong>
                                                            <?php echo $dt->format('d M Y'); ?></p> -->


                                                            </div>
                                                            <?php
                                                        }else{ 
                                                          /*  if ($price != false) {
                                                                $pr = new _postfield;
                                                                $re = $pr->readprice($_GET["postid"]);
                                                                if ($re != false) {
                                                                    
                                                                    $fprice = "$ ".$price."/hour"; 
                                                                    
                                                                } else {
                                                                    if ($catid == 9) {
                                                                        $ticketprice = $price;
                                                                        $fprice = "Ticket Price $". $price; 
                                                                        
                                                                    } else{
                                                                        $fprice = '$'.$price; 
                                                                    }
                                                                }
                                                            } */
                                                            //if($button == "Buy" && $catid != 3 )
                                                            if ($catid == 1 || $catid == 9 || $catid == 15 || $selltype =="Retail" ){
                                                                //echo $available;
                                                                ?>
                                                                <!-- <div class="row  no-margin qtyBox">
                                                                    <p><span class="qty_box">Quantity available: <input type="text" name="" value="<?php echo $available;?>" class="qtyavb" readonly /></span></p>
                                                                    <p>
                                                                        <span class="qty_box">Quantity: <input type="text" class="liveQty" id="liveQty" name="spOrderQty" value="1"  style="width: 50px;" maxlength="5" /></span>
                                                                        
                                                                    </p>

                                                                    
                                                                </div> -->
                                                                <tr>
                                                                    <td><strong>Price</strong></td>
                                                                    <td><?php echo "$". $price; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Quantity Available</strong></td>
                                                                    <td><?php echo $Quantity;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Quantity</strong></td>
                                                                    <td><input type="number" class="liveQty" id="liveQty" name="spOrderQty" value="<?php echo $Quantity; ?>" min="0" min="5" onkeyup="this.value = minmax(this.value, 0, <?php echo $Quantity;?>)" style="width: 50px;" maxlength="5" /></td>
                                                                </tr>

                                                                   <?php  
                                                                   
                                                                  
                                                                   if($category == "Shoes"){

                                                                        $s = new _spproductsize;

                                                                        $allsize= $s->read($_GET["postid"]);
                                                                        $size = mysqli_fetch_assoc($allsize);
                                                                          
                                                                         /* print_r($size);*/

                                                                    ?>
                                                                    <tr>
                                                                      <td><strong>Size</strong> :</td>
<td>
                                                                   
                                                             <select>
                                                          <option>Select</option>
                                                           <option  style="<?php if($size['shoesize1'] <= 0){ echo "display: none;";   }  ?>">1</option>
                                                            <option  style="<?php if($size['shoesize2'] <= 0){ echo "display: none;";   }  ?>">2</option>
                                                            <option  style="<?php if($size['shoesize3'] <= 0){ echo "display: none;";   }  ?>">3</option>
                                                            <option  style="<?php if($size['shoesize4'] <= 0){ echo "display: none;";   }  ?>">4</option>
                                                            <option  style="<?php if($size['shoesize5'] <= 0){ echo "display: none;";   }  ?>">5</option>
                                                            <option  style="<?php if($size['shoesize6'] <= 0){ echo "display: none;";   }  ?>">6</option>
                                                            <option  style="<?php if($size['shoesize7'] <= 0){ echo "display: none;";   }  ?>">7</option>
                                                            <option  style="<?php if($size['shoesize8'] <= 0){ echo "display: none;";   }  ?>">8</option>
                                                            <option  style="<?php if($size['shoesize9'] <= 0){ echo "display: none;";   }  ?>">9</option>
                                                            <option  style="<?php if($size['shoesize10'] <= 0){ echo "display: none;";   }  ?>">10</option>
                                                            <option  style="<?php if($size['shoesize11'] <= 0){ echo "display: none;";   }  ?>">11</option>
                                                            <option  style="<?php if($size['shoesize12'] <= 0){ echo "display: none;";   }  ?>">12</option>
                                                            <option  style="<?php if($size['shoesize13'] <= 0){ echo "display: none;";   }  ?>">13</option>
                                                            <option  style="<?php if($size['shoesize14'] <= 0){ echo "display: none;";   }  ?>">14</option>
                                                          



                                                        </select>

    </td>
  </tr>


                                                                  <?php 

                                                                    }


                                                                    if($category == "Clothing"){

                                                                       $cs = new _spproductsize;

                                                                        $csize= $cs->read($_GET["postid"]);
                                                                        $clothsize = mysqli_fetch_assoc($csize);

                                                                  ?>


  <tr>
                                                                      <td><strong>Size</strong> :</td>
                                                      <td>
                                                                   
                                                        <select>
                                                          <option>Select</option>
                                                           <option  style="<?php if($clothsize['sizeXS'] <= 0){ echo "display: none;";   }  ?>">XS</option>
                                                            <option  style="<?php if($clothsize['sizeS'] <= 0){ echo "display: none;";   }  ?>">S</option>
                                                            <option  style="<?php if($clothsize['sizeM'] <= 0){ echo "display: none;";   }  ?>">M</option>
                                                            <option  style="<?php if($clothsize['sizeL'] <= 0){ echo "display: none;";   }  ?>">L</option>
                                                            <option  style="<?php if($clothsize['sizeXL'] <= 0){ echo "display: none;";   }  ?>">XL</option>
                                                            <option  style="<?php if($clothsize['sizeXXL'] <= 0){ echo "display: none;";   }  ?>">XXL</option>
                                                            <option  style="<?php if($clothsize['sizeXXXL'] <= 0){ echo "display: none;";   }  ?>">XXXL</option>
                                                           
                                                          



                                                        </select>

                                                      </td>
</tr>





                                                                  <?php 

                                                                   }


                                                                  ?>


                                                                  <tr>
                                                           <!--  <td><strong>Last Updated Date</strong></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td> -->
                                                           </tr>
                                                                <?php
                                                            }elseif($selltype == "Wholesaler"){
                                                                ?>

                                                                <tr>
                                                                    <td><strong>FOB Price</strong></td>
                                                                    <td><?php echo "$". $price . " / Pieces"; ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><strong>Min Order</strong></td>
                                                                    <td><?php echo $minorderqty ." Piece/Pieces";?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><strong>Supply Ability</strong></td>
                                                                    <td><?php echo $supplyability;?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><strong>Payment Terms</strong></td>
                                                                    <td><?php echo $paymentterm;?></td>
                                                                </tr>
       <?php  
                                                                   
                                                                  
                                                                   if($category == "Shoes"){

                                                                        $s = new _spproductsize;

                                                                        $allsize= $s->read($_GET["postid"]);
                                                                        $size = mysqli_fetch_assoc($allsize);
                                                                          
                                                                         /* print_r($size);*/

                                                                    ?>
                                                                    <tr>
                                                                      <td><strong>Size</strong> </td>
<td>
                                                                   
                                                             <select>
                                                          <option>Select</option>
                                                           <option  style="<?php if($size['shoesize1'] <= 0){ echo "display: none;";   }  ?>">1</option>
                                                            <option  style="<?php if($size['shoesize2'] <= 0){ echo "display: none;";   }  ?>">2</option>
                                                            <option  style="<?php if($size['shoesize3'] <= 0){ echo "display: none;";   }  ?>">3</option>
                                                            <option  style="<?php if($size['shoesize4'] <= 0){ echo "display: none;";   }  ?>">4</option>
                                                            <option  style="<?php if($size['shoesize5'] <= 0){ echo "display: none;";   }  ?>">5</option>
                                                            <option  style="<?php if($size['shoesize6'] <= 0){ echo "display: none;";   }  ?>">6</option>
                                                            <option  style="<?php if($size['shoesize7'] <= 0){ echo "display: none;";   }  ?>">7</option>
                                                            <option  style="<?php if($size['shoesize8'] <= 0){ echo "display: none;";   }  ?>">8</option>
                                                            <option  style="<?php if($size['shoesize9'] <= 0){ echo "display: none;";   }  ?>">9</option>
                                                            <option  style="<?php if($size['shoesize10'] <= 0){ echo "display: none;";   }  ?>">10</option>
                                                            <option  style="<?php if($size['shoesize11'] <= 0){ echo "display: none;";   }  ?>">11</option>
                                                            <option  style="<?php if($size['shoesize12'] <= 0){ echo "display: none;";   }  ?>">12</option>
                                                            <option  style="<?php if($size['shoesize13'] <= 0){ echo "display: none;";   }  ?>">13</option>
                                                            <option  style="<?php if($size['shoesize14'] <= 0){ echo "display: none;";   }  ?>">14</option>
                                                          



                                                        </select>

    </td>
  </tr>


                                                                  <?php 

                                                                    }


                                                                    if($category == "Clothing"){

                                                                       $cs = new _spproductsize;

                                                                        $csize= $cs->read($_GET["postid"]);
                                                                        $clothsize = mysqli_fetch_assoc($csize);

                                                                  ?>


                                                     <tr>
                                                        <td><strong>Size</strong> </td>
                                                           <td>
                                                                   
                                                          <select>
                                                            <option>Select</option>
                                                             <option  style="<?php if($clothsize['sizeXS'] <= 0){ echo "display: none;";   }  ?>">XS</option>
                                                              <option  style="<?php if($clothsize['sizeS'] <= 0){ echo "display: none;";   }  ?>">S</option>
                                                              <option  style="<?php if($clothsize['sizeM'] <= 0){ echo "display: none;";   }  ?>">M</option>
                                                              <option  style="<?php if($clothsize['sizeL'] <= 0){ echo "display: none;";   }  ?>">L</option>
                                                              <option  style="<?php if($clothsize['sizeXL'] <= 0){ echo "display: none;";   }  ?>">XL</option>
                                                              <option  style="<?php if($clothsize['sizeXXL'] <= 0){ echo "display: none;";   }  ?>">XXL</option>
                                                              <option  style="<?php if($clothsize['sizeXXXL'] <= 0){ echo "display: none;";   }  ?>">XXXL</option>
                                                             
                                                            



                                                          </select>

                                                      </td>
                                                    </tr>





                                                                  <?php 

                                                                   }


                                                                  ?>




                                                              <?php
                                                            }

                                                        }
                                                        ?>
                                                
                                                    </tbody>
                                                </table>
                                                <div class="btn_box ">
                                                    <form action="<?php echo ($available == 0 ?" ":"../cart/addorder.php");?>" method="post">
                                                        <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
                                                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
                                                        <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
                                                        <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $row['idspProfiles'];?>"/>
                                                        <input type="hidden" id="spOrdrQty" name="spOrderQty" value="1" >
                                                        
                                                        <?php
                                                            if($catid == 18){
                                                                echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#quotation' disabled='disabled'><span class='fa fa-quote-left' aria-hidden='true' ></span> Send Quotation</button>";
                                                            
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
                                                                    echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#coverletter' id='applybtn' disabled>Apply Job</button>";
                                                                
                                                                include("coverletter.php");
                                                            
                                                            }else if($catid == 5){
                                                                
                                                                echo "<button type='button' class='btn btn-success btn-sm pull-right' data-toggle='modal' data-categoryid='".$catid."' data-postid='".$_GET["postid"]."' data-target='#bid-system' data-profileid='".$_SESSION['pid']."' disabled><span class='fa fa-hand-paper-o'> </span> Bid</button>";
                                                            
                                                            }else if($catid != 18 && $catid != 2 && $catid != 5 && $catid != 7 && $catid != 12) {
                                                                
                                                                if( $catid == 9){
                                                                    if($ticketprice > 0){
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);
                                                                        if ($res != false)
                                                                        {
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' disabled><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
                                                                        }
                                                                        else
                                                                            echo "<button type='submit' class='btn btn-primary btn-sm pull-right ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' disabled><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
                                                                    }else{
                                                                        
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkevent($_GET["postid"] , $buyerid);
                                                                        if ($res != false){
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' disabled>Joined</button>";
                                                                        }else{
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right joinevent' data-profileid='".$_SESSION["pid"]."'  data-postid='".$_GET["postid"]."' data-seller='".$row['idspProfiles']."' disabled>Join</button>";
                                                                        }
                                                                    }
                                                                    
                                                                }else{

                                                                    //echo"here";
                                                                   /* $po = new _postfield;
                                                                    $result_po = $po->checkAuction($_GET['postid']);*/
                                                                    if($selltype == "Auction"){

                                                                    	echo' <div class="" style="padding-bottom: 10px;display: flex;">';

                                                                    	echo' <input type="number" class="form-control activity" id="AuctionPrice" name="AuctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin:0px;" readonly/>';

                                                                        //selltype
                                                                            echo "&nbsp;&nbsp;<button type='button' class='btn btn_cart btn_buy_now' data-toggle='modal' data-target='#bid-auction' disabled>Post Bid</button>";

                                                                           echo'</div>'; 

                                                                           echo'<span for="AuctionPrice">Your bid must be greater than $'.$HeighestBid.'</span>';
                                                                           ?>

                                                                            <div id="invalidBid"></div>
                            <!--Hidden attribute-->
                            <input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
                            <input type="hidden" id="spPostFieldBidFlag" value="1" >
                            <input type="hidden" class="auctioncat" value="1" />
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 

                                                                           

                                                                           <?php
                                                                      
                                                                        
                                                                    }else{

                                                                        echo "<button type='submit' class='btn btn_cart_buy btn_buy_now ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='' disabled style='background-color:#ff901d!important;'>Buy Now</button>";
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);
                                                                        if ($res != false){
                                                                            echo "<button type='button' class='btn btn_cart disabled btn_add_to_cart' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' disabled>Added to cart</button>";
                                                                        }else{
                                                                            echo "<button type='submit' class='btn btn_cart btn_add_to_cart ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' disabled>Add to cart</button>";
                                                                        }
                                                                         
                                                                         if($selltype == "Wholesaler"){

                                                                         	echo'<div class="space"></div>
                                                                            <a href="javascript:void(0)" class="btn butn_draf db_btn db_orangebtn" data-toggle="modal" data-target="#quotation" disabled>Request For Quote</a>';
                                                                         
                                                                         }
                                                                      

                                                                        echo"<br><br>";
                                                                    }
                                                                    
                                                                }
                                                            }

                                                        ?>

                                                    </form>

                                                    <!--   <button type='button' id="btnpublishpre" class='btn btn_cart btn_add_to_cart btnpublishpre ' style="width: 25%!important; float: right;" >Publish</button>

                                                      <button type='button' id="delpreviewdraft" data-postid="<?php echo $_GET["postid"];?>" class='btn btn_cart btn_add_to_cart btnpublishpre delpreviewdraft' style="width: 33%!important; float: right;" >Remove Draft</button>

                                                  
                                                    <a href="<?php echo $BaseUrl;?>/post-ad/sell/?postid=<?php echo $_GET["postid"];?>" title="" id="btnpublishpre" class='btn btn_cart btn_add_to_cart btnpublishpre' style="width: 24%!important; float: right;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 100%)!important;margin-right: 5px;">Edit</a> -->
                                                   
                                                    <!-- <button type='button' id="btnpublishpre" class='btn btn_cart btn_add_to_cart btnpublishpre' style="width: 22%!important; float: right;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 100%)!important;">Edit</button> -->

                                                </div>

                                            </div>
                                            
                                        </div>

                                        <!-- <?php echo "here"; ?> -->
                                        
                                    </div>
                                    <div class="space"></div>
                                   <div class="row">
                                        <div class="col-md-6" >
                                            
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
                                                            <p style="word-break: break-word;"><?php echo $desc;?></p>
                                                            <p><strong>Item Condition</strong> : <?php echo $ItemCondition;?></p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab2default">
                                                            <p><?php echo $specification;?></p>
                                                            
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
                                                                }else{
                                                                    echo "<h5 class='text-center'>No Records Found</h5>";
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
                                                                        }else{
                                                                             echo "<tr>
                                                                                    <td colspan=3><h5 class='text-center'>No Records Found!</h5></td>
                                                                                </tr>";
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

                                         <div class="col-md-6" style="padding-top: 81px;padding-right: 21px;">

                                            <button type='button' id="btnpublishpre" class='btn  btn_add_to_cart btnpublishpre ' style="width: 25%!important; float: right;background-color: blue!important;margin-right: 5px;" >Publish</button>

                                            
  
                                            <a href="<?php echo $BaseUrl;?>/post-ad/sell/?postid=<?php echo $_GET["postid"];?>" title="" id="btnpublishpre" class='btn btn_add_to_cart btnpublishpre' style="width: 24%!important; float:right;margin-right: 5px;background-color: #d39c00!important; ">Edit</a>

                                            <button type='button' id="delpreviewdraft" data-postid="<?php echo $_GET["postid"];?>" class='btn btn_add_to_cart btnpublishpre delpreviewdraft' style="width: 25%!important; float: right;margin-right: 5px;background-color: red!important;" >Cancel</button>
                                                   
                                          </div>


                                    </div> 
                                </div>

                         


                            </div>

                           <!--  <div class="col-md-3 pro_detail_box">

                                <?php echo "Here"; ?>

                            </div>  -->
                          
                        </div>



                    </div>

                     <div class="col-md-1"></div>
                </div>
            </div>
        </section>


       <?php include('postshare.php');?>
        <!--modal for Enquery-->
        <div class="modal fade" id="enqueryModalq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos bradius-15" >
                    <div class="modal-header bg-white br_radius_top">
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

                        <div class="modal-footer bg-white br_radius_bottom">
                          <button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-submit postenquiry db_btn db_primarybtn">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--complete-->
        <!--Auction bid system-->
        <div class="modal fade" id="bid-auctionq" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos bradius-15">
                    <div class="modal-header bg-white br_radius_top">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="bidModalLabel">Bid on Auction <span id="projecttitle" style="color:#1a936f;"></span></h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            
                            <label for="AuctionPrice">Your bid must be greater than $<?php echo $HeighestBid; ?></label>
                            <div class="input-group" style="width:6cm;margin-bottom: 10px;">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" class="form-control activity" id="AuctionPrice" name="AuctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin:0px;" />
                            </div>
                            <div id="invalidBid"></div>
                            <!--Hidden attribute-->
                            <input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
                            <input type="hidden" id="spPostFieldBidFlag" value="1" >
                            <input type="hidden" class="auctioncat" value="1" />
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            <!--Complete-->

                        </div>
                        <div class="modal-footer bg-white br_radius_bottom">
                            <button type="button" class="btn btn-secondary db_btn db_orangebtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary placebidAuction db_btn db_primarybtn">Place Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        
        
    </body>
</html>
<?php
} ?>
<script type="text/javascript">



   $(document).ready(function() {
       
        var auction_exp = $("#auctionexp").val();

        var selltype = $("#selltype").val();

        //alert();
if(selltype == "Auction"){

  var countDownDate = new Date(auction_exp).getTime();

// Update the count down every 1 second
  var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("auction_enddate").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);


}
//alert(auction_exp);



        });





 var number = document.getElementById('liveQty');

// Listen for input event on numInput.
/*number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}    */
function minmax(value, min, max) 
{
   /* if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; */
    if(parseInt(value) > max) 
        return max; 
    else return value;
}

$("#btnpublishpre").click(function(){
	//alert('h11');

        /* var selltype = $("#sellType_").val();
         var spPostingTitle = $("#spPostingTitle").val();
         var auctionQuantity_ = $("#auctionQuantity_").val();
         var auctionStatus_ = $("#auctionStatus_").val();
         var auctionPrice = $("#auctionPrice").val();
         var spPostingNotes = $("#spPostingNotes").val();*/

         var postid = "<?php echo $_GET["postid"]; ?>"
          var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";


/*alert(postid);*/
            $.ajax({
                        url: "prevpublish.php",
                        type: "POST",
                        data: 'postid='+postid ,
                      
                        success: function(vi){
                          
                             
                             window.location.href = MAINURL+"/post-ad/sell/posting.php?postid="+postid.trim();
                          /*    swal({
                                    title: "Publish Successfully!",
                                    imageUrl: logo,
                                    confirmButtonClass: "sweet_ok",
                                    confirmButtonText: "Ok",
                                },
                                function(){
                                   //window.location.reload();
                                   //window.location.href = MAINURL+"/post-ad/sell/posting.php?postid="+postid.trim();
                                });
                           */
                        //window.location.reload();
                        },
                        error: function(error){
                            
                        }          
                    });




         
});







</script>