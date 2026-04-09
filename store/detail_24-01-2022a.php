<?php
    include('../univ/baseurl.php');
    session_start();
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


          /*  $v = new _productposting;
            $rv = $v->read($_GET["postid"]);
            //echo $p->ta->sql;
            if ($rd != false) {
                
                $row = mysqli_fetch_assoc($rd);
                print_r($row);

            }*/
    $pr = new _spprofiles;
    $result  = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $profileType = $sprows["spProfileType_idspProfileType"];
        // 2 and 5 are employment and freelance types
    }

?>
<!DOCTYPE html>
<html lang="en-US">
    <head>

         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <?php include('../component/f_links.php');?>
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

        <!--THIS IS ZOOM PLUGIN FOR IMAGE DETAIL PAGES START -->
        <!---<link href="<?php echo $BaseUrl; ?>/assets/zoom/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $BaseUrl; ?>/assets/zoom/lib/blowup.js"></script>--->

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

      

<!-- New Magnify css like amazone by Nitin Tiwari -->

<!-- <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/cloud_magnify/js/jquery.js"></script>
<link href="<?php echo $BaseUrl; ?>/assets/cloud_magnify/css/cloud-zoom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/cloud_magnify/js/cloud-zoom.1.0.2.min.js"></script> -->
        
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


<style type="text/css">
  

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  /*padding-bottom: 10px;*/
}

 .rating-box:before{
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
  }

  .ratings {
    position: absolute!important;
    left:0;
    top:0;
    white-space:nowrap!important;
    overflow:hidden!important;
    color: Gold!important;
   
  }
.ratings:before {
      content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }

.flag:hover{
    color:#428bca!important;
}



/*review hover*/

/*.a-fixed-left-grid {
    position: relative;
}

.a-popover-inner {
    background-color: #fff;
    padding: 14px 18px;
    text-align: left;
    overflow-x: hidden;
}

.a-popover {
    display: inline-block;
    position: absolute;
    visibility: hidden;
    top: 0;
    left: 0;
    z-index: 1010;
    padding: 8px;
    max-width: 440px;
}

.a-fixed-left-grid-inner, .a-fixed-right-grid-inner {
    position: relative;
    padding: 0;
}

.a-fixed-left-grid-col, .a-fixed-right-grid-col {
    position: relative;
    overflow: visible;
    zoom: 1;
    min-height: 1px;
}

.a-padding-none {
    padding: 0!important;
}

.a-spacing-small, .a-ws .a-ws-spacing-small {
    margin-bottom: 10px!important;
}

.a-icon-row {
    padding-top: 1px;
    padding-bottom: 1px;
}

.a-icon-row {
    display: block;
    line-height: 0;
}
.a-star-4 {
    background-position: -21px -368px;
}

.a-icon-star {
    width: 80px;
    height: 18px;
}


.a-icon-star, .a-icon-star-medium, .a-icon-star-mini, .a-icon-star-small {
    position: relative;
    vertical-align: text-top;
}

.a-icon, .a-link-emphasis:after {
    background-image: url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIIcon-sprite_1x-003a053…._V2_.png);
    -webkit-background-size: 400px 900px;
    background-size: 400px 900px;
    background-repeat: no-repeat;
    display: inline-block;
    vertical-align: top;
}

[class*=a-icon-star]>.a-icon-alt {
    clip-path: circle(0);
    left: auto;
    width: 100%;
    height: 100%;
    font-size: inherit;
    line-height: normal;
    opacity: 0;
}

.a-icon-alt {
    position: absolute;
    left: -9999px;
    top: auto;
    display: block;
    width: 1px;
    height: 1px;
    line-height: 1px;
    font-size: 1px;
    overflow: hidden;
}

.a-text-beside-button {
    display: inline-block;
    position: relative;
    top: 1px;
    padding: 4px 0 0 6px;
}

.a-text-bold {
    font-weight: 700!important;
}

.a-size-medium {
    text-rendering: optimizeLegibility;
}

.a-size-medium {
    font-size: 17px!important;
    line-height: 1.255!important;
}

.a-color-base {
    color: #111!important;
}

.a-spacing-medium, .a-ws .a-ws-spacing-medium {
    margin-bottom: 18px!important;
}

.a-row {
    width: 100%;
}

.a-size-base {
    font-size: 13px!important;
    line-height: 19px!important;
}

.a-color-secondary {
    color: #555!important;
}

.a-spacing-base, .a-ws .a-ws-spacing-base {
    margin-bottom: 14px!important;
}

table {
    margin-bottom: 18px;
    border-collapse: collapse;
    width: 100%;
}

tr.a-histogram-row {
    color: #767676;
}

tr.a-histogram-row:first-child td {
    padding-top: 0;
}

tr.a-histogram-row td:first-child {
    padding-left: 0;
}*/



.heading {
  font-size: 25px;
  margin-right: 10px;
}

/*.fa {
  font-size: 25px;
}*/

.checked {
  color: gold;
}

/* Three column layout */
.side {
  float: left;
  width: 15%;
  margin-top:10px;
}

.middle {
  margin-top:10px;
  float: left;
  width: 68%;
  padding-left: 10px;
}

