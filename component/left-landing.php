<?php
//include("friendmessage/totalunreadmsg.php"); 
?>
<style>
* {
box-sizing: border-box;
}

.zoom {
// padding: 50px;
// background-color: green;
transition: transform .2s;
font-size: 5px;
//width: 19px;
//height: 19px;
//margin: 0 auto;
}

.zoom:hover {
-ms-transform: scale(1.1);
/* IE 9 */
-webkit-transform: scale(1.1);
/* Safari 3-8 */
transform: scale(1.1);
}
</style>



<div class="left_grid left_group_black left_sidebar">
<ul>
<li class="zoom"><strong>
<a href="<?php echo $BaseUrl; ?>/my-profile/">
<?php
$p = new _spprofiles;
$result = $p->read($_SESSION['pid']);
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (isset($row["spProfilePic"])) {
echo "<img style='height: 30px;width: 30px;' alt='profilepic' class='img-circle img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
} else {
echo "<img alt='profilepic' class='img-circle' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
}
}
?>

<p style="white-space: nowrap; width: 130px; overflow: hidden; text-overflow: ellipsis;"><?php echo (isset($_SESSION['myprofile']) && !empty($_SESSION['myprofile'])) ? ucwords(strtolower($_SESSION['myprofile'])) : (isset($_SESSION['username']) ? ucwords(strtolower($_SESSION['username'])) : "Profile"); ?></p>
</a>
</strong></li>
<li class="zoom"><a href="<?php echo $BaseUrl; ?>/dashboard/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/dashboard-icon.png" class="img-responsive" alt="" />
<p>Master Dashboard</p>
</a></li>
<li class="zoom"><a href="<?php echo $BaseUrl; ?>/profile/index.php?favourite"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/favorite-icon.png" class="img-responsive" alt="" />
<p>Favorites</p>
</a></li>
<li class="zoom"><a href="<?php echo $BaseUrl; ?>/inbox.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/coupons-icon.png" class="img-responsive" alt="" />
<p>
Inbox <?php if (isset($totalunread) && $totalunread > 0) {
echo "(" . $totalunread . ")";
} ?></p>
</a></li>


<?php 
$as = new _spAllStoreForm;
$result_as = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);
if ($result_as) {
$row = mysqli_fetch_assoc($result_as);
  $groups_new = $row['groups'];

}else 
{
$groups_new = 1;
}
 ?>
<li class="<?php echo ($groups_new == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/my-groups/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/Groups-icon.png" class="img-responsive" alt="" />
<p>Groups</p>
</a></li>

</ul>
</div>


<div class="left_grid left_group_black left_sidebar">
<span style="font-size: 15px;font-weight: 600;" class="">Explore The SharePage </span>
<?php
$as = new _spAllStoreForm;

$result_as = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);

if ($result_as) {
  $row = mysqli_fetch_assoc($result_as);

  $timeline = $row['timeline'];
  $jobboard = $row['jobboard'];
  $freelance = $row['freelance'];
  $event = $row['event'];
  $fund_raising = $row['fund_raising'];
  $classified_ads = $row['classified_ads'];
  $consultation = $row['consultation'];
  $invoicing = $row['invoicing'];
  $business = $row['business'];

  // $rental= $row['rental'];
  // $realestate= $row['realestate'];
  // $artandcraft = $row['artandcraft'];
  // $videos = $row['videos'];
  // $trainings = $row['trainings'];
  // $my_business_space = $row['my_business_space'];
  // $news_views = $row['news_views'];
  // $business_for_sale = $row['business_for_sale'];
  // $nft = $row['nft'];
  // $dating = $row['dating'];
  // $directory = $row['directory'];
} else {
  $timeline = "";
  $jobboard = "";
  $freelance = "";
  $event = "";
  $fund_raising = "";
  $classified_ads = "";
  $consultation = "";
  $invoicing = "";
  $business = "";

  // $stores = "";
  // $rental= "";
  // $realestate= "";
  // $artandcraft = "";
  // $videos = "";
  // $trainings = "";
  // $my_business_space = "";
  // $news_views = "";
  // $business_for_sale = "";
  // $nft = "";
  // $dating = "";
  // $directory = "";
}


$result_as1 = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);
if ($result_as1) {
  $row1 = mysqli_fetch_assoc($result_as1);
  $buisness = $row1['business'];
 }
?>
<ul style="margin-top: 10px;">

<!--   <li class=""><a href="<?php echo $BaseUrl; ?>/store/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/stores.png" class="img-responsive" alt="" /><p>Stores</p></a></li> -->

