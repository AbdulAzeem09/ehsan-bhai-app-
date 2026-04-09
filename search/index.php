<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/



include('../univ/baseurl.php');
session_start();


if (!isset($_SESSION['pid'])) {
    include_once("../authentication/check.php");
    $_SESSION['afterlogin'] = "cart/";
} else {


    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    if (isset($_POST['txtSearch'])) {
        $txtSearchvalue = htmlspecialchars($_POST['txtSearch']);
        $txtCategoryval 	= $_POST['txtCategory'];

        $newStringchk = preg_replace('/\d+/u', '', $txtCategoryval);
        $stringchk    = preg_replace('/-+/', '', $newStringchk);
        if ($stringchk == "p") {
            $categoryvalue = preg_replace("/[^0-9]/", "", $txtCategoryval);
        } else {
            $categoryvaluepro = preg_replace("/[^0-9]/", "", $txtCategoryval);
        }
    } else {
        header('location:../details');
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include('../component/links.php'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->

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
        </script>
        <!--This script for sticky left and right sidebar END-->
        <!-- SWEET ALERT MSG -->
        <link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
    </head>
    <style>
        .allUser {
            margin: 0px;
        }
        .sweet-alert h2 {
            color: #575757;
            font-size: 25px !important;
            text-align: center;
            font-weight: 600;
            text-transform: none;
            position: relative;
            margin: 25px 0;
            padding: 0;
            line-height: 40px;
            display: block;
        }
        .allpic img{
            width: 164px!important;
        }
        .data {
            width: 30%!important;
        }

/* .set span {
padding:0px!important;
} */


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
</style>

<body class="bg_gray" onload="pageOnload('cart')">

    <?php

    include_once("../header.php");
    ?>
    <section class="landing_page">
        <div class="container pubpost">

            <div id="sidebar" class="col-md-2 no-padding">
                <?php include('../component/left-landing.php'); ?>
            </div>
            <div class="col-md-7">
<!-- <div class="row m_top_10">
<div class="col-md-12">
<div style="padding: 10px;">
<div class="createbox">
<span><label> <b>User Profile</b></label></span>
</div>
</div>
</div>
</div>  -->

<div class="post_timeline" id="ip3">
    <span>
        <label style="
        margin-left: 22px;
        margin-bottom: 22px; color: #202548;
        ">
        <b>Keyword
        </b>
        <span>
            <?php
            $txtSearch = !empty($_POST['txtSearch']) ? htmlspecialchars($_POST['txtSearch']) : "";
            
            if ($txtSearch) {
                echo '- ' . $txtSearch;
            }
            ?>
        </span>

    </label>
</span>
<?php
$pr = new _spprofilehasprofile;

if (isset($_POST['btnSearch'])) {
    $redirect_location = $BaseUrl."/profile-search/?term=".$txtSearch."&txtCategory=".$_POST['txtCategory'];
    //ob_start();
    //header("location:".$redirect_location);
    //exit;
    $level = '';
    $txtCategory 	= $_POST['txtCategory'];


    $newString = preg_replace('/\d+/u', '', $txtCategory);
    $string    = preg_replace('/-+/', '', $newString);
    //get id from striing
    $categoryId = preg_replace("/[^0-9]/", "", $txtCategory);

    if ($string == 'p') {

        $p = new _spprofiles;
        $srpvt = $p->searchprofile($categoryId, $txtSearch);
        //SELECT * FROM spprofiles AS t inner join spprofiletype as d on t.spprofiletype_idspprofiletype = d.idspprofiletype where t.spprofilename  like ('%akhil%') and t.spprofiletype_idspprofiletype != 6 and t.spprofiletype_idspprofiletype != 5 and t.is_active = 1
        
        if($srpvt)
        {
            $rowcount = mysqli_num_rows($srpvt);
        }
        echo "<b>(" . $rowcount . " Profiles Found)</b>";

        if ($srpvt != false) { ?>
            <div class="row no-margin list-wrapper" > <?php
            while ($row = mysqli_fetch_assoc($srpvt)) {
                $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
//echo $pr->ta->sql;
                if ($result3 == 0) {
                    $level = '&nbsp;';
                } else if ($result3 == 1) {
                    $level = '1st';
                } else if ($result3 == 2) {
                    $level = '2nd';
                } else if ($result3 == 3) {
                    $level = '3rd';
                } else {
                    $level = '&nbsp;';
                }


                $st = new _spuser;
                $st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
                if ($st1 != false) {
                    $stt = mysqli_fetch_assoc($st1);
                    $account_status = $stt['deactivate_status'];
                } else {
                    $account_status = 0;
                }





                ?>

                <?php if ($account_status != 1) { ?>


                    <div class="col-md-3" id="ip3">
                        <div class="allUser text-center" id="ip4" style="height: 270px;">
                            <a href="../friends/?profileid=<?php echo $row['idspProfiles']; ?>">
                                <div class="img-wrapper">
                                    <img alt="<?php echo $row['spProfileName']; ?>" class="img-responsive center-block" src="<?php echo ((isset($row['spProfilePic'])) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png"); ?>">
                                
								</div>
                                <div class="detail" style="height: 42px;">
                                    <div class="name">
                                        <?php
                                        if (strlen($row['spProfileName']) < 25) {
                                            echo $row['spProfileName'];
                                        } else {
                                            echo substr($row['spProfileName'], 0, 25) . "...";
                                        } ?>
										<!-- <?php //echo ucfirst($row['spProfileName']); 
										?> -->
									</div>
									<h5 style="padding:1.5px;"><?php echo $row['spProfileTypeName']; ?> Profile</h5>
								</div>
								
										<!-- <h4><?php //echo $level; 
										?></h4> -->
							</a>

							<a href="../friends/?profileid=<?php echo $row['idspProfiles']; ?>">
								<span class="viewProfileBtn" id="view_profile_<?php echo $row['idspProfiles']; ?>" style="border-radius: 14px">View Profile</span>
							</a>
<!-- Check users are already friends1111
-->
<?php
//
$profileObject = new _spprofilehasprofile;
$isAlreadyFriend = $profileObject->checkfriend($_SESSION["pid"], $row['idspProfiles']);

if ($isAlreadyFriend != false) {

    $checkRow = mysqli_fetch_assoc($isAlreadyFriend);
}
$requestFlag = $checkRow["spProfiles_has_spProfileFlag"];
if ($requestFlag == false) {
    $requestFlag = '';
}
/*print_r($isAlreadyFriend);
echo "----------";
$row['idspProfiles'];
echo "----------";
print_r($user_profiles_list);
echo "----------";
*/


if (($isAlreadyFriend == false && !in_array($row['idspProfiles'], $user_profiles_list, TRUE)) || ($isAlreadyFriend != false && $requestFlag == -1 && in_array($row['idspProfiles'], $user_profiles_list, TRUE))) {


    ?>
    <?php

    $flag = 'NULL';
    $fv = new _spprofilefeature;
    $checkIsBlocked = $fv->chkBlock($_SESSION['pid'], $row['idspProfiles']);
    $checkIsBlocked2 = $fv->chkBlock($row['idspProfiles'], $_SESSION['pid']);

// Is friend blocked
    if ($checkIsBlocked == false && $checkIsBlocked2 == false) {
        ?>

        <?php if ($_SESSION['guet_yes'] != 'yes') {
            ?>
            <div class="profile_section_<?php echo $row['idspProfiles']; ?>">
                <span class="btn btnPosting sendRequestOnSearch" onclick="send_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>','<?php echo $flag; ?>')" style="border-radius: 14px; background-color: green;">
                    Add Friend
                </span>
            </div>
        <?php }
    }
} 
else if (!in_array($row['idspProfiles'], $user_profiles_list, TRUE) && ($requestFlag == 0 || $requestFlag == NULL)) {
//

/*echo $requestFlag;
echo "+++++++++++++";*/
?>
<?php if ($_SESSION['guet_yes'] != 'yes') {
    ?>
    <div class="profile_section_<?php echo $row['idspProfiles']; ?>">
        <span class="btn btnPosting cancelRequest" onclick="cancel_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>')" style="border-radius: 14px; background-color: red;">
            Cancel Request
        </span>
    </div>
<?php }
?>
<?php } else { ?>
    <span class="btn " style="border-radius: 14px; background-color:#808080;">
        Friend
    </span>
<?php } ?>
</div>
</div>

<?php  } ?>




<?php
} ?>
</div>
<div id="pagination-container"></div>

<?php
} else { //die('===fhgdfhd======'); 
?>
<div class="row no-margin" style="background-color:#f2f2f2;margin-bottom: 5px;">
    <div class="col-md-12 title text-center" style="color:#1a936f;">
        <h2>Result Not Found</h2>
    </div>
    </div> <?php
}
} else if ($_POST['txtCategory'] == '1') {

    $p = new _sppostreview;
    $sres = $p->limitallpersonalproduct_searchall(1, $_SESSION['pid'],$txtSearch);

//$sres $p->limitallpersonalproduct_searchall($categoryId, $txtSearch);
//$sres = $p->searchproduct($categoryId, $txtSearch);
//GET IMAGES FORM POSTINGPIC
    if ($sres != false) { ?>
        <div class="row no-margin"> <?php
        while ($row2 = mysqli_fetch_assoc($sres)) {
            $pc = new _postingpic;
            $res = $pc->read($row2['idspPostings']);
            if ($res != false) {
                $postr = mysqli_fetch_assoc($res);
            }
            ?>
            <div class="col-md-3 no-padding">
                <div class="allUser text-center" style="height: 258px;">
                    <a href="../store/detail.php?catid=1&postid=<?php echo $row2['idspPostings']; ?>&back=back">
                        <div class="allUserImgBox">
                            <img alt="<?php echo $row2['spPostingTitle']; ?>" class="img-responsive center-block" src="<?php echo ((isset($postr['spPostingPic'])) ? " " . ($postr['spPostingPic']) . "" : "".$BaseUrl."/assets/images/blank-img/no-store.png"); ?>">
                        </div>
                        <div style="min-height: 30px;">
                            <?php if (strlen($row2['spPostingTitle']) < 20) { ?>
                                <h2><?php echo $row2['spPostingTitle']; ?></h2>
                            <?php } else { ?>
                                <h2><?php echo (substr($row2['spPostingTitle'], 0, 20) . '...');  ?></h2>
                            <?php } ?>
                            <h2><?php echo $row2['sellType']; ?></h2>
                        </div>
                        <span>View Detail</span>
                    </a>
                    <?php 
                    if ($row2['spPostingPrice'] != '') 
                    {
                        $curr = $row2['default_currency'];
                        $price = $row2['spPostingPrice'];
                        $discount   = $row2['retailSpecDiscount'];
                        if (($row2['sellType'] == 'Retail')|| ($row2['sellType'] == 'Personal')) 
                        {
                            if ($row2['retailSpecDiscount'] != '') 
                            {
                                $discount   = $row2['retailSpecDiscount'];
                            } else {
                                $discount   = $row2['spPostingPrice'];
                            }
                            echo $curr . ' ' . $discount;
                        }

                        if (($discount != '') && ($row2['sellType'] == "Retail")||($row2['sellType'] == 'Personal')) {
                            if ($price != $discount) {
                            ?> &nbsp; 
                            <del class="text-success" style="color:green;">
                                <?php echo $curr . ' ' . $price; ?>
                            </del>
                            <?php
                        }
//echo $curr . ' ' . $price;
                    } else {

                    }
                }
                ?>
                <?php 


                if($row2['sellType'] == "Wholesale" || $row2['sellType'] == "Auction"){

                    if ($row2['spPostingPrice'] != false) {
                        if($row2['sellType'] == "Wholesale"){
                            echo "<div class='postprice text-center' style='' data-price='" . $row2['spPostingPrice'] . "'>" . $row2['default_currency'] . ' ' . $row2['spPostingPrice'] . "/Pieces</div>";
                        }else{
                            echo "<div class='postprice text-center' style='' data-price='" . $row2['spPostingPrice'] . "'>" . $row2['default_currency'] . ' ' . $row2['spPostingPrice'] . "</div>";
                        }

                    } else {
                        $dbDate = strtotime($row2['spPostingExpDt']);
                        $formattedDate = date('Y-m-d', $dbDate);
                        echo "Expires on " . $formattedDate;
                    }   

                }


                ?>



            </div>
        </div>
        <?php
    } ?>
    </div><?php
}
}

else if($_POST['txtCategory'] == '2') {
    $p = new _sppostreview;
    $sres = $p->publicpost_jobBoard_session_searchall($txtSearch);

    if ($sres != false) { ?>
        <div class="row no-margin"> <?php
        while ($row2 = mysqli_fetch_assoc($sres)) {
            $pc = new _postingpic;
            $res = $pc->read($row2['idspPostings']);
            if ($res != false) {
                $postr = mysqli_fetch_assoc($res);
            }
            ?>

            <div class="col-md-3 no-padding">
                <div class="allUser1 text-center">
                    <a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row2['idspPostings']; ?>">

                        <h2><?php echo $row2['spPostingTitle']; ?></h2>

                        <div class="price">
                            <?php if ($row2['spPostingSlryRngFrm'] > 0) {
                                echo $row2['job_currency'] . ' ' . $row2['spPostingSlryRngFrm'] . ' - ' . $row2['job_currency'] . ' ' . $row2['spPostingSlryRngTo'] . '';
                            } ?>
                        </div>
                        <a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row2['idspPostings'];?>" class="avg-bid btn zoom1">Apply now </a>

                    </a>





                </div>
            </div>
            <?php
        } ?>
        </div><?php
    }
}else if($_POST['txtCategory'] == '3') {


    $p = new _sppostreview;
    $sres = $p->showAllPropertyviewall_realstate($txtSearch);


    if ($sres != false) { ?>
        <div class="row no-margin">


            <?php
            while ($row2 = mysqli_fetch_assoc($sres)) {
                $price =  $row2['spPostingPrice'];
                $pc = new _postingpic;
                $res2 = $pc->readrealpic($row2['idspPostings']);


                ?>
                <div class="col-md-3 no-padding">
                    <div class="allUser text-center" style="height: 270px;">
                        <a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row2['idspPostings']; ?>">
                            <div class="allUserImgBox">
                                <?php

//if ($res2->num_rows > 0) {
                                if ($res2 != false) {
                                    $rp = mysqli_fetch_assoc($res2);
                                    $pic2 = $rp['spPostingPic'];
                                    if($pic2){
                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                    }
                                    else
                                    {
                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src='https://dev.thesharepage.com/img/no.png' >";

                                    }
                                }else
                                {
                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src='https://dev.thesharepage.com/img/no.png' >";

                                }
/*} else {
$res2 = $pic2->read($row2['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
}
}
} else {*/
// echo $row2['idspPostings'].'-----------';
// $res2 = $pic2->read($row2['idspPostings']);
// if ($res2 != false) {
//     $rp = mysqli_fetch_assoc($res2);
//     $pic2 = $rp['spPostingPic'];
//     echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
// } else {
//     echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
// }



    ?>
</div>
<div style="min-height: 30px;">

    <h2 style="line-height:15px;"><?php echo $row2['spPostingTitle']; ?></h2>
    <h2><?php echo $row2['spPostingPropertyType']; ?></h2>
    <p class="text1"><span><?php echo $row2['defaltcurrency'] . ' '.$price; ?></span></p>
</div>
<span>View Detail</span>
</a>





</div>
</div>
<?php
} ?>
</div><?php
}
}



else if($_POST['txtCategory'] == '5') {

    $p = new _sppostreview;
    $sres = $p->total_post_freelancerserachdata($txtSearch);

    if ($sres != false) { ?>
        <div class="row no-margin"> <?php
        while ($row2 = mysqli_fetch_assoc($sres)) {
            $pc = new _postingpic;
            $res = $pc->read($row2['idspPostings']);
            if ($res != false) {
                $postr = mysqli_fetch_assoc($res);
            }
            ?>

            <div class="col-md-3 no-padding">
                <div class="allUser1 text-center">
                    <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row2['idspPostings'];?>" style="color:black;">
                        <h2><?php echo $row2['spPostingTitle']; ?></h2>
                        <?php if($Fixed == ''){
                            if($row['spPostingPriceFixed'] == 1){
                                $Fixed = "Fixed Rate";
                            }else{
                                $hourly ="Hourly Rate";                                                 }
                            }
                            ?>
                            <p class="timing-week" style="font-weight: bolder!important;">
                                <?php echo ($Fixed != '')? $Fixed: $hourly;?><!--  - <?php echo $Category;?> - <?php echo $postingDate;?> --></p>
                                <p class="proposals"><?php 
                                echo ($row2['spPostingPrice'] > 0)?$row2['Default_Currency'] .' '.$row2['spPostingPrice'] : 0;?></p>

                                <div class="price">
                                    <?php if ($row2['spPostingSlryRngFrm'] > 0) {
                                        echo $row2['job_currency'] . ' ' . $row2['spPostingSlryRngFrm'] . ' - ' . $row2['job_currency'] . ' ' . $row2['spPostingSlryRngTo'] . '';
                                    } ?>
                                </div>



                            </a>





                        </div>
                    </div>
                    <?php
                } ?>
                </div><?php
            }
        }





        else if($_POST['txtCategory'] == '7') {

            $p = new _sppostreview;
            $sres = $p->publicpost_music_keyword_searchall($txtSearch);

            if ($sres != false) { ?>
                <div class="row no-margin"> <?php
                while ($row2 = mysqli_fetch_assoc($sres)) {
                    $pc = new _postingpic;
                    $res2 = $pc->readpicall($row2['idspPostings']);

                    ?>
                    <div class="col-md-3 no-padding">
                        <div class="allUser Als text-center" style="height: 220px;">
                            <a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row2['idspPostings']; ?>" class="btn ">
                                <div class="allUserImgBox">
                                    <?php 
                                    if ($res2 != false) {
                                        $rp = mysqli_fetch_assoc($res2);
                                        $pic2 = $rp['spPostingPic'];
                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                        <?php
                                    } else {
                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                        <?php
                                    } ?>
                                </div>
                                <div style="min-height: 30px;">
                                    <h2><?php echo $row2['spPostingTitle']; ?></h2>
                                    <h2><?php echo $row2['spPostSelection']; ?></h2>

                                </div>
                                <a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row2['idspPostings']; ?>" class="btn ">View Detail</a>
                            </a>

                        </div>
                    </div>
                    <?php
                } ?>
                </div><?php
            }
        }





        else if($_POST['txtCategory'] == '8') {


            $p = new _sppostreview;
            $sres = $p->read_all_trainingsearch($txtSearch);

            if ($sres != false) { ?>
                <div class="row no-margin"> <?php
                while ($row2 = mysqli_fetch_assoc($sres)) {
                    $pc = new _postingpic;
                    $res2 = $pc->read_cover_images($row2['id']);

                    ?>
                    <div class="col-md-3 data no-padding">
                        <div class="allUser allpic text-center" style="height: 205px;">
                            <a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row2['id'];?>">

                                <div class="allUserImgBox">
                                    <?php 
                                    if($res2 != false){                                                
                                        $rp = mysqli_fetch_assoc($res2);
                                        $pic2 = $rp['filename'];
                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' >"; 

                                    }else{
                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                    } ?>
                                </div>
                                <div style="min-height: 30px;">
                                    <h2><?php echo $row2['spPostingTitle']; ?></h2>
                                    <small>(<?php echo $row2['trainingcategory']; ?>)</small> 

                                    <?php 
                                    $price      = $row2['spPostingPrice'];
                                    $txtDiscount=$row2['txtDiscount'];

//echo $price.'hello';
//echo $txtDiscount;   

                                    if($price!='' && $txtDiscount!=''){

                                        $discountedPrice = $price - ($price* ($txtDiscount/100));   
                                        ?>

                                        <style>
                                            #piddd{
                                                * float: left!important;  
                                            }
                                        </style>
                                        <p id="piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row2['spPostingPrice'] > 0)?$row2['default_currency'].' '.$discountedPrice:'Free';?>

                                        <del class="text-success" style="/* color:green; */"><?php echo ($price > 0)?$row2['default_currency'].' '.$price:'';?></del>   
                                    </p>
                                    <?php
                                }else{

                                    ?>

                                    <p id = "piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row2['spPostingPrice'] > 0)?$row2['default_currency'].' '.$row2['spPostingPrice']:'Free';?></p>

                                <?php } ?>  



                            </div>
                        </a>


                    </div>
                </div>
                <?php
            } ?>
            </div><?php
        }
    }






    else if($_POST['txtCategory'] == '9') {

        $p = new _sppostreview;
        $sres = $p->homepage_events_top_pagsearchall($txtSearch);

        if ($sres != false) { ?>
            <div class="row no-margin"> <?php
            while ($row2 = mysqli_fetch_assoc($sres)) {

                $venu = $row2['spPostingEventVenue'];
                $startDate = $row2['spPostingStartDate'];
                $pc = new _postingpic;
                $res2 = $pc->readFeatureeventpic($row2['idspPostings']);

                ?>
                <div class="col-md-3 no-padding">
                    <div class="allUser set text-center" style="height: 235px;">
                        <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row2['idspPostings']; ?>" class="">

                            <div class="allUserImgBox">
                                <?php 
                                if($res2 != false){
                                    if($res2->num_rows > 0){
                                        if ($res2 != false) {
                                            $rp = mysqli_fetch_assoc($res2);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' 
                                            class='img-responsive' src=' " . ($pic2) . "' >"; 
                                        } else{
                                            echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive'>"; 
                                        }
                                    }else{
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                            $rp = mysqli_fetch_assoc($res2);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                        } else{
                                            echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive'>"; 
                                        }
                                    }
                                }else{
                                    $res2 = $pic->read($row['idspPostings']);
                                    if ($res2 != false) {
                                        $rp = mysqli_fetch_assoc($res2);
                                        $pic2 = $rp['spPostingPic'];
                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                    } else{
                                        echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive'>"; 
                                    }
                                } ?>
                            </div>
                            <div style="min-height: 30px;">
                                <h2>
                                    <?php if (strlen($row2['spPostingTitle']) < 20) { ?>
                                        <?php echo $row2['spPostingTitle'];?></span>
                                    <?php } else { ?>
                                        <?php echo (substr($row2['spPostingTitle'], 0, 20) . '...'); ?>
                                    <?php } ?>
                                </h2>
                                <?php
                                if(!empty($startDate)){
                                    $dy = new DateTime($startDate);
                                    $day = $dy->format('d');
                                    $month = $dy->format('M');
                                    $weak = $dy->format('D');
                                }else{
                                    $day = 0;
                                    $month = "&nbsp;";
                                    $weak = "&nbsp;";
                                }
                                ?>
                                <span class="">
                                    <?php echo $month.' '.$day;?>&nbsp;&nbsp;<?php echo $weak;?></span>
                                    <span  class=""><i class="fa fa-map-marker"></i>
                                        <?php if (strlen($venu) < 10) { ?>
                                            <?php echo $venu;?></span>
                                        <?php } else { ?>
                                            <?php echo (substr($venu, 0, 10) . '...'); ?>
                                        <?php } ?>
                                    </div>
                                </a>


                            </div>
                        </div>
                        <?php
                    } ?>
                    </div><?php
                }
            }





            else if($_POST['txtCategory'] == '10') {

                $p = new _sppostreview;
                $sres = $p->myUploadedVidsearch($txtSearch);

                if ($sres != false) { ?>
                    <div class="row no-margin"> 
                        <?php
                        while ($row2 = mysqli_fetch_assoc($sres)) {
                            $pc = new _postingpic;
                            $res2 = $pc->readpicall($row2['idspPostings']);

                            ?>
                            <div class="col-md-3 no-padding">
                                <div class="allUser Als text-center" style="height: 160px;">
                                    <a href="<?php echo $BaseUrl . '/videos/watch.php?video_id=' . $row2['video_id']; ?>">
                                        <div class="allUserImgBox">

                                            <?php if (!empty($row2['video_thumbnail'])) { ?>
                                                <img class="effect-fade lazyloaded" src="../upload/video/video_thumbnail/<?php echo $row2['video_thumbnail']; ?>" alt="vp-ms07">
                                            <?php } else { ?>
                                                <img class="effect-fade lazyloaded" src="<?php echo $BaseUrl; ?>/img/no.png" alt="vp-ms07">

                                            <?php } ?>
                                        </div>
                                        <div style="min-height: 30px;">
                                            <h2><?php echo $row2['video_title']; ?></h2>
                                            <?php

                                            if ($row2['video_price_status'] == '1') {
                                                if (!empty($row2['video_discount'])) {
                                                    $total_price = $row2['video_price'] - (($row2['video_price'] * $row2['video_discount']) / 100);
                                                    echo $row2['default_currency'] . ' ';
                                                    echo $total_price;
                                                } else {
                                                    $total_price = $row2['video_price'];
                                                    echo $total_price;
                                                }
                                            } else {
                                                echo 'Free';
                                            }
                                            ?>

                                        </div>
                                    </a>


                                </div>
                            </div>
                            <?php
                        } ?>
                        </div><?php
                    }
                }

                else if($_POST['txtCategory'] == '13') {

                    $p = new _sppostreview;
                    $userid=$_SESSION['uid'];
                    $c= new _orderSuccess;
                    $currency= $c->readcurrency($userid);
                    $res1= mysqli_fetch_assoc($currency);
                    $curr=$res1['currency'];
                    $sres = $p->search_artgallerynewsearchall($txtSearch);

                    if ($sres != false) { ?>
                        <div class="row no-margin"> <?php
                        while ($row2 = mysqli_fetch_assoc($sres)) {


                            $pc = new _postingpic;
                            $res2 = $pc->readartpic($row2['idspPostings']);

                            ?>
                            <div class="col-md-3 no-padding">
                                <div class="allUser Als text-center" style="height: px;">
                                    <a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row2['idspPostings'];?>">
                                        <div class="allUserImgBox">
                                            <?php 
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
//print_r($rp);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
                                            } else{?>
                                                <img alt='Posting Pic' src='<?php echo $BaseUrl; ?>/assets/images/blank-img/no-store.png' class='img-responsive'>

                                            <?php } ?> 
                                        </div>
                                        <div style="min-height: 30px;">
                                            <h2 style="line-height: 12px;">
                                                <?php if (strlen($row2['spPostingTitle']) < 20) { ?>
                                                    <?php echo $row2['spPostingTitle']; ?>
                                                <?php } else { ?>
                                                    <?php echo (substr($row2['spPostingTitle'], 0, 20) . '...'); ?>
                                                <?php } ?>
                                            </h2>
                                            <?php


                                            if(empty($row2['spPostingPrice'])){
                                                echo "<span class='price'>Free </span>";
                                            }else{
                                                if(empty($row2['discountphoto'])){	
                                                    echo '<span class="price">  ' .$curr.'   '.$row2['spPostingPrice'].  '  </span>';
                                                }else{
                                                    echo '<span class="price">  ' .$curr.'  '.$row2['discountphoto'].  '  </span>'; 
                                                }
                                            } 
                                            if(empty($row2['discountphoto'])){
                                            }else{ 




                                            }
                                            ?>
                                        </div>
                                    </a>


                                </div>
                            </div>
                            <?php
                        } ?>
                        </div><?php
                    }
                }


                else if($_POST['txtCategory'] == '17') {

                    $p = new _sppostreview;
                    $g = new _spgroup;
                    $sres = $p->profilegroupmembersearchall($txtSearch);

                    if ($sres != false) { ?>
                        <div class="row no-margin"> <?php
                        while ($row2 = mysqli_fetch_assoc($sres)) {

                            $baneer_iamge = $g->read_bannerimage($row2['idspGroup']);
                            $baneer_iamge_row = mysqli_fetch_assoc($baneer_iamge);
//print_r($baneer_iamge_row);
                            $gimage  = $baneer_iamge_row['spgroupimage'];

                            ?>
                            <div class="col-md-3 no-padding">
                                <div class="allUser Als text-center" style="height: 220px;">
                                    <a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row2['idspGroup'] ?>&groupname=<?php echo $row2['spGroupName'] ?>&timeline&page=1">
                                        <div class="allUserImgBox">
                                            <?php 

                                            if ($gimage == "") { ?>

                                                <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp" class="img-responsive group_banner" alt="" /><?php
                                            }



                                            else { ?>
                                                <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-responsive group_banner" alt="" /><?php
                                            } ?>
                                        </div>
                                        <div style="min-height: 30px;">
                                            <h2 style="font-size:14px;word-wrap: break-word;"><?php echo $row2['spGroupName']; ?></h2>
                                            <span>

                                                (
                                                    <?php
//  $gcate = ($row['spgroupCategory']); 
                                                    $gcate = $g->read_category($row2['spgroupCategory']);
//echo $g->ta->sql;
                                                    if ($gcate != false) {
                                                        while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                            echo $groupcate['group_category_name'];
                                                        }
                                                    }

                                                    ?> 
                                                    )
                                                </span>

                                            </div>
                                        </a>


                                    </div>
                                </div>
                                <?php
                            } ?>
                            </div><?php
                        }
                    }












                } else {
                    header("location:" . $BaseUrl . '/timeline');
                }
                ?>
            </div>







        </div>
        <div id="sidebar_right" class="col-md-3 no-padding" style="left: auto">
            <?php include('../component/right-landing.php'); ?>
        </div>
    </div>
