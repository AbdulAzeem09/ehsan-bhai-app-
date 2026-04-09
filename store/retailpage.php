<?php

die("3333333333333");
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="my-groups/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class)
    {
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?> 
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
        <script>
            $(function(){
                // bind change event to select
                $('#dynamic_select').on('change', function () {
                    var url = "view-all.php?catName=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
                //dynamic price
                /*$('#dynamic_price').on('change', function () {
                    var url = "view-all.php?orderby=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
*/
        
            });
        </script>
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


  $(function(){
     $("#dynamic_price").on('change', function(){
               // alert();

               $("#price_form").submit();
               return true;

  
                });

          });


        </script>

      
        <!--This script for sticky left and right sidebar END--> 
  <!--  <script type="text/javascript">
            
 function postingexpire(id,exdate){
//alert();


var auction_exp = $("#auctionexp"+id).val();

var auction_exp = $("#auctionexp"+exdate).val();
 

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
  }
}, 1000);



//alert(auction_exp);


  }
        </script> -->

  <!--        <style type="text/css">
          


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
.seeproduct{
  display: none;
}
.loadpost{
  font-size: 16px;
    color: #0B241E;
    font-weight: bold;
}
.loadpost:hover{
text-decoration: underline!important;
   font-size: 16px;
    color: #2ba805;
    font-weight: bold;
}
        </style> -->
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
	display:contents;
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
	background-color: green;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
}
		</style>
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">

                     <?php 
                        include('top-dashboard.php');                        
                        ?>


                    <div id="sidebar"  class="col-md-2 hidden-xs no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                       
                        
                        
                        
                        <div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px;">
                            <div class="row no-margin">
                                <div class="col-md-10 no-padding right_link">

                                      <form method="POST" action="">
                     <div class="" style="padding-top: 3px;padding-left: 3px;">
                        <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
                        <input style="border-radius: 20px;background-color: #e6eeff;width:75%!important;display:inline-block; height: 40px;" type="text" class="form-control" name="txtStoreSearch" value="<?php echo isset($_POST['txtStoreSearch'])?$_POST['txtStoreSearch']:'';?>" placeholder="Search For Products" />
                        <button type="submit" class="btn btnd_store" name="btnSearchStore" style=" width: 140px!important;">Search <!-- aution --></button>          
                     </div>                                
                  </form>
                                   
                                    <!-- <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a> -->
                            
                                </div>


                                <div class="col-md-2" style="padding: 3px 28px;" >

                            <form id="price_form" method="POST" action="">

                                    <div class="" style="display: inline;">

                                <select class="form-control pull-right no-radius" id="dynamic_price" style="width: 170px;display: inline;margin-left: 5px;border-radius: 20px; height: 40px;margin-right: 4px;" name="pricedropdown">
                                             
                        <option value="">Select Price Order</option>
                                              
                             <option value="Asc" <?php if($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
                                         
                            <option value="Desc"  <?php if($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
                                        </select>
                                    </div>
                                </form>
                                 <!--    <div class="" style="display: inline">
                                        <select class="form-control pull-right no-radius" id="dynamic_select" style="width: 150px;">
                                            <?php
                                                $pr = new _spprofilehasprofile;
                                                $p = new _postfield;
                                                $m = new _subcategory;

                                                if(isset($_GET['catName'])){
                                                    $selectValue = str_replace('_', ' ', $_GET['catName']);
                                                    $SelectTitle = str_replace('-', '&', $selectValue);
                                                    
                                                }

                                                
                                                $catid = 1;
                                                $result = $m->read($catid);
                                                if($result){
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php echo (isset($SelectTitle) && $SelectTitle == $rows['subCategoryTitle'])?'selected':''; ?> ><?php echo $rows["subCategoryTitle"]; ?></option>
                                                        <?php
                                                       
                                                    }
                                                }
                                            ?>
                                      </select>

                                        
                                        
                                            
                                    </div> -->
                                  <!--   <div class="listingview pull-right" style="display: inline">
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="active" ><i class="fa fa-th" aria-hidden="true"></i></a>
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-list.php';?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                    </div> -->
                                </div>
                            </div>
                            
                        </div>
                    
                            
                        <div class="row no-margin ">
                            
                            <?php
                            //$ca = new _categories
                            $au = new _productposting;
                            $p = new _postingview;
                            if(isset($_GET['friend']) && $_GET['friend'] >0){
                                //seller store if user wants to show
                                $result3 = $p->singlefriendstore($_GET['friend']);
                            }if(isset($_POST['txtStoreSearch'])){
                                // print_r("comming ");
                                // exit;
                                $txtSearchCategory  = $_POST['txtSearchCategory'];
                                $txtStoreSearch   = $_POST['txtStoreSearch'];
                                $result3 = $au->search_store("Retail", 1, $txtStoreSearch);
                              

                            } else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {

                               $result3 = $au->readDESCauctionsort(1,$_SESSION['pid']);      

                               //echo $au->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $result3 = $au->readASCauctionsort(1,$_SESSION['pid']);

                                // echo $p->ta->sql;

                               }else if(isset($_GET['type']) && $_GET['type'] !=  ''){

                                $result3 = $au->auction($_GET['type'], $_SESSION['uid'],$_SESSION['pid']);

                            } else if(isset($_GET['condition']) && $_GET['condition'] !=  ''){
                           if ($_GET['folder'] ==  'retail') {

                                // print_r("coming");
                                // exit;
                               if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];
                                         $exp = date('Y-m-d h:i:s');
                                         if($_GET['condition'] == 'All'){
                                             $result3 = $au->myretailall_store_prange($txtStartPrice, $txtEndPrice,$exp);
                                         }else{
                                           $result3 = $au->myretail_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice,$exp);
                                         }

                                       
                                   //echo $au->ta->sql;

                                }else if($_GET['condition'] == 'All'){
                                
                             $result3 = $au->allretailproduct(1,$_SESSION['pid']);

                              // echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'New'){


                             $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                             //echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Has Defect'){
                                    $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                            } else if($_GET['condition'] == 'Antique'){
                                  $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                            } else if($_GET['condition'] == 'Unused'){
                                   $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);
                                }
                                else if($_GET['condition'] == 'Old'){
                                  $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                          //  echo $au->ta->sql;
                                }
                             }else if ($_GET['folder'] == 'store') {
                                     
                                //left module vise filter
                               if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];
                                         $exp = date('Y-m-d h:i:s');
                                         if($_GET['condition'] == 'All'){
                                             $result3 = $au->myauctionall_store_prange($txtStartPrice, $txtEndPrice,$exp);
                                         }else{
                                           $result3 = $au->myauction_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice,$exp);
                                         }

                                       
                                   //echo $au->ta->sql;

                                }else if($_GET['condition'] == 'All'){
                             $result3 = $au->readitemauction_product('Auction',$_SESSION['pid']);

                           //echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'New'){
                             $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                             //echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Has Defect'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                            // echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Antique'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                           //  echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Unused'){
                                   $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                           //  echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'Old'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                            // echo $au->ta->sql;
                                }
                                
                            }   
                            }else if(isset($_GET['mod']) && $_GET['mod'] !=  ''){
                                //left module vise filter
                                if($_GET['mod'] == 'retail'){
                                    $result3 = $p->retailpost(1);
                                }else if($_GET['mod'] == 'wholesale'){
                                    $result3 = $p->allwholesellpost();
                                }else if($_GET['mod'] == 'manufacturer'){
                                    $result3 = $p->manufacturePost();
                                }else if($_GET['mod'] == 'distributor'){
                                    $result3 = $p->distributorPost();
                                }
                                else if($_GET['mod'] == 'personal'){
                                    $result3 = $p->personalSalePost();
                                }
                                
                            }else{
                                if(isset($_GET['friendlevel']) && $_GET['friendlevel'] > 0){
                                    
                                    if($_GET['friendlevel'] == 1){
                                        $result5 = $pr->frndLevelone($_SESSION['pid']);
                                        $levelpass = "1st Degree";
                                    }else if($_GET['friendlevel'] == 2){
                                        $result5 = $pr->frndLevelScnd($_SESSION['pid']);
                                        $levelpass = "2nd Degree";
                                    }else if($_GET['friendlevel'] == 3){
                                        $result5 = $pr->frndLevelThird($_SESSION['pid']);
                                        $levelpass = "3rd Degree";
                                    }

                                    if($result5){
                                        foreach ($result5 as $key => $value5) {
                                            if($_SESSION['pid'] != $value5){
                                                friendlevel($value5, $BaseUrl, $folder, $levelpass);
                                            }
                                            
                                        }
                                    }
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                  //my store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_my_post($SelectTitle, $_SESSION['uid']);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->myall_store_order_by($_SESSION['uid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->myall_store_condition($_SESSION['uid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->myall_store_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->myall_store_country($_SESSION['uid'], $_GET['country']);
                                    }else{
                                        $result3 = $p->myall_store($_SESSION['uid']);
                                    }
                                  
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                  //friend store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_store_friends_Posting($SelectTitle, $_SESSION['uid']);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->store_friends_Posting_order_by($_SESSION['uid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->store_friends_Posting_condition($_SESSION['uid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->store_friends_Posting_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->store_friends_Posting_country($_SESSION['uid'], $_GET['country']);
                                    }else{
                                        $result3 = $p->store_friends_Posting($_SESSION['uid']);
                                    }
                                  
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                    //group post
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_group_main_Posting($SelectTitle, $_SESSION['pid']); 
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->all_group_store_order_by($_SESSION['pid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->all_group_store_condition($_SESSION['pid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->all_group_store_prange($_SESSION['pid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->all_group_store_country($_SESSION['pid'], $_GET['country']);
                                    }else{
                                        $result3 = $p->all_group_store($_SESSION['pid']);
                                    }
                                  
                                }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                    //retail store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_retail_store($SelectTitle);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->retailpost_order_by($_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->retailpost_condition($_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->retailpost_prange($txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->retailpost_country($_GET['country']);
                                    }else{
                                        $result3 = $p->retailpost(1);
                                    }
                                    
                                }else{
                                    //public store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_publicpost($SelectTitle);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->publicpost_price($_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->publicpost_condition($_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->publicpost_prange($txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->publicpost_country($_GET['country']);
                                    }else{
                                        $result3 = $p->publicpost(isset($start), 1);
                                    }
                                }
                            } 
                         /*   function friendlevel($value, $BaseUrl, $folder, $levelpass){
                                $p = new _postingview;
                                //$result3 = $p->store_friends_Posting($value);
                                $result3 = $p->singlefriendstore($value);
                                //echo $p->ta->sql;
                                if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $dt = new DateTime($row3['spPostingDate']);
                                        
                                        
                                        ?>
                                        <div class="col-xs-5ths col-md-4">
                                            <div class="featured_box text-center subcategory_box">

                                                <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
                                                    
                                                    <?php
                                                    $pic = new _postingpic;
                                                    //$pic = new _productpic;
                                                    $result4 = $pic->read($row3['idspPostings']);
                                                    //echo $pic->ta->sql;
                                                    if ($row3['idspCategory'] != 5 && $row3['idspCategory'] != 2) {
                                                        if ($result4 != false) {
                                                            if(mysqli_num_rows($result4) > 0){
                                                                $rp = mysqli_fetch_assoc($result4);
                                                                $picture = $rp['spPostingPic'];
                                                                
                                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                            }
                                                        } else{
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                        }
                                                    }else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }
                                                    ?>
                                                    
                                                </a>
                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                                <?php
                                                if(!empty($row3['spPostingTitle'])){
                                                    if(strlen($row3['spPostingTitle']) < 15){
                                                        ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a></h4><?php
                                                        
                                                    }else{
                                                        ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr(ucwords(strtolower($row3['spPostingtitle'])), 0,15).'...'; ?></a></h4><?php
                                                    }
                                                }else{
                                                    echo "<h4>&nbsp;</h4>";
                                                } ?>
                                              </li>
                                              <li>
                                                <h5 >
                                                    <?php
                                                    if ($row3['spPostingPrice'] != false) {
                                                        echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                    }else{
                                                        echo "Expires on ".$row3['spPostingExpDt'];
                                                    }
                                                      ?>
                                                </h5>
                                              </li>
                                            </ul>
                                               <!--  <h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$row3['idspProfiles']?>"><?php echo ucwords(strtolower($row3['spProfileName']));?></a></h6> -->
                                                <!-- <h6 class="name"><?php echo ucwords(strtolower($row3['spProfileName']));?></h6> -->
                                                <!-- <span><?php echo $levelpass;?></span>
                                                <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p> -->
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }*/

                            ?>
                            <div class="heading03">
                                <h3><?php 
                                if(isset($_GET['catName'])){
                                    echo $SelectTitle;
                                }else if(isset($_GET['friendlevel'])){
                                    if($_GET['friendlevel'] == 1){
                                        echo "1st Level Friends Products";
                                    }else if($_GET['friendlevel'] == 2){
                                        echo "2nd Level Friends Products";
                                    }else if($_GET['friendlevel'] == 3){
                                        echo "3rd Level Friends Products";
                                    }else{
                                        header('location:'.$BaseUrl.'/'.$folder);
                                    }
                                    
                                }else{
                                    if (isset($_POST['txtStoreSearch']) && $_POST['txtStoreSearch'] !='') {
                                        echo $result3->num_rows." results found for ".$_POST['txtStoreSearch'];
                                    } else {
                                        echo $result3->num_rows." results found";
                                    }
                                }
                                ?></h3>
                            </div>
                            <?php 
                            //echo $au->ta->sql;
                            if ($result3) {

                              $auction_store = $result3->num_rows;
                             // print_r($auction_store);
                                  ?>
								  <div class="list-wrapper">
                                  <?php
                               $active = 0;
                                while ($row3 = mysqli_fetch_assoc($result3)) {

                                  // $postingexpire = $row3['spPostingExpDt'];

                                    $dt = new DateTime($row3['spPostingDate']);                                    
                                    ?>
                                 <!-- <div class="item <?php echo ($active >= 15)?'seeproduct':'';?>"> -->
                                  <div class="list-item">
                                    <div class="col-xs-5ths col-md-4">
                                        <div class="featured_box text-center subcategory_box">

                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
                                                
                                                <?php
                                                $pic = new _productpic;
                                                $result4 = $pic->read($row3['idspPostings']);
                                                //echo $pic->ta->sql;
                                            if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
                                                    if ($result4 != false) {
                                                        if(mysqli_num_rows($result4) > 0){
                                                            $rp = mysqli_fetch_assoc($result4);
                                                            $picture = $rp['spPostingPic'];
                                                            
                                                            echo "<img style='border-top-left-radius: 17px;
    border-top-right-radius: 17px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        }
                                                    } else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                }
                                                ?>
                                                
                                            </a>
                                            <ul style="padding-left: 10px;display: grid;">
                                            <li>
                                            <?php
                                            if($_SESSION['pid'] != $rows['idspProfiles']){
                                        
                                                $result6 = $pr->frndLeevel($_SESSION['pid'], $row3['idspProfiles']);
                                                //echo $pr->ta->sql;
                                                //echo $result3;
                                                if($result6 == 0){
                                                  $level = '1st Degree';
                                                }else if($result6 == 1){
                                                  $level = '1st Degree';
                                                }else if($result6 == 2){
                                                  $level = '2nd Degree';
                                                }else if($result6 == 3){
                                                  $level = '3rd Degree';
                                                }else{
                                                  $level = 'Not Defined';
                                                }
                                            }else{
                                                $level = '1st Degree';
                                            }

                                            if(!empty($row3['spPostingTitle'])){
                                                if(strlen($row3['spPostingTitle']) < 15){
                                                    ?><h4 style="background-color: unset;float: left;padding: 0px;"><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>"  style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst($row3['spPostingTitle']); ?></a></h4><?php
                                                    
                                                }else{
                                                    ?><h4 style="background-color: unset;float: left;padding: 0px;"><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>"  style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst(substr($row3['spPostingTitle'], 0,15).'...') ; ?></a></h4><?php
                                                }
                                            }else{
                                                echo "<h4>&nbsp;</h4>";
                                            } ?>
                                            </li>
                                              <li>
                                            <h5 style="float: left;">
                                                <?php
                                                if ($row3['spPostingPrice'] != false) {
                                                    echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                }else{
                                                   // echo "Expires on ".$row3['spPostingExpDt'];
                                                }
                                                  ?>
                                            </h5>
                                          </li>
                                      
					                                            <p class="date"></p>

					<input type="hidden" id="auctionexpid<?php echo $row3['idspPostings']?>" value="<?php echo $row3['idspPostings']?>">

					<input type="hidden" id="auctionexp<?php echo $row3['idspPostings']?>" value="<?php echo $row3['spPostingExpDt']?>">

					  <script type="text/javascript">

					$(document).ready(function(){
					  // we call the function
					   get_auctionexpdata("<?php echo $row3['idspPostings'];?>");

					 
					   });
					</script>   
					<li>
					<span style="float: left;" id="auction_enddate<?php echo $row3['idspPostings']?>"></span>     
					</li>
					</ul>
                                        </div>
                                    </div>
                                  </div>
                                    <?php
                                     /* $active++;*/

                                    } /*if($auction_store >= 15){ */
                                    ?>
                            <!--  <center><a class="loadpost" id="fold_p">SEE MORE</a></center> -->
                            </div>
							<div id="pagination-container"></div>
                          <?php /*}*/
                           }else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  } ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

 <script type="text/javascript">
          
          $(document).ready(function(){

/*    // Load more data
    $('.loadpost').click(function(){

$(".seeproduct").show();
$(".loadpost").hide();



   });*/
          });
        </script>


        <script type="text/javascript">
          
 function get_auctionexpdata(id){

   
var auction_exp = $("#auctionexp"+id).val()

  // alert(auction_exp);
//if(selltype == "Auction"){

  var countDownDate = new Date(auction_exp).getTime();

 
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
    


if(days > 0 && hours > 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours > 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML =  minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =   minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =   minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =   seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =  seconds + "s ";

}

  // Output the result in an element with id="demo"



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
    document.getElementById("auction_enddate"+id).innerHTML = "EXPIRED";
  }
}, 1000);


//alert(auction_exp);



  }
        </script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
		<script>
		// j http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 10;

    items.slice(perPage).hide();

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
		
    </body>
</html>
<?php
}
?>