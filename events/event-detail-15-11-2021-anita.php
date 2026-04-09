<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    
 if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }

    if (isset($_GET['postid']) && $_GET['postid'] >0) {
        $p = new _spevent;
       // $pf  = new _postfield;

        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $ProTitle   = $row['spPostingTitle'];
            $ProDes     = $row['spPostingNotes'];
            $specification     = $row['specification'];

            $ArtistName = $row['spProfileName'];
            $ArtistId   = $row['spProfiles_idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];
            $expDate    = $row['spPostingExpDt'];

            $pr = new _spprofilehasprofile;
            $result3 = $pr->frndLeevel($_SESSION['pid'], $row['spProfiles_idspProfiles']);
            if($result3 == 0){
              $level = '1st Connection';
            }else if($result3 == 1){
              $level = '1st Connection';
            }else if($result3 == 2){
              $level = '2nd Connection';
            }else if($result3 == 3){
              $level = '3rd Connection';
            }else{
              $level = 'Not Define';
            }

               $venu = $row['spPostingEventVenue'];
               $startDate = $row['spPostingStartDate'];
               $endDate = $row['spPostingEndDate'];
               $startTime = $row['spPostingStartTime'];
               $endTime = $row['spPostingEndTime'];
               $OrganizerId = $row['spPostingEventOrgId'];
               $Organizername = $row['spPostingEventOrgName'];
               $Quantity = $row['ticketcapacity'];

               $dtstrtTime = strtotime($startTime);
               $dtendTime = strtotime($endTime);

            //$result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
              /* if($result_pf){
             $venu = "";
                $startDate = "";
                $endDate = "";
                $startTime    = "";
                $endTime = "";
                $OrganizerId = "";
                $Quantity = '';
                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                    
                    if($venu == ''){
                        if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                            $venu = $row2['spPostFieldValue'];

                        }
                    }
                    if($startDate == ''){
                        if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                            $startDate = $row2['spPostFieldValue'];

                        }
                    }
                    if($endDate == ''){
                        if($row2['spPostFieldName'] == 'spPostingEndDate_'){
                            $endDate = $row2['spPostFieldValue'];

                        }
                    }
                    if($startTime == ''){
                        if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                            $startTime = $row2['spPostFieldValue'];

                        }
                    }
                    if($endTime == ''){
                        if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                           $endTime = $row2['spPostFieldValue']; 

                        }
                    }
                    if($OrganizerId == ''){
                        if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
                            $OrganizerId = $row2['spPostFieldValue'];

                        }
                    }
                    if($Quantity == ''){
                        if($row2['spPostFieldName'] == 'ticketcapacity_'){
                            $Quantity = $row2['spPostFieldValue'];

                        }
                    }
                }
                $dtstrtTime = strtotime($startTime);
                $dtendTime = strtotime($endTime);
            }
       */



        }

        

    }else{
        $re = new _redirect;
        $redirctUrl = "../events";
        $re->redirect($redirctUrl);
    }

    if(isset($_GET['visibility']) && $_GET['visibility'] == -1){
        $visibil = 1;
    }else{
        $visibil = 0;
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <!-- this script for slider art -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
        <script>
            function checkqty(txb) {                
                var qty = parseInt(txb);
                var actualQty = $("#spOrderQty").val();
                //alert(actualQty);return false;
                //console.log(actualQty);
                if(qty > actualQty){
                    document.getElementById("newValue").value = actualQty;
                }
                if(qty < 1){
                    document.getElementById("newValue").value = 1;
                    //alert("less");
                }

                $('#payqty').val($('#newValue').val());
            }
        </script>
        
<style type="text/css">
  div#profileshow {
    padding-left: 0!important;
}
div#groupshow {
    padding-left: 0!important;
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
	