/* Place text to the right */
.right {
  text-align: right;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

html {
  scroll-behavior: smooth;
}

/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars */
.bar-5 {width: 60%; height: 18px; background-color: #4CAF50;}
.bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1 {width: 15%; height: 18px; background-color: #f44336;}

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
  .side, .middle {
    width: 100%;
  }
  .right {
    display: none;
  }
}
</style>


    </head>

    <body class="bg_gray" lang="en">
       
        <?php

            //this is for store header
            $header_store = "header_store";

            $folder = "store";

            include("../header.php");

           // print_r($_GET["postid"]);


            

            $pro = new _spprofiles;
            $p = new _productposting;
            $rd = $p->read($_GET["postid"]);
            

            // $poster_detail = $pro->read()
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);
                $poster_id = $row['spProfiles_idspProfiles'];    
                $poster_detail = $pro->read($poster_id);
                $poster_row = mysqli_fetch_assoc($poster_detail);
              
                
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
               

              
               // $ItemCondition
                
                /*$auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];
                $auctionStatus = $row['auctionStatus'];*/

                /*spPostingTitle*/

                 $spid = $row['idspPostings'];


                $myuserid   = $poster_row['idspProfiles'];

                //print_r($myuserid);

                $postingexpire = $row['spPostingExpDt'];
                $PostTitle  = $row['spPostingTitle'];
                $price      = $row['spPostingPrice']; 
                $catid      = $row["spCategories_idspCategory"];
                $wholesaleflag = $row["spPostingsFlag"];
                $button     = $row["spCategoriesButton"];
                $comment    = $row["sppostingscommentstatus"];
                $Country    = $row['spPostingsCountry'];
                $City       = $row['spPostingsCity'];
                $dt         = new DateTime($row['spPostingDate']);
                $desc       = $row['spPostingNotes'];
                $specification       = $row['specification'];
                
                $SellName   = $poster_row['spProfileName'];
                $SellEmail  = $poster_row['spProfileEmail'];
                $SellPhone  = $poster_row['spProfilePhone'];
                $SellAdres  = $row['spprofilesAddress'];
                $SellCity   = $poster_row['spProfilesCity'];
                $SellCounty = $poster_row['spProfilesCountry'];
                $SellId     = $row['spProfiles_idspProfiles'];

                $category     = $row['subcategory'];

               //     print_r($poster_row);
               // exit;
            // echo "herecode"; print_r($spPostingTitle);

               //  print_r($myuserid);
            /*
            $p = new _productposting;
            $rd = $p->read($_GET["postid"]);
            //echo $p->ta->sql;
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);

               // print_r($row);
                $selltype = $row['selltype'];
                $myuserid   = $row['spUser_idspUser'];

                $postingexpire = $row['spPostingExpDt'];
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
                $SellId     = $row['idspProfiles'];*/
                $p = new _productposting;
                $result4 = $p->publicpost_count($SellId);
                //echo $p->ta->sql;
                if($result4 != false){
                    $SelProduct = mysqli_num_rows($result4);
                }else{
                    $SelProduct = 0;
                }
            }
            

            $pv = new _productposting;
               //echo $pv->ta->sql;
            $rdf = $pv->read($_GET["postid"]);

            if ($rdf != false) {
                
                $rowf = mysqli_fetch_assoc($rdf);
                $spPostFieldValue = $rowf['spPostFieldValue'];
               
            }


       /*      if($SellId != $_SESSION['pid']){

                 $pv = new _spproduct_view;
            $rdf = $pv->readproductview($_SESSION['pid']);

   
                if ($rdf != false) {
                    
                    $rowf = mysqli_fetch_assoc($rdf);
                    $spPostFieldValue = $rowf['spPostFieldValue'];
                   
                }

            }*/

         
         /*  $rdfa = $pv->readpostfield($_GET["postid"]);

            if ($rdfa != false) {
                
                 // $rowfa = mysqli_fetch_assoc($rdfa);

                  while($rowfa = mysqli_fetch_assoc($rdfa)){
                  	     echo"<pre>";

                  	     if($rowfa["spPostFieldName"] == "retailStatus_" && $spPostFieldValue == "Retail"){

                              $ItemCondition == $rowfa["spPostFieldValue"];
                               print_r($rowfa["spPostFieldValue"]);
                  	     }
                  	    print_r($rowfa);
                  }
             
            }*/


            //readpostfield

             //print_r($spid); //product id
                  // echo "<br>";
                   //print_r($SellId); // spidprfilid...

             //echo "<br>";  print_r($_SESSION['pid']); // uid

          // echo "<br>"; print_r($_SESSION['uid']);
        /*      if($SellId != $_SESSION['pid']){

                $pv = new _spproduct_view;
                $rdf = $pv->readproductview($_SESSION['pid']);

                if ($rdf != false) {
                    
                    $rowf = mysqli_fetch_assoc($rdf);
                    $spPostFieldValue = $rowf['spPostFieldValue'];
                   
                }
            }*/

             $currentDateTime = date('Y-m-d H:i:s');
    

          $pv = new _spproduct_view;
           
          $allreadyviews =  $pv->readviewed($_SESSION['uid'],$spid);

           $viewed = mysqli_fetch_assoc($allreadyviews);

          // print_r($allreadyviews);
         
         if(empty($allreadyviews)){
               $resv = $pv->insertrecent_viewproduct($spid,$SellId,$_SESSION['uid'],$currentDateTime);
         }
         

           //echo "<br>"; echo $pv->ta->sql;

         // if ($resv != false) {


                    //$spPostFieldValue = $rowf['spPostFieldValue'];
                   
            //    }



        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                   
                    <div class="col-md-12">
                       
                        <!-- <div class="retail_level_two m_btm_10 banner_btn" style="max-height: 48px;" > -->
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- <h3><a href="<?php echo $BaseUrl.'/store'; ?>" style="color: black!important;float: none!important;" ><u>Store:</u> </a><?php echo $storeTitle;?></h3> -->

                            <?php if ($selltype == 'Retail') { ?>
                                     
                                    
                                    
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/retail/view-all.php?condition=All&folder=retail'; ?>">Retail</a></li>

                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                           <?php if ($selltype == 'Wholesaler') { ?>
                                     
                                    
                                    
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home"style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/wholesale'; ?>">Wholesaler</a></li>

                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                           <?php if ($selltype == 'Auction') { ?>
                                     
                                    
                                    
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;
    margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home"style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/store/view-all.php?type=auction'; ?>">Auction</a></li>
                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                                </div>
                          <!--       <div class="col-md-4">
                                  

         <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="width: auto;background-color:#2ba805!important;padding: 7px 33px!important;">Sell Product</a>
                                </div> -->
                            </div>
                        <!-- </div> -->

                        <!--  <?php include('searchform.php');?> -->

                         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
  <?php
  
 
                if(isset($_SESSION['successMessage'])){?>
                  
                        <div class="space"></div>
                        <p class="alert alert-success"><?php echo $_SESSION['successMessage'];  ?></p> <?php
                        unset($_SESSION['successMessage']);
                  
                } ?>
  <div class="store_searchbox" style="background-color: #ffff;border-radius: 36px;" >
      <form method="POST" action="<?php echo $BaseUrl.'/store/search.php'; ?>">
          <div class="">
              <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
                <?php if($profileType != '2' && $profileType != '5') { 
                    $priceWidth = "74%!important";
                } else {
                    $priceWidth = "88%!important";
                }
                ?> 
              <input style="border-radius: 19px;background-color: #e6eeff;width: <?php echo $priceWidth ?>;" type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products in <?php echo $selltype;?>" />
              <button type="submit" class="btn btnd_store" name="btnSearchStore">Search</button>
              <?php if($profileType != '2' && $profileType != '5') { ?>
                  <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="width: auto;background-color:#2ba805!important;padding: 10px 33px!important;">Sell Product</a>
                <?php } ?>
          </div>                                
      </form>
      
  </div>


  <?php

 $po = new _spauctionbid;
                                                                        $h_bid = $po->auctionhighestbid($_GET['postid']);
                                                                      /*  echo $po->ta->sql;*/
                                                                        $i = 1;
                                                                        if($h_bid != false){
                                                                           /* while($highest_bid = mysqli_fetch_assoc($h_bid)){ */
                                                                           
                                                                           $highest_bid = mysqli_fetch_assoc($h_bid);

                                                                           /*print_r($highest_bid);*/
                                                                                
                                                                           /* }*/

                                                                          }


  ?>

<script type="text/javascript">
  
/*
setInterval(function()
{
  var postid = $("#spPostings_idspPostings").val();
var  profileid = $("#spProfiles_idspProfiles").val();

 alert(postid);
 alert(profileid);
    $.ajax({
        type: "POST",
        url: "checkbidcondition.php",
        data:{'spPostings_idspPostings':postid},
        success:function(data)
        {

     alert(data);
            var obj = JSON.parse(data);

                        alert(obj);

                        var highestbid = obj.auctionPrice;

                         $("#ishighbid").html(obj.bidcheck);
               
                         
           
        }
    });
}, 10000)
*/
</script>


<?php if($selltype == "Auction"){ ?>
<div id="ishighbid"></div>
<?php } ?>
<!-- <?php
if($_SESSION['pid'] == $highest_bid['spProfiles_idspProfiles']){
?>

<div class="alert alert-success" id="auct">
  <strong>You're the higest bidder.</strong>
</div>


<?php
}else{


  $po = new _spauctionbid;
                                                        $result_my_au = $po->checkMyAuctionbid($_GET['postid'], $_SESSION['pid']);
                                                        //echo $po->ta->sql;

                                                        //print_r($result_my_au);
                                                        if($result_my_au == true){ ?>
                                                          <div class="alert alert-success" id="auct">
  <strong>You're the higest bidder.</strong>
</div> <?php    
                                                        }
?>

<?php
}


?> -->



<div class="alert alert-success" id="auction_end" style="display: none;">
  <strong>Conratulation!</strong> Auction End With Higest bid <?php echo "$".$highest_bid['auctionPrice'];?>.
</div>
                         <!-- <?php print_r($folder); ?> -->
                       <!--  <div class="breadcrumb_box m_btm_10 row no-margin">
                            <div class="col-md-8 no-padding">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl;?>">Home</a></li> -->
                                  <!--   <?php
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
                                    } ?> -->
                                    
                                   <!--  <li class="breadcrumb-item active"><?php echo $PostTitle?></li> -->
                             <!--    </ol>
                            </div> -->
                          <!--   <div class="col-md-4 text-right right_link" >
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a>
                            </div> -->
                      <!--   </div> -->
    <?php if($SellId == $_SESSION['pid']){ ?>

<div class="alert alert-success">
  <strong>This is my product</strong>
</div>   <?php  }?>
                      
                        <div class="row">
                            <div class="col-md-9">
                                <div class="pro_detail_box" style="margin-top: 10px;border-radius: 15px;">
                                
                                <div class="row no-margin">
                                    <div class="col-md-6 no-padding" >
                                    <h2><?php echo ucwords($PostTitle); ?></h2>
                                    </div>
                                    <div class="col-md-6 deatilproduct">
                                        <table style="display: contents;">
                                        	<tbody style="float: right;">
                                                    <tr>
                                                        <td style="font-size: 12px;"><!-- <strong style="font-size: medium;"> -->Product:<!--   </strong> --></td>
                                                        <td style="font-size: 12px;"> &nbsp;AEF-<?php echo $_GET['postid'];?></td>
                                                        <input type="hidden" id="selltype" name="" value="<?php echo $selltype; ?>">
                                                    </tr>
                                             </tbody>
                                        </table>
                                    </div>
                                </div>


                                    <div class="row no-margin">
                                        <div class="col-md-6 no-padding">
                                            
                                            <div class="product_slider_box social bradius-20">
                                                <div id="carousel-bounding-box" style="height: 100% !important;">
                                                    <div class="carousel slide" id="myCarousestore">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner productslider">
                                                           


														  
														  
														  
														  
														  
														  
<style type="text/css">


.flickity-enabled {
  position: relative;
}

.flickity-enabled:focus { outline: none; }

.flickity-viewport {
  overflow: hidden;
  position: relative;
  height: 100%;
}

.flickity-slider {
  position: absolute;
  width: 100%;
  height: 100%;
}

.flickity-enabled.is-draggable {
  -webkit-tap-highlight-color: transparent;
          tap-highlight-color: transparent;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.flickity-enabled.is-draggable .flickity-viewport {
  cursor: move;
  cursor: -webkit-grab;
  cursor: grab;
}

.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
  cursor: -webkit-grabbing;
  cursor: grabbing;
}

.flickity-prev-next-button {
  position: absolute;
  top: 50%;
  width: 44px;
  height: 44px;
  border: none;
  border-radius: 50%;
  background: white;
  background: hsla(0, 0%, 100%, 0.75);
  cursor: pointer;
  /* vertically center */
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.flickity-prev-next-button:hover { background: white; }

.flickity-prev-next-button:focus {
  outline: none;
  box-shadow: 0 0 0 5px #09F;
}

.flickity-prev-next-button:active {
  opacity: 0.6;
}

.flickity-prev-next-button.previous { left: 10px; }
.flickity-prev-next-button.next { right: 10px; }

.flickity-prev-next-button:disabled {
  opacity: 0.3;
  cursor: auto;
}

.flickity-prev-next-button svg {
  position: absolute;
  left: 20%;
  top: 20%;
  width: 60%;
  height: 60%;
}

.flickity-prev-next-button .arrow {
  fill: #333;
}

.carousel {
  background: #FAFAFA;
}

.carousel-main {
  margin-bottom: 8px;
}

.carousel-cell {
  width: 100%;
  margin-right: 8px;
  background: #8C8;
  border-radius: 5px;
}
.carousel-nav .carousel-cell {
  height: 90px;
  width: 120px;
}

.carousel-main img {
  display: block;
  margin: 0 auto; 
}
.pro_detail_box.dfhfgbhcgf.col-md-10 {
    border: 1px solid #ccc;
    border-radius: 12px !important;
    padding: 5px;
    background-color: #fff;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

function detect_old_ie(){if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){var o=new Number(RegExp.$1);return!(9<=o)&&(8<=o||(7<=o||(6<=o||(5<=o||void 0))))}return!1}window.requestAnimFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(o){window.setTimeout(o,20)},function(Ao){function n(s,o){this.xzoom=!0;var t,a,p,l,r,e,n,d,i,c,h,f,u,v,m,g,w,x,b,z,y,C,k,O,M,A,S,H,W,F,I,T,X,Y,R,q,E,L,D,Z,_,j,N,Q,$,B,G,J,K,P,U,V=this,oo={},to=(new Array,new Array),eo=0,io=0,so=0,no=0,ao=0,po=0,lo=0,ro=0,co=0,ho=0,fo=0,uo=0,vo=0,mo=detect_old_ie(),go=/MSIE (\d+\.\d+);/.test(navigator.userAgent),wo="";function xo(){var o=document.documentElement;return{left:(window.pageXOffset||o.scrollLeft)-(o.clientLeft||0),top:(window.pageYOffset||o.scrollTop)-(o.clientTop||0)}}function bo(){var o;"circle"==V.options.lensShape&&"lens"==V.options.position&&(o=((M=A=Math.max(M,A))+2*Math.max(F,W))/2,k.css({"-moz-border-radius":o,"-webkit-border-radius":o,"border-radius":o}))}function zo(o,t,e,i){"lens"==V.options.position?(C.css({top:-(t-n)*T+A/2,left:-(o-d)*I+M/2}),V.options.bg&&(k.css({"background-image":"url("+C.attr("src")+")","background-repeat":"no-repeat","background-position":-(o-d)*I+M/2+"px "+(-(t-n)*T+A/2)+"px"}),e&&i&&k.css({"background-size":e+"px "+i+"px"}))):C.css({top:-H*T,left:-S*I})}function yo(o,t){var e,i;1<(so=so<-1?-1:so)&&(so=1),X<Y?i=(e=l*(X-(X-1)*so))/R:e=(i=r*(Y-(Y-1)*so))*R,L?(no=o,ao=t,po=e,lo=i):(L||(ro=po=e,co=lo=i),M=l/(I=e/a),A=r/(T=i/p),bo(),ko(o,t),C.width(e),C.height(i),k.width(M),k.height(A),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),zo(o,t,e,i))}function Co(){var o=ho,t=fo,e=uo,i=vo,s=ro,n=co;o+=(no-o)/V.options.smoothLensMove,t+=(ao-t)/V.options.smoothLensMove,e+=(no-e)/V.options.smoothZoomMove,i+=(ao-i)/V.options.smoothZoomMove,s+=(po-s)/V.options.smoothScale,n+=(lo-n)/V.options.smoothScale,M=l/(I=s/a),A=r/(T=n/p),bo(),ko(o,t),C.width(s),C.height(n),k.width(M),k.height(A),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),ko(e,i),zo(o,t,s,n),ho=o,fo=t,uo=e,vo=i,ro=s,co=n,L&&requestAnimFrame(Co)}function ko(o,t){S=(o-=d)-M/2,H=(t-=n)-A/2,"lens"!=V.options.position&&V.options.lensCollision&&(S<0&&(S=0),M<=a&&a-M<S&&(S=a-M),a<M&&(S=a/2-M/2),H<0&&(H=0),A<=p&&p-A<H&&(H=p-A),p<A&&(H=p/2-A/2))}function Oo(){void 0!==m&&m.remove(),void 0!==w&&w.remove(),void 0!==N&&N.remove()}function Mo(o){var t=o.attr("title"),o=o.attr("xtitle");return o||t||""}this.adaptive=function(){0!=B&&0!=G||(s.css("width",""),s.css("height",""),B=s.width(),G=s.height()),Oo(),Q=Ao(window).width(),$=Ao(window).height(),J=s.width(),K=s.height(),B<J&&(J=B),G<K&&(K=G),(Q<B||$<G?!0:!1)?s.width("100%"):0!=B&&s.width(B),"fullscreen"!=P&&(!function(){var o=s.offset();l="auto"==V.options.zoomWidth?J:V.options.zoomWidth;r="auto"==V.options.zoomHeight?K:V.options.zoomHeight;"#"==V.options.position.substr(0,1)?oo=Ao(V.options.position):oo.length=0;if(0!=oo.length)return!0;switch(P){case"lens":case"inside":return!0;case"top":n=o.top,d=o.left,i=n-r,c=d;break;case"left":n=o.top,d=o.left,i=n,c=d-l;break;case"bottom":n=o.top,d=o.left,i=n+K,c=d;break;case"right":default:n=o.top,d=o.left,i=n,c=d+J}return!(Q<c+l||c<0)}()?V.options.position=V.options.mposition:V.options.position=P),V.options.lensReverse||(U=V.options.adaptiveReverse&&V.options.position==V.options.mposition)},this.xscroll=function(o){var t,e;u=o.pageX||o.originalEvent.pageX,v=o.pageY||o.originalEvent.pageY,o.preventDefault(),o.xscale?(so=o.xscale,yo(u,v)):(t=-o.originalEvent.detail||o.originalEvent.wheelDelta||o.xdelta,e=u,o=v,mo&&(e=D,o=Z),so+=t=0<t?-.05:.05,yo(e,o))},this.openzoom=function(o){switch(u=o.pageX,v=o.pageY,V.options.adaptive&&V.adaptive(),so=V.options.defaultScale,L=!1,m=Ao("<div></div>"),""!=V.options.sourceClass&&m.addClass(V.options.sourceClass),m.css("position","absolute"),x=Ao("<div></div>"),""!=V.options.loadingClass&&x.addClass(V.options.loadingClass),x.css("position","absolute"),g=Ao('<div style="position: absolute; top: 0; left: 0;"></div>'),m.append(x),w=Ao("<div></div>"),""!=V.options.zoomClass&&"fullscreen"!=V.options.position&&w.addClass(V.options.zoomClass),w.css({position:"absolute",overflow:"hidden",opacity:1}),V.options.title&&""!=wo&&(N=Ao("<div></div>"),j=Ao("<div></div>"),N.css({position:"absolute",opacity:1}),V.options.titleClass&&j.addClass(V.options.titleClass),j.html("<span>"+wo+"</span>"),N.append(j),V.options.fadeIn&&N.css({opacity:0})),k=Ao("<div></div>"),""!=V.options.lensClass&&k.addClass(V.options.lensClass),k.css({position:"absolute",overflow:"hidden"}),V.options.lens&&(lenstint=Ao("<div></div>"),lenstint.css({position:"absolute",background:V.options.lens,opacity:V.options.lensOpacity,width:"100%",height:"100%",top:0,left:0,"z-index":9999}),k.append(lenstint)),function(){switch(p="fullscreen"==V.options.position?(a=Ao(window).width(),Ao(window).height()):(a=s.width(),s.height()),x.css({top:p/2-x.height()/2,left:a/2-x.width()/2}),(e=V.options.rootOutput||"fullscreen"==V.options.position?s.offset():s.position()).top=Math.round(e.top),e.left=Math.round(e.left),V.options.position){case"fullscreen":n=xo().top,d=xo().left,c=i=0;break;case"inside":n=e.top,d=e.left,c=i=0;break;case"top":n=e.top,d=e.left,i=n-r,c=d;break;case"left":n=e.top,d=e.left,i=n,c=d-l;break;case"bottom":n=e.top,d=e.left,i=n+p,c=d;break;case"right":default:n=e.top,d=e.left,i=n,c=d+a}n-=m.outerHeight()/2,d-=m.outerWidth()/2,"#"==V.options.position.substr(0,1)?oo=Ao(V.options.position):oo.length=0,0==oo.length&&"inside"!=V.options.position&&"fullscreen"!=V.options.position?(V.options.adaptive&&B&&G||(B=a,G=p),l="auto"==V.options.zoomWidth?a:V.options.zoomWidth,r="auto"==V.options.zoomHeight?p:V.options.zoomHeight,i+=V.options.Yoffset,c+=V.options.Xoffset,w.css({width:l+"px",height:r+"px",top:i,left:c}),"lens"!=V.options.position&&t.append(w)):"inside"==V.options.position||"fullscreen"==V.options.position?(l=a,r=p,w.css({width:l+"px",height:r+"px"}),m.append(w)):(l=oo.width(),r=oo.height(),V.options.rootOutput?(i=oo.offset().top,c=oo.offset().left,t.append(w)):(i=oo.position().top,c=oo.position().left,oo.parent().append(w)),i+=(oo.outerHeight()-r-w.outerHeight())/2,c+=(oo.outerWidth()-l-w.outerWidth())/2,w.css({width:l+"px",height:r+"px",top:i,left:c})),V.options.title&&""!=wo&&("inside"==V.options.position||"lens"==V.options.position||"fullscreen"==V.options.position?(h=i,f=c,m.append(N)):(h=i+(w.outerHeight()-r)/2,f=c+(w.outerWidth()-l)/2,t.append(N)),N.css({width:l+"px",height:r+"px",top:h,left:f})),m.css({width:a+"px",height:p+"px",top:n,left:d}),g.css({width:a+"px",height:p+"px"}),V.options.tint&&"inside"!=V.options.position&&"fullscreen"!=V.options.position?g.css("background-color",V.options.tint):mo&&g.css({"background-image":"url("+s.attr("src")+")","background-color":"#fff"}),y=new Image;var o="";switch(go&&(o="?r="+(new Date).getTime()),y.src=s.attr("xoriginal")+o,(C=Ao(y)).css("position","absolute"),(y=new Image).src=s.attr("src"),(O=Ao(y)).css("position","absolute"),O.width(a),V.options.position){case"fullscreen":case"inside":w.append(C);break;case"lens":k.append(C),V.options.bg&&C.css({display:"none"});break;default:w.append(C),k.append(O)}}(),"inside"!=V.options.position&&"fullscreen"!=V.options.position?((V.options.tint||mo)&&m.append(g),V.options.fadeIn&&(g.css({opacity:0}),k.css({opacity:0}),w.css({opacity:0}))):V.options.fadeIn&&w.css({opacity:0}),t.append(m),V.eventmove(m),V.eventleave(m),V.options.position){case"inside":i-=(w.outerHeight()-w.height())/2,c-=(w.outerWidth()-w.width())/2;break;case"top":i-=w.outerHeight()-w.height(),c-=(w.outerWidth()-w.width())/2;break;case"left":i-=(w.outerHeight()-w.height())/2,c-=w.outerWidth()-w.width();break;case"bottom":c-=(w.outerWidth()-w.width())/2;break;case"right":i-=(w.outerHeight()-w.height())/2}w.css({top:i,left:c}),C.xon("load",function(o){if(x.remove(),!V.options.openOnSmall&&(C.width()<l||C.height()<r))return V.closezoom(),o.preventDefault(),!1;V.options.scroll&&V.eventscroll(m),"inside"!=V.options.position&&"fullscreen"!=V.options.position?(m.append(k),V.options.fadeIn?(g.fadeTo(300,V.options.tintOpacity),k.fadeTo(300,1),w.fadeTo(300,1)):(g.css({opacity:V.options.tintOpacity}),k.css({opacity:1}),w.css({opacity:1}))):V.options.fadeIn?w.fadeTo(300,1):w.css({opacity:1}),V.options.title&&""!=wo&&(V.options.fadeIn?N.fadeTo(300,1):N.css({opacity:1})),q=C.width(),E=C.height(),V.options.adaptive&&(a<B||p<G)&&(O.width(a),O.height(p),q*=a/B,E*=p/G,C.width(q),C.height(E)),ro=po=q,co=lo=E,R=q/E,X=q/l,Y=E/r;for(var t,e=["padding-","border-"],i=F=W=0;i<e.length;i++)t=parseFloat(k.css(e[i]+"top-width")),F+=t!=t?0:t,t=parseFloat(k.css(e[i]+"bottom-width")),F+=t!=t?0:t,t=parseFloat(k.css(e[i]+"left-width")),W+=t!=t?0:t,t=parseFloat(k.css(e[i]+"right-width")),W+=t!=t?0:t;F/=2,W/=2,uo=ho=no=u,vo=fo=ao=v,yo(u,v),V.options.smooth&&(L=!0,requestAnimFrame(Co)),V.eventclick(m)})},this.movezoom=function(o){u=o.pageX,v=o.pageY,mo&&(D=u,Z=v);var t=u-d,e=v-n;U&&(o.pageX-=2*(t-a/2),o.pageY-=2*(e-p/2)),(t<0||a<t||e<0||p<e)&&m.trigger("mouseleave"),V.options.smooth?(no=o.pageX,ao=o.pageY):(bo(),ko(o.pageX,o.pageY),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),zo(o.pageX,o.pageY,0,0))},this.eventdefault=function(){V.eventopen=function(o){o.xon("mouseenter",V.openzoom)},V.eventleave=function(o){o.xon("mouseleave",V.closezoom)},V.eventmove=function(o){o.xon("mousemove",V.movezoom)},V.eventscroll=function(o){o.xon("mousewheel DOMMouseScroll",V.xscroll)},V.eventclick=function(o){o.xon("click",function(o){s.trigger("click")})}},this.eventunbind=function(){s.xoff("mouseenter"),V.eventopen=function(o){},V.eventleave=function(o){},V.eventmove=function(o){},V.eventscroll=function(o){},V.eventclick=function(o){}},this.init=function(o){V.options=Ao.extend({},Ao.fn.xzoom.defaults,o),t=V.options.rootOutput?Ao("body"):s.parent(),P=V.options.position,U=V.options.lensReverse&&"inside"==V.options.position,V.options.smoothZoomMove<1&&(V.options.smoothZoomMove=1),V.options.smoothLensMove<1&&(V.options.smoothLensMove=1),V.options.smoothScale<1&&(V.options.smoothScale=1),V.options.adaptive&&Ao(window).xon("load",function(){B=s.width(),G=s.height(),V.adaptive(),Ao(window).resize(V.adaptive)}),V.eventdefault(),V.eventopen(s)},this.destroy=function(){V.eventunbind()},this.closezoom=function(){L=!1,V.options.fadeOut?(V.options.title&&""!=wo&&N.fadeOut(299),"inside"==V.options.position&&"fullscreen"==V.options.position||w.fadeOut(299),m.fadeOut(300,function(){Oo()})):Oo()},this.gallery=function(){for(var o=new Array,t=0,e=io;e<to.length;e++)o[t]=to[e],t++;for(e=0;e<io;e++)o[t]=to[e],t++;return{index:io,ogallery:to,cgallery:o}},this.xappend=function(e){var i=e.parent();function o(o){Oo(),o.preventDefault(),V.options.activeClass&&(_.removeClass(V.options.activeClass),(_=e).addClass(V.options.activeClass)),io=Ao(this).data("xindex"),V.options.fadeTrans&&((z=new Image).src=s.attr("src"),(b=Ao(z)).css({position:"absolute",top:s.offset().top,left:s.offset().left,width:s.width(),height:s.height()}),Ao(document.body).append(b),b.fadeOut(200,function(){b.remove()}));var t=i.attr("href"),o=e.attr("xpreview")||e.attr("src");wo=Mo(e),e.attr("title")&&s.attr("title",e.attr("title")),s.attr("xoriginal",t),s.removeAttr("style"),s.attr("src",o),V.options.adaptive&&(B=s.width(),G=s.height())}to[eo]=i.attr("href"),i.data("xindex",eo),0==eo&&V.options.activeClass&&(_=e).addClass(V.options.activeClass),0==eo&&V.options.title&&(wo=Mo(e)),eo++,V.options.hover&&i.xon("mouseenter",i,o),i.xon("click",i,o)},this.init(o)}Ao.fn.xon=Ao.fn.on||Ao.fn.bind,Ao.fn.xoff=Ao.fn.off||Ao.fn.bind,Ao.fn.xzoom=function(t){var e,i;if(this.selector){var o,s=this.selector.split(",");for(o in s)s[o]=Ao.trim(s[o]);this.each(function(o){if(1==s.length)if(0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0!==e.x&&(i=Ao(this),e.x.xappend(i));else if(Ao(this).is(s[0])&&0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0===e.x||Ao(this).is(s[0])||(i=Ao(this),e.x.xappend(i))})}else this.each(function(o){if(0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0!==e.x&&(i=Ao(this),e.x.xappend(i))});return void 0!==e&&(e.data("xzoom",e.x),Ao(e).trigger("xzoom_ready"),e.x)},Ao.fn.xzoom.defaults={position:"right",mposition:"inside",rootOutput:!0,Xoffset:0,Yoffset:0,fadeIn:!0,fadeTrans:!0,fadeOut:!1,smooth:!0,smoothZoomMove:3,smoothLensMove:1,smoothScale:6,defaultScale:0,scroll:!0,tint:!1,tintOpacity:.5,lens:!1,lensOpacity:.5,lensShape:"box",lensCollision:!0,lensReverse:!1,openOnSmall:!0,zoomWidth:"auto",zoomHeight:"auto",sourceClass:"xzoom-source",loadingClass:"xzoom-loading",lensClass:"xzoom-lens",zoomClass:"xzoom-preview",activeClass:"xactive",hover:!1,adaptive:!0,adaptiveReverse:!1,title:!1,titleClass:"xzoom-caption",bg:!1}}(jQuery);

</script>
<?php 
	$pc = new _productpic;
	$res2 = $pc->read($_GET["postid"]);
	if ($res2 != false) {
 ?>
<!-- Flickity HTML init --> 
<div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
						<?php
						$x=4;
								while ($rp = mysqli_fetch_assoc($res2)) {
									$pic2 = $rp['spPostingPic'];
									?>
<div class="carousel-cell">

<!---<img style="height: 310px; width: 100%; " src="<?php// echo ($pic2);?>"/>---> 




<img style="height: 310px; width: 100%; " class="xzoom<?php echo $x; ?>" id="xzoom-magnific" src="<?php echo ($pic2);?>" xoriginal="<?php echo ($pic2);?>" />







<script>
  (function ($) {
    $(document).ready(function() {

        $('.xzoom<?php echo $x; ?>').xzoom({tint: '#006699', Xoffset: 15});

        //Integration with hammer.js
        var isTouchSupported = 'ontouchstart' in window;

        if (isTouchSupported) {
           

        
        $('.xzoom<?php echo $x; ?>').each(function() {
            var xzoom = $(this).data('xzoom');
            $(this).hammer().on("tap", function(event) {
                event.pageX = event.gesture.center.pageX;
                event.pageY = event.gesture.center.pageY;
                var s = 1, ls;

                xzoom.eventmove = function(element) {
                    element.hammer().on('drag', function(event) {
                        event.pageX = event.gesture.center.pageX;
                        event.pageY = event.gesture.center.pageY;
                        xzoom.movezoom(event);
                        event.gesture.preventDefault();
                    });
                }

                var counter = 0;
                xzoom.eventclick = function(element) {
                    element.hammer().on('tap', function() {
                        counter++;
                        if (counter == 1) setTimeout(openmagnific,300);
                        event.gesture.preventDefault();
                    });
                }

                function openmagnific() {
                    if (counter == 2) {
                        xzoom.closezoom();
                        var gallery = xzoom.gallery().cgallery;
                        var i, images = new Array();
                        for (i in gallery) {
                            images[i] = {src: gallery[i]};
                        }
                        $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
                    } else {
                        xzoom.closezoom();
                    }
                    counter = 0;
                }
                xzoom.openzoom(event);
            });
        });

        } else {
            //If not touch device

            //Integration with fancybox plugin
            $('#xzoom-fancy').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
                event.preventDefault();
            });
           
            //Integration with magnific popup plugin
            $('#xzoom-magnific').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                var gallery = xzoom.gallery().cgallery;
                var i, images = new Array();
                for (i in gallery) {
                    images[i] = {src: gallery[i]};
                }
                $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
                event.preventDefault();
            });
        }
    });
})(jQuery);
</script>
</div>
									<?php
							$x++;	}                        
							?>	 
