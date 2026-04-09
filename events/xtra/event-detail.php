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


    if (isset($_GET['postid']) && $_GET['postid'] >0) {
        $p = new _postingview;
        $pf  = new _postfield;

        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $ProTitle   = $row['spPostingtitle'];
            $ProDes     = $row['spPostingNotes'];
            $ArtistName = $row['spProfileName'];
            $ArtistId   = $row['idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];
            $expDate    = $row['spPostingExpDt'];

            $pr = new _spprofilehasprofile;
            $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
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

            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
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
            }
        </script>
        
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <!-- Modal for send a sms -->
        <div id="sendAsms" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content no-radius">
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
                                    <button type="submit" class="btn pull-right btnSendSms" <?php echo ($_SESSION['pid'] == $OrganizerId)?'disabled':'';?> id="sendEventSms">Send Message</button>
                                    <button type="button" class="btn pull-right"  data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
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
                    <div class="col-sm-12 text-center">
                        <p class="titDetail"><?php echo $ProTitle;?></p>
                        <p class="location"><i class="fa fa-map-marker"></i> <?php echo $venu;?></p>
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
                                        <h3>Time Start</h3>
                                        <img src="<?php echo $BaseUrl;?>/assets/images/events/icon-2.png" class="img-responsive">
                                        <p><?php echo date("h:i A", $dtendTime); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="transTopBtmFoot">
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
                        </div>

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
                                        <span><i class="fa fa-home"></i></span>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <?php
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
                                    $fv = new _favorites;
                                    $res_fv = $fv->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
                                    //echo $fv->ta->sql;
                                    if($res_fv != false){ ?>
                                        <a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
                                            Bookmark
                                        </a><?php
                                        //echo '<li><a data-postid="'. $_GET["postid"].'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
                                    }else{
                                        ?>
                                        <a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                            <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                            Bookmark
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    
                                </li>
                                <li>
                                    <div class="row reviewdetail">
                                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
                                        <input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
                                        <p id='postrating' class="rating " style="margin-left: 40px;margin-bottom: 0px;line-height: 14px;">
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
                            
                                        </p>
                                        <p class="col-sm-12 rating">
                                            <?php  echo "Rating: <span id='rate'>".round($ratings,2)."</span>"; ?>
                                        </p>
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
                                            $title = "";
                                        }
                                        ?>
                                    
                                    <div class="ie_<?php echo $_GET['postid'];?>">
                                        <div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
                                            <button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;"><?php echo $title;?></button>
                                            <ul class="dropdown-menu ">
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
                                                <li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                
                                <li>
                                    <?php
                                    $pic = new _postingpic;
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
                                        <span class='sp-share-art' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pic2); ?>'>
                                            <i class="fa fa-share-alt"></i>
                                        </span>
                                        Share
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg_white detailEvent m_top_10">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="titleEvent">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="hostedbyevent">
                                            <!-- <a href="javascrpit:void(0)" data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms btn butn_save">Contact Organizer</a>                                    -->
                                            <label>Organizers:</label>
                                            <?php
                                            $pf  = new _postfield;
                                            $pro = new _spprofiles;
                                            $ei  = new _eventJoin;
                                            $limit = 0;
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
                                                                <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $row7['spProfileName'];?></a>,
                                                                <?php
                                                                $limit++;
                                                                if($limit == 3){
                                                                    break;
                                                                }
                                                            }
                                                            //chek profile is rejected or aproved
                                                            // $result8 = $ei->chekStatus($_GET['postid'], $profileId, 2);
                                                            // if($result8 != false){
                                                            //     $row8 = mysqli_fetch_assoc($result8);
                                                            //     if($row8['spEventjoin_status'] == 1){
                                                                    
                                                            //     }
                                                            // }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <form action="../cart/addorder.php" method="post" class="form-inline text-right">
                                            
                                            <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET['postid'];?>">
                                            <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'];?>">                                    
                                            <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo ($price>0)?$price:'0';?>">
                                            <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php echo $ArtistId;?>">
                                            
                                            <?php
                                            $buyerid = $_SESSION['pid'];
                                            $od = new  _order;
                                            $res = $od->checkorder($_GET["postid"] , $buyerid);
                                            if ($res != false){ ?>
                                                <button type="button" class="btn butn_cancel pull-right disabled" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Added to cart</button>
                                                <?php
                                                //echo "<button type='button' class='btn btn_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Added to cart</button>";
                                            }else{ ?>
                                                <button type="<?php echo ($visibil == 1 ? "button":"submit");?>" class="btn butn_cancel pull-right <?php echo ($visibil == 1 ? "disabled":"");?>" id="addtocart" data-postid="<?php echo $_GET['postid'];?>" data-profileid="<?php echo $_SESSION['pid'];?>" data-categoryid="9"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  <?php echo ($price > 0)?'Buy Ticket':'Free Ticket';?></button>
                                                <?php
                                                //echo "<button type='submit' class='btn btn_cart".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='9'>Add to cart</button>";
                                            }
                                            ?>
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
                                            
                                        </form>


                                        


                                    </div>
                                </div>
                                <hr class="hrline">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2>Event <span>Details</span></h2>
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
                                        <p class="text-justify"><?php echo $ProDes;?></p>
                                        
                                        <h2 style="font-size: 18px;">Available Tickets: <span><?php echo ($Quantity > 0)?$Quantity:'House Full'; ?></span></h2>
                                        <div class="space"></div>
                                        <p><a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="btn btn-primary text-left" ><i class="fa fa-flag"></i> Flag This Post</a></p>
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


                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        //this is posting for featured pic
                                        $pic = new _postingpic;
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
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="navtabFrnd">
                            <li class="active"><a data-toggle="tab" href="#home">Gallery</a></li>
                            <!-- <li><a data-toggle="tab" href="#menu1">Video</a></li> -->
                           <!--  <li><a data-toggle="tab" href="#menu2">Reviews</a></li> -->
                            <li><a data-toggle="tab" href="#menu3">Sponsors</a></li>
                            <li><a data-toggle="tab" href="#menu4">Featuring</a></li>
                            <li><a data-toggle="tab" href="#menu5">Contact Organizer</a></li>
                        </ul>

                        <div class="tab-content" style="min-height: 300px;">
                            <div id="home" class="tab-pane fade in active">
                                <div class="space"></div>
                                <div class="row">
                                    <?php
                                    $pic = new _postingpic;
                                    $res2 = $pic->read($_GET['postid']);

                                    if ($res2 != false) {
                                        while ($rp = mysqli_fetch_assoc($res2)) {
                                            $pic2 = $rp['spPostingPic'];
                                            ?>
                                            <div class="col-md-3">
                                                <div class="EvntImg">
                                                    <a class="thumbnail" rel="lightbox[group]" href="<?php echo ($pic2);?>" title="<?php echo $ProTitle;?>">
                                                        <img class="group1" src="<?php echo ($pic2);?>">
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                            <?php
                                        }                        
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
                                        $SpCat = "Prime";
                                        include('sponsor.php');
                                        ?>
                                        <!-- <h2>Platinum</h2> -->
                                        <?php
                                        $SpCat = "Platinum";
                                        include('sponsor.php');
                                        ?>
                                        <!-- <h2>Gold</h2> -->
                                        <?php
                                        $SpCat = "Gold";
                                        include('sponsor.php');
                                        ?>
                                        <!-- <h2>Silver</h2> -->
                                        <?php
                                        $SpCat = "Silver";
                                        include('sponsor.php');
                                        ?>
                                        <!-- <h2>Media</h2> -->
                                        <?php
                                        $SpCat = "Media";
                                        include('sponsor.php');
                                        ?>
                                        <!-- <h2>General</h2> -->
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
									$pf  = new _postfield;
									$pro = new _spprofiles;
									$result6 = $pf->readFeaturPost($_GET['postid']);
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
														<div class="featuringBox row bg_white no-margin">
															<a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
																<div class="col-md-3 no-padding">
																	<?php 
																	echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
																	?>
																</div>
																<div class="col-md-9 no-padding">
																	<h4><?php echo $row7['spProfileName'];?></h4>
																</div>
															</a>
														</div>
													</div>
													<?php
												}
											}
										}
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
                                            <div class="featuringBox row bg_white no-margin">
                                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
                                                    <div class="col-md-3 no-padding">
                                                        <?php 
                                                        echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                        ?>
                                                    </div>
                                                    <div class="col-md-9 no-padding">
                                                        <h4><?php echo $row7['spProfileName'];?></h4>
                                                    </div>
                                                </a>
                                                <div class="col-md-12">
                                                    <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms">Contact Organizer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
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
                                                            <div class="featuringBox row bg_white no-margin">
                                                                <a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
                                                                    <div class="col-md-3 no-padding">
                                                                        <?php 
                                                                        echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                                        ?>
                                                                    </div>
                                                                    <div class="col-md-9 no-padding">
                                                                        <h4><?php echo $row7['spProfileName'];?></h4>
                                                                    </div>
                                                                </a>
                                                                <div class="col-md-12">
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