.ui-autocomplete.ui-menu {
    background: #fff;
    max-width: 20%;
    border: 1px solid #c5c5c5;
    font-size: 1em;
	padding: 3px 3em 6px 1em;
}
	.ui-autocomplete.ui-menu .ui-menu-item {
    line-height: 26px;
    letter-spacing: 0.5px;
}
	
	/* * Pure CSS star rating that works without reversing order * of inputs * ------------------------------------------------------- * NOTE: For the styling to work, there needs to be a radio * input selected by default. There also needs to be a * radio input before the first star, regardless of * whether you offer a 'no rating' or 0 stars option * * This codepen uses FontAwesome icons */
 #full-stars-example {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* set icon padding and size */
	/* set default star color */
	/* set color of none icon when unchecked */
	/* if none icon is checked, make it red */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
	/* make none icon grey on rating group hover */
	/* make none icon red on hover */
}
 #full-stars-example .rating-group {
	 display: inline-flex;
}
 #full-stars-example .rating__icon {
	 pointer-events: none;
}
 #full-stars-example .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #full-stars-example .rating__label {
	 cursor: pointer;
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #full-stars-example .rating__icon--star {
	 color: orange;
}
 #full-stars-example .rating__icon--none {
	 color: #eee;
}
 #full-stars-example .rating__input--none:checked + .rating__label .rating__icon--none {
	 color: red;
}
 #full-stars-example .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example .rating-group:hover .rating__label .rating__icon--star {
	 color: orange;
}
 #full-stars-example .rating__input:hover ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example .rating-group:hover .rating__input--none:not(:hover) + .rating__label .rating__icon--none {
	 color: #eee;
}
 #full-stars-example .rating__input--none:hover + .rating__label .rating__icon--none {
	 color: red;
}
 #half-stars-example {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* set icon padding and size */
	/* add padding and positioning to half star labels */
	/* set default star color */
	/* set color of none icon when unchecked */
	/* if none icon is checked, make it red */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
	/* make none icon grey on rating group hover */
	/* make none icon red on hover */
}
 #half-stars-example .rating-group {
	 display: inline-flex;
}
 #half-stars-example .rating__icon {
	 pointer-events: none;
}
 #half-stars-example .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #half-stars-example .rating__label {
	 cursor: pointer;
	/* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #half-stars-example .rating__label--half {
	 padding-right: 0;
	 margin-right: -0.6em;
	 z-index: 2;
}
 #half-stars-example .rating__icon--star {
	 color: orange;
}
 #half-stars-example .rating__icon--none {
	 color: #eee;
}
 #half-stars-example .rating__input--none:checked + .rating__label .rating__icon--none {
	 color: red;
}
 #half-stars-example .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #half-stars-example .rating-group:hover .rating__label .rating__icon--star, #half-stars-example .rating-group:hover .rating__label--half .rating__icon--star {
	 color: orange;
}
 #half-stars-example .rating__input:hover ~ .rating__label .rating__icon--star, #half-stars-example .rating__input:hover ~ .rating__label--half .rating__icon--star {
	 color: #ddd;
}
 #half-stars-example .rating-group:hover .rating__input--none:not(:hover) + .rating__label .rating__icon--none {
	 color: #eee;
}
 #half-stars-example .rating__input--none:hover + .rating__label .rating__icon--none {
	 color: red;
}
 #full-stars-example-two {
	/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
	/* make hover effect work properly in IE */
	/* hide radio inputs */
	/* hide 'none' input from screenreaders */
	/* set icon padding and size */
	/* set default star color */
	/* if any input is checked, make its following siblings grey */
	/* make all stars orange on rating group hover */
	/* make hovered input's following siblings grey on hover */
}
 #full-stars-example-two .rating-group {
	 display: inline-flex;
}
 #full-stars-example-two .rating__icon {
	 pointer-events: none;
}
 #full-stars-example-two .rating__input {
	 position: absolute !important;
	 left: -9999px !important;
}
 #full-stars-example-two .rating__input--none {
	 display: none;
}
 #full-stars-example-two .rating__label {
	 cursor: pointer;
	 padding: 0 0.1em;
	 font-size: 2rem;
}
 #full-stars-example-two .rating__icon--star {
	 color: orange;
}
 #full-stars-example-two .rating__input:checked ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 #full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
	 color: orange;
}
 #full-stars-example-two .rating__input:hover ~ .rating__label .rating__icon--star {
	 color: #ddd;
}
 
	.ui-autocomplete li.ui-menu-item {
    font-size: 10px;
}
</style>



    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <!-- Modal for send a sms -->
        <div id="sendAsms" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 15px; ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Send a sms</h4>
                    </div>
                    <div class="row no-margin">
                        <!-- <div class="col-md-12 no-padding orgifo">
                            <label>Organizer Name (
                            <?php
                            $pro = new _spprofiles;
                            $result7 = $pro->read($OrganizerId);
                            if($result7 != false){
                                $row7 = mysqli_fetch_assoc($result7);
                                ?>
                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>"><?php echo $row7['spProfileName'];?></a>
                                <?php
                            }
                            ?>
                            )</label>
                        </div> -->
                    </div>
                    <form method="post" action="../friendmessage/sendSms.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                        <input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="<?php echo $_SESSION['pid'];?>">
                        <input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="<?php echo $OrganizerId;?>">
                        
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="sp-post-edit">
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" name="spfriendChattingMessage"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn pull-right btnSendSms" <?php echo ($_SESSION['pid'] == $OrganizerId)?'disabled':'';?> id="sendEventSms" style="border-radius: 15px; ">Send Message</button>
                                    <button type="button" class="btn pull-right"  data-dismiss="modal" style="margin-right: 5px; border-radius: 15px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <section class="topDetailEvent">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">

                           <?php 


                                    if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                                        if($_SESSION['count'] <= 1){
                                            $_SESSION['count'] +=1; ?>
                                            <div class="alert alert-success alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $_SESSION['errorMessage'];  ?>
                                            </div> <?php
                                            unset($_SESSION['errorMessage']);
                                        }
                                    } ?>
                           
                    </div>
                        <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="titDetail"><?php echo $ProTitle;?></p>
                        <p class="location eventcapitalize"><i class="fa fa-map-marker"></i> <?php echo $venu;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="transTop">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="detailTopcol text-center">
                                        <h3>Start</h3>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/events/icon-1.png" class="img-responsive">
                                        <p><?php echo $startDate;?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="detailTopcol text-center">
                                        <h3>Ends</h3>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/events/icon-1.png" class="img-responsive">
                                        <p><?php echo $expDate?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="detailTopcol text-center">
                                        <h3>Time Start</h3>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/events/icon-2.png" class="img-responsive">
                                        <p><?php echo date("h:i A", $dtstrtTime); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="detailTopcol text-center">
                                        <h3>Time End</h3>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/events/icon-2.png" class="img-responsive">
                                        <p><?php echo date("h:i A", $dtendTime); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!--  <div class="transTopBtmFoot">
                            <?php
                            $today = date('Y-m-d');
                            $date1 = new DateTime($today);
                            $date2 = new DateTime($startDate);
                            $interval = $date2->diff($date1);
                            ?>
                            <ul>
                                <li>&nbsp;</li>
                                <li><?php echo $interval->format('%m Months');?></li>
                                <li><?php echo $interval->format('%d Days');?></li>
                                <li>&nbsp;</li>
                            </ul>
                        </div> -->

                    </div>
                </div>
            </div>
        </section>
        <section class="main_box">            
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="twolevelEvent">
                            <ul class="social">
                                <li>
                                    <a href="<?php echo $BaseUrl.'/events';?>">
                                        <span class="iconhover"><i class="fa fa-home"></i></span>
                                        Home
                                    </a>
                                </li>
                                <li class="bokmarktab">
                                    <?php
                                    //rating
                                 
                                    $ev = new _event_favorites;
                                    $res_ev = $ev->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                   // echo $ev->ta->sql; 

                                        
                                    

                                    if($res_ev != false){ 


                                    	?>

                                    	   <a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <!-- <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span> -->
                                            <span id="removetofavouriteeve" class="iconhover"><i class="fa fa-heart"></i></span>
                                            Bookmarked
                                        </a>

                                        <?php

                                    	
                                       
                                        }else{
                                        ?>
                                        <a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <span id="addtofavouriteeve" class="iconhover"><i class="fa fa-heart-o"></i></span>
                                            Bookmark
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    
                                </li>
                                <li>

                                    <?php

                                      $r = new _speventreview_rating;

                                  $sumres = $r->readeventrating($_GET["postid"]);

                                  //echo $r->ta->sql;  

                                 
                                  
                                        while ($sumrow = mysqli_fetch_assoc($sumres)) {

                                          //echo "<pre>";
                                        // print_r($sumrow);

                                               

                                           $sumrating += $sumrow['rating'];

                                        $ratarr[] =  $sumrow['rating'];

                                          //echo count($ratarr);


                                        }



                                      $countrate = count($ratarr);

                                       $averagerate = $sumrating / $countrate;

                                           $totalrate  = round($averagerate, 1);
                                           
                                         /*  print_r($totalrate);
                                            print_r($averagerate);*/

                                           ?>

                                    <div class="row reviewdetail">
                                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
                                        <input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
                              <!--           <p id='eventrating' class="rating " style="margin-left: 40px;margin-bottom: 0px;line-height: 14px;">
                                        
                            
                                           <label  style="cursor:pointer; <?php if($totalrate >= "5") { echo "color: gold";}?>" class = "full" for="star5" title="Awesome - 5 stars"></label>

                                          
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" <?php if($totalrate >= "4") { echo "checked";}?>>


                                            <label style="cursor:pointer; <?php if($totalrate >= "4") { echo "color: gold";}?>" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" <?php if($totalrate >= "3") { echo "checked";}?>>


                                            <label style="cursor:pointer; <?php if($totalrate >= "3") { echo "color: gold";}?>" class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" <?php if($totalrate >= "2") { echo "checked";}?>>

                                            <label style="cursor:pointer; <?php if($totalrate >= "2") { echo "color: gold";}?>" class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input class="stars" type="radio" id="star1" name="rating" value="1" <?php if($totalrate >= "1") { echo "checked";}?>>
                                            <label style="cursor:pointer; <?php if($totalrate >= "1") { echo "color: gold";}?>" class = "full" for="star1" title="Sucks big time - 1 star"></label>

 


                                        </p> -->
<!---
                                               <div class="rating-box">
                                      <?php if($totalrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalrate >= "4" && $totalrate < "5") { 
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
                                        <p class="col-md-12 rating">

                                           



                               <a  href="<?php echo $BaseUrl.'/events/showeventrating.php?postid='.$_GET['postid']; ?>">Rating : <?php if($totalrate <= 0 ){ echo "0.0"; }else{ echo $totalrate; } ?></a>
                                        </p>-->
                                    </div>
                                </li>
                                <li>
                                    <?php
                                        $area2 = "";
                                        $area1 = "";
                                        $area0 = "";
                                        $ei = new _eventIntrest;
                                        $result = $ei->chekAlready($_GET['postid'], $_SESSION['pid']);
                                        if($result != false){
                                            $row3 = mysqli_fetch_assoc($result);
                                            $area = $row3['intrestArea'];

                                            if($area == 2){
                                                $area2 = "<i class='fa fa-check'></i>";
                                                $title = "Going";
                                            }else if($area == 1){
                                                $area1 = "<i class='fa fa-check'></i>";
                                                $title = "Interested";
                                            }else if($area == 0){
                                                $area0 = "<i class='fa fa-check'></i>";
                                                $title = "May Be";
                                            }
                                        }else{
                                            $title = "Event";
                                        }

                                          $ie = new _eventIntrest;
                                                                        $resulti1 = $ie->chekGoing($_GET['postid'], 2);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti1 != false && $resulti1->num_rows >0){
                                                                        $going = $resulti1->num_rows;
                                                                        }else{
                                                                          $going =  0;
                                                                        }

                                                                           $resulti2 = $ie->chekGoing($_GET['postid'], 1);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti2 != false && $resulti2->num_rows >0){
                                                                        $interested = $resulti2->num_rows;
                                                                        }else{
                                                                          $interested =  0;
                                                                        }


                                                                          $resulti3 = $ie->chekGoing($_GET['postid'], 0);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti3 != false && $resulti3->num_rows >0){
                                                                        $MayBe = $resulti3->num_rows;
                                                                        }else{
                                                                          $MayBe =  0;
                                                                        }
                                        ?>

                                     <span id="">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    <div class="ie_<?php echo $_GET['postid'];?>">

                                        <div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
                                            <button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;"><?php echo $title;?></button>
                                            <ul class="dropdown-menu ">
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="2"><?php echo $area2;?> Going (<?php echo $going; ?>) </a></li>
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="1"><?php echo $area1;?> Interested (<?php echo $interested; ?>)</a></li>
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="0"><?php echo $area0;?> May Be (<?php echo $MayBe; ?>)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                
                                <li>
                                    <?php
                                    $pic = new _eventpic;
                                    $res2 = $pic->read($_GET['postid']);
                                    if ($res2 != false) {
                                        $rp = mysqli_fetch_assoc($res2);
                                        $pic2 = $rp['spPostingPic'];
                                        //echo "<img alt='Posting Pic' class='img-responsive img-big' src=' " . ($pic2) . "' >";
                                    } else{
                                        //echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive img-big'>";
                                    }
                                    
                                    ?>
                                    <a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'>

                                        <span class='sp-share-art iconhover' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pic2); ?>'>
                                            <i class="fa fa-share-alt"></i>
                                        </span>
                                        Share
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="titleEvent">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="hostedbyevent">
                                            <!-- <a href="javascrpit:void(0)" data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms btn butn_save">Contact Organizer</a>                                    -->
                                            <label style="margin-left: 15px;">Organizer (s):</label>
 
                                                                <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $pic->getOrganizerName($Organizername);?></a>
                                                               
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-7">

                                     
                                <?php
								// ===PAYPAL ACCOUNT LIVE SETTING
								// RETURN CANCEL LINK
								$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								$success_return = $BaseUrl."/paymentstatus/event_payment_success.php?postid=".$_GET['postid']."&sellid=".$ArtistId;

                               // print_r($success_return);
								// ===END
								// ===LOCAL ACCOUNT SETTING
								// RETURN CANCEL LINK
								//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
								// RETURN SUCCESS LINK
								//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
								// ===END



								//Here we can use paypal url or sanbox url.
								// sandbox
								$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
								// live payment
								//$paypal_url		= 'https://www.paypal.com/cgi-bin/webscr';
								//Here we can used seller email id. 
								$merchant_email = 'developer-facilitator@thesharepage.com';
								// live email
								//$merchant_email = 'sharepagerevenue@gmail.com';
																
								//paypal call this file for ipn
								//$notify_url 	= "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
								?>


	
								<form action="<?php echo $paypal_url; ?>" method="post" class="form-inline text-right">
									<input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
									<!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
									<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
									<input type="hidden" name="return" value="<?php echo $success_return; ?>">
									<input type="hidden" name="rm" value="2" />
        							<input type="hidden" name="lc" value="" />
        							<input type="hidden" name="no_shipping" value="1" />
        							<input type="hidden" name="no_note" value="1" />
        							<input type="hidden" name="currency_code" value="USD">
        							<input type="hidden" name="page_style" value="paypal" />
        							<input type="hidden" name="charset" value="utf-8" />
									<input type="hidden" name="cbt" value="Back to FormGet" />

									<!-- Redirect direct to card detail Page -->
									
									<input type="hidden" name="landing_page" value="billing">

									<!-- Redirect direct to card detail Page End -->


									<!-- Specify a Buy Now button. -->
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="upload" value="1">

                                      

									<?php



                                                echo "<input type='hidden' name='item_name_1' value='".$ProTitle."'>";
												echo "<input type='hidden' name='item_number' value='143' >";
												echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_1' value='".$price."'>";
												
												echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
									?>
                               <button type="submit" class="btn butn_cancel pull-right  btn-border-radius" id="Buynow"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket</button>

                                      <!--   <form action="../cart/addorder.php" method="post" class="form-inline text-right">
                                            
                                            <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET['postid'];?>">
                                            <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'];?>">                                    
                                            <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo ($price>0)?$price:'0';?>">
                                            <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php echo $ArtistId;?>"> -->
                                            
                                       <!--      <?php
                                            $buyerid = $_SESSION['pid'];
                                            $od = new  _order;
                                            $res = $od->checkorder($_GET["postid"] , $buyerid);
                                            if ($res != false){ ?>
                                                <button type="button" class="btn butn_cancel pull-right disabled" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Added to cart</button>
                                                <?php
                                                //echo "<button type='button' class='btn btn_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Added to cart</button>";
                                            }else{ ?> -->
                                              <!--   <button type="<?php echo ($visibil == 1 ? "button":"submit");?>" class="btn butn_cancel pull-right <?php echo ($visibil == 1 ? "disabled":"");?>" id="addtocart" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9" style="border-radius: 25px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  <?php echo ($price > 0)?'Buy Ticket':'Free Ticket';?></button> -->
                                               <!--  <button type="<?php echo ($visibil == 1 ? "button":"submit");?>" class="btn butn_cancel pull-right <?php echo ($visibil == 1 ? "disabled":"");?>" id="addtocart" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9" style="border-radius: 25px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  <?php echo ($price > 0)?'Buy Ticket':'Free Ticket';?></button> -->
                                              <!--   <?php
                                                echo "<button type='submit' class='btn btn_cart".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Add to cart</button>";
                                            }
                                            ?> -->
                                            <div class="form-group price">
                                                <span style="font-size: 20px;">Ticket Price: <span class="red_clr"><strong>$<?php echo $price;?></strong></span></span>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label >Available Quantity: <span class="red_clr">(<?php echo (isset($Quantity))?$Quantity:'1';?>)</span> <span class="gray_clr">></span> </label>
                                            </div> -->
                                            <div class="form-group price">
                                                <span style="font-size: 20px;">Quantity</span>
                                                <input type="hidden" id="spOrderQty" value="<?php echo (isset($Quantity))?$Quantity:'1';?>"> 
                                                <input type="number" class="form-control no-radius" style="width: 60px;margin-right: 5px" id="newValue" name="spOrderQty" placeholder="" value="1" onkeyup="checkqty(this.value);" >
                                            </div>
                                            
                                    <!--     </form> -->