<li class="<?php echo ($stores == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/store/storeindex.php?folder=home"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/stores.png" class="img-responsive" alt="" />
<p>Stores</p>
</a></li>


<?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>

<li class="<?php echo ($freelance == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/freelancer/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/freelancer.png" class="img-responsive" alt="" />
<p> Freelancer</p>
</a></li>
<?php } ?>
<!--   <li class="<?php echo ($freelance == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/freelancer/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/freelancer.png" class="img-responsive" alt="" /><p>Freelancer</p></a></li> -->

<!--  <li class="<?php echo ($freelance == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/freelancer/coming_freelancer.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/freelancer.png" class="img-responsive" alt="" /><p>Freelancer</p></a></li> -->

<!--   <li class="<?php echo ($jobboard == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/job-board/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/jobboard_icon.png" class="img-responsive" alt="" /><p>Job Board</p></a></li> -->

<!-- <li class="<?php echo ($jobboard == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/job-board/coming_jobboard.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/jobboard_icon.png" class="img-responsive" alt="" /><p>Job Board</p></a></li> -->
<li class="<?php echo ($jobboard == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/job-board"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/jobboard_icon.png" class="img-responsive" alt="" />
<p>Job Board</p>
</a></li>


<!--  <li class="<?php echo ($realestate == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/real-estate/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/real-estate.png" class="img-responsive" alt="" /><p>Real Estate</p></a></li> -->

<li class="<?php echo ($realestate == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/real-estate/index.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/real-estate.png" class="img-responsive" alt="" />
<p>Real Estate</p>
</a></li>


<li class="<?php echo ($rental == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/real-estate/all-room.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/rental.png" class="img-responsive" alt="" />
<p>Rental</p>
</a></li>



<!--   <li class="<?php echo ($event == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/events/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/events_icon.png" class="img-responsive" alt="" /><p>Events</p></a></li> -->

<li class="<?php echo ($event == 1) ? 'hidden' : ''; ?> zoom "><a href="<?php echo $BaseUrl; ?>/events"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/events_icon.png" class="img-responsive" alt="" />
<p>Events</p>
</a></li>

<!-- <li class="<?php echo ($event == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/events/coming_events.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/events_icon.png" class="img-responsive" alt="" /><p>Events</p></a></li> -->


<!--   <li class="<?php echo ($coupon == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/coupon/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/coupon.png" class="img-responsive" alt="" /><p>Coupon</p></a></li>
-->
<!-- <li class="<?php echo ($coupon == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/coupon/coming_coupon.php"><img src="<?php //echo $BaseUrl;
?>/assets/images/icon/home/coupon.png" class="img-responsive" alt="" /><p>Coupon</p></a></li> -->

<!--  <li class="<?php echo ($art == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/photos/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/art_gallery_icon.png" class="img-responsive" alt="" /><p>Art Gallery</p></a></li>
-->
<li class="<?php echo ($art == 1) ? 'hidden' : ''; ?> zoom "><a href="<?php echo $BaseUrl; ?>/artandcraft/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/art_gallery_icon.png" class="img-responsive" alt="" />
<p>Art and Craft</p>
</a></li>

<!-- <li class="<?php echo ($music == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/music/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/music.png" class="img-responsive" alt="" /><p>Music</p></a></li> -->
<!-- <li class="<?php echo ($music == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/music/overview.php"><img src="<?php //echo $BaseUrl;
?>/assets/images/icon/home/music.png" class="img-responsive" alt="" /><p>Music</p></a></li> -->
<!-- coming_music.php -->

<!--   <li class="<?php echo ($videos == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/videos/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/videos.png" class="img-responsive" alt="" /><p>Video</p></a></li> -->

<li class="<?php echo ($videos == 1) ? 'hidden' : ''; ?> zoom "><a href="<?php echo $BaseUrl; ?>/videos/index.php?page=1"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/videos.png" class="img-responsive" alt="" />
<p>Videos</p>
</a></li>


<li class="<?php echo ($trainings == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/trainings/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/training.png" class="img-responsive" alt="" />
<p>Trainings</p>
</a></li>

<!-- <li class="<?php echo ($trainings == 1) ? 'hidden' : ''; ?>"><a href="<?php echo $BaseUrl; ?>/trainings/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/training.png" class="img-responsive" alt="" /><p>Trainings</p></a></li>-->

<!-- <li><a href="<?php echo $BaseUrl; ?>/services/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/classified-ads.png" class="img-responsive" alt="" /><p>Classified ads</p></a></li> -->

