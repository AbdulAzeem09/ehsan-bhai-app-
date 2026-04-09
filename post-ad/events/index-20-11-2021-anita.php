<?php
	include('../../univ/baseurl.php');
	session_start();
	$_GET["module"] = "9";
	$_GET["categoryid"] = "9";
	$_GET["profiletype"] = "1";
	$_GET["categoryname"] = "Events";
	//$BaseUrl = 'http://localhost/the-share-page';
	//include "../index.php";
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $header_event = "events";

    if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }

    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if($res != false){
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"]; 
        $userstate = $ruser["spUserState"]; 
        $usercity = $ruser["spUserCity"]; 
    }
?>
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="The SharePage">
        <meta name="author" content="">
        <title>The SharePage.</title>
        <link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/tsp_trans.png'?>" sizes="16x16" type="image/png">
       <!--  <link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/logo-black.png'?>" sizes="16x16" type="image/png"> -->
        <!--Bootstrap core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!--Font awesome core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
        <!--custom css jis ki wja say issue ho rha tha form submit main-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

        <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/posting/event.js"></script>
        
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
        
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
        <!--post group button on btm of the form-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

        <!--CSS FOR MULTISELECTOR-->
        <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

        
        <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
        
        <script type="text/javascript">
			$(document).ready(function() {
    //This condition will check if form with id 'contact-form' is exist then only form reset code will execute.
    if($('#sp-create-album').length>0){
        $('#sp-create-album')[0].reset(); 
    }
});
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });
            $(function () {
                $('#rightmenu').multiselect({
                    includeSelectAllOption: true
                });
            });
            $(function () {
                $('#cohost').multiselect({
                    includeSelectAllOption: true
                });
            });
        </script>
        <script src="//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initialize"></script>
        <script src="<?php echo $BaseUrl.'/assets/js/jquery.geocomplete.js';?>"></script>
       <!--  <script>
            $(function(){
                $("#spPostingEventVenue_").geocomplete();
            });
        </script> -->

        <!--   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: 0,dateFormat: 'yy-mm-dd'});
  } );
  </script>

        <?php 
        $urlCustomCss = $BaseUrl.'/component/custom.css.php';
        include $urlCustomCss;
        ?>

<style type="text/css">
	
 .ui-widget-header {
    background-color: #ffb8bd!important;
}