</section>

<?php include('../component/footer.php'); ?>
<?php include('../component/btm_script.php'); ?>

<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<script src="/assets/js/home.js"></script>
<!-- END -->
<script>
    function cancel_request(senderId, reciverId, profilename) {

        swal({
            title: "Cancel friend request?",

            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "Cancel",
            showCancelButton: true,
        },
        function(isConfirm) {
            if (isConfirm) {

                $.post('../friends/cancelRequest.php', {
                    sender: senderId,
                    reciever: reciverId,
                    profilename: profilename,


                }, function(d) {
//$("#send_profile_section_" + reciverId).html("");

                    var onclick = "send_request('" + senderId + "','" + reciverId + "','" + profilename + "','NULL')";
                    $(".profile_section_" + reciverId).html('<span class="btn btnPosting sendRequestOnSearch" style="border-radius: 14px; background-color: green;" onclick = "' + onclick + ' ">Add Friend </span>');
                });



            }
        });

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
//friend request send
        $(".sendRequestOnSearch1").click(function(i, e) {
            var btn = this;
            var senderId = $(this).data("sender");
            var reciverId = $(this).data("reciver");
            var profilename = $(this).data("profilename");
            var flag = $(this).data("flag");
            $.post('../friends/sendrequest.php', {
                sender: senderId,
                reciever: reciverId,
                profilename: profilename,
                flag: flag
            }, function(d) {
//window.location.reload();
                swal({
                    title: "Friend request is sent.",
                    type: "success",
                    confirmButtonClass: "sweet_ok",
                    confirmButtonText: "Ok",
                    cancelButtonClass: "sweet_cancel",
                    cancelButtonText: "No",
                    showCancelButton: false,
                },
                function(isConfirm) {
                    if (isConfirm) {
//$(".send_profile_section_" + reciverId).html("");
                        $(".profile_section_" + reciverId).html('<span class="btn btnPosting cancelRequest" style="border-radius: 14px; background-color: red;" data-flag="' + flag + '" data-profilename="' + profilename + '" data-sender="' + senderId + '" data-reciver="' + reciverId + '">Cancel Request</span>');
//location.href = "<?php echo $BaseUrl; ?>/timeline/index.php";
                    }
                });
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
//friend Cancel Request send
        $(".cancelRequest1").click(function(i, e) {
            var btn = this;
            var senderId = $(this).data("sender");
            var reciverId = $(this).data("reciver");
            var profilename = $(this).data("profilename");
            var flag = $(this).data("flag");
            swal({
                title: "Do you want to Cancel Request ?",

                type: "warning",
                confirmButtonClass: "sweet_ok",
                confirmButtonText: "Yes",
                cancelButtonClass: "sweet_cancel",
                cancelButtonText: "Cancel",
                showCancelButton: true,
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.post('../friends/cancelRequest.php', {
                        sender: senderId,
                        reciever: reciverId,
                        profilename: profilename,
                        flag: flag
                    }, function(d) {
//$("#send_profile_section_" + reciverId).html("");
                        $(".profile_section_" + reciverId).html('<span class="btn btnPosting sendRequestOnSearch" style="border-radius: 14px; background-color: green;" data-flag="NULL" data-profilename="' + profilename + '" data-sender="' + senderId + '" data-reciver="' + reciverId + '">Add Friend </span>');
                    });



                }
            });

        });
    });
</script>

<script>
    function send_request(senderId, reciverId, profilename, flag) {

        $.post('../friends/sendrequest.php', {
            sender: senderId,
            reciever: reciverId,
            profilename: profilename,
            flag: flag
        }, function(d) {
//window.location.reload();
            swal({
                title: "Friend request is sent.",
                type: "success",
                confirmButtonClass: "sweet_ok",
                confirmButtonText: "Ok",
                cancelButtonClass: "sweet_cancel",
                cancelButtonText: "No",
                showCancelButton: false,
            },
            function(isConfirm) {
                if (isConfirm) {

//$(".send_profile_section_" + reciverId).html("");
                    var onclick = "cancel_request('" + senderId + "','" + reciverId + "','" + profilename + "')";
                    $(".profile_section_" + reciverId).html('<span class="btn btnPosting cancelRequest" style="border-radius: 14px; background-color: red;" onclick="' + onclick + '">Cancel Request</span>');
//location.href = "<?php echo $BaseUrl; ?>/timeline/index.php";
                }
            });
        });
    }
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
} ?>