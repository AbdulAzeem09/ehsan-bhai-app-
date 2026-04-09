
<?php

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
  $_SESSION['afterlogin']="store/";
  include_once ("../authentication/check.php");
  
}else{

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

    <?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On'); */
include '../component/custom.css.php';
include('store_headpart.php');
?>

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


      $(function(){
       $("#dynamic_price").on('change', function(){
  //alert();

        $("#price_form").submit();
        return true;


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
/*.loading{
  position: relative;
  top: 260px;
}*/
</style>

</head>

<body class="bg_gray">
  <?php
        //this is for store header
  $header_store = "header_store";
  include_once("../header.php");
  ?>
  <style>

.inner_top_form button {
   
    padding: 9px 12px !important;
}
  </style>

  <section class="main_box">
    <div class="container">
      <div class="row">

        <?php 
        include('top-dashboard.php');
                        //include('searchform.php');
        ?>

        <div id="sidebar" class="col-md-2 hidden-xs no-padding">
          <div class="left_grid store_left_cat">
            <?php
            include('../component/left-store.php');
            ?>
          </div>
        </div>
        <div class="col-md-10">


         <div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px;">
          <div class="row no-margin">
            <div class="col-md-10 no-padding right_link">
             <form method="POST" action="<?php echo $BaseUrl.'/retail/'; ?>">
               <div class="" style="padding-top: 3px;padding-left: 3px;">
                <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
                <input style="border-radius: 20px;background-color: #e6eeff;width:75%!important;display:inline-block;height: 40px; " type="text" class="form-control" name="txtStoreSearch" value="<?php if(isset($_POST['txtStoreSearch'])){ echo $_POST['txtStoreSearch'];  }?>" placeholder="Search For Products" />
                <button type="submit" class="btn btnd_store" name="btnSearchStore" style=" width: 140px!important;">Search <!-- store --></button>          
              </div>                                
            </form>


          </div>


          <div class="col-md-2" style="padding: 3px 28px;" >
            <form id="price_form" method="POST" action="<?php echo $BaseUrl.'/retail/'; ?>" style="margin-block-end: 2px!important;">

              <select class="form-control pull-right no-radius" id="dynamic_price" style="width: 170px;display: inline;margin-left: 5px;border-radius: 20px; height: 40px;margin-right: 4px;"
              name="pricedropdown">

              <option value="">Select Price Order</option>

              <option value="Asc" <?php if($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>

              <option value="Desc"  <?php if($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>

            </select>
          </form> 
          
        </div>
      </div>

    </div>


    <?php
    $p = new _postingview;
    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                          //my store
      $res = $p->myall_store($_SESSION['uid']);
      $storeofmonth = $p->store_of_month(6, $_SESSION['uid'], $_SESSION['pid']);

    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                          //friend store
      $res = $p->store_friends_Posting($_SESSION['uid']);
      $storeofmonth = $p->store_of_month(4, $_SESSION['uid'], $_SESSION['pid']);

    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                          //group post
      $res = $p->all_group_store($_SESSION['pid']);
      $storeofmonth = $p->store_of_month(5, $_SESSION['uid'], $_SESSION['pid']);

    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                          //retail post
      $res = $p->retailpost(1);
      $storeofmonth = $p->store_of_month(2, $_SESSION['uid'], $_SESSION['pid']);

    }else{
                          //public store
      $res = $p->publicpost(isset($start), 1);
      $storeofmonth = $p->store_of_month(1, $_SESSION['uid'], $_SESSION['pid']);
    }
    $storeValue = str_replace(' ', '_', $storeofmonth);
    $StoreTitle = str_replace('&', '-', $storeValue);
    ?>

               <!--          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>New Arrival <span class="pull-right"><a class="btn btnPosting db_btn31 db_primarybtn_store pull-right" href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">View All</a></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymovetwo slide" id="itemslider_two">
                                <div class="carousel-inner">
                                  <?php
                                  $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store($_SESSION['pid']);

                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //group post
                                        $res = $p->retailpost(1);
                                    }else{
                                      //public store
                                      //$res = $p->publicpost(isset($start), 1);
                                      $res = $p->publicpost_store_pro(1, 20);
                                    }

                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths featured_box">
                                          <div class="img_new_arriv text-center clb" style="    border-radius: 19px;">
                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _postingpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php
                                      $active++;
                                    }
                                  } ?>

                                  
                                </div>
                                <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_two" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_two" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                        
                        </div>
                      -->

                      <div class="row">
                        <div class="col-md-12">
                          <div class="heading03">
                            <h3>Retail<span class="pull-right"><!-- <a class="btn btnPosting db_btn31 db_primarybtn_store pull-right" href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">View All</a> --></span></h3>
                          </div>

                           <!--    <div class="carousel carousel-showmanymovetwo slide" id="itemslider_three">
                            <div class="carousel-inner"> -->
                              <?php


                                 // $p = new _postingview;


                              $p = new _productposting;
                              if(isset($_POST['txtStoreSearch'])){
                                $txtSearchCategory  = $_POST['txtSearchCategory'];
                                $txtStoreSearch   = $_POST['txtStoreSearch'];


                                $res = $p->search_store("Retail", 1, $txtStoreSearch);

                                    //echo $p->ta->sql;


                              }

                              else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){


                               $res = $p->readDESCretailsort(1,$_SESSION['pid']);  


                            //   echo $p->ta->sql;

                             }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                               $res = $p->readASCretailsort(1,$_SESSION['pid']);

                                // echo $p->ta->sql;


                             }else{


                               $res = $p->allretailproduct1(1,$_SESSION['pid']);


                             }


							   //echo $p->ta->sql;



                                   /* if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store($_SESSION['pid']);

                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){*/
                                        //group post

                                    //$res = $p->retailpost(1);

                                    //$rows = mysqli_fetch_assoc($res);
                                   //echo "<pre>";
                                  //print_r($rows);

                                 /*   }else{
                                      //public store
                                      //$res = $p->publicpost(isset($start), 1);
                                      $res = $p->publicpost_store_pro(1, 20);
                                    }
*/
                                  //echo $p->ta->sql;
                                    $active = 0;

                                    if($res != false){

                                    /*print_r($res);

                                 
*/                                 // $i = 1;

                                    $retail_store = $res->num_rows;
                            //  print_r($retail_store);
                                    while ($rows = mysqli_fetch_assoc($res)) { ?>


                                     <input type="hidden" name="post_id" id="post_id<?php echo $rows['idspPostings'];?>" value="<?php echo $rows['idspPostings'];?>"> 

                                     <div class="item <?php echo ($active >= 12)?'seeproduct':'';?>">
                                      <div class="col-xs-5ths">
                                        <!-- <div class="featured_box text-center"> -->
                                          <div class="featured_box" style="height:260px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                              <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

                                               <?php
                                               $pic = new _productpic;
                                               $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                               if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                if ($result != false) {
                                                  $rp = mysqli_fetch_assoc($result);
                                                  $picture = $rp['spPostingPic'];
                                                  echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                } else
                                                echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                              }else{
                                                if ($result != false) {
                                                  $rp = mysqli_fetch_assoc($result);
                                                  $picture = $rp['spPostingPic'];
                                                  echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                } else
                                                echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                              }
                                              ?>


                                            </a>
                                          </div>

                                          <ul style="padding-left: 10px;display: grid;">

                                            <li>
                                              <h4 style="background-color: unset;float: left;padding: 0px;">

                                               <?php 

                                               if(!empty($rows['spPostingTitle'])){
                                                if(strlen($rows['spPostingTitle']) < 15){
                                                  ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                }else{
                                                  ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
                                                }
                                              }else{
                                                echo "&nbsp;";
                                              }
                                              ?>    

                                            </h4>
                                          </li>

                                          <li>
                                            <h5 style="float: left;">

                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                echo "<div class='postprice' style='' data-price='" . $rows['spPostingPrice'] . "'>".$rows['default_currency'].' '.$rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                echo "Expires on".$rows['spPostingExpDt'];
                                              }
                                              ?>


                                            </h5>
                                          </li>


                                          <?php


                                          $mr = new _spstorereview_rating;

                                          $resultsum1 = $mr->readstorerating($rows['idspPostings']);

                         // echo $mr->ta->sql;

                                          if($resultsum1 != false){



                                           $totalmyreviews1 = $resultsum1->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;


                                           while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

                                            $sumrevrating1 += $rowreview1['rating'];

                                            $rateingarr1[] =  $rowreview1['rating'];

                                          }  

                                          $count1 = count($rateingarr1);

                                          $reviewaveragerate1 = $sumrevrating1 / $count1;

                                          $totalreviewrate1  = round($reviewaveragerate1, 1);

                                   //   echo $totalreviewrate1;

                                        }      


                                        ?>
                                        <li>
                                          <p class="rating_box">

                                           <!-- <div class="rating-box">
                                            </?php if($totalreviewrate1 >= "5") { 
                                              echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
                                              echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate1 >= "4") { 
                                              echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
                                              echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate1 >= "3") { 
                                              echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
                                              echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate1 >= "2") { 
                                              echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
                                              echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate1 >= "1") { 
                                              echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate1 <= "0") { 
                                              echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                            ?>

                                          </div> -->



                                          <!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
                                        </p>
                                      </li>           
                                    </ul>
                                  </div>
                                </div>
                              </div>


                              <?php
                              $active++;

                            }if($retail_store >= 15){ 
                              ?>
                           

                              <?php }
                            }else{

                              echo"<h4 class='text-center'>No Product Found</h4>";
                            } ?>


                            <!--</div>
                                 <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_three" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_three" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div> -->
                            </div>
                            <center>
                                <div class="loadingseemore"><a class="loadpost" id="fold_p">SEE MORE</a></div></center>

                          </div>


                          <!--  Whollsale div -->

                      <!--   <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>Wholesale<span class="pull-right"></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymovetwo slide" id="itemslider_four">
                                <div class="carousel-inner">
                                  <?php
                                  $p = new _postingview;
                               
                                      $res = $p-> mywholesellpost($_SESSION['pid'], 1);

                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths featured_box">
                                          <div class="img_new_arriv text-center clb" style="    border-radius: 19px;">
                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _postingpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                          </div>
                                            <h4>
                                              <?php 
                                            
                                                if(!empty($rows['spPostingtitle'])){
                                                    if(strlen($rows['spPostingtitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords($rows['spPostingtitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords(substr($rows['spPostingtitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            </h4>
                                            <h5 >
                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>
                                            </h5>
                                          
                                            <p class="date"></p>
                                        </div>
                                      </div>
                                      <?php
                                      $active++;
                                    }
                                  }else{
                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  } ?>

                                  
                                </div>
                                <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_four" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_four" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                          </div> -->


<!--                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>Auction <span class="pull-right"></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymovetwo slide" id="itemslider_three">
                                <div class="carousel-inner">
                                  <?php
                                  $p = new _postingview;
                              
                                       $res = $p->auction('auction', $_SESSION['uid']);
                            
                                //  echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths featured_box">
                                          <div class="img_new_arriv text-center clb" style="    border-radius: 19px;">
                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _postingpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                          </div>
                                            <h4>
                                              <?php 
                                              
                                                if(!empty($rows['spPostingtitle'])){
                                                    if(strlen($rows['spPostingtitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords($rows['spPostingtitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords(substr($rows['spPostingtitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            </h4>
                                            <h5 >
                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>
                                            </h5>
                                            
                                            <p class="date"></p>
                                        </div>
                                      </div>
                                      <?php
                                      $active++;
                                    }
                                  } ?>

                                  
                                </div>
                                <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_three" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_three" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                        </div>


                      -->




<!--                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>All Products <span class="pull-right"><a class="btn btnPosting db_btn31 db_primarybtn_store pull-right" href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">View All</a></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                                <div class="carousel-inner">
                                  <?php
                                    $pr = new _spprofilehasprofile;
                                    $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store_random($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting_randm($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store_random($_SESSION['pid']);
                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //retail post
                                        $res = $p->retailpost_random(1);
                                    }else{
                                      //public store
                                      $res = $p->publicpost_random(1, 30);
                                    }
                                    
                                  //echo mysqli_num_rows($res);
                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                      $dt = new DateTime($rows['spPostingDate']);
                                      //echo $rows['idspProfiles'];
                                      if($_SESSION['pid'] != $rows['idspProfiles']){
                                        
                                        $result3 = $pr->frndLeevel($_SESSION['pid'], $rows['idspProfiles']);
                                        //echo $pr->ta->sql;
                                        //echo $result3;
                                        if($result3 == 0){
                                          $level = '1st Degree';
                                        }else if($result3 == 1){
                                          $level = '1st Degree';
                                        }else if($result3 == 2){
                                          $level = '2nd Degree';
                                        }else if($result3 == 3){
                                          $level = '3rd Degree';
                                        }else{
                                          $level = 'Not Define';
                                        }
                                      }else{
                                        $level = '1st Degree';
                                      }
                                      
                                     ?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <div class="featured_box text-center">
                                            <div class="img_fe_box">
                                              <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                                <?php
                                                  $pic = new _postingpic;
                                                  $result = $pic->read($rows['idspPostings']);
                                                  //echo $pic->ta->sql;
                                                  if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                  }else{
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                  }
                                                ?>
                                              </a>
                                            </div>
                                            <h4>
                                              <?php 
                                           
                                                if(!empty($rows['spPostingtitle'])){
                                                    if(strlen($rows['spPostingtitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords($rows['spPostingtitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords(substr($rows['spPostingtitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            </h4>
                                            <h5 >
                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>
                                            </h5>
                                          
                                          </div>
                                        </div>
                                      </div> <?php
                                      $active++;
                                    }
                                  } ?>
                                  
                                </div>

                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                        </div>
                      -->
                      <div class="row">
                        <div class="col-md-12">
                          <div class="btm_img_str">
                            <!-- <a href="<?php echo $BaseUrl.'/store/dashboard';?>"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/quote.jpg" class="img-responsive" /></a> -->

                            <?php     $a = new _spAllStoreForm;
                            $resban = $a->readbanner('store');
                                               // $result4 = $all->readContent(1);


                            ?>

                            <div  class="carousel carousel-showmanymovetwo slide" data-ride="carousel" id="itemslider_three">

                              <!-- Wrapper for slides -->
                              <div class="carousel-inner">


                                <?php

                                if ($resban) {

                                  $count = 0; 
                                             // while  $row4 = mysqli_fetch_assoc($result4);

                                             /* $bannerrow = mysqli_fetch_assoc($resban);
                                             $bannerpicture = $bannerrow["image"];*/
                                             while ($bannerrow = mysqli_fetch_assoc($resban)) {

                                              $bannerpicture = $bannerrow["image"];
                                              ?>
                                              <div class="item <?php if($count == 0){echo "active"; } ?> ">
                                                <div class="top_banner">
                                                 <img src="<?php echo $BaseUrl.'/backofadmin/content/banner/images/'.$bannerpicture?>"
                                                 alt="banner Pic" class="img-responsive" style="width: 100%;">
       <!--  <div class="carousel-caption">
          <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>
        </div> -->
      </div>
    </div>

    <?php 

    $count = $count + 1; 

  }

} 
?>     


</div>

<!-- Left and right controls -->
<a class="left carousel-control" href="#itemslider_three" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#itemslider_three" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  <span class="sr-only">Next</span>
</a>
</div>
</div>
</div>

</div>


</div>
</div>
</div>
</section>




<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

     <!--     
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider').carousel({ interval: false });
            $('.carousel-showmanymoveone .item').each(function(){
              var itemToClone = $(this);
            for (var i=1;i<5;i++) {
              itemToClone = itemToClone.next();
              if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
              }
              itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
              }
            });
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider_two').carousel({ interval: false });
            $('.carousel-showmanymovetwo .item').each(function(){
              var itemToClone = $(this);
              for (var i=1;i<5;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
          });
        </script> -->

        <script type="text/javascript">

          $(document).ready(function(){

    // Load more data
            $('.loadpost').click(function(){
//alert();

              $(".seeproduct").show();
              $(".loadpost").hide();


/*$('#fold_p').css({
        'position':'relative',
        'top': '262px',
        'right': '300px'

       
    });*/

            });
          });
/* $(document).ready(function(){
   $('.loadpost').click(function(){
          $("#fold_p").fadeOut(function () {
            $("#fold_p").text(($("#fold_p").text() == 'SEE MORE') ? 'SEE LESS' : 'SEE MORE').fadeIn();

            $(".seeproduct").hide();
        });
           });
            });*/
        </script>


        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider_one').carousel({ interval: false });
            $('.carousel-showmanymoveone .item').each(function(){
              var itemToClone = $(this);
              for (var i=1;i<5;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
              }
            });
          });




        </script>  
      </body>
      </html>
      <?php
    }
  ?>