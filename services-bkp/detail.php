<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "services/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";

    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        $postid = $_GET['postid'];
        $p = new _classified;
        $pf  = new _postfield;

        $result = $p->singletimelines($postid);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            //echo "<pre>"; print_r($row);

            $ProTitle   = $row['spPostingTitle'];
            $ProCat   = $row['spPostSerComty'];
            $skill   = $row['skill'];
            $ProDes     = $row['spPostingNotes'];
           /* $ArtistName = $row['spProfileName'];
            $ArtistId   = $row['spProfiles_idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];*/
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city       = $row['spPostingsCity'];

          /*  $UserEmail  = $row['spProfileEmail'];
            $UserPhone  = $row['spProfilePhone'];*/

             $category = $row['servicecategory'];
                
                $countryAdd    = $row['spPostCountry'];
                $state = $row['spPostState'];
                $cityAdd = $row['spPostCity'];
                $dt = new DateTime($row['spPostingDate']); 
                $PostingDate = $dt->format('d-m-Y');
                $postalCod = $row['spPostPostalCode'];
                $isPhoneShow = $row['spPostShowPhone'];
                $isEmailShow = $row['spPostShowEmail'];
               $pro = new  _spprofiles;
               $resultpro = $pro->read($row['spProfiles_idspProfiles']);

               $rowsp = mysqli_fetch_assoc($resultpro);

               $ArtistName = $rowsp['spProfileName'];
               $ArtistId   = $row['spProfiles_idspProfiles'];
               $ArtistAbout= $rowsp['spProfileAbout'];
               $ArtistPic  = $rowsp['spProfilePic'];
               $UserEmail  = $rowsp['spProfileEmail'];
               $UserPhone  = $rowsp['spProfilePhone'];

              /* print_r($rowsp);*/

            //posting fields
  /*          $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
                $category = "";
                
                $countryAdd    = "";
                $state = "";
                $cityAdd = "";
                $postalCod = "";
                $isPhoneShow = "";
                $isEmailShow = "";

                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                    if($category == ''){
                        if($row2['spPostFieldName'] == 'servicecategory_'){
                            $category = $row2['spPostFieldValue'];
                        }
                    }
                    if($state == ''){
                        if($row2['spPostFieldName'] == 'spPostState_'){
                            $state = $row2['spPostFieldValue'];
                        }
                    }
                    if($countryAdd == ''){
                        if($row2['spPostFieldName'] == 'spPostCountry_'){
                            $countryAdd = $row2['spPostFieldValue'];
                        }
                    }
                    if($cityAdd == ''){
                        if($row2['spPostFieldName'] == 'spPostCity_'){
                            $cityAdd = $row2['spPostFieldValue'];
                        }
                    }
                    if($postalCod == ''){
                        if($row2['spPostFieldName'] == 'spPostPostalCode_'){
                            $postalCod = $row2['spPostFieldValue'];
                        }
                    }
                    if($isPhoneShow == ''){
                        if($row2['spPostFieldName'] == 'spPostShowPhone_'){
                            $isPhoneShow = $row2['spPostFieldValue'];
                        }
                    }
                    if($isEmailShow == ''){
                        if($row2['spPostFieldName'] == 'spPostShowEmail_'){
                            $isEmailShow = $row2['spPostFieldValue'];
                        }
                    }
                }
            }*/


        }

        //rating
        $r = new _sppostrating;
        $res = $r->read($_SESSION["pid"],$_GET["postid"]);
        if($res != false){
            $rows = mysqli_fetch_assoc($res);
            $rat = $rows["spPostRating"];
        }else{
            $rat = 0;
        }
            
        $result = $r->review($_GET["postid"]);
        if($result != false){
            $total = 0;
            $count = $result->num_rows;
            while($rows = mysqli_fetch_assoc($result)){
                $total += $rows["spPostRating"];
            }
            $ratings = $total/$count;
        }else{
            $ratings = 0;
        }

    }else{
        $re = new _redirect;
        $redirctUrl = "../services";
        $re->redirect($redirctUrl);
    }

    $st  = new _state;
    $c   = new _country;
    $ci  = new _city;
    // provision name
    $result2 = $st->readStateName($state);
    //echo $st->ta->sql;
    if($result2 != false){
        $row2 = mysqli_fetch_assoc($result2);
        $stateTitle = $row2['state_title'];
    }else{
        $stateTitle = "";
    }
    // county name
    $result3 = $c->readCountryName($countryAdd);
    //echo $c->ta->sql;
    if($result3 != false){
        $row3 = mysqli_fetch_assoc($result3);
        $countryTitle = $row3['country_title'];
    }else{
        $countryTitle = "";
    }
    // city name
    $result4 = $ci->readCityName($cityAdd);
    //echo $ci->ta->sql;
    if($result4 != false){
        $row4 = mysqli_fetch_assoc($result4);
        $cityTitle = $row4['city_title'];
    }else{
        $cityTitle = "";
    }
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <link href="<?php echo $BaseUrl; ?>/assets/zoom/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <script src="<?php echo $BaseUrl; ?>/assets/zoom/lib/blowup.js"></script>
    </head>
