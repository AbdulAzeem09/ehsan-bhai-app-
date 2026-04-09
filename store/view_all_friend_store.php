 <?php
 
  include('../univ/baseurl.php');
  session_start();

 // print_r($_SESSION['pid']);


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
        <?php include('store_headpart.php');?> 
        
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

           <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });


$(function(){
 $("#dynamic_price").on('change', function(){
 // alert();

  $("#price_form").submit();
  return true;

  
    });

 });
            
        </script>
   <style type="text/css">
     .featured_box img {
    margin: 0 auto!important;
}
.frnd-store img {
        margin: 0 auto!important;
        height: 100px!important;
        width: 100px;
        float: left;
        border-radius: 60px;
    }
.frnd-store {
   height:  188px;
}

.frnd-store.user-profile-Img{
    height:  200px;
}

.frnd-store h4 {
    margin: 0!important;
    padding: 0px; 
    text-align: left;
    font-size:  17px;
    font-family:  'MarksimonRegular';
}

.frnd-store h5 {
    margin-top: 0px;
    font-size: 13px;
}

.store-anchor {
    text-align: center;
    padding-top: 28px;
    height:  118px;
}
.carousel-control {
    position: absolute;
    top: 0;
    bottom: 16px!important;
    left: 0;
    width: 15%;
    font-size: 20px;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
    background-color: rgba(0, 0, 0, 0);
    filter: alpha(opacity=50);
    opacity: .5;
}

       
  

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

.carousel-inner > .item {

display: block;

}
</style>      
    </head>

    <body class="bg_gray">



      <?php
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");
     //echo $_SESSION["pid"]; 

         

      ?>


 <section class="main_box">
            <div class="container">
                <div class="row">
                
                    <div class="col-md-12">
                        <?php 
                        include('top-dashboard.php');
                        //include('searchform.php');
                        ?>



    
    <!-- Retail Open -->     

    <?php