</div>
<div class="carousel carousel-nav"
  data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
						<?php
						$pc = new _productpic;
						$res2 = $pc->read($_GET["postid"]);

							if ($res2 != false) {
								while ($rp = mysqli_fetch_assoc($res2)) {
									$pic2 = $rp['spPostingPic'];
									?>
<div class="carousel-cell"><img style="width: 100%;height: 100%;" src="<?php echo ($pic2);?>"/></div>
									<?php
								}                        
							} ?>
</div>


<?php } ?>


<script src='https://npmcdn.com/flickity@2/dist/flickity.pkgd.js'></script>

														  
														  
														  
														  
														  
														  
														  
														  
														  
														  
														  
															
															
															
                                                        </div><!-- Carousel nav -->
                                                                                     
                                                    </div>
                                                </div>
                                                

                                                <ul class="produc_quote_box social">
                                                    <li>
                                                        <?php if($SellId == $_SESSION['pid']){ ?>

                                                      <a href="#" id="enquire_sell" ><i class="fa fa-comments"></i> Enquiry</a>
                                               
                                                   <?php }else{ ?>
                                                          
                                                           <a href="#" id="enquire" data-toggle="modal" data-target="#enqueryModal"><i class="fa fa-comments"></i> Enquiry</a>

                                                  <?php } ?>

                                                    </li>


                                                     <li class="showfav">
                                 <?php

                                 /*print_r($_SESSION['uid']);

                                 print_r($_SESSION['pid']);*/
                                                      $st = new _store_favorites;
                                    $res_ev = $st->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                   // echo $ev->ta->sql; 

                                        
                                    

                                    if($res_ev != false){ 


                                      ?>

                                         <a href="javascript:void(0)" class="remtofavorites"data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <!-- <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span> -->
                                            <i class="fa fa-heart"></i> Unfavourite</a>
                                        

                                         
                                        <?php

                                      
                                       
                                        }else{
                                        ?>
                                        <a href="javascript:void(0)"  class="addtofavourite" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                         <!--    <span id="addtofavouriteeve" class="iconhover"><i class="fa fa-heart-o"></i></span> -->
                                            <i class="fa fa-heart-o"></i> Favourite</a>
                                       


                                        <?php
                                    }
                                    ?>

                                    
                                </li>

                                                    
                                                     









                                                  <?php
                                                    $pc = new _productpic;
                                                    $resp = $pc->read($_GET["postid"]);
                                                    //echo $pc->ta->sql;
                                                    if ($resp != false) {
                                                        $postrp = mysqli_fetch_assoc($resp);
                                                        $pictp = $postrp['spPostingPic']; 
                                                    }  ?>
                                                    <li><a href="#" data-toggle='modal' data-target='#myshare'><span class='sp-share' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pictp); ?>'><i class="fa fa-share-alt"></i> Share</span></a></li>

                                               <li>
              <?php


                                                               
                                      $r = new _spstorereview_rating;

                                  $sumres = $r->readstorerating($_GET["postid"]);
                                                          //    echo $r->ta->sql;
                                                                if($sumres != false){
                                                                    while($sumrow = mysqli_fetch_assoc($sumres)){

                                                                      $sumrating += $sumrow['rating'];

                                                                       $ratarr[] =  $sumrow['rating'];

                                                                     }  

                                                              $countrate = count($ratarr);

                                                              $averagerate = $sumrating / $countrate;

                                                              $totalrate  = round($averagerate, 1);
                                                                        ?>
                                    <!--   <div class="row mainreview no-margin"> -->
                                                                           <!--  <div class="col-md-1 no-padding-left">
                                                                                


                                                                                <?php
                                                                                if(isset($rows['spProfilePic'])){
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src=' ".($rows['spProfilePic'])."' >" ;
                                                                                }else{
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src='../img/no.png' >" ;
                                                                                }
                                                                            
                                                                                ?>
                                                                                
                                                                            </div> -->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">


                                        <!-- <div class="col-md-3 no-padding-left" style="width: 18%;">         -->
                                                       <div class="rating-box"  id="rating-box"  data-container="body" data-toggle="popover" data-placement="right" data-content="10" data-original-title="" title="">
                                      <?php if($totalrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalrate > "4" && $totalrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalrate > "3" && $totalrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalrate > "2" && $totalrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalrate > "1" && $totalrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>

                                    <script>
$(document).ready(function(){





     function fetchData(){  
             /*   var fetch_data = '';  
                var element = $(this);  */
                var id = $("#spPostings_idspPostings").val();
                $.ajax({  
                     url:"fetchrating.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){ 
                      
                      var obj = JSON.parse(data);
                   /*alert(obj.rating);*/
                          /*fetch_data = obj.rating; */ 

                          /*alert(obj.rating);*/
                          $('.rating-box').attr('data-content',obj.rating);
                          /*$("#ratingreview").html(obj.rating);*/
                     }  
                });  
                /*return fetch_data; */ 
           } 
fetchData();
/*$('.rating-box').popover({
    html: true,
    trigger: 'hover',
    container: '.rating-box',
    placement: 'bottom',
    content: function () {  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                $.ajax({  
                     url:"fetchrating.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){ 
                      
                      var obj = JSON.parse(data);
                     
                          fetch_data = obj.rating;  
                     }  
                });  

                return fetch_data;  

               
           }  
});
*/


/* $('.rating-box').popover({  
                title:fetchData,  
                 trigger: 'hover',
                html:true,  
                placement:'bottom'  
           }); 


      function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                $.ajax({  
                     url:"fetchrating.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){ 
                      
                      var obj = JSON.parse(data);
                   
                          fetch_data = obj.rating;  
                     }  
                });  
                return fetch_data;  
           }  */
/*<p>4.1 average based on 254 reviews.</p><hr style="border:3px solid #f1f1f1"><div class="row" style="padding-left: 10px;padding-right: 10px;"><div class="side"><div>5 star</div></div><div class="middle"><div class="bar-container"><div class="bar-5"></div></div></div><div class="side right"><div>150</div></div><div class="side"><div>4 star</div></div><div class="middle"><div class="bar-container"><div class="bar-4"></div></div></div><div class="side right"><div>63</div></div><div class="side"><div>3 star</div></div><div class="middle"><div class="bar-container"><div class="bar-3"></div></div></div><div class="side right"><div>15</div></div><div class="side"><div>2 star</div></div><div class="middle"><div class="bar-container"><div class="bar-2"></div></div></div><div class="side right"><div>6</div></div><div class="side"><div>1 star</div></div><div class="middle"><div class="bar-container"><div class="bar-1"></div></div></div><div class="side right"><div>20</div></div></div>
*/

/*  $(".rating-box").popover({ trigger: "hover" , placement: "bottom", html: true, animation:false}).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 300);
});
*/

$("#rating-box").popover({ trigger: "manual" ,placement: "bottom", html: true, animation:false})
    .on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 300);
        });

 /* $('.btn-warning').popover({title: "Header", content: "Blabla", placement: "top"}); 
  $('.rating-box').popover({title: "Header", content: "Blabla",trigger : 'hover', placement: "bottom"}); 
  $('.btn-danger').popover({title: "Header", content: "Blabla", placement: "left"}); 
  $('.btn-default').popover({title: "Header", content: "Blabla", placement: "right"}); */
});
</script>
                                   <!--  </div> -->
                                    
                                    <!-- <div class="col-md-9 no-padding"> 
                                        <p class="col-md-12 rating">
                                        Rating: <?php if($totalrate <= 0 ){ echo "0.0"; }else{ echo $totalrate; } ?>
                               <a  href="<?php echo $BaseUrl.'/store/showstorerating.php?postid='.$_GET['postid']; ?>">(See more info)</a>
                                        </p>
                                                                           </div>  -->
                                                                        <!-- </div> -->
                                                                        <?php
                                                                    /*}*/
                                                                }else{
                                                                    /*echo "<h5 class='text-center'>No Review Found!</h5>";*/
                                                                }
                                                                ?>
                                                           <!--  </div> -->



                                               </li>







                                                </ul>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_detail_right">
                                                <table class="table table-striped table-hovered">
                                                    <tbody>
                                                        <!-- <tr>
                                                             <td><strong>Product Code</strong></td>
                                                            <td>AEF-<?php echo $_GET['postid'];?></td>
                                                        </tr> -->
                                                     
                                                            
                                                        
                                                        <?php
                                                        //Quantity availability of this post
                                                      /*  $pr = new _productposting;
                                                        $re = $pr->quantity($_GET["postid"]);
                                                        //echo $pr->ta->sql;
                                                        $soldquantity =0;
                                                        if ($re != false) {
                                                            $i = 0;
                                                            $rw = mysqli_fetch_assoc($re);
                                                            $Quantity = $rw["spPostFieldValue"];
                                                        } else {
                                                            if ($catid == 8 || $catid == 10 || $catid == 11 || $catid == 13 || $catid == 14)
                                                                $Quantity = INF;
                                                            else
                                                                $Quantity = 1;
                                                        }*/
                                                        $or = new _order;
                                                        $total = 0;
                                                        $res = $or->quantityavailable($_GET["postid"]);
                                                        //echo $or->ta->sql;

                                                        //print_r($res);

                                                        if ($res != false) {
                                                            while ($order = mysqli_fetch_assoc($res)) {
                                                                if ($order["spOrderStatus"] == 0) {
                                                                    $soldquantity += $order["spOrderQty"];
                                                                }
                                                            }
                                                        }

                                                        if (isset($soldquantity)) {
                                                            $available = $Quantity - $soldquantity;
                                                        }else{
                                                            $available = $Quantity;
                                                        }

                                                       // print_r($available);
                                                       /* print_r($_GET['postid']);*/
                                                        //check product is auction or not
                                                       /* $po = new _postfield;
                                                        $result_po = $po->checkAuction($_GET['postid']);*/

                                                        


                                                        if($selltype == "Auction"){
                                                           /* $result_fel = $po->field($_GET['postid']);
                                                            //echo $po->ta->sql;
                                                            $ItemCondition = '';
                                                            $ExpiryDate = '';*/

                                                             
 

/*
                                                            if($result_fel != false){
                                                                while ($row_fel = mysqli_fetch_assoc($result_fel)) {
                                                                    //echo $row_fel['spPostFieldName']."<br>";
                                                                   
                                                                   // print_r($row_fel);
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
                                                            $bid = new _spauctionbid;
                                                            $result_bid = $bid->auctionbid($_GET['postid']);
                                                            // echo $bid->ta->sql;
                                                            // SHOW LATEST BID 
                                                            $result_au  = $bid->get_heigh_auction_priceof_product($_GET['postid']);
                                                            //echo $bid->ta->sql;
                                                            if($result_au != false){
                                                                $row_he = mysqli_fetch_assoc($result_au);

                                                               // print_r($row_he);
                                                                $HeighestBid = $row_he['auctionPrice'];
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
                                                                 <p><strong style="color: #333333;">Expired Date</strong>: <span id="auction_enddate"></span></p>
                                                                 <p><strong style="color: #333333;">Total Bids</strong><a href="#tab4default" data-toggle="tab">: <?php echo $totalBid; ?></a></p>
                                                            	 <p><strong style="color: #333333;">Current Bid</strong>: <strong style="color: #333333;">$<?php echo $HeighestBid;?></strong></p>

                                                               <p><strong style="color: #333333;">My Bid</strong>: <strong style="color: #333333;">$<?php 
                                                               $po = new _spauctionbid;
                                                                        $my_bid = $po->Mylastbid($_GET['postid'],$_SESSION['pid']);

                                                                        $mybid = mysqli_fetch_assoc($my_bid);

                                                                        //print_r($mybid);
                                                                         if(!empty($mybid)){
                                                                          echo $mybid['auctionPrice'];
                                                                        }else{
                                                                          echo '0';
                                                                        }  
                                                                        


                                                               ?></strong></p>

                                                                
                                                               

                                                                 <!--  <?php  
                                                                   
                                                                  
                                                                   if($category == "Shoes"){

                                                                        $s = new _spproductsize;

                                                                        $allsize= $s->read($spid);
                                                                        $size = mysqli_fetch_assoc($allsize);
                                                                          
                                                                        

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

                                                                        $csize= $cs->read($spid);
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

 -->

                                                            
                                                                <!-- <p><strong style="color: #333333;">Item Condition</strong> : <?php echo $ItemCondition;?></p> -->
                                                               <!--  <p><strong>Expired Date</strong> : <?php echo $ExpiryDate;?></p> -->
                                                               

                                                                <!-- <p><strong style="color: #333333;">Expired Date</strong> : <?php echo $postingexpire;?></p> -->
                                                               
                                                               
                                                                
                                                            </div>
                                                            <?php
                                                        }else{ 
                                                            if ($price != false) {
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
                                                            } 
                                                            //if($button == "Buy" && $catid != 3 )
                                                            if ($catid == 1 || $catid == 9 || $catid == 15 || $selltype =="Retail"){
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
                                                                    <td><?php echo "$".$price; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Quantity Available</strong></td>
                                                                    <td><?php echo $available;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Quantity</strong></td>
                                                                    <td><input type="number" class="liveQty" id="liveQty" name="spOrderQty" value="1" min="0" min="5" onkeyup="this.value = minmax(this.value, 0, <?php echo $available;?>)" style="width: 50px;" maxlength="5" /></td>
                                                                </tr>
                                                                <?php 
                                                                    if (isset($minorderqty) && !empty($minorderqty)) { ?>
                                                                        <span class="wholesale_mcg" style="color:red;"></span>
                                                                   <?php }
                                                                ?>
                                                                <input type="hidden" id="productSellType" value="<?php echo $selltype;?>"  />
                                                                <input type="hidden" id="productMinimumQuantity" value="<?php echo(isset($minorderqty) && !empty($minorderqty)  ? $minorderqty : 0)?>" />                                                                <?php  
                                                                   
                                                                  
                                                                   if($category == "Shoes"){

                                                                        $s = new _spproductsize;

                                                                        $allsize= $s->read($spid);
                                                                        $size = mysqli_fetch_assoc($allsize);
                                                                          
                                                                    ?>
                                                                    <tr>
                                                                      <td><strong>Size</strong> :</td>
                                            <td> 
                                                <select id="showsize">
                                                          <option>Select</option>
                                                           <option value="shoesize1" style="<?php if($size['shoesize1'] <= 0){ echo "display: none;";   }  ?>">1</option>
                                                            <option value="shoesize2"  style="<?php if($size['shoesize2'] <= 0){ echo "display: none;";   }  ?>">2</option>
                                                            <option value="shoesize3"  style="<?php if($size['shoesize3'] <= 0){ echo "display: none;";   }  ?>">3</option>
                                                            <option value="shoesize4"  style="<?php if($size['shoesize4'] <= 0){ echo "display: none;";   }  ?>">4</option>
                                                            <option value="shoesize5"  style="<?php if($size['shoesize5'] <= 0){ echo "display: none;";   }  ?>">5</option>
                                                            <option value="shoesize6"  style="<?php if($size['shoesize6'] <= 0){ echo "display: none;";   }  ?>">6</option>
                                                            <option value="shoesize7"  style="<?php if($size['shoesize7'] <= 0){ echo "display: none;";   }  ?>">7</option>
                                                            <option value="shoesize8"  style="<?php if($size['shoesize8'] <= 0){ echo "display: none;";   }  ?>">8</option>
                                                            <option value="shoesize9"  style="<?php if($size['shoesize9'] <= 0){ echo "display: none;";   }  ?>">9</option>
                                                            <option value="shoesize10" style="<?php if($size['shoesize10'] <= 0){ echo "display: none;";   }  ?>">10</option>
                                                            <option value="shoesize11" style="<?php if($size['shoesize11'] <= 0){ echo "display: none;";   }  ?>">11</option>
                                                            <option value="shoesize12" style="<?php if($size['shoesize12'] <= 0){ echo "display: none;";   }  ?>">12</option>
                                                            <option value="shoesize13" style="<?php if($size['shoesize13'] <= 0){ echo "display: none;";   }  ?>">13</option>
                                                            <option value="shoesize14" style="<?php if($size['shoesize14'] <= 0){ echo "display: none;";   }  ?>">14</option>

                                                        </select>

    </td>
  </tr>


                                                                  <?php 

                                                                    }


                                                                    if($category == "Clothing"){

                                                                       $cs = new _spproductsize;

                                                                        $csize= $cs->read($spid);
                                                                        $clothsize = mysqli_fetch_assoc($csize);

                                                                  ?>


  <tr>
                                                                      <td><strong>Size</strong> :</td>
                                                      <td>
                                                                   
                                                        <select id="clothsize">
                                                          <option>Select</option>
                                                           <option value="sizeXS" style="<?php if($clothsize['sizeXS'] <= 0){ echo "display: none;";   }  ?>">XS</option>
                                                            <option value="sizeS"  style="<?php if($clothsize['sizeS'] <= 0){ echo "display: none;";   }  ?>">S</option>
                                                            <option value="sizeM"  style="<?php if($clothsize['sizeM'] <= 0){ echo "display: none;";   }  ?>">M</option>
                                                            <option value="sizeL"  style="<?php if($clothsize['sizeL'] <= 0){ echo "display: none;";   }  ?>">L</option>
                                                            <option value="sizeXL"  style="<?php if($clothsize['sizeXL'] <= 0){ echo "display: none;";   }  ?>">XL</option>
                                                            <option value="sizeXXL"  style="<?php if($clothsize['sizeXXL'] <= 0){ echo "display: none;";   }  ?>">XXL</option>
                                                            <option value="sizeXXXL"  style="<?php if($clothsize['sizeXXXL'] <= 0){ echo "display: none;";   }  ?>">XXXL</option>
                                                           
                                                          



                                                        </select>

                                                      </td>
</tr>





                                                                  <?php 

                                                                   }


                                                                  ?>

           




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
                                                            }
                                                        }
                                                        ?>
                                                          <!--  <tr>
                                                            <td><strong>Last Updated Date</strong></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                        </tr> -->
                                                
                                                    </tbody>
                                                </table>
                                                <div class="btn_box <?php echo ($SellId == $_SESSION['pid'])?'hidden':'';?>">
                                                    <form action="<?php echo ($available == 0 ?" ":"../cart/addorder.php");?>" method="post">
                                                        <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
                                                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>

                                                        <input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="<?php echo $_SESSION['uid']?>"/>

                                                         <input type="hidden" class="dynamic-pid" id="size" name="size" />

                                                        <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
                                                        <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $row['spProfiles_idspProfiles'];?>"/>
                                                        <input type="hidden" id="cartItemType" name="cartItemType" value="Store"/>
                                                        <input type="hidden" id="spOrdrQty" name="spOrderQty" value="1" >
                                                        
                                                        <?php
                                                        
                                                        //print_r($catid );
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
                                                                else{
                                                                   
                                                                   echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#coverletter' id='applybtn'>Apply Job</button>";

                                                                }    
                                                                    
                                                                
                                                                include("coverletter.php");
                                                            
                                                            }else if($catid == 5){
                                                                
                                                                echo "<button type='button' class='btn btn-success btn-sm pull-right' data-toggle='modal' data-categoryid='".$catid."' data-postid='".$_GET["postid"]."' data-target='#bid-system' data-profileid='".$_SESSION['pid']."'><span class='fa fa-hand-paper-o'> </span> Bid</button>";
                                                            
                                                            }else if($catid != 18 && $catid != 2 && $catid != 5 && $catid != 7 && $catid != 12) {
                                                               // echo "here";
                                                                if( $catid == 9 ){
                                                                    if($ticketprice > 0){
                                                                        $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);

                                                                        //echo $od->ta->sql;
                                                                        if ($res != false)
                                                                        {
                                                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
                                                                        }
                                                                        else{
                                                                            echo "<button type='submit' class='btn btn-primary btn-sm pull-right ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
                                                                        }
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

                                                                    //echo"here";
                                                                    $po = new _postfield;
                                                                    $result_po = $po->checkAuction($_GET['postid']);
                                                                    if($selltype == "Auction"){

                                                                //selltype
                                                                        
?>
                    <form id="auct_bid" action="post">
                       <!--  <div class="modal-body"> -->
                            
                            <!-- <div class="" style="padding-bottom: 10px;display: flex;padding-top: 27px;padding-bottom: 25px;padding-left: 5px;display: flex;background-color: whitesmoke;margin-bottom: 15px;"> -->

                              <div id="aucdiv" style="padding-bottom: 10px;display: none;padding-top: 27px;padding-bottom: 5px;padding-left: 5px;background-color: whitesmoke;">
                                <!-- <span class="input-group-addon" id="basic-addon1">$</span> -->
                                <input type="text" class="form-control activity" id="AuctionPrice" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" onkeypress="javascript:return isNumber(event)" maxlength="9"   style="margin:0px;" />&nbsp;&nbsp;
                                <button type='button' class='btn btn_cart btn_buy_now placebidAuction' style='float:right;padding: 8px;'  >Bid</button>

                            </div>
                            <label for="AuctionPrice" id="bidmsg" style="font-weight: unset;font-size: 12px;padding-top: 4px;padding-right: 220px;background-color: whitesmoke;padding-left: 10px;display: none;">Your bid must be $<?php echo $HeighestBid; ?>  or more</label>
                            <div id="invalidBid"></div>
                            <!--Hidden attribute-->
                            <input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
                            <input type="hidden" id="spPostings_idspPostings"  name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
                            <input type="hidden" id="spPostFieldBidFlag" value="1">
                            <input type="hidden" class="auctioncat" value="1"/>
                            <input class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                            
                      <!--Complete-->
                      <!--  </div> -->
                      <!--   <div class="modal-footer bg-white br_radius_bottom"> -->
                           <!--  <button type="button" class="btn btn-secondary db_btn db_orangebtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary placebidAuction db_btn db_primarybtn">Place Bid</button>
                        </div> -->
                    </form>
                            <?php

                                                                    /* echo "<button type='button' class='btn btn_cart btn_buy_now placebidAuction' style='float:right;'  >Post Bid</button>";*/
                                                                            
                                                                    /*echo "<button type='button' class='btn btn_cart btn_buy_now placebidAuction' data-toggle='modal' data-target='#bid-auction' >Post Bid</button>";*/
                                                                       

                                                                    }else{

                                                                      $exda = date("Y-m-d" , strtotime($ExpiryDate));

                                                                      $today = date("Y-m-d");

                                                                     /* echo $exda;
                                                                      
                                                                      echo $today; */
																	   if($selltype == "Wholesaler" || $selltype == "Retail"){
																			echo "<button type='submit' class='btn btn_cart_buy btn_buy_now ' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='' ".($available == 0 || $exda < $today ? "":"")."
                                                                            style='background-color:#ff901d!important;'>Buy Now</button>";
																	   }else{
                                                                        echo "<button type='submit' class='btn btn_cart_buy btn_buy_now ' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='' ".($available == 0 || $exda < $today ? "disabled":"")."style='background-color:#ff901d!important;'>Buy Now</button>";
																	   }
																	   $buyerid = $_SESSION['pid'];
                                                                        $od = new  _order;
                                                                        $res = $od->checkorder($_GET["postid"] , $buyerid);

                                                                        //echo $od->ta->sql;
                                                                        if ($res != false && $selltype != "Retail"){
                                                                            echo "<button type='button' class='btn btn_cart disabled btn_add_to_cart' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'  ".($available == 0 || $exda < $today ? "disabled":"").">Added to cart</button>";
                                                                        }else{
                                                                            echo "<button type='submit' class='btn btn_cart btn_add_to_cart ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Add to cart</button>";
                                                                        }

                                                                          if($selltype == "Wholesaler"){
									
                                                                          /*  echo'<div class="space"></div>
                                                                            <a href="javascript:void(0)" class="btn butn_draf db_btn db_orangebtn" data-toggle="modal" data-target="#quotation" >Request For Quote</a>';*/
                                                                         
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
                                                        <!-- <li><a href="#tab3default" data-toggle="tab">Reviews</a></li> -->
                                                      <!--   <?php 
                                                        $po = new _spauctionbid;
                                                        $result_my_au = $po->checkMyAuctionbid($_GET['postid'], $_SESSION['pid']);
                                                        //echo $po->ta->sql;

                                                        //print_r($result_my_au);
                                                        if($result_my_au == true){ ?>
                                                            <li><a href="#tab4default" data-toggle="tab">Your Bids</a></li> <?php    
                                                        }

                                                        ?> -->

<?php
                                                          if($selltype == "Auction"){ ?>

                                                            
                                                            <li><a href="#tab4default" id="yourbid" data-toggle="tab">Your Bids</a></li>

                                                            <?php    
                                                        }
?>
                                                      <!--   <li><a href="#tab4default" data-toggle="tab">Your Bids</a></li> -->
                                                        
                                                    </ul>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active" id="tab1default">
                                                            <p style="word-break: break-word;"><?php echo $desc;?></p>
                                                           <?php
                                                          /*         $po = new _postfield;
                                                      
                                                            $result_fel = $po->field($_GET['postid']);
                                                            //echo $po->ta->sql;
                                                            $ItemCondition = '';
                                                            $ExpiryDate = '';

                                                             
 


                                                            if($result_fel != false){
                                                                while ($row_fel = mysqli_fetch_assoc($result_fel)) {
                                                                 
                                                                    if($row_fel['spPostFieldName'] == 'auctionStatus_'){
                                                                        $ItemCondition = $row_fel['spPostFieldValue'];
                                                                    } if($row_fel['spPostFieldName'] == 'retailStatus_'){
                                                                        $ItemCondition = $row_fel['spPostFieldValue'];
                                                                    }else{
                                                                        if($ItemCondition == ''){
                                                                            $ItemCondition = "Not Define";
                                                                        }
                                                                    }
                                                                    
                                                                   
                                                                    
                                                                    
                                                                    
                                                                }
                                                            }*/
                                                            ?>
                                                            <p><strong style="color: #333333;">Item Condition</strong>: <?php echo $ItemCondition;?></p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab2default">
                                                            <p><?php if(!empty($specification)){
                                                                     echo $specification;
                                                            }else{
                                                               
                                                               echo "No Specification Found";
                                                            }


                                                            ?></p>
                                                            
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


                                                               
                                      $r = new _spstorereview_rating;

                                  $sumres = $r->readstorerating($_GET["postid"]);
                                                          //    echo $r->ta->sql;
                                                                if($sumres != false){
                                                                    while($sumrow = mysqli_fetch_assoc($sumres)){

                                                                      $sumrating += $sumrow['rating'];

                                                                       $ratarr[] =  $sumrow['rating'];

                                                                     }  

                                                              $countrate = count($ratarr);

                                                              $averagerate = $sumrating / $countrate;

                                                              $totalrate  = round($averagerate, 1);
                                                                        ?>
                                      <div class="row mainreview no-margin">
                                                                           <!--  <div class="col-md-1 no-padding-left">
                                                                                
 

                                                                                <?php
                                                                                if(isset($rows['spProfilePic'])){
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src=' ".($rows['spProfilePic'])."' >" ;
                                                                                }else{
                                                                                    echo "<img  alt='Profile Pic' class='img-responsive' src='../img/no.png' >" ;
                                                                                }
                                                                            
                                                                                ?>
                                                                                
                                                                            </div> -->
                                        <div class="col-md-3 no-padding-left" style="width: 18%;">        
                                                       <div class="rating-box">
                                      <?php if($totalrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalrate > "4" && $totalrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalrate > "3" && $totalrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalrate > "2" && $totalrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalrate > "1" && $totalrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                                    </div>
                                    
                                    <div class="col-md-9 no-padding"> 
                                        <p class="col-md-12 rating">
                                        Rating: <?php if($totalrate <= 0 ){ echo "0.0"; }else{ echo $totalrate; } ?>
                               <a  href="<?php echo $BaseUrl.'/store/showstorerating.php?postid='.$_GET['postid']; ?>">(See more info)</a>
                                        </p>
                                                                           </div> 
                                                                        </div>
                                                                        <?php
                                                                    /*}*/
                                                                }else{
                                                                    echo "<h5 class='text-center'>No Review Found!</h5>";
                                                                }
                                                                ?>
                                                            </div>


                                                        </div>
                                                        <div class="tab-pane fade" id="tab4default">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped ">
                                                                    <thead>
                                                                        <tr style="font-size: 18px;">
                                                                            <th>No.</th>
                                                                            <th>Bidder's Name</th>
                                                                            <th>Bid Price</th>
                                                                            <th>Bid Date/Time</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $po = new _spauctionbid;
                                                                        $result_bid = $po->auctionbid($_GET['postid']);
                                                                        //echo $po->ta->sql;
                                                                        $i = 1;

                                                                        // print_r($result_bid);
                                                                        if($result_bid != false){
                                                                            while($row_bid = mysqli_fetch_assoc($result_bid)){ 
                                                                                $p = new _spprofiles;
                                                                                $NameOfProfile = $p->getProfileName($row_bid['spProfiles_idspProfiles']);
                                                                                ?>
                                                                                <tr style="<?php  if($i== 1 && $result_bid->num_rows > 1){ echo "color:red; ";  }else if($i==  $result_bid->num_rows){ echo "color:green; ";  }?>">
                                                                                    <td><?php echo $i;?></td>
                                                                                    <td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row_bid['spProfiles_idspProfiles'];?>"  style="font-size: 16px;<?php  if($i== 1 && $result_bid->num_rows > 1){ echo "color:red; ";  }elseif($i==  $result_bid->num_rows){ echo "color:green; ";  }else{ echo "color: #428bca;"; }?>" onMouseOver="this.style.color='#00F'"><?php echo ucwords($NameOfProfile);?></a></td>
                                                                                    <td>$<?php echo $row_bid['auctionPrice'];?></td>
                                                                                    <td><?php echo $row_bid['bid_timestamp'];?></td>
                                                                                </tr> <?php
                                                                                $i++;
                                                                            }
                                                                        }else{

                                                                           echo"<tr colspan='4'><td  colspan='4'><h3 style='text-align:center;' >No Bid Found.</h3></td></tr>";
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
                            <div id="sidebar_right" class="col-md-3  no_pad_left_right" style="margin-top: 15px;">
                                <?php include('../component/seller-info-tips.php');?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>


        <?php include('postshare.php');?>

            <div class="modal fade" id="lowestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content no-radius bradius-15">
        <form action="../store/auction-bid/rebid.php" method="POST" id="lowestbidfrm" class="sharestorepos">
          <div class="modal-header bg-white br_radius_top">
            <h4 class="modal-title success" style="color:red;"><span id="lowoldbid"></span> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>

          <div class="modal-body sharedimage">
                 <span id="lowbidtime" style="float: right;padding-top: 20px;"></span>
             <div class="row">

          <div class="col-md-12">
             <p style="color:red"><i class="fa fa-warning" style="color:red"></i>&nbsp;You've been outbid by someone else max bid!<br><p  style="color:black;    padding-left: 22px;">You can Still Win! Try bidding Again!</p></p>
          </div>
        </div>
        <!--  <div class="row">

          <div class="col-md-12">
             <p style="color:red"><i class="fa fa-warning" style="color:red"></i>&nbsp;You've been outbid by someone else max bid!<br><p  style="color:black">You can Still Win! Try bidding Again!</p></p>
          </div>
        </div> -->
          <div class="row">

          <div class="col-md-12">

         <!--   <p style="color:red;">You've been outbid by someone else max bid!</p>
           <p>Your high bid amount <span id="lowbid"></span></p>  -->

           <input type="hidden" name="spPostings_idspPostings" id="lownewspPostings_idspPostings" >
           <input type="hidden" name="spProfiles_idspProfiles" id="lownewspProfiles_idspProfiles" >
           <input type="hidden" name="lastBid" id="lownewlastBid" >
 
           <div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">

           


                                <!-- <span class="input-group-addon" id="basic-addon1">$</span> -->
            <div class="col-md-8">
               
              <input type="text" class="form-control activity" id="AuctionPricenewlow" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." onkeypress="javascript:return isNumber(event)" aria-describedby="basic-addon1" style="margin:0px;">&nbsp;&nbsp;
            </div>
            <div class="col-md-4">

              <button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionlow"  style="float:left;padding: 8px;background: #1c6121!important;border-radius: 20px!important;width: 90%;">Bid</button>
              <span id="lowpriceerror" style="color:red;"></span>
            </div>

            </div>

           <p>By placing a bid,You're committing to buy this item if you Win.</p>

          </div>
            
          </div>

            </div>
           <!--  <div class="modal-footer bg-white br_radius_bottom">
            <button type="" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Cancel</button>
            <button type="submit" id="share" class="btn btn-submit db_btn db_primarybtn">Share</button>
          </div> -->
        </form>
      </div>
    </div>
  </div>


          <div class="modal fade" id="higestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content no-radius bradius-15">
        <form action="../store/auction-bid/rebid.php" method="POST"  id="higestbidfrm" class="sharestorepos">
          <div class="modal-header bg-white br_radius_top">
            <h4 class="modal-title success" style="color:green;"><span id="oldbid"></span> </h4><button type="button" class="close" data-dismiss="modal">&times;</button>
           
            
          </div>

          <div class="modal-body sharedimage">

             <span id="oldbidtime" style="float: right;padding-top: 20px;"></span>
          <div class="row">

          <div class="col-md-12">

           <p style="color:green;"><i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>&nbsp;You're the highest bidder!</p>
           <p>Your high bid amount &nbsp;<span id="highbid" style="font-weight: 600;font-size: 19px;"></span></p>

           <input type="hidden" name="spPostings_idspPostings" id="newspPostings_idspPostings" >
           <input type="hidden" name="spProfiles_idspProfiles" id="newspProfiles_idspProfiles" >
           <input type="hidden" name="lastBid" id="newlastBid" >
      
           <div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">

            
                                <!-- <span class="input-group-addon" id="basic-addon1">$</span> -->
            <div class="col-md-8">
              <!-- <p>Realy want to win? Try Rasing bid amount</p> -->
              <input type="text" class="form-control activity" id="AuctionPricenewhigh"  onkeypress="javascript:return isNumber(event)" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin-left: 19px;">&nbsp;&nbsp;
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionhigh" style="float:left;padding: 8px;background: #1c6121!important;border-radius: 20px!important;width: 90%;">Bid</button>
              <span id="highpriceerror"></span>
            </div>

            </div>

            <p>By placing a bid,You're committing to buy this item if you Win.</p>

          </div>
            
          </div>

            </div>
           <!--  <div class="modal-footer bg-white br_radius_bottom">
            <button type="" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Cancel</button>
            <button type="submit" id="share" class="btn btn-submit db_btn db_primarybtn">Share</button>
          </div> -->
        </form>
      </div>
    </div>
  </div>

        <!--modal for Enquery-->
        <div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos bradius-15" >
                    <div class="modal-header bg-white br_radius_top">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="enquireModalLabel" ><b>Send a Message</b></h3>
                    </div>
                    <form action="../enquiry/addmsgenquire.php" method="post" id="enquirymessege">
                        <div class="modal-body">
                            <?php
                                /*$e = new _postenquiry;
                                $re = $e->read($_GET["postid"]);
                              //  echo $e->ta->sql;
                                if ($re != false){
                                    while($rw = mysqli_fetch_assoc($re)){
                                        $con = new _conversation;
                                        $result = $con->readconversation($rw["idspMessage"]);
                                        if ($result != false){
                                            while($row = mysqli_fetch_assoc($result)){
                                                
                                            }
                                        }
                                    }
                                }*/
                                $p = new _productposting;
                                $res = $p->read($_GET['postid']);
                               // echo $p->ta->sql;
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
                              <textarea class="form-control" id="message-text" name="message" 
                               rows="5" maxlength="500" onkeyup="keyupmessage()"></textarea>

                                <span id="messagetext_error" style="color:red; font-size: 14px;"></span>
                            </div>
                        </div>

                        <div class="modal-footer bg-white br_radius_bottom">
                          <button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-submit postenquiry db_btn db_primarybtn" >Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--complete-->
        <!--Auction bid system-->
        <div class="modal fade" id="bid-auction" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
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
                            <input class="dynamic-pid" name="spProfiles_idspProfiles"  type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
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


    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode

        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) ){
          return false;
        }else  if (evt.which == 13) {
            evt.preventDefault();
        }else{
              return true;
        }
    }    

    $(".placenewbidAuctionlow").on("click", function () {
        var currentBid = $("#AuctionPricenewlow").val();
        var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
        
        if(currentBid == ""){
            swal({
                title: 'Please Enter Your bid.',
                imageUrl: logo
                });
        }else{
            var postid = $("#spPostings_idspPostings").val();
            var  profileid = $("#spProfiles_idspProfiles").val();
                $.ajax({
                              type:'POST',
                              url:'checkbidcondition.php',
                              data:{'spPostings_idspPostings':postid},
                              success:function(data){
                                var obj = JSON.parse(data);
                                var highestbid = obj.auctionPrice;
                                var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
                            if(obj.auctionPrice != 0){
                                var highestbid = obj.auctionPrice;

                                if(currentBid == highestbid ){
                                    swal({
                                        title: 'Your bid Should be greater than $'+highestbid+'',
                                        imageUrl: logo
                                    });
                     
                                }else if(currentBid > highestbid){
                                    $.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:highestbid }, function (r) {
                                    });
                                    var newoldbid = " $"+highestbid;
                                    var newhighbid = " $"+currentBid;
                                    $("#oldbid").html(newoldbid);
                                    $("#highbid").html(newhighbid);

                                    $("#newspPostings_idspPostings").val(postid);
                                    $("#newspProfiles_idspProfiles").val(profileid);
                                    $("#newlastBid").val(highestbid);
                                    $("#higestbid").modal('show');
                                }else if(currentBid < highestbid){
                                     var newoldbid = " $"+highestbid;
                                     var newhighbid = " $"+currentBid;

                                    $("#lowoldbid").html(newoldbid);
                                    $("#lowbid").html(newhighbid);

                                    $("#lownewspPostings_idspPostings").val(postid);
                                    $("#lownewspProfiles_idspProfiles").val(profileid);
                                    $("#lownewlastBid").val(highestbid);

                                    $("#lowestbid").modal('show');

                                }
                            }else{
                               $.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:lastBid }, function (r) {
                                    });
                               location.reload();
                            }
                        }
                        });
            }
    });



    $(".placenewbidAuctionhigh").on("click", function () {
          var currentBid = $("#AuctionPricenewhigh").val();
          var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
        if(currentBid == ""){
         swal({
                title: 'Please Enter Your bid.',
                imageUrl: logo
            });
        }else{
            var postid = $("#spPostings_idspPostings").val();
            var  profileid = $("#spProfiles_idspProfiles").val();
                $.ajax({
                          type:'POST',
                          url:'checkbidcondition.php',
                          data:{'spPostings_idspPostings':postid},
                          success:function(data){

                            var obj = JSON.parse(data);
                            var highestbid = obj.auctionPrice;
                            var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";

                        if(obj.auctionPrice != 0){
                            var highestbid = obj.auctionPrice;
                            if(currentBid == highestbid ){
                                swal({
                                        title: 'Your bid Should be greater than $'+highestbid+'',
                                        imageUrl: logo
                                    });
                            }else if(currentBid > highestbid){
                                     $.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:highestbid }, function (r) {
                                    });
                                var newoldbid = " $"+highestbid;
                                var newhighbid = " $"+currentBid;

                                $("#oldbid").html(newoldbid);
                                $("#highbid").html(newhighbid);

                                $("#newspPostings_idspPostings").val(postid);
                                $("#newspProfiles_idspProfiles").val(profileid);
                                $("#newlastBid").val(highestbid);
                                $("#higestbid").modal('show');
                            }else if(currentBid < highestbid){
                                var newoldbid = " $"+highestbid;
                                var newhighbid = " $"+currentBid;

                                $("#lowoldbid").html(newoldbid);
                                $("#lowbid").html(newhighbid);

                                $("#lownewspPostings_idspPostings").val(postid);
                                $("#lownewspProfiles_idspProfiles").val(profileid);
                                $("#lownewlastBid").val(highestbid);

                                $("#lowestbid").modal('show');
                            }
                        }else{
                               $.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:lastBid }, function (r) {
                                      //alert(r);
                                    });
                               location.reload();
                            }
                        }
                    });

        }
    });





  function keyupmessage() {

//alert();
  var messagetext= $("#message-text").val()

   if(messagetext != "")
  {
    $('#messagetext_error').text(" ");
  
  }
  
       
}



   $(document).ready(function() {
       
        var auction_exp = $("#auctionexp").val();

        var selltype = $("#selltype").val();

        //alert();
if(selltype == "Auction"){

  var countDownDate = new Date(auction_exp).getTime();

 /* var bidend = new Date(auction_exp.getTime() - 5 * 60000);

alert(bidend);*/
// Update the count down every 1 second
  var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();


 /* alert(now);*/
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
/*
  alert(distance);*/
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("auction_enddate").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";


if(days == 0 && hours == 0 && minutes <= 5 ){

$('#auction_end').show();
$('#AuctionPrice').hide();
$('.placebidAuction').hide();
$('#bidmsg').hide();
/*alert();*/
}
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("auction_enddate").innerHTML = "EXPIRED";


    
  }else{

    var x = document.getElementById("aucdiv");

    var y = document.getElementById("bidmsg");

    x.style.display = "flex";

    y.style.display = "block";

  }


}, 1000);


}
//alert(auction_exp);



        });








 var number = document.getElementById('liveQty');