<!-- <li><a href="<?php echo $BaseUrl; ?>/services/coming_services.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/classified-ads.png" class="img-responsive" alt="" /><p>Classified ads</p></a></li> -->


<li class="<?php echo ($classified_ads == 1) ? 'hidden' : ''; ?> zoom"><a href="<?php echo $BaseUrl; ?>/services"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/classified-ads.png" class="img-responsive" alt="" />
<p>Classified Ads</p>
</a></li>

<!-- <li class="<?php echo ($directory == 1) ? 'hidden' : ''; ?>" ><a href="<?php echo $BaseUrl; ?>/business-directory/"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/services.png" class="img-responsive" alt="" /><p>Directory Services</p></a></li> -->


<!--  <li class="<?php echo ($directory == 1) ? 'hidden' : ''; ?>" ><a href="<?php echo $BaseUrl; ?>/business-directory/coming_business.php"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/services.png" class="img-responsive" alt="" /><p>Directory Services</p></a></li> -->

<!--<li class="<?php echo ($directory == 1) ? 'hidden' : ''; ?> zoom " ><a href="<?php echo $BaseUrl; ?>/business-directory"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/services.png" class="img-responsive" alt="" /><p>My Business Space</p></a></li>-->

<li class="<?php echo ($directory == 1) ? 'hidden' : ''; ?> zoom "><a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=A"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/services.png" class="img-responsive" alt="" />
<p>Business Space</p>
</a></li>

<li class="<?php echo ($news == 1) ? 'hidden' : ''; ?> zoom "><a class="" href="<?php echo $BaseUrl . '/news/index.php?page=1'; ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/news.png">
<p>News Views</p>
</a></li> 

<li class="<?php echo ($buisness == 1) ? 'hidden' : ''; ?> zoom "><a class="" href="<?php echo $BaseUrl . '/business_for_sale/index.php?page=1'; ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/for_sale_business.webp">
<p>Business for Sale</p>
</a></li> 

<li class="<?php echo ($nft == 1) ? 'hidden' : ''; ?> zoom "><a class="" href="<?php echo $BaseUrl . '/nft'; ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/nft/nft.png">
<p> NFT</p>
</a></li> 

<?php if($_SESSION['ptid'] == 1){ ?>
<li class="<?php echo ($pos == 1) ? 'hidden' : ''; ?> zoom "><a target="_blank" class="" href="<?php echo $BaseUrl . '/store/pos-dashboard/index.php'; ?>"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/pos1.png">
<p> POS</p>
</a></li> 
<?php }?>


<li class="<?php echo (isset($dating) && $dating == 1) ? 'hidden' : ''; ?> zoom "><a target="_blank"
class="" href="https://thesharepagedating.com/"><img src="<?php echo $BaseUrl; ?>/assets/images/2.png">
<p> Dating</p>
</a></li>


<!--  <li class="<?php // echo ($groups == 1)?'hidden':''; 
?>"><a href="<?php // echo $BaseUrl;
?>/my-groups/campaign.php?email=email"><img src="<?php // echo $BaseUrl;
?>/assets/images/icon/home/email-campaign.png" class="img-responsive" alt="" /><p>Email Campaigns</p></a></li> -->

<!--    <li class="<?php // echo  ($groups == 1)?'hidden':''; 
?>"><a href="<?php // echo $BaseUrl;
?>/my-groups/coming_email.php"><img src="<?php // echo $BaseUrl;
?>/assets/images/icon/home/email-campaign.png" class="img-responsive" alt="" /><p>Email Campaigns</p></a></li>-->


<!--   <li class="<?php // echo ($groups == 1)?'hidden':''; 
?>"><a href="<?php // echo $BaseUrl;
?>/my-groups/campaign.php?sms=sms"><img src="<?php // echo $BaseUrl;
?>/assets/images/icon/home/sms-campaigns.png" class="img-responsive" alt="" /><p>SMS Campaigns</p></a></li> -->


<!--   <li class="<?php // echo ($groups == 1)?'hidden':''; 
?>"><a href="<?php // echo $BaseUrl;
?>/my-groups/coming_email.php"><img src="<?php // echo $BaseUrl;
?>/assets/images/icon/home/sms-campaigns.png" class="img-responsive" alt="" /><p>SMS Campaigns</p></a></li>-->

</ul>

<!--
HIDE FOR SOME TIME
<h2>Create</h2>
<div class="create_link">
<a href="#">Advert</a> . <a href="#">Group</a> . <a href="#">Folder</a> . <a href="#">Event</a> . <a href="#">xyz</a>
</div>
-->
</div>