input[type=time]::-webkit-inner-spin-button, 
input[type=time]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

	.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btns {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 5px 10px;
  border-radius: 8px;
  font-size: 15px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
/*
input[type=time]::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }*/
	
	.sponsorimg{
	width:100px!important;
	height:100px!important;}

    h3.sponser-title {
        margin-bottom: 20px;
    }
    .footer-button-block {
        margin-bottom: 20px;
    }

</style>

    </head>
	<body onload="pageOnload('post')" >
        <div class="loadbox" >
            <div class="loader"></div>
        </div>
    	<?php 
        
            include_once("../../header.php");
            
            $p = new _spprofiles;
            $rp = $p->readProfiles($_SESSION['uid']);
            $res = $p->readprofilepic($_GET["profiletype"],$_SESSION['uid']);
            if ($res != false){
                $r = mysqli_fetch_assoc($res);
                $name = $r['spProfileName'];
                $icon = $r['spprofiletypeicon'];
            }else{
				$name = "Select Profile";
				$icon = "<i class='fa fa-user'></i>";
			}
            
        ?>
        <!--Add album size-->

                                                                    <!--     <button data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn ">Add Sponsor</button> -->

                                                                        
                                                                          <div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="loadbox" >
                           <div class="loader"></div>
                          </div>
                         
                                <div class="modal-dialog" role="document">
                          

                                    <div class="modal-content sharestorepos no-radius bradius-15" style="border-radius: 15px!important;">
                                        <form action="../../events/dashboard/createsponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
                                            <div class="modal-header  bg-white br_radius_top" style="border-top-left-radius: 15px!important;border-top-right-radius: 15px!important;background-color: #fff!important;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                        
                                                <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <div class="row">
                                                  
                                                 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorTitle">Company<span style="color:red;">*</span></label>
                                                             <span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value=""  onkeyup="keyupsponsorfun()" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
                                                              <span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
                                                             <span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()"/>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="sponsorCategory">Category<span style="color:red;">*</span></label>
                                                        <span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                         <select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
                                                               <option value="">Select Category</option>
                                                                <option class="General">General</option>
                                                                <option class="Prime">Prime</option>
                                                                <option class="Platinum">Platinum</option>
                                                                <option class="Gold">Gold</option>
                                                                <option class="Silver">Silver</option>
                                                                <option class="Media">Media</option>
                                                            </select>
                                                             
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
                                                            <span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" 
                                                            maxlength="500" onkeyup="keyupsponsorfun()"></textarea>
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>
                                                                 
                                                             <input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
                                                                   <span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <p class="help-block"><small>Browse files from your device</small></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9" style="padding-left: 130px;">
                                                                <div class="form-group">
                                                                    <label for="sponsorPreview">Logo Preview</label>


                                                                    <div id="sponsorPreview"></div>
                                                                    <div id="postingsponsorPreview">
                                                                        <div class="row">
                                                                            <div id="spPreview">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer bg-white br_radius_bottom" style="border-bottom-left-radius: 15px!important;border-bottom-right-radius: 15px!important;background-color: #fff!important;">
                                                <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal" style="background: #fab318!important;border-radius: 30px!important;color:#fff;">Close</button>
                                                <button id="addSponser" type="submit" class="btn btn-primary db_btn db_primarybtn" style="background: #032350!important;border-radius: 30px!important;">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                                                 


        <div class="modal fade" id="sponsorAddModala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos no-radius">
                    <form action="../../album/createsponsor.php" method="post" id="sp-create-album" class="no-margin">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor</b></h4>
                        </div>
                        <div class="modal-body">
                        
                            <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sponsorTitle">Sponsor Name</label>
                                        <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sponsorWebsite">Company Website</label>
                                        <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sponsor_idspProfile">Profile</label>
                                        <select class="form-control" name="sponsor_idspProfile">  
                                            <?php
                                            $b = array();
                                            $r = new _spprofilehasprofile;
                                            $pv = new _postingview;
                                            $res = $r->readall($_SESSION["pid"]);//As a receiver
                                            //echo $r->ta->sql;
                                            if($res != false){
                                                while($rows = mysqli_fetch_assoc($res)){
                                                    $p = new _spprofiles;
                                                    $sender = $rows["spProfiles_idspProfileSender"];
                                                    array_push($b,$sender);
                                                    $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                                    //echo $p->ta->sql;
                                                    if($result != false){
                                                        $row = mysqli_fetch_assoc($result);
                                                        echo "<option value='".$rows["spProfiles_idspProfileSender"]."'  >".$row["spProfileName"]."</option>";
                                                    }
                                                }
                                            }
                                            //show profile as sender
                                            $r = new _spprofilehasprofile;
                                            $res = $r->readallfriend($_SESSION["pid"]);//As a sender
                                            //echo $r->ta->sql;
                                            if($res != false){
                                                while($rows = mysqli_fetch_assoc($res)){
                                                    $rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
                                                    if($rm == ""){
                                                        $p = new _spprofiles;
                                                        $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
                                                        if($result != false){
                                                            $receive = $rows["spProfiles_idspProfilesReceiver"];
                                                            $row = mysqli_fetch_assoc($result);
                                                            echo "<option value='".$rows["spProfiles_idspProfilesReceiver"]."' >".$row["spProfileName"]."</option>";
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sponsorCategory">Sponsorship Category</label>
                                        <select class="form-control" name="sponsorCategory">
                                            <option class="General">General</option>
                                            <option class="Prime">Prime</option>
                                            <option class="Platinum">Platinum</option>
                                            <option class="Gold">Gold</option>
                                            <option class="Silver">Silver</option>
                                            <option class="Media">Media</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sponsorDesc">Short Description</label>
                                        <textarea class="form-control" name="sponsorDesc"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="spSponsorPic">Add Logo</label>
                                                <input type="file" class="sponsorPic" name="spSponsorPic">
                                                <p class="help-block"><small>Browse files from your device</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="sponsorPreview">Logo Preview</label>
                                                <div id="sponsorPreview"></div>
                                                <div id="postingsponsorPreview">
                                                    <div class="row">
                                                        <div id="spPreview" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="spaddSponsor" type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Done-->
        <!--Album creation modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos no-radius">
                    <form action="../../album/createalbum.php" method="post" id="sp-create-album" class="no-margin">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><b>Create New Album</b></h4>
                        </div>
                        <div class="modal-body">
                        
                            <input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

                            <input type="hidden" name="sppostingalbumFlag" value="<?php echo $_GET["module"]; ?>">

                            <div class="form-group">
                                <label for="spAlbumName" class="control-label contact">Album Name</label>
                                <input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
                            </div>

                            <div class="form-group">
                                <label for="spAlbumDescription" class="contact">Details about your event</label>
                                <textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="spaddalbum" type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--Done-->
        <!--Exhibition creation modal-->
        <div class="modal fade" id="newExhibition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sharestorepos no-radius">
                    <form action="../../album/createxhibition.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id=""><b>Create New Exhibition</b></h4>
                        </div>
                        <div class="modal-body">
                        
                            <input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                            <input type="hidden" id="spExhibitionImage" name="spExhibitionImage" value="">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="spExhibitionTitle" class="control-label contact">Title</label>
                                        <input type="text" class="form-control" id="spExhibitionTitle" name="spExhibitionTitle">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="spStartDate" class="control-label contact">Starting Date</label>
                                        <input type="date" class="form-control" id="spStartDate" name="spStartDate">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="spEndDate" class="control-label contact">Ending Date</label>
                                        <input type="date" class="form-control" id="spEndDate" name="spEndDate">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="spExhibitionVenu" class="control-label contact">Venu</label>
                                        <input type="text" class="form-control" id="spExhibitionVenu" name="spExhibitionVenu">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="spExhibitionDesc" class="contact">Description</label>
                                <textarea class="form-control" id="spExhibitionDesc" name="spExhibitionDesc"></textarea>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="spaddexhibition" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--Done-->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 no-padding">
                        <div class="left_artform" id="leftArtFrm" style="min-height: 1400px;">
                            <img src="<?php echo $BaseUrl;?>/assets/images/art/left-art-form.jpg" class="img-responsive" alt="" />
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-12">
 <form enctype="multipart/form-data" action="<?php echo $BaseUrl?>/post-ad/dopostevent.php" method="post" id="sp-form-post" name="postform">
                                <div class="event_form">
                                    <div class="modTitle" >
                                       <!--  <h2>Module Name: <span>Events</span></h2> -->
                                        <h2><span>Events</span></h2>
                                    </div>
                                    <h3>
                                        <i class="fa fa-pencil"></i> Submit an event 
                                        <?php
                                        if(isset($_GET['draft']) && $_GET['draft'] > 0){
                                            ?>
                                            <a href="<?php echo $BaseUrl.'/events/dashboard.php';?>" class="pull-right">Back to Dashboard</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="<?php echo $BaseUrl.'/events';?>" class="pull-right">Back to Home</a>
                                            <?php
                                        }
                                        ?>
                                        
                                    </h3>

                                    <div class="add_form_body form-body">

                                        <div class="">
                                            <div class="">
                                                <div >
                                                    <div class="row no-margin">
    													<div class="col-md-12 no-padding">
                                                            <h4>Your Contact Information</h4>
                                                            
                                                            <p>This information will not be shared on the website. We will only use this to contact you if we have questions about your submission.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="space"></div>
                                                <div >
                                                    <?php
                                                    $profileid = "";
                                                    $eCountry = "";
                                                    $eCity = "";
                                                    $eCityID = "";
                                                    $eCategory = "";
                                                    $eSubCategoryID = "";
                                                    $eSubCategory = "";
                                                    $ePostTitle = "";
                                                    $ePostNotes = "";
                                                    $eExDt = "";
                                                    $ePrice = "";
                                                    $shipping = "";

                                   if (isset($_GET["postid"])) {
                                                        //$p = new _postingview;
                                                        $p = new _spevent;
                                                        $r = $p->read($_GET["postid"]);
                                                        //echo $p->ta->sql;
                                                        if ($r != false) {
                                                            while ($row = mysqli_fetch_assoc($r)) {

                                                               // echo "<pre>";
                                                               // print_r($row);
                      echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
																$ePostTitle = $row["spPostingTitle"];
                                                                $ePostNotes = $row["spPostingNotes"];
                                                                 $specification = $row["specification"];
                                                                $eExDt = $row["spPostingExpDt"];
                                                                $ePrice = $row["spPostingPrice"];
                                                                $profileid = $row['idspProfiles'];
                                                                $postingflag = $row['spPostingsFlag'];
                                                                $phone = $row['spProfilePhone'];
                                                                $shipping = $row['sppostingShippingCharge'];
                                                                $eCountry = $row['spPostingsCountry'];
                                                                $eCity = $row['spPostingsCity'];
                                                                
																$eState = $row['spPostingsState'];
																$eeventaddress=	$row['eventaddress'];							
                                       
                                                               // $pf  = new _postfield;
                                                                //$result_pf = $pf->read($_GET['postid']);
                                                                //echo $pf->ta->sql."<br>";
                                                               /* if($result_pf){*/

                                                                    //$organizerId = "";
                                                                    $venu = "";
                                                                    $hallcapicty = "";
                                                                    $ticketCapty = "";
                                                                    $spStartDate = "";
                                                                    $spEndDate   = "";
                                                                    $srtTime     = "";
                                                                    $endTime     = "";
                                                                   // $category    = "";

                                                                      $category = $row['eventcategory'];
                                                                      $organizerId = $row['spPostingEventOrgId'];
																	  $organizerName = $row['spPostingEventOrgName'];
                                                                      $venu = $row['spPostingEventVenue'];
                                                                      $hallcapicty = $row['hallcapacity'];
                                                                      $ticketCapty = $row['ticketcapacity'];
                                                                      $spStartDate = $row['spPostingStartDate'];
                                                                      $spEndDate = $row['spPostingExpDt'];
                                                                      $srtTime = $row['spPostingStartTime'];
                                                                      $endTime = $row['spPostingEndTime'];

/*
                                                                    while ($row2 = mysqli_fetch_assoc($result_pf)) {



                                                                        if($category == ''){
                                                                            if($row2['spPostFieldName'] == 'eventcategory_'){
                                                                                $category = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($organizerId == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
                                                                                $organizerId = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($venu == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                                                                                $venu = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($hallcapicty == ''){
                                                                            if($row2['spPostFieldName'] == 'hallcapacity_'){
                                                                                $hallcapicty = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($ticketCapty == ''){
                                                                            if($row2['spPostFieldName'] == 'ticketcapacity_'){
                                                                                $ticketCapty = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($spStartDate == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                                                                $spStartDate = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($spEndDate == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingEndDate_'){
                                                                                $spEndDate = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($srtTime == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                                                                                $srtTime = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                        if($endTime == ''){
                                                                            if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                                                                                $endTime = $row2['spPostFieldValue'];
                                                                            }
                                                                        }
                                                                       
                                                                    }
                                                                
*/
                                                              /*  }*/
                                                            }
                                                        }
                                                    }
                                                    $p = new _spprofiles;
                                                    $res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

                                                    if ($res != false) {
                                                        $r = mysqli_fetch_assoc($res);
                                                        $profileid = $r['idspProfiles'];
                                                        $country = $r["spProfilesCountry"];
                                                        $city = $r["spProfilesCity"];
                                                    }
                                                    ?>
                                                    
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                        
                    <input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) { echo $_GET["postid"]; } ?>">

                      <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
                                 <input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
                         <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
                                                                
                         <input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
                                                                
                                                                <?php
                                                                $p = new _album;
                                                                $pid = $_SESSION['pid'];
                                                                $albumid = $p->timelinealbum($pid);
                                                                ?>
                                          <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
                                                                <?php
                                                                if (isset($_GET["postid"])) {
                                                                    echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
                                                                }
                                                                ?>
                                                                <!--Art Gallery-->
                                                                <!--Art Gallery complete-->
                                                                <div class="row no-margin">
                                                                    <div class="col-md-12 no-padding">
                                                                <div class="form-group">
                                                                    <label for="spPostingTitle" class="lbl_1">Event Title <span style="color:red;">*</span> <span id="lbl_1" class="label_error"></span> <span style="color:blue;font-weight: 500;font-size: 11px;">(Max 45 characters)</span></label>
                                                                    <input type="text" class="form-control" id="spPostingTitle" maxlength="45" name="spPostingTitle"  value="<?php echo $ePostTitle ?>" placeholder="" required />
                                                                </div>

                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label for="spPostingCountry" class="lbl_2">Country <span style="color:red;">*</span> <span id="lbl_2" class="label_error"></span></label>
                                                                                    <select id="spUserCountry" class="form-control " name="spPostingsCountry">
                                                                                        <option value="0">Select Country</option>
                                                                                        <?php
                                                                                        $co = new _country;
                                                                                        $result3 = $co->readCountry();
                                                                                        if($result3 != false){
                                                                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                                ?>
                                                                                                <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($eCountry) && $eCountry == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                    <!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="loadUserState">
                                                                                    <label for="spUserState" class="lbl_3">State <span style="color:red;">*</span> <span id="lbl_3" class="label_error"></span></label>
                                                                                    <select class="form-control" name="spPostingsState" id="spUserState">
                                                                                        <option value="0">Select State</option>
                                                                                        <?php 
                                                                                        if (isset($eState) && $eState > 0) {
                                                                                            $countryId = $eCountry;
                                                                                            $pr = new _state;
                                                                                            $result2 = $pr->readState($countryId);
                                                                                            if($result2 != false){
                                                                                                while ($row2 = mysqli_fetch_assoc($result2)) {  ?>
                                                                                                 <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($eState) && $eState == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="loadCity">
                                                                                  <!--   <div class="form-group"> -->
                                                                                        <label for="spPostingCity">City<span style="color:red;">*</span> <span id="lbl_city" class="label_error"></span></label>
                                                                                        <select class="form-control" name="spPostingsCity" id="spPostingsCity" >
                                                                                            <option value="0">Select City</option>
                                                                                            <?php 
                                                                                            if (isset($eCity) && $eCity > 0) {
                                                                                                $stateId = $eState;
                                                                                                $co = new _city;
                                                                                                $result3 = $co->readCity($stateId);
                                                                                                //echo $co->ta->sql;
                                                                                                if($result3 != false){
                                                                                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                                                                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($eCity) && $eCity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
                                                                                                    }
                                                                                                }
                                                                                            } ?>
                                                                                        </select>
                                                                                        <!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
                                                                                   <!--  </div> -->
                                                                                </div>
                                                                            </div>

                                                                           <!--  <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="spPostingCountry">Country</label>
                                                                                    <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) && $eCountry != '') ? $eCountry : $country; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="spPostingCity">Location/City</label>
                                                                                    <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) && $eCity != '')? $eCity : $city; ?>">
                                                                                </div>
                                                                            </div> -->

                                                                        </div>
                                                                       
                                                                        <div class="addcustomfields">
                                                                            <!--add custom fields-->
                                                                            <?php
                                                                            if(isset($_GET["postid"])){
                                                                                $f = new _postfield;
                                                                                $res = $f->field($_GET["postid"]);
                                                                                if ($res != false){
                                                                                    while ($result = mysqli_fetch_assoc($res)) {
                                                                                        $row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
                                                                                        //$idspPostField = $result["idspPostField"];
                                                                                    }
                                                                                }
                                                                            }
                                                                            
                                                                            include("../event.php");
                                                                            
                                                                            ?>
                                                                            <!--Getcustomfield-->
                                                                        </div>

																	<div class="row">
																		<div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="spPostingNotes">Write a catchy phrase for your event</label>
                                                                            <textarea class="form-control" id="specification" name="specification" maxlength="500" equired><?php echo $specification ?> </textarea>
                                                                        </div>
																		</div>
																		<div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="spPostingNotes">Details about your event</label>
                                                                            <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500" equired><?php echo $ePostNotes ?> </textarea>
                                                                        </div>
                                                                        </div>
																		</div>

                                                                    </div>
                                                                </div>
                                                                <!--Testing-->
                                                                <div class="col-md-12">
                                                                <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group upload-btn-wrapper">
                                                                           
                                                                            <label for="postingpic">Upload Poster (s)</label>
																			 <button class="btns">Upload a file</button>
                               <input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple">

                              <p class="help-block"><small>Browse files from your device</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group">
                                                                            <label for="postingPicPreview">Picture Preview</label>
                                                                            <div id="imagePreview"></div>
                                                                            <div id="postingPicPreview">
                                                                                <div class="row">
                                                                                    <div id="dvPreview" >
                                                                                        <?php
                                                                                        $i = 1;
                                                                                        $pic = new _eventpic;
                                                          if(isset($_GET['postid'])){
                                                            $res = $pic->read($_GET["postid"]);
                                                                 if ($res != false) {
                                                                 while ($rows = mysqli_fetch_assoc($res)) {
                                                                       $picture = $rows['spPostingPic'];
                                                                          if($rows['spFeatureimg'] == 1){
                                                                                  $select = "checked";
                                                                                                    }else{
                                                                                                        $select = '';
                                                                                                    }
                                                                                                    //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";
                                    echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='".$_GET['postid']."' data-picid='".$rows['idspPostingPic']."'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' ".$select." />Feature Image</label></div>";
                                                                                                    //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
                                                                                                    $i++;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0)?$i:'1'?>" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <!-- <div class="row ">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="postingvideo">Add video </label>
                                                                            <input type="file" id="addvideo" class="spmedia" name="spPostingMedia" accept="video/*">
                                                                            <p class="help-block"><small>Browse files from your device</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div id="media-container"></div>                                                
                                                                </div> -->
                                                                <div class="col-md-12">
                                                                    <h3 class="sponser-title">Sponsor Information</h3>
                                                                <div class="row sponsorInfo ">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group add_spon">
																			<!-- (<a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal">Add Sponsor</a>) -->
																			
                                                  <label for="sponsorId_">Select Sponsor</label>
                                 <select id="rightmenu" class="sp_Sponsor form-control spPostField " name="sponsorId" multiple="multiple" style="width: 100%;">
                                 <?php
                                           $pf  = new _postfield;
                         $allSponsor = array();
                                                                                if(isset($_GET['postid'])){
                                                                                    
                                                                                    $result6 = $pf->readSponsorPost($_GET['postid']);
                                                                                    //echo $pf->ta->sql."<br>";
                                                                                    if($result6 != false){
                                                                                        while ($row6 = mysqli_fetch_assoc($result6)) {
                                                                                            
                                                                                            if($row6['spPostFieldValue'] != ''){
                                                                                                $sponsorId = $row6['spPostFieldValue'];
                                                                                                array_push($allSponsor, $sponsorId);
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }

                                                                                $sp = new _sponsorpic;
                                                                                $result2 = $sp->readAll($_SESSION['pid']);
                                                                                //echo $sp->ta->sql;
                                                                                if($result2 != false){
                                                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                                        if(in_array($row2['idspSponsor'], $allSponsor)){
                                                                                            $spSelect = "selected";
                                                                                        }else{
                                                                                            $spSelect = '';
                                                                                        }
                                                                                        echo "<option value='".$row2['idspSponsor']."' ".$spSelect.">".$row2['sponsorTitle']."</option>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
																			
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    	

                                                                    <!-- 	 <button data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn ">Add Sponsor</button> -->

                                                                      <!--   
                                                                          <div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="loadbox" >
                           <div class="loader"></div>
                          </div>
                         
                                <div class="modal-dialog" role="document">
                          

                                    <div class="modal-content sharestorepos no-radius bradius-15">
                                        <form action="createsponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
                                            <div class="modal-header  bg-white br_radius_top">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                            
                                                <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <div class="row">
                                                  



                                                 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorTitle">Company<span style="color:red;">*</span></label>
                                                             <span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value=""  onkeyup="keyupsponsorfun()" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
                                                              <span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
                                                             <span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()"/>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="sponsorCategory">Category<span style="color:red;">*</span></label>
                                                        <span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                         <select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
                                                               <option value="">Select Category</option>
                                                                <option class="General">General</option>
                                                                <option class="Prime">Prime</option>
                                                                <option class="Platinum">Platinum</option>
                                                                <option class="Gold">Gold</option>
                                                                <option class="Silver">Silver</option>
                                                                <option class="Media">Media</option>
                                                            </select>
                                                             
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
                                                            <span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                            <textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" 
                                                            maxlength="500" onkeyup="keyupsponsorfun()"></textarea>
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>
                                                                 
                                                             <input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
                                                                   <span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <p class="help-block"><small>Browse files from your device</small></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9" style="padding-left: 130px;">
                                                                <div class="form-group">
                                                                    <label for="sponsorPreview">Logo Preview</label>


                                                                    <div id="sponsorPreview"></div>
                                                                    <div id="postingsponsorPreview">
                                                                        <div class="row">
                                                                            <div id="spPreview">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer bg-white br_radius_bottom">
                                                <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal">Close</button>
                                                <button id="addSponser" type="submit" class="btn btn-primary db_btn db_primarybtn">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                                                 

 -->
                                                                <button data-toggle="modal" style="float:right;" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn ">Add Sponsor</button>
                                                                </div>
																	
                                                                </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <!--<a id="PostViewAll" href="../../my-posts/" class="btn btn-primary" role="button" style="width:7cm;">View All Post</a>-->
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--complete-->
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                            </div>


                                    </div>
                                </div>

                            </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                <div class="row no-margin">
                                    <div class="hidden">
                                        
                                        
                                        <!-- <div class="btn-group">-->
                                            <!--<button id="spPostSubmit" type="submit" class="btn btn-success">Public Post</button>-->
                                            <!-- <button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>

                                            <button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" style="height: 34px;"><span class="caret"></span></button>
                                            <ul class="dropdown-menu posttype">
                                                <li><a id="postpublic" style="cursor:pointer;">Public</a></li>
                                                <li><a id="postgroup" style="cursor:pointer;">Group</a></li>
                                            </ul> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-4">
                                        <div id="sp-group-container" class="input-group hidden">
                                            <input class="form-control" id='group_' name="group_" type="text"  placeholder="Type to Select Group..." >

                                            <span class="input-group-btn">
                                                <!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
                                                <a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-right footer-button-block">
                                        <?php
                                        if (isset($_GET["postid"])) {
                                           /* echo "<a class='btn butn_draf' style='border-radius: 30px!important;' href='../deletePost.php?postid=" . $_GET['postid'] . "'>Delete post</a>";*/
                                        }
                                        ?>
                                        <!-- this is preview button -->
                                       <!--  <button type="submit" id="preview" class="btn butn_preview previewbtn">Preview</button> -->
                                        <!-- <button id="spPostSubmit" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button> -->
                                        <button id="spPostSubmitEvent" type="submit" class="btn butn_save savesubmitbtn <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button>

                                        <button id="spSaveDraftevent" type="submit" class="btn butn_draf savedraftbtn <?php echo (isset($_GET['postid']))?'hidden':'';?>">Save Draft</button>
                                        <a href="<?php echo $BaseUrl.'/events';?>" class="btn butn_cancel cancelpostbtn" >Cancel Post</a>
                                        <!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->
                                    </div>
                                </div>
                                </div>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
			</div>
        </section>
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
		<!-- notification js -->
					<div class="retail-wholesheller">
				</div>
					<script type="text/javascript">
        $(function() {
            $('#spPostingPrice').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
            $('#hallcapacity_').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
				
				
           });

              $('#ticketcapacity_').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
				  	
           });
       
        });
    </script> 


    <script type="text/javascript">
         
         function Endtimecheck(){
                var starttime = $('#spPostingStartTime_').val();


                alert(starttime);

         }
   
var endtime = document.getElementById('spPostingEndTime_');

var starttime = document.getElementById('spPostingStartTime_');
function onTimeChange() {
/*  var timeSplit = endtime.value.split(':'),
    endhours,
    endminutes,

var timeSplit2 = starttime.value.split(':'),
    starthours,
    startminutes,
    
  starthours = timeSplit2[0];
  startminutes = timeSplit2[1];

if(starthours > endhours ){

alert(start houer is greter)

}else{
   
   alert(start houer is greter) 

}*/
  /*if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }*/
/*  alert(hours + ':' + minutes + ' ' + meridian);*/
}





$(function () {
    $("#spPostingStartDate_").datepicker({
        numberOfMonths: 2,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#spPostingExpDt").datepicker("option", "minDate", dt);
        }
    });
    $("#spPostingExpDt").datepicker({
        numberOfMonths: 2,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#spPostingStartDate_").datepicker("option", "maxDate", dt);
        }
    });
});

    </script>

        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
        <script type="text/javascript">
               
function keyupsponsorfun() {

  //alert();

        var company= $("#sponsorTitle").val()

        var Website = $("#sponsorWebsite").val()
        var Price = $("#spsponsorPrice").val()
        var category = $("#sponsorCategory").val()
        var Description = $("#spsponsorDesc").val()
        var sponsorImage = $("#sponsorImg").val()

//alert(category);
 //alert(category.length);

   if(company != "")
  {
    $('#sponsorTitle_error').text(" ");
    
  }
  if(Website != "")
  {
    $('#sponsorWebsite_error').text(" ");
 }
   if(Price != "" )
  {
    $('#spsponsorPrice_error').text(" ");
    
  }
 if(category.length != 0)
  {
    $('#sponsorCategory_error').text(" ");
  
  }
   if(Description != "")
  {
    $('#spsponsorDesc_error').text(" ");
  }
   if(sponsorImage != "")
  {
    $('#sponsorImg_error').text(" ");
  
  }
  
       
}
$('#sp-form-post').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
			
$('body').on('keydown', 'input, select', function(e) {
  if (e.which === 13) {
    var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
    focusable = form.find('input').filter(':visible');
    next = focusable.eq(focusable.index(this)+1);
    if (next.length) {
        next.focus();
    }
    return false;
  }
});
$('#ticketcapacity_').on('mouseleave', function(e) {
	var hallcapacity=$('#hallcapacity_').val();
    var ticketcapacity=$('#ticketcapacity_').val();
	if(hallcapacity=='')
	{
		$('#ticketcapacity_').val('');

		document.getElementById("myDIV").style.display = "none";
		
	}else if(ticketcapacity>hallcapacity){
		
		document.getElementById("myDIV").style.display = "block";
		$('#ticketcapacity_').val('');
			 }
	else{
		
		document.getElementById("myDIV").style.display = "none";
	}
});
        </script>
    </body>
</html>
<?php
} ?>