// Listen for input event on numInput.
number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}    
function minmax(value, min, max) 
{
   /* if(parseInt(value) < min || isNaN(parseInt(value))) 
        return min; */
    if(parseInt(value) > max) 
        return max; 
    else return value;
}




$("#enquire_sell").click(function(){

                         var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";

                     swal({
                              title: "This is My Product.",
                              imageUrl: logo
                          });

});

 


$('#showsize').on('change', function() {
  /*alert( this.value );*/
  $("#size").val(this.value);
});

$('#clothsize').on('change', function() {
  /*alert( this.value );*/
  $("#size").val(this.value);
});


  /*$('.postenquiry').click(function() {
  //  alert();

var messagetext = $('#message-text').val(); 
if (messagetext == "" ){
$('#messagetext_error').text("This Field is Required."); 
$("#message-text").focus();
 return false;

}else {
$("#enquirymessege").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});*/



/*
function message_validate()
{
alert();
       var flag=0;
       var strText = document.f1.message.value;
       if (strText!="")
       {
       var strArr = new Array();
       strArr = strText.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

       if(document.f1.message.value=="" || flag == 1 )
       {        alert("shouldn't be blank or contain blank space at the Bewgining!!");
               document.f1.message.value="";
               document.f1.message.focus();
               return false;
       }
       return true;
}
*/
</script>