/*print_r($_GET);*/
     if($_GET['firendstore'] == 'friend'){  ?>
                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>friends store<span class="pull-right seemore">
                                  </span></h3>
                              </div>

                        <div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
                                <div class="carousel-inner">

                                     <?php
                                   
                             /*       $p = new _productposting;

                                    if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

               
                                    //public store
                                    $res = $p->search_mystore("Retail", 1, $txtStoreSearch,$_SESSION['pid']);
                                

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $res = $p->myretailDESCproduct(1,$_SESSION['pid']);      

                             // echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $res = $p->myretailASCproduct(1,$_SESSION['pid']);

                               //  echo $p->ta->sql;

                               }else{

                                $res = $p->myretailproduct(1,$_SESSION['pid']);
                              }
                                    

                                    */

                                 //   echo $p->ta->sql;
                                

                                     $active = 0;

    $r = new _spprofilehasprofile;
  
  $resall = $r->readalllimit($_SESSION["pid"]);//As a receiver
  //echo $r->ta->sql;
  if($resall != false){
    while($rowall = mysqli_fetch_assoc($resall)){
      $p = new _spprofiles;
      $sender = $rowall["spProfiles_idspProfileSender"];
     
      $result = $p->read($rowall["spProfiles_idspProfileSender"]);

        if($result != false){                    
            while ($row = mysqli_fetch_assoc($result)) {
                $b = new _storebanner;
                $result2  = $b->readprofile($row['idspProfiles']);
                if($result2 != false)
                {
                  $bannerrow = mysqli_fetch_assoc($result2);
                  $bannerpicture = $bannerrow["spStorebanner"];
                }
                $bs = new _spbusiness_profile;
                $rpvt = $bs->read($row['idspProfiles']);
                if ($rpvt != false) {
                    $bussinessrow = mysqli_fetch_assoc($rpvt);
                    $storeuser = $bussinessrow['spDynamicWholesell'];
                   }
                   ///print_r($bannerpicture);
                   //exit;
                ?>
                    <div class="item <?php echo ($active == 0)?'active':'';?>">
                        <div class="col-xs-5ths">
                          <div class="featured_box frnd-store">
                            <a href="<?php echo $BaseUrl.'/store/my-all-product.php?userid='.$row['idspProfiles'];?>">
                                <div class="img_fe_box" style="border: 0px solid #ccc;height:118px;">
                                    <?php  
                                    if (isset($bannerpicture) && $bannerpicture != '') {
                                    ?>
                                        <img id="profilepic" data-media="<?php echo (isset($bannerpicture)?"1":"0");?>" src="<?php echo (isset($bannerpicture))?($bannerpicture):''; ?>" alt="Profile Pic" class="img-responsive" >
                                    <?php } else {?>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/bg/top_banner.jpg" class="img-responsive" alt="" />
                                    <?php
                                    } 
                                        $prodPosting = new _productposting;
                                        $totalProds = $prodPosting->publicpost_count($row['idspProfiles']);
                                        //echo $p->ta->sql;
                                        if($totalProds != false){
                                            $totalProds = mysqli_num_rows($totalProds);
                                        }else{
                                            $totalProds = 0;
                                        }
                                    ?>
                                    <div class="store-anchor">
                                        <span>VISIT STORE</span><br>
                                        <span>(<?php echo $totalProds; ?> Items)</span>
                                    </div>
                                </div>
                                <ul style="padding: 7px 0px 0px 10px;">
                                    <li>
                                        <h4 style="background-color: unset;">
                                            <?php if (isset($storeuser) && $storeuser != '') { ?>
                                               <span style="color: #0b241e; font-weight: 600; text-transform: capitalize;">
                                                <?php 
                                                    if(strlen($storeuser) < 20)
                                                    {
                                                        echo $storeuser;
                                                    } else {
                                                        echo substr($storeuser, 0,20)."...";
                                                    }
                                                ?></span>
                                            <?php } else { ?>
                                                <span style="color: #0b241e; font-weight: 600; text-transform: capitalize;"><?php echo ucwords(substr($row['spProfileName'], 0,15)); ?></span>
                                            <?php } ?>
                                        </h4>
                                    </li>
                                    <li>
                                    <h5 style="padding-top:7px;">
                                        <?php
                                        if ($row['spProfileName'] != false) {?>
                                            <span style="color: #0b241e; font-weight: 600; text-transform: capitalize;"><?php echo ucwords(substr($row['spProfileName'], 0,15)); ?></span>
                                        <?php }?>
                                    </h5>
                                    </li>
                                </ul>
                            </a>
                          </div>
                        </div>
                    </div> 
                      <?php $active++;
                    }
                }
            }
    } else {
        echo "<h4 class='text-center'>No Friend Store Available</h4>";
    }
    ?>
                                  
                                </div>

                              <!--   <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div> -->
                              </div>
                            

                            </div>
                            </div>  
<?php }elseif ($_GET['firendstore'] == 'retail') { ?>
                          <!-- friend store Close --> 

                      <!-- Retail Open -->      
                    <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>Retail<span class="pull-right seemore">
                                  </span></h3>
                              </div>
 
                                  
                  <div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
                                <div class="carousel-inner">

                                     <?php
                                   // $p = new _postingview;
           
                
    $r = new _spprofilehasprofile;
  
  $resall = $r->readall($_SESSION["pid"]);//As a receiver
  //echo $r->ta->sql;
  if($resall != false){
    while($rowall = mysqli_fetch_assoc($resall)){
      $pr = new _spprofiles;
      $sender = $rowall["spProfiles_idspProfileSender"];
     
      $result = $pr->read($rowall["spProfiles_idspProfileSender"]);
      //echo $p->ta->sql;

      if($result != false){
                                 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $friendpid = $row['idspProfiles'];
                             //  print_r($friendpid);
                             
                                               
                                    $p = new _productposting;

                                    if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
                                  /*$p = new _productposting;*/
                
               
                                    //public store
                   $res = $p->search_mystore("Retail", 1, $txtStoreSearch,$friendpid);
                                

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $res = $p->myretailDESCproduct(1,$friendpid);      

                             // echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $res = $p->myretailASCproduct(1,$friendpid);

                               //  echo $p->ta->sql;

                               }else{

                                $res = $p->myretailproduct(1,$friendpid);
                              }
                                    

                                    

                                //echo $p->ta->sql;

                                     $active = 0;
                                
                                  if($res != false){

                                    while ($rows = mysqli_fetch_assoc($res)) {
                                     ?>

                                  
 <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                            <div class="featured_box ">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

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
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
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
                                                  echo "<div class='postprice' style='' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
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
                          
                             <div class="rating-box">
                                      <?php if($totalreviewrate1 >= "5") { 
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

                                    </div>

                                
                            
                       <!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
                        </p>
                                 </li>           
                                   </ul>
                                          </div>
                                        </div>
                                      </div>



                                       <?php
                                      $active++;
                                    }
                                  }/*else{

                                       echo "<h4 class='text-center'>No Friend Store Available</h4>";
                                  }*/
                                   
                                 }
                              }
                            }
                          }else{

                                       echo "<h4 class='text-center'>No Friend Store Available</h4>";
                                  }?>
                                  
                                </div>

                          <!--       <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div> -->
                              </div>
                             </div>
             
                            </div>  
