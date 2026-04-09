<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_GET['userid']) && $_GET['userid'] > 0){

        $profileId = $_GET['userid'];
        $pro = new _spprofiles;
        $result = $pro->read($profileId);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $ProfileName = $row['spProfileName'];

               $UserEmailid = $row['spProfileEmail'];

              $spUserid = $row['spUser_idspUser'];

               //$profiletype = 1;
              
        }
    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl.'/store');
    }
          
 //   echo $profiletype;

     $result1 = $pro->readbussinessdata($spUserid);

         if ($result1) {
            $row1 = mysqli_fetch_assoc($result1);
            $bussinessid = $row1['idspProfiles'];

            
        }
    // echo  $pro->ta->sql;
        // echo  $bussinessid;



        $bs = new _spbusiness_profile;
       
        $rpvt = $bs->read($bussinessid);


     //  echo $bs->ta->sql;
        if ($rpvt != false){


            $bussinessrow = mysqli_fetch_assoc($rpvt);
           // $Storeusername = $bussinessrow['spDynamicWholesell'];

           // echo "<pre>";
           // print_r($bussinessrow);

            $bussid= $bussinessrow['spprofiles_idspProfiles'];


            $bussinessdesc = $bussinessrow['BussinessOverview'];
            $storeuser = $bussinessrow['spDynamicWholesell'];

             $ProfilesAboutStore = $bussinessrow['spProfilesAboutStore'];
              $shippingtext = $bussinessrow['spshippingtext'];
               $Profilerefund = $bussinessrow['spProfilerefund'];
                $Profilepolicy = $bussinessrow['spProfilepolicy'];
           
         
            
        } 

       


    $b = new _storebanner;


    $result2  = $b->read($spUserid);
    if($result2 != false)
    {
      $bannerrow = mysqli_fetch_assoc($result2);
     
      $bannerpicture = $bannerrow["spStorebanner"];
     

    }

   // echo  $bannerpicture;




