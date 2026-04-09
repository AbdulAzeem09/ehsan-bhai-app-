<?php
   /*error_reporting(E_ALL);
   ini_set('display_errors', '1');*/
   
   include('../univ/baseurl.php');
   session_start();
   if (!isset($_SESSION['pid'])) {
   $_SESSION['afterlogin'] = "my-groups/";
   include_once("../authentication/check.php");
   } else {
   function sp_autoloader($class)
   {
   include '../mlayer/' . $class . '.class.php';
   }
   spl_autoload_register("sp_autoloader");
   ?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <?php include('../component/f_links.php'); ?>
      <?php include('store_headpart.php') ?>
      <style>
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
         color: #28bd68;
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
         background-color: #28bd68;
         border-color: #28bd68;
         }
         .simple-pagination .prev.current,
         .simple-pagination .next.current {
         background: #0f8f46;
         }
         .dropdown-toggle::after {
         content: none;
         }
         .form-select {
         font-size:1.5rem!important;
         }
         .form-control {
         font-size:1.5rem!important;
         }
         .form-control-btn {
         font-size:1.5rem!important;
         }
         .input-group .btn {
         font-size:1.5rem!important;
         }
      </style>
   </head>
   <body class="bg_gray">
      <?php
         $header_store = "header_store";
         include_once("../header.php");
         ?>
      <style>
         .inner_top_form button {
         padding: 9px 12px !important;
         }
      </style>
      <div class="wrapper d-flex align-items-stretch">
         <nav id="leftsidebar" class="active">
            <div class="custom-menu">
               <button type="button" id="leftsidebarCollapse" class="btn btn-primary">
               <i class="fa fa-bars"></i>
               <span class="sr-only">Toggle Menu</span>
               </button>
            </div>
            <div class="p-4">
               <h1>Categories</h1>
               <?php include('../component/left-storecategory.php'); ?>
            </div>
         </nav>
         <!-- Page Content p-4 p-md-5 pt-5 -->
         <div id="rightcontent" class="">
            <section class="main_box">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <?php
                           include('top-dashboard.php');
                           ?>	
                        <div class="breadcrumb_box m_btm_10 rounded shadow">
                           <div class="row d-flex justify-conent-between">
                              <div class="col-md-8 mt-3">
                                 <form method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;">
                                    <div class="input-group ">
                                       <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
                                       <input type="text" class="form-control" name="txtStoreSearch" value="<?php if (isset($_POST['txtStoreSearch'])) {
                                          echo $_POST['txtStoreSearch'];
                                          } ?>" placeholder="Search For Products" required />
                                       <button type="submit" class="btn btn-primary" name="btnSearchStore">
                                       <i class="fa fa-search"></i>
                                       </button>
                                       <a href="<?php echo $BaseUrl ?>/store/personal.php" class="btn">Reset</a>
                                       <!-- <button type="button" class="btn" href="<?php echo $BaseUrl ?>/store/storeindex.php?folder=home">Reset</button>   -->
                                    </div>
                                 </form>
                              </div>
                              <div class="col-md-4 mt-3">
                                 <div class="d-flex justify-content-between mx-3">
                                    <?php if ($profileType != '2' && $profileType != '5') { ?>
                                    <!-- <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn btn-warning sell"> 
                                       Sell Product
                                       </a> -->
                                    <?php } ?>
                                    <form id="price_form" method="POST" action="<?php echo $BaseUrl . '/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;display:inline;">
                                       <?php if ($profileType != '2' && $profileType != '5') {
                                          $priceWidth = "165px";
                                          } else {
                                          $priceWidth = "50%";
                                          }
                                          ?>
                                       <select class="form-select" id="dynamic_price"  name="pricedropdown">
                                          <option value="">Select Price Order</option>
                                          <option value="Asc" <?php if ($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
                                          <option value="Desc" <?php if ($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
                                       </select>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Bread Crum_Box End -->
                        <div class="row no-margin ">
                           <?php
                              $au = new _productposting;
                              $p = new _postingview;
                              if (isset($_GET['friend']) && $_GET['friend'] > 0) {
                              $result3 = $p->singlefriendstore($_GET['friend']);
                              }
                              if (isset($_POST['txtStoreSearch'])) {
                              $txtSearchCategory  = $_POST['txtSearchCategory'];
                              $txtStoreSearch   = $_POST['txtStoreSearch'];
                              $result3 = $au->search_personal("Personal", 1, $txtStoreSearch);
                              } else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc') {
                              $result3 = $au->readDESCretailsort_p(1, $_SESSION['pid']);
                              } else if (isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc') {
                              $result3 = $au->readASCretailsort_p(1, $_SESSION['pid']);
                              } else if (isset($_GET['type']) && $_GET['type'] !=  '') {
                              $result3 = $au->auction($_GET['type'], $_SESSION['uid'], $_SESSION['pid']);
                              } else if (isset($_GET['condition']) && $_GET['condition'] !=  '') {
                              if ($_GET['folder'] ==  'retail') {
                              if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $exp = date('Y-m-d h:i:s');
                              if ($_GET['condition'] == 'All') {
                              $result3 = $au->myretailall_store_prange($txtStartPrice, $txtEndPrice, $exp);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else {
                              $result3 = $au->myretail_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice, $exp);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              }
                              } else if ($_GET['condition'] == 'All') {
                              if ($_GET['page'] == 1) {
                              $start = 0;
                              } else {
                              $sss = $_GET['page'] - 1;
                              $start = 24 * $sss;
                              }
                              $limitaa = 24;
                              $r3 = $au->allretailproductnumrows(1, $_SESSION['pid']);
                              if ($r3 != '') {
                              }
                              $result3 = $au->allretailproduct(1, $_SESSION['pid'], $start, $limitaa);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else if ($_GET['condition'] == 'New') {
                              $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else if ($_GET['condition'] == 'Has Defect') {
                              $condit = 'Used and has Defect';
                              $result3 = $au->readitemcondtion_product($_GET['folder'], $condit, $_SESSION['pid']);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else if ($_GET['condition'] == 'Antique') {
                              $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else if ($_GET['condition'] == 'Unused') {
                              $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              } else if ($_GET['condition'] == 'Old') {
                              $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'], $_SESSION['pid']);
                              if ($result3 != '') {
                              $num_rows = $result3->num_rows;
                              }
                              }
                              } else if ($_GET['folder'] == 'store') {
                              if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $exp = date('Y-m-d h:i:s');
                              if ($_GET['condition'] == 'All') {
                              $result3 = $au->myauctionall_store_prange($txtStartPrice, $txtEndPrice, $exp);
                              } else {
                              $result3 = $au->myauction_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice, $exp);
                              }
                              } else if ($_GET['condition'] == 'All') {
                              $result3 = $p->publicpost_all();
                              } else if ($_GET['condition'] == 'New') {
                              $result3 = $au->readitemcondtion_storeproduct($_GET['condition']);
                              } else if ($_GET['condition'] == 'Has Defect') {
                              $result3 = $au->readitemcondtion_storeproduct($_GET['condition']);
                              } else if ($_GET['condition'] == 'Antique') {
                              $result3 = $au->readitemcondtion_storeproduct($_GET['condition']);
                              } else if ($_GET['condition'] == 'Unused') {
                              $result3 = $au->readitemcondtion_storeproduct($_GET['condition']);
                              } else if ($_GET['condition'] == 'Old') {
                              $result3 = $au->readitemcondtion_storeproduct($_GET['condition']);
                              }
                              }
                              } else if (isset($_GET['mod']) && $_GET['mod'] !=  '') {
                              if ($_GET['mod'] == 'retail') {
                              $result3 = $p->retailpost(1);
                              } else if ($_GET['mod'] == 'wholesale') {
                              $result3 = $p->allwholesellpost();
                              } else if ($_GET['mod'] == 'manufacturer') {
                              $result3 = $p->manufacturePost();
                              } else if ($_GET['mod'] == 'distributor') {
                              $result3 = $p->distributorPost();
                              } else if ($_GET['mod'] == 'personal') {
                              $result3 = $p->personalSalePost();
                              }
                              } else {
                              if (isset($_GET['friendlevel']) && $_GET['friendlevel'] > 0) {
                              if ($_GET['friendlevel'] == 1) {
                              $result5 = $pr->frndLevelone($_SESSION['pid']);
                              $levelpass = "1st Degree";
                              } else if ($_GET['friendlevel'] == 2) {
                              $result5 = $pr->frndLevelScnd($_SESSION['pid']);
                              $levelpass = "2nd Degree";
                              } else if ($_GET['friendlevel'] == 3) {
                              $result5 = $pr->frndLevelThird($_SESSION['pid']);
                              $levelpass = "3rd Degree";
                              }
                              if ($result5) {
                              foreach ($result5 as $key => $value5) {
                              if ($_SESSION['pid'] != $value5) {
                              friendlevel($value5, $BaseUrl, $folder, $levelpass);
                              }
                              }
                              }
                              } else if (isset($_GET['mystore']) && $_GET['mystore'] == 6) {
                              //my store
                              if (isset($_GET['catName'])) {
                              $result3 = $p->single_my_post($SelectTitle, $_SESSION['uid']);
                              } else if (isset($_GET['orderby'])) {
                              $result3 = $p->myall_store_order_by($_SESSION['uid'], $_GET['orderby']);
                              } else if (isset($_GET['condition'])) {
                              $result3 = $p->myall_store_condition($_SESSION['uid'], $_GET['condition']);
                              } else if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $result3 = $p->myall_store_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                              } else if (isset($_GET['country'])) {
                              $result3 = $p->myall_store_country($_SESSION['uid'], $_GET['country']);
                              } else {
                              $result3 = $p->myall_store($_SESSION['uid']);
                              }
                              } else if (isset($_GET["mystore"]) && $_GET["mystore"] == 4) {
                              //friend store
                              if (isset($_GET['catName'])) {
                              $result3 = $p->single_store_friends_Posting($SelectTitle, $_SESSION['uid']);
                              } else if (isset($_GET['orderby'])) {
                              $result3 = $p->store_friends_Posting_order_by($_SESSION['uid'], $_GET['orderby']);
                              } else if (isset($_GET['condition'])) {
                              $result3 = $p->store_friends_Posting_condition($_SESSION['uid'], $_GET['condition']);
                              } else if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $result3 = $p->store_friends_Posting_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                              } else if (isset($_GET['country'])) {
                              $result3 = $p->store_friends_Posting_country($_SESSION['uid'], $_GET['country']);
                              } else {
                              $result3 = $p->store_friends_Posting($_SESSION['uid']);
                              }
                              } else if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {
                              //group post
                              if (isset($_GET['catName'])) {
                              $result3 = $p->single_group_main_Posting($SelectTitle, $_SESSION['pid']);
                              } else if (isset($_GET['orderby'])) {
                              $result3 = $p->all_group_store_order_by($_SESSION['pid'], $_GET['orderby']);
                              } else if (isset($_GET['condition'])) {
                              $result3 = $p->all_group_store_condition($_SESSION['pid'], $_GET['condition']);
                              } else if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $result3 = $p->all_group_store_prange($_SESSION['pid'], $txtStartPrice, $txtEndPrice);
                              } else if (isset($_GET['country'])) {
                              $result3 = $p->all_group_store_country($_SESSION['pid'], $_GET['country']);
                              } else {
                              $result3 = $p->all_group_store($_SESSION['pid']);
                              }
                              } else if (isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2) {
                              //retail store
                              if (isset($_GET['catName'])) {
                              $result3 = $p->single_retail_store($SelectTitle);
                              } else if (isset($_GET['orderby'])) {
                              $result3 = $p->retailpost_order_by($_GET['orderby']);
                              } else if (isset($_GET['condition'])) {
                              //die('cc');
                              $result3 = $p->retailpost_condition($_GET['condition']);
                              } else if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $result3 = $p->retailpost_prange($txtStartPrice, $txtEndPrice);
                              } else if (isset($_GET['country'])) {
                              $result3 = $p->retailpost_country($_GET['country']);
                              } else {
                              $result3 = $p->retailpost(1);
                              }
                              } else {
                              //public store
                              if (isset($_GET['catName'])) {
                              $result3 = $p->single_publicpost($SelectTitle);
                              } else if (isset($_GET['orderby'])) {
                              $result3 = $p->publicpost_price($_GET['orderby']);
                              } else if (isset($_GET['condition'])) {
                              //die('==');
                              $result3 = $p->publicpost_condition($_GET['condition']);
                              } else if (isset($_POST['btnPriceRange'])) {
                              $txtStartPrice = $_POST['txtStartPrice'];
                              $txtEndPrice = $_POST['txtEndPrice'];
                              $result3 = $p->publicpost_prange($txtStartPrice, $txtEndPrice);
                              } else if (isset($_GET['country'])) {
                              $result3 = $p->publicpost_country($_GET['country']);
                              } else {
                              //echo $start;
                              if ($_GET['page'] == 1) {
                              $start = 0;
                              } else {
                              $sss = $_GET['page'] - 1;
                              $start = 10 * $sss;
                              }
                              $limitaa = 10;
                              
                              $result3 = $p->personal_all($start, $limitaa);
                              }
                              }
                              }
                              
                              $num_rows = $result3->num_rows;
                              
                              
                              ?>
                           <div class="heading03">
                              <h3><?php
                                 $userid = $_SESSION['uid'];
                                 $c = new _orderSuccess;
                                 $currency = $c->readcurrency($userid);
                                 $res1 = mysqli_fetch_assoc($currency);
                                 //print_r($result3); die("s");
                                 if (isset($_GET['catName'])) {
                                 //die('======');
                                 echo $SelectTitle;
                                 } else if (isset($_GET['friendlevel'])) {
                                 if ($_GET['friendlevel'] == 1) {
                                 echo "1st Level Friends Products";
                                 } else if ($_GET['friendlevel'] == 2) {
                                 echo "2nd Level Friends Products";
                                 } else if ($_GET['friendlevel'] == 3) {
                                 echo "3rd Level Friends Products";
                                 } else {
                                 header('location:' . $BaseUrl . '/' . $folder);
                                 }
                                 } else {
                                 //die('====');
                                 $aa = $result3->num_rows;
                                 if (isset($_POST['txtStoreSearch']) && $_POST['txtStoreSearch'] != '') {
                                 echo $result3->num_rows . " results found for " . $_POST['txtStoreSearch'];
                                 } else {
                                 //echo $account_status;
                                 //die('==');
                                 
                                 if ($account_status!=1) {
                                 if($result3->num_rows>0){
                                 if($num_rows){
                                 echo $num_rows." results found";
                                 }else{
                                 echo $num_rows." Personal";
                                 }
                                 }}
                                 else{
                                 echo " 0 results found ";
                                 }
                                 }
                                 }
                                 ?></h3>
                           </div>
                           <?php
                              if ($account_status == 1) {
                              if ($aa) {
                              echo $aa . " results found";
                              }
                              } else {
                              //echo "0 results found";
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
                        <div class="item list-wrapper">
                           <?php
                              $active = 0;
                              while ($row3 = mysqli_fetch_assoc($result3)) {
                              //print_r($row3);
                              //die('==');
                              if ($row3['spuser_idspuser'] != NULL) {
                              $st = new _spuser;
                              $st1 = $st->readdatabybuyerid($row3['spuser_idspuser']);
                              if ($st1 != false) {
                              $stt = mysqli_fetch_assoc($st1);
                              $account_status = $stt['deactivate_status'];
                              }
                              //die('22');
                              }
                              // $postingexpire = $row3['spPostingExpDt'];
                              $price = $row3['spPostingPrice'];
                              $default_currency = $row3['default_currency'];
                              if ($row3['sellType'] == 'Personal') {
                              if ($row3['retailQuantity'] != '') {
                              $discount   = $row3['retailQuantity'];
                              } else {
                              $discount   = $row3['retailQuantity'];
                              }
                              }
                              if ($row3['sellType'] == 'Wholesaler') {
                              $discount   = $row3['spPostingPrice'];
                              }
                              /// echo $special_discount;
                              $spec_dis = (((int)$price * (int)$discount) / 100);
                              $disc_price = $price - $spec_dis;
                              $dt = new DateTime($row3['spPostingDate']);
                              ?>
                           <!-- <div class="item <?php echo ($active >= 15) ? 'seeproduct' : ''; ?>"> -->
                           <?php if ($account_status != 1) { ?>
                           <div class="col-xs-5ths list-item1">
                              <div class="featured_box text-center subcategory_box1 zoom1">
                                 <div class="img_fe_box" >
                                    <a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?>">
                                    <?php
                                       $pic = new _productpic;
                                       $result4 = $pic->read($row3['idspPostings']);
                                       //echo $pic->ta->sql;
                                       if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
                                       if ($result4 != false) {
                                       if (mysqli_num_rows($result4) > 0) {
                                       $rp = mysqli_fetch_assoc($result4);
                                       $picture = $rp['spPostingPic'];
                                       echo "<img  alt='Posting Pic' style='height: 100%; width: 100%;' class='img-fluid' src=' " . ($picture) . "' > ";
                                       }
                                       } else {
                                       echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-fluid'>";
                                       }
                                       } else {
                                       echo "<img alt='Posting Pic' style='height: 100%; width: 100%;' src='../assets/images/blank-img/no-store.png' class='img-fluid'>";
                                       }
                                       ?>
                                    </a>
                                 </div>
                                 <ul class="d-flex flex-column float-start ">
                                    <li class="float-start fs-3">
                                       <?php
                                          if ($_SESSION['pid'] != $rows['idspProfiles']) {																
                                          } else {
                                          $level = '1st Degree';
                                          }
                                          if (!empty($row3['spPostingTitle'])) {
                                          if (strlen($row3['spPostingTitle']) < 10) {
                                          ?>
                                       <h2 style="text-align: start; margin:0px;"><a   href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst($row3['spPostingTitle']); ?></a></h2>
                                       <?php
                                          } else {
                                          ?>
                                       <h2 style="text-align: start; margin:0px;"><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $row3['idspPostings']; ?> "  data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst(substr($row3['spPostingTitle'], 0, 15) . '...'); ?></a></h2>
                                       <?php
                                          }
                                          } else {
                                          } ?>
                                    </li>
                                    <li class="float-start fs-3" style="text-align:start;">
                                       <?php
                                          $curr = $row3['default_currency'];
                                          $price = $row3['spPostingPrice'];
                                          if ($row3['spPostingPrice'] != '') {
                                          $curr = $row3['default_currency'];
                                          $price = $row3['spPostingPrice'];
                                          $discount   = $row3['retailSpecDiscount'];
                                          if ($row3['sellType'] == 'personal') {
                                          if ($row3['retailSpecDiscount'] != '') {
                                          $discount   = $row3['retailSpecDiscount'];
                                          } else {
                                          $discount   = $row3['spPostingPrice'];
                                          }
                                          }
                                          echo $curr . ' ' . $discount;
                                          if (($discount != '') && ($row3['sellType'] == "Retail")) {
                                          if ($price != $discount) {
                                          echo $curr.' '.$discount; 
                                          ?> &nbsp; <strong class="text-success fw-bold float-start" style="color:green;"><?php echo $curr . ' ' . $price; ?></strong>
                                       <?php
                                          }
                                          } else {
                                          ?> &nbsp; <strong class="text-danger text-decoration-line-through"><?php echo $curr . ' ' . $price; ?></strong>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </li>
                                    <li class="float-start">
                                       <?php
                                          $c = new _spproduct_review;
                                          $available = $row3['supplyability'];
                                          $idposting_new = $row3['idspPostings'];
                                          $product = $c->read_product($idposting_new);
                                          $rows1 = mysqli_fetch_array($product);
                                          $retail1 = $rows1['retailQuantity'];
                                          if ($retail1 <= 0) {
                                          echo "<span style='float:left; color:red;font-size:15px;'><b>Out of Stock</b></span>";
                                          } else {
                                          echo "<span style='float:left;  color:green;font-size:15px;'><b>In Stock</b></span>";
                                          }
                                          ?>
                                    </li>
                                    <p class="date"></p>
                                    <input type="hidden" id="auctionexpid<?php echo $row3['idspPostings'] ?>" value="<?php echo $row3['idspPostings'] ?>">
                                    <input type="hidden" id="auctionexp<?php echo $row3['idspPostings'] ?>" value="<?php echo $row3['spPostingExpDt'] ?>">
                                    <script type="text/javascript">
                                       $(document).ready(function() {
                                       // we call the function
                                       get_auctionexpdata("<?php echo $row3['idspPostings']; ?>");
                                       });
                                    </script>
                                    <?php
                                       if ($_GET['folder'] == "retail") {
                                       if ($row3['retailQuantity'] > 0) { ?>
                                    <span style="color:green"><b>Available</b></span>
                                    <?php } else {  ?>
                                    <span style="color:red"><b>Out Of Stock</b></span>
                                    <?php }
                                       } ?>
                                 </ul>
                              </div>
                           </div>
                           <?php }
                              } 
                              ?>
                        </div>
                        <div id="pagination-container"></div>
                     </div>
                     <br>
                     <div class="row" style="height:60px;">
                        <div class="col-md-6" style="height:50px;">
                           <?php 
                              if ($_GET['page'] != "1") { ?>
                           <a class=" btn btn-success btn-lg sell btn-border-radius " style="margin-left:40px;" href="<?php echo $BaseUrl . '//store/personal.php?page=' . $_GET['page'] - 1; ?>">Previous</a> 
                        </div>
                        <?php  } ?>
                        <div class="col-md-6" >
                           <?php if ($num_rows == "24") { ?>
                           <a class="float-right  btn btn-success btn-lg sell btn-border-radius" style="margin-right:40px;" href="<?php echo $BaseUrl . '/store/personal.php?&page=' . $_GET['page'] + 1; ?>">Next</a>
                           <?php  } ?>
                        </div>
                        <?php
                           } else {
                           echo "<h4 class='text-center'>No Record Found</h4>";
                           } ?>
                     </div>
                  </div>
               </div>
         </div>
      </div>
      </section>
      </div>
      <?php
         include('../component/f_footer.php');
         include('../component/f_btm_script.php');
         ?>
      <!--Javascript-->
      <!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script> -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
      <script type="text/javascript">
         $(document).ready(function() {
         
         });
      </script>
      <script type="text/javascript">
         function get_auctionexpdata(id) {
         var auction_exp = $("#auctionexp" + id).val()
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
         if (days > 0 && hours > 0 && minutes > 0 && seconds > 0) {
         document.getElementById("auction_enddate" + id).innerHTML = days + "d " + hours + "h " +
         minutes + "m " + seconds + "s ";
         document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h " +
         minutes + "m " + seconds + "s ";
         document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h " +
         minutes + "m " + seconds + "s ";
         } else if (days <= 0 && hours > 0 && minutes > 0 && seconds > 0) {
         document.getElementById("auction_enddate" + id).innerHTML = hours + "h " +
         minutes + "m " + seconds + "s ";
         document.getElementById("oldbidtime").innerHTML = hours + "h " +
         minutes + "m " + seconds + "s ";
         document.getElementById("lowbidtime").innerHTML = hours + "h " +
         minutes + "m " + seconds + "s ";
         } else if (days <= 0 && hours <= 0 && minutes > 0 && seconds > 0) {
         document.getElementById("auction_enddate" + id).innerHTML = minutes + "m " + seconds + "s ";
         document.getElementById("oldbidtime").innerHTML = minutes + "m " + seconds + "s ";
         document.getElementById("lowbidtime").innerHTML = minutes + "m " + seconds + "s ";
         } else if (days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0) {
         document.getElementById("auction_enddate" + id).innerHTML = seconds + "s ";
         document.getElementById("oldbidtime").innerHTML = seconds + "s ";
         document.getElementById("lowbidtime").innerHTML = seconds + "s ";
         }
         // Output the result in an element with id="demo"
         if (days == 0 && hours == 0 && minutes <= 5) {
         $('#auction_end').show();
         $('#AuctionPrice').hide();
         $('.placebidAuction').hide();
         $('#bidmsg').hide();
         /*alert();*/
         }
         // If the count down is over, write some text 
         if (distance < 0) {
         clearInterval(x);
         document.getElementById("auction_enddate" + id).innerHTML = "EXPIRED";
         }
         }, 1000);
         //alert(auction_exp);
         }
      </script>
      <script type="text/javascript">
         //USER ONE
         $(function() {
         $('#leftmenu').multiselect({
         includeSelectAllOption: true
         });
         });
      </script>
      <script>
         $(function() {
         // bind change event to select
         $('#dynamic_select').on('change', function() {
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
      <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
      <script>
         function execute(settings) {
         $('#sidebar').hcSticky(settings);
         }
         // if page called directly
         jQuery(document).ready(function($) {
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
         jQuery(document).ready(function($) {
         if (top === self) {
         execute_right({
         top: 20,
         bottom: 50
         });
         }
         });
         $(function() {
         $("#dynamic_price").on('change', function() {
         // alert('hello');
         $("#price_form").submit();
         return true;
         });
         });
      </script>
      <script>
         (function ($) {
         "use strict";
         var fullHeight = function () {
         $(".js-fullheight").css("height", $(window).height());
         $(window).resize(function () {
         $(".js-fullheight").css("height", $(window).height());
         });
         };
         fullHeight();
         $("#leftsidebarCollapse").on("click", function () {
         $("#leftsidebar").toggleClass("active");
         });
         })(jQuery);
      </script>
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js "></script>
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js "></script>
      <script>
         // jQuery Plugin:  http://flaviusmatis.github.io/simplePagination.js/ 
         
         var items = $(".list-wrapper .list-item");
         var numItems = items.length;
         var perPage = 12;
         
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
   </body>
</html>
<?php
   //print_r($_GET);
   //die('===');
   ?>