<?php }elseif ($_GET['firendstore'] == 'WholeSale') {
  # code..?>
                          <!-- Retail Close -->   

                           <!-- Wholesale Open -->

                     <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>WholeSale<span class="pull-right seemore">
                                  </span></h3>
                              </div>

                        <div class="carousel carousel-showmanymoveone slide" id="itemslider_four">
                                <div class="carousel-inner">

                                  
                                  <?php
                                  $p = new _productposting;

                
    $r = new _spprofilehasprofile;
  
  $resall = $r->readall($_SESSION["pid"]);//As a receiver
  //echo $r->ta->sql;
  if($resall != false){
    while($rowall = mysqli_fetch_assoc($resall)){
      $pr = new _spprofiles;
      $sender = $rowall["spProfiles_idspProfileSender"];
     
      $result = $pr->read($rowall["spProfiles_idspProfileSender"]);
      //echo $p->ta->sql;

      if($result != false){
                                 
                            while ($row = mysqli_fetch_assoc($result)) {

                             /* print_r($row);*/
                                $friendpid = $row['idspProfiles'];

                                  if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
                                  /*$p = new _productposting;*/
               
                                    //public store
                                    $resw = $p->search_mystore("Wholesaler", 1, $txtStoreSearch,$friendpid);
                               

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $resw = $p->myWholesalerDESCproduct(1,$friendpid);      

                             // echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $resw = $p->myWholesalerASCproduct(1,$friendpid);

                               //  echo $p->ta->sql;

                               }else{
                               
                                      $resw = $p->mywholesaleproduct(1,$friendpid);

                                     
                              }
                              // echo $p->ta->sql;


                                  $active = 0;
                                  if($resw != false){
                                    while ($rowsw = mysqli_fetch_assoc($resw)) {
                                      
                                              
                                             // print_r($rows);

                                      ?>
                                        
                                  
                                       
                                 <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                            <div class="featured_box">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                 <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>">
                                              <?php
                                                $pic = new _productpic;
                                                $result = $pic->read($rowsw['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
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
                                            
                                                if(!empty($rowsw['spPostingTitle'])){
                                                    if(strlen($rowsw['spPostingTitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0,15)).'...'; ?></a><?php
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
                                              if ($rowsw['spPostingPrice'] != false) {
                                                  echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>$" . $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rowsw['spPostingExpDt'];
                                              }
                                              ?>

                                             
                                            </h5>

                         <?php
                       
                            
                         $mr = new _spstorereview_rating;

                         $resultsum3 = $mr->readstorerating($rowsw['idspPostings']);

                        //  echo $mr->ta->sql;

                          if($resultsum3 != false){

                         

                         $totalmyreviews3 = $resultsum3->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview3 = mysqli_fetch_assoc($resultsum3)){

                                            $sumrevrating3 += $rowreview3['rating'];

                                             $rateingarr3[] =  $rowreview3['rating'];

                                        }  

                                      $count3 = count($rateingarr3);

                                      $reviewaveragerate3 = $sumrevrating3 / $count3;

                                      $totalreviewrate3  = round($reviewaveragerate3, 1);

                                }      


                        ?>
                      </li>
                      <li>
                      <h5>Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>

                      </li>
                      <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <?php if($totalreviewrate3 >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate3 >= "4" && $totalreviewrate3 < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate3 >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate3 > "3" && $totalreviewrate3 < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate3 >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate3 > "2" && $totalreviewrate3 < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate3 >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate3 > "1" && $totalreviewrate3 < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate3 >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate3 <= "0") { 
                                        //echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>

                            
                       <!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
                        </p>
                      </li>
                                            
                                          </div>
                                        </div>
                                      </div> 



                                      <?php
                                      $active++;
                                   }
                                  }else{

                                      /* echo "<h4 class='text-center'>No Friend Store Available</h4>";*/
                                  }
                                   
                                 }
                              }
                            }
                          }else{

                                       echo "<h4 class='text-center'>No Friend Store Available</h4>";
                                  }?>
                                  
                                </div>

                            <!--     <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_four" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_four" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div> -->
                              </div>
                            

                            </div>
                            </div>  

<?php }elseif ($_GET['firendstore'] == 'auction') { ?>              

    <!-- wholesaler close  -->


<!-- Auction open -->



                     <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>Auction<span class="pull-right seemore">
                                  </span></h3>
                              </div>

                     <div class="carousel carousel-showmanymoveone slide" id="itemslider_five">
                                <div class="carousel-inner">

                                  

                                      <?php
                               $p = new _productposting;

                
    $r = new _spprofilehasprofile;
  
  $resall = $r->readall($_SESSION["pid"]);//As a receiver
  //echo $r->ta->sql;
  if($resall != false){
    while($rowall = mysqli_fetch_assoc($resall)){
      $pr = new _spprofiles;
      $sender = $rowall["spProfiles_idspProfileSender"];
     
      $result = $pr->read($rowall["spProfiles_idspProfileSender"]);
      //echo $p->ta->sql;

      if($result != false){
                                 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $friendpid = $row['idspProfiles'];

                                    if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
                                 /* $p = new _productposting;*/
              
                                    //public store
                                    $res = $p->search_mystore("Auction", 1, $txtStoreSearch,$friendpid);
                              

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $res = $p->myAuctionDESCproduct(1,$friendpid);      

                            // echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $res = $p->myAuctionASCproduct(1,$friendpid);

                               //  echo $p->ta->sql;

                               }else{

                                $res = $p->myauctionproduct(1,$friendpid);
                              }
                               
                                

                              //  echo $p->ta->sql;

                              /*  print_r($res);
*/

                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                     /* echo "<pre>";
                                    print_r($rows) ; */

                                      ?>

                                  
    <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                         <!--  <div class="featured_box text-center"> -->
                                           <div class="featured_box ">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                 <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
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
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            
                                            </h4>
                                            <li>
                                            <h5 style="float: left;">

                                               <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>

                                             
                                            </h5>
                                          </li>
       <input type="hidden" id="auctionexpid<?php echo $rows['idspPostings']?>" value="<?php echo $rows['idspPostings']?>">

<input type="hidden" id="auctionexp<?php echo $rows['idspPostings']?>" value="<?php echo $rows['spPostingExpDt']?>">

  <script type="text/javascript">

$(document).ready(function(){
  // we call the function
   get_auctionexpdata("<?php echo $rows['idspPostings'];?>");

 
   });
</script> 

<li style="padding-top: 10px;">
<span id="auction_enddate<?php echo $rows['idspPostings']?>"></span>  
</li>   

                                            
                                          </div>
                                        </div>
                                      </div> 


                                      <?php
                                      $active++;
                                    }
                                  }else{

                                       //echo "<h4 class='text-center'>No Friend Store Available</h4>";
                                  }
                                   
                                 }
                              }
                            }
                          }else{

                                       echo "<h4 class='text-center'>No Friend Store Available</h4>";
                                  }?>
                                  
                                </div>

                               <!--  <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_five" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_five" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div> -->
                              </div>
                            

                            </div>
                            </div>   
<?php } ?>
                            <!-- Auction close -->



     </div>
   </div>
 </div>
</section>



         
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
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
 <script type="text/javascript">


          $(document).ready(function(){
      /*      $('#itemslider_one').carousel({ interval: false });
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
            });*/
          });
        </script>   

 </body>
</html>
<?php
}
?>