?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
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
            $(document).ready(function(){
                $('#itemslider').carousel({ interval: 3000 });
                $('.carousel-showmanymoveone .item').each(function(){
                  var itemToClone = $(this);
                for (var i=1;i<3;i++) {
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


<style type="text/css">
  

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  padding-bottom: 10px;
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
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                <?php /*print_r($_SESSION['pid']);*/

                $p = new _spprofiles;
                $result  = $p->profilestore($_SESSION["pid"]);
                
                if($result != false)
                {
                    $rowss = mysqli_fetch_assoc($result);

                }
               ?>






      <div id="StorebannerUpload" class="modal fade" role="dialog">
              <div class="modal-dialog">

               
                <div class="modal-content sharestorepos bradius-15" style="width: 800px;">
                    <div class="modal-header br_radius_top bg-white">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Upload Banner</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h4>Choose your store banner</h4>
                          <div id=""></div>
                              <br/>

                              <input type="file" name="bannerfile" class="basestorebanner" id="basestorebannerid" style="display: block;" />  
                            <!--   <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
                              <input type="hidden" id="spProfileId" value="<?php echo  $profileId;?>">

                              <input type="hidden" id="spuserId" value="<?php echo $spUserid;?>">

                             <!--  <input type="hidden" id="baseImageWeb" class="image-tag"> -->



                            
                        </div>

                        <div class="col-md-6">
                          <h4>Your selected banner will appear here...</h4>
                          <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;"></div>
                           <button type="button" class="btn btn-primary" id="btnbannerimg" style="margin-top: 10px;">Upload</button>
                        </div>
                        
                      </div>
                    </div>
                    <div class="modal-footer bg-white br_radius_bottom">
                      <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
          </div>
 

                    <div class="col-md-10">
                         <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">

  
 
           <?php if ($spUserid == $_SESSION['uid']) { ?>

        <a href="javascript:void(0)" class="" data-toggle="modal" data-target="#StorebannerUpload" style="color: #1c6121!important; float: right; font-size: 30px;"><i class="fa fa-edit"></i></a>
           
     <?php  } ?>                    



         <?php  
         if (isset($bannerpicture) && $bannerpicture != '') {
            ?>
            <img id="profilepic" data-media="<?php echo (isset($bannerpicture)?"1":"0");?>" src="<?php echo (isset($bannerpicture))?($bannerpicture):''; ?>" alt="Profile Pic" class="img-responsive" style="width: 100%;">
            <div style="position: absolute!important;
    bottom: 14px!important;
    
    font-size: 26px;
    background-color: white;
    /* max-width: 58px; */
    min-width: 182px;
    border-top-right-radius: 15px;;
    padding-left: 10px;
    text-align: center;
    text-transform: capitalize;">

            <?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?>  </div> 
            
         <?php }else{?>
            
            <img src="<?php echo $BaseUrl;?>/assets/images/bg/top_banner.jpg" class="img-responsive" alt="" />
     <div style="position: absolute!important;
    bottom: 14px!important;
   
    font-size: 26px;
    background-color: white;
    /* max-width: 58px; */
    min-width: 182px;
    border-top-right-radius: 15px;;
    padding-left: 10px;
    text-align: center;
    text-transform: capitalize;">

            <?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?>  </div> 
            <?php
          }
       
          ?>








                                   
                              


                                </div>
                            </div>
                        </div>

                      
                        
                      
                       <!--  <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading">
                            <div class="row">
                                <div class="col-md-8">
                              		
                                     <h3><?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?></h3>



                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                            </div>
                        </div> -->
                         <ol class="breadcrumb" style="margin-bottom: 0px;">
                         <li class="breadcrumb-item"><a href="<?php echo $BaseUrl;?>/">Home</a></li>
                                    <?php
                                    $storeTitle = "Public Store";
                                    echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    ?>

                                    <li class="breadcrumb-item active" style=" text-transform: capitalize;"><a href="<?php echo $BaseUrl;?>/search/index.php"><?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?></a></li>
                       </ol>

                      <!--   <?php include('searchform.php');?> -->
                        <!-- <div class="breadcrumb_box m_btm_10 row no-margin">
                            <div class="col-md-8 no-padding">
                                <ol class="breadcrumb" >
                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl;?>/">Home</a></li>
                                    <?php
                                    $storeTitle = "Public Store";
                                    echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    ?>
                                    <li class="breadcrumb-item active" style=" text-transform: capitalize;"><?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?></li>
                                                   
                                </ol>
                            </div>
 -->
                           <!--  <div class="col-md-4 text-right right_link" >
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a>
                            </div> -->
                     <!--    </div> -->
                        
                            
                      <!--   <div class="row no-margin "> -->
                           <!--  <div class="heading03">
                                <h3><?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?></h3>
                            </div> -->
                            <?php

                            //$ca = new _categories
                            $p = new _postingview;
                            $result3 = $p->singleFriendProduct($profileId, 1);
                            
                            //echo $p->ta->sql;
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $dt = new DateTime($row3['spPostingDate']);
                                    
                                    
                                    ?>
                                    <div class="col-xs-5ths">
                                        <div class="featured_box text-center subcategory_box">

                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
                                                
                                                <?php
                                                $pic = new _postingpic;
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
                                            <?php
                                            if(!empty($row3['spPostingtitle'])){
                                                if(strlen($row3['spPostingtitle']) < 15){
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a></h4><?php
                                                    
                                                }else{
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr(ucwords(strtolower($row3['spPostingtitle'])), 0,15).'...'; ?></a></h4><?php
                                                }
                                            }else{
                                                echo "<h4>&nbsp;</h4>";
                                            } ?>
                                            <h5 >
                                                <?php
                                                if ($row3['spPostingPrice'] != false) {
                                                    echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                }else{
                                                    echo "Expires on ".$row3['spPostingExpDt'];
                                                }
                                                  ?>
                                            </h5>
                                            <h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$row3['idspProfiles']?>"><?php echo ucwords(strtolower($row3['spProfileName']));?></a></h6>
                                            <p class="date"></p>
                                            <!-- <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p> -->
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                       <!--  </div> -->


<!-- <div class="row">
   <div class="col-md-12">
                  <div class="store_name1 bg_white">
                                 <?php   if (isset($storeuser) && $storeuser != '') { ?>
                                     <h3 class="eventcapitalize" style="text-align: center; padding-top: 5px;color: green;" ><?php echo (isset($ProfileName) && $ProfileName !='')?$ProfileName:''; ?> Store Name : <?php echo $storeuser; ?></h3>
                                      
                                 

                                 <?php }else{?>

                                    <h3 class="eventcapitalize" style="text-align: center;">No information about store name.</h3>


                                <?php  }
                                  ?>

                  </div>
              </div>
          </div> -->
  <!-- tab section -->
   <div class="row">
   <div class="col-md-12">
                  <div class="store_detailcenter_1 bg_white" style="margin-top: 20px;">
                            
                              
                                 <?php   if (isset($storeuser) && $storeuser != '') { ?>
                                     <h3 class="eventcapitalize"><?php echo $storeuser; ?> </h3>
                                 <?php }else{?>

                                    <h3 class="eventcapitalize" style="text-align: center;">No information about store name.</h3>


                                <?php  }
                                  ?>
                           

                  <div class="row">
                  <div class="col-md-12">
                <!--   <p id='eventrating' class="rating" style="margin-right: 82%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <a href="">98% positive in the last 12 months (2242 rating)</a>

 -->
                                 <?php   if (isset($bussinessdesc) && $bussinessdesc != '') { ?>
                                     <p><?php echo $bussinessdesc;?></p>
                                 <?php }else{?>

                                    <p style="text-align: center;">No information about bussiness detail.</p>


                                <?php  }
                                  ?>

  </div>
          </div>

    <div class="row">
    <div class="col-md-12">
            <div class="panel with-nav-tabs panel-success">
                <div class="panel-heading" style="padding: 0px; border-bottom: 0px;">

                  <?php  $r = new _spstorereview_rating;
                                   $res2 = $r->readallrating($_GET['userid']);

                                  $totalreviews = $res2->num_rows;?>
                                  
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1success" data-toggle="tab">About Store</a></li>
                            <li><a href="#tab2success" data-toggle="tab">Shipping Destination</a></li>
                            <li><a href="#tab3success" data-toggle="tab">Returns and Refunds</a></li>
                             <li><a href="#tab4success" data-toggle="tab">Policies</a></li>
                            <li><a href="#tab5success" data-toggle="tab">Rating  <?php if($totalreviews > 0){ echo $totalreviews; }else{ echo "0"; }?></a></li>
                            <li><a href="#tab6success" data-toggle="tab">Contact Us</a></li>


                            
                           
                          <!--   <li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4success" data-toggle="tab">Success 4</a></li>
                                    <li><a href="#tab5success" data-toggle="tab">Success 5</a></li>
                                </ul>
                            </li> -->
                        </ul>
                </div>
                <div class="panel-body">
                     <div class="tab-content"> 
                        <!-- <div class="tab-pane fade in active" id="tab1success">Success 1</div> -->

                      
                          

                          <div class="tab-pane fade in active" id="tab1success" style="padding: 4px;">
                          <div class="row">
                            <div class="col-md-12">

                              <?php   if (isset($ProfilesAboutStore) && $ProfilesAboutStore != '') { ?>
                                     <p><?php echo $ProfilesAboutStore;?></p>
                                 <?php }else{?>

                                    <p style="text-align: center;">No inforamtion about store.</p>


                                <?php  }
                                  ?>


                            </div>
                          </div>
                        </div>

                         <div class="tab-pane fade " id="tab2success" style="padding: 4px;">
                          <div class="row">
                            <div class="col-md-12">

                              <?php   if (isset($shippingtext) && $shippingtext != '') { ?>
                                     <p><?php echo $shippingtext;?></p>
                                 <?php }else{?>

                                    <p style="text-align: center;">No inforamtion about shipping destination.</p>


                                <?php  }
                                  ?>


                            </div>
                          </div>
                        </div>

                          <div class="tab-pane fade " id="tab3success" style="padding: 4px;">
                          <div class="row">
                            <div class="col-md-12">

                              <?php   if (isset($Profilerefund) && $Profilerefund != '') { ?>
                                     <p><?php echo $Profilerefund;?></p>
                                 <?php }else{?>

                                    <p style="text-align: center;">No inforamtion about returns and refunds.</p>


                                <?php  }
                                  ?>


                            </div>
                          </div>
                        </div>

                          <div class="tab-pane fade " id="tab4success" style="padding: 4px;">
                          <div class="row">
                            <div class="col-md-12">

                              <?php   if (isset($Profilepolicy) && $Profilepolicy != '') { ?>
                                     <p><?php echo $Profilepolicy;?></p>
                                 <?php }else{?>

                                    <p style="text-align: center;">No inforamtion about policies.</p>


                                <?php  }
                                  ?>


                            </div>
                          </div>
                        </div>


                         <div class="tab-pane fade " id="tab5success" style="padding: 4px;">
                      <?php $pro = new _spprofiles;

                                  $r = new _spstorereview_rating;
                                   $res2 = $r->readallrating($_GET['userid']);

                                 // $totalreviews = $sumres->num_rows;

                                 //   echo $r->ta->sql;  

                                   //print_r($res2);

                                   if($res2 != false){


                                        while ($raterow = mysqli_fetch_assoc($res2)) {

                                            // echo "<pre>";
                                            // print_r($prorow);
                                         

                                           $proresult = $pro->read($raterow['spProfile_idspProfile']); 
                                          // $proresult = $pro->profileforresume($raterow['uid']); 
                                              
                                            // echo $pro->ta->sql; 

                                              $profilerow = mysqli_fetch_assoc($proresult);

                                             $picture = $profilerow["spProfilePic"];

                                              $username = $profilerow['spProfileName']; 

                                             $useremail = $profilerow['spProfileEmail']; 

                                             echo  $useremail;

                                      //  $postingDate = $r-> spstorePostingDate($row["currentdate"]);
                                           ?>


                          <div class="row">

                              <div class="col-md-2">

                                <?php
          if (isset($picture) && $picture != '') {
            ?>
            <img id="profilepic" data-media="<?php echo (isset($picture)?"1":"0");?>" src="<?php echo (isset($picture))?($picture):''; ?>" alt="Profile Pic" class="img-responsive" style="height: 65px;border-radius: 100%; margin-bottom: 10px;    width: 65px;">
            <?php
          }else{
            ?>
             <img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 65px;border-radius: 100%; margin-bottom: 10px;     width: 65px;">
            <?php
          }
          ?>
                              </div>
                            <div class="col-md-3">
                              <p class="eventcapitalize" style="font-size: 16px;font-weight: bold;color: #1c6121;"><?php echo $username;?></p>
                             <p id='eventrating' class="rating"style="    margin-bottom: 0px; line-height: 6px; margin-left: -6px;">

                                  <!--  <input class="stars" type="radio" id="star5" name="rating" value="5" <?php echo ($row['rating'] >= 5)?'checked="checked"':''; ?>>
 -->
                         <input class="stars" type="radio" id="star5" name="rating" value="5" <?php if($raterow['rating'] == "5") { echo "checked "; }?> 
                              />
                                            <label  style="cursor:pointer ;color: #1c6121; <?php if($raterow['rating'] >= "5") { echo "color: gold";}?>" class = "full" for="star5" title="Awesome - 5 stars" style="color: gold!important;"></label>

                                            <input class="stars" type="radio" id="star4" name="rating" value="4" <?php if($raterow['rating'] == "4") { echo "checked";}?> />

                                            <label style="cursor:pointer; color: #1c6121;<?php if($raterow['rating'] >= "4") { echo "color: gold";}?>" class = "full <?php if($raterow['rating'] == "4") { echo "checkrating "; }?>" for="star4" title="Pretty good - 4 stars"></label>

                                            <input class="stars" type="radio" id="star3" name="rating" value="3" <?php if($raterow['rating'] == "3") { echo "checked";}?> />


                                            <label style="cursor:pointer; color: #1c6121;<?php if($raterow['rating'] >= "3") { echo "color: gold";}?>" class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input style="cursor:pointer;" class="stars" type="radio" id="star2" name="rating" value="2" <?php if($raterow['rating'] == "2") { echo "checked";}?> />

                                            <label style="cursor:pointer; color: #1c6121; <?php if($raterow['rating'] >= "2") { echo "color: gold";}?>" class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input class="stars" type="radio" id="star1" name="rating" value="1" <?php if($raterow['rating'] == "1") { echo "checked";}?> />

                                            <label style="cursor:pointer;color: #1c6121; <?php if($raterow['rating'] >= "1") { echo "color: gold";}?>" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                </p>
                                        </div>

                                       <div class="col-md-7">

                                        <p><?php echo $raterow['review'];?></p>
                                      </div>
                                    </div>
<?php }
                                     }else{?>

                                      <p class="text-center">No Reviews</p>
  <?php                                  }?>

                               
                               </div>


                          <div class="tab-pane fade " id="tab6success" style="padding: 4px;">

                         <form id="contactform" enctype="multipart/form-data"> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">

            <input type="hidden" name="useremail" value="<?php echo  $useremail;?>">
                              <div class="form-group">
                       <label for="sel1">Name:<span class="red">*</span></label>
                       <input type="text" name="cname" id="cnameid" class="form-control" value="<?php echo $ProfileName; ?>" onkeyup="keyupBankfun()">
                        <span id="cnameid_error" style="color:red;"></span>
                        </div>
                      </div>
                         <div class="col-md-6">
                        <div class="form-group">
                       <label for="sel2">Email:<span class="red">*</span> </label>
                        <input type="text" name="cemail" id="cemailid" class="form-control" 
                       value="<?php echo $UserEmailid; ?>" onkeyup="keyupBankfun()">
                         <span id="cemailid_error" style="color:red;"></span>
                        </div>
                      </div>
                    </div>

                         <div class="form-group">
                       <label for="sel3">Message:<span class="red">*</span> </label>
                       <textarea class="form-control" id="cmessageid" name="cmessage" rows="4" onkeyup="keyupBankfun()"></textarea>
                        <span id="cmessageid_error" style="color:red;"></span>
                        </div>   

                        <button class="btn" type="submit" style="background-color: #1c6121;color: #fff; border-radius: 6px;border: none;float: right;">Submit</button>



                            </div>
                          </div>
                        </form>
                        </div>



                    </div>

                       
                    <!-- </div> -->

                </div>
            </div>
        </div>
      </div>


                  
          
        </div>
      </div>
       </div>

  <!-- end tab -->












                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>


 <script type="text/javascript">



$(function () {
  
  $(".basestorebanner").change(function () {
   // alert();
        if (typeof (FileReader) != "undefined") {
            var bannerresults = $("#bannerresults");
            //spPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
        //alert(file[0].size);
        if(file[0].size <= 2097152){
          if (regex.test(file[0].name.toLowerCase())) {
           var reader = new FileReader();
            reader.onload = function (e) {
              var img = $("<span class='fa fa-remove dynamicspimg closed'></span><img class='divbannerimg overlayImage' style='width: 100%; height: 200px;overflow: hidden;' src='" + e.target.result + "'/></div>");
            
              bannerresults.append(img);
              document.getElementById("bannerresults").classList.remove('hidden');
            }
            reader.readAsDataURL(file[0]);
          } else {
            alert(file[0].name + " is not a valid image file.");
            //spPreview.html("");
            return false;
          }
        }else{
          alert(file[0].name + " is too large. Please upload image less then 2Mb.");
          return false;
        }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
      });



  $("#btnbannerimg").click(function(){
           // alert();
            var pid = $("#spProfileId").val();
             var uid = $("#spuserId").val();
            
             var imgCount = $(".divbannerimg").length;

                        var base64image = $(".divbannerimg").attr("src");
                         var arr = base64image.match(/data:image\/[a-z]+;/);
          
                        var ext = arr[0].replace("data:image/", "");
                        ext = ext.replace(";", "");
                     
                   
           
               /* $.post("../store/uploadstorebanner.php", {profileid: pid, userid: uid, bannerPic: base64image, ext: ext}, function (r) {
            //  window.location.reload();
            });*/

              $.ajax({
      url: "../store/uploadstorebanner.php",
      type: "POST",
      data:  {'profileid': pid, 'userid': uid, 'bannerPic': base64image, 'ext': ext},
      success: function(data){
           //console.log(data);
          window.location.reload();

                /*  swal({

                                  title: "Banner Added Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });*/
      },
            
    });
          });

     </script>   


<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#contactform").on('submit', function(e){
  //   alert();
         e.preventDefault();

        var Name= $("#cnameid").val()

        var Email = $("#cemailid").val()
        var Message = $("#cmessageid").val()
    

      //  alert(Bankuser);


        if(Name == "" &&  Email == "" && Message == ""){

           /* $("#shipadd_error").text("Please Enter Address.");*/

            $("#cnameid_error").text("Please Enter Your Name.");
             $("#cnameid").focus();

            $("#cemailid_error").text("Please Enter Email.");
             $("#cemailid").focus();

            $("#cmessageid_error").text("Please Enter Message.");
             $("#cmessageid").focus();


      

         return false;
        }else if (Name == "") {
            
            $("#cnameid_error").text("Please Enter Your Name.");
             $("#cnameid").focus();


             return false;
        }else if (Email == "") {
          
            $("#cemailid_error").text("Please Enter Email.");
             $("#cemailid").focus();

             return false;
        }else if (Message == "") {
          $("#cmessageid_error").text("Please Enter Message.");
             $("#cmessageid").focus();
             
             return false;
        }

   else{
      
        $.ajax({
            type: 'POST',
            url: 'addcontactinfo.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
                
            success: function(response){ 

                         //console.log(data);


                                 swal({

                                  title: "Message Sended Successfully!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

  
            }
        });
      }

    });
});


function keyupBankfun() {

 //alert();
        var Name= $("#cnameid").val()

        var Email = $("#cemailid").val()
        var Message = $("#cmessageid").val()
    

    

   if(Name != "")
  {
    $('#cnameid_error').text(" ");
    
  }
  if(Email != "")
  {
    $('#cemailid_error').text(" ");
 }
   if(Message != "" )
  {
    $('#cmessageid_error').text(" ");
    
  }

       
}

</script>


    </body>
</html>