</form>
								
                                        


                                    </div>
                                </div>
                                <hr class="hrline">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="eventcapitalize">Event <span>Details</span></h2>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        if($visibil == 1){
                                            ?>
                                            <!--Privew Button Code button-->
                                            <div class="<?php echo ($visibil == 1?"":"hidden");?>">
                                                <div class="text-center" style="margin-bottom:10px;">
                                                    <button type="button" id="submitpost" class="btn butn_save" data-visibility="-1" data-postid="<?php echo $_GET["postid"]; ?>">Submit</button>
                                                    <button type="button" id="saveindraft" class="btn butn_draf">Save Draft</button>                                                    
                                                    
                                                </div>
                                            </div>
                                            <!--Completed-->
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="text-justify eventcapitalize"><?php echo $ProDes;?></p>
                                        
                                        <h2 style="font-size: 18px;">Available Tickets: <span><?php echo ($Quantity > 0)?$Quantity:'House Full'; ?></span></h2>
                                        <div class="space"></div>
                                        <p><a href="javascript:void(0)"  data-toggle="modal" data-target="#flagPost" class="text-left flag" style="color: #000;"><i class="fa fa-flag"></i> Flag Event</a></p>
                                        <!-- Modal -->
                                        <div id="flagPost" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <form method="post" action="addtoflag.php" class="sharestorepos" id="addflagdata">
                                                    <div class="modal-content bradius-15">
                                                        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
                                                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                        <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
                                                        <div class="modal-header bg-white br_radius_top">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Flag Post</h4>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="radio">
                                                                <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>


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
                                                            <textarea class="form-control" name="flag_desc" placeholder="Add Comments" 
                                                            id="flag_desc"  onkeyup="keyupflagfun()" maxlength="500"></textarea>
                                                            
                                                            <span id="flagdesc_error" style="color:red; font-size: 12px;"></span>
                                                        </div>
                                                        <div class="modal-footer bg-white br_radius_bottom">
                                                            <input type="submit" name="" class="btn butn_mdl_submit submitevent">
                                                            <button type="button" class="btn butn_cancel homecancelbtn" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        //this is posting for featured pic
                                        $pic = new _eventpic;
                                        $res2 = $pic->readFeature($_GET['postid']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive center-block' src=' " . ($pic2) . "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive center-block'>"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($_GET['postid']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive center-block' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive center-block'>"; 
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

        <section class="eventGallery">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" id="navtabFrnd" style="border-radius: 20px;">
                            <li class="active" ><a data-toggle="tab" href="#home" style="border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;">Gallery</a></li>
                            <!-- <li><a data-toggle="tab" href="#menu1">Video</a></li> -->
                           <!--  <li><a data-toggle="tab" href="#menu2">Reviews</a></li> -->
                            <li><a data-toggle="tab" href="#menu3">Sponsors</a></li>
                            <li><a data-toggle="tab" href="#menu4">Featuring</a></li>
                            <li><a data-toggle="tab" href="#menu5">Contact Organizer</a></li>
                            <li><a data-toggle="tab" href="#menu6">Specification</a></li>
                        </ul>

                        <div class="tab-content" style="min-height: 300px;">
                            <div id="home" class="tab-pane fade in active">
                                <div class="space"></div>
                                <div class="row">
                                    <?php
                                    $pic = new _eventpic;
                                    $res2 = $pic->read($_GET['postid']);

                                    if ($res2 != false) {
                                        while ($rp = mysqli_fetch_assoc($res2)) {
                                            $pic2 = $rp['spPostingPic'];
                                            ?>
                                            <div class="col-md-3">
                                                <div class="EvntImg">
                                                    <a class="thumbnail eventpostimg" rel="lightbox[group]" href="<?php echo ($pic2);?>" title="<?php echo $ProTitle;?>">
                                                        <img class="group1 eventpostimg" src="<?php echo ($pic2);?>">
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                            <?php
                                        }                        
                                    }else{
                                                  echo"<h3 class='text-center'>No record Found!</h3>";
                                                } ?>
                                </div>
                            </div>

                            <div id="menu1" class="tab-pane fade">
                                <div class="space"></div>
                                <div class="row">
                                    <?php
                                    $media = new _postingalbum;
                                    $result = $media->read($_GET['postid']);
                                    if ($result != false) {
                                        $r = mysqli_fetch_assoc($result);
                                        $picture = $r['spPostingMedia'];
                                        $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                        $sppostingmediaExt = $r['sppostingmediaExt'];
                                        if($sppostingmediaExt == 'mp4'){ ?>
                                            <div class="col-md-offset-3 col-md-6">
                                                <div style='margin-left:15px;margin-right:15px;'>
                                                    <video  style='max-height:300px;width: 100%' controls>
                                                        <source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
                                                    </video>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                
                            </div>
                            <div id="menu3" class="tab-pane fade ">
                                
                                <div class="">
                                    <div class="space"></div>
                                    <div class="SponsrTitle">
                                  
                                        <?php
                                        $SpCat = "General";
                                        include('sponsor.php');
                                        ?>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div id="menu4" class="tab-pane fade">
                                <h3>Featuring</h3>
                                <div class="row">
                                    <?php
									$pf  = new _spevent;
									$pro = new _spprofiles;
									$result6 = $pf->readFeaturPost($_GET['postid']);
									//echo $pf->ta->sql."<br>";
									if($result6 != false){
										while ($row6 = mysqli_fetch_assoc($result6)) {
											if($row6['addfeaturning'] != ''){
												$profileId = $row6['addfeaturning'];
												$result7 = $pro->read($profileId);
												if($result7 != false){
													$row7 = mysqli_fetch_assoc($result7);
													?>
													<div class="col-md-3">
									<div class="featuringBox row bg_white no-margin">
						<a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
						<div class="col-md-3 no-padding">
																	<?php 
																	echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../assets/images/blank-img/default-profile.png")."'>";
																	?>
									</div>
				<div class="col-md-9 no-padding">
																	<h4 class="eventcapitalize"><?php echo $row7['spProfileName'];?></h4>
																</div>
															</a>
														</div>
													</div>
													<?php
												}
											}else{
                                                  echo"<h3 class='text-center'>No record Found!</h3>";
                                                }
										}
									}else{
                                        echo"<h3 class='text-center'>No record Found!</h3>";
                                    }
									?>
                                    

                                </div>
                            </div>
                            <div id="menu5" class="tab-pane fade">
                                <div class="space"></div>
                                <div class="row">
                                    <?php
                                    //organizer id......
                                    $pro = new _spprofiles;
                                    $result7 = $pro->read($OrganizerId);
                                    if($result7 != false){
                                        $row7 = mysqli_fetch_assoc($result7);
                                        ?>
                                        <div class="col-md-3">
                                            <div class="featuringBox row bg_white no-margin"
                            style=" border-radius: 15px;">
                                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
             <div class="col-md-3 no-padding">
                                                        <?php 
                    echo "<img  alt='profile-Pic' style='border-radius: 10px;' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                        ?>
                                                    </div>
                                                       </a>
                                                <div class="col-md-9 no-padding">
                                                    <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
                                                        <h4 class ="eventcapitalize"><?php echo $row7['spProfileName'];?></h4>
                                                    </a>
                                                           <span class="dropdown">
                                                            <button type="button" class="btn btnPosting db_btn db_primarybtn dropdown-toggle" data-sender="" data-reciver="<?php echo $_GET["profileid"];?>" style="margin:5px;padding: 5px 7px!important;font-size: 8px!important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane"></span> Send Message</button>
                                                            
                                                            <div class="dropdown-menu bradius-15" id="popform" aria-labelledby="dropdownMenu1">
                                                                <form action="" method="post">
                                                                    <div class="form-group" style="margin:3px;">
                                                                        <textarea class="form-control frndmsg" rows="4" id="sndmsg" name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
                                                                    </div>
                                                                    
                                                                    <button type="button" class="btn btn-primary pull-right wthmsg db_btn db_primarybtn" data-reciver="<?php echo $OrganizerId;?>" data-sender="<?php echo $_SESSION['pid'];?>" id="sendermesg">Send</button>
                                                                </form>
                                                            </div>
                                                        </span>
                                                    </div>
                                             
                                                <div class="col-sm-12">
                                                     
                                                    <!-- <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms">Contact Organizer</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                                  echo"<h3 class='text-center'>No record Found!</h3>";
                                                } 
                                    //co-Host persons.
                                    $pf  = new _postfield;
                                    $pro = new _spprofiles;
                                    $ei  = new _eventJoin;
                                    if(isset($_GET['postid']) && $_GET['postid'] > 0){
                                        $fieldName = "spPostingCohost_";
                                        $result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
                                        //echo $pf->ta->sql."<br>";
                                        if($result6 != false){
                                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                                if($row6['spPostFieldValue'] != ''){
                                                    $profileId = $row6['spPostFieldValue'];
                                                    $result7 = $pro->read($profileId);
                                                    if($result7 != false){
                                                        $row7 = mysqli_fetch_assoc($result7);
                                                        ?>
                                                        <div class="col-md-3">
                                                <div class="featuringBox row bg_white no-margin"style="border-radius: 15px;">
                     <a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
                                                                    <div class="col-md-3 no-padding">
                                                                        <?php 
                                                                        echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                                        ?>
                                                                    </div>
                                                                    <div class="col-md-9 no-padding">
                                                                        <h4><?php echo $row7['spProfileName'];?></h4>
                             </a>
                                 <div class="col-sm-12">
                                                                    <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms getCntactid">Contact Organizer</span>
                                                     </div>
                                                            </div>
                                                        </div>
                                                        <!-- <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $row7['spProfileName'];?></a>, -->
                                                        <?php
                                                    }
                                                    
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                              <div id="menu6" class="tab-pane fade">
                              
                                <div class="row">
                                    <?php
                                  
                                    if(!empty($specification)){
                                      
                                                    ?>
                                                    <div class="col-sm-12">
                                                     <p style="padding-top: 20px;padding-left: 20px;"><?php echo $specification; ?></p>
                                                    </div>
                                                    <?php
                                               
                                          
                                    }else{
                                        echo"<h3 class='text-center'>No record Found!</h3>";
                                    }
                                    ?>
                                    

                                </div>
                            </div>
                            <!-- End tabs -->
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>
        
        <?php include('postshare.php');?>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- image gallery script strt -->
        <script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
        <script type="text/javascript">
      
$(document).ready(function() {
  //alert();
	  $(".mySelect").select2();
  $('.submitevent').click(function() {
  //  alert();

var flagdesc = $('#flag_desc').val(); 
if (flagdesc == "" ){
$('#flagdesc_error').text("This Field is Required."); 
$("#flag_desc").focus();
 return false;

}else {
$("#addflagdata").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});
</script>
 

 <script type="text/javascript">
function keyupflagfun() {

  var flagdesc= $("#flag_desc").val()

   if(flagdesc != "")
  {
    $('#flagdesc_error').text(" ");
  
  }
  
       
}
</script>       
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
            // Colorbox Call
            $(document).ready(function(){
                $("[rel^='lightbox']").prettyPhoto();
            });
        </script>
        <!-- image gallery script end -->
	</body>
</html>
<?php
}
?>