<style>
    #myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content2 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

.active_car{
    border: 3px solid #09a4ae !important;
}

/* Add Animation */
.modal-content2, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #FFFFFF;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #FFFFFF;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content2 {
    width: 100%;
  }
}
   #targett{
	   target:none;
	   height : opx;
   }
   
   .hide-bullets {
    list-style: none;
    margin-top: 300px;
    padding: 0;
}
div#carousel-bounding-box {
    height: 4px;
}
  
</style>
    <body class="bg_gray">
         <?php
        include_once("../header.php");
        ?>
        <?php include('postshare.php');?>
        <section>
            <div class="row no-margin">
                <!-- <div class="col-md-2 no-padding">
                  <?php include('../component/left-services.php');?> 
                </div> -->
                <div class="col-md-12 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">

                           <!--  <div class="col-md-12 no-padding">
                                <div class="fulmainarttab">
                                    <ul class='nav nav-tabs' id='navtabser' >
                                        <li role="presentation" class="active"><a href="#video1" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ProTitle; ?></a></li> 
                                        
                                    </ul>
                                    <div class="linebtm"></div>
                                </div>
                            </div> -->
                            <div class="col-md-12 no-padding">

                               <!--  <div class="row no-margin topServBread">
                                    <div class="col-md-12 no-padding">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/services';?>"><i class="fa fa-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/services/category.php';?>">All Category</a></li> 
                                                <li class="breadcrumb-item active" aria-current="page">Detail</li> 
                                            </ol>
                                        </nav>
                                    </div>
                                </div> -->

                                  <!-- <?php include('servicemodule.php'); ?> -->
                                  <?php

                                    $postid = $_GET['postid'];
                                    $post_name = new _classified; 
                                    $result1 = $post_name->singletimelines($postid);
                                    if($result1 != false){
                                        $row2 = mysqli_fetch_assoc($result1);?>
                                        <div class="col-md-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 97%;margin-top: 22px;margin: 20px 8px 20px 13px;">
                        
                                            <h3 style="margin-top: 10px!important;">Classified Ads <strong><?php echo $row2['spPostSelection'] ?></strong>
											
											<a  href="<?php echo $BaseUrl.'/services/dashboard'; ?>" class = "pull-right" style="font-size:20px">&nbsp;DASHBOARD&nbsp;</a>
											<a href="<?php echo $BaseUrl.'/services'; ?>" class = "pull-right" style="font-size:20px">&nbsp;HOME&nbsp;/</a>
											
											</h3>  
											
											

											
                                        </div>
                                     <?php }?>   


                                  <div class="col-md-12">
                            <?php
                            if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
                                <p class="alert alert-success error_show" style="background-color: #00a65a !important;color:#FFF!important;"><?php echo $_SESSION['err'];?></p><?php
                                $_SESSION['count']++;
                                unset($_SESSION['err']);
                            }
                            ?>
                        </div>
                                <div class="tab-content no-radius otherTimleineBody" style="padding: 20px 20px;">



                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">
                                        <div class="artistDetail">
                                            
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="bg_white ArtistSong leftServ">
                                                           <!-- <h4><a href="<?php echo $BaseUrl.'/services'; ?>" class=""><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back to Home </a></h4>-->
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <h3><strong><?php echo ucwords($ProTitle); ?> </strong>
                                                                        <?php if ($cityTitle !='' && $stateTitle !='') {?>
                                                                            <small>(<?php echo $cityTitle.', '.$stateTitle;?>)</small>
                                                                       <?php } ?>
                                                                    </h3>         
                                                                </div>
																<div class="col-md-3">
																<div class="row reviewdetail social socialicon ">
                                                                        <?php if($ArtistId != $_SESSION['pid']){ ?>
                                                                        <div class="col-md-1 classified">

                                                                             <?php
                                                                                $fv = new _favorites;
                                                                                $res_fv = $fv->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                                                                //echo $fv->ta->sql;
                                                                                if($res_fv != false){ ?>
                                                                                    <a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                                                        <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
                                                                                    </a><?php
                                                                                    //echo '<li><a data-postid="'. $_GET["postid"].'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
                                                                                }else{
                                                                                    ?>
                                                                                    <a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                                                        <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                                                                    </a>
                                                                                    <?php
                                                                                }
                                                                                
                                                                                 $pc = new _classifiedpic;
                                                                                 $res = $pc->readall($_GET["postid"]);
                                                         
                                                                                 $active1 = 0;
                                                                                 if ($res != false) {
                                                                                 $postr = mysqli_fetch_assoc($res);
                                                                                 $pictp = $postr['spPostingPic']; 
                                                                                 }
                                                                    
                                                                                
                                                                                ?>
                                                                              
                                                                        </div>

                                                                    <?php } ?>
                                                                       <!--  <p>
                                                                            <fieldset id='postrating' class="rating">
                                                                                <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                                                                <label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                                                <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                                                                <label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                                                <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                                                                <label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
                                                                                <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" />
                                                                                <label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                                <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                                                                <label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                                            </fieldset>
                                                                            
                                                                            
                                                                        </p>
                                                                        <p class="col-md-12">
                                                                            <?php  echo "Rating: <span id='rate'>".round($ratings,2)."</span>"; ?>
                                                                        </p> -->
                                                                        <div class="col-md-6">
                                                                        <a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare' class="shareimgicon">
                                                                                <span class='sp-share-art' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pictp); ?>'>
                                                                                    <i class="fa fa-share-alt"></i> Share
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
																</div>
																<div class="col-md-4">
																	
															<div style="float:right">
                                                                                   <?php
																				   $diff = strtotime(date("d-m-Y")) - strtotime($PostingDate);
																				   echo "Posted ".abs(round($diff / 86400))." Days Ago";
																				   echo "<br>";
																						echo "on ".$PostingDate; 
																						?>
																	</div>
                                                                </div>
																<div class="col-md-12" style="margin-bottom:-7px">
																<p><span><strong>Category :</strong> </span><?= $ProCat; ?></p>
																</div>
                                                               <div class="col-md-7">
                                                                    <div class="product_slider_box social" >
                                                                    <div id="carousel-bounding-box"id="targett" >
                                                                              <div class="carousel slide" id="myCarousel">
                                                                                <!-- Carousel items -->
                                                                              <div class="carousel-inner productslider">
                                                                                    <?php
                                                                                    $pc = new _postingpic;
                                                                                    $res = $pc->readFeature($_GET["postid"]);
                                                                                    //echo $pc->ta->sql;
                                                                                    $active1 = 0;
                                                                                    if ($res != false) {
                                                                                        while($postr = mysqli_fetch_assoc($res)){
                                                                                            $picture = $postr['spPostingPic']; ?>
                                                                                            <div class="<?php echo ($active1 == 0)?'active':'';?> item" data-slide-number="<?php echo $active1?>">
                                                                                                <?php
                                                                                                if(isset($picture)){ ?>
                                                                                                    <img src="<?php echo ($picture); ?>" alt="Posting Pic" class="img-responsive" style="height: 276px;" > <?php
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
                                                                        <div class="hidden-xs" id="slider-thumbs" >
                                                                            <div class="product_slider_box social bradius-20">
                                                <div id="carousel-bounding-box" style="padding-bottom: 5px;border-bottom: 2px solid #ccc;">
                                                    <div class="carousel slide" id="myCarousestore">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner productslider">
                                                            <?php
                                                            $pc = new _classifiedpic;
                                                            $res = $pc->readall($_GET["postid"]);
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
                                                                            <img id="myImg<?php echo $active1; ?>" class="img_zoom_<?php echo $active1; ?>_t img-responsive" src="<?php echo ($picture); ?>" alt="Posting Pic" style="height: 300px;" > <?php
                                                                        }else{ ?>
                                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > <?php
                                                                        }
                                                                        ?>
                                                                    </div> 
                                                                    <div id="myModal<?php echo $active1; ?>" class="modal2">
                                                                      <span id="close<?php echo $active1; ?>" class="close">&times;</span>
                                                                      <img class="modal-content2" id="img01<?php echo $active1; ?>">
                                                                      <div id="caption<?php echo $active1; ?>"></div>
                                                                    </div>
                                                                    <!--completed-->
                                                                    
                                                                    <script>
                                                                    // Get the modal
                                                                    var modal = document.getElementById("myModal<?php echo $active1; ?>");

                                                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                                                    var img = document.getElementById("myImg<?php echo $active1; ?>");
                                                                    var modalImg = document.getElementById("img01<?php echo $active1; ?>");
                                                                    var captionText = document.getElementById("caption<?php echo $active1; ?>");
                                                                    img.onclick = function(){
                                                                      modal.style.display = "block";
                                                                      modalImg.src = this.src;
                                                                      captionText.innerHTML = this.alt;
                                                                    }

                                                                    // Get the <span> element that closes the modal
                                                                    //var span = document.getElementsByClassName("close")[0];

                                                                    // When the user clicks on <span> (x), close the modal
                                                                    //span.onclick = function() { 
                                                                    $("#close<?php echo $active1; ?>").click(function(){
                                                                      $("#myModal<?php echo $active1; ?>").css("display","none");
                                                                      //modal.style.display = "none";
                                                                    //}
                                                                    });
                                                                    </script>
                                                                    
                                                                    <?php
                                                                    $active1++;
                                                                }
                                                            }
                                                            ?>
                                                        </div><!-- Carousel nav -->
                                                                                     
                                                    </div>
                                                </div>
                                                <div class="hidden-xs" id="slider-thumbs">
                                            <script type="text/javascript">
                                                 jQuery(document).ready(function($) {
                                                           
                                                    $('#carousel-text').html($('#slide-content-0').html());
                                                    //Handles the carousel thumbnails
                                                   $('[id^=carousel-selector-]').click( function(){
                                                        var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                                                        var id = parseInt(id);
                                                        
                                                        if ($('.thumb-box-layer').hasClass('active_car')) {
                                                            $('.thumb-box-layer').removeClass('active_car')
                                                        }
                                                        $(this).addClass('active_car');
                                                        $('#myCarousestore').carousel(id);
                                                    });
                                                    // When the carousel slides, auto update the text
                                                    $('#myCarousestore').on('slid.bs.carousel', function (e) {
                                                        var id = $('.item.active').data('slide-number');
                                                        if ($('.thumb-box-layer').hasClass('active_car')) {
                                                            $('.thumb-box-layer').removeClass('active_car');
                                                        }
                                                        $('.thumb-for-auto-'+id).addClass('active_car');
                                                        $('#carousel-text').html($('#slide-content-'+id).html());
                                                    });
                                                });
                                            </script>
                                                    <!-- Bottom switcher of slider -->
                                                    <ul class="row hide-bullets">
                                                        <?php
                                                        $pc = new _classifiedpic;
                                                        $res = $pc->readall($_GET["postid"]);
                                                        //echo $pc->ta->sql;
                                                        $active1 = 0;
                                                        if ($res != false) {
                                                            $active2 = 0;
                                                            while($postr = mysqli_fetch_assoc($res)){

                                                                //print_r($postr);
                                                                $picture = $postr['spPostingPic']; 
                                                                if($active2 == 0) {
                                                                    $pic = $picture;
                                                                    $carousal_thumb = 'active_car';
                                                                } else {
                                                                    $carousal_thumb = '';
                                                                }
                                                                
                                                                ?>
                                                                <li class="col-sm-2 padding_5 thumb_box">
                                                                    <a class="thumbnail thumb-box-layer <?php echo $carousal_thumb;?> thumb-for-auto-<?php echo $active2;?>" id="carousel-selector-<?php echo $active2;?>">
                                                                        <?php
                                                                        if(isset($picture)){ ?>
                                                                            <img src="<?php echo ($picture); ?>"  style="height: 56px;" alt="Posting Pic" class="img-responsive" > 
                                                                      <?php
                                                                       
                                                                        }else{ 

                                                                          ?>
                                                                           
                                                                            <img src="../img/no.png" alt="Posting Pic" class="img-responsive" > 

                                                                      <?php
                                                                       
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


                                                                            <!-- Bottom switcher of slider -->
                                                                         <!--    <ul class="row hide-bullets">
                                                                                <?php
                                                                                $pc = new _classifiedpic;
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
                                                                                
                                                                                        
                                                                                
                                                                            </ul>  -->                
                                                                        </div>

                                                                        

                                                                    </div>

                                                                </div>
															<div class="col-md-5">
                                                                    <div class="table-responsive">
                                                                        
                                                                        <script>
                                                                            function initMap() {
                                                                                var map = new google.maps.Map(document.getElementById('map'), {
                                                                                    zoom: 5,
                                                                                    center: {lat: -34.397, lng: 150.644}
                                                                                });
                                                                                var geocoder = new google.maps.Geocoder();
                                                                                geocodeAddress(geocoder, map);
                                                                            }
                                                                            function geocodeAddress(geocoder, resultsMap) {
                                                                                var address = "<?php echo $cityTitle.' '.$countryTitle; ?>";
                                                                                //alert(address);
                                                                                geocoder.geocode({'address': address}, function(results, status) {
                                                                                    if (status === 'OK') {
                                                                                        resultsMap.setCenter(results[0].geometry.location);
                                                                                        var marker = new google.maps.Marker({
                                                                                          map: resultsMap,
                                                                                          position: results[0].geometry.location
                                                                                        });
                                                                                    } else {
                                                                                        //alert('Geocode was not successful for the following reason: ' + status);
                                                                                    }
                                                                                });
                                                                            }
                                                                        </script>
                                                                        <table class="table table-striped table-bordered">
                                                                            <tbody>
																			     
                                                                                <tr>
                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong>Postal Code</strong></td>
                                                                                    <td><?php echo $postalCod; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong>Country</strong></td>
                                                                                    <td><?php echo $countryTitle; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong>State</strong></td>
                                                                                    <td><?php echo $stateTitle; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong>City</strong></td>
                                                                                    <td><?php echo $cityTitle; ?></td>
                                                                                </tr>
                                                                                
																				 
                                                                                
                                                                            </tbody>
																			
                                                                        </table>
                                                                    </div>

                                                                    
                                                                <h3 style="margin-top:10px">HIGHLIGHTS OF SERVICES</h3>
																				  <ul>
																					  <?php
																				  $data1 = explode(",",$skill);
																				  foreach($data1 as $data){
																					  echo "<li>".$data."</li>";
																					  
																					  } ?>
																				  </ul>
                                                                </div>
																

                                                            </div>

                                                            
                                                            <div class="row serv_detail_pge">
                                                                
                                                                <div class="space"></div>
                                                                <div class="col-md-12 text-justify">
                                                                    
                                                                    <p><?php echo $ProDes; ?></p>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']?>"/>
                                                                    <input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4" style="padding-left: 0px;">
                                                        <div class="bg_white ArtistSong map_serv_detail m_btm_15">

                                                            <div id="map"></div>
                                                            
                                                        </div>

                                                        <div class="bg_white ArtistSong map_serv_detail m_btm_15">
                                                            <h3>About the poster</h3>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="img_serv_box m_btm_20">
                                                                        <?php
                                                                        if(isset($ArtistPic)){ ?>
                                                                        <a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>">

                                                                            <img src=" <?php echo ($ArtistPic);?>" class="img-responsive img-circle">
                                                                        </a>
                                                                            <?php
                                                                        }else{ ?>
                                                                            <img src="../img/noman.png" class="img-responsive">
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 no-padding">
                                                                    <div class="rightBusinePro">
                                                                        <a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>" class="title"><?php echo ucfirst($ArtistName); ?></a>
                                                                        <p>Business Profile</p>
                                                                       <!--  <a href="javascript:void">Show Other Post(0)</a> -->
                                                                     <!--    <?php
                                                                        if(isset($isPhoneShow) && $isPhoneShow == 1){
                                                                            echo "<p><i class='fa fa-phone'></i>: ".$UserPhone."</p>";
                                                                        }
                                                                        if (isset($isEmailShow) && $isEmailShow == 1) {
                                                                            echo "<p><i class='fa fa-envelope'></i>: ".$UserEmail."</p>";
                                                                        }
                                                                        
                                                                        ?> -->
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            <a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>" class="btn">View Profile</a>
                                                            <p>&nbsp;</p>
                                                           
                                                           <?php


                                                           /*print_r($ArtistId);*/
                                                           //print_r($row);
                                                           /* print_r($_SESSION['pid']);*/



                                                            if($ArtistId != $_SESSION['pid'] && !in_array($ArtistId, $user_profiles_list, TRUE)){ ?>


                                                            <h3>Contact <?php echo $ArtistName; ?></h3>
                                                            
                                                            <form method="post" action="addenquiry.php" class="sndmsgservFrm" >
                                                                <input type="hidden" name="spProfile_idspProfile" value="<?php echo $ArtistId;?>">
                                                                <input type="hidden" name="sender_id" value="<?php echo $_SESSION['pid'];?>">
                                                                <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid']; ?>">
                                                                <textarea class="form-control no-radius m_btm_5" placeholder="Send a message" rows="4" name="enquiry_msg"></textarea>
                                                                <input type="submit" name="" value="Send Message" class="btn ">
                                                            </form>
                                                        </div>
                                                         <a href="javascript:void(0)" style="padding: 2px 10px; color: #000;margin-bottom: 15px;display: block;" data-toggle="modal" data-target="#flagPost">Flag This Post?</a>
                                                        <!-- Modal -->
                                                        <div id="flagPost" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <form method="post" action="addtoflag.php" class="sharestorepos">
                                                                    <div class="modal-content no-radius">
                                                                        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
                                                                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                                        <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Flag Post</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="why_flag" value="Duplicate post" checked>Duplicate post</label>
                                                                            </div>
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                                                                            </div>
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                                                                            </div>
                                                                            <div class="radio">
                                                                                <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                                                                            </div> 

                                                                            <!-- <label>Why flag this post?</label> -->
                                                                            <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="submit" name="" class="btn butn_mdl_submit ">
                                                                            <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>



                                                    <?php } ?>
                                             <!--            <div class="bg_white ArtistSong map_serv_detail m_btm_15">
                                                            <h3>Related Services</h3>
                                                            <?php
                                                            $limit = 3;
                                                            $orderBy = "DESC";
                                                            $p   = new _postingview;
                                                            $pf  = new _postfield;
                                                            $res = $p->publicpost_music($limit, $_GET["categoryID"], $orderBy);
                                                            //echo $p->ta->sql;
                                                            if($res){
                                                                while ($row = mysqli_fetch_assoc($res)){
                                                                    $result_pf = $pf->read($row['idspPostings']);
                                                                    //echo $pf->ta->sql."<br>";
                                                                    if($result_pf){
                                                                        $sercom = "";
                                                                        
                                                                        while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                            if($sercom == ''){
                                                                                if($row2['spPostFieldName'] == 'spPostSelection_'){
                                                                                    $sercom = $row2['spPostFieldValue'];
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <?php
                                                                            $pic = new _postingpic;
                                                                            $res2 = $pic->read($row['idspPostings']);
                                                                            if ($res2 != false) {
                                                                                $rp = mysqli_fetch_assoc($res2);
                                                                                $pic2 = $rp['spPostingPic'];
                                                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                                <?php
                                                                            } else{
                                                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                                <?php
                                                                            } ?>
                                                                        </div>
                                                                        <div class="col-md-8 no-padding">
                                                                            <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title"><?php echo $row['spPostingtitle']; ?></a>
                                                                            <span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
                                                                            <span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>
        
        <?php 
        
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap"></script>
    </body>
</html>
<?